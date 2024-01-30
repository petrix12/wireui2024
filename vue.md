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