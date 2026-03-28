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

        <input type="hidden" name="{{ $name }}" value="0">

        <span class="relative inline-flex items-center justify-center shrink-0">
            <input
                type="checkbox"
                name="{{ $name }}"
                id="{{ $name }}"
                value="{{ $value }}"
                @if($checked) checked @endif
                @if($disabled) disabled @endif
                class="sr-only peer"
            >
            {{-- Box --}}
            <span class="w-5 h-5 rounded-md border-2 border-gray-300 dark:border-slate-700 bg-white dark:bg-slate-900
                peer-checked:bg-indigo-500 peer-checked:border-indigo-500
                transition-colors duration-200
                {{ $error ? 'border-rose-300 dark:border-rose-500/50' : '' }}">
            </span>
            {{-- Checkmark --}}
            <span class="absolute inset-0 flex items-center justify-center pointer-events-none
                opacity-0 peer-checked:opacity-100 transition-opacity duration-200">
                <svg class="w-3 h-3 text-white" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="2,6 5,9 10,3"/>
                </svg>
            </span>
        </span>

        @if($label)
            <span class="text-sm font-medium text-gray-700 dark:text-slate-300 select-none">{{ $label }}</span>
        @endif

    </label>

    @if($hint && !$error)
        <p class="text-xs text-gray-400 dark:text-gray-500">{{ $hint }}</p>
    @endif

    @if($error)
        <p class="text-xs text-rose-500">{{ $error }}</p>
    @endif

</div>
