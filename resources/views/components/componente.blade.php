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