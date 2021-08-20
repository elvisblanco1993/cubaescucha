@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block pl-3 pr-4 py-2 border-l-4 border-bluegray-400 text-sm font-medium text-bluegray-600 bg-bluegray-50 focus:outline-none focus:text-bluegray-800 focus:bg-bluegray-100 focus:border-bluegray-700 transition duration-150 ease-in-out'
            : 'block pl-3 pr-4 py-2 border-l-4 border-transparent text-sm font-medium text-bluegray-200 hover:text-bluegray-800 hover:bg-bluegray-50 hover:border-bluegray-400 focus:outline-none focus:text-bluegray-800 focus:bg-bluegray-50 focus:border-bluegray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
