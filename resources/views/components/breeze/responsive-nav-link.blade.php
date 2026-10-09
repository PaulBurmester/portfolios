@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-accent text-start text-base font-medium text-accent bg-raised focus:outline-none focus:bg-raised focus:border-accent transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-muted hover:text-fg hover:bg-raised hover:border-line focus:outline-none focus:text-fg focus:bg-raised focus:border-line transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
