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
            ['icon' => 'fa-solid fa-users', 'label' => 'Users'],
        ],
        'Settings' => [
            ['icon' => 'fa-solid fa-gear', 'label' => 'Config'],
        ],
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
            <a href="#"
               class="flex h-12 flex-row gap-2 items-center text-gray-100 p-2 justify-center bg-indigo-800 dark:bg-indigo-950 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 245.44 236.61" class="w-10 h-10">
                    <path
                        d="M125.13.06h18.72a3.08,3.08,0,0,1,2.58,1c1.37,1.45,3.57,1.46,5.37,1.5,6.76.14,13.06,2.45,19.35,4.34,3.64,1.1,7.59,1.95,11,4.23,2,1.38,4.58,2.16,6.88,3.27a107.57,107.57,0,0,1,25.4,17.49,108.44,108.44,0,0,1,12.05,12.87c2.44,3,5.43,5.83,6.63,9.78.22.73.34,1.32-.48,1.64a1,1,0,0,1-1.41-.68c-.35-2.44-2.58-3.33-3.93-4.91a128.31,128.31,0,0,0-9.77-10.54,16.92,16.92,0,0,0-5.44-3.75,30.66,30.66,0,0,1-6.48-3.9c-5.14-3.63-10.88-5.93-16.49-8.56-3.75-1.76-7.41-4-11.37-4.93-5.16-1.16-9.84-4.56-15.44-3.63-3.33.55-6.27-1.12-9.46-1.44a84.71,84.71,0,0,0-17.87.4c-3.6.4-7.35.28-10.69,1.74-3.87,1.71-8.19,1.73-12,3.81-2.72,1.49-5.85,2.08-8.72,3.44A127.33,127.33,0,0,0,80,37.73,88.22,88.22,0,0,0,65.9,51.59,93.71,93.71,0,0,0,55.51,67.72,146,146,0,0,0,47.33,88c-2.46,7.18-3.26,14.74-4.95,22.1a38.17,38.17,0,0,0,.55,17.71c.69,2.84,1.09,5.69,1.52,8.56,1.23,8.15,3.86,15.93,6.8,23.54a97,97,0,0,0,10.5,19.54,87.93,87.93,0,0,0,14.31,16.75A108.3,108.3,0,0,0,91.35,207.3c4.5,2.75,9.29,4.88,13.88,7.39a54.56,54.56,0,0,0,8.52,3.23c7.68,2.63,15.69,3.86,23.78,4.87,10.08,1.26,19.92-.31,29.71-1.82a45.6,45.6,0,0,0,13.92-4.29c2.56-1.32,5.41-1.91,8.06-3.18a214.22,214.22,0,0,0,24.48-13.89,43.67,43.67,0,0,0,10.63-10.56c2.51-3.33,5.47-6.41,7.75-9.91,1.58-2.44,4.87-3.53,5.26-6.84,0-.21.47-.5.73-.52.51,0,.67.42.66.86,0,1.28.35,2.7-1.07,3.61a2.13,2.13,0,0,0-.86.85c-3,7.51-8.8,12.93-13.68,19.08-1.83,2.31-3.79,4.49-5.78,6.61s-4.67,3.31-6.85,5.22a95,95,0,0,1-12,9.05c-2.89,1.81-6.13,3.06-9.14,4.68-2.24,1.2-4.44,2.47-6.65,3.69a54.65,54.65,0,0,1-11.09,4.3c-13.61,4-27.43,6.82-41.8,6.88-12.36,0-24.57-.86-36.53-3.76a87.88,87.88,0,0,1-13.67-4.37c-3.47-1.47-7-2.93-10.44-4.48a74.63,74.63,0,0,1-12.39-7.08c-3.38-2.38-6.79-4.7-10.08-7.21-1.63-1.26-3.24-2.58-4.77-3.91A128.44,128.44,0,0,1,24.63,188c-3.91-5-7-10.57-10.35-16-5.08-8.21-7.9-17.3-10.5-26.39A114.59,114.59,0,0,1,.31,125.05c-1.12-11.65,1-23,3.17-34.3A99.3,99.3,0,0,1,9.56,70.6c2.57-6,5.18-12.13,8.8-17.64A125.48,125.48,0,0,1,31.63,35.7,94.66,94.66,0,0,1,47.77,21.82,118.46,118.46,0,0,1,67,11.28c7.27-3.14,14.86-5,22.33-7.37,4-1.25,8.52-.35,12.21-2C105.43.1,109.22.1,113.16,0s8,0,12,0Z"
                        style="fill:currentColor"/>
                    <path
                        d="M64,139.12a7.35,7.35,0,0,1,1,3.48c.11,1.59.3,3.12,2,4A2.85,2.85,0,0,1,68,148c3.49,8.53,9.33,15.44,15,22.51,5.95,7.4,13.61,12.51,21.63,17.13,5,2.87,10.41,5.51,16,6.46,9.14,1.56,18.4,3.76,27.85,1.48,3.12-.75,6.47-.61,9.53-1.5a74.52,74.52,0,0,0,17.9-7.48c2.72-1.63,5.69-3.06,8.28-4.83a82.78,82.78,0,0,0,12.44-10.65c3.32-3.4,6.65-7,8.66-11.12,2.73-5.58,5.94-10.94,7.68-17.17,1.87-6.71,2.18-13.55,3.65-20.24.64-2.93,1.78-3.9,4.78-3.9,6.73,0,13.47,0,20.2,0,2.87,0,3.57.85,3.73,3.73a55.68,55.68,0,0,1-2.84,20.07c-1.48,4.7-3.47,9.13-5.4,13.64a73.18,73.18,0,0,1-4.47,8.63,79.62,79.62,0,0,1-9.2,12.82c-4.11,4.54-8.13,9.16-13.23,12.7-3.69,2.57-7.2,5.35-11.23,7.45-2.39,1.24-4.78,2.54-7.13,3.86a56.91,56.91,0,0,1-6.76,2.88c-11.42,4.61-23.37,6.11-35.56,5.83a110.41,110.41,0,0,1-17.59-1.51c-2.75-.51-5.36-1.73-8.1-2.37A73.74,73.74,0,0,1,107.19,200,69.8,69.8,0,0,1,92.29,190a128.54,128.54,0,0,1-13.16-13.14,64.15,64.15,0,0,1-8-12.43c-1.48-3-2.61-6.06-4.25-8.92a9.57,9.57,0,0,1-1.12-3.26A14.44,14.44,0,0,0,64,146.7C62.66,144.53,63,141.94,64,139.12Z"
                        style="fill:currentColor"/>
                    <path
                        d="M231.59,117.67h-9.48c-3.32,0-4.49-1.2-5.56-4.43-1.36-4.11-1.14-8.46-2.19-12.57-2.49-9.77-6.2-19.1-12.2-27.26A74.75,74.75,0,0,0,184.1,56.22c-3.9-2.68-8-4.93-12.07-7.26a51.33,51.33,0,0,0-8.49-3.49c-11-3.83-22.25-4.76-33.84-3.86a70.4,70.4,0,0,0-24.64,7,75.72,75.72,0,0,0-15,10c-4,3.22-7.74,6.68-11.52,10.12a55.08,55.08,0,0,0-4,4.38c-.51.58-.82,1.81-1.79,1.24-1.21-.71-.72-2-.11-2.87,1.81-2.62,3.18-5.52,5.38-7.92,2-2.23,3.86-4.66,5.73-7,2.82-3.56,6.75-6,10.3-8.8,3.22-2.55,6.36-5.28,10-7.11,3.43-1.7,6.83-3.47,10.36-5,3.84-1.67,8-2.26,11.7-4.1,3.14-1.54,6.62-1.43,10-2,6.14-1,12.32-2.4,18.55-1.59,7.93,1,16,1.21,23.65,4.21,3,1.17,6.13,1.8,9.15,3a105.07,105.07,0,0,1,21.2,12.08A74.66,74.66,0,0,1,223.12,61a96.1,96.1,0,0,1,10.71,15.74c2.55,4.8,5.39,9.54,7.1,14.59,2.55,7.54,5.15,15.27,4.36,23.51a2.82,2.82,0,0,1-3.23,2.91c-3.49-.1-7,0-10.47,0Z"
                        style="fill:currentColor"/>
                    <path
                        d="M147.88,69.16c4-.07,3.87.19,4.76,3.8,2,8,2.3,16.25,4.83,24.09a38.17,38.17,0,0,1,.79,4.16c1.51,7.2,3.6,14.26,5.19,21.43,1.21,5.5,2.91,10.86,4.34,16.28A62.83,62.83,0,0,0,172.38,152c1.47,2.81,2,6,4.16,8.63,1.42,1.69-.18,5.24-2.55,6.24a75.74,75.74,0,0,1-9.11,3.21c-3.2.87-5.22-.54-6.29-3.6-3.16-9-5.62-18.11-8.35-27.19a41,41,0,0,1-.75-4.34c-.44-2.4-1.81-3.12-3.83-3.14-5.83,0-11.65,0-17.47,0a2.78,2.78,0,0,0-2.71,1.85,68.55,68.55,0,0,0-3,8.12c-1.9,6.86-3.24,13.83-4.93,20.72-.7,2.86-2,3.67-5,3.73-3.11.07-6.08-.84-9.11-1.28-2.85-.41-3.52-1.66-2.89-4.51a122.42,122.42,0,0,1,6.27-19.83c1.84-4.5,2.93-9.13-1.06-13.39-1.3-1.38-1.59-3.52-1.72-5.39s1.29-2.69,3.12-2.73c2.32,0,4.67.06,6.59-1.64a5.54,5.54,0,0,0,2.07-2.75c.71-3.86,2.62-7.3,3.76-11,1.83-5.91,4.16-11.65,6.54-17.36.73-1.74,2.31-2,3.78-2.51a6.28,6.28,0,0,1,1.24-.15c5.52-.74,6-1.23,5.79-6.76-.11-4,0-4.07,4-5.72C143.3,70.19,145.55,68.86,147.88,69.16Zm-10.17,48.55v0a21,21,0,0,0,3.72,0c1.73-.31,3-1.17,2.79-3.31-.58-5.54-2.3-10.8-3.76-16.12-.21-.77-.37-1.83-1.33-1.92-1.2-.11-1.27,1.11-1.61,1.9-1.69,4-3.3,8.05-5,12.05-2.43,5.62-1.34,7.38,4.72,7.42Z"
                        style="fill:currentColor"/>
                </svg>
                <span>Admin</span>
            </a>

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

                    <div class="relative h-full flex items-center" x-data="{userMenuOpen: false}">
                        <button @click="userMenuOpen = !userMenuOpen"
                                class="flex flex-row items-center px-4 py-2 text-gray-800 dark:text-gray-200 h-full">
                            <img class="w-8 h-8 rounded-full bg-gray-300 dark:bg-gray-700"
                                 src="https://api.dicebear.com/7.x/adventurer/svg?seed=test" alt="User avatar">
                            <span class="ml-2 text-sm">John Doe</span>
                            <svg class="w-4 h-4 ml-2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                 stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <!-- Backdrop -->
                        <div
                            x-show="userMenuOpen"
                            @click="userMenuOpen = false"
                            x-init="() => { $el.classList.remove('hidden'); }"
                            class="fixed inset-0 h-full w-full z-10 hidden"
                        ></div>

                        <!-- Dropdown -->
                        <div
                            x-show="userMenuOpen"
                            x-init="() => { $el.classList.remove('hidden'); }"
                            class="absolute right-0 mt-2 py-2 w-48 bg-white dark:bg-slate-800 border dark:border-slate-700 rounded-md shadow-xl z-20 hidden"
                        >
                            <a href="{{route('frontend.home')}}"
                               class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-indigo-600 hover:text-white transition-colors duration-200">
                                <i class="fa-solid fa-home mr-1"></i> Back to website
                            </a>
                            <a href="#"
                               class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-indigo-600 hover:text-white transition-colors duration-200">
                                <i class="fa-solid fa-right-from-bracket mr-1"></i> Log out
                            </a>
                        </div>
                    </div>
                </div>
            </header>

            {{-- Breadcrumb --}}
            @hasSection('breadcrumb')
                <div class="px-6 py-4">
                    @yield('breadcrumb')
                </div>
            @endif

            <!-- PAGE CONTENT -->
            <div class="grow p-6">
                @yield('content')
            </div>

            <!-- FOOTER -->
            <footer id="footer" class="text-slate-400 text-xs px-3 py-1.5 border-t border-slate-200 dark:border-slate-800 mt-2">
                Copyright &copy; 2024 Alexandre. All rights reserved.
            </footer>
        </main>

    </div>
@endsection
