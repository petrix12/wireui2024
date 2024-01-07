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


## Cambiar nombres a componentes de WireUI para evitar conflictos con Jetstream o cualquier otro componente
1. Modificar archivo de configuración **config\wireui.php** (al **alias** del elemento **components** anteponer **wireui.**):
    ```php
    // ...
    return [
        // ...
        'components' => [
            'avatar' => [
                'class' => Components\Avatar::class,
                'alias' => 'wireui.avatar',
            ],
            'icon' => [
                'class' => Components\Icon::class,
                'alias' => 'wireui.icon',
            ],
            'icon.spinner' => [
                'class' => Components\Icons\Spinner::class,
                'alias' => 'wireui.icon.spinner',
            ],
            'color-picker' => [
                'class' => Components\ColorPicker::class,
                'alias' => 'wireui.color-picker',
            ],
            'input' => [
                'class' => Components\Input::class,
                'alias' => 'wireui.input',
            ],
            'textarea' => [
                'class' => Components\Textarea::class,
                'alias' => 'wireui.textarea',
            ],
            'label' => [
                'class' => Components\Label::class,
                'alias' => 'wireui.label',
            ],
            'error' => [
                'class' => Components\Error::class,
                'alias' => 'wireui.error',
            ],
            'errors' => [
                'class' => Components\Errors::class,
                'alias' => 'wireui.errors',
            ],
            'inputs.maskable' => [
                'class' => Components\Inputs\MaskableInput::class,
                'alias' => 'wireui.inputs.maskable',
            ],
            'inputs.phone' => [
                'class' => Components\Inputs\PhoneInput::class,
                'alias' => 'wireui.inputs.phone',
            ],
            'inputs.currency' => [
                'class' => Components\Inputs\CurrencyInput::class,
                'alias' => 'wireui.inputs.currency',
            ],
            'inputs.number' => [
                'class' => Components\Inputs\NumberInput::class,
                'alias' => 'wireui.inputs.number',
            ],
            'inputs.password' => [
                'class' => Components\Inputs\PasswordInput::class,
                'alias' => 'wireui.inputs.password',
            ],
            'badge' => [
                'class' => Components\Badge::class,
                'alias' => 'wireui.badge',
            ],
            'badge.circle' => [
                'class' => Components\CircleBadge::class,
                'alias' => 'wireui.badge.circle',
            ],
            'button' => [
                'class' => Components\Button::class,
                'alias' => 'wireui.button',
            ],
            'button.circle' => [
                'class' => Components\CircleButton::class,
                'alias' => 'wireui.button.circle',
            ],
            'dropdown' => [
                'class' => Components\Dropdown::class,
                'alias' => 'wireui.dropdown',
            ],
            'dropdown.item' => [
                'class' => Components\Dropdown\DropdownItem::class,
                'alias' => 'wireui.dropdown.item',
            ],
            'dropdown.header' => [
                'class' => Components\Dropdown\DropdownHeader::class,
                'alias' => 'wireui.dropdown.header',
            ],
            'notifications' => [
                'class' => Components\Notifications::class,
                'alias' => 'wireui.notifications',
            ],
            'datetime-picker' => [
                'class' => Components\DatetimePicker::class,
                'alias' => 'wireui.datetime-picker',
            ],
            'time-picker' => [
                'class' => Components\TimePicker::class,
                'alias' => 'wireui.time-picker',
            ],
            'card' => [
                'class' => Components\Card::class,
                'alias' => 'wireui.card',
            ],
            'native-select' => [
                'class' => Components\NativeSelect::class,
                'alias' => 'wireui.native-select',
            ],
            'select' => [
                'class' => Components\Select::class,
                'alias' => 'wireui.select',
            ],
            'select.option' => [
                'class' => Components\Select\Option::class,
                'alias' => 'wireui.select.option',
            ],
            'select.user-option' => [
                'class' => Components\Select\UserOption::class,
                'alias' => 'wireui.select.user-option',
            ],
            'toggle' => [
                'class' => Components\Toggle::class,
                'alias' => 'wireui.toggle',
            ],
            'checkbox' => [
                'class' => Components\Checkbox::class,
                'alias' => 'wireui.checkbox',
            ],
            'radio' => [
                'class' => Components\Radio::class,
                'alias' => 'wireui.radio',
            ],
            'modal' => [
                'class' => Components\Modal::class,
                'alias' => 'wireui.modal',
            ],
            'modal.card' => [
                'class' => Components\ModalCard::class,
                'alias' => 'wireui.modal.card',
            ],
            'dialog' => [
                'class' => Components\Dialog::class,
                'alias' => 'wireui.dialog',
            ],
        ],
    ];
    ```
2. Ejecutar:
    + $ php artisan optimize:clear


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

    Route::post('/wireui/forms', function () {
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
        @extends('layouts/layoutMaster')

        @section('title', 'Formulario')

        @section('page-style')
        <!-- Enlace al archivo CSS de Tailwind CDN -->
        <link href="{{ asset('assets\css\tailwind.min.css') }}" rel="stylesheet">
        @endsection

        @section('content')
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Pruebas </span>formularios
        </h4>
        @endsection        
        ```
    + resources\views\wireui\tables.blade.php:
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
        ```
    + resources\views\wireui\livewire.blade.php:
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
        ```
    + resources\views\wireui\actions.blade.php:
        ```php
        @extends('layouts/layoutMaster')

        @section('title', 'Acciones')

        @section('page-style')
        <!-- Enlace al archivo CSS de Tailwind CDN -->
        <link href="{{ asset('assets\css\tailwind.min.css') }}" rel="stylesheet">
        @endsection

        @section('content')
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Pruebas </span>acciones
        </h4>
        @endsection        
        ```
    + resources\views\wireui\ui.blade.php:
        ```php
        @extends('layouts/layoutMaster')

        @section('title', 'UI')

        @section('page-style')
        <!-- Enlace al archivo CSS de Tailwind CDN -->
        <link href="{{ asset('assets\css\tailwind.min.css') }}" rel="stylesheet">
        @endsection

        @section('content')
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Pruebas </span>UI
        </h4>
        @endsection        
        ```
    + resources\views\wireui\dropdown.blade.php:
        ```php
        @extends('layouts/layoutMaster')

        @section('title', 'Dropdown')

        @section('page-style')
        <!-- Enlace al archivo CSS de Tailwind CDN -->
        <link href="{{ asset('assets\css\tailwind.min.css') }}" rel="stylesheet">
        @endsection

        @section('content')
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Pruebas </span>Dropdown
        </h4>
        @endsection        
        ```
    + resources\views\wireui\modal.blade.php:
        ```php
        @extends('layouts/layoutMaster')

        @section('title', 'Modal')

        @section('page-style')
        <!-- Enlace al archivo CSS de Tailwind CDN -->
        <link href="{{ asset('assets\css\tailwind.min.css') }}" rel="stylesheet">
        @endsection

        @section('content')
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Pruebas </span>Modales
        </h4>
        @endsection        
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
                    },
                    {
                        "url": "/wireui/dropdown",
                        "name": "Dropdown",
                        "icon": "menu-icon tf-icons ti ti-calculator",
                        "slug": "wireui-dropdown"
                    },
                    {
                        "url": "/wireui/modal",
                        "name": "Modales",
                        "icon": "menu-icon tf-icons ti ti-calculator",
                        "slug": "wireui-modal"
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
            <x-wireui.errors class="mb-4" title="Pruebas de validación (se encontrarón {errors} errores de validación)" />
            <x-wireui.errors class="mb-4" only="nombre|url" />

            <x-wireui.card title="Componentes de formularios">
                <x-slot name="action">
                    <x-wireui.button icon="plus" {{-- primary --}}>
                        Agregar
                    </x-wireui.button>
                </x-slot>

                {{-- INPUTS --}}
                <div class="mb-4">
                    <x-wireui.input 
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
                    <x-wireui.input 
                        name="url" 
                        label="URL" 
                        placeholder="tu-sitio-web.com"
                        prefix="https://"
                        class="h-10"
                        style="padding-left: 3.7rem"
                    />
                </div>        
                <div class="mb-4">
                    <x-wireui.input 
                        name="email" 
                        label="Correo" 
                        placeholder="Tu correo"
                        suffix="@gmail.com"
                        class="h-10"
                        style="padding-right: 7rem; padding-left: 0.5rem"
                    />
                </div>
                <div class="mb-4">
                    <x-wireui.input 
                        class="h-10 pl-20"
                        placeholder="Contraseña..."
                        name="password"
                    >
                        <x-slot name="prepend">
                            <div class="absolute inset-y-0">
                                <x-wireui.button
                                    icon="lock-closed"
                                    class="h-full"
                                />
                            </div>
                        </x-slot>
                    </x-wireui.input>
                </div>
                <div class="mb-4">
                    <x-wireui.input 
                        class="h-10 pl-5 pr-20"
                        placeholder="Contraseña..."
                        name="password2"
                    >
                        <x-slot name="append">
                            <div class="absolute inset-y-0 right-0">
                                <x-wireui.button
                                    icon="lock-closed"
                                    class="h-full"
                                />
                            </div>
                        </x-slot>
                    </x-wireui.input>
                </div>
                <div class="mb-4">
                    <x-wireui.inputs.password
                        class="h-10 pl-5"
                        label="Contraseña"
                        placeholder="Contraseña..."
                        name="password3"
                    />
                </div>
                <div class="mb-4">
                    <x-wireui.inputs.number
                        class="h-10 pl-5"
                        label="Número"
                        placeholder="Número..."
                        name="numero"
                    />
                </div>

                {{-- TEXTAREA --}}
                <div class="mb-4">
                    <x-wireui.textarea
                        class="pl-5 pt-2"
                        label="Textarea"
                        placeholder="Textarea..."
                        name="texto"
                    />
                </div>

                {{-- SELECTS --}}
                <div class="mb-4">
                    <x-wireui.native-select
                        class="h-10 pl-5"
                        label="País"
                        :options="['España', 'Venezuela', 'Austria', 'Colombia', 'Italia']"
                        name="pais"
                        placeholder="Seleccione un país"
                    />
                </div>
                <div class="mb-4">
                    <x-wireui.native-select
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
                    <x-wireui.native-select
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
                    </x-wireui.native-select>
                </div>
                <div class="mb-4">
                    <x-wireui.select
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
                    <x-wireui.select
                        label="País"
                        placeholder="Seleccione un país"
                        name="pais5"
                    >
                        <x-wireui.select.option value="1">España</x-wireui.select.option>
                        <x-wireui.select.option value="2">Venezuela</x-wireui.select.option>
                        <x-wireui.select.option value="3">Austria</x-wireui.select.option>
                        <x-wireui.select.option value="4">Colombia</x-wireui.select.option>
                        <x-wireui.select.option value="5">Italia</x-wireui.select.option>
                    </x-wireui.select>
                </div>
                <div class="mb-4">
                    <x-wireui.select
                        label="Usuario"
                        placeholder="Seleccione un usuario"
                        name="usuario"
                    >
                        <x-wireui.select.user-option label="Pedro Bazó" src="https://via.placeholder.com/500" value="1" />
                        <x-wireui.select.user-option label="Leticia Rodríguez" src="https://via.placeholder.com/500" value="2" />
                        <x-wireui.select.user-option label="Isabel Bazó" src="https://via.placeholder.com/500" value="3" />
                    </x-wireui.select>
                </div>
                <div class="mb-4">
                    <x-wireui.select
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
                    <x-wireui.select
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
                    <x-wireui.select
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
                    <x-wireui.select
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
                    <x-wireui.color-picker 
                        label="Color"
                        name="color1"
                        placeholder="Seleccione un color"
                    />
                </div>
                <div class="mb-4">
                    <x-wireui.color-picker 
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
                    <x-wireui.color-picker 
                        label="Color"
                        name="color3"
                        placeholder="Seleccione un color"
                        :colors="['#FFF', '#000', '#14B8A6']"
                    />
                </div>

                {{-- TOGGLES --}}
                <div class="mb-4">
                    <x-wireui.toggle name="status" label="Estado" />
                    <x-wireui.toggle name="status2" label="Estado" valor="7" />
                    <x-wireui.toggle name="status3" left-label="Estado" valor="7" />
                    <x-wireui.toggle name="status4" label="Estado" md />
                    <x-wireui.toggle name="status4" label="Estado" lg />
                </div>

                {{-- CHECK BOX --}}
                <div class="mb-4 flex space-x-4">
                    <x-wireui.checkbox label="Rol 1" id="rol1" value="1" name="roles[]" />
                    <x-wireui.checkbox label="Rol 2" id="rol2" value="2" name="roles[]" />
                    <x-wireui.checkbox label="Rol 3" id="rol3" value="3" name="roles[]" />
                    <x-wireui.checkbox label="Rol 4" id="rol4" value="4" name="roles[]" />
                </div>
                <div class="mb-4 flex space-x-4">
                    <x-wireui.checkbox left-label="Rol 1" id="rolb1" value="1" name="rolesb[]" />
                    <x-wireui.checkbox left-label="Rol 2" id="rolb2" value="2" name="rolesb[]" />
                    <x-wireui.checkbox left-label="Rol 3" id="rolb3" value="3" name="rolesb[]" />
                    <x-wireui.checkbox left-label="Rol 4" id="rolb4" value="4" name="rolesb[]" />
                </div>
                <div class="mb-4 flex space-x-4">
                    <x-wireui.checkbox md left-label="Rol 1" id="rolc1" value="1" name="rolesc[]" />
                    <x-wireui.checkbox md left-label="Rol 2" id="rolc2" value="2" name="rolesc[]" />
                    <x-wireui.checkbox md left-label="Rol 3" id="rolc3" value="3" name="rolesc[]" />
                    <x-wireui.checkbox md left-label="Rol 4" id="rolc4" value="4" name="rolesc[]" />
                </div>

                {{-- RADIS BUTTONS --}}
                <div class="mb-4 flex space-x-4">
                    <x-wireui.radio label="Persona 1" id="pers1" value="1" name="pers" />
                    <x-wireui.radio label="Persona 2" id="pers2" value="2" name="pers" />
                    <x-wireui.radio label="Persona 3" id="pers3" value="3" name="pers" />
                    <x-wireui.radio label="Persona 4" id="pers4" value="4" name="pers" />
                </div>

                <x-slot name="footer">
                    {{-- BOTONES --}}
                    <div class="mb-4">
                        <x-wireui.button type="submit" class="w-full" black>Guardar</x-wireui.button>
                    </div>                
                    <div class="mb-4">
                        <x-wireui.button type="submit" class="w-full" teal outline>Guardar</x-wireui.button>
                    </div>                
                    <div class="mb-4">
                        <x-wireui.button type="submit" class="w-full" slate flat>Guardar</x-wireui.button>
                    </div>            
                    <div class="mb-4">
                        <x-wireui.button type="submit" class="w-full" icon="home">Guardar</x-wireui.button>
                    </div>            
                    <div class="mb-4">
                        <x-wireui.button.circle type="submit" icon="home"></x-wireui.button.circle>
                        <x-wireui.button type="submit" icon="home" label="Guardar"></x-wireui.button>
                        <x-wireui.button type="submit" icon="home" label="Guardar" xs></x-wireui.button>
                        <x-wireui.button type="submit" icon="home" label="Guardar" sm></x-wireui.button>
                        <x-wireui.button type="submit" icon="home" label="Guardar" md></x-wireui.button>
                        <x-wireui.button type="submit" icon="home" label="Guardar" lg></x-wireui.button>
                        <x-wireui.button type="submit" icon="home" label="Google" href="https://www.google.com"></x-wireui.button>
                        <x-wireui.button type="submit" icon="home" label="Home" href="/"></x-wireui.button>
                    </div>
                </x-slot>
            </x-wireui.card>
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

    <x-wireui.card title="Tabla de prueba">
        @livewire('user-table')
    </x-wireui.card>
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

    <x-wireui.card title="Componente livewire de prueba">
        @livewire('forms')
    </x-wireui.card>
    @endsection
    ```
3. Modificar componente **resources\views\livewire\forms.blade.php**:
    ```php
    <div>
        {{-- MASCARAS --}}
        <div class="mb-4">
            <x-wireui.inputs.maskable 
                label="Teléfono"
                placeholder="Ingrese su número"
                mask="['(+##) ###-##.##.##', '(+###) ###-##.##.##']"
                {{-- Para ver más opciones de máscaras: https://v1.wireui.dev/docs/maskable-inputs --}}
            />
        </div>

        {{-- CURRENCY --}}
        <div class="mb-4">
            <x-wireui.inputs.currency
                label="Importe"
            />
            <x-wireui.inputs.currency
                label="Importe"
                precision="3"   {{-- Definir números decimales --}}
                thousands="."   {{-- Caracter de separadores de miles --}}
                decimal=","     {{-- Caracter de separadores de decimales --}}
                icon="currency-dollar"
            />
            <x-wireui.inputs.currency
                label="Importe"
                precision="3"   {{-- Definir números decimales --}}
                thousands="."   {{-- Caracter de separadores de miles --}}
                decimal=","     {{-- Caracter de separadores de decimales --}}
                prefix="Bs."
            />
        </div>

        {{-- FECHA y HORA --}}
        <div class="mb-4">
            <x-wireui.input 
                type="date"
            />
            <x-wireui.datetime-picker 
                label="Fecha y hora"
                placeholder="Ingrese Fecha y hora"
            />
            <x-wireui.datetime-picker 
                label="Fecha y hora"
                placeholder="Ingrese Fecha y hora"
                :min="now()->subDays(7)->format('Y-m-d')"
                :max="now()->addDays(7)->format('Y-m-d')"
            />        
            <x-wireui.datetime-picker 
                label="Fecha"
                placeholder="Ingrese Fecha"
                without-time    {{-- para mostrar solo fecha y ocultar hora --}}            
            />
            <x-wireui.time-picker 
                label="Hora"
                placeholder="Ingrese hora"
            />
            <x-wireui.time-picker 
                label="Hora"
                placeholder="Ingrese hora"
                interval="15"
            />
            <x-wireui.time-picker 
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
    @extends('layouts/layoutMaster')

    @section('title', 'Acciones')

    @section('page-style')
    <!-- Enlace al archivo CSS de Tailwind CDN -->
    <link href="{{ asset('assets\css\tailwind.min.css') }}" rel="stylesheet">
    @endsection

    @section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Pruebas </span>acciones
    </h4>

    <x-wireui.card title="Prueba de acciones y notificaciones">
        <div class="mb-4">
            <x-wireui.button dark onclick="openNotification()">
                Abrir notificación
            </x-wireui.button>
        </div>
        <div class="mb-4">
            @livewire('notification')
        </div>
        <div class="mb-4">
            <x-wireui.button dark onclick="openDialogo()">
                Abrir diálogo
            </x-wireui.button>
        </div>
        <div class="mb-4">
            @livewire('dialog')
        </div>
    </x-wireui.card>
    @endsection

    @section('page-script')
    <script>
        function openNotification() {
            window.$wireui.notify({
                'title': 'Notificación',
                'description': 'Descripción de prueba',
                'icon': 'success'
            });
        }
        function openDialogo() {
            window.$wireui.dialog({
                'title': 'Diálogo',
                'description': 'Descripción de prueba',
                'icon': 'success'
            });
        }
    </script>
    @endsection
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
        <x-wireui.button dark wire:click="open()">
            Abrir notificación
        </x-wireui.button>
    </div>
    ```
7. Modificar controlador livewire **app\Http\Livewire\Dialog.php**:
    ```php
    <?php

    namespace App\Http\Livewire;

    use Livewire\Component;
    use WireUi\Traits\Actions;

    class Dialog extends Component
    {
        use Actions;

        public function open() {
            /*
            $this->dialog([
                'title' => 'Diálogo',
                'description' => 'Diálogo de prueba',
                'icon' => 'info'
            ]);
            */

            $this->dialog()->confirm([
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
            return view('livewire.dialog');
        }
    }
    ```
8. Modificar vista livewire **resources\views\livewire\dialog.blade.php**:
    ```php
    <div>
        <div>
            <x-wireui.button dark wire:click="open()">
                Abrir diálogo
            </x-wireui.button>
        </div>
    </div>
    ```

## Componentes UI
1. Modificar vista **resources\views\wireui\ui.blade.php**:
    ```php
    @extends('layouts/layoutMaster')

    @section('title', 'UI')

    @section('page-style')
    <!-- Enlace al archivo CSS de Tailwind CDN -->
    <link href="{{ asset('assets\css\tailwind.min.css') }}" rel="stylesheet">
    @endsection

    @section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Pruebas </span>UI
    </h4>
    <x-wireui.card title="Pruebas componente UI">
        {{-- ICONOS --}}
        {{-- Iconos: https://v1.heroicons.com --}}
        <h5>Iconos</h5>
        <div class="mb-4 flex gap-5">
            <x-wireui.icon name="chip" class="w-5 h-5" />
            <x-wireui.icon name="chip" class="w-5 h-5" solid />
        </div>

        {{-- BADGES --}}
        {{-- Badges: https://v1.wireui.dev/docs/badges --}}
        <h5>Badges</h5>
        <div class="mb-4 flex gap-5">
            <x-wireui.badge dark>12</x-wireui.badge>
            <x-wireui.badge red outline>20</x-wireui.badge>
            <x-wireui.badge blue flat>30</x-wireui.badge>
            <x-wireui.badge blue rounded>30</x-wireui.badge>
            <x-wireui.badge blue squared>30</x-wireui.badge>
            <x-wireui.badge dark label="Soluciones++" />
            <x-wireui.badge blue icon="pencil" label="Lápiz" />
            <x-wireui.badge.circle blue icon="pencil" />
        </div>
        <div class="mb-4 flex gap-5">
            <x-wireui.badge md blue icon="pencil" label="Lápiz" />
            <x-wireui.badge.circle md blue icon="pencil" />
        </div>
        <div class="mb-4 flex gap-5">
            <x-wireui.badge lg blue icon="pencil" label="Lápiz" />
            <x-wireui.badge.circle lg blue icon="pencil" />
        </div>
        
        {{-- AVATARES --}}
        {{-- Avatar: https://v1.wireui.dev/docs/avatar --}}
        <h5>Avatares</h5>
        <div class="mb-4 flex gap-5">
            <x-wireui.avatar src="https://petrix12.github.io/cvpetrix2022/img/autor.jpg" />
            <x-wireui.avatar label="PB" />
            <x-wireui.avatar squared src="https://petrix12.github.io/cvpetrix2022/img/autor.jpg" />
        </div>
        <div class="mb-4 flex gap-5">
            <x-wireui.avatar xs src="https://petrix12.github.io/cvpetrix2022/img/autor.jpg" />
            <x-wireui.avatar sm src="https://petrix12.github.io/cvpetrix2022/img/autor.jpg" />
            <x-wireui.avatar md src="https://petrix12.github.io/cvpetrix2022/img/autor.jpg" />
            <x-wireui.avatar lg src="https://petrix12.github.io/cvpetrix2022/img/autor.jpg" />
            <x-wireui.avatar xl src="https://petrix12.github.io/cvpetrix2022/img/autor.jpg" />

            <x-wireui.avatar size="h-16 w-16" src="https://petrix12.github.io/cvpetrix2022/img/autor.jpg" />
            <x-wireui.avatar size="h-20 w-20" src="https://petrix12.github.io/cvpetrix2022/img/autor.jpg" />
        </div>
    </x-wireui.card>
    @endsection
    ```

## Componentes Dropdown
1. Modificar vista **resources\views\wireui\dropdown.blade.php**:
    ```php
    @extends('layouts/layoutMaster')

    @section('title', 'Dropdown')

    @section('page-style')
    <!-- Enlace al archivo CSS de Tailwind CDN -->
    <link href="{{ asset('assets\css\tailwind.min.css') }}" rel="stylesheet">
    @endsection

    @section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Pruebas </span>Dropdown
    </h4>

    <x-wireui.card title="Pruebas Dropdown">
        <div class="mb-4 flex gap-5">
            <x-wireui.dropdown align="left">
                <x-wireui.dropdown.item label="Formularios" href="{{ route('forms') }}" />
                <x-wireui.dropdown.item href="{{ route('tables') }}">
                    Tablas
                </x-wireui.dropdown.item>
            </x-wireui.dropdown>
        </div>

        <div class="mb-4 flex gap-5">
            <x-wireui.dropdown align="left">
                <x-wireui.dropdown.header label="Cabecera">
                    <x-wireui.dropdown.item label="Formularios" href="{{ route('forms') }}" />
                    <x-wireui.dropdown.item label="Tablas" href="{{ route('tables') }}" />
                    <x-wireui.dropdown.item separator label="Livewire" href="{{ route('livewire') }}" />
                </x-wireui.dropdown.header>
            </x-wireui.dropdown>
        </div>

        <div class="mb-4 flex gap-5">
            <x-wireui.dropdown align="left">
                <x-wireui.dropdown.header label="Cabecera">
                    <x-wireui.dropdown.item icon="home" label="Formularios" href="{{ route('forms') }}" />
                    <x-wireui.dropdown.item icon="pencil" label="Tablas" href="{{ route('tables') }}" />
                    <x-wireui.dropdown.item icon="user" separator label="Livewire" href="{{ route('livewire') }}" />
                </x-wireui.dropdown.header>
            </x-wireui.dropdown>
        </div>

        <div class="mb-4 flex gap-5">
            <x-slot>
                <x-wireui.button name="trigger">
                    Dropdown
                </x-wireui.button>
            </x-slot>
            <x-wireui.dropdown align="left">
                <x-wireui.dropdown.header label="Cabecera">
                    <x-wireui.dropdown.item icon="home" label="Formularios" href="{{ route('forms') }}" />
                    <x-wireui.dropdown.item icon="pencil" label="Tablas" href="{{ route('tables') }}" />
                    <x-wireui.dropdown.item icon="user" separator label="Livewire" href="{{ route('livewire') }}" />
                </x-wireui.dropdown.header>
            </x-wireui.dropdown>
        </div>
    </x-card>
    @endsection 
    ```

## Modal
1. Crear componente livewire **modal**:
    + $ php artisan make:livewire modal
2. Modificar vista **resources\views\wireui\modal.blade.php**:
    ```php
    @extends('layouts/layoutMaster')

    @section('title', 'Modal')

    @section('page-style')
    <!-- Enlace al archivo CSS de Tailwind CDN -->
    <link href="{{ asset('assets\css\tailwind.min.css') }}" rel="stylesheet">
    @endsection

    @section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Pruebas </span>Modales
    </h4>

    <x-wireui.card title="Pruebas Modales">
        <div class="mb-4 flex gap-5">
            @livewire('modal')
        </div>
    </x-wireui.card>
    @endsection 
    ```
3. Modificar componente controlador livewire **app\Http\Livewire\Modal.php**:
    ```php
    <?php

    namespace App\Http\Livewire;

    use Livewire\Component;

    class Modal extends Component
    {
        public $openModal = false;
        
        public function render()
        {
            return view('livewire.modal');
        }
    }
    ```
4. Modificar componente vista livewire **resources\views\livewire\modal.blade.php**:
    ```php
    <div>
        <x-wireui.button dark wire:click="$set('openModal', true)">
            Abrir modal
        </x-wireui.button>
        {{-- 
        <x-wireui.modal blur wire:model="openModal">
            <x-wireui.card title="Es es un modal">
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Numquam, eaque reprehenderit nemo 
                    illo magnam alias error! Laboriosam ex unde architecto, libero non impedit similique sunt 
                    repellendus eaque aliquid! Iure, nam?
                </p>

                <x-slot
                    name="footer"
                >
                    <x-wireui.button wire:click="$set('openModal', true)">
                        Cerrar modal
                    </x-wireui.button>
                </x-slot>
            </x-wireui.card>
        </x-wireui.modal> 
        --}}
        <x-wireui.modal.card title="Es otro modal" blur wire:model="openModal">
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Numquam, eaque reprehenderit nemo 
                illo magnam alias error! Laboriosam ex unde architecto, libero non impedit similique sunt 
                repellendus eaque aliquid! Iure, nam?
            </p>

            <x-slot
                name="footer"
            >
                <x-wireui.button wire:click="$set('openModal', true)">
                    Cerrar modal
                </x-wireui.button>
            </x-slot>
        </x-wireui.modal.card>
    </div>
    ```


## Páginas de interes
+ Iconos: https://v1.heroicons.com
+ Badges: https://v1.wireui.dev/docs/badges
+ Avatar: https://v1.wireui.dev/docs/avatar
+ Botones: https://v1.wireui.dev/docs/buttons
+ Tablas: 
    + https://github.com/Power-Components/livewire-powergrid
    + https://livewire-powergrid.com/get-started/install.html
    + https://livewire-powergrid.com/get-started/create-powergrid-table.html
+ Mascaras: https://v1.wireui.dev/docs/maskable-inputs

