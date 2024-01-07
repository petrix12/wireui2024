<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Livewire y WireUI: Crea interfaces web responsivas de forma fácil
+ URL: https://codersfree.com/cursos/livewire-wireui-crea-interfaces-web-responsivas-facil

## Instalación:
+ Página oficial: https://v1.wireui.dev
1. Ejecutar:
    + $ composer require wireui/wireui
2. Modificar plantilla principal **resources\views\layouts\app.blade.php**:
    ```html
    <!-- ... -->
    <head>
        <!-- ... -->
        @wireUiScripts
        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <!-- ... -->
    ```
3. Modificar el archivo de configuración de tailwind **tailwind.config.js**:
    ```js
    // ...
    module.exports = {
        presets: [
            // ...
            require('./vendor/wireui/wireui/tailwind.config.js')
        ],
        // ...
        content: [
            // ...
            './vendor/wireui/wireui/resources/**/*.blade.php',
            './vendor/wireui/wireui/ts/**/*.ts',
            './vendor/wireui/wireui/src/View/**/*.php'
        ]
    // ...    
    ```
4. Ejecutar:
    + $ npm run dev
5. Publicar archivos de configuración:
    + $ php artisan vendor:publish --tag='wireui.config'
        + **Nota:** publica el archivo de configuración: **config\wireui.php**.
    + $ php artisan vendor:publish --tag='wireui.resources'
        + **Nota:** publica los archivos de recursos en **resources\views\vendor\wireui**.
    + $ php artisan vendor:publish --tag='wireui.lang'
        + **Nota:** publica los archivos de traducción de paquete en **lang\vendor\wireui**.

## Preparación del entorno de prueba
1. Crear rutas de prueba en **routes\web.php**:
    ```php
    // ...    
    use Illuminate\Http\Request;
    // ...

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
    ```
2. Crear rutas de prueba en **routes\api.php**:
    ```php
    // RUTAS DE PRUEBA WIREUI
    Route::get('/users', function(Request $request) {
        $search = $request->search;
        return \App\Models\User::where('name', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%")
            ->get();
    })->name('api.users.index');

    Route::get('/users2', function(Request $request) {
        $search = $request->search;
        return \App\Models\User::where('name', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%")
            ->when($request->exists('selected'), function($query) use($request) {
                $query->whereIn('id', $request->selected)->limit(10);
            })
            ->get();s
    })->name('api.users.index2');

    Route::get('/users3', function(Request $request) {
        return \App\Models\User::when($request->search, function($query, $search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        })->when($request->selected, function($query, $selected) {
            $query->whereIn('id', $selected)->limit(10);
        })->get();
    })->name('api.users.index3');
    ```
3. Crear vistas de prueba:
    + resources\views\wireui\forms.blade.php:
        ```php
        <x-app-layout>
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Formularios
                </h2>
            </x-slot>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <P>AQUÍ EL CONTENIDO DE LA PÁGINA</P>
                    </div>
                </div>
            </div>
        </x-app-layout>       
        ```
    + resources\views\wireui\tables.blade.php:
        ```php
        <x-app-layout>
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Formularios
                </h2>
            </x-slot>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <P>AQUÍ EL CONTENIDO DE LA PÁGINA</P>
                    </div>
                </div>
            </div>
        </x-app-layout>       
        ```
    + resources\views\wireui\livewire.blade.php:
        ```php
        <x-app-layout>
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Formularios
                </h2>
            </x-slot>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <P>AQUÍ EL CONTENIDO DE LA PÁGINA</P>
                    </div>
                </div>
            </div>
        </x-app-layout>       
        ```
    + resources\views\wireui\actions.blade.php:
        ```php
        <x-app-layout>
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Formularios
                </h2>
            </x-slot>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <P>AQUÍ EL CONTENIDO DE LA PÁGINA</P>
                    </div>
                </div>
            </div>
        </x-app-layout>       
        ```
    + resources\views\wireui\ui.blade.php:
        ```php
        <x-app-layout>
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Formularios
                </h2>
            </x-slot>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <P>AQUÍ EL CONTENIDO DE LA PÁGINA</P>
                    </div>
                </div>
            </div>
        </x-app-layout>       
        ```
4. Modificar menú vertical en **resources\menu\AdministradorVerticalMenu.json** para incluir las pruebas:
    ```json
    {
        "menu": [
            {
                "name": "Pruebas WireUI",
                "icon": "menu-icon tf-icons ti ti-table",
                "slug": "pruebas-ui",
                "submenu": [
                    {
                        "url": "/wireui/forms",
                        "name": "Formularios",
                        "icon": "menu-icon tf-icons ti ti-calculator",
                        "slug": "wireui-formularios"
                    },
                    {
                        "url": "/wireui/tables",
                        "name": "Tablas",
                        "icon": "menu-icon tf-icons ti ti-calculator",
                        "slug": "wireui-tables"
                    },
                    {
                        "url": "/wireui/livewire",
                        "name": "Livewire",
                        "icon": "menu-icon tf-icons ti ti-calculator",
                        "slug": "wireui-livewire"
                    },
                    {
                        "url": "/wireui/actions",
                        "name": "Acciones",
                        "icon": "menu-icon tf-icons ti ti-calculator",
                        "slug": "wireui-actions"
                    },
                    {
                        "url": "/wireui/ui",
                        "name": "UI",
                        "icon": "menu-icon tf-icons ti ti-calculator",
                        "slug": "wireui-ui"
                    }
                ]
            },
            // ...
        ]
    }
    ```

## Ejemplos vista formularios
+ Diseñar vista **resources\views\wireui\forms.blade.php**:
    ```php
    @extends('layouts/layoutMaster')

    @section('title', 'Formulario')

    @section('page-style')
    <!-- Enlace al archivo CSS de Tailwind CDN -->
    <link href="{{ asset('assets\css\tailwind.min.css') }}" rel="stylesheet">

    <!-- Añadir en la sección head del HTML -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/jit/tailwind-jit.css" rel="stylesheet"> --}}

    <!-- Añadir en la sección head del HTML -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/jit/tailwind.min.css" rel="stylesheet"> --}}

    <!-- Añadir en la sección head del HTML -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/jit/tailwind.min.css" rel="stylesheet"> --}}

    <!-- Añadir en la sección head del HTML -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet"> --}}

    {{-- <script src="https://cdn.tailwindcss.com/dist/tailwind.min.js"></script> --}}
    {{-- <script src="https://cdn.tailwindcss.com/dist/tailwind.js"></script> --}}



    @endsection

    @section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Pruebas </span>formularios
    </h4>

    <div class="container">
        <form action="{{ route('forms.store') }}" method="POST">
            @csrf

            {{-- VALIDACIÓN DE ERRORES --}}
            <x-errors class="mb-4" title="Pruebas de validación (se encontrarón {errors} errores de validación)" />
            <x-errors class="mb-4" only="nombre|url" />

            <x-card title="Componentes de formularios">
                <x-slot name="action">
                    <x-button icon="plus" {{-- primary --}}>
                        Agregar
                    </x-button>
                </x-slot>

                {{-- INPUTS --}}
                <div class="mb-4">
                    <x-input 
                        class="h-10"
                        name="nombre" 
                        label="Nombre" 
                        placeholder="Nombre..."
                        hint="Información relevante"
                        corner-hint="Ejm.: Pedro Bazó"
                        icon="user"
                        right-icon="pencil"
                    />
                </div>
                <div class="mb-4">
                    <x-input 
                        name="url" 
                        label="URL" 
                        placeholder="tu-sitio-web.com"
                        prefix="https://"
                        class="h-10"
                        style="padding-left: 3.7rem"
                    />
                </div>        
                <div class="mb-4">
                    <x-input 
                        name="email" 
                        label="Correo" 
                        placeholder="Tu correo"
                        suffix="@gmail.com"
                        class="h-10"
                        style="padding-right: 7rem; padding-left: 0.5rem"
                    />
                </div>
                <div class="mb-4">
                    <x-input 
                        class="h-10 pl-20"
                        placeholder="Contraseña..."
                        name="password"
                    >
                        <x-slot name="prepend">
                            <div class="absolute inset-y-0">
                                <x-button
                                    icon="lock-closed"
                                    class="h-full"
                                />
                            </div>
                        </x-slot>
                    </x-input>
                </div>
                <div class="mb-4">
                    <x-input 
                        class="h-10 pl-5 pr-20"
                        placeholder="Contraseña..."
                        name="password2"
                    >
                        <x-slot name="append">
                            <div class="absolute inset-y-0 right-0">
                                <x-button
                                    icon="lock-closed"
                                    class="h-full"
                                />
                            </div>
                        </x-slot>
                    </x-input>
                </div>
                <div class="mb-4">
                    <x-inputs.password
                        class="h-10 pl-5"
                        label="Contraseña"
                        placeholder="Contraseña..."
                        name="password3"
                    />
                </div>
                <div class="mb-4">
                    <x-inputs.number
                        class="h-10 pl-5"
                        label="Número"
                        placeholder="Número..."
                        name="numero"
                    />
                </div>

                {{-- TEXTAREA --}}
                <div class="mb-4">
                    <x-textarea
                        class="pl-5 pt-2"
                        label="Textarea"
                        placeholder="Textarea..."
                        name="texto"
                    />
                </div>

                {{-- SELECTS --}}
                <div class="mb-4">
                    <x-native-select
                        class="h-10 pl-5"
                        label="País"
                        :options="['España', 'Venezuela', 'Austria', 'Colombia', 'Italia']"
                        name="pais"
                        placeholder="Seleccione un país"
                    />
                </div>
                <div class="mb-4">
                    <x-native-select
                        class="h-10 pl-5"
                        label="País"
                        :options="[
                            [
                                'name' => 'España',
                                'id' => 1
                            ], 
                            [
                                'name' => 'Venezuela',
                                'id' => 2
                            ], 
                            [
                                'name' => 'Austria',
                                'id' => 3
                            ], 
                            [
                                'name' => 'Colombia',
                                'id' => 4
                            ], 
                            [
                                'name' => 'Italia',
                                'id' => 5
                            ]
                        ]"
                        name="pais2"
                        placeholder="Seleccione un país"
                        option-label="name"
                        option-value="id"
                    />
                </div>
                <div class="mb-4">
                    <x-native-select
                        class="h-10 pl-5"
                        label="País"
                        name="pais3"
                        placeholder="Seleccione un país"
                    >
                        <option @selected(true) value="1">España</option>
                        <option value="2">Venezuela</option>
                        <option value="3">Austria</option>
                        <option value="4">Colombia</option>
                        <option value="5">Italia</option>
                    </x-native-select>
                </div>
                <div class="mb-4">
                    <x-select
                        label="País"
                        placeholder="Seleccione un país"
                        :options="[
                            [ 'name' => 'España', 'id' => 1, 'description' => 'abc' ],
                            [ 'name' => 'Venezuela', 'id' => 2, 'description' => 'def' ],
                            [ 'name' => 'Austria', 'id' => 3, 'description' => 'hij' ],
                            [ 'name' => 'Colombia', 'id' => 4, 'description' => 'klm' ],
                            [ 'name' => 'Italia', 'id' => 5, 'description' => 'nop' ]
                        ]"
                        name="pais4"
                        option-label="name"
                        option-value="id"
                    />
                </div>
                <div class="mb-4">
                    <x-select
                        label="País"
                        placeholder="Seleccione un país"
                        name="pais5"
                    >
                        <x-select.option value="1">España</x-select.option>
                        <x-select.option value="2">Venezuela</x-select.option>
                        <x-select.option value="3">Austria</x-select.option>
                        <x-select.option value="4">Colombia</x-select.option>
                        <x-select.option value="5">Italia</x-select.option>
                    </x-select>
                </div>
                <div class="mb-4">
                    <x-select
                        label="Usuario"
                        placeholder="Seleccione un usuario"
                        name="usuario"
                    >
                        <x-select.user-option label="Pedro Bazó" src="https://via.placeholder.com/500" value="1" />
                        <x-select.user-option label="Leticia Rodríguez" src="https://via.placeholder.com/500" value="2" />
                        <x-select.user-option label="Isabel Bazó" src="https://via.placeholder.com/500" value="3" />
                    </x-select>
                </div>
                <div class="mb-4">
                    <x-select
                        label="Usuario"
                        placeholder="Seleccione un usuario"
                        name="usuario2"
                        :async-data="route('api.users.index')"
                        option-label="name"
                        option-value="id"
                        :template="[
                            'name' => 'user-option',
                            'config' => [
                                'src' => 'profile_photo_url' // campo de la url de la imagen
                            ]
                        ]"
                    />
                </div>
                <div class="mb-4">
                    <x-select
                        label="Usuario"
                        placeholder="Seleccione un usuario"
                        name="usuario3[]"
                        :async-data="route('api.users.index')"
                        option-label="name"
                        option-value="id"
                        multiselect
                        :template="[
                            'name' => 'user-option',
                            'config' => [
                                'src' => 'profile_photo_url' // campo de la url de la imagen
                            ]
                        ]"
                    />
                </div>
                <div class="mb-4">
                    <x-select
                        label="Usuario"
                        placeholder="Seleccione un usuario"
                        name="usuario4[]"
                        :async-data="route('api.users.index2')"
                        option-label="name"
                        option-value="id"
                        multiselect
                        :template="[
                            'name' => 'user-option',
                            'config' => [
                                'src' => 'profile_photo_url' // campo de la url de la imagen
                            ]
                        ]"
                    />
                </div>
                <div class="mb-4">
                    <x-select
                        label="Usuario"
                        placeholder="Seleccione un usuario"
                        name="usuario4[]"
                        :async-data="route('api.users.index3')"
                        option-label="name"
                        option-value="id"
                        multiselect
                        :template="[
                            'name' => 'user-option',
                            'config' => [
                                'src' => 'profile_photo_url' // campo de la url de la imagen
                            ]
                        ]"
                    />
                </div>

                {{-- COLORS --}}
                <div class="mb-4">
                    <x-color-picker 
                        label="Color"
                        name="color1"
                        placeholder="Seleccione un color"
                    />
                </div>
                <div class="mb-4">
                    <x-color-picker 
                        label="Color"
                        name="color2"
                        placeholder="Seleccione un color"
                        :colors="[
                            [ 'name' => 'White', 'value' => '#FFF'],
                            [ 'name' => 'Black', 'value' => '#000'],
                            [ 'name' => 'Teal', 'value' => '#14B8A6']
                        ]"
                    />
                </div>
                <div class="mb-4">
                    <x-color-picker 
                        label="Color"
                        name="color3"
                        placeholder="Seleccione un color"
                        :colors="['#FFF', '#000', '#14B8A6']"
                    />
                </div>

                {{-- TOGGLES --}}
                <div class="mb-4">
                    <x-toggle name="status" label="Estado" />
                    <x-toggle name="status2" label="Estado" valor="7" />
                    <x-toggle name="status3" left-label="Estado" valor="7" />
                    <x-toggle name="status4" label="Estado" md />
                    <x-toggle name="status4" label="Estado" lg />
                </div>

                {{-- CHECK BOX --}}
                <div class="mb-4 flex space-x-4">
                    <x-checkbox label="Rol 1" id="rol1" value="1" name="roles[]" />
                    <x-checkbox label="Rol 2" id="rol2" value="2" name="roles[]" />
                    <x-checkbox label="Rol 3" id="rol3" value="3" name="roles[]" />
                    <x-checkbox label="Rol 4" id="rol4" value="4" name="roles[]" />
                </div>
                <div class="mb-4 flex space-x-4">
                    <x-checkbox left-label="Rol 1" id="rolb1" value="1" name="rolesb[]" />
                    <x-checkbox left-label="Rol 2" id="rolb2" value="2" name="rolesb[]" />
                    <x-checkbox left-label="Rol 3" id="rolb3" value="3" name="rolesb[]" />
                    <x-checkbox left-label="Rol 4" id="rolb4" value="4" name="rolesb[]" />
                </div>
                <div class="mb-4 flex space-x-4">
                    <x-checkbox md left-label="Rol 1" id="rolc1" value="1" name="rolesc[]" />
                    <x-checkbox md left-label="Rol 2" id="rolc2" value="2" name="rolesc[]" />
                    <x-checkbox md left-label="Rol 3" id="rolc3" value="3" name="rolesc[]" />
                    <x-checkbox md left-label="Rol 4" id="rolc4" value="4" name="rolesc[]" />
                </div>

                {{-- RADIS BUTTONS --}}
                <div class="mb-4 flex space-x-4">
                    <x-radio label="Persona 1" id="pers1" value="1" name="pers" />
                    <x-radio label="Persona 2" id="pers2" value="2" name="pers" />
                    <x-radio label="Persona 3" id="pers3" value="3" name="pers" />
                    <x-radio label="Persona 4" id="pers4" value="4" name="pers" />
                </div>

                <x-slot name="footer">
                    {{-- BOTONES --}}
                    <div class="mb-4">
                        <x-button type="submit" class="w-full" black>Guardar</x-button>
                    </div>                
                    <div class="mb-4">
                        <x-button type="submit" class="w-full" teal outline>Guardar</x-button>
                    </div>                
                    <div class="mb-4">
                        <x-button type="submit" class="w-full" slate flat>Guardar</x-button>
                    </div>            
                    <div class="mb-4">
                        <x-button type="submit" class="w-full" icon="home">Guardar</x-button>
                    </div>            
                    <div class="mb-4">
                        <x-button.circle type="submit" icon="home"></x-button.circle>
                        <x-button type="submit" icon="home" label="Guardar"></x-button>
                        <x-button type="submit" icon="home" label="Guardar" xs></x-button>
                        <x-button type="submit" icon="home" label="Guardar" sm></x-button>
                        <x-button type="submit" icon="home" label="Guardar" md></x-button>
                        <x-button type="submit" icon="home" label="Guardar" lg></x-button>
                        <x-button type="submit" icon="home" label="Google" href="https://www.google.com"></x-button>
                        <x-button type="submit" icon="home" label="Home" href="/"></x-button>
                    </div>
                </x-slot>
            </x-card>
        </form>
    </div>
    @endsection    
    ```

## Ejemplos vista tablas
+ Instalar Livewire Powergrid:
    + $ composer require power-components/livewire-powergrid
+ Publicar los archivos de configuración:
    + $ php artisan vendor:publish --tag=livewire-powergrid-config
        + **Nota:** se genera un archivo de configuración en **config\livewire-powergrid.php**
+ Crear una tabla:
    + $ php artisan powergrid:create
    + Component Name: UserTable
    + [M]odel or [C]ollection? (default: M): M
    + Model (ex: App\Models\User): App\Models\User
    + Use the based on fillable ? (yes/no) [no]: yes
    + **Nota:** La tabla se crea como un componente de Livewire:
        + Controlador: app\Http\Livewire\UserTable.php
        + Vista: en la vista se llamará con la directiva: @livewire('user-table')
+ Diseñar vista **resources\views\wireui\tables.blade.php**:
    ```php
    @extends('layouts/layoutMaster')

    @section('title', 'Tablas')

    @section('page-style')
    <!-- Enlace al archivo CSS de Tailwind CDN -->
    <link href="{{ asset('assets\css\tailwind.min.css') }}" rel="stylesheet">
    @endsection

    @section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Pruebas </span>tablas
    </h4>

    <x-card title="Tabla de prueba">
        @livewire('user-table')
    </x-card>
    @endsection
    ```

## Componentes de Livewire
1. Crear componente livewire:
    + $ php artisan make:livewire forms
2. Modificar vista **resources\views\wireui\livewire.blade.php**:
    ```php
    @extends('layouts/layoutMaster')

    @section('title', 'Livewire')

    @section('page-style')
    <!-- Enlace al archivo CSS de Tailwind CDN -->
    <link href="{{ asset('assets\css\tailwind.min.css') }}" rel="stylesheet">
    @endsection

    @section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Pruebas </span>livewire
    </h4>

    <x-card title="Componente livewire de prueba">
        @livewire('forms')
    </x-card>
    @endsection
    ```
3. Modificar componente **resources\views\livewire\forms.blade.php**:
    ```php
    <div>
        {{-- MASCARAS --}}
        <div class="mb-4">
            <x-inputs.maskable 
                label="Teléfono"
                placeholder="Ingrese su número"
                mask="['(+##) ###-##.##.##', '(+###) ###-##.##.##']"
                {{-- Para ver más opciones de máscaras: https://v1.wireui.dev/docs/maskable-inputs --}}
            />
        </div>

        {{-- CURRENCY --}}
        <div class="mb-4">
            <x-inputs.currency
                label="Importe"
            />
            <x-inputs.currency
                label="Importe"
                precision="3"   {{-- Definir números decimales --}}
                thousands="."   {{-- Caracter de separadores de miles --}}
                decimal=","     {{-- Caracter de separadores de decimales --}}
                icon="currency-dollar"
            />
            <x-inputs.currency
                label="Importe"
                precision="3"   {{-- Definir números decimales --}}
                thousands="."   {{-- Caracter de separadores de miles --}}
                decimal=","     {{-- Caracter de separadores de decimales --}}
                prefix="Bs."
            />
        </div>

        {{-- FECHA y HORA --}}
        <div class="mb-4">
            <x-input 
                type="date"
            />
            <x-datetime-picker 
                label="Fecha y hora"
                placeholder="Ingrese Fecha y hora"
            />
            <x-datetime-picker 
                label="Fecha y hora"
                placeholder="Ingrese Fecha y hora"
                :min="now()->subDays(7)->format('Y-m-d')"
                :max="now()->addDays(7)->format('Y-m-d')"
            />        
            <x-datetime-picker 
                label="Fecha"
                placeholder="Ingrese Fecha"
                without-time    {{-- para mostrar solo fecha y ocultar hora --}}            
            />
            <x-time-picker 
                label="Hora"
                placeholder="Ingrese hora"
            />
            <x-time-picker 
                label="Hora"
                placeholder="Ingrese hora"
                interval="15"
            />
            <x-time-picker 
                label="Hora"
                placeholder="Ingrese hora"
                format="24"
            />
        </div>
    </div>
    ```

## Acciones
1. Crear componente livewire:
    + $ php artisan make:livewire notification
2. Crear componente livewire:
    + $ php artisan make:livewire dialog
3. Incluir el componente **notifications** en **resources\views\layouts\app.blade.php**:
    ```php
    <!-- ... -->
    <body class="font-sans antialiased bg-light">
        <!-- ... -->
        <x-notifications />
        <x-dialog />
        <!-- ... -->
    </body>
    <!-- ... -->
    ```
4. Modificar la vista **resources\views\wireui\actions.blade.php**:
    ```php
    ```
5. Modificar controlador livewire **app\Http\Livewire\Notification.php**:
    ```php
    <?php

    namespace App\Http\Livewire;

    use Livewire\Component;
    use WireUi\Traits\Actions;

    class Notification extends Component
    {
        use Actions;

        public function open() {
            /* 
            $this->notification([
                'title' => 'Notificación',
                'description' => 'Notificación de prueba',
                'icon' => 'info'
            ]); 
            */

            /* 
            $this->notification()->success(
                $title ='Notificación',
                $description = 'Notificación de prueba'
            ); 
            */

            $this->notification()->confirm([
                'title' => 'Seguro?',
                'description' => 'Descripción de prueba',
                'icon' => 'question',
                'accept' => [
                    'label' => 'Aceptar',
                    'method' => 'miMetodo',
                    'params' => 'prueba'
                ],
                'reject' => [
                    'label' => 'Cancelar'
                ]
            ]);
        }

        public function miMetodo($params) {

        }

        public function render()
        {
            return view('livewire.notification');
        }
    }
    ```
6. Modificar vista livewire **resources\views\livewire\notification.blade.php**:
    ```php
    <div>
        <x-button dark wire:click="open()">
            Abrir notificación
        </x-button>
    </div>
    ```
7. Modificar controlador livewire **app\Http\Livewire\Dialog.php**:
    ```php
    ```
8. Modificar vista livewire **resources\views\livewire\dialog.blade.php**:
    ```php
    <div>
        <div>
            <x-button dark wire:click="open()">
                Abrir diálogo
            </x-button>
        </div>
    </div>
    ```
9. mmmmm



## Páginas de interes
+ Iconos: https://v1.heroicons.com
+ Botones: https://v1.wireui.dev/docs/buttons
+ Tablas: 
    + https://github.com/Power-Components/livewire-powergrid
    + https://livewire-powergrid.com/get-started/install.html
    + https://livewire-powergrid.com/get-started/create-powergrid-table.html
+ Mascaras: https://v1.wireui.dev/docs/maskable-inputs


Videos culminados: 14 (Componentes de formularios)
Rama actual: wireui01