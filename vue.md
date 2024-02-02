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

        components: {
            OtroComponente
        },
        
        data() {
            let dato1 = 'Prueba';
            return {
                dato1
            }
        },

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
            <OtroComponente />
        </div>
    </template>

    <script setup>
    /* Código Javascript */
    import OtroComponente from './OtroComponente.vue'
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
+ mmm