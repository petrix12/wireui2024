# LARAVEL 10

## Pre-requisitos obligatorios:
+ [XAMPP](https://www.apachefriends.org/es/index.html) o [Laragon](https://laragon.org/index.html).
+ [Composer](https://getcomposer.org/).
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

## Documentación:
+ [Página oficial de Laravel](https://laravel.com).

## Instalación Laravel
+ Instalar el instalador de Laravel:
    + $ composer global require laravel/installer
+ Instalación de un proyecto Laravel:
    + Vía composer (no requiere del instalador de Laravel):
        + $ composer create-project laravel/laravel mi_proyecto_laravel
    + Vía instalador de Laravel:
        + $ laravel new mi_proyecto_laravel

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

## Controlador
+ Crear controlador:
    + $ php artisan make:controller NombreController

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
+ Para crear solamente un modelo:
    + $ php artisan make:model Modelo
+ Indicar a un modelo la tabla a administrar:
    ```php
    // ...
    class Modelo extends Model {
        // ...
        protected $table = "modelos";
    }
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

    class DatabaseSeeder extends Seeder
    {
        // ...
        public function run(): void
        {
            // ...
            $this->call(ModeloSeeder::class);
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
        // ...
        class ModeloFactory extends Factory
        {
            // ...
            public function definition(): array
            {
                return [
                    'propiedad1' => $this->faker->sentence(),   // Oración
                    'propiedad2' => $this->faker->paragraph(),  // Párrafo                    
                    'propiedad3' => $this->faker->randomElement(['Valor 1', 'Valor 2', 'Valor 3'])   // Escoger entre varios elementos
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
