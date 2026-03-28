@extends('layouts.design-system')
@section('content')
    <div class="flex flex-col gap-10 max-w-4xl">

        {{-- Intro --}}
        <div class="flex flex-col gap-2">
            <h2 class="text-2xl font-semibold text-gray-900 tracking-tight">Welcome</h2>
            <p class="text-sm text-gray-400 max-w-lg">
                Visual reference for all available components. Each page documents the props, variants, and states of a component.
            </p>
        </div>

        {{-- Cards --}}
        <div class="grid grid-cols-2 gap-4">

            @foreach([
                [
                    'title'       => 'Buttons',
                    'route'       => 'design-system.buttons',
                    'tag'         => 'x-button',
                    'icon'        => 'fa-solid fa-computer-mouse',
                    'description' => 'Variants, sizes, icons, loading / disabled states, link rendering.',
                    'count'       => '7 variants',
                ],
                [
                    'title'       => 'Form',
                    'route'       => 'design-system.form',
                    'tag'         => 'x-form.*',
                    'icon'        => 'fa-solid fa-pen-to-square',
                    'description' => 'Input, textarea, toggle, checkbox, radio, select, date, color, autocomplete.',
                    'count'       => '9 components',
                ],
                [
                    'title'       => 'Table',
                    'route'       => 'design-system.table',
                    'tag'         => 'x-table.*',
                    'icon'        => 'fa-solid fa-table',
                    'description' => 'Table, search-bar, filter, pagination.',
                    'count'       => '4 components',
                ],
                [
                    'title'       => 'Feedback',
                    'route'       => 'design-system.feedback',
                    'tag'         => 'x-feedback.*',
                    'icon'        => 'fa-solid fa-message',
                    'description' => 'Alert, badge, toast.',
                    'count'       => '3 components',
                ],
                [
                    'title'       => 'Overlay',
                    'route'       => 'design-system.overlay',
                    'tag'         => 'x-overlay.*',
                    'icon'        => 'fa-solid fa-layer-group',
                    'description' => 'Modal, dropdown, dropdown-item, dropdown-divider.',
                    'count'       => '4 components',
                ],
                [
                    'title'       => 'Nav',
                    'route'       => 'design-system.nav',
                    'tag'         => 'x-nav.*',
                    'icon'        => 'fa-solid fa-bars',
                    'description' => 'Breadcrumb.',
                    'count'       => '1 component',
                ],
            ] as $card)
                <a href="{{ route($card['route']) }}"
                   class="group rounded-2xl border border-gray-100 bg-white shadow-xs p-6 flex flex-col gap-4 hover:border-indigo-200 hover:shadow-sm transition-all duration-150">

                    <div class="flex items-start justify-between">
                        <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center">
                            <i class="{{ $card['icon'] }} text-indigo-500 text-sm"></i>
                        </div>
                        <span class="text-[10px] font-medium text-gray-300 uppercase tracking-widest">{{ $card['count'] }}</span>
                    </div>

                    <div class="flex flex-col gap-1">
                        <div class="flex items-center gap-2">
                            <h3 class="text-sm font-semibold text-gray-900">{{ $card['title'] }}</h3>
                            <code class="text-[10px] text-indigo-400 bg-indigo-50 px-1.5 py-0.5 rounded">{{ $card['tag'] }}</code>
                        </div>
                        <p class="text-xs text-gray-400">{{ $card['description'] }}</p>
                    </div>

                    <div class="flex items-center gap-1 text-xs text-indigo-400 font-medium opacity-0 group-hover:opacity-100 transition-opacity">
                        View components <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </div>

                </a>
            @endforeach

        </div>
    </div>
@endsection
