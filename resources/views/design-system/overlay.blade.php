{{-- resources/views/design-system/overlay.blade.php --}}

@extends('layouts.design-system')

@section('content')
        <div class="max-w-5xl mx-auto px-8 py-12 flex flex-col gap-16">

            {{-- MODAL --}}
            <section class="flex flex-col divide-y divide-gray-100 dark:divide-slate-800 rounded-2xl border border-gray-100 dark:border-slate-800 bg-white dark:bg-slate-900 shadow-xs overflow-hidden">

                <div class="px-6 py-4">
                    <span class="text-xs font-medium tracking-widest text-gray-400 dark:text-slate-500 uppercase">01</span>
                    <h2 class="text-sm font-semibold text-gray-800 dark:text-slate-100">Modal</h2>
                    <p class="text-xs text-gray-400 dark:text-slate-500 mt-0.5">Dialog and confirmation windows</p>
                </div>

                {{-- 01 — Basic --}}
                <div class="flex items-start gap-8 px-6 py-8">
                    <div class="flex flex-col gap-0.5 w-56 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">01 — basic</code>
                        <span class="text-xs text-gray-400 dark:text-slate-500">Header + body + footer</span>
                    </div>
                    <div>
                        <x-overlay.modal name="demo-basic" size="md">
                            <x-slot:trigger>
                                <x-button onclick="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'demo-basic' }))">
                                    Open modal
                                </x-button>
                            </x-slot:trigger>

                            <x-slot:header>
                                <p class="text-sm font-semibold text-gray-800 dark:text-slate-200">Modal title</p>
                                <p class="text-xs text-gray-400 dark:text-slate-500">Optional subtitle</p>
                            </x-slot:header>

                            <p class="text-sm text-gray-600 dark:text-slate-400">Modal content. You can put any HTML content, form, text, etc. here.</p>

                            <x-slot:footer>
                                <x-button variant="ghost" onclick="window.dispatchEvent(new CustomEvent('close-modal', { detail: 'demo-basic' }))">
                                    Cancel
                                </x-button>
                                <x-button variant="primary">Confirm</x-button>
                            </x-slot:footer>
                        </x-overlay.modal>
                    </div>
                </div>

                {{-- 02 — Confirmation danger --}}
                <div class="flex items-start gap-8 px-6 py-8">
                    <div class="flex flex-col gap-0.5 w-56 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">02 — danger confirmation</code>
                        <span class="text-xs text-gray-400 dark:text-slate-500">Destructive action</span>
                    </div>
                    <div>
                        <x-overlay.modal name="demo-danger" size="sm">
                            <x-slot:trigger>
                                <x-button variant="danger" onclick="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'demo-danger' }))">
                                    Delete
                                </x-button>
                            </x-slot:trigger>

                            <x-slot:header>
                                <p class="text-sm font-semibold text-gray-800 dark:text-slate-200">Delete element</p>
                            </x-slot:header>

                            <div class="flex flex-col gap-3">
                                <div class="flex items-center justify-center w-12 h-12 rounded-full bg-red-50 dark:bg-rose-500/10 mx-auto">
                                    <i class="fa-solid fa-trash text-red-500 dark:text-rose-400"></i>
                                </div>
                                <p class="text-sm text-gray-600 dark:text-slate-400 text-center">This action is irreversible. Are you sure you want to delete this element?</p>
                            </div>

                            <x-slot:footer>
                                <x-button variant="ghost" onclick="window.dispatchEvent(new CustomEvent('close-modal', { detail: 'demo-danger' }))">
                                    Cancel
                                </x-button>
                                <x-button variant="danger">Delete</x-button>
                            </x-slot:footer>
                        </x-overlay.modal>
                    </div>
                </div>

                {{-- 03 — Sizes --}}
                <div class="flex items-start gap-8 px-6 py-8">
                    <div class="flex flex-col gap-0.5 w-56 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">03 — sizes</code>
                        <span class="text-xs text-gray-400 dark:text-slate-500">sm, md, lg, xl</span>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        @foreach(['sm', 'md', 'lg', 'xl'] as $s)
                            <x-overlay.modal name="demo-size-{{ $s }}" size="{{ $s }}">
                                <x-slot:trigger>
                                    <x-button variant="outline" onclick="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'demo-size-{{ $s }}' }))">
                                        {{ strtoupper($s) }}
                                    </x-button>
                                </x-slot:trigger>

                                <x-slot:header>
                                    <p class="text-sm font-semibold text-gray-800 dark:text-slate-200">Modal size={{ $s }}</p>
                                </x-slot:header>

                                <p class="text-sm text-gray-600 dark:text-slate-400">Content for a <strong>{{ $s }}</strong> size modal.</p>

                                <x-slot:footer>
                                    <x-button variant="ghost" onclick="window.dispatchEvent(new CustomEvent('close-modal', { detail: 'demo-size-{{ $s }}' }))">
                                        Close
                                    </x-button>
                                </x-slot:footer>
                            </x-overlay.modal>
                        @endforeach
                    </div>
                </div>

            </section>

            {{-- DROPDOWN --}}
            <section class="flex flex-col divide-y divide-gray-100 dark:divide-slate-800 rounded-2xl border border-gray-100 dark:border-slate-800 bg-white dark:bg-slate-900 shadow-xs overflow-hidden">

                <div class="px-6 py-4">
                    <span class="text-xs font-medium tracking-widest text-gray-400 dark:text-slate-500 uppercase">02</span>
                    <h2 class="text-sm font-semibold text-gray-800 dark:text-slate-100">Dropdown</h2>
                    <p class="text-xs text-gray-400 dark:text-slate-500 mt-0.5">Contextual menus and actions</p>
                </div>

                {{-- 01 — Basic --}}
                <div class="flex items-start gap-8 px-6 py-8">
                    <div class="flex flex-col gap-0.5 w-56 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">01 — basic</code>
                        <span class="text-xs text-gray-400 dark:text-slate-500">Simple menu with icons</span>
                    </div>
                    <x-overlay.dropdown>
                        <x-slot:trigger>
                            <x-button variant="outline">
                                Actions <i class="fa-solid fa-chevron-down text-xs ml-1"></i>
                            </x-button>
                        </x-slot:trigger>

                        <x-overlay.dropdown-item icon="fa-solid fa-pen">Edit</x-overlay.dropdown-item>
                        <x-overlay.dropdown-item icon="fa-solid fa-copy">Duplicate</x-overlay.dropdown-item>
                        <x-overlay.dropdown-item icon="fa-solid fa-share">Share</x-overlay.dropdown-item>
                    </x-overlay.dropdown>
                </div>

                {{-- 02 — Divider and danger --}}
                <div class="flex items-start gap-8 px-6 py-8">
                    <div class="flex flex-col gap-0.5 w-56 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">02 — divider + danger</code>
                        <span class="text-xs text-gray-400 dark:text-slate-500">Separator and destructive action</span>
                    </div>
                    <x-overlay.dropdown>
                        <x-slot:trigger>
                            <x-button variant="outline">
                                Options <i class="fa-solid fa-chevron-down text-xs ml-1"></i>
                            </x-button>
                        </x-slot:trigger>

                        <x-overlay.dropdown-item icon="fa-solid fa-pen">Edit</x-overlay.dropdown-item>
                        <x-overlay.dropdown-item icon="fa-solid fa-copy">Duplicate</x-overlay.dropdown-item>
                        <x-overlay.dropdown-divider />
                        <x-overlay.dropdown-item icon="fa-solid fa-trash" variant="danger">Delete</x-overlay.dropdown-item>
                    </x-overlay.dropdown>
                </div>

                {{-- 03 — Alignment --}}
                <div class="flex items-start gap-8 px-6 py-8">
                    <div class="flex flex-col gap-0.5 w-56 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">03 — alignment</code>
                        <span class="text-xs text-gray-400 dark:text-slate-500">left, center, right</span>
                    </div>
                    <div class="flex gap-4">
                        @foreach(['left', 'center', 'right'] as $align)
                            <x-overlay.dropdown align="{{ $align }}">
                                <x-slot:trigger>
                                    <x-button variant="outline">{{ ucfirst($align) }}</x-button>
                                </x-slot:trigger>
                                <x-overlay.dropdown-item icon="fa-solid fa-pen">Edit</x-overlay.dropdown-item>
                                <x-overlay.dropdown-item icon="fa-solid fa-trash" variant="danger">Delete</x-overlay.dropdown-item>
                            </x-overlay.dropdown>
                        @endforeach
                    </div>
                </div>

                {{-- 04 — Icon trigger --}}
                <div class="flex items-start gap-8 px-6 py-8">
                    <div class="flex flex-col gap-0.5 w-56 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">04 — icon trigger</code>
                        <span class="text-xs text-gray-400 dark:text-slate-500">Kebab menu button</span>
                    </div>
                    <x-overlay.dropdown>
                        <x-slot:trigger>
                            <button class="flex items-center justify-center w-8 h-8 rounded-lg text-gray-400 dark:text-slate-500 hover:bg-gray-100 dark:hover:bg-slate-800 hover:text-gray-600 dark:hover:text-slate-300 transition-colors cursor-pointer">
                                <i class="fa-solid fa-ellipsis-vertical text-sm"></i>
                            </button>
                        </x-slot:trigger>
                        <x-overlay.dropdown-item icon="fa-solid fa-pen">Edit</x-overlay.dropdown-item>
                        <x-overlay.dropdown-item icon="fa-solid fa-copy">Duplicate</x-overlay.dropdown-item>
                        <x-overlay.dropdown-divider />
                        <x-overlay.dropdown-item icon="fa-solid fa-trash" variant="danger">Delete</x-overlay.dropdown-item>
                    </x-overlay.dropdown>
                </div>

            </section>


        </div>
@endsection
