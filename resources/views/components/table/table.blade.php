@props([
    'id'           => 'table',
    'emptyMessage' => 'Aucun résultat.',
    'striped'      => false,
])

<div class="rounded-2xl border border-gray-100 dark:border-slate-800 bg-white dark:bg-slate-900 shadow-xs overflow-hidden">

    {{-- Toolbar (optionnel) --}}
    @if(isset($toolbar))
        <div class="flex items-center justify-end gap-3 flex-wrap px-4 py-3 border-b border-gray-100 dark:border-slate-800">
            {{ $toolbar }}
        </div>
    @endif

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">

            <thead>
            <tr class="border-b border-gray-100 dark:border-slate-800">
                @foreach($columns as $col)
                    <th class="px-5 py-3 font-semibold text-gray-700 dark:text-slate-300 text-sm whitespace-nowrap {{ $col['key'] === 'action' ? 'text-right' : '' }}">
                        @if($col['sortable'])
                            <a href="{{ $sortUrl($col['key']) }}"
                               class="inline-flex items-center gap-1.5 hover:text-indigo-600 transition-colors
                                          {{ $currentSort === $col['key'] ? 'text-indigo-600 dark:text-indigo-400' : 'text-gray-700 dark:text-slate-300' }}">
                                {{ $col['label'] }}
                                <span class="flex flex-col gap-px">
                                        <svg class="w-2 h-2 {{ $currentSort === $col['key'] && $currentDir === 'asc' ? 'text-indigo-500' : 'text-gray-300 dark:text-slate-600' }}"
                                             viewBox="0 0 8 5" fill="currentColor">
                                            <path d="M4 0L8 5H0z"/>
                                        </svg>
                                        <svg class="w-2 h-2 {{ $currentSort === $col['key'] && $currentDir === 'desc' ? 'text-indigo-500' : 'text-gray-300 dark:text-slate-600' }}"
                                             viewBox="0 0 8 5" fill="currentColor">
                                            <path d="M4 5L0 0h8z"/>
                                        </svg>
                                    </span>
                            </a>
                        @else
                            {{ $col['label'] }}
                        @endif
                    </th>
                @endforeach
            </tr>

            @if(collect($columns)->contains(fn($c) => $c['searchable'] ?? false))
                <tr class="border-b border-gray-100 dark:border-slate-800 bg-gray-50/50 dark:bg-slate-800/50">
                    @foreach($columns as $col)
                        <th class="px-4 py-2">
                            @if($col['searchable'] ?? false)
                                <form method="GET">
                                    @foreach(request()->except(["{$id}_search_{$col['key']}", 'page']) as $k => $v)
                                        <input type="hidden" name="{{ $k }}" value="{{ $v }}">
                                    @endforeach
                                    <input
                                        type="text"
                                        name="{{ $id }}_search_{{ $col['key'] }}"
                                        value="{{ request("{$id}_search_{$col['key']}") }}"
                                        placeholder="Filter…"
                                        class="w-full h-7 px-2.5 rounded-lg border border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-900
                                                   text-xs text-gray-700 dark:text-slate-300 placeholder-gray-300 dark:placeholder-slate-600
                                                   focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"
                                    />
                                </form>
                            @endif
                        </th>
                    @endforeach
                </tr>
            @endif
            </thead>

            <tbody class="divide-y divide-gray-50 dark:divide-slate-800">
            @forelse($rows as $i => $row)
                <tr class="{{ $striped && $i % 2 === 1 ? 'bg-gray-50/60 dark:bg-slate-800/40' : 'bg-white dark:bg-slate-900' }}
                                hover:bg-indigo-50/30 dark:hover:bg-indigo-500/10 transition-colors">
                    @foreach($columns as $col)
                        <td class="px-5 py-3.5 text-gray-700 dark:text-slate-300 whitespace-nowrap {{ $col['key'] === 'action' ? 'text-right' : '' }}">
                            @php
                                $cellContent = is_array($row) ? ($row[$col['key']] ?? '—') : ($row->{$col['key']} ?? '—');
                            @endphp

                            @if(isset($rowTemplate))
                                @php
                                    $html = (string) $rowTemplate;
                                    $customContent = null;

                                    // Chercher <template column="KEY">...</template>
                                    $pattern = '/<template\s+column="' . preg_quote($col['key'], '/') . '"[^>]*>(.*?)<\/template>/is';
                                    if (preg_match($pattern, $html, $matches)) {
                                        $customContent = $matches[1];
                                    }
                                @endphp

                                @if($customContent !== null)
                                    {!! \Illuminate\Support\Facades\Blade::render($customContent, ['row' => $row]) !!}
                                @else
                                    {{ $cellContent }}
                                @endif
                            @else
                                {{ $cellContent }}
                            @endif
                        </td>
                    @endforeach
                </tr>
            @empty
                <tr>
                    <td colspan="{{ count($columns) }}"
                        class="px-5 py-12 text-center text-sm text-gray-400">
                        {{ $emptyMessage }}
                    </td>
                </tr>
            @endforelse
            </tbody>

        </table>
    </div>

    {{-- Pagination --}}
    @if($isPaginated)
        <x-table.pagination :paginator="$paginator"/>
    @endif

</div>
