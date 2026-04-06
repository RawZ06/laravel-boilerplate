@extends('layouts.admin')

@section('breadcrumb')
    <x-nav.breadcrumb :items="[
        ['label' => 'Dashboard', 'icon' => 'fa-solid fa-gauge', 'url' => route('backend.index')],
        ['label' => 'User', 'icon' => 'fa-solid fa-user', 'url' => route('backend.users.index')],
        ['label' => 'Details', 'icon' => 'fa-solid fa-eye'],
    ]"/>
@endsection

@section('content')
    <div class="flex flex-col gap-2 container max-w-7xl mx-auto">
        <h1 class="text-2xl font-bold">User {{$user->id}}</h1>

        <div class="flex gap-2 justify-end">
            <x-button href="{{ route('backend.users.edit', $user->id) }}" icon="fa-solid fa-user-plus">Edit User
            </x-button>
            @if ($user->id != auth()->user()->id)
                <x-button variant="danger"
                          onclick="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'delete-user' }))"
                          icon="fa-solid fa-trash">Delete User
                </x-button>
            @endif
        </div>

        <div class="flex flex-col gap-8">
            <div class="flex flex-col gap-2">
                <span class="text-sm font-bold uppercase tracking-wide">Name</span>
                <span>{{$user->name}}</span>
            </div>

            <div class="flex flex-col gap-2">
                <span class="text-sm font-bold uppercase tracking-wide">Email</span>
                <span>{{$user->email}}</span>
            </div>

            <div class="flex flex-col gap-2">
                <span class="text-sm font-bold uppercase tracking-wide">Password</span>
                <span>*********</span>
            </div>

            <div class="flex flex-col gap-2">
                <span class="text-sm font-bold uppercase tracking-wide">Remember Token</span>
                <span>*********</span>
            </div>

            <div class="flex flex-col gap-2">
                <span class="text-sm font-bold uppercase tracking-wide">Email Verified At</span>
                <span>{{$user->email_verified_at}}</span>
            </div>

            <div class="flex flex-col gap-2">
                <span class="text-sm font-bold uppercase tracking-wide">Created_At</span>
                <span>{{$user->created_at}}</span>
            </div>

            <div class="flex flex-col gap-2">
                <span class="text-sm font-bold uppercase tracking-wide">Update_At</span>
                <span>{{$user->updated_at}}</span>
            </div>
        </div>
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
            <p class="text-sm text-gray-600 dark:text-slate-400 text-center">This action is
                irreversible. Are you
                sure you want to delete this element?</p>
        </div>

        <x-slot:footer>
            <x-button variant="ghost"
                      onclick="window.dispatchEvent(new CustomEvent('close-modal', { detail: 'delete-user' }))">
                Cancel
            </x-button>
            <form action="{{ route('backend.users.destroy', $user->id) }}"
                  onsubmit="currentModal = null" method="POST">
                @csrf
                @method('DELETE')
                <x-button type="submit" variant="danger">Delete</x-button>
            </form>
        </x-slot:footer>
    </x-overlay.modal>
@endsection
