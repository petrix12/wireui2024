<?php

namespace App\Listeners;

use App\Events\EventoEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class OyenteListener
{
    /**
     * Create the event listener.
     */
    public function __construct() {}

    /**
     * Handle the event.
     */
    public function handle(EventoEvent $event): void
    {
        // Aquí las acciones a tomar con la información del evento $data
        dd('Información recibida: ' . $event->data);
    }
}
