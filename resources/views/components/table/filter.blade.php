@props([
    'name'        => '',
    'options'     => [],
    'label'       => null,
    'placeholder' => 'Tous',
    'currentValue' => '',
])

<form method="GET" action="" class="flex items-center gap-2">

    @foreach(request()->except(["filter[{$name}]", 'page']) as $key => $val)
        <input type="hidden" name="{{ $key }}" value="{{ $val }}">
    @endforeach

    <div class="flex items-center gap-2">
        @if($label)
            <span class="text-sm text-gray-500">{{ $label }}</span>
        @endif

        <select
            name="filter[{{ $name }}]"
            onchange="this.form.submit()"
            class="text-sm rounded-xl border border-gray-200 bg-white shadow-xs
                   text-gray-700 px-3 py-2
                   focus:outline-none focus:ring-2 focus:ring-indigo-300 focus:border-indigo-400
                   transition"
        >
            <option value="">{{ $placeholder }}</option>
            @foreach($options as $value => $label)
                <option value="{{ $value }}" {{ $currentValue == $value ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
    </div>

</form>
