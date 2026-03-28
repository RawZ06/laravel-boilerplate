{{-- resources/views/components/form/input.blade.php --}}
@props([
    'name'        => null,
    'label'       => null,
    'type'        => 'text',
    'placeholder' => null,
    'value'       => null,
    'hint'        => null,
    'error'       => null,
    'disabled'    => false,
    'required'    => false,
    'icon'        => null,
    'iconPos'     => 'left',
])

<x-form.field :label="$label" :name="$name" :hint="$hint" :error="$error" :required="$required">
    <div class="relative">

        @if($icon && $iconPos === 'left')
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                <i class="{{ $icon }} text-gray-400 text-sm"></i>
            </div>
        @endif

        <input
            type="{{ $type }}"
            name="{{ $name }}"
            id="{{ $name }}"
            value="{{ old($name, $value) }}"
            placeholder="{{ $placeholder }}"
            @if($disabled) disabled @endif
            @if($required) required @endif
            {{ $attributes->merge(['class' => '
                w-full rounded-lg border bg-white px-3.5 py-2 text-sm text-gray-800
                placeholder:text-gray-400 outline-none transition-all duration-150
                focus:ring-2 focus:ring-offset-0
                ' . ($error
                    ? 'border-rose-300 focus:border-rose-400 focus:ring-rose-100'
                    : 'border-gray-200 focus:border-indigo-400 focus:ring-indigo-100'
                ) . '
                ' . ($disabled ? 'bg-gray-50 text-gray-400 cursor-not-allowed' : '') . '
                ' . ($icon && $iconPos === 'left'  ? 'pl-9'  : '') . '
                ' . ($icon && $iconPos === 'right' ? 'pr-9'  : '') . '
            ']) }}
        />

        @if($icon && $iconPos === 'right')
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                <i class="{{ $icon }} text-gray-400 text-sm"></i>
            </div>
        @endif

    </div>
</x-form.field>
