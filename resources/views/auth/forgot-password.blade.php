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

                <h1 class="text-2xl font-semibold text-slate-800 dark:text-white mb-1">Forgot password? 🔒</h1>
                <p class="text-slate-500 dark:text-slate-400 text-sm mb-8">No problem. Just let us know your email address and we will email you a password reset link.</p>

                {{-- Status alert --}}
                @if (session('status'))
                    <div class="mb-6">
                        <x-feedback.alert variant="success" :dismissible="false">
                            {{ session('status') }}
                        </x-feedback.alert>
                    </div>
                @endif

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

                <form method="POST" action="{{ route('auth.password.email') }}" class="space-y-5">
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

                    {{-- Submit --}}
                    <x-button
                        type="submit"
                        class="w-full"
                    >
                        Email Password Reset Link
                    </x-button>

                </form>

                <p class="mt-6 text-center text-sm text-slate-500 dark:text-slate-400">
                    Remembered your password?
                    <a href="{{ route('auth.index') }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 transition font-medium">
                        Back to login
                    </a>
                </p>
            </div>
        </div>

    </div>
@endsection
