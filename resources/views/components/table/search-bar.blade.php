@props([
    'name'        => 'q',
    'placeholder' => 'Search…',
    'value'       => '',
])

<form method="GET" action="" class="flex items-center gap-2">

    {{-- Preserve other parameters GET except q and page --}}
    @foreach(request()->except([$name, 'page']) as $key => $val)
        <input type="hidden" name="{{ $key }}" value="{{ $val }}">
    @endforeach

    <div class="relative">
        <span class="absolute inset-y-0 left-3 flex items-center pointer-events-none text-gray-400 dark:text-slate-500">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
            </svg>
        </span>
        <x-form.input
            type="search"
            icon="fa-solid fa-search"
            icon-pos="left"
            name="{{ $name }}"
            value="{{ $value }}"
            placeholder="{{ $placeholder }}"
        ></x-form.input>
    </div>

</form>
