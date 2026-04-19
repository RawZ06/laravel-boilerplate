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
                          onclick="window.dispatchEvent(new CustomEvent('open-modal', { detail: { name: 'delete-user', action: '{{ route('backend.users.destroy', $user->id) }}', id: '{{ $user->id }}' } }))"
                          icon="fa-solid fa-trash">Delete User
                </x-button>
            @endif
        </div>

        <form method="POST" action="{{ route('backend.users.update', $user) }}" class="flex flex-col gap-6">
            @csrf
            @method('PUT')

            <x-form.avatar-picker :value="old('avatar', $user->avatar)" />

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

    <x-overlay.modal name="delete-user">
        <x-slot:header>
            <p class="text-sm font-semibold text-gray-800 dark:text-slate-200">Delete element</p>
        </x-slot:header>

        <div class="flex flex-col gap-3">
            <div
                class="flex items-center justify-center w-12 h-12 rounded-full bg-red-50 dark:bg-rose-500/10 mx-auto">
                <i class="fa-solid fa-trash text-red-500 dark:text-rose-400"></i>
            </div>
            <p class="text-sm text-gray-600 dark:text-slate-400 text-center">
                This action is irreversible. Are you sure you want to delete this element <span x-show="detail.id" x-text="'#' + detail.id"></span>?
            </p>
        </div>

        <x-slot:footer>
            <x-button variant="ghost"
                      onclick="window.dispatchEvent(new CustomEvent('close-modal', { detail: 'delete-user' }))">
                Cancel
            </x-button>
            <form :action="detail.action || '{{ route('backend.users.destroy', $user->id) }}'"
                  onsubmit="currentModal = null" method="POST">
                @csrf
                @method('DELETE')
                <x-button type="submit" variant="danger">Delete</x-button>
            </form>
        </x-slot:footer>
    </x-overlay.modal>
@endsection
