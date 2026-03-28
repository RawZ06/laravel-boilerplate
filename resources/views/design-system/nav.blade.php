@extends('layouts.design-system')

@section('content')
    <div class="max-w-5xl mx-auto px-8 py-12 flex flex-col gap-16">

        {{-- BREADCRUMB --}}
        <section class="flex flex-col divide-y divide-gray-100 rounded-2xl border border-gray-100 bg-white shadow-xs overflow-hidden">

            <div class="px-6 py-4">
                <span class="text-xs font-medium tracking-widest text-gray-400 uppercase">01</span>
                <h2 class="text-sm font-semibold text-gray-800">Breadcrumb</h2>
                <p class="text-xs text-gray-400 mt-0.5">Fil d'Ariane et navigation hiérarchique</p>
            </div>

            {{-- 01 — Basique --}}
            <div class="flex items-start gap-8 px-6 py-8">
                <div class="flex flex-col gap-0.5 w-56 shrink-0">
                    <code class="text-xs font-medium text-indigo-500">01 — basique</code>
                    <span class="text-xs text-gray-400">Liens simples</span>
                </div>
                <x-nav.breadcrumb :items="[
                ['label' => 'Accueil', 'url' => '#'],
                ['label' => 'Paramètres', 'url' => '#'],
                ['label' => 'Profil'],
            ]" />
            </div>

            {{-- 02 — Avec icône --}}
            <div class="flex items-start gap-8 px-6 py-8">
                <div class="flex flex-col gap-0.5 w-56 shrink-0">
                    <code class="text-xs font-medium text-indigo-500">02 — avec icône</code>
                    <span class="text-xs text-gray-400">Icône sur le premier élément</span>
                </div>
                <x-nav.breadcrumb :items="[
                ['label' => 'Accueil', 'url' => '#', 'icon' => 'fa-solid fa-house'],
                ['label' => 'Projets', 'url' => '#'],
                ['label' => 'Design System', 'url' => '#'],
                ['label' => 'Navigation'],
            ]" />
            </div>

            {{-- 03 — Un seul niveau --}}
            <div class="flex items-start gap-8 px-6 py-8">
                <div class="flex flex-col gap-0.5 w-56 shrink-0">
                    <code class="text-xs font-medium text-indigo-500">03 — un seul niveau</code>
                    <span class="text-xs text-gray-400">Page racine</span>
                </div>
                <x-nav.breadcrumb :items="[
                ['label' => 'Dashboard', 'icon' => 'fa-solid fa-house'],
            ]" />
            </div>

            {{-- 04 — Chemin long --}}
            <div class="flex items-start gap-8 px-6 py-8">
                <div class="flex flex-col gap-0.5 w-56 shrink-0">
                    <code class="text-xs font-medium text-indigo-500">04 — chemin long</code>
                    <span class="text-xs text-gray-400">Plusieurs niveaux</span>
                </div>
                <x-nav.breadcrumb :items="[
                ['label' => 'Accueil', 'url' => '#', 'icon' => 'fa-solid fa-house'],
                ['label' => 'Organisation', 'url' => '#'],
                ['label' => 'Équipes', 'url' => '#'],
                ['label' => 'Frontend', 'url' => '#'],
                ['label' => 'Jean Dupont'],
            ]" />
            </div>

        </section>

    </div>
@endsection
