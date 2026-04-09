{{-- layouts/app.blade.php --}}
@extends('layouts.skeleton')

@section('head')
    <style>
        [x-cloak] { display: none !important; }
    </style>
@endsection

@section('body')
    <div class="min-h-screen flex flex-col bg-slate-100 dark:bg-slate-950">

        <!-- HEADER -->
        <header class="h-14 bg-white dark:bg-slate-900 shadow-sm dark:shadow-slate-800/50 sticky top-0 z-10">
            <div class="max-w-6xl mx-auto h-full px-6 flex items-center justify-between">

                <!-- Brand -->
                <a href="{{ route('frontend.home') }}" class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-xl bg-indigo-500 flex items-center justify-center shadow-sm shrink-0">
                        <i class="fa-solid fa-bolt text-white text-xs"></i>
                    </div>
                    <span class="text-slate-800 dark:text-white font-semibold text-sm tracking-tight">
                        {{ config('app.name', 'Laravel') }}
                    </span>
                </a>

                <!-- Right -->
                <div class="flex items-center gap-2">

                    <!-- Theme switcher -->
                    <x-overlay.dropdown align="right">
                        <x-slot:trigger>
                            <x-button variant="ghost" aria-label="Toggle theme">
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

                    <!-- Auth -->
                    @auth
                        <x-overlay.dropdown align="right">
                            <x-slot:trigger>
                                <button class="flex items-center gap-2 px-3 py-1.5 rounded-lg text-sm text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                                    <img class="w-7 h-7 rounded-full bg-gray-300"
                                         src="https://api.dicebear.com/7.x/adventurer/svg?seed={{ auth()->user()->name }}"
                                         alt="Avatar">
                                    <span>{{ auth()->user()->name }}</span>
                                    <i class="fa-solid fa-chevron-down text-xs text-slate-400"></i>
                                </button>
                            </x-slot:trigger>

                            <x-overlay.dropdown-item :href="route('auth.profile.index')" icon="fa-solid fa-user">
                                Profile
                            </x-overlay.dropdown-item>

                            @if(auth()->user()->isAdmin())
                                <x-overlay.dropdown-item :href="route('backend.index')" icon="fa-solid fa-gauge">
                                    Dashboard
                                </x-overlay.dropdown-item>
                            @endif

                            <x-overlay.dropdown-item :href="route('auth.logout')" icon="fa-solid fa-right-from-bracket">
                                Log out
                            </x-overlay.dropdown-item>
                        </x-overlay.dropdown>
                    @else
                        <x-button variant="ghost" tag="a" href="{{ route('auth.login') }}">
                            Log in
                        </x-button>
                        <x-button variant="primary" tag="a" href="{{ route('auth.register') }}">
                            Sign up
                        </x-button>
                    @endauth
                </div>
            </div>
        </header>

        <!-- PAGE CONTENT -->
        <main class="grow p-6 flex flex-col gap-8">
            @foreach(['success', 'error', 'warning', 'info'] as $type)
                @if(session($type))
                    <x-feedback.alert :variant="$type" :dismissible="true">
                        {{ session($type) }}
                    </x-feedback.alert>
                @endif
            @endforeach
            @yield('content')
        </main>

        <!-- FOOTER -->
        <footer class="text-slate-400 text-center text-xs px-3 py-1.5 border-t border-slate-200 dark:border-slate-800 mt-2 bg-white dark:bg-slate-900">
            &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.
        </footer>

    </div>
@endsection
