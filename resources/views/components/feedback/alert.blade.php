@props(['variant' => 'info', 'title' => '', 'dismissible' => false])

@php
    $variants = [
        'info'    => ['bg' => 'bg-blue-50 border-blue-200',   'icon' => 'fa-solid fa-circle-info',  'icon_color' => 'text-blue-500',  'title_color' => 'text-blue-800',  'text_color' => 'text-blue-700'],
        'success' => ['bg' => 'bg-green-50 border-green-200', 'icon' => 'fa-solid fa-circle-check', 'icon_color' => 'text-green-500', 'title_color' => 'text-green-800', 'text_color' => 'text-green-700'],
        'warning' => ['bg' => 'bg-yellow-50 border-yellow-200','icon' => 'fa-solid fa-triangle-exclamation','icon_color' => 'text-yellow-500','title_color' => 'text-yellow-800','text_color' => 'text-yellow-700'],
        'error'   => ['bg' => 'bg-red-50 border-red-200',     'icon' => 'fa-solid fa-circle-xmark', 'icon_color' => 'text-red-500',   'title_color' => 'text-red-800',   'text_color' => 'text-red-700'],
    ];

    $v = $variants[$variant] ?? $variants['info'];
@endphp

<div
    x-data="{ show: true }"
    x-show="show"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    {{ $attributes->merge(['class' => "flex gap-3 p-4 rounded-xl border {$v['bg']}"]) }}
>
    <i class="fa-fw mt-0.5 text-sm {{ $v['icon'] }} {{ $v['icon_color'] }}"></i>

    <div class="flex-1 flex flex-col gap-0.5">
        @if($title)
            <p class="text-sm font-semibold {{ $v['title_color'] }}">{{ $title }}</p>
        @endif
        <div class="text-sm {{ $v['text_color'] }}">{{ $slot }}</div>
    </div>

    @if($dismissible)
        <button @click="show = false" class="shrink-0 text-gray-400 hover:text-gray-600 transition-colors cursor-pointer">
            <i class="fa-solid fa-xmark text-sm"></i>
        </button>
    @endif
</div>
