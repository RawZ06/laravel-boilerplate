@props(['paginator'])

<div class="flex items-center justify-between gap-4 px-5 py-3 border-t border-gray-100 flex-wrap">

    {{-- Info --}}
    <span class="text-xs text-gray-400">
        {{ $paginator->firstItem() }}–{{ $paginator->lastItem() }}
        sur {{ number_format($paginator->total()) }} résultats
    </span>

    <div class="flex items-center gap-1">

        {{-- First --}}
        @if($paginator->onFirstPage())
            <span class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-300 text-xs cursor-not-allowed select-none">«</span>
        @else
            <a href="{{ $paginator->url(1) }}"
               class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-500 hover:bg-gray-100 text-xs transition-colors">«</a>
        @endif

        {{-- Prev --}}
        @if($paginator->onFirstPage())
            <span class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-300 text-xs cursor-not-allowed select-none">‹</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
               class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-500 hover:bg-gray-100 text-xs transition-colors">‹</a>
        @endif

        {{-- Pages --}}
        @foreach(
            $paginator->getUrlRange(
                max(1, $paginator->currentPage() - 2),
                min($paginator->lastPage(), $paginator->currentPage() + 2)
            ) as $page => $url
        )
            @if($page === $paginator->currentPage())
                <span class="w-8 h-8 flex items-center justify-center rounded-lg bg-indigo-600 text-white text-xs font-semibold select-none">
                    {{ $page }}
                </span>
            @else
                <a href="{{ $url }}"
                   class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-600 hover:bg-gray-100 text-xs transition-colors">
                    {{ $page }}
                </a>
            @endif
        @endforeach

        {{-- Next --}}
        @if($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
               class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-500 hover:bg-gray-100 text-xs transition-colors">›</a>
        @else
            <span class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-300 text-xs cursor-not-allowed select-none">›</span>
        @endif

        {{-- Last --}}
        @if($paginator->hasMorePages())
            <a href="{{ $paginator->url($paginator->lastPage()) }}"
               class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-500 hover:bg-gray-100 text-xs transition-colors">»</a>
        @else
            <span class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-300 text-xs cursor-not-allowed select-none">»</span>
        @endif

        {{-- Per page --}}
        <form method="GET" id="per-page-form" class="ml-3">
            @foreach(request()->except(['per_page', 'page']) as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach
            <select
                name="per_page"
                onchange="this.closest('form').submit()"
                class="h-8 pl-3 pr-7 rounded-lg border border-gray-200 bg-white text-xs text-gray-700
                       focus:outline-none focus:ring-2 focus:ring-indigo-500 appearance-none cursor-pointer">
                @foreach([10, 25, 50, 100] as $size)
                    <option value="{{ $size }}" {{ request('per_page', 10) == $size ? 'selected' : '' }}>
                        {{ $size }}
                    </option>
                @endforeach
            </select>
        </form>

    </div>
</div>
