<?php

namespace App\Http\Controllers;

use App\Models\Modelo;
use Illuminate\Http\Request;

class ModeloController extends Controller
{
    public function index() {
        $modelos = Modelo::paginate();
        return view('crud.modelos.index', compact('modelos'));
    }

    public function create() {
        return view('crud.modelos.create');
    }

    public function store(Request $request) {
        $request->validate([
            'propiedad1' => 'required|min:12'
            // Forma alternativa:
            // 'propiedad1' => ['required', 'min:12']
        ]);
        // Forma 1:
        /*
        $modelo = new Modelo();
        $modelo->propiedad1 = $request->propiedad1;
        $modelo->save();
        */

        // Forma 2:
        /*
        $modelo = Modelo::create([
            'propiedad1' => $request->propiedad1
        ]);
        */

        // Forma 3:
        $modelo = Modelo::create($request->all());

        return redirect()->route('modelos.show', $modelo);
    }

    public function show(Modelo $modelo) {
        return view('crud.modelos.show', compact('modelo'));
    }

    public function edit(Modelo $modelo) {
        $this->authorize('regla_autorizacion', $modelo);
        return view('crud.modelos.edit', compact('modelo'));
    }

    public function update(Request $request, Modelo $modelo) {
        $this->authorize('regla_autorizacion', $modelo);
        $request->validate([
            // Reglas de validación
            'propiedad1' => 'required|min:12'
        ], [
            // Personalización de los mensajes de error
            'propiedad1.required' => 'La propiedad 1 es obligatoria'
        ], [
            // Personalización de los atributos
            'propiedad1' => 'Cambio de nombre'
        ]);

        // Forma 1:
        /*
        $modelo->propiedad1 = $request->propiedad1;
        $modelo->save();
        */

        // Forma 2:
        $modelo->update(['propiedad1' => $request->propiedad1]);

        // Forma 3:
        $modelo->update($request->all());

        return redirect()->route('modelos.show', $modelo);
    }

    public function destroy(Modelo $modelo) {
        $this->authorize('regla_autorizacion', $modelo);
        $modelo->delete();
        return redirect()->route('modelos.index');
    }
}
