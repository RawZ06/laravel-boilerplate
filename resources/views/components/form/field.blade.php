{{-- resources/views/components/form/field.blade.php --}}
@props([
    'label'    => null,
    'hint'     => null,
    'error'    => null,
    'required' => false,
    'name'     => null,
])

<div class="flex flex-col gap-1.5">

    @if($label)
        <label
            @if($name) for="{{ $name }}" @endif
        class="text-sm font-medium text-gray-700 dark:text-gray-300"
        >
            {{ $label }}
            @if($required)
                <span class="text-rose-400 ml-0.5">*</span>
            @endif
        </label>
    @endif

    {{ $slot }}

    @if($error)
        <p class="text-xs text-rose-500 flex items-center gap-1">
            <i class="fa-solid fa-circle-exclamation"></i>
            {{ $error }}
        </p>
    @elseif($hint)
        <p class="text-xs text-gray-400 dark:text-gray-500">{{ $hint }}</p>
    @endif

</div>
