{{-- resources/views/design-system/buttons.blade.php --}}

@extends('layouts.design-system')

@section('content')
        <div class="max-w-5xl mx-auto px-8 py-12 flex flex-col gap-16">

            {{-- BADGE --}}
            <section class="flex flex-col divide-y divide-gray-100 rounded-2xl border border-gray-100 bg-white shadow-xs overflow-hidden">

                <div class="px-6 py-4">
                    <span class="text-xs font-medium tracking-widest text-gray-400 uppercase">01</span>
                    <h2 class="text-sm font-semibold text-gray-800">Badge</h2>
                    <p class="text-xs text-gray-400 mt-0.5">Étiquettes de statut et de catégorie</p>
                </div>

                {{-- 01 — Variantes --}}
                <div class="flex items-start gap-8 px-6 py-8">
                    <div class="flex flex-col gap-0.5 w-56 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">01 — variantes</code>
                        <span class="text-xs text-gray-400">Les 6 couleurs disponibles</span>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <x-feedback.badge variant="gray">Gray</x-feedback.badge>
                        <x-feedback.badge variant="indigo">Indigo</x-feedback.badge>
                        <x-feedback.badge variant="green">Green</x-feedback.badge>
                        <x-feedback.badge variant="red">Red</x-feedback.badge>
                        <x-feedback.badge variant="yellow">Yellow</x-feedback.badge>
                        <x-feedback.badge variant="blue">Blue</x-feedback.badge>
                    </div>
                </div>

                {{-- 02 — Avec dot --}}
                <div class="flex items-start gap-8 px-6 py-8">
                    <div class="flex flex-col gap-0.5 w-56 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">02 — dot</code>
                        <span class="text-xs text-gray-400">Indicateur de statut avec point coloré</span>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <x-feedback.badge variant="green" :dot="true">Actif</x-feedback.badge>
                        <x-feedback.badge variant="red" :dot="true">Inactif</x-feedback.badge>
                        <x-feedback.badge variant="yellow" :dot="true">En attente</x-feedback.badge>
                        <x-feedback.badge variant="gray" :dot="true">Archivé</x-feedback.badge>
                    </div>
                </div>

                {{-- 03 — Tailles --}}
                <div class="flex items-start gap-8 px-6 py-8">
                    <div class="flex flex-col gap-0.5 w-56 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">03 — tailles</code>
                        <span class="text-xs text-gray-400">sm, md, lg</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <x-feedback.badge variant="indigo" size="sm">Small</x-feedback.badge>
                        <x-feedback.badge variant="indigo" size="md">Medium</x-feedback.badge>
                        <x-feedback.badge variant="indigo" size="lg">Large</x-feedback.badge>
                    </div>
                </div>

            </section>

            {{-- ALERT --}}
            <section class="flex flex-col divide-y divide-gray-100 rounded-2xl border border-gray-100 bg-white shadow-xs overflow-hidden">

                <div class="px-6 py-4">
                    <span class="text-xs font-medium tracking-widest text-gray-400 uppercase">02</span>
                    <h2 class="text-sm font-semibold text-gray-800">Alert</h2>
                    <p class="text-xs text-gray-400 mt-0.5">Messages de feedback contextuels dans la page</p>
                </div>

                {{-- 01 — Variantes --}}
                <div class="flex items-start gap-8 px-6 py-8">
                    <div class="flex flex-col gap-0.5 w-56 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">01 — variantes</code>
                        <span class="text-xs text-gray-400">info, success, warning, error</span>
                    </div>
                    <div class="flex flex-col gap-3 flex-1">
                        <x-feedback.alert variant="info">Une information utile à afficher.</x-feedback.alert>
                        <x-feedback.alert variant="success">L'opération a bien été effectuée.</x-feedback.alert>
                        <x-feedback.alert variant="warning">Attention, cette action est irréversible.</x-feedback.alert>
                        <x-feedback.alert variant="error">Une erreur est survenue, réessayez.</x-feedback.alert>
                    </div>
                </div>

                {{-- 02 — Avec titre --}}
                <div class="flex items-start gap-8 px-6 py-8">
                    <div class="flex flex-col gap-0.5 w-56 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">02 — avec titre</code>
                        <span class="text-xs text-gray-400">Titre + description</span>
                    </div>
                    <div class="flex flex-col gap-3 flex-1">
                        <x-feedback.alert variant="success" title="Enregistré avec succès">Les modifications ont bien été sauvegardées.</x-feedback.alert>
                        <x-feedback.alert variant="error" title="Erreur de validation">Veuillez corriger les champs en rouge avant de continuer.</x-feedback.alert>
                    </div>
                </div>

                {{-- 03 — Dismissible --}}
                <div class="flex items-start gap-8 px-6 py-8">
                    <div class="flex flex-col gap-0.5 w-56 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">03 — dismissible</code>
                        <span class="text-xs text-gray-400">Fermable par l'utilisateur</span>
                    </div>
                    <div class="flex flex-col gap-3 flex-1">
                        <x-feedback.alert variant="info" title="Mise à jour disponible" :dismissible="true">Une nouvelle version est disponible, pensez à rafraîchir.</x-feedback.alert>
                        <x-feedback.alert variant="warning" :dismissible="true">Votre session expire dans 5 minutes.</x-feedback.alert>
                    </div>
                </div>

            </section>


        </div>
@endsection
