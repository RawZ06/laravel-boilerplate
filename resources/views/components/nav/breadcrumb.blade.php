@props(['items' => []])

<nav aria-label="Breadcrumb">
    <ol class="flex items-center gap-1 flex-wrap">
        @foreach($items as $index => $item)
            @php $isLast = $index === array_key_last($items); @endphp

            <li class="flex items-center gap-1">
                {{-- Séparateur --}}
                @if($index > 0)
                    <i class="fa-solid fa-chevron-right text-[10px] text-gray-300 mx-1"></i>
                @endif

                {{-- Lien ou texte --}}
                @if(!$isLast && isset($item['url']))
                    <a
                        href="{{ $item['url'] }}"
                        class="flex items-center gap-1.5 text-sm text-gray-400 hover:text-gray-700 transition-colors"
                    >
                        @if(isset($item['icon']))
                            <i class="{{ $item['icon'] }} text-xs"></i>
                        @endif
                        {{ $item['label'] }}
                    </a>
                @else
                    <span class="flex items-center gap-1.5 text-sm font-medium text-gray-700">
                        @if(isset($item['icon']))
                            <i class="{{ $item['icon'] }} text-xs"></i>
                        @endif
                        {{ $item['label'] }}
                    </span>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
