@extends('layouts.admin')

@section('breadcrumb')
    <x-nav.breadcrumb :items="[
        ['label' => 'Dashboard', 'icon' => 'fa-solid fa-gauge', 'url' => route('backend.index')],
        ['label' => 'Audits', 'icon' => 'fa-solid fa-history', 'url' => route('backend.audits.index')],
        ['label' => 'Audit Details', 'icon' => 'fa-solid fa-eye'],
    ]"/>
@endsection

@section('content')
    <div class="container max-w-4xl mx-auto space-y-6">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold">Audit Details</h1>
            <x-button variant="ghost" size="sm" href="{{ route('backend.audits.index') }}" icon="fa-solid fa-arrow-left">
                Back to list
            </x-button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Info Card --}}
            <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-slate-800 p-6 shadow-sm flex flex-col gap-4">
                <h2 class="font-semibold text-slate-800 dark:text-slate-200 border-b border-slate-50 dark:border-slate-800 pb-2">Information</h2>

                <div class="grid grid-cols-3 gap-1">
                    <span class="text-xs text-slate-400">Date</span>
                    <span class="col-span-2 text-sm text-slate-700 dark:text-slate-300">{{ $audit->created_at->format('Y-m-d H:i:s') }}</span>
                </div>

                <div class="grid grid-cols-3 gap-1">
                    <span class="text-xs text-slate-400">User</span>
                    <div class="col-span-2 flex items-center gap-2">
                        <img class="w-6 h-6 rounded-full bg-slate-200 dark:bg-slate-800 object-cover"
                             src="{{ $audit->user?->avatar ?? 'https://api.dicebear.com/7.x/adventurer/svg?seed=' . ($audit->user?->name ?? 'Guest') }}" alt="User avatar">
                        <span class="text-sm text-slate-700 dark:text-slate-300">{{ $audit->user?->name ?? 'Guest' }}</span>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-1">
                    <span class="text-xs text-slate-400">Event</span>
                    <div class="col-span-2">
                        @php
                            $variant = match($audit->event) {
                                'created' => 'green',
                                'updated' => 'blue',
                                'deleted' => 'red',
                                default => 'gray'
                            };
                        @endphp
                        <x-feedback.badge :variant="$variant">{{ ucfirst($audit->event) }}</x-feedback.badge>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-1">
                    <span class="text-xs text-slate-400">Resource</span>
                    <div class="col-span-2 flex items-center gap-1.5 text-sm text-slate-700 dark:text-slate-300">
                        <span>{{ class_basename($audit->auditable_type) }}</span>
                        @php
                            $resourceRoute = null;
                            if ($audit->event !== 'deleted') {
                                try {
                                    $routeName = 'backend.' . str(class_basename($audit->auditable_type))->plural()->lower() . '.show';
                                    if (Route::has($routeName)) {
                                        $resourceRoute = route($routeName, $audit->auditable_id);
                                    }
                                } catch (\Exception $e) {}
                            }
                        @endphp

                        @if($resourceRoute)
                            <a href="{{ $resourceRoute }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 font-medium underline decoration-indigo-500/30">
                                #{{ $audit->auditable_id }}
                            </a>
                        @else
                            <span class="text-slate-500">#{{ $audit->auditable_id }}</span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Context Card --}}
            <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-slate-800 p-6 shadow-sm flex flex-col gap-4">
                <h2 class="font-semibold text-slate-800 dark:text-slate-200 border-b border-slate-50 dark:border-slate-800 pb-2">Context</h2>

                <div class="grid grid-cols-3 gap-1">
                    <span class="text-xs text-slate-400">IP Address</span>
                    <span class="col-span-2 text-sm font-mono text-slate-700 dark:text-slate-300">{{ $audit->ip_address }}</span>
                </div>

                <div class="grid grid-cols-3 gap-1 overflow-hidden">
                    <span class="text-xs text-slate-400">URL</span>
                    <span class="col-span-2 text-sm text-slate-700 dark:text-slate-300 break-all">{{ $audit->url }}</span>
                </div>

                <div class="grid grid-cols-1 gap-1">
                    <span class="text-xs text-slate-400">User Agent</span>
                    <span class="text-xs text-slate-500 italic">{{ $audit->user_agent }}</span>
                </div>
            </div>
        </div>

        {{-- Changes --}}
        <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-slate-800 p-6 shadow-sm flex flex-col gap-6">
            <h2 class="font-semibold text-slate-800 dark:text-slate-200 border-b border-slate-50 dark:border-slate-800 pb-2">Data Changes</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                {{-- Old Values --}}
                <div class="flex flex-col gap-3">
                    <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">Old Values</span>
                    @if($audit->old_values)
                        <div class="bg-slate-50 dark:bg-slate-950 p-4 rounded-xl border border-slate-100 dark:border-slate-800 overflow-auto max-h-96">
                            <pre class="text-xs text-slate-700 dark:text-slate-300">{{ json_encode($audit->old_values, JSON_PRETTY_PRINT) }}</pre>
                        </div>
                    @else
                        <div class="text-sm text-slate-400 italic">No previous values.</div>
                    @endif
                </div>

                {{-- New Values --}}
                <div class="flex flex-col gap-3">
                    <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">New Values</span>
                    @if($audit->new_values)
                        <div class="bg-slate-50 dark:bg-slate-950 p-4 rounded-xl border border-slate-100 dark:border-slate-800 overflow-auto max-h-96">
                            <pre class="text-xs text-slate-700 dark:text-slate-300">{{ json_encode($audit->new_values, JSON_PRETTY_PRINT) }}</pre>
                        </div>
                    @else
                        <div class="text-sm text-slate-400 italic">No new values (deleted).</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
