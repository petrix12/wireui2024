<?php

namespace App\Observers;

use App\Models\Modelo;

class ModeloObserver
{
    /**
     * Handle the Modelo "created" event.
     */
    public function created(Modelo $modelo): void
    {
        // Se activa al crear un registro
    }

    public function creating(Modelo $modelo): void
    {
        // Se activa justo antes de crear un registro
    }

    /**
     * Handle the Modelo "updated" event.
     */
    public function updated(Modelo $modelo): void
    {
        //
    }

    /**
     * Handle the Modelo "deleted" event.
     */
    public function deleted(Modelo $modelo): void
    {
        // Se activa al aleminar un registro
    }

    public function deleting(Modelo $modelo): void {
        // Se activa justo antes de aliminar un registro
    }

    /**
     * Handle the Modelo "restored" event.
     */
    public function restored(Modelo $modelo): void
    {
        //
    }

    /**
     * Handle the Modelo "force deleted" event.
     */
    public function forceDeleted(Modelo $modelo): void
    {
        //
    }
}
