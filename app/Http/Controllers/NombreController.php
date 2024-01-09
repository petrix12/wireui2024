<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NombreController extends Controller
{
    public function mi_vista() {
        $parametro = 'Mi parámetro';
        return view('mi_vista', compact('parametro'));
    }
}
