<?php

use App\Mail\CorreoMailable;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// RUTAS DE PRUEBA WIREUI
Route::get('/wireui/forms', function () {
    return view('wireui.forms');
})->name('forms');

Route::post('/wireui/forms', function (Request $request) {
    $request->validate([
        'nombre' => 'required',
        'url' => 'required'
    ]);
    return $request->all();
})->name('forms.store');

Route::get('/wireui/tables', function () {
    return view('wireui.tables');
})->name('tables');

Route::get('/wireui/livewire', function () {
    return view('wireui.livewire');
})->name('livewire');

Route::get('/wireui/actions', function () {
    return view('wireui.actions');
})->name('actions');

Route::get('/wireui/ui', function () {
    return view('wireui.ui');
})->name('ui');

Route::get('/wireui/dropdown', function () {
    return view('wireui.dropdown');
})->name('dropdown');

Route::get('/wireui/modal', function () {
    return view('wireui.modal');
})->name('modal');

Route::get('correo', function() {
    Mail::to('mi.correo1@correo.com')
        ->send(new CorreoMailable([
            'from_email' => 'mi.correo1@correo.com', 
            'from_name' => 'Mi nombre', 
            'asunto' => 'asunto', 
            'message' => 'mensaje...'
        ]));
    return 'correo enviado';
});
