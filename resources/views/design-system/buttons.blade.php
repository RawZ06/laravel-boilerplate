{{-- resources/views/design-system/buttons.blade.php --}}

@extends('layouts.design-system')

@section('content')
        <div class="max-w-5xl mx-auto px-8 py-12 flex flex-col gap-16">

            {{-- 01 VARIANTES --}}
            <section class="flex flex-col gap-6">
                <div class="flex flex-col gap-1">
                    <span class="text-xs font-medium tracking-widest text-gray-400 uppercase">01</span>
                    <h2 class="text-xl font-semibold text-gray-900 tracking-tight">Variantes</h2>
                    <p class="text-sm text-gray-400">Prop <code class="bg-gray-100 px-1.5 py-0.5 rounded text-gray-600 text-xs">variant</code> — définit le style visuel du bouton.</p>
                </div>

                <div class="rounded-2xl border border-gray-100 bg-white shadow-xs divide-y divide-gray-50">
                    @foreach([
                        ['primary',   'Action principale, call-to-action fort'],
                        ['secondary', 'Action secondaire, neutre'],
                        ['outline',   'Alternative sobre au secondary'],
                        ['ghost',     'Action discrète, navigation, liens'],
                        ['danger',    'Suppression, action destructrice'],
                        ['success',   'Confirmation, validation'],
                        ['warning',   'Avertissement, action risquée'],
                    ] as [$v, $desc])
                        <div class="flex items-center justify-between px-6 py-4">
                            <div class="flex flex-col gap-0.5 w-64">
                                <code class="text-xs font-medium text-indigo-500">variant="{{ $v }}"</code>
                                <span class="text-xs text-gray-400">{{ $desc }}</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <x-button variant="{{ $v }}">{{ ucfirst($v) }}</x-button>
                                <x-button variant="{{ $v }}" icon="fa-solid fa-bolt">Avec icône</x-button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            {{-- 02 TAILLES --}}
            <section class="flex flex-col gap-6">
                <div class="flex flex-col gap-1">
                    <span class="text-xs font-medium tracking-widest text-gray-400 uppercase">02</span>
                    <h2 class="text-xl font-semibold text-gray-900 tracking-tight">Tailles</h2>
                    <p class="text-sm text-gray-400">Prop <code class="bg-gray-100 px-1.5 py-0.5 rounded text-gray-600 text-xs">size</code> — <code class="bg-gray-100 px-1.5 py-0.5 rounded text-gray-600 text-xs">sm</code> · <code class="bg-gray-100 px-1.5 py-0.5 rounded text-gray-600 text-xs">md</code> · <code class="bg-gray-100 px-1.5 py-0.5 rounded text-gray-600 text-xs">lg</code></p>
                </div>

                <div class="rounded-2xl border border-gray-100 bg-white shadow-xs p-8">
                    <div class="flex items-end gap-6">
                        @foreach([
                            ['sm', 'Small'],
                            ['md', 'Medium'],
                            ['lg', 'Large'],
                        ] as [$s, $label])
                            <div class="flex flex-col items-center gap-3">
                                <x-button size="{{ $s }}" icon="fa-solid fa-plus">{{ $label }}</x-button>
                                <code class="text-xs text-gray-400">size="{{ $s }}"</code>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            {{-- 03 ICONES --}}
            <section class="flex flex-col gap-6">
                <div class="flex flex-col gap-1">
                    <span class="text-xs font-medium tracking-widest text-gray-400 uppercase">03</span>
                    <h2 class="text-xl font-semibold text-gray-900 tracking-tight">Icônes</h2>
                    <p class="text-sm text-gray-400">Props <code class="bg-gray-100 px-1.5 py-0.5 rounded text-gray-600 text-xs">icon</code> + <code class="bg-gray-100 px-1.5 py-0.5 rounded text-gray-600 text-xs">iconPos</code> — accepte n'importe quelle classe Font Awesome.</p>
                </div>

                <div class="rounded-2xl border border-gray-100 bg-white shadow-xs divide-y divide-gray-50">
                    <div class="flex items-center justify-between px-6 py-4">
                        <div class="flex flex-col gap-0.5">
                            <code class="text-xs font-medium text-indigo-500">icon="fa-solid fa-plus" iconPos="left"</code>
                            <span class="text-xs text-gray-400">Icône à gauche (défaut)</span>
                        </div>
                        <x-button icon="fa-solid fa-plus">Nouveau</x-button>
                    </div>
                    <div class="flex items-center justify-between px-6 py-4">
                        <div class="flex flex-col gap-0.5">
                            <code class="text-xs font-medium text-indigo-500">icon="fa-solid fa-arrow-right" iconPos="right"</code>
                            <span class="text-xs text-gray-400">Icône à droite</span>
                        </div>
                        <x-button icon="fa-solid fa-arrow-right" iconPos="right">Suivant</x-button>
                    </div>
                    <div class="flex items-center justify-between px-6 py-4">
                        <div class="flex flex-col gap-0.5">
                            <code class="text-xs font-medium text-indigo-500">icon="fa-solid fa-trash" variant="danger"</code>
                            <span class="text-xs text-gray-400">Icône seule sans slot</span>
                        </div>
                        <x-button icon="fa-solid fa-trash" variant="danger"></x-button>
                    </div>
                </div>
            </section>

            {{-- 04 ÉTATS --}}
            <section class="flex flex-col gap-6">
                <div class="flex flex-col gap-1">
                    <span class="text-xs font-medium tracking-widest text-gray-400 uppercase">04</span>
                    <h2 class="text-xl font-semibold text-gray-900 tracking-tight">États</h2>
                    <p class="text-sm text-gray-400">Props <code class="bg-gray-100 px-1.5 py-0.5 rounded text-gray-600 text-xs">loading</code> et <code class="bg-gray-100 px-1.5 py-0.5 rounded text-gray-600 text-xs">disabled</code>.</p>
                </div>

                <div class="rounded-2xl border border-gray-100 bg-white shadow-xs divide-y divide-gray-50">
                    <div class="flex items-center justify-between px-6 py-4">
                        <div class="flex flex-col gap-0.5">
                            <code class="text-xs font-medium text-indigo-500">:loading="true"</code>
                            <span class="text-xs text-gray-400">Remplace l'icône par un spinner, bloque le clic</span>
                        </div>
                        <x-button :loading="true">Enregistrer</x-button>
                    </div>
                    <div class="flex items-center justify-between px-6 py-4">
                        <div class="flex flex-col gap-0.5">
                            <code class="text-xs font-medium text-indigo-500">:disabled="true"</code>
                            <span class="text-xs text-gray-400">Opacité réduite, pointer-events none</span>
                        </div>
                        <x-button :disabled="true">Désactivé</x-button>
                    </div>
                </div>
            </section>

            {{-- 05 LIEN --}}
            <section class="flex flex-col gap-6">
                <div class="flex flex-col gap-1">
                    <span class="text-xs font-medium tracking-widest text-gray-400 uppercase">05</span>
                    <h2 class="text-xl font-semibold text-gray-900 tracking-tight">Lien</h2>
                    <p class="text-sm text-gray-400">Prop <code class="bg-gray-100 px-1.5 py-0.5 rounded text-gray-600 text-xs">href</code> — rend une balise <code class="bg-gray-100 px-1.5 py-0.5 rounded text-gray-600 text-xs">&lt;a&gt;</code> au lieu d'un <code class="bg-gray-100 px-1.5 py-0.5 rounded text-gray-600 text-xs">&lt;button&gt;</code>.</p>
                </div>

                <div class="rounded-2xl border border-gray-100 bg-white shadow-xs p-6 flex items-center gap-4">
                    <x-button href="/dashboard" variant="ghost" icon="fa-solid fa-house">Accueil</x-button>
                    <x-button href="/dashboard" variant="outline" icon="fa-solid fa-arrow-right" iconPos="right">Voir le dashboard</x-button>
                </div>
            </section>

        </div>
@endsection
