@props(['active'])

@php
$classes = ($active)
            ? 'text-white p-4 bg-yellow-800'
            : 'text-white p-4 hover:bg-yellow-800';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
