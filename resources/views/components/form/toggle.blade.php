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

        {{-- Wrapper relatif pour positionner track + thumb --}}
        <span class="relative inline-flex items-center">
            <input
                type="checkbox"
                name="{{ $name }}"
                id="{{ $name }}"
                value="{{ $value }}"
                @if($checked) checked @endif
                @if($disabled) disabled @endif
                class="sr-only peer"
            >
            {{-- Track --}}
            <span class="block w-10 h-6 rounded-full bg-gray-200 peer-checked:bg-indigo-500 transition-colors duration-200 {{ $error ? 'ring-2 ring-rose-300' : '' }}"></span>
            {{-- Thumb --}}
            <span class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full shadow-sm transition-transform duration-200 peer-checked:translate-x-4"></span>
        </span>

        @if($label)
            <span class="text-sm font-medium text-gray-700 select-none">{{ $label }}</span>
        @endif

    </label>

    @if($hint && !$error)
        <p class="text-xs text-gray-400">{{ $hint }}</p>
    @endif

    @if($error)
        <p class="text-xs text-rose-500">{{ $error }}</p>
    @endif

</div>
