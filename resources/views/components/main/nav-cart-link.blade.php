@props(['active'])

@php

$classes = ($active)
            ? 'text-white px-3 py-3 animate-bounce bg-yellow-700 rounded-xl'
            : 'text-white px-3 py-3 animate-bounce';

@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    <i class="fa fa-shopping-cart"> {{ $slot }}</i>
</a>
