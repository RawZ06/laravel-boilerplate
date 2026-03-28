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
            <span class="text-sm text-gray-500 dark:text-slate-400">{{ $label }}</span>
        @endif

        <select
            name="filter[{{ $name }}]"
            onchange="this.form.submit()"
            class="text-sm rounded-xl border border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-900 shadow-xs
                   text-gray-700 dark:text-slate-200 px-3 py-2
                   focus:outline-none focus:ring-2 focus:ring-indigo-300 dark:focus:ring-indigo-500/30 focus:border-indigo-400 dark:focus:border-indigo-500
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
