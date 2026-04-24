{{-- components/avatar.blade.php --}}
@props([
    'src' => null,
    'alt' => 'User avatar',
    'size' => 'sm',
])

@php
    $sizes = [
        'sm' => 'w-8 h-8',
        'md' => 'w-12 h-12',
        'lg' => 'w-16 h-16',
    ];

    $sizeClass = $sizes[$size] ?? $sizes['sm'];
@endphp

@if(!empty($src))
    <img
        class="{{ $sizeClass }} rounded-full bg-gray-300 dark:bg-gray-700 object-cover"
        src="{{ $src }}"
        alt="{{ $alt }}"
    />
@else
    <span class="{{ $sizeClass }} rounded-full bg-gray-300 dark:bg-gray-700 flex items-center justify-center">
        <i class="fa-solid fa-user text-gray-500 dark:text-gray-400"></i>
    </span>
@endif
