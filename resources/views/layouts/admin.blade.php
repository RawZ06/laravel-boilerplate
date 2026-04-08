@extends('layouts.skeleton')

@section('head')
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
@endsection

@php
    $menu = [
        'Nav' => [
            ['icon' => 'fa-solid fa-gauge', 'label' => 'Dashboard', 'route' => 'backend.index'],
            ['icon' => 'fa-solid fa-users', 'label' => 'Users', 'route' => 'backend.users.index'],
        ]
    ];
@endphp

@section('body')
    <div x-data="{navOpen: window.innerWidth >= 1024}" class="min-h-screen">

        <!-- SIDEBAR NAV -->
        <nav
            id="nav"
            x-show="navOpen"
            x-on:resize.window="navOpen = window.innerWidth >= 1024"
            @click.outside="navOpen = window.innerWidth >= 1024"
            class="w-64 fixed z-10 h-full top-0 left-0 bottom-0 bg-slate-800 dark:bg-slate-900 hidden"
            x-transition:enter="transition ease duration-300"
            x-transition:enter-start="opacity-0 -translate-x-full"
            x-transition:enter-end="opacity-100 translate-x-0"
            x-transition:leave="transition ease duration-300"
            x-transition:leave-start="opacity-100 translate-x-0"
            x-transition:leave-end="opacity-0 -translate-x-full"
            x-init="() => { $el.classList.remove('hidden'); }"
        >
            <!-- Logo / Brand -->
            <div
               class="flex h-12 flex-row gap-3 items-center px-4 bg-indigo-900 dark:bg-indigo-950 group">

                {{-- Icon --}}
                <div class="w-8 h-8 rounded-xl bg-indigo-500 flex items-center justify-center shadow-sm shrink-0">
                    <i class="fa-solid fa-bolt text-white text-xs"></i>
                </div>

                {{-- Name --}}
                <div class="flex flex-col leading-tight">
                    <span class="text-white font-semibold text-sm tracking-tight">{{ config('app.name', 'Laravel') }}</span>
                    <span class="text-indigo-400 text-xs font-medium tracking-wide">Admin</span>
                </div>

            </div>

            <!-- Navigation Menu -->
            <div class="mt-4 pb-16">
                <nav class="px-2 space-y-1">
                    @foreach($menu as $section => $items)
                        <p class="text-xs text-slate-400 uppercase tracking-widest px-2 mt-4 first:mt-0 mb-1">{{ $section }}</p>
                        @foreach($items as $item)
                            <a href="{{ !empty($item['route']) ? route($item['route']) : '#' }}"
                                @class([
                                        'flex items-center gap-3 px-3 py-2 rounded-md text-sm transition-colors',
                                        'bg-slate-700 text-white dark:bg-slate-800' => !empty($item['route']) && request()->routeIs($item['route'] . '*'),
                                        'text-gray-100 hover:bg-slate-700 dark:hover:bg-slate-800' => empty($item['route']) || !request()->routeIs($item['route'] . '*'),
                                ])>
                                <i class="{{ $item['icon'] }} w-4 text-center"></i>
                                <span>{{ $item['label'] }}</span>
                            </a>
                        @endforeach
                    @endforeach
                </nav>
            </div>

            <!-- Footer sidebar -->
            <div class="absolute bottom-0 left-0 right-0 px-4 py-3 border-t border-slate-700 dark:border-slate-800">
                <a href="{{ route('design-system.index') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-md text-sm text-slate-400 hover:bg-slate-700 dark:hover:bg-slate-800 hover:text-white transition-colors">
                    <i class="fa-solid fa-palette w-4 text-center"></i>
                    <span>Design System</span>
                </a>
            </div>
        </nav>

        <!-- MAIN CONTENT -->
        <main class="flex flex-col relative lg:left-64 lg:w-[calc(100%-16rem)] min-h-screen bg-slate-100 dark:bg-slate-950">

            <!-- HEADER -->
            <header id="header" class="h-12 text-xl lg:text-base flex flex-row items-center bg-white dark:bg-slate-900 shadow-sm dark:shadow-slate-800/50">

                <!-- Mobile menu button -->
                <button @click="navOpen = true" class="lg:hidden px-4 py-2 text-gray-800 dark:text-gray-200">
                    <svg class="w-5 h-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>

                <!-- User menu -->
                <div class="flex flex-row ml-auto items-center h-full">
                    <div class="flex items-center h-full px-2">
                        <x-overlay.dropdown align="right">
                            <x-slot:trigger>
                                <x-button variant="ghost">
                                    <i x-show="theme === 'light'" class="fa-solid fa-sun text-lg" x-cloak></i>
                                    <i x-show="theme === 'dark'" class="fa-solid fa-moon text-lg" x-cloak></i>
                                    <i x-show="theme === 'system'" class="fa-solid fa-desktop text-lg" x-cloak></i>
                                </x-button>
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

                    <x-overlay.dropdown align="right">
                        <x-slot:trigger>
                            <button class="flex flex-row items-center px-4 py-2 text-gray-800 dark:text-gray-200 h-full">
                                <img class="w-8 h-8 rounded-full bg-gray-300 dark:bg-gray-700"
                                     src="https://api.dicebear.com/7.x/adventurer/svg?seed=test" alt="User avatar">
                                <span class="ml-2 text-sm">
                                    {{ auth()->user()->name }}
                                </span>
                                <svg class="w-4 h-4 ml-2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                     stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                    <path d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                        </x-slot:trigger>

                        <x-overlay.dropdown-item :href="route('frontend.home')" icon="fa-solid fa-home">
                            Back to website
                        </x-overlay.dropdown-item>

                        <x-overlay.dropdown-item href="{{ route('auth.logout') }}" icon="fa-solid fa-right-from-bracket">
                            Log out
                        </x-overlay.dropdown-item>
                    </x-overlay.dropdown>
                </div>
            </header>

            {{-- Breadcrumb --}}
            @hasSection('breadcrumb')
                <div class="px-6 py-4">
                    @yield('breadcrumb')
                </div>
            @endif

            <!-- PAGE CONTENT -->
            <div class="grow p-6 flex flex-col gap-8">
                @foreach(['success', 'error', 'warning', 'info'] as $type)
                    @if(session($type))
                        <x-feedback.alert :variant="$type" :dismissible="true">
                            {{ session($type) }}
                        </x-feedback.alert>
                    @endif
                @endforeach
                @yield('content')
            </div>

            <!-- FOOTER -->
            <footer id="footer" class="text-slate-400 text-xs px-3 py-1.5 border-t border-slate-200 dark:border-slate-800 mt-2">
                &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.
            </footer>
        </main>

    </div>
@endsection
