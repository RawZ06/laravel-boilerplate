@extends('layouts.admin')

@section('breadcrumb')
    <x-nav.breadcrumb :items="[
        ['label' => 'Dashboard', 'icon' => 'fa-solid fa-gauge', 'url' => route('backend.index')],
        ['label' => 'Profile', 'icon' => 'fa-solid fa-user'],
    ]" />
@endsection

@section('content')

    <div class="flex flex-col gap-2 mb-8">
        <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Profile</h1>
        <p class="text-sm text-slate-400">Manage your personal information and password.</p>
    </div>

    <div class="flex flex-col gap-6 w-full max-w-2xl mx-auto">

        {{-- General information --}}
        <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 p-6">
            <h2 class="text-base font-semibold text-slate-800 dark:text-white mb-1">General information</h2>
            <p class="text-sm text-slate-400 mb-6">Update your username and email address.</p>

            <form action="{{ route('auth.profile.update') }}" method="POST" class="flex flex-col gap-5">
                @csrf
                @method('PATCH')

                <x-form.field label="Username" for="name">
                    <x-form.input
                        type="text"
                        id="name"
                        name="name"
                        :value="old('name', auth()->user()->name)"
                        required
                        autocomplete="name"
                        :error="$errors->first('name')"
                    />
                </x-form.field>

                <x-form.field label="Email address" for="email">
                    <x-form.input
                        type="email"
                        id="email"
                        name="email"
                        :value="old('email', auth()->user()->email)"
                        required
                        autocomplete="email"
                        :error="$errors->first('email')"
                    />
                </x-form.field>

                <div class="flex justify-end">
                    <x-button type="submit">Save changes</x-button>
                </div>
            </form>
        </div>

        {{-- Change password --}}
        <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 p-6">
            <h2 class="text-base font-semibold text-slate-800 dark:text-white mb-1">Change password</h2>
            <p class="text-sm text-slate-400 mb-6">Make sure to use a strong password.</p>

            <form action="{{ route('auth.profile.password') }}" method="POST" class="flex flex-col gap-5">
                @csrf
                @method('PATCH')

                <x-form.field label="Current password" for="current_password">
                    <x-form.input
                        type="password"
                        id="current_password"
                        name="current_password"
                        placeholder="••••••••"
                        required
                        autocomplete="current-password"
                        :error="$errors->first('current_password')"
                    />
                </x-form.field>

                <x-form.field label="New password" for="password">
                    <x-form.input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="••••••••"
                        required
                        autocomplete="new-password"
                        :error="$errors->first('password')"
                    />
                </x-form.field>

                <x-form.field label="Confirm new password" for="password_confirmation">
                    <x-form.input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        placeholder="••••••••"
                        required
                        autocomplete="new-password"
                        :error="$errors->first('password_confirmation')"
                    />
                </x-form.field>

                <div class="flex justify-end">
                    <x-button type="submit">Update password</x-button>
                </div>
            </form>
        </div>

        {{-- Account info --}}
        <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 p-6">
            <h2 class="text-base font-semibold text-slate-800 dark:text-white mb-1">Account information</h2>
            <p class="text-sm text-slate-400 mb-6">Read-only details about your account.</p>

            <dl class="flex flex-col gap-4">
                <div class="flex items-center justify-between py-3 border-b border-slate-100 dark:border-slate-700">
                    <dt class="text-sm text-slate-500 dark:text-slate-400">Member since</dt>
                    <dd class="text-sm font-medium text-slate-800 dark:text-white">
                        {{ auth()->user()->created_at->translatedFormat('l j F Y') }}
                    </dd>
                </div>
                <div class="flex items-center justify-between py-3">
                    <dt class="text-sm text-slate-500 dark:text-slate-400">Last updated</dt>
                    <dd class="text-sm font-medium text-slate-800 dark:text-white">
                        {{ auth()->user()->updated_at->translatedFormat('l j F Y') }}
                    </dd>
                </div>
            </dl>
        </div>

    </div>

@endsection
