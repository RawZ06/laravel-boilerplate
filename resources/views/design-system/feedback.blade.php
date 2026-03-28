{{-- resources/views/design-system/feedback.blade.php --}}

@extends('layouts.design-system')

@section('content')
        <div class="max-w-5xl mx-auto px-8 py-12 flex flex-col gap-16">

            {{-- BADGE --}}
            <section class="flex flex-col divide-y divide-gray-100 dark:divide-slate-800 rounded-2xl border border-gray-100 dark:border-slate-800 bg-white dark:bg-slate-900 shadow-xs overflow-hidden">

                <div class="px-6 py-4">
                    <span class="text-xs font-medium tracking-widest text-gray-400 dark:text-slate-500 uppercase">01</span>
                    <h2 class="text-sm font-semibold text-gray-800 dark:text-slate-100">Badge</h2>
                    <p class="text-xs text-gray-400 dark:text-slate-500 mt-0.5">Status and category labels</p>
                </div>

                {{-- 01 — Variants --}}
                <div class="flex items-start gap-8 px-6 py-8">
                    <div class="flex flex-col gap-0.5 w-56 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">01 — variants</code>
                        <span class="text-xs text-gray-400 dark:text-slate-500">The 6 available colors</span>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <x-feedback.badge variant="gray">Gray</x-feedback.badge>
                        <x-feedback.badge variant="indigo">Indigo</x-feedback.badge>
                        <x-feedback.badge variant="green">Green</x-feedback.badge>
                        <x-feedback.badge variant="red">Red</x-feedback.badge>
                        <x-feedback.badge variant="yellow">Yellow</x-feedback.badge>
                        <x-feedback.badge variant="blue">Blue</x-feedback.badge>
                    </div>
                </div>

                {{-- 02 — With dot --}}
                <div class="flex items-start gap-8 px-6 py-8">
                    <div class="flex flex-col gap-0.5 w-56 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">02 — dot</code>
                        <span class="text-xs text-gray-400 dark:text-slate-500">Status indicator with colored dot</span>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <x-feedback.badge variant="green" :dot="true">Active</x-feedback.badge>
                        <x-feedback.badge variant="red" :dot="true">Inactive</x-feedback.badge>
                        <x-feedback.badge variant="yellow" :dot="true">Pending</x-feedback.badge>
                        <x-feedback.badge variant="gray" :dot="true">Archived</x-feedback.badge>
                    </div>
                </div>

                {{-- 03 — Sizes --}}
                <div class="flex items-start gap-8 px-6 py-8">
                    <div class="flex flex-col gap-0.5 w-56 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">03 — sizes</code>
                        <span class="text-xs text-gray-400 dark:text-slate-500">sm, md, lg</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <x-feedback.badge variant="indigo" size="sm">Small</x-feedback.badge>
                        <x-feedback.badge variant="indigo" size="md">Medium</x-feedback.badge>
                        <x-feedback.badge variant="indigo" size="lg">Large</x-feedback.badge>
                    </div>
                </div>

            </section>

            {{-- ALERT --}}
            <section class="flex flex-col divide-y divide-gray-100 dark:divide-slate-800 rounded-2xl border border-gray-100 dark:border-slate-800 bg-white dark:bg-slate-900 shadow-xs overflow-hidden">

                <div class="px-6 py-4">
                    <span class="text-xs font-medium tracking-widest text-gray-400 dark:text-slate-500 uppercase">02</span>
                    <h2 class="text-sm font-semibold text-gray-800 dark:text-slate-100">Alert</h2>
                    <p class="text-xs text-gray-400 dark:text-slate-500 mt-0.5">Contextual feedback messages within the page</p>
                </div>

                {{-- 01 — Variants --}}
                <div class="flex items-start gap-8 px-6 py-8">
                    <div class="flex flex-col gap-0.5 w-56 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">01 — variants</code>
                        <span class="text-xs text-gray-400 dark:text-slate-500">info, success, warning, error</span>
                    </div>
                    <div class="flex flex-col gap-3 flex-1">
                        <x-feedback.alert variant="info">Useful information to display.</x-feedback.alert>
                        <x-feedback.alert variant="success">Operation completed successfully.</x-feedback.alert>
                        <x-feedback.alert variant="warning">Warning, this action is irreversible.</x-feedback.alert>
                        <x-feedback.alert variant="error">An error occurred, please try again.</x-feedback.alert>
                    </div>
                </div>

                {{-- 02 — With title --}}
                <div class="flex items-start gap-8 px-6 py-8">
                    <div class="flex flex-col gap-0.5 w-56 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">02 — with title</code>
                        <span class="text-xs text-gray-400 dark:text-slate-500">Title + description</span>
                    </div>
                    <div class="flex flex-col gap-3 flex-1">
                        <x-feedback.alert variant="success" title="Successfully saved">Changes have been saved.</x-feedback.alert>
                        <x-feedback.alert variant="error" title="Validation error">Please correct the red fields before continuing.</x-feedback.alert>
                    </div>
                </div>

                {{-- 03 — Dismissible --}}
                <div class="flex items-start gap-8 px-6 py-8">
                    <div class="flex flex-col gap-0.5 w-56 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">03 — dismissible</code>
                        <span class="text-xs text-gray-400 dark:text-slate-500">Closable by user</span>
                    </div>
                    <div class="flex flex-col gap-3 flex-1">
                        <x-feedback.alert variant="info" title="Update available" :dismissible="true">A new version is available, consider refreshing.</x-feedback.alert>
                        <x-feedback.alert variant="warning" :dismissible="true">Your session expires in 5 minutes.</x-feedback.alert>
                    </div>
                </div>

            </section>


        </div>
@endsection
