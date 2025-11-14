<?php

namespace App\Http\Controllers;

use App\Enums\ApprovalStatus;
use App\Enums\PaymentStatus;
use App\Enums\ServiceOrderEvents;
use App\Models\ServiceOrderBill;
use App\Models\ServiceOrderEvent;
use App\Models\ServiceOrderSparePart;
use Illuminate\Http\Request;
use Laravel\Cashier\Checkout;

class ServiceOrderPaymentController extends Controller
{
    public function pay(Request $request)
    {
        $event = ServiceOrderEvent::query()->findOrFail($request->event_id);

        $items = $event->data['item_ids'] ?? [];

        if ($event->type === ServiceOrderEvents::BillGenerated) {
            $models = ServiceOrderBill::query()->whereIn('id', $items)->get();
        } else {
            $models = ServiceOrderSparePart::query()->whereIn('id', $items)->get();
        }

        $lineItems = $models->map(fn ($item) => [
            'price_data' => [
                'currency' => 'mxn',
                'unit_amount' => intval($item->price * 100),
                'product_data' => [
                    'name' => $item->description ?? $item->name,
                ],
            ],
            'quantity' => $item->quantity ?? 1,
        ])->toArray();

        return Checkout::guest()
           ->create($lineItems, [
               'mode' => 'payment',
               'success_url' => route('service.orders.process', $event),
               'cancel_url' => route('service.orders.show', $event->service_order_id),
           ]);
    }

    public function process(ServiceOrderEvent $event)
    {
        $serviceOrderId = $event->service_order_id;

        $items = $event->data['item_ids'] ?? [];

        if ($event->type === ServiceOrderEvents::BillGenerated) {
            $models = ServiceOrderBill::query()->whereIn('id', $items)->get();
        } else {
            $models = ServiceOrderSparePart::query()->whereIn('id', $items)->get();
        }

        foreach ($models as $model) {
            $model->update([
                'payment_status' => PaymentStatus::Pagado,
            ]);
            $model->save();
        }

        $event->update([
            'approval_status' => ApprovalStatus::Approved,
        ]);
        $event->save();

        return redirect()->route('service.orders.show', $serviceOrderId);
    }
}
