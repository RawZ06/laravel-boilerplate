@extends('layouts.admin')

@section('breadcrumb')
    <x-nav.breadcrumb :items="[
        ['label' => 'Dashboard', 'icon' => 'fa-solid fa-gauge', 'url' => route('backend.index')],
        ['label' => 'User', 'icon' => 'fa-solid fa-user'],
    ]"/>
@endsection

@section('content')
    <div class="flex flex-col gap-2 container max-w-7xl mx-auto">
        <h1 class="text-2xl font-bold">User</h1>

        <div class="flex justify-end">
            <x-button href="{{ route('backend.users.create') }}" icon="fa-solid fa-user-plus">Create User</x-button>
        </div>

        <x-table
            id="users_table"
            :rows="$users"
            :columns="[
                ['key' => 'id', 'label' => 'ID', 'sortable' => false, 'searchable' => false],
                ['key' => 'name',  'label' => 'Name',  'sortable' => false, 'searchable' => false],
                ['key' => 'email', 'label' => 'Email', 'sortable' => false, 'searchable' => false],
                ['key' => 'role', 'label' => 'Role', 'sortable' => false, 'searchable' => false],
                ['key' => 'created_at',  'label' => 'Created At',  'sortable' => false, 'searchable' => false],
                ['key' => 'updated_at', 'label' => 'Updated At', 'sortable' => false, 'searchable' => false],
                ['key' => 'action', 'label' => 'Action', 'sortable' => false, 'searchable' => false],
            ]"
        >
            <x-slot:rowTemplate>
                <x-table.row column="role">
                    @verbatim
                        <x-feedback.badge :variant="$row->isAdmin() ? 'indigo' : 'gray'">
                            {{ $row->role->label() }}
                        </x-feedback.badge>
                    @endverbatim
                </x-table.row>
                <x-table.row column="action">
                    @verbatim
                        <x-overlay.dropdown align="right">
                            <x-slot:trigger>
                                <x-button variant="ghost">
                                    <i class="fa-solid fa-solid fa-ellipsis-vertical text-xs"></i>
                                </x-button>
                            </x-slot:trigger>

                            <x-overlay.dropdown-item href="{{ route('backend.users.show', $row->id) }}"
                                                     icon="fa-solid fa-eye">Details
                            </x-overlay.dropdown-item>
                            <x-overlay.dropdown-item href="{{ route('backend.users.edit', $row->id) }}"
                                                     icon="fa-solid fa-pen">Edit
                            </x-overlay.dropdown-item>
                            @if ($row->id !== auth()->user()->id)
                                <x-overlay.dropdown-divider/>
                                <x-overlay.dropdown-item icon="fa-solid fa-trash" variant="danger"
                                                         onclick="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'delete-user' }))">
                                    Delete
                                </x-overlay.dropdown-item>
                            @endif
                        </x-overlay.dropdown>

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
                                <form action="{{ route('backend.users.destroy', $row->id) }}"
                                      onsubmit="currentModal = null" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <x-button type="submit" variant="danger">Delete</x-button>
                                </form>
                            </x-slot:footer>
                        </x-overlay.modal>
                    @endverbatim
                </x-table.row>
            </x-slot:rowTemplate>
        </x-table>
    </div>
@endsection
