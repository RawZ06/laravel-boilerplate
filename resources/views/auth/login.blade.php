@extends('layouts.skeleton')

@section('body')
    <div class="min-h-screen flex bg-slate-50 dark:bg-slate-950">

        {{-- Left panel - Branding --}}
        <div class="hidden lg:flex lg:w-1/2 bg-[#1e2235] dark:bg-[#0f1120] flex-col justify-between p-12">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-indigo-500 flex items-center justify-center">
                    <i class="fa-solid fa-bolt text-white text-sm"></i>
                </div>
                <span class="text-white font-semibold text-lg">{{ config('app.name', 'Laravel') }}</span>
            </div>

            <div>
                <blockquote class="text-slate-300 dark:text-slate-400 text-xl leading-relaxed mb-6">
                    "An interface designed to move fast, without sacrificing what matters."
                </blockquote>
                <p class="text-slate-500 dark:text-slate-600 text-sm">— The product team</p>
            </div>

            <p class="text-slate-600 dark:text-slate-700 text-xs">&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.</p>
        </div>

        {{-- Right panel - Form --}}
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-slate-50 dark:bg-slate-900">
            <div class="w-full max-w-md">

                {{-- Mobile logo --}}
                <div class="flex items-center gap-3 mb-10 lg:hidden">
                    <div class="w-9 h-9 rounded-xl bg-indigo-500 flex items-center justify-center">
                        <i class="fa-solid fa-bolt text-white text-sm"></i>
                    </div>
                    <span class="font-semibold text-lg text-slate-800 dark:text-white">{{ config('app.name', 'Laravel') }}</span>
                </div>

                <h1 class="text-2xl font-semibold text-slate-800 dark:text-white mb-1">Welcome back 👋</h1>
                <p class="text-slate-500 dark:text-slate-400 text-sm mb-8">Sign in to your account.</p>

                {{-- Error alert --}}
                @if ($errors->any())
                    <div class="mb-6">
                        <x-feedback.alert variant="error" :dismissible="false">
                            <ul class="space-y-0.5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </x-feedback.alert>
                    </div>
                @endif

                <form method="POST" action="{{ route('auth.login') }}" class="space-y-5">
                    @csrf

                    {{-- Email --}}
                    <x-form.field label="Email address" for="email">
                        <x-form.input
                            type="email"
                            id="email"
                            name="email"
                            :value="old('email')"
                            placeholder="you@example.com"
                            required
                            autofocus
                            autocomplete="email"
                            :error="$errors->first('email')"
                        />
                    </x-form.field>

                    {{-- Password --}}
                    <x-form.field for="password">
                        <x-slot name="label">
                            <div class="flex items-center justify-between mb-1.5">
                                <label for="password" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Password</label>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-xs text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 transition">
                                        Forgot password?
                                    </a>
                                @endif
                            </div>
                        </x-slot>
                        <x-form.input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="••••••••"
                            required
                            autocomplete="current-password"
                            :error="$errors->first('password')"
                        />
                    </x-form.field>

                    {{-- Remember me --}}
                    <x-form.checkbox
                        id="remember"
                        name="remember"
                        label="Remember me"
                    />

                    {{-- Submit --}}
                    <x-button
                        type="submit"
                        class="w-full"
                    >
                        Sign in
                    </x-button>

                </form>
            </div>
        </div>

    </div>
@endsection
