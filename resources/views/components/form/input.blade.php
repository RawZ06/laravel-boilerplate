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
                <i class="{{ $icon }} text-gray-400 dark:text-slate-500 text-sm"></i>
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
                w-full rounded-lg border bg-white dark:bg-slate-900 px-3.5 py-2 text-sm text-gray-800 dark:text-slate-200
                placeholder:text-gray-400 dark:placeholder:text-slate-500 outline-none transition-all duration-150
                focus:ring-2 focus:ring-offset-0 dark:focus:ring-offset-slate-950
                ' . ($error
                    ? 'border-rose-300 focus:border-rose-400 focus:ring-rose-100 dark:border-rose-500/50 dark:focus:ring-rose-500/20'
                    : 'border-gray-200 dark:border-slate-700 focus:border-indigo-400 dark:focus:border-indigo-500 focus:ring-indigo-100 dark:focus:ring-indigo-500/20'
                ) . '
                ' . ($disabled ? 'bg-gray-50 dark:bg-slate-800 text-gray-400 dark:text-slate-600 cursor-not-allowed' : '') . '
                ' . ($icon && $iconPos === 'left'  ? 'pl-9'  : '') . '
                ' . ($icon && $iconPos === 'right' ? 'pr-9'  : '') . '
            ']) }}
        />

        @if($icon && $iconPos === 'right')
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                <i class="{{ $icon }} text-gray-400 dark:text-slate-500 text-sm"></i>
            </div>
        @endif

    </div>
</x-form.field>
