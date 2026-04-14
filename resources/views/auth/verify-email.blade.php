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
                    "Verification is the first step towards a secure experience."
                </blockquote>
                <p class="text-slate-500 dark:text-slate-600 text-sm">— The product team</p>
            </div>

            <p class="text-slate-600 dark:text-slate-700 text-xs">&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.</p>
        </div>

        {{-- Right panel - Content --}}
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-slate-50 dark:bg-slate-900">
            <div class="w-full max-w-md">

                {{-- Mobile logo --}}
                <div class="flex items-center gap-3 mb-10 lg:hidden">
                    <div class="w-9 h-9 rounded-xl bg-indigo-500 flex items-center justify-center">
                        <i class="fa-solid fa-bolt text-white text-sm"></i>
                    </div>
                    <span class="font-semibold text-lg text-slate-800 dark:text-white">{{ config('app.name', 'Laravel') }}</span>
                </div>

                <h1 class="text-2xl font-semibold text-slate-800 dark:text-white mb-1">Verify your email 📧</h1>
                <p class="text-slate-500 dark:text-slate-400 text-sm mb-8">
                    Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.
                </p>

                @if (session('status') == 'verification-link-sent')
                    <div class="mb-6">
                        <x-feedback.alert variant="success" :dismissible="false">
                            A new verification link has been sent to the email address you provided during registration.
                        </x-feedback.alert>
                    </div>
                @endif

                <div class="flex flex-col gap-4 mt-8">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <x-button type="submit" class="w-full">
                            Resend Verification Email
                        </x-button>
                    </form>

                    <a href="{{ route('auth.logout') }}" class="text-center text-sm text-slate-500 hover:text-slate-800 dark:hover:text-slate-300 transition-colors">
                        Log Out
                    </a>
                </div>

            </div>
        </div>

    </div>
@endsection
