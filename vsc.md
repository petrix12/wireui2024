# Visual Studio Code

## Construcción de un snippet
1. Página para generar snippet: https://snippet-generator.app
2. Estructura:
```html
<template>
</template>

<script>
export default {
    props: {
    },

    components: {
        GoogleMaps
    },

    data() {
        return {
        }
    },

    mounted() {
    },

    updated() {
    },

    methods: {
    },

    computed: {
    }
}
</script>

<style scoped>
</style>
```
3. Obtener el snippet resultante de pegar el código anterior en la página indicada inicialmente (indicar descripción y tag trigger):
```json
"Vue Component Snippet Option API": {
  "prefix": "vuecoapi",
  "body": [
    "<template>",
    "</template>",
    "",
    "<script>",
    "export default {",
    "    props: {",
    "    },",
    "",
    "    components: {",
    "        GoogleMaps",
    "    },",
    "",
    "    data() {",
    "        return {",
    "        }",
    "    },",
    "",
    "    mounted() {",
    "    },",
    "",
    "    updated() {",
    "    },",
    "",
    "    methods: {",
    "    },",
    "",
    "    computed: {",
    "    }",
    "}",
    "</script>",
    "",
    "<style scoped>",
    "</style>"
  ],
  "description": "Vue Component Snippet Option API"
}
```
4. Ir a File > Preferences > Configure User Snippets, e indicar que esté disponible para proyectos de vue (vue.json).
5. Incluir finalmente el snippet construido anteriormente en **C:\Users\bazop\AppData\Roaming\Code\User\snippets\vue.json**.
6. Para llamarlo, se debe escribir: vuecoapi