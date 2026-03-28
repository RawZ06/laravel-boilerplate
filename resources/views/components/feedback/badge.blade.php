@props(['variant' => 'gray', 'size' => 'md', 'dot' => false])

@php
    $variants = [
        'gray'    => 'bg-gray-100 text-gray-600',
        'indigo'  => 'bg-indigo-50 text-indigo-600',
        'green'   => 'bg-green-50 text-green-600',
        'red'     => 'bg-red-50 text-red-600',
        'yellow'  => 'bg-yellow-50 text-yellow-600',
        'blue'    => 'bg-blue-50 text-blue-600',
    ];

    $sizes = [
        'sm' => 'text-xs px-2 py-0.5',
        'md' => 'text-xs px-2.5 py-1',
        'lg' => 'text-sm px-3 py-1',
    ];

    $dots = [
        'gray'    => 'bg-gray-400',
        'indigo'  => 'bg-indigo-500',
        'green'   => 'bg-green-500',
        'red'     => 'bg-red-500',
        'yellow'  => 'bg-yellow-500',
        'blue'    => 'bg-blue-500',
    ];

    $classes = implode(' ', [
        'inline-flex items-center gap-1.5 font-medium rounded-full',
        $variants[$variant] ?? $variants['gray'],
        $sizes[$size] ?? $sizes['md'],
    ]);
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    @if($dot)
        <span class="w-1.5 h-1.5 rounded-full {{ $dots[$variant] ?? $dots['gray'] }}"></span>
    @endif
    {{ $slot }}
</span>
