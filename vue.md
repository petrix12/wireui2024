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
    import OtroComponente from './OtroComponente.vue'

    export default defineComponent({
        name: 'NombreComponente',
        props: {},
        components: {},        
        data() {},

        created() { console.log('El componente se acaba de crear'); },
        mounted() { console.log('El componente se acaba de montar'); },
        updated() { console.log('El componente se acaba de actualizar'); },
        unmounted() { console.log('El componente se acaba de desmontar (antes llamdo destroyed)'); },

        computed: {},
        methods: {}
    });
    </script>
    <!-- ... -->
    ```

+ Estructura ciclo de vida Composition API:
    ```html
    <script>

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



