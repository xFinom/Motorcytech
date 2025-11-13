<?php

namespace App\Services;

use App\Enums\ServiceOrderEvents;
use Illuminate\Support\Facades\Auth;

class ServiceOrderEventPayloadBuilder
{
    public static function for(ServiceOrderEvents $eventType, array $context = []): array
    {
        return match ($eventType) {
            ServiceOrderEvents::StatusChange => [
                'old_status' => $context['old_status'] ?? null,
                'new_status' => $context['new_status'] ?? null,
                'changed_by' => Auth::id(),
            ],

            ServiceOrderEvents::ServiceChange => [
                'old_service_id' => $context['old_service_id'] ?? null,
                'new_service_id' => $context['new_service_id'] ?? null,
                'updated_by' => Auth::id(),
            ],

            ServiceOrderEvents::SparePartQuote => [
                'parts_count' => $context['parts_count'] ?? 0,
                'total_cost' => $context['total_cost'] ?? 0,
                'quoted_by' => Auth::id(),
            ],

            ServiceOrderEvents::BillGenerated => [
                'bill_id' => $context['bill_id'] ?? null,
                'amount' => $context['amount'] ?? 0,
                'generated_by' => Auth::id(),
            ],
        };
    }
}
