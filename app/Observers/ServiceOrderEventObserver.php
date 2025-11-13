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
        // TODO: enviar correos
    }

    /**
     * Handle the ServiceOrderEvent "updated" event.
     */
    public function updated(ServiceOrderEvent $serviceOrderEvent): void
    {
        //
    }
}
