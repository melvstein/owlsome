@props(['active'])

@php

$classes = ($active)
            ? 'text-white no-underline hover:bg-gray-300 hover:text-black px-3 py-2 rounded bg-yellow-700 border-l-4 border-yellow-600'
            : 'text-white no-underline hover:bg-gray-300 hover:text-black px-3 py-2 rounded';

@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
