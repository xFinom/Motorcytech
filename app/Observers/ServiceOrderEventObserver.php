<?php

namespace App\Observers;

use App\Enums\ServiceOrderEvents;
use App\Models\ServiceOrderEvent;
use App\Notifications\BillGeneratedNotification;
use App\Notifications\NewUserNotification;
use App\Notifications\OrderStatusChangedNotification;
use App\Notifications\SparePartQuoteNotification;
use Illuminate\Support\Facades\Auth;

class ServiceOrderEventObserver
{
    /**
     * Handle the ServiceOrderEvent "created" event.
     */
    public function created(ServiceOrderEvent $serviceOrderEvent): void
    {
        $serviceOrderEvent->load([
            'serviceOrder',
            'serviceOrder.client',
        ]);

        $notification = match($serviceOrderEvent->type) {
            ServiceOrderEvents::StatusChange => new OrderStatusChangedNotification(),
            ServiceOrderEvents::BillGenerated => new BillGeneratedNotification(),
            ServiceOrderEvents::SparePartQuote => new SparePartQuoteNotification(),
            ServiceOrderEvents::ServiceChange => new NewUserNotification(Auth::user()),
        };

        $serviceOrderEvent->serviceOrder->client->notify($notification);
    }

    /**
     * Handle the ServiceOrderEvent "updated" event.
     */
    public function updated(ServiceOrderEvent $serviceOrderEvent): void
    {
        //
    }
}
