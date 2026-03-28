@extends('layouts.skeleton')

@section('body')
    <div class="bg-[#fafafa] dark:bg-slate-950 min-h-screen font-sans flex text-gray-900 dark:text-slate-200">

        {{-- Sidebar --}}
        <aside class="w-60 shrink-0 bg-white dark:bg-slate-900 border-r border-gray-100 dark:border-slate-800 sticky top-0 h-screen flex flex-col">

            {{-- Logo --}}
            <div class="h-14 flex items-center px-6 border-b border-gray-100 dark:border-slate-800">
                <span class="text-xs font-medium tracking-widest text-gray-400 dark:text-slate-500 uppercase">Design System</span>
            </div>

            {{-- Nav --}}
            <nav class="flex-1 px-3 py-4 flex flex-col gap-6 overflow-y-auto">

                @php
                    $navItems = [
                        'Foundations' => [
                            ['label' => 'Home',    'route' => 'design-system.index',   'icon' => 'fa-solid fa-house'],
                        ],
                        'Components' => [
                            ['label' => 'Buttons',    'route' => 'design-system.buttons', 'icon' => 'fa-solid fa-computer-mouse'],
                            ['label' => 'Form',       'route' => 'design-system.form',    'icon' => 'fa-solid fa-pen-to-square'],
                            ['label' => 'Table',       'route' => 'design-system.table',    'icon' => 'fa-solid fa-table'],
                            ['label' => 'Feedback',       'route' => 'design-system.feedback',    'icon' => 'fa-solid fa-message'],
                            ['label' => 'Overlay',       'route' => 'design-system.overlay',    'icon' => 'fa-solid fa-layer-group'],
                            ['label' => 'Nav',       'route' => 'design-system.nav',    'icon' => 'fa-solid fa-bars'],
                        ],
                    ];
                @endphp

                @foreach($navItems as $group => $items)
                    <div class="flex flex-col gap-0.5">
                        <span
                            class="text-[10px] font-semibold tracking-widest text-gray-300 dark:text-slate-600 uppercase px-3 mb-1">{{ $group }}</span>
                        @foreach($items as $item)
                            @php $active = request()->routeIs($item['route']); @endphp
                            <a href="{{ route($item['route']) }}"
                               class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm transition-all duration-100
                               {{ $active
                                   ? 'bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 font-medium'
                                   : 'text-gray-500 dark:text-slate-400 hover:bg-gray-50 dark:hover:bg-slate-800 hover:text-gray-800 dark:hover:text-slate-200'
                               }}">
                                <i class="{{ $item['icon'] }} w-4 text-center text-xs"></i>
                                {{ $item['label'] }}
                            </a>
                        @endforeach
                    </div>
                @endforeach

            </nav>

            {{-- Footer --}}
            <div class="px-4 py-4 border-t border-gray-100 dark:border-slate-800 flex flex-col gap-1">
                <a href="{{ route('backend.index') }}"
                   class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm text-gray-500 dark:text-slate-400 hover:bg-gray-50 dark:hover:bg-slate-800 hover:text-gray-800 dark:hover:text-slate-200 transition-all duration-100">
                    <i class="fa-solid fa-arrow-left w-4 text-center text-xs"></i>
                    Back to admin
                </a>
                <span class="text-xs text-gray-300 dark:text-slate-600 px-3">v1.0.0</span>
            </div>

        </aside>

        {{-- Main --}}
        <div class="flex-1 flex flex-col min-h-screen">

            {{-- Topbar --}}
            <div class="border-b border-gray-100 dark:border-slate-800 bg-white dark:bg-slate-900 sticky top-0 z-10">
                <div class="px-10 h-14 flex items-center justify-between">
                    <h1 class="text-sm font-medium text-gray-900 dark:text-slate-200">{{ $title ?? 'Design System' }}</h1>
                    @isset($tag)
                        <code class="text-xs text-gray-400 dark:text-slate-500">{{ $tag }}</code>
                    @endisset
                    <div class="flex items-center h-full px-2">
                        <x-overlay.dropdown align="right">
                            <x-slot:trigger>
                                <button type="button" class="w-10 h-10 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition-colors flex items-center justify-center rounded-lg hover:bg-gray-100 dark:hover:bg-slate-800 border border-transparent hover:border-gray-200 dark:hover:border-slate-700">
                                    <i x-show="theme === 'light'" class="fa-solid fa-sun text-lg" x-cloak></i>
                                    <i x-show="theme === 'dark'" class="fa-solid fa-moon text-lg" x-cloak></i>
                                    <i x-show="theme === 'system'" class="fa-solid fa-desktop text-lg" x-cloak></i>
                                </button>
                            </x-slot:trigger>

                            <x-overlay.dropdown-item @click="setTheme('light')" icon="fa-solid fa-sun">
                                <span class="flex-1 text-left text-sm">Light</span>
                                <i x-show="theme === 'light'" class="fa-solid fa-check ml-auto text-indigo-500" x-cloak></i>
                            </x-overlay.dropdown-item>
                            <x-overlay.dropdown-item @click="setTheme('dark')" icon="fa-solid fa-moon">
                                <span class="flex-1 text-left text-sm">Dark</span>
                                <i x-show="theme === 'dark'" class="fa-solid fa-check ml-auto text-indigo-500" x-cloak></i>
                            </x-overlay.dropdown-item>
                            <x-overlay.dropdown-item @click="setTheme('system')" icon="fa-solid fa-desktop">
                                <span class="flex-1 text-left text-sm">System</span>
                                <i x-show="theme === 'system'" class="fa-solid fa-check ml-auto text-indigo-500" x-cloak></i>
                            </x-overlay.dropdown-item>
                        </x-overlay.dropdown>
                    </div>
                </div>
            </div>

            {{-- Content --}}
            <main class="flex-1 px-10 py-12">
                @yield('content')
            </main>

        </div>
    </div>
    <x-feedback.toast position="bottom-right" />
@endsection
