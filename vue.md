# Vue.js

## Pre-requisitos obligatorios:
+ [NodeJS](https://nodejs.org).

## Pre-requisitos recomendados:
+ [GIT](https://git-scm.com).
+ [Visual Studio Code](https://code.visualstudio.com).

## Extensiones de VSC recomendadas:
+ Vue 3 Snippets (hollowtree)
+ Vue Language Features (Volar)

## Extensiones de Google recomendadas:
+ Vue.js devtools

## Documentación:
+ [Vue](https://vuejs.org).
+ [Vue CLI](https://cli.vuejs.org).

## Instalación Vue:
+ Instalar cliente principal de vue:
    + $ [sudo] npm install -g @vue/cli

## Crear un proyecto:
+ Vía CDN:
    ```html
    <script src="https://unpkg.com/vue@3"></script>

    <div id="app">{{ message }}</div>

    <script>
        const { createApp} = Vue
        createApp({
            data() {
                return {
                    message: 'Soluciones++'
                }
            }
        }).mount('#app')
    </script>
    ```
+ Vía CLI:
    + Ejecutar:
        + $ vue create mi_proyecto
        + Ejemplo de opciones seleccionadas para la creación de un proyecto:
            ```
            Vue CLI v5.0.8
            ? Please pick a preset: Manually select features
            ? Check the features needed for your project: Babel, TS, Linter
            ? Choose a version of Vue.js that you want to start the project with 3.x
            ? Use class-style component syntax? No
            ? Use Babel alongside TypeScript (required for modern mode, auto-detected polyfills, transpiling JSX)? Yes
            ? Pick a linter / formatter config: Basic
            ? Pick additional lint features: Lint on save
            ? Where do you prefer placing config for Babel, ESLint, etc.? In dedicated config files
            ? Save this as a preset for future projects? No
            ? Pick the package manager to use when installing dependencies: NPM           
            ```
        + Para ejecutar el proyecto:
            + $ cd mi_proyecto
            + $ npm run serve
    + Una vez generado el proyecto, se debe tener en cuenta:
        + El archivo de punto de entrada **mi_proyecto\public\index.html**, llama a:
        + El archivo principal **mi_proyecto\src\main.js** (**main.ts** o **main.js**, según si utiliza Typescript o Javascript), y este finalmente llama a:
        + El archivo componente principal **mi_proyecto\src\App.vue**, que es el archivo que desencadenara la llamada del resto de los compoentes de la aplicación:
            + Option API:
            ```html
            <template>
                <ComponenteDesencadenante />
            </template>

            <script>
            import { defineComponent } from 'vue';
            import ComponenteDesencadenante from './components/ComponenteDesencadenante.vue';

            export default defineComponent({
                name: 'App',                    
                components: {
                    ComponenteDesencadenante
                }
            });
            </script>

            <style>
            /* Código CSS */
            </style>            
            ```
            + Composition API:
            ```html
            <template>
                <ComponenteDesencadenante />
            </template>

            <script setup>
            import ComponenteDesencadenante from './components/ComponenteDesencadenante.vue';
            </script>

            <style>
            /* Código CSS */
            </style>            
            ```

## Proyectos con pre-procesador css:
+ Ejecutar:
    + $ vue create cssexample
    + Ejemplo de opciones seleccionadas para la creación de un proyecto:
        ```
        Vue CLI v5.0.8
        ? Please pick a preset: Manually select features
        ? Check the features needed for your project: (Press <space> to select, <a> to toggle all, <i> to invert selection, and <enter> to proceed)        
        >(*) Babel
        ( ) TypeScript
        ? Check the features needed for your project: Babel, TS, CSS Pre-processors, Linter
        ? Choose a version of Vue.js that you want to start the project with 3.x
        ? Use class-style component syntax? No
        ? Use Babel alongside TypeScript (required for modern mode, auto-detected polyfills, transpiling JSX)? Yes
        ? Pick a CSS pre-processor (PostCSS, Autoprefixer and CSS Modules are supported by default): Sass/SCSS (with dart-sass)
        ? Pick a linter / formatter config: Basic
        ? Pick additional lint features: Lint on save
        ? Where do you prefer placing config for Babel, ESLint, etc.? In dedicated config files
        ? Save this as a preset for future projects? No         
        ```
+ Incluir pre-procesador css en un proyecto existente:
    + SASS:
        + $ npm install -D sass-loader sass
    + LESS:
        + $ npm install -D less-loader less
    + Stylus:
        + $ npm install -D stylus-loader stylus
+ Para aplicar los estilos del pre-procesador css:
    ```html
    <!-- ... -->
    <style scoped lang="scss">
        /* ... */
        $red: #FF0000;
        h3 {
            color: $red;
        }
        /* ... */
    </style>
    ```
+ Ejemplo de un archivo de estilos sass en el proyecto:
    + Crear archivo de estilos **cssexample\src\scss\_variables.scss**:
        ```scss
        $red: #FF0000;
        $green: #00FF00;
        $blue: #0000FF;
        ```
    + Incorporar archivo de estilos a la aplicación en **cssexample\vue.config.js**:
        ```js
        // ...
        module.exports = defineConfig({
        // ...
        css: {
            loaderOptions: {
                sass: {
                    additionalData: `
                        @import "@/scss/_variables.scss";
                    `
                }
            }
        }
        })        
        ```
    + **Nota 1**: luego será necesario reiniciar el servidor web.
    + **Nota 2**: la instrucción:
        ```scss
        @import "@/scss/_variables.scss";
        ```
        Se puede usar dentro de cualquier componente vue de la aplicación, ejm:
        ```html
        <!-- ... -->
        <style scoped lang="scss">
            /* ... */
            @import "@/scss/_variables.scss";
            /* ... */
        </style>            
        ```

## Proyectos con enrutado:
+ Ejecutar:
    + $ vue create routingexample
    + Ejemplo de opciones seleccionadas para la creación de un proyecto:
        ```
        Vue CLI v5.0.8
        ? Please pick a preset: Manually select features
        ? Check the features needed for your project: Babel, TS, Router, CSS Pre-processors, Linter
        ? Choose a version of Vue.js that you want to start the project with 3.x
        ? Use class-style component syntax? No
        ? Use Babel alongside TypeScript (required for modern mode, auto-detected polyfills, transpiling JSX)? Yes
        ? Use history mode for router? (Requires proper server setup for index fallback in production) Yes
        ? Pick a CSS pre-processor (PostCSS, Autoprefixer and CSS Modules are supported by default): Sass/SCSS (with dart-sass)
        ? Pick a linter / formatter config: Basic
        ? Pick additional lint features: Lint on save
        ? Where do you prefer placing config for Babel, ESLint, etc.? In dedicated config files
        ? Save this as a preset for future projects? No      
        ```
    + Las rutas se definen en **proyectos_vue\routingexample\src\router\index.ts**.

## Estructura recomendada de carpetas de un proyecto Vue:
+ **node_modules**: dependencias npm.
+ **public**: archivos accesibles desde la web.
+ **src**: parte central de la aplicación.
    + **assets**
    + **components**
    + **interfaces**
    + **router**
    + **scss**: contenedor de archivos de pre-procesadores css.
    + **services**
    + **view**



## Estructura de un compoenten Vue:
+ Estructura general Option API:
    ```html
    <template>
        <div>
            <!-- Código HTML del componente-->
            <h2>{{ dato1 }}</h2>
            <button @click="metodo_prueba">Prueba</button>

            <OtroComponente />
        </div>
    </template>

    <script>
    /* Código Javascript */
    import { defineComponent } from 'vue';
    import OtroComponente from './OtroComponente.vue'

    export default defineComponent({
        name: 'NombreComponente',
        props: {},

        components: {
            OtroComponente
        },
        
        data() {
            let dato1 = 'Prueba';
            return {
                dato1
            }
        },

        mounted() {},

        computed: {},

        methods: {
            metodo_prueba() {
                this.dato1. = 'Otro valor';
            }
        }
    });
    </script>

    <!-- Si nuestro componente utilizar Typescript -->
    <!--
    <script lang="ts" setup>
    /* Código Javascript */
    </script>        
    -->

    <style scoped>
    /* Código CSS */
    </style>
    ```
+ Estructura general Composition API:
    ```html
    <template>
        <div>
            <!-- Código HTML del componente-->
            <h2>{{ dato1 }}</h2>
            <button @click="metodo_prueba">Prueba</button>

            <OtroComponente />
        </div>
    </template>

    <script>
    /* Código Javascript */
    import { defineComponent, ref } from 'vue';
    import OtroComponente from './OtroComponente.vue';

    export default defineComponent({
        name: 'NombreComponente',

        setup() {
            let dato1 = ref('Prueba');
            const metodo_prueba = () => {
                dato1.value = 'Otro valor';
            }
            return {
                dato1,
                metodo_prueba
            }
        }
    });
    </script>

    <!-- Si nuestro componente utilizar Typescript -->
    <!--
    <script lang="ts" setup>
    /* Código Javascript */
    </script>        
    -->

    <style scoped>
    /* Código CSS */
    </style>
    ```
+ Estructura general Composition API (con Typescript):
    ```html
    <template>
        <div>
            <!-- Código HTML del componente-->
            <h2>{{ dato1 }}</h2>
            <button @click="metodo_prueba">Prueba</button>

            <OtroComponente />
        </div>
    </template>

    <script lang="ts">
    /* Código Javascript */
    import { defineComponent, Ref, ref } from 'vue';
    import OtroComponente from './OtroComponente.vue';

    export default defineComponent({
        name: 'NombreComponente',

        setup() {
            interface DatoObjeto {
                clave1: string,
                clave2: string
            };
            let dato1:Ref = ref('Prueba');
            let array1:Ref<Array<string>> = ref(['valor 1', 'valor 2', 'valor 3']);
            let array2:Ref<Array<DatoObjeto>> = ref([
                {clave1: 'valor 1 de la clave 1', clave2: 'valor 1 de la clave 2'}, 
                {clave1: 'valor 2 de la clave 1', clave2: 'valor 2 de la clave 2'}
            ]);
            const metodo_prueba = ():void => {
                dato1.value = 'Otro valor';
            }
            return {
                dato1,
                metodo_prueba
            }
        }
    });
    </script>

    <!-- Si nuestro componente utilizar Typescript -->
    <!--
    <script lang="ts" setup>
    /* Código Javascript */
    </script>        
    -->

    <style scoped>
    /* Código CSS */
    </style>
    ```
+ Estructura general Composition API (con setup en el script):
    ```html
    <template>
        <div>
            <!-- Código HTML del componente-->
            <h2>{{ dato1 }}</h2>
            <button @click="metodo_prueba">Prueba</button>

            <OtroComponente />
        </div>
    </template>

    <script lang="ts" setup>
    /* Código Javascript */
    import { Ref, ref } from 'vue';
    import OtroComponente from './OtroComponente.vue';

    let dato1:Ref = ref('Prueba');
    const metodo_prueba = ():void => {
        dato1.value = 'Otro valor';
    }
    </script>

    <!-- Si nuestro componente utilizar Typescript -->
    <!--
    <script lang="ts" setup>
    /* Código Javascript */
    </script>        
    -->

    <style scoped>
    /* Código CSS */
    </style>
    ```

## Ciclo de vida:
+ Etapas:
    + beforeCreate
    + created
    + beforeMount
    + mounted
    + beforeUpdate
    + updated
    + beforeDestroy
    + destroyed
+ Estructura ciclo de vida Option API:
    ```html
    <!-- ... -->
    <script>
    import { defineComponent } from 'vue'

    export default defineComponent({
        beforeCreate() { console.log('El componente se va a crear'); },
        created() { console.log('El componente se acaba de crear'); },
        mounted() { console.log('El componente se acaba de montar'); },
        updated() { console.log('El componente se acaba de actualizar'); },
        unmounted() { console.log('El componente se acaba de desmontar (antes llamdo destroyed)'); },
    })
    </script>
    <!-- ... -->
    ```
+ Estructura ciclo de vida Composition API:
    ```html
    <script setup>
    import { onCreated, onMounted, onUpdated, onUnmounted } from 'vue'

    onCreated(() => { console.log('El componente se acaba de crear') })
    onMounted(() => { console.log('El componente se acaba de montar') })
    onUpdated(() => { console.log('El componente se acaba de actualizar') })
    onUnmounted(() => { console.log('El componente se acaba de desmontar') })
    </script>
    ```

## Directivas:
+ Selectivo **v-if**:
    ```html
    <!-- ... -->
    <div v-if="condicion">
        <!-- Código si se cumple condicion -->
    </div>
    <div v-else-if="condicion2">
        <!-- Código si se cumple condicion2 -->
    </div>
    <div v-else>
        <!-- Código si no se cumple condicion ni condicion2 -->
    </div>
    <!-- ... -->
    ```
    + **Nota:** el **v-if** no dibuja en el virtual DOM las condiciones que no se cumplen.
+ Selectivo **v-show**:
    ```html
    <!-- ... -->
    <div v-show="condicion">
        <!-- Código si se cumple condicion -->
    </div>
    <!-- ... -->
    ```
    + **Nota:** el **v-show** dibuja en el virtual DOM las condiciones que no se cumplen y le agrega al tag que lo usa el atributo **style: "display: none;"**.
+ Recorrido de estructuras **v-for**:
    ```html
    <!-- ... -->
    <ul>
        <li v-for="elemento in elementos" :key="elemento.id">{{ elemento }}</li>
        <!-- :key tambien se puede escribir como v-bind:key -->
    </ul>
    <!-- Usando un index -->
    <ul>
        <li v-for="(elemento, index) in elementos" :key="index">{{ elemento }}</li>
        <!-- :key tambien se puede escribir como v-bind:key -->
    </ul>
    <!-- ... -->
    ```
+ Bindeo **v-bind**:
    + Bindeo de clases:
        ```html
        <!-- ... -->
        <p v-bind:class="{
            'mi-clase': condicion 
        }"
        >
            A este texto se le aplicará la clase mi-clase si condicion se cumple
        </p>

        <!-- forma simplificada -->
        <p :class="{
            'mi-clase': condicion 
        }"
        >
            A este texto se le aplicará la clase mi-clase si condicion se cumple
        </p>
        <!-- ... -->
        ```
    + Bindeo de estilos:
        ```html
        <!-- ... -->
        <p :style="{
            backgroundColor: variable_bg,
            'background-color': variable_bg,     // Esta expresión es igual a la anterior
            color: variable_color
        }"
        >
            A este texto se le aplicará los estilos definidos en style
        </p>
        <!-- ... -->
        ```
+ Evento **v-on**:
    ```html
    <!-- ... -->
    <button v-on:click="miEvento()">Ejecutar evento</button>
    <button @click="miEvento()">Ejecutar evento</button>
    <!-- ... -->
    ```
+ Comunicación bidireccional **v-model**:
    ```html
    <!-- ... -->
    <input type="text" v-model="inputText" />
    <p>{{ inputText }}</p>
    <!-- ... -->
    ```

## Comunicación entre componentes:
+ Comunicación vertical descendente (**props**):
    + Componente padre con Composition API:
        ```html
        <template>
            <h2>Componente padre</h2>
            <ComponenteHijo 
                informacion="Información a pasar al componente hijo"
            />
        </template>

        <script setup>
        import ComponenteHijo from './ComponenteHijo.vue'
        </script>
        ```
    + Componente hijo con Option API:
        ```html
        <template>
            <div>
                <h2>Componente hijo</h2>
                <p>Información del componente padre: {{ props.informacion }}</p>
            </div>
        </template>

        <script>
        import { defineComponent } from 'vue'

        export default defineComponent({
            props: {
                informacion: {
                    type: String,
                    required: false,
                    defalut: 'Sin información'
                }
            },
            setup(props) {
                return {
                    props
                }
            }
        })
        </script>
        ```
    + Componente hijo con Composition API con el setup definido en el script:
        ```html
        <template>
            <div>
                <h2>Componente hijo</h2>
                <p>Información del componente padre: {{ props.informacion }}</p>
            </div>
        </template>

        <script setup>
        import { defineProps } from 'vue'

        const props = defineProps({
            informacion: {
                type: String,
                required: false,
                defalut: 'Sin información'
            }
        })
        </script>
        ```
+ Comunicación vertical ascendente (**emits**):
    + Componente padre con Option API:
        ```html
        <template>
            <h2>Componente padre</h2>
            <ComponenteHijo 
                @comunicarAlComponentePadre="comunicacionDelComponenteHijo"
            />
        </template>

        <script>        
        import { defineComponent } from 'vue'

        export default defineComponent({
            data() {
                return {
                    variable
                }
            }

            methods: {
                comunicacionDelComponenteHijo(variable) {
                    this.variable = variable
                }
            }
        })
        </script>
        ```
    + Componente hijo con Option API:
        ```html
        <template>
            <div>
                <h2>Componente hijo</h2>
                <button @click="enviarComunicacionAlComponentePadre">Enviar información al componente Padre</button>
            </div>
        </template>

        <script>
        import { defineComponent } from 'vue'

        export default defineComponent({
            emits: ["comunicarAlComponentePadre"],
            setup(props, { emit }) {
                const enviarComunicacionAlComponentePadre = () {
                    emit("comunicarAlComponentePadre", "valor entregado desde el compoenente hijo")
                }
                return {
                    props,
                    enviarComunicacionAlComponentePadre
                }
            },
        })
        </script>
        ```
    + Componente hijo con Composition API con el setup definido en el script:
        ```html
        <template>
            <div>
                <h2>Componente hijo</h2>
                <button @click="enviarComunicacionAlComponentePadre">Enviar información al componente Padre</button>
            </div>
        </template>

        <script setup>
        import { defineProps, defineEmits } from 'vue'

        const emit = defineEmits(['comunicarAlComponentePadre'])
        const enviarComunicacionAlComponentePadre = () {
            emit("comunicarAlComponentePadre", "valor entregado desde el compoenente hijo")
        }
        </script>
        ```

## Propiedades computadas:
+ Option API:
    ```html
    <template>
        <div>
            <p>{{ valorData }}</p>
            <p>{{ valorComputado }}</p>
        </div>
    </template>

    <script>
    import { defineComponent } from 'vue'

    export default defineComponent({
        data() {
            return {
                valorData: 1
            }
        },
        computed: {
            valorComputado() {
                return this.valorData * 2;
            }
            // Con Typescript se debe añadir el tipado de datos al valor computado:
            /*
            valorComputado():integer {
                return this.valorData * 2;
            }
            */
        }
    })
    </script>
    ```
+ Composition API:
    ```html
    <template>
        <div>
            <p>{{ valorData }}</p>
            <p>{{ valorComputado }}</p>
        </div>
    </template>

    <script>
    import { defineComponent, ref, computed } from 'vue'

    export default defineComponent({
        setup() {
            let valorData = ref(1)
            const valorComputado = computed(() => valorData.value * 2)

            return {
                valorData,
                valorComputado
            }
        }
    })
    </script>
    ```
+ Composition API con setup en el script:
    ```html
    <template>
        <div>
            <p>{{ valorData }}</p>
            <p>{{ valorComputado }}</p>
        </div>
    </template>

    <script setup>
    import { ref, computed } from 'vue'
    
    let valorData = ref(1)
    const valorComputado = computed(() => valorData.value * 2)
    </script>
    ```

## Directivas personalizadas:
+ Directiva personalizada simple:
    + Modificar el archivo principal **mi_proyecto\src\main.js** para estructurar la directiva personalizada:
        ```js
        // ...
        const app = createApp(App)
        
        /* 
            1er parámetro: nombre de la directiva (dentro de vue la usaremos como v-mi-directiva)
            2do parámetro: objeto con las acciones a realizar
        */
        app.directive('mi-directiva', {
            /* 
                Clave: momento del ciclo de vida de un componente
                Valor: acción a realizar
            */
            beforeMount: (el) => {
                /*
                    el: etiqueta html en donde va a actuar la directiva

                */
                el.style.fontSize = "70px"
            },
            updated: () => {
                // Otras acciones a tomar
            }
        })
        
        app.mount('#app')
        // ...
        ```
    + Ejemplo de uso en un componente:
        ```html
        <p v-mi-directiva>Texto con la directiva personalizada aplicada</p>
        ```
+ Directiva personalizada con value:
    + Modificar el archivo principal **mi_proyecto\src\main.js** para estructurar la directiva personalizada:
        ```js
        // ...
        const app = createApp(App)
        
        /* 
            1er parámetro: nombre de la directiva (dentro de vue la usaremos como v-mi-directiva)
            2do parámetro: objeto con las acciones a realizar
        */
        app.directive('mi-directiva', {
            /* 
                Clave: momento del ciclo de vida de un componente
                Valor: acción a realizar
            */
            beforeMount: (el, binding) => {
                /*
                    el: etiqueta html en donde va a actuar la directiva
                    binding: datos a recibir por la directiva

                */
                el.style.fontSize = binding.value + "px"
            }
        })
        
        app.mount('#app')
        // ...
        ```
    + Ejemplo de uso en un componente:
        ```html
        <p v-mi-directiva="45">Texto con la directiva personalizada aplicada</p>
        ```
+ Directiva personalizada con argumentos:
    + Modificar el archivo principal **mi_proyecto\src\main.js** para estructurar la directiva personalizada:
        ```js
        // ...
        const app = createApp(App)
        
        /* 
            1er parámetro: nombre de la directiva (dentro de vue la usaremos como v-mi-directiva)
            2do parámetro: objeto con las acciones a realizar
        */
        app.directive('mi-directiva', {
            /* 
                Clave: momento del ciclo de vida de un componente
                Valor: acción a realizar
            */
            beforeMount: (el, binding) => {
                /*
                    el: etiqueta html en donde va a actuar la directiva
                    binding: datos a recibir por la directiva

                */
                let size = 18
                switch(binding.arg) {
                    case 'sm':
                        size = 10
                        break
                    case 'md':
                        size = 18
                        break
                    case 'lg':
                        size = 25
                        break
                    case 'xl':
                        size = 40
                        break
                }
                el.style.fontSize = size + "px"
            }
        })
        
        app.mount('#app')
        // ...
        ```
    + Ejemplo de uso en un componente:
        ```html
        <p v-mi-directiva:xl>Texto con la directiva personalizada aplicada</p>
        ```
+ Directiva personalizada con modificadores:
    + Modificar el archivo principal **mi_proyecto\src\main.js** para estructurar la directiva personalizada:
        ```js
        // ...
        const app = createApp(App)
        
        /* 
            1er parámetro: nombre de la directiva (dentro de vue la usaremos como v-mi-directiva)
            2do parámetro: objeto con las acciones a realizar
        */
        app.directive('mi-directiva', {
            /* 
                Clave: momento del ciclo de vida de un componente
                Valor: acción a realizar
            */
            beforeMount: (el, binding) => {
                /*
                    el: etiqueta html en donde va a actuar la directiva
                    binding: datos a recibir por la directiva

                */                
                if(binding.modifiers.sm) {
                    el.style.fontSize = "10px"
                } else if(binding.modifiers.md) {
                    el.style.fontSize = "18px"
                } else if(binding.modifiers.lg) {
                    el.style.fontSize = "25px"
                }

                if(binding.modifiers.red) {
                    el.style.color = '#FF0000'
                } else if(binding.modifiers.green) {
                    el.style.color = '#00FF00'
                } else if(binding.modifiers.blue) {
                    el.style.color = '#0000FF'
                }
            }
        })
        
        app.mount('#app')
        // ...
        ```
    + Ejemplo de uso en un componente:
        ```html
        <p v-mi-directiva.blue.sm>Texto con la directiva personalizada aplicada</p>
        ```

## Servicios:
+ **Nota**: una buena práctica de programación es crear los servicios en una ruta específica para este fin, como puede ser **mi_proyecto\src\services**.
+ Ejemplo de una clase de servicio:
    + Creación del servicio (crear **vue2024\mi_proyecto\src\services\ModeloService.js**):
        ```js
        import { ref } from 'vue'

        class ModeloService {
            private modelos

            constructor() {
                this.modelos = ref([])
            }

            getModelos() {
                return this.modelos
            }

            async fetchAll() {
                try {
                    const url = 'https:://mi_servicio/modelos'
                    const response = await fetch(url)
                    const json = await response.json()
                    this.modelos.value = await json
                } catch(error) {
                    console.log(error)
                }
            }
        }

        export default ModeloService        
        ```
    + Consumo del servicio (**vue2024\mi_proyecto\src\components\MoldeloList.vue**):
        + Forma 1: Composition API
            ```html
            <template>
                <h2>Lista de modelos</h2>
                <ul>
                    <li v-if="modelo in modelos" :key="modelo.id">{{ modelo.name }}</li>
                </ul>
            </template>

            <script>
            import { defineComponent, onMounted } from 'vue'
            import ModeloService from '@/services/ModeloService'

            export default defineComponent({
                name: 'ModeloList',
                setup() {
                    const service = new ModeloService()
                    const modelos = service.getModelos()
                    onMounted(async () => {
                        await service.fetchAll()
                    })
                    return {
                        modelos
                    }
                },
            })
            </script>            
            ```
        + Forma 2: Composition API con setup en el script
            ```html
            <template>
                <h2>Lista de modelos</h2>
                <ul>
                    <li v-if="modelo in modelos" :key="modelo.id">{{ modelo.name }}</li>
                </ul>
            </template>

            <script setup>
            import { onMounted } from 'vue'
            import ModeloService from '@/services/ModeloService'

            const service = new ModeloService()
            const modelos = service.getModelos()
            onMounted(async () => {
                await service.fetchAll()
            })
            </script>            
            ```
        + Forma 3: Option API
            ```html
            <template>
                <h2>Lista de modelos</h2>
                <ul>
                    <li v-if="modelo in modelos" :key="modelo.id">{{ modelo.name }}</li>
                </ul>
            </template>

            <script>
            import { defineComponent } from 'vue'
            import ModeloService from '@/services/ModeloService'

            export default defineComponent({
                name: 'ModeloList',
                data() {                        
                    const service = new ModeloService()
                    const modelos = service.getModelos()                    
                    return {
                        modelos,
                        service
                    }
                },

                async mounted() {
                    await this.service.fetchAll()
                },
            })
            </script>            
            ```

## Tips de interes:
### Importar estilos y scripts a un componente vue:
    ```html
    <!-- ... -->
    <script>
    export default {
        // ...
        head() {
            return {
                link: [
                    {
                        rel: 'stylesheet',
                        href: 'https://url_estilos.css',
                    },
                    // ...
                ],
                script: [
                    {
                        src: 'https://url_scripts.js',
                        type: 'text/javascript',
                    },
                    // ...
                ],
            };
        },
        // ...
    };
    </script>
    <!-- ... -->
    ```
### Instalar bootstrap:
+ Ejecutar:
    + $ npm install --save bootstrap
    + $ npm install --save @popperjs/core
+ Incorporar bootstrap al proyecto:
    + Modificar archivo principal **...\src\main.ts** o **...\src\main.js**:
        ```js
        // ...
        import "bootstrap/dist/css/bootstrap.min.css"
        import "bootstrap"
        // ...
        ```
