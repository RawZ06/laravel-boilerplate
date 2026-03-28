@props([
    'name'        => 'q',
    'placeholder' => 'Rechercher…',
    'value'       => '',
])

<form method="GET" action="" class="flex items-center gap-2">

    {{-- Preserve other parameters GET except q and page --}}
    @foreach(request()->except([$name, 'page']) as $key => $val)
        <input type="hidden" name="{{ $key }}" value="{{ $val }}">
    @endforeach

    <div class="relative">
        <span class="absolute inset-y-0 left-3 flex items-center pointer-events-none text-gray-400">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
            </svg>
        </span>
        <input
            type="search"
            name="{{ $name }}"
            value="{{ $value }}"
            placeholder="{{ $placeholder }}"
            class="pl-9 pr-4 py-2 text-sm rounded-xl border border-gray-200 bg-white shadow-xs
                   placeholder-gray-400 text-gray-700
                   focus:outline-none focus:ring-2 focus:ring-indigo-300 focus:border-indigo-400
                   transition w-64"
        >
    </div>

    <button type="submit"
            class="px-4 py-2 text-sm font-medium text-white bg-indigo-500 rounded-xl hover:bg-indigo-600 transition-colors shadow-xs">
        Search
    </button>

</form>
