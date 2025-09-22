<?php

namespace App\Observers;

use App\Models\ServiceOrderEvent;

class ServiceOrderEventObserver
{
    /**
     * Handle the ServiceOrderEvent "created" event.
     */
    public function created(ServiceOrderEvent $serviceOrderEvent): void
    {
        //
    }

    /**
     * Handle the ServiceOrderEvent "updated" event.
     */
    public function updated(ServiceOrderEvent $serviceOrderEvent): void
    {
        //
    }
}
