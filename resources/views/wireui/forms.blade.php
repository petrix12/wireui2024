<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Formularios
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container">
                    <form action="{{ route('forms.store') }}" method="POST">
                        @csrf
            
                        {{-- VALIDACIÓN DE ERRORES --}}
                        <x-wireui.errors class="mb-4" title="Pruebas de validación (se encontrarón {errors} errores de validación)" />
                        <x-wireui.errors class="mb-4" only="nombre|url" />
            
                        <x-wireui.card title="Componentes de formularios">
                            <x-slot name="action">
                                <x-wireui.button icon="plus" primary>
                                    Agregar
                                </x-wireui.button>
                            </x-slot>
            
                            {{-- INPUTS --}}
                            <x-wireui.card title="Inputs">
                                <div class="mb-4">
                                    <x-wireui.input 
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
                                        style="padding-left: 4.3rem"
                                    />
                                </div>        
                                <div class="mb-4">
                                    <x-wireui.input 
                                        name="email" 
                                        label="Correo" 
                                        placeholder="Tu correo"
                                        suffix="@gmail.com"
                                        style="padding-right: 7rem; padding-left: 0.5rem"
                                    />
                                </div>
                                <div class="mb-4">
                                    <x-wireui.input 
                                        placeholder="Contraseña..." 
                                        class="pl-20"
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
                                        class="pl-5 pr-20"
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
                                        class="pl-5"
                                        label="Contraseña"
                                        placeholder="Contraseña..."
                                        name="password3"
                                    />
                                </div>
                                <div class="mb-4">
                                    <x-wireui.inputs.number
                                        class="pl-5"
                                        label="Número"
                                        placeholder="Número..."
                                        name="numero"
                                    />
                                </div>
                            </x-wireui.card>
            
                            {{-- TEXTAREA --}}
                            <div class="mb-4"></div>
                            <x-wireui.card title="Textarea">
                                <div class="mb-4">
                                    <x-wireui.textarea
                                        class="pl-5 pt-2"
                                        label="Textarea"
                                        placeholder="Textarea..."
                                        name="texto"
                                    />
                                </div>
                            </x-wireui.card>
            
                            {{-- SELECTS --}}
                            <div class="mb-4"></div>
                            <x-wireui.card title="Selects">
                                <div class="mb-4">
                                    <x-wireui.native-select
                                        class="pl-5"
                                        label="País"
                                        :options="['España', 'Venezuela', 'Austria', 'Colombia', 'Italia']"
                                        name="pais"
                                        placeholder="Seleccione un país"
                                    />
                                </div>
                                <div class="mb-4">
                                    <x-wireui.native-select
                                        class="pl-5"
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
                                        class="pl-5"
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
                            </x-wireui.card>
            
                            {{-- COLORS --}}
                            <div class="mb-4"></div>
                            <x-wireui.card title="Colores">
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
                            </x-wireui.card>
            
                            {{-- TOGGLES --}}
                            <div class="mb-4"></div>
                            <x-wireui.card title="Toggles">
                                <div class="mb-4">
                                    <x-wireui.toggle name="status" label="Estado" />
                                    <x-wireui.toggle name="status2" label="Estado" valor="7" />
                                    <x-wireui.toggle name="status3" left-label="Estado" valor="7" />
                                    <x-wireui.toggle name="status4" label="Estado" md />
                                    <x-wireui.toggle name="status4" label="Estado" lg />
                                </div>
                            </x-wireui.card>
            
                            {{-- CHECK BOX --}}
                            <div class="mb-4"></div>
                            <x-wireui.card title="Check Box">
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
                            </x-wireui.card>
            
                            {{-- RADIO BUTTONS --}}
                            <div class="mb-4"></div>
                            <x-wireui.card title="Radio Buttons">
                                <div class="mb-4 flex space-x-4">
                                    <x-wireui.radio label="Persona 1" id="pers1" value="1" name="pers" />
                                    <x-wireui.radio label="Persona 2" id="pers2" value="2" name="pers" />
                                    <x-wireui.radio label="Persona 3" id="pers3" value="3" name="pers" />
                                    <x-wireui.radio label="Persona 4" id="pers4" value="4" name="pers" />
                                </div>
                            </x-wireui.card>
            
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
            </div>
        </div>
    </div>
</x-app-layout>