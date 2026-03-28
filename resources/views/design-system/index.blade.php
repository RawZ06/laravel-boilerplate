@extends('layouts.design-system')
@section('content')
    <div class="flex flex-col gap-10 max-w-4xl">

        {{-- Intro --}}
        <div class="flex flex-col gap-2">
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-slate-100 tracking-tight">Welcome</h2>
            <p class="text-sm text-gray-400 dark:text-slate-500 max-w-lg">
                Visual reference for all available components. Each page documents the props, variants, and states of a component.
            </p>
        </div>

        {{-- Cards --}}
        <div class="grid grid-cols-2 gap-4">

            @foreach([
                // ... (existing array)
            ] as $card)
                <a href="{{ route($card['route']) }}"
                   class="group rounded-2xl border border-gray-100 dark:border-slate-800 bg-white dark:bg-slate-900 shadow-xs p-6 flex flex-col gap-4 hover:border-indigo-200 dark:hover:border-indigo-500/50 hover:shadow-sm transition-all duration-150">

                    <div class="flex items-start justify-between">
                        <div class="w-10 h-10 rounded-xl bg-indigo-50 dark:bg-indigo-500/10 flex items-center justify-center">
                            <i class="{{ $card['icon'] }} text-indigo-500 text-sm"></i>
                        </div>
                        <span class="text-[10px] font-medium text-gray-300 dark:text-slate-600 uppercase tracking-widest">{{ $card['count'] }}</span>
                    </div>

                    <div class="flex flex-col gap-1">
                        <div class="flex items-center gap-2">
                            <h3 class="text-sm font-semibold text-gray-900 dark:text-slate-100">{{ $card['title'] }}</h3>
                            <code class="text-[10px] text-indigo-400 bg-indigo-50 dark:bg-indigo-500/10 px-1.5 py-0.5 rounded">{{ $card['tag'] }}</code>
                        </div>
                        <p class="text-xs text-gray-400 dark:text-slate-500">{{ $card['description'] }}</p>
                    </div>

                    <div class="flex items-center gap-1 text-xs text-indigo-400 font-medium opacity-0 group-hover:opacity-100 transition-opacity">
                        View components <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </div>

                </a>
            @endforeach

        </div>
    </div>
@endsection
