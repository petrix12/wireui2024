# LARAVEL 10

## Pre-requisitos obligatorios:
+ [XAMPP](https://www.apachefriends.org/es/index.html) o [Laragon](https://laragon.org/index.html).
+ [Composer](https://getcomposer.org/).
+ [NodeJS](https://nodejs.org).

## Pre-requisitos recomendados:
+ [GIT](https://git-scm.com).
+ [Visual Studio Code](https://code.visualstudio.com).

## Documentación:
+ [Página oficial de Laravel](https://laravel.com).

## Instalar el instalador de Laravel:
+ $ composer global require laravel/installer

## Instalación de un proyecto Laravel:
+ Vía composer (no requiere del instalador de Laravel):
    + $ composer create-project laravel/laravel mi_proyecto_laravel
+ Vía instalador de Laravel:
    + $ laravel new mi_proyecto_laravel

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

## Estructura de una ruta:
+ Las rutas se definenen en los archivos contenidos en la carpeta **routes**.
+ Ejemplo:
    ```php
    Routee::get('ruta/{parametro_obligatorio}/{parametro_opcional?}', function($parametro_obligatorio, $parametro_opcional = null) {
        if($parametro_opcional) {
            return "ruta con $parametro_obligatorio y $parametro_opcional";
        } else {
            return "ruta con solo con $parametro_obligatorio",
        }
    });
    ```