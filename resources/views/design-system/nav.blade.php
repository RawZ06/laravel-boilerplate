@extends('layouts.design-system')

@section('content')
    <div class="max-w-5xl mx-auto px-8 py-12 flex flex-col gap-16">

        {{-- BREADCRUMB --}}
        <section class="flex flex-col divide-y divide-gray-100 dark:divide-slate-800 rounded-2xl border border-gray-100 dark:border-slate-800 bg-white dark:bg-slate-900 shadow-xs overflow-hidden">

            <div class="px-6 py-4">
                <span class="text-xs font-medium tracking-widest text-gray-400 dark:text-slate-500 uppercase">01</span>
                <h2 class="text-sm font-semibold text-gray-800 dark:text-slate-100">Breadcrumb</h2>
                <p class="text-xs text-gray-400 dark:text-slate-500 mt-0.5">Breadcrumb and hierarchical navigation</p>
            </div>

            {{-- 01 — Basic --}}
            <div class="flex items-start gap-8 px-6 py-8">
                <div class="flex flex-col gap-0.5 w-56 shrink-0">
                    <code class="text-xs font-medium text-indigo-500">01 — basic</code>
                    <span class="text-xs text-gray-400 dark:text-slate-500">Simple links</span>
                </div>
                <x-nav.breadcrumb :items="[
                ['label' => 'Home', 'url' => '#'],
                ['label' => 'Settings', 'url' => '#'],
                ['label' => 'Profile'],
            ]" />
            </div>

                {{-- 02 — With icon --}}
                <div class="flex items-start gap-8 px-6 py-8">
                    <div class="flex flex-col gap-0.5 w-56 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">02 — with icon</code>
                        <span class="text-xs text-gray-400 dark:text-slate-500">Icon on the first element</span>
                    </div>
                    <x-nav.breadcrumb :items="[
                    ['label' => 'Home', 'url' => '#', 'icon' => 'fa-solid fa-house'],
                    ['label' => 'Projects', 'url' => '#'],
                    ['label' => 'Design System', 'url' => '#'],
                    ['label' => 'Navigation'],
                ]" />
                </div>

                {{-- 03 — Single level --}}
                <div class="flex items-start gap-8 px-6 py-8">
                    <div class="flex flex-col gap-0.5 w-56 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">03 — single level</code>
                        <span class="text-xs text-gray-400 dark:text-slate-500">Root page</span>
                    </div>
                    <x-nav.breadcrumb :items="[
                    ['label' => 'Dashboard', 'icon' => 'fa-solid fa-house'],
                ]" />
                </div>

                {{-- 04 — Long path --}}
                <div class="flex items-start gap-8 px-6 py-8">
                    <div class="flex flex-col gap-0.5 w-56 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">04 — long path</code>
                        <span class="text-xs text-gray-400 dark:text-slate-500">Multiple levels</span>
                    </div>
                    <x-nav.breadcrumb :items="[
                    ['label' => 'Home', 'url' => '#', 'icon' => 'fa-solid fa-house'],
                    ['label' => 'Organization', 'url' => '#'],
                    ['label' => 'Teams', 'url' => '#'],
                    ['label' => 'Frontend', 'url' => '#'],
                    ['label' => 'John Doe'],
                ]" />
                </div>

        </section>

    </div>
@endsection
