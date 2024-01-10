# LARAVEL 10

## Pre-requisitos obligatorios:
+ [XAMPP](https://www.apachefriends.org/es/index.html) o [Laragon](https://laragon.org/index.html).
+ [Composer](https://getcomposer.org/).
+ [NodeJS](https://nodejs.org).

## Pre-requisitos recomendados:
+ [GIT](https://git-scm.com).
+ [Visual Studio Code](https://code.visualstudio.com).

## Documentación:
+ [Página oficial de Laravel](https://laravel.com).

## Instalar el instalador de Laravel:
+ $ composer global require laravel/installer

## Instalación de un proyecto Laravel:
+ Vía composer (no requiere del instalador de Laravel):
    + $ composer create-project laravel/laravel mi_proyecto_laravel
+ Vía instalador de Laravel:
    + $ laravel new mi_proyecto_laravel

## Extensiones de VSC recomendadas:
+ Laravel Blade formatter (Shuhei Hayashibara).
+ Laravel Blade Snippets (Winnie Lin).
+ Laravel goto view (codingyu).
+ Laravel Snippets (Winnie Lin).
+ PHP Intelephense (Ben Mewburn).
+ Spanish Language Pack for Visual Studio Code (Microsoft).
+ Tailwind CSS IntelliSense (Tailwind Labs).
+ Alpine.js IntelliSense (Adrian Wilczyński).
+ GitHub Copilot (GitHub).

## Estructura de una ruta:
+ Las rutas se definenen en los archivos contenidos en la carpeta **routes**.
+ Ejemplo:
    ```php
    Route::get('ruta/{parametro_obligatorio}/{parametro_opcional?}', function($parametro_obligatorio, $parametro_opcional = null) {
        if($parametro_opcional) {
            return "ruta con $parametro_obligatorio y $parametro_opcional";
        } else {
            return "ruta con solo con $parametro_obligatorio",
        }
    });

    // Buscará el método __invoke en el controlador
    Route::get('ruta', NombreController::class);

    // Buscará el método nombre_metodo en el controlador
    Route::get('ruta', [NombreController::class, 'nombre_metodo']);

    // Definir un grupo de rutas
    Route::controller(NombreController::class)->group(function() {
        Route::get('ruta1', 'metodo1');
        Route::get('ruta2', 'metodo2');
        Route::get('ruta3', 'metodo3');
    });
    ```

## Crear controlador:
+ $ php artisan make:controller NombreController

## Construcción de plantillas Blade
+ Crear plantilla en **resources\views\layouts\mi_plantilla.blade.php**:
    ```php
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <!-- ... -->
        <title>@yield('title')</title>
    </head>
    <body>
        @yield('content')
    </body>
    </html>
    ```
+ Uso de la plantilla en una vista **resources\views\mi_vista.blade.php**:
    ```php
    @extends('layouts.mi_plantilla')

    @section('title', 'Mi título de página')

    @section('content')
        {{-- Mi contenido HTML --}}
    @endsection
    ```

## Invocar vista desde un controllador:
    ```php
    // ...
    class NombreController extends Controller
    {
        // ...
        public function mi_vista() {
            $parametro = 'Mi parámetro';
            return view('mi_vista', compact('parametro'));
        }
        // ...
    }    
    ```

## Migración
+ Documentación: https://laravel.com/docs/10.x/migrations
+ Nombre de ejemplo de un archivo de migración y los posibles tipos de campos a definir:
    + Nombre: database\migrations\2014_10_12_000000_create_users_table.php
    + Código:
        ```php
        // ...
        public function up(): void
        {
            Schema::create('users', function (Blueprint $table) {
                $table->id();                                           // Crea la columna id
                $table->string('name', 150);
                $table->string('email')->unique();
                $table->texto('descripción');
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->rememberToken();                                // Crea la columna remember_token
                $table->foreignId('current_team_id')->nullable();
                $table->string('profile_photo_path', 2048)->nullable();
                $table->timestamps();                                   // Crea las columnas created_at y updated_at
            });
        }
        // ...   
        ```
+ Ejecutar las migraciones:
    + $ php artisan migrate
+ Crear migración:
    + $ php artisan make:migration nombretabla
+ Crear migración siguiendo las convenciones de Laravel:
    + $ php artisan make:migration create_nombretabla_table
    + **Nota:** al usar esta convención se crean las estructuras de los métodos **up** y **down** en el archivo de la migración.
+ Revertir cambios de la última migración:
    + $ php artisan migrate:rollback
+ Revertir todos los cambios y volver a ejecutar las migraciones:
    + $ php artisan migrate:fresh
+ mmm
