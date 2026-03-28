@props([
    'name'     => null,
    'label'    => null,
    'hint'     => null,
    'error'    => null,
    'checked'  => false,
    'disabled' => false,
    'value'    => '1',
])

<div class="flex flex-col gap-1.5">

    <label class="inline-flex items-center gap-3 {{ $disabled ? 'cursor-not-allowed opacity-50' : 'cursor-pointer' }}">

        <span class="relative inline-flex items-center justify-center shrink-0">
            <input
                type="radio"
                name="{{ $name }}"
                id="{{ $name }}_{{ $value }}"
                value="{{ $value }}"
                @if($checked) checked @endif
                @if($disabled) disabled @endif
                class="sr-only peer"
            >
            {{-- Outer circle --}}
            <span class="w-5 h-5 rounded-full border-2 border-gray-300 dark:border-slate-700 bg-white dark:bg-slate-900
                peer-checked:border-indigo-500
                transition-colors duration-200
                {{ $error ? 'border-rose-300 dark:border-rose-500/50' : '' }}">
            </span>
            {{-- Inner dot --}}
            <span class="absolute w-2.5 h-2.5 rounded-full bg-indigo-500
                opacity-0 peer-checked:opacity-100
                transition-opacity duration-200 pointer-events-none">
            </span>
        </span>

        @if($label)
            <span class="text-sm font-medium text-gray-700 dark:text-slate-300 select-none">{{ $label }}</span>
        @endif

    </label>

    @if($hint && !$error)
        <p class="text-xs text-gray-400 dark:text-slate-500">{{ $hint }}</p>
    @endif

    @if($error)
        <p class="text-xs text-rose-500">{{ $error }}</p>
    @endif

</div>
