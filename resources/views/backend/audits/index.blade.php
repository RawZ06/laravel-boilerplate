@extends('layouts.admin')

@section('breadcrumb')
    <x-nav.breadcrumb :items="[
        ['label' => 'Dashboard', 'icon' => 'fa-solid fa-gauge', 'url' => route('backend.index')],
        ['label' => 'Audits', 'icon' => 'fa-solid fa-history'],
    ]"/>
@endsection

@section('content')
    <div class="flex flex-col gap-4 container max-w-7xl mx-auto">
        <h1 class="text-2xl font-bold tracking-tight text-slate-800 dark:text-white">Audit Logs</h1>

        <x-table
            id="audits_table"
            :rows="$audits"
            :columns="[
                ['key' => 'created_at', 'label' => 'Date', 'sortable' => false],
                ['key' => 'user', 'label' => 'User', 'sortable' => false],
                ['key' => 'event', 'label' => 'Event', 'sortable' => false],
                ['key' => 'auditable_type', 'label' => 'Resource', 'sortable' => false],
                ['key' => 'auditable_id', 'label' => 'ID', 'sortable' => false],
                ['key' => 'ip_address', 'label' => 'IP Address', 'sortable' => false],
                ['key' => 'action', 'label' => 'Action', 'sortable' => false],
            ]"
        >
            <x-slot:rowTemplate>
                <x-table.row column="created_at">
                    @verbatim
                        <span class="text-xs text-slate-500">{{ $row->created_at->format('Y-m-d H:i:s') }}</span>
                    @endverbatim
                </x-table.row>

                <x-table.row column="user">
                    @verbatim
                        @if($row->user)
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded-full bg-slate-200 dark:bg-slate-700 flex items-center justify-center overflow-hidden">
                                    <img src="{{ $row->user->avatar ?? 'https://api.dicebear.com/7.x/adventurer/svg?seed=' . $row->user->name }}" alt="avatar" class="object-cover w-full h-full">
                                </div>
                                <span class="text-sm font-medium">{{ $row->user->name }}</span>
                            </div>
                        @else
                            <span class="text-xs text-slate-400 italic">System / Guest</span>
                        @endif
                    @endverbatim
                </x-table.row>

                <x-table.row column="event">
                    @verbatim
                        @php
                            $variant = match($row->event) {
                                'created' => 'green',
                                'updated' => 'blue',
                                'deleted' => 'red',
                                default => 'gray'
                            };
                        @endphp
                        <x-feedback.badge :variant="$variant">
                            {{ ucfirst($row->event) }}
                        </x-feedback.badge>
                    @endverbatim
                </x-table.row>

                <x-table.row column="auditable_id">
                    @verbatim
                        @php
                            $resourceRoute = null;
                            if ($row->event !== 'deleted') {
                                try {
                                    $routeName = 'backend.' . str(class_basename($row->auditable_type))->plural()->lower() . '.show';
                                    if (Route::has($routeName)) {
                                        $resourceRoute = route($routeName, $row->auditable_id);
                                    }
                                } catch (\Exception $e) {}
                            }
                        @endphp

                        @if($resourceRoute)
                            <a href="{{ $resourceRoute }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 font-medium underline decoration-indigo-500/30">
                                {{ $row->auditable_id }}
                            </a>
                        @else
                            <span class="text-slate-500">{{ $row->auditable_id }}</span>
                        @endif
                    @endverbatim
                </x-table.row>

                <x-table.row column="auditable_type">
                    @verbatim
                        <span class="text-xs font-mono bg-slate-100 dark:bg-slate-800 px-1.5 py-0.5 rounded text-slate-600 dark:text-slate-400">
                            {{ class_basename($row->auditable_type) }}
                        </span>
                    @endverbatim
                </x-table.row>

                <x-table.row column="action">
                    @verbatim
                        <x-button variant="ghost" size="sm" href="{{ route('backend.audits.show', $row->id) }}" title="View details">
                            <i class="fa-solid fa-eye text-xs"></i>
                        </x-button>
                    @endverbatim
                </x-table.row>
            </x-slot:rowTemplate>
        </x-table>
    </div>
@endsection
