{{-- resources/views/components/button.blade.php --}}

@php
    $variants = [
        'primary'   => 'bg-indigo-500 text-white hover:bg-indigo-600 shadow-sm shadow-indigo-200 dark:shadow-indigo-900/20 focus:ring-indigo-300',
        'secondary' => 'bg-gray-100 text-gray-700 hover:bg-gray-200 focus:ring-gray-200 dark:bg-slate-800 dark:text-slate-300 dark:hover:bg-slate-700 dark:focus:ring-slate-700',
        'ghost'     => 'bg-transparent text-gray-600 hover:bg-gray-100 focus:ring-gray-200 dark:text-slate-400 dark:hover:bg-slate-800 dark:focus:ring-slate-800',
        'outline'   => 'bg-white text-gray-700 border border-gray-200 hover:bg-gray-50 focus:ring-gray-200 dark:bg-transparent dark:text-slate-300 dark:border-slate-700 dark:hover:bg-slate-800 dark:focus:ring-slate-800',
        'danger'    => 'bg-rose-500 text-white hover:bg-rose-600 shadow-sm shadow-rose-200 dark:shadow-rose-900/20 focus:ring-rose-300',
        'success'   => 'bg-emerald-500 text-white hover:bg-emerald-600 shadow-sm shadow-emerald-200 dark:shadow-emerald-900/20 focus:ring-emerald-300',
        'warning'   => 'bg-amber-400 text-white hover:bg-amber-500 shadow-sm shadow-amber-200 dark:shadow-amber-900/20 focus:ring-amber-300',
    ];

    $sizes = [
        'sm' => 'px-3 py-1.5 text-xs gap-1.5',
        'md' => 'px-4 py-2 text-sm gap-2',
        'lg' => 'px-5 py-2.5 text-base gap-2.5',
    ];

    $iconSizes = [
        'sm' => 'text-xs',
        'md' => 'text-sm',
        'lg' => 'text-base',
    ];

    $base = 'inline-flex items-center justify-center font-medium rounded-lg transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-offset-1 dark:focus:ring-offset-slate-900 cursor-pointer';

    $variantClass = $variants[$variant] ?? $variants['primary'];
    $sizeClass    = $sizes[$size] ?? $sizes['md'];
    $iconSize     = $iconSizes[$size] ?? $iconSizes['md'];

    $isDisabled   = $disabled || $loading;
    $disabledClass = $isDisabled ? 'opacity-50 pointer-events-none' : '';

    $tag = $href ? 'a' : 'button';
@endphp

<{{ $tag }}
    @if(!$href) type="{{ $type }}" @endif
@if($href) href="{{ $href }}" @endif
@if($isDisabled && !$href) disabled @endif
{{ $attributes->merge(['class' => "$base $variantClass $sizeClass $disabledClass"]) }}
>
@if($loading)
    <i class="fa-solid fa-circle-notch animate-spin {{ $iconSize }}"></i>
@elseif($icon && $iconPos === 'left')
    <i class="{{ $icon }} {{ $iconSize }}"></i>
@endif

@if($slot->isNotEmpty())
    <span>{{ $slot }}</span>
@endif

@if(!$loading && $icon && $iconPos === 'right')
    <i class="{{ $icon }} {{ $iconSize }}"></i>
@endif
</{{ $tag }}>
