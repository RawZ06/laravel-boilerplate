@extends('layouts.admin')

@section('breadcrumb')
    <x-nav.breadcrumb :items="[
        ['label' => 'Dashboard', 'icon' => 'fa-solid fa-gauge', 'url' => route('backend.index')],
        ['label' => 'User', 'icon' => 'fa-solid fa-user', 'url' => route('backend.users.index')],
        ['label' => 'Edit', 'icon' => 'fa-solid fa-user-pen'],
    ]" />
@endsection

@section('content')
    <div class="flex flex-col gap-2 container max-w-7xl mx-auto">
        <h1 class="text-2xl font-bold">Edit User</h1>

        <div class="flex gap-2 justify-end">
            <x-button href="{{ route('backend.users.show', $user->id) }}" icon="fa-solid fa-eye">Show User
            </x-button>
            @if ($user->id != auth()->user()->id)
                <x-button variant="danger"
                          onclick="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'delete-user' }))"
                          icon="fa-solid fa-trash">Delete User
                </x-button>
            @endif
        </div>

        <form method="POST" action="{{ route('backend.users.update', $user) }}" class="flex flex-col gap-6">
            @csrf
            @method('PUT')

            <x-form.input
                name="name"
                label="Name"
                placeholder="John Doe"
                icon="fa-solid fa-user"
                :value="old('name', $user->name)"
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
                :value="old('email', $user->email)"
                :error="$errors->first('email')"
                required
            />

            <x-form.input
                name="password"
                type="password"
                label="Password"
                placeholder="••••••••"
                icon="fa-solid fa-lock"
                hint="Leave empty to keep current password."
                :error="$errors->first('password')"
            />

            <x-form.input
                name="password_confirmation"
                type="password"
                label="Confirm Password"
                placeholder="••••••••"
                icon="fa-solid fa-lock"
                :error="$errors->first('password_confirmation')"
            />

            <x-form.select
                name="role"
                label="Role"
                placeholder="Select a role"
                :options="[
                    ['value' => 'user', 'label' => 'User'],
                    ['value' => 'admin', 'label' => 'Administrator'],
                ]"
                :selected="old('role', $user->role->value)"
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
                    icon="fa-solid fa-user-pen"
                >
                    Update User
                </x-button>
            </div>
        </form>
    </div>
@endsection
