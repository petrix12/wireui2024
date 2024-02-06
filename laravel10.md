# LARAVEL 10

## Pre-requisitos obligatorios:
+ [XAMPP](https://www.apachefriends.org/es/index.html) o [Laragon](https://laragon.org/index.html).
+ [Composer](https://getcomposer.org).
+ [NodeJS](https://nodejs.org).

## Pre-requisitos recomendados:
+ [GIT](https://git-scm.com).
+ [Visual Studio Code](https://code.visualstudio.com).

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

## Extensiones de Google recomendadas:
+ JSON Formatter

## Documentación:
+ [Página oficial de Laravel](https://laravel.com).
+ [Laravel Lang](https://laravel-lang.com/installation.html).

## Instalación Laravel
+ Instalar el instalador de Laravel:
    + $ composer global require laravel/installer
+ Instalación de un proyecto Laravel:
    + Vía composer (no requiere del instalador de Laravel):
        + $ composer create-project laravel/laravel mi_proyecto_laravel
    + Vía instalador de Laravel:
        + $ laravel new mi_proyecto_laravel
+ Crear un proyecto con Jetstream desde el instalador de Laravel:
    + $ laravel new mi_proyecto_laravel --jet


## Rutas
+ Estructura de una ruta:
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
+ Asignar nombre identificativo a una ruta:
    ```php
    Route::get('ruta', [NombreController::class, 'nombre_metodo'])->name('mi_ruta.ruta');
    ```
    + **Nota 1:** ejemplo para invocar ruta desde una vista:
        ```php
        <!-- ... -->
        <a href="{{ route('mi_ruta.ruta') }}">Mi ruta</a>
        <!-- ... -->
        ```
    + **Nota 1:** ejemplo para invocar ruta con parámetro desde una vista:
        ```php
        <!-- ... -->
        <a href="{{ route('mi_ruta.ruta', 'parametro') }}">Mi ruta</a>
        <!-- ... -->
        ```
+ Ejemplo de modelo de rutas para un CRUD:
    ```php
    Route::get('modelos', [ModeloController::class, 'index'])->name('modelos.index');
    Route::get('modelos/create', [ModeloController::class, 'create'])->name('modelos.create');
    Route::post('modelos', [ModeloController::class, 'store'])->name('modelos.store');
    Route::get('modelos/{modelo}', [ModeloController::class, 'show'])->name('modelos.show');
    Route::get('modelos/{modelo}/edit', [ModeloController::class, 'edit'])->name('modelos.edit');
    Route::put('modelos/{modelo}', [ModeloController::class, 'update'])->name('modelos.update');
    Route::delete('modelos/{modelo}', [ModeloController::class, 'destroy'])->name('modelos.destroy');
    ```
+ Ejemplo de modelo de rutas para un CRUD con resource:
    ```php
    Route::resource('modelos', ModeloController::class);
    ```
+ Ejemplo de ruta cuando queremos mostrar contenido estático:
    ```php
    Route::view('mirutaestatica', 'vista');
    ```

+ Ver todas las rutas:
    + $ php artisan r:l

## Controladores
+ Crear controlador:
    + $ php artisan make:controller NombreController
+ Ejemplo de un controlador para un CRUD
    + app\Http\Controllers\ModeloController.php
        ```php
        // ...
        use App\Models\Modelo;
        // ...
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
                return view('crud.modelos.edit', compact('modelo'));
            }

            public function update(Request $request, Modelo $modelo) {
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
                $modelo->delete();
                return redirect()->route('modelos.index');
            }
        }        
        ```
+ Emitir una variable de sesión (forma 1):
    ```php
    // ...
    public function destroy(Modelo $modelo) {
        $modelo->delete();
        session()->flash('info', 'El modelo ha sido eliminado');
        return redirect()->route('modelos.index');
    }
    // ...
    ```
+ Emitir una variable de sesión (forma 2):
    ```php
    // ...
    public function destroy(Modelo $modelo) {
        $modelo->delete();
        return redirect()->route('modelos.index')->with('info', 'El modelo ha sido eliminado');
    }
    // ...
    ```


## Vistas
+ Ejemplos de vistas para un CRUD:
    + resources/views/crud/modelos/index.blade.php
        ```php
        @extends('layouts.mi_plantilla')

        @section('title', 'Lista modelos')

        @section('content')
            <h1>Lista modelos</h1>
            <ul>
                @foreach($modelos as $modelo)
                    <li>Propiedad 1: {{ $modelo->propiedad1 }}</li>
                @endforeach
            </ul>
            <!-- Si el controlador envía los registros paginados -->
            {{ $modelos->link() }}
        @endsection
        ```
    + resources\views\crud\modelos\create.blade.php
        ```php
        @extends('layouts.mi_plantilla')

        @section('title', 'Crear modelo')

        @section('content')
            <h1>Crear modelo</h1>
            <form action="{{ route('modelos.store') }}" method="POST">
                @csrf
                <label>Propiedad 1</label>
                <input type="text" name="propiedad1" value="{{ old('propiedad1') }}" />
                @error('propiedad1')
                    {{ $message }}
                @enderror
                <button type="submit">Crear</button>
            </form>
        @endsection
        ```
    + resources\views\crud\modelos\show.blade.php
        ```php
        @extends('layouts.mi_plantilla')

        @section('title', 'Mostrar modelo')

        @section('content')
            <h1>Mostrar modelo</h1>
            <label>Propiedad 1: {{ $modelo->propiedad1 }}</label>
            <a href="{{ route('modelos.index') }}">Lista de modelos</a>
            <a href="{{ route('modelos.edit', $modelo) }}">Editar modelo</a>
            <form action="{{ route('modelos.destroy', $modelo) }}" method="POST">
                @csrf
                @method('delete')
                <button type="submit">Eliminar modelo</button>
            </form>
        @endsection        
        ```
    + resources\views\crud\modelos\edit.blade.php
        ```php
        @extends('layouts.mi_plantilla')

        @section('title', 'Editar modelo')

        @section('content')
            <h1>Editar modelo</h1>
            <form action="{{ route('modelos.update', $modelo) }}" method="POST">
                @csrf
                @method('put')
                <label>Propiedad 1</label>
                <input type="text" name="propiedad1" value="{{ old('propiedad1', $modelo->propiedad1) }}" />
                @error('propiedad1')
                    {{ $message }}
                @enderror
                <button type="submit">Actualizar</button>
            </form>
        @endsection
        ```
+ Resivir una variable de sesión:
    + resources/views/crud/modelos/index.blade.php
        ```php
        @extends('layouts.mi_plantilla')

        @section('title', 'Lista modelos')

        @section('content')
            <h1>Lista modelos</h1>
            @if(session('info'))
                <script>
                    alert("{{ session('info') }}");
                </script>
            @endif
            <ul>
                @foreach($modelos as $modelo)
                    <li>Propiedad 1: {{ $modelo->propiedad1 }}</li>
                @endforeach
            </ul>
            <!-- Si el controlador envía los registros paginados -->
            {{ $modelos->link() }}
        @endsection
        ```


## Blade
+ Construcción de plantillas Blade
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
+ Invocar vista desde un controllador:
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
+ Ejemplo de directiva **foreach**:
    ```php
    <!-- ... -->
    <ul>
        @foreach($modelos as $modelo)
            <li>Propiedad 1: {{ $modelo->propiedad1 }}</li>
        @endforeach
    </ul>
    <!-- Si el controlador envía los registros paginados -->
    {{ $modelos->link() }}
    <!-- ... -->
    ```
+ Directivas:
    + if:
        ```php
        @if($condicion)
            <!-- Se muestra solo si $condicion = true -->
        @else
            <!-- Se muestra solo si $condicion = false -->
        @endif
        ```
    + auth:
        ```php
        @auth
            <!-- Se muestra solo si existe un usuario autenticado -->
        @else
            <!-- Se muestra solo si no existe un usuario autenticado -->
        @endauth
        ```
    + foreach:
        ```php
        @foreach ($elementos as $elemento)
            {{ $elemento }}
        @endforeach
        ```
        + **Nota:** al usar un foreach se crean algunas variables de interes:
            + $loop->first (Primero elemento)
            + $loop->index (Elemento actual, el primero tendrá el valor de cero)

## Migraciones
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
                $table->text('descripcion');
                $table->longText('descripcion_muy_larga');
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->enum('status', [1, 2])->default(1);
                $table->rememberToken();                                // Crea la columna remember_token
                $table->foreignId('current_team_id')->nullable();
                $table->string('profile_photo_path', 2048)->nullable();

                // Restricciones de llave foranea con set null
                $table->unsignedBigInteger('modelo_id')->nullable();
                $table->foreign('modelo_id')
                    ->rerferences('id')->on('modelos')
                    ->onDelete('set null');

                // Restricciones de llave foranea con cascade
                $table->unsignedBigInteger('otro_modelo_id');
                $table->foreign('otro_modelo_id')
                    ->rerferences('id')->on('otro_modelos')
                    ->onDelete('cascade');

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
+ Crear migración siguiendo las convenciones de Laravel para una tabla auxiliar:
    + $ php artisan make:migration create_nombretabla1_nombretabla2_table   (escribir en orden alfabético)
+ Revertir cambios de la última migración:
    + $ php artisan migrate:rollback
+ Revertir todos los cambios y volver a ejecutar las migraciones (elimina la tabla sin ejecutar el método **down**):
    + $ php artisan migrate:fresh
+ Revertir todos los cambios y volver a ejecutar las migraciones (ejecuta el método **down**):
    + $ php artisan migrate:refresh
+ Eliminar todas las tablas de la base de datos:
    + $ php artisan migrate:reset
+ Agregar una columna a una migración:
    + $ php artisan make:migration add_micolumna_to_mitabla_table
    + Luego modificar la migración para definir la nueva columna:
        ```php
        // ...
        public function up() {
            Schema::table('mitabla', function(Blueprint $table) {
                $table->string('micolumna')->nullable()->after('otracolumna');
            });
        }
        // ...
        public function down() {
            Schema::table('mitabla', function(Blueprint $table) {
                $table->dropColumn('micolumna');
            });
        }
        ```
+ Modificar un campo de una migración:
    + Instalar dependencia:
        + $ composer require doctrine/dbal
    + Crear migración:
        + $ php artisan make:migration cambiar_propiedades_to_mitabla_table
    + Luego modificar la migración para definir la nueva columna:
        ```php
        // ...
        public function up() {
            Schema::table('mitabla', function(Blueprint $table) {
                $table->string('micolumna', 50)->nullable()->change();
            });
        }
        // ...
        public function down() {
            Schema::table('mitabla', function(Blueprint $table) {
                $table->string('micolumna', 255)->nullable(false)->change();
            });
        }
        ```

## Modelos:
+ Crear un modelo:
    + $ php artisan make:model Modelo
    + $ php artisan make:model Modelo -m        (con migración)
    + $ php artisan make:model Modelo -mc       (con migración y controlador)
    + $ php artisan make:model Modelo -mcs      (con migración, controlador y seeder)
    + $ php artisan make:model Modelo -mcsf     (con migración, controlador, seeder y factory)
    + $ php artisan make:model Modelo -a        (con migración, controlador, seeder y factory)
+ Indicar a un modelo la tabla a administrar:
    ```php
    // ...
    class Modelo extends Model {
        // ...
        protected $table = "modelos";
    }
    ```
+ Definir asignación masiva (indicando los campos a considerar):
    ```php
    // ...
    class Modelo extends Model {
        // ...
        protected $fillable = [
            'propiedad1'
        ];
    }
    ```
+ Definir asignación masiva (indicando los campos a no considerar):
    ```php
    // ...
    class Modelo extends Model {
        // ...
        protected $guarded = [
            'propiedad1'
        ];
    }
    ```
+ Definir asignación masiva (indicando todos los campos):
    ```php
    // ...
    class Modelo extends Model {
        // ...
        protected $guarded = [];
    }
    ```
+ Establecer ralación 1:1 de **Modelo** a **OtroModelo**:
    ```php
    // ...
    class Modelo extends Model {
        // ...
        // Forma manual
        public function otro_modelo() {
            $otro_modelo = OtroModelo::where('modelo_id', $this->id)->first();
            return $otro_modelo;
        }

        // Forma simplificada, es funcionalmente igual a la anterior
        // Este método considera que la llave primaria del Modelo modelo es 'id', 
        // y la llave foránea de OtroModelo es modelo_id
        public function otro_modelo_forma2() {
            return $this->hasOne('App\Models\OtroModelo');
        }

        // Forma simplificada, sin seguir las convenciones de laravel
        // Este método considera que la llave primaria del Modelo modelo no sigue las convenciones
        // y la llave foránea de OtroModelo tampoco sigue las convenciones
        public function otro_modelo_forma3() {
            return $this->hasOne('App\Models\OtroModelo', 'modelo_id', 'id');
        }
    }
    ```
+ Establecer ralación 1:1 inversa de **OtroModelo** a **Modelo**:
    ```php
    // ...
    class OtroModelo extends Model {
        // ...
        // Forma manual
        public function modelo() {
            $modelo = Modelo::find($this->modelo_id);
            return $modelo;
        }

        // Forma simplificada, es funcionalmente igual a la anterior
        public function modelo2() {
            return $this->belongsTo('App\Models\Modelo');
        }
    }
    ```
+ Establecer ralación 1:n de **OtroModelo** a **Modelo**:
    ```php
    // ...
    class Modelo extends Model {
        // ...
        // Forma simplificada
        public function otro_modelos() {
            return $this->hasMany('App\Models\OtroModelo');
        }
    }
    ```
+ Establecer ralación 1:n inversa de **OtroModelo** a **Modelo**:
    ```php
    // ...
    class OtroModelo extends Model {
        // ...
        // Forma simplificada
        public function modelo() {
            return $this->belongsTo('App\Models\Modelo');
        }
    }
    ```
+ Establecer ralación n:n de **OtroModelo** a **Modelo**:
    ```php
    // ...
    class Modelo extends Model {
        // ...
        // Forma simplificada
        public function otro_modelos() {
            return $this->belongsToMany('App\Models\OtroModelo');
        }

        // Ejemplo de código para asignar un valor
        // $modelo = Modelo::find($modelo_id);
        // $modelo->otro_modelos()->attach($otro_modelo_id);

        // Ejemplo de código para quitar un valor
        // $modelo = Modelo::find($modelo_id);
        // $modelo->otro_modelos()->detach($otro_modelo_id);

        // Ejemplo de código para asignar varios valores
        // $modelo = Modelo::find($modelo_id);
        // $modelo->otro_modelos()->attach([$otro_modelo1_id, $otro_modelo2_id]);

        // Ejemplo de código para quitar varios valores
        // $modelo = Modelo::find($modelo_id);
        // $modelo->otro_modelos()->detach([$otro_modelo1_id, $otro_modelo2_id]);

        // Ejemplo de código para quitar todos los valores y luego asignar varios valores
        // $modelo = Modelo::find($modelo_id);
        // $modelo->otro_modelos()->sync([$otro_modelo1_id, $otro_modelo2_id]);
    }
    ```
+ Relaciones polimórficas:
    + Cuando establezca las relaciones polimórficas del medelo **Tabla** tener en cuenta:
      + En el modelo **Tabla**:
          ```php
          public function tablanable() {
              return $this->morphTo();
          }
          ```
    + En el modelo **Modelo**:
        ```php
        // Relación uno a uno polimórfica
        public function tabla() {
            return $this->morphOne('App\Models\Tabla', 'tablaable');
        }

        // Relación uno a muchos polimórfica
        // El 2do parámetro es el nombre del método definido en el modelo Tabla
        public function tablas() {
            return $this->morphMany('App\Models\Tabla', 'tablaable');   
        }

        // Relación muchos a muchos polimórfica
        // El 2do parámetro es el nombre de la tabla intermedia en singular
        public function tablas2() {
            return $this->morphToMany('App\Models\Tabla', 'tablaable');
        }

        // Relación muchos a muchos inversa polimórficas
        // El 2do parámetro es el nombre de la tabla intermedia en singular
        public function tablas3() {
            return $this->morphedByMany('App\Models\Tabla', 'tablaable');
        }
        ```
    + La tabla **tablas** deberá tener campos similares a:
        + campo1
        + campo2
        + tablaable_id
        + tablaable_type
        + **Nota 1:** La clave primaria será una clave compuesta por los campos **tablaable_id** y **tablaable_type**.
        + **Nota 2:** 
            + Ejemplo del archivo de migración para relaciones polimórficas uno a uno:
                ```php
                // ...
                public function up(): void
                {
                    Schema::create('tablas', function (Blueprint $table) {
                        $table->string('campo1');
                        $table->string('campo2');
                        $table->unsignedBigInteger('tablaable_id');
                        $table->string('tablaable_type');
                        // Definición de la llave primaria compuesta
                        $table->primary(['tablaable_id', 'tablaable_type']);
                        $table->timestamps();
                    });
                }
                // ...
                ```
            + Ejemplo del archivo de migración para relaciones polimórficas uno a muchos:
                ```php
                // ...
                public function up(): void
                {
                    Schema::create('tablas', function (Blueprint $table) {
                        $table->id();
                        $table->string('campo1');
                        $table->string('campo2');
                        $table->unsignedBigInteger('tablaable_id');
                        $table->string('tablaable_type');
                        $table->timestamps();
                    });
                }
                // ...
                ```
            + Ejemplo del archivo de migración para relaciones polimórficas uno a muchos:
                ```php
                // ...
                public function up(): void
                {
                    Schema::create('tablas', function (Blueprint $table) {
                        $table->id();
                        $table->string('campo1');
                        $table->string('campo2');
                        $table->timestamps();
                    });
                }
                // ...
                ```
                + En este caso hay que generar una tabla intermedia:
                    + $ php artisan make:migration create_tablaables_table
                    + Ejemplo de construcción de la migración:
                        ```php
                        // ...
                        public function up(): void
                        {
                            Schema::create('tablaables', function (Blueprint $table) {
                                $table->id();
                                $table->unsignedBigInteger('tablaable_id');
                                $table->string('tablaable_type');
                                $table->unsignedBigInteger('tabla_id');
                                $table->foreign('tabla_id')->references('id')->on('tablas')->onDelete('cascade');
                                $table->timestamps();
                            });
                        }
                        // ...
                        ```
        + **Nota 3:** Creación de registros:
            + Desde el modelo **Tabla**:
                ```php
                Tabla::create([
                    'campo1' => 'Valor campo 1',
                    'campo2' => 'Valor campo 2',
                    'tablaable_id' => $modelo_id,
                    'tablaable_type' => 'App\Models\Modelo'
                ]);
                ```
            + Desde el modelo **Modelo**:
                ```php
                $modelo->tabla()->create([
                    'campo1' => 'Valor campo 1',
                    'campo2' => 'Valor campo 2'
                ]);
                ```



## Tinker
+ Ejecutar Tinker:
    + $ php artisan tinker
+ Salir de Tinker:
    + >>> exit
+ Usar un modelo:
    + >>> use App\Models\Modelo
+ Crear una instancia de un modelo:
    + >>> $modelo = new Modelo;
+ Asignar un valor a una propiedad de un modelo:
    + >>> $modelo->propiedad = 'Valor';
+ Ver el contendido de un modelo:
    + >>> $modelo;
+ Agregar instancia del modelo como un registro en tabla:
    + >>> $modelo->save();
+ Modificar un registro
    + >>> $modelo->propiedad = 'otro valor';
    + >>> $modelo->save();
+ Recuperar todos los registros de una tabla:
    + >>> $modelos = Modelo::all();
+ Recuperar todos los registros de una tabla aplicando un filtro:
    + >>> $modelos = Modelo::where('propiedad1', 'valor1')->get();
+ Recuperar todos los registros de una tabla aplicando un filtro y un orden:
    + >>> $modelos = Modelo::where('propiedad1', 'valor1')->orderBy('propiedad2', 'desc')->get();
    + **Nota:** por defecto **orderBy** ordena de manera ascendente: **asc**.
+ Recuperar el primer registro:
    + >>> $modelos = Modelo::where('propiedad1', 'valor1')->orderBy('propiedad2', 'desc')->first();
+ Recuperar solo los campos **propiedad1** y **propiedad2**:
    + >>> $modelos = Modelo::select('propiedad1', 'propiedad2')->get();
    + >>> $modelos = Modelo::select('propiedad1', 'propiedad2')->orderBy('propiedad2')->where('propiedad1', 'valor1')->get();
+ Recuperar solo los campos **propiedad1** y **propiedad2** usando alias:
    + >>> $modelos = Modelo::select('propiedad1 as p1', 'propiedad2 as p2')->get();
+ Recuperar solo 5 registros:
    + >>> $modelos = Modelo::select('propiedad1 as p1', 'propiedad2 as p2')->take(5)->get();
+ Recuperar un registro con **id** = 3:
    + >>> $modelos = Modelo::find(3);
+ Recuperar todos los registros con **id** > 3:
    + >>> $modelos = Modelo::where('id', '>', 3)->get();
    + **Nota:** operadores de comparación que se pueden usar:
        + Igual: =
        + Mayor: >
        + Mayor o igual: >=
        + Menor: <
        + Menor o igual: <=
        + Diferente: <>
        + Que contenga: LIKE
+ Recuperar todos los registros que contenga el texto **texto** en cualquier parte del campo:
    + >>> $modelos = Modelo::where('propiedad3', 'LIKE', '%texto%')->get();

## Eloquent:
+ Pasar todos los registros:
    ```php
    // ...
    class NombreController extends Controller
    {
        // ...
        public function mi_vista() {
            $modelos = Modelo::all();
            return view('mi_vista', compact('modelos'));
        }
        // ...
    }
    ```
+ Pasar registros paginados:
    ```php
    // ...
    class NombreController extends Controller
    {
        // ...
        public function mi_vista() {
            $modelos = Modelo::paginate();  // Por defecto envía 15 registros
            return view('mi_vista', compact('modelos'));
        }
        // ...
    }
    ```
    + **Nota 1:** para navegar entre lotes de registros en la dirección del navegador podemos escribir algo así:
        + http://miaplicacion.test/modelos?page=[numero]

## Seeder
+ Programar seeder en **database\seeders\DatabaseSeeder.php**:
    ```php
    // ...
    use App\Models\Modelo;
    use Illuminate\Database\Seeder;

    class DatabaseSeeder extends Seeder
    {
        // ...
        public function run(): void
        {
            // ...
            $modelo = new Modelo();
            $modelo->propiedad = "Valor de mi propiedad";
            $modelo->save();
        }
    }    
    ```
+ Ejecutar seeder:
    + $ php artisan db:seed
+ Crear, programar y cargar un seeder:
    + $ php artisan make:seeder ModeloSeeder
    + Programar seeder en **database\seeders\ModeloSeeder.php**:
        ```php
        // ...
        use App\Models\Modelo;
        use Illuminate\Database\Seeder;

        class DatabaseSeeder extends Seeder
        {
            // ...
            public function run(): void
            {
                $modelo = new Modelo();
                $modelo->propiedad = "Valor de mi propiedad";
                $modelo->save();
            }
        }    
        ```
    + Cargar el en **database\seeders\DatabaseSeeder.php**:
    ```php
    // ...
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\Storage;
    use App\Models\Modelo;
    use App\Models\Post;

    class DatabaseSeeder extends Seeder
    {
        // ...
        public function run(): void
        {
            // ...
            $this->call(ModeloSeeder::class);

            // Llamar a un factory desde el modelo
            Modelo::factory(8)->create();

            // Ejemplo para tratar imagenes
            Storage::deleteDirectory('posts');
            Storage::makeDirectory('posts');
            $posts = Post::factory(100)->create();
            foreach($post as $post) {
                Image::factory(1)->create([
                    'imageable_id' => $post->id,
                    'imageable_type' => Post::class
                ]);
            }
        }
    }    
    ```
+ Reestablecer tablas de la base de datos y ejecutar los seeders:
    + $ php artisan migrate:fresh --seed
+ Migrar y ejecutar los seeders:
    + $ php artisan migrate --seed

## Factory
+ Crear un factory:
    + $ php artisan make:factory ModeloFactory
    + **Nota**: cuando se crea de este modo, es necesario adaptar el código al modelo a emplear.
+ Crear y programar un factory inicando el modelo a usar:
    + $ php artisan make:factory ModeloFactory --model=Modelo
    + Programa factory ****:
        ```php
        // ...
        use App\Models\Modelo;
        use App\Models\OtroModelo;
        use Illuminate\Support\Str;
        // ...
        class ModeloFactory extends Factory
        {
            // ...
            public function definition(): array
            {
                $propiedad4 = $this->faker->unique->word(20),   // Una palabra de máximo 20 caracteres que no se repite
                return [
                    'propiedad1' => $this->faker->sentence(),   // Oración
                    'propiedad2' => $this->faker->paragraph(),  // Párrafo                    
                    'propiedad3' => $this->faker->randomElement(['Valor 1', 'Valor 2', 'Valor 3']),   // Escoger entre varios elementos
                    'propiedad4' => $propiedad4,
                    'propiedad5' => Str::slug($propiedad4),
                    'propiedad6' => $this->faker->text(300),   // Texto de 300 caracteres
                    'propiedad7' => OtroModelo::all()->random()->id,   // Escoger al azar un id del modelo OtroModelo
                    // Parámetros: ruta, ancho, alto, catergoria (ya no funciona, ruta_completa)
                    // Si ruta_completa es:
                    // true: //public/storage/img/imagen.jpg
                    // false: /imagen.jpg
                    'propiedad8' => $this->faker->image('public/storage/img', 640, 480, null, true)


                ];
            }
        }        
        ```
+ Usar un factory en un seeder:
    + Programar seeder **database\seeders\ModeloSeeder.php**:
        ```php
        // ...
        use App\Models\Modelo;
        use Illuminate\Database\Seeder;

        class DatabaseSeeder extends Seeder
        {
            // ...
            public function run(): void
            {
                // Crea 50 registros del modelo Modelo tal como están definidos en el factory
                Modelo::factory(50)->create();
            }
        }    
        ```
        + **Nota**: para este tipo de seeder, se puede prescindir de este y ejecutar **Modelo::factory(50)->create();** directamente en **database\seeders\DatabaseSeeder.php**:
            ```php
            // ...
            use App\Models\Modelo;
            use Illuminate\Database\Seeder;

            class DatabaseSeeder extends Seeder
            {
                // ...
                public function run(): void
                {
                    // ...
                    Modelo::factory(50)->create();
                }
            }    
            ```

## Mutadores y accesores:
1. Agregar un mutador y un accesor a el modelo **Modelo**:
    + Modificar el modelo **app\Models\Modelo.php**:
        ```php
        // ...
        use Illuminate\Database\Eloquent\Casts\Attribute;

        class Modelo extends Model
        {
            // ...
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
        ```

## Form Request:
+ Crear un Form Request:
    + $ php artisan make:request StoreModelo
    + **Nota:** se genera el archivo **app\Http\Requests\StoreModelo.php**.
    + Ejemplo de programación del Form Request **app\Http\Requests\StoreModelo.php**:
        ```php
        // ...
        class StoreModelo extends FormRequest
        {
            // ...
            public function authorize(): bool
            {
                return true;
            }

            // ...
            public function rules(): array
            {
                return [
                    'propiedad1' => 'required|min:12'
                ];
            }

            // Método para personalizar los mensaje de error
            public function messages(): array
            {
                return [
                    'propiedad1.required' => 'La propiedad 1 es obligatoria'
                ];
            }

            // Método para personalizar los atributos
            public function attributes(): array
            {
                return [
                    'propiedad1' => 'Cambio de nombre'
                ];
            }
        }        
        ```
    + Ejemplo de uso en el controlador que lo invoca **app\Http\Controllers\ModeloController.php**:
        ```php
        // ...
        public function store(StoreModelo $request) {

            $modelo = new Modelo();
            $modelo->propiedad1 = $request->propiedad1;
            $modelo->save();
            return redirect()->route('modelos.show', $modelo);
        }
        // ...   
        ```

## Configuración
+ Configurar proyecto al español:
    + Editar **config\app.php**:
        ```php
        // ...
        return [
            // ...
            'locale' => 'es',
            // ...
        ];        
        ```

## Mailables
+ Indicar credenciales del servicio de correos a utilizar en **.env**:
    + Ejemplo:
        ```env
        MAIL_MAILER=smtp
        MAIL_HOST=mailpit
        MAIL_PORT=1025
        MAIL_USERNAME=null
        MAIL_PASSWORD=null
        MAIL_ENCRYPTION=null
        MAIL_FROM_ADDRESS="hello@example.com"
        MAIL_FROM_NAME="${APP_NAME}"        
        ```
+ Crear un mailable:
    + $ php artisan make:mail CorreoMailable
    + **Nota:** esta acción crea el siguiente archivo: **app\Mail\CorreoMailable.php**,.
+ Crear vista del correo **resources\views\emails\correo.blade.php**:
    ```php
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Correo</title>
    </head>
    <body>
        <h1>Correo</h1>
        <p>{{ $data['message'] }}</p>
    </body>
    </html>
    ```
    + **Nota:** si para el correo se usan estilos bootstrap, tailwind, etc, será necesario escribir los estilos en el mismo correo.
+ Modificar **app\Mail\CorreoMailable.php**:
    ```php
    // ...
    use Illuminate\Mail\Mailables\Address;

    class CorreoMailable extends Mailable
    {
        // ...
        public $data;

        // ...
        public function __construct($data)
        {
            $this->data = $data;
        }
        // ...
        public function envelope(): Envelope
        {
            return new Envelope(
                from: new Address($this->data['from_email'], $this->data['from_name']),
                subject: $this->data['asunto']
            );
        }
        // ...
        public function content(): Content
        {
            return new Content(
                view: 'emails.correo'
            );
        }
        // ...
    }
    ```
+ Ejemplo de invocación del correo:
    ```php
    // ...
    use App\Mail\CorreoMailable;
    use Illuminate\Support\Facades\Mail;
    // ...
    $data = [
        'from_email' => 'mi.correo1@correo.com', 
        'from_name' => 'Mi nombre', 
        'asunto' => 'asunto', 
        'message' => 'mensaje...'
    ]

    Mail::to('mi.correo1@correo.com')->send(new CorreoMailable($data));

    // Otra forma:
    $correo = new \App\Mail\CorreoMailable($data);
    \Illuminate\Support\Facades\Mail::to('mi.correo1@correo.com')->bcc('mi.correo2@correo.com')->send($correo);
    ```

## Componentes
+ Crear un componente blade anónimo:
    + Crear archivo **resources\views\components\componente.blade.php**:
        ```php
        @props(['title', 'clase' => 'clase2', 'variable2'])

        @php
            switch($clase) {
                case 'clase1':
                    $clases = "bg-blue-100";
                    break;
                case 'clase2':
                    $clases = "bg-red-100";
                    break;
                default:
                    $clases = "bg-black-100";
                    break;
            }
        @endphp

        <div {{ $attributes->merge(['class' => 'm-5' ]) }}>
            <h1 class="fs-2 {{ $clases }}">{{ $title }}</h1>
            <p>{{ $otravariable }}</p>
            <p>{{ $variable2 }}</p>
            <p>
                {{ $slot }} {{-- Aquí enviaremos por parámetro el contenido principal de mi componente --}}
            </p>
            {{-- En la variable attributes se almacenan todas las variables que no se rescatan en los props o en los slut --}}
            <p>{{ $attributes }}</p>
        </div>    
        ```
        + **Nota:** para ver el componente, en la vista que lo invoca, escribir:
            ```php
            @php
                $variable = 'Valor de la variable';
            @endphp

            <x-componente title="Título del componente" clase="clase1" :variable2="$variable" id="mi_id">
                <x-slot name="otravariable">
                    Contenido de mi otra variable
                </x-slot>
                Contenido principal del componente
            </x-componente>
            ```
+ Crear un componente blade de clase:
    + Ejecutar:
        + $ php artisan make:component ComponenteClase
        + **Nota:** crea dos archivos:
            + Lógica: app\View\Components\ComponenteClase.php
            + Vista: resources\views\components\componente-clase.blade.php
    + Diseñar vista del componente:
        ```php
        <div {{ $attributes->merge(['class' => 'm-5' ]) }}>
            <h1 class="fs-2 {{ $clases }}">{{ $title }}</h1>
            <p>{{ $otravariable }}</p>
            <p>{{ $variable2 }}</p>
            <p>
                {{ $slot }} {{-- Aquí enviaremos por parámetro el contenido principal de mi componente --}}
            </p>
            {{-- En la variable attributes se almacenan todas las variables que no se rescatan en los props o en los slut --}}
            <p>{{ $attributes }}</p>
        </div>        
        ```
    + Programar lógica del componente:
        ```php
        // ...
        class ComponenteClase extends Component
        {
            public $title;
            public $clases;
            public $variable2;
            // ...
            public function __construct($title, $clase = 'clase1', $variable2)
            {
                switch($clase) {
                    case 'clase1':
                        $clases = "bg-blue-100";
                        break;
                    case 'clase2':
                        $clases = "bg-red-100";
                        break;
                    default:
                        $clases = "bg-black-100";
                        break;
                }

                $this->title = $title;
                $this->clases = $clases;
                $this->variable2 = $variable2;
            }
            // ...
        }
        ```
    + Se invoca como el componente anónimo.


## Middlewares:
+ Ejemplo de creación de un middleware:
    + Crear middleware:
        + $ php artisan make:middleware MiddlewarePrueba
        + **Nota:** esta acción crea el middleware en **app\Http\Middleware\MiddlewarePrueba.php**.
    + Establecer lógica del middleware en **app\Http\Middleware\MiddlewarePrueba.php**:
        ```php
        ```
    + Registrar middleware en **app\Http\Kernel.php**:
        ```php
        // ...
        protected $middlewareAliases = [
            // ...
            'prueba' => \App\Http\Middleware\MiddlewarePrueba::class
        ];
        // ...        
        ```
    + Crear rutas en **wireui2024\routes\web.php** para probar middleware:
        ```php
        Route::get('prueba', function() {
            return "Has accedido correctamente a esta ruta";
        })->middleware('prueba');

        Route::get('prueba2', function() {
            return "Has accedido correctamente a esta ruta";
        })->middleware(['prueba', 'auth:sanctum']);

        Route::get('noautorizado', function() {
            return "No estas autorizado para acceder a esta ruta";
        });
        ```

## Crear una vista markdown:
1. Instalar la dependencia:
    + $ composer require graham-campbell/markdown
2. Crear una vista para renderizar el archivo markdown **resources\views\markdown.blade.php**:
    ```php
    {{-- Puedes incluir estilos CSS específicos para Markdown si lo deseas --}}
    <style>
        /* Estilos CSS específicos para el contenido Markdown */
    </style>

    {{-- Mostrar el contenido HTML rendereado --}}
    {!! $htmlContent !!}    
    ```
3. Crear una vista markdown **public\markdown.md**.
4. Ejemplo del llamado de un archivo markdown en **routes\web.php**:
    ```php
    // ...
    use GrahamCampbell\Markdown\Facades\Markdown;
    use Illuminate\Support\Facades\File;
    // ...
    Route::get('markdown', function () {
        // Ruta al archivo Markdown
        $filePath = public_path('markdown.md');

        // Leer el contenido del archivo
        $markdownContent = File::get($filePath);    

        // Convertir Markdown a HTML usando la fachada Markdown
        $htmlContent = Markdown::convertToHtml($markdownContent);

        // Pasar el contenido HTML a la vista
        return view('markdown')->with('htmlContent', $htmlContent);
    });    
    ```

## Livewire:
+ Crear un componente Livewire:
    + $ php artisan make:livewire componente-livewire
    + Vista del compoente: resources\views\livewire\componente-livewire.blade.php
    + Controlador del componente: app\Livewire\ComponenteLivewire.php
    + Para llamar al componennte desde una vista:
        ```php
        @livewire('componente-livewire')
        ```
+ mm

## Publicar recursos de Laravel:
+ Publicar idiomas:
    + $ php artisan lang:publish
    + **Nota:** para traducir los mensajes al español, crear carpeta **es** y copiar traducidos al español los archivos contenidos en **en**.
+ Publicar vistas de componentes Jetstream:
    + 

## Tailwind
+ Documentación: https://tailwindcss.com/docs/installation
+ Incluir CDN de tailwind en la plantilla principal **resources\views\layouts\mi_plantilla.blade.php**:
    ```php
    <!-- ... -->
    <head>
        <!-- ... -->
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <!-- ... -->
    ```

## Algunos comandos artisan:
+ Levantar un servidor web local:
    + $ php artisan serve
+ Crear un enlace simbólico o acceso directo a el storage de la aplicación:
    + $ php artisan storage:link

## Algunas funciones php:
```php
// Encriptar contraseña:
$password = bcrypt($request->password);
// Transforma a título
$minuscula = ucwords('pEdRo');      // regresa: Pedro
// Transforma a mínusculas
$minuscula = strtolower('pEdRo');    // regresa: pedro
```

## Crear un virtual host:
+ Para el lado del cliente, modificar **C:\Windows\System32\drivers\etc\hosts**
    ```
    # Host virtual Mi proyecto - lado del cliente
    127.0.0.1	miproyecto.test
    ```
    + **Nota**: Editar con el block de notas en modo de administrador.
+ Para el lado del servidor, modificar **C:\xampp\apache\conf\extra\httpd-vhosts.conf**
    ```
    # Agregar esta línea una única vez
    <VirtualHost *>
        DocumentRoot "C:\xampp\htdocs"
        ServerName localhost
    </VirtualHost>

    # Host virtual Mi proyecto - lado del servidor
    <VirtualHost *>
        DocumentRoot "C:\xampp\htdocs\miproyecto\public"
        ServerName miproyecto.test
        <Directory "C:\xampp\htdocs\miproyecto\public">
            Options All
            AllowOverride All
            Require all granted
        </Directory>
    </VirtualHost>
    ```
    + **Nota**: En el archivo **C:\xampp\apache\conf\httpd.conf** las líneas:
    ```
    Include conf/extra/httpd-vhosts.conf
    ```
    y
    ```
    LoadModule rewrite_module modules/mod_rewrite.so
    ```
    no deben estar comentada con #.
+ Reiniciar el servidor Apache.
