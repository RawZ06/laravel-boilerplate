{{-- resources/views/design-system/buttons.blade.php --}}

@extends('layouts.design-system')

@section('content')
        <div class="max-w-5xl mx-auto px-8 py-12 flex flex-col gap-16">

            {{-- MODAL --}}
            <section class="flex flex-col divide-y divide-gray-100 rounded-2xl border border-gray-100 bg-white shadow-xs overflow-hidden">

                <div class="px-6 py-4">
                    <span class="text-xs font-medium tracking-widest text-gray-400 uppercase">01</span>
                    <h2 class="text-sm font-semibold text-gray-800">Modal</h2>
                    <p class="text-xs text-gray-400 mt-0.5">Fenêtres de dialogue et de confirmation</p>
                </div>

                {{-- 01 — Basique --}}
                <div class="flex items-start gap-8 px-6 py-8">
                    <div class="flex flex-col gap-0.5 w-56 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">01 — basique</code>
                        <span class="text-xs text-gray-400">Header + body + footer</span>
                    </div>
                    <div>
                        <x-overlay.modal name="demo-basic" size="md">
                            <x-slot:trigger>
                                <x-button onclick="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'demo-basic' }))">
                                    Ouvrir la modal
                                </x-button>
                            </x-slot:trigger>

                            <x-slot:header>
                                <p class="text-sm font-semibold text-gray-800">Titre de la modal</p>
                                <p class="text-xs text-gray-400">Sous-titre optionnel</p>
                            </x-slot:header>

                            <p class="text-sm text-gray-600">Contenu de la modal. Vous pouvez y mettre n'importe quel contenu HTML, formulaire, texte, etc.</p>

                            <x-slot:footer>
                                <x-button variant="ghost" onclick="window.dispatchEvent(new CustomEvent('close-modal', { detail: 'demo-basic' }))">
                                    Annuler
                                </x-button>
                                <x-button variant="primary">Confirmer</x-button>
                            </x-slot:footer>
                        </x-overlay.modal>
                    </div>
                </div>

                {{-- 02 — Confirmation danger --}}
                <div class="flex items-start gap-8 px-6 py-8">
                    <div class="flex flex-col gap-0.5 w-56 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">02 — confirmation danger</code>
                        <span class="text-xs text-gray-400">Action destructive</span>
                    </div>
                    <div>
                        <x-overlay.modal name="demo-danger" size="sm">
                            <x-slot:trigger>
                                <x-button variant="danger" onclick="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'demo-danger' }))">
                                    Supprimer
                                </x-button>
                            </x-slot:trigger>

                            <x-slot:header>
                                <p class="text-sm font-semibold text-gray-800">Supprimer l'élément</p>
                            </x-slot:header>

                            <div class="flex flex-col gap-3">
                                <div class="flex items-center justify-center w-12 h-12 rounded-full bg-red-50 mx-auto">
                                    <i class="fa-solid fa-trash text-red-500"></i>
                                </div>
                                <p class="text-sm text-gray-600 text-center">Cette action est irréversible. Êtes-vous sûr de vouloir supprimer cet élément ?</p>
                            </div>

                            <x-slot:footer>
                                <x-button variant="ghost" onclick="window.dispatchEvent(new CustomEvent('close-modal', { detail: 'demo-danger' }))">
                                    Annuler
                                </x-button>
                                <x-button variant="danger">Supprimer</x-button>
                            </x-slot:footer>
                        </x-overlay.modal>
                    </div>
                </div>

                {{-- 03 — Tailles --}}
                <div class="flex items-start gap-8 px-6 py-8">
                    <div class="flex flex-col gap-0.5 w-56 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">03 — tailles</code>
                        <span class="text-xs text-gray-400">sm, md, lg, xl</span>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        @foreach(['sm', 'md', 'lg', 'xl'] as $s)
                            <x-overlay.modal name="demo-size-{{ $s }}" size="{{ $s }}">
                                <x-slot:trigger>
                                    <x-button variant="outline" onclick="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'demo-size-{{ $s }}' }))">
                                        {{ strtoupper($s) }}
                                    </x-button>
                                </x-slot:trigger>

                                <x-slot:header>
                                    <p class="text-sm font-semibold text-gray-800">Modal size={{ $s }}</p>
                                </x-slot:header>

                                <p class="text-sm text-gray-600">Contenu d'une modal de taille <strong>{{ $s }}</strong>.</p>

                                <x-slot:footer>
                                    <x-button variant="ghost" onclick="window.dispatchEvent(new CustomEvent('close-modal', { detail: 'demo-size-{{ $s }}' }))">
                                        Fermer
                                    </x-button>
                                </x-slot:footer>
                            </x-overlay.modal>
                        @endforeach
                    </div>
                </div>

            </section>

            {{-- DROPDOWN --}}
            <section class="flex flex-col divide-y divide-gray-100 rounded-2xl border border-gray-100 bg-white shadow-xs overflow-hidden">

                <div class="px-6 py-4">
                    <span class="text-xs font-medium tracking-widest text-gray-400 uppercase">02</span>
                    <h2 class="text-sm font-semibold text-gray-800">Dropdown</h2>
                    <p class="text-xs text-gray-400 mt-0.5">Menus contextuels et actions</p>
                </div>

                {{-- 01 — Basique --}}
                <div class="flex items-start gap-8 px-6 py-8">
                    <div class="flex flex-col gap-0.5 w-56 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">01 — basique</code>
                        <span class="text-xs text-gray-400">Menu simple avec icônes</span>
                    </div>
                    <x-overlay.dropdown>
                        <x-slot:trigger>
                            <x-button variant="outline">
                                Actions <i class="fa-solid fa-chevron-down text-xs ml-1"></i>
                            </x-button>
                        </x-slot:trigger>

                        <x-overlay.dropdown-item icon="fa-solid fa-pen">Modifier</x-overlay.dropdown-item>
                        <x-overlay.dropdown-item icon="fa-solid fa-copy">Dupliquer</x-overlay.dropdown-item>
                        <x-overlay.dropdown-item icon="fa-solid fa-share">Partager</x-overlay.dropdown-item>
                    </x-overlay.dropdown>
                </div>

                {{-- 02 — Avec divider et danger --}}
                <div class="flex items-start gap-8 px-6 py-8">
                    <div class="flex flex-col gap-0.5 w-56 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">02 — divider + danger</code>
                        <span class="text-xs text-gray-400">Séparateur et action destructive</span>
                    </div>
                    <x-overlay.dropdown>
                        <x-slot:trigger>
                            <x-button variant="outline">
                                Options <i class="fa-solid fa-chevron-down text-xs ml-1"></i>
                            </x-button>
                        </x-slot:trigger>

                        <x-overlay.dropdown-item icon="fa-solid fa-pen">Modifier</x-overlay.dropdown-item>
                        <x-overlay.dropdown-item icon="fa-solid fa-copy">Dupliquer</x-overlay.dropdown-item>
                        <x-overlay.dropdown-divider />
                        <x-overlay.dropdown-item icon="fa-solid fa-trash" variant="danger">Supprimer</x-overlay.dropdown-item>
                    </x-overlay.dropdown>
                </div>

                {{-- 03 — Alignement --}}
                <div class="flex items-start gap-8 px-6 py-8">
                    <div class="flex flex-col gap-0.5 w-56 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">03 — alignement</code>
                        <span class="text-xs text-gray-400">left, center, right</span>
                    </div>
                    <div class="flex gap-4">
                        @foreach(['left', 'center', 'right'] as $align)
                            <x-overlay.dropdown align="{{ $align }}">
                                <x-slot:trigger>
                                    <x-button variant="outline">{{ ucfirst($align) }}</x-button>
                                </x-slot:trigger>
                                <x-overlay.dropdown-item icon="fa-solid fa-pen">Modifier</x-overlay.dropdown-item>
                                <x-overlay.dropdown-item icon="fa-solid fa-trash" variant="danger">Supprimer</x-overlay.dropdown-item>
                            </x-overlay.dropdown>
                        @endforeach
                    </div>
                </div>

                {{-- 04 — Trigger icône --}}
                <div class="flex items-start gap-8 px-6 py-8">
                    <div class="flex flex-col gap-0.5 w-56 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">04 — trigger icône</code>
                        <span class="text-xs text-gray-400">Bouton kebab menu</span>
                    </div>
                    <x-overlay.dropdown>
                        <x-slot:trigger>
                            <button class="flex items-center justify-center w-8 h-8 rounded-lg text-gray-400 hover:bg-gray-100 hover:text-gray-600 transition-colors cursor-pointer">
                                <i class="fa-solid fa-ellipsis-vertical text-sm"></i>
                            </button>
                        </x-slot:trigger>
                        <x-overlay.dropdown-item icon="fa-solid fa-pen">Modifier</x-overlay.dropdown-item>
                        <x-overlay.dropdown-item icon="fa-solid fa-copy">Dupliquer</x-overlay.dropdown-item>
                        <x-overlay.dropdown-divider />
                        <x-overlay.dropdown-item icon="fa-solid fa-trash" variant="danger">Supprimer</x-overlay.dropdown-item>
                    </x-overlay.dropdown>
                </div>

            </section>


        </div>
@endsection
