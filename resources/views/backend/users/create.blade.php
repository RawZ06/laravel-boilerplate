@extends('layouts.admin')

@section('breadcrumb')
    <x-nav.breadcrumb :items="[
        ['label' => 'Dashboard', 'icon' => 'fa-solid fa-gauge', 'url' => route('backend.index')],
        ['label' => 'User', 'icon' => 'fa-solid fa-user', 'url' => route('backend.users.index')],
        ['label' => 'Create', 'icon' => 'fa-solid fa-user-plus'],
    ]" />
@endsection

@section('content')
    <div class="flex flex-col gap-2 container max-w-7xl mx-auto">
        <h1 class="text-2xl font-bold">Create User</h1>

        <form method="POST" action="{{ route('backend.users.store') }}" class="flex flex-col gap-6">
            @csrf

            <x-form.input
                name="name"
                label="Name"
                placeholder="John Doe"
                icon="fa-solid fa-user"
                :value="old('name')"
                :error="$errors->first('name')"
                required
            />

            <x-form.input
                name="email"
                type="email"
                label="Email"
                placeholder="john@example.com"
                icon="fa-solid fa-envelope"
                hint="We will never share your email."
                :value="old('email')"
                :error="$errors->first('email')"
                required
            />

            <x-form.input
                name="password"
                type="password"
                label="Password"
                placeholder="••••••••"
                icon="fa-solid fa-lock"
                :error="$errors->first('password')"
                required
            />

            <x-form.input
                name="password_confirmation"
                type="password"
                label="Confirm Password"
                placeholder="••••••••"
                icon="fa-solid fa-lock"
                :error="$errors->first('password_confirmation')"
                required
            />

            <x-form.select
                name="role"
                label="Role"
                placeholder="Select a role"
                :options="[
                    ['value' => 'user', 'label' => 'User'],
                    ['value' => 'admin', 'label' => 'Administrator'],
                ]"
                :selected="old('role', 'user')"
                :error="$errors->first('role')"
                required
            />

            <div class="flex justify-end gap-3">
                <x-button
                    href="{{ route('backend.users.index') }}"
                    variant="secondary"
                    icon="fa-solid fa-xmark"
                >
                    Cancel
                </x-button>

                <x-button
                    type="submit"
                    variant="primary"
                    icon="fa-solid fa-user-plus"
                >
                    Create User
                </x-button>
            </div>
        </form>
    </div>
@endsection
