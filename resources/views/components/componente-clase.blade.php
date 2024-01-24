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