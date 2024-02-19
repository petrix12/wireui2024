<?php

namespace App\Policies;

use App\Models\Modelo;
use App\Models\User;

class ModeloPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    // Crear regla de autorización
    public function regla_autorizacion(User $user, Modelo $modelo) {
        $condicion_de_autorizacion = true;  // Ejemplo: $user->id == $modelo->user_id
        if($condicion_de_autorizacion) {
            return true;
        } else {
            return false;
        }
    }
}
