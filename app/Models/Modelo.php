<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Casts\Attribute;

class Modelo extends Model
{
    use HasFactory;

    // Definir método para administrar el mutador y el accesor
    // El método debe recibir el nombre del atributo que se desea modificar
    // Usando la forma tradicional
    protected function propiedad1(): Attribute {
        return new Attribute(
            // Accesor
            get: function($value) {
                // retornar el valor aplicando la transformación deseada
                return ucwords($value);
            },
            // Mutador
            set: function($value) {
                // retornar el valor aplicando la transformación deseada
                return strtolower($value);
            }
        );
    }

    // Definir método para administrar el mutador y el accesor
    // El método debe recibir el nombre del atributo que se desea modificar
    // Usando funciones flecha
    protected function propiedad2(): Attribute {
        return new Attribute(
            // Accesor
            get: fn($value) => ucwords($value),
            // Mutador
            set: fn($value) => strtolower($value)
        );
    }

    // Definir método para administrar el mutador y el accesor
    // El método debe recibir el nombre del atributo que se desea modificar
    // Usando la forma antigua
    // Accesor
    protected function getPropiedad3Attribute($value) {
        return  ucwords($value);
    }
    // Mutador
    protected function setPropiedad3Attribute($value) {
        $this->attributes['propiedad3'] = strtolower($value);
    }
}
