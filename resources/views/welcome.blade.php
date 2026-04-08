@extends('layouts.app')

@section('content')
    <div class="flex flex-col items-center justify-center min-h-[60vh] px-6 text-center">

        {{-- Brand --}}
        <div class="w-14 h-14 rounded-2xl bg-indigo-500 flex items-center justify-center shadow-md mb-6">
            <i class="fa-solid fa-bolt text-white text-xl"></i>
        </div>

        <h1 class="text-3xl font-semibold text-slate-800 dark:text-white tracking-tight mb-3">
            {{ config('app.name', 'Laravel') }}
        </h1>

        <p class="text-slate-500 dark:text-slate-400 text-base max-w-sm mb-8">
            Your next project starts here.
        </p>

    </div>
@endsection
