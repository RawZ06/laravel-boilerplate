@extends('layouts.admin')

@section('breadcrumb')
    <x-nav.breadcrumb :items="[
        ['label' => 'Dashboard', 'icon' => 'fa-solid fa-gauge'],
    ]" />
@endsection

@section('content')
    <div class="flex flex-col gap-2">
        <h1 class="text-2xl font-bold text-slate-800 dark:text-white">
            Bienvenue, {{ auth()->user()->name }} 👋
        </h1>
        <p class="text-sm text-slate-400">
            {{ now()->translatedFormat('l j F Y') }} &bull; {{ config('app.name') }} &bull; Laravel {{ app()->version() }}
        </p>
    </div>
@endsection
