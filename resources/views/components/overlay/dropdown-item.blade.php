@props([
    'href'    => null,
    'variant' => 'default',
    'icon'    => null,
])

@php
    $colors = [
        'default' => 'text-gray-700 hover:bg-gray-50',
        'danger'  => 'text-red-600 hover:bg-red-50',
    ];
    $color = $colors[$variant] ?? $colors['default'];
    $tag = $href ? 'a' : 'button';
@endphp

<{{ $tag }}
{{ $href ? "href=$href" : 'type=button' }}
{{ $attributes->merge(['class' => "flex items-center gap-2.5 w-full px-4 py-2.5 text-xs font-medium transition-colors $color"]) }}
>
@if($icon)
    <i class="{{ $icon }} w-4 text-center opacity-60"></i>
@endif
{{ $slot }}
</{{ $tag }}>
