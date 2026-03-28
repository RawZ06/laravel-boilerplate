{{-- resources/views/components/form/textarea.blade.php --}}
@props([
    'name'        => null,
    'label'       => null,
    'placeholder' => null,
    'value'       => null,
    'hint'        => null,
    'error'       => null,
    'disabled'    => false,
    'required'    => false,
    'rows'        => 4,
    'resize'      => true,
])

<x-form.field :label="$label" :name="$name" :hint="$hint" :error="$error" :required="$required">

    <textarea
        name="{{ $name }}"
        id="{{ $name }}"
        rows="{{ $rows }}"
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
            ' . ($disabled  ? 'bg-gray-50 text-gray-400 cursor-not-allowed' : '') . '
            ' . ($resize    ? 'resize-y' : 'resize-none') . '
        ']) }}
    >{{ old($name, $value) }}</textarea>

</x-form.field>
