@props(['name' => '', 'size' => 'md'])

@php
    $sizes = [
        'sm'  => 'max-w-sm',
        'md'  => 'max-w-lg',
        'lg'  => 'max-w-2xl',
        'xl'  => 'max-w-4xl',
        'full'=> 'max-w-full mx-4',
    ];
    $maxWidth = $sizes[$size] ?? $sizes['md'];
@endphp

<div
    x-data="{ open: false }"
    x-on:open-modal.window="if ($event.detail === '{{ $name }}') open = true"
    x-on:close-modal.window="if ($event.detail === '{{ $name }}') open = false"
    x-on:keydown.escape.window="open = false"
>
    {{-- Trigger slot --}}
    {{ $trigger ?? '' }}

    {{-- Overlay --}}
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-40 bg-black/40 backdrop-blur-sm"
        @click="open = false"
        x-cloak
    ></div>

    {{-- Panel --}}
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95 translate-y-2"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-95 translate-y-2"
        class="fixed inset-0 z-50 flex items-center justify-center p-4"
        x-cloak
    >
        <div
            class="relative w-full {{ $maxWidth }} bg-white rounded-2xl shadow-xl flex flex-col overflow-hidden"
            @click.stop
        >
            {{-- Header --}}
            @isset($header)
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                    <div class="flex flex-col gap-0.5">
                        {{ $header }}
                    </div>
                    <button
                        @click="open = false"
                        class="text-gray-400 hover:text-gray-600 transition-colors cursor-pointer"
                    >
                        <i class="fa-solid fa-xmark text-sm"></i>
                    </button>
                </div>
            @endisset

            {{-- Body --}}
            <div class="px-6 py-6 flex-1 overflow-y-auto">
                {{ $slot }}
            </div>

            {{-- Footer --}}
            @isset($footer)
                <div class="flex items-center justify-end gap-2 px-6 py-4 border-t border-gray-100 bg-gray-50">
                    {{ $footer }}
                </div>
            @endisset
        </div>
    </div>
</div>
