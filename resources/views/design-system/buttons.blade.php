{{-- resources/views/design-system/buttons.blade.php --}}

@extends('layouts.design-system')

@section('content')
        <div class="max-w-5xl mx-auto px-8 py-12 flex flex-col gap-16">

            {{-- 01 VARIANTS --}}
            <section class="flex flex-col gap-6">
                <div class="flex flex-col gap-1">
                    <span class="text-xs font-medium tracking-widest text-gray-400 uppercase">01</span>
                    <h2 class="text-xl font-semibold text-gray-900 tracking-tight">Variants</h2>
                    <p class="text-sm text-gray-400">Prop <code class="bg-gray-100 px-1.5 py-0.5 rounded text-gray-600 text-xs">variant</code> — defines the visual style of the button.</p>
                </div>

                <div class="rounded-2xl border border-gray-100 bg-white shadow-xs divide-y divide-gray-50">
                    @foreach([
                        ['primary',   'Main action, strong call-to-action'],
                        ['secondary', 'Secondary action, neutral'],
                        ['outline',   'Sober alternative to secondary'],
                        ['ghost',     'Discreet action, navigation, links'],
                        ['danger',    'Deletion, destructive action'],
                        ['success',   'Confirmation, validation'],
                        ['warning',   'Warning, risky action'],
                    ] as [$v, $desc])
                        <div class="flex items-center justify-between px-6 py-4">
                            <div class="flex flex-col gap-0.5 w-64">
                                <code class="text-xs font-medium text-indigo-500">variant="{{ $v }}"</code>
                                <span class="text-xs text-gray-400">{{ $desc }}</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <x-button variant="{{ $v }}">{{ ucfirst($v) }}</x-button>
                                <x-button variant="{{ $v }}" icon="fa-solid fa-bolt">With icon</x-button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            {{-- 02 SIZES --}}
            <section class="flex flex-col gap-6">
                <div class="flex flex-col gap-1">
                    <span class="text-xs font-medium tracking-widest text-gray-400 uppercase">02</span>
                    <h2 class="text-xl font-semibold text-gray-900 tracking-tight">Sizes</h2>
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

            {{-- 03 ICONS --}}
            <section class="flex flex-col gap-6">
                <div class="flex flex-col gap-1">
                    <span class="text-xs font-medium tracking-widest text-gray-400 uppercase">03</span>
                    <h2 class="text-xl font-semibold text-gray-900 tracking-tight">Icons</h2>
                    <p class="text-sm text-gray-400">Props <code class="bg-gray-100 px-1.5 py-0.5 rounded text-gray-600 text-xs">icon</code> + <code class="bg-gray-100 px-1.5 py-0.5 rounded text-gray-600 text-xs">iconPos</code> — accepts any Font Awesome class.</p>
                </div>

                <div class="rounded-2xl border border-gray-100 bg-white shadow-xs divide-y divide-gray-50">
                    <div class="flex items-center justify-between px-6 py-4">
                        <div class="flex flex-col gap-0.5">
                            <code class="text-xs font-medium text-indigo-500">icon="fa-solid fa-plus" iconPos="left"</code>
                            <span class="text-xs text-gray-400">Icon on the left (default)</span>
                        </div>
                        <x-button icon="fa-solid fa-plus">New</x-button>
                    </div>
                    <div class="flex items-center justify-between px-6 py-4">
                        <div class="flex flex-col gap-0.5">
                            <code class="text-xs font-medium text-indigo-500">icon="fa-solid fa-arrow-right" iconPos="right"</code>
                            <span class="text-xs text-gray-400">Icon on the right</span>
                        </div>
                        <x-button icon="fa-solid fa-arrow-right" iconPos="right">Next</x-button>
                    </div>
                    <div class="flex items-center justify-between px-6 py-4">
                        <div class="flex flex-col gap-0.5">
                            <code class="text-xs font-medium text-indigo-500">icon="fa-solid fa-trash" variant="danger"</code>
                            <span class="text-xs text-gray-400">Icon only without slot</span>
                        </div>
                        <x-button icon="fa-solid fa-trash" variant="danger"></x-button>
                    </div>
                </div>
            </section>

            {{-- 04 STATES --}}
            <section class="flex flex-col gap-6">
                <div class="flex flex-col gap-1">
                    <span class="text-xs font-medium tracking-widest text-gray-400 uppercase">04</span>
                    <h2 class="text-xl font-semibold text-gray-900 tracking-tight">States</h2>
                    <p class="text-sm text-gray-400">Props <code class="bg-gray-100 px-1.5 py-0.5 rounded text-gray-600 text-xs">loading</code> and <code class="bg-gray-100 px-1.5 py-0.5 rounded text-gray-600 text-xs">disabled</code>.</p>
                </div>

                <div class="rounded-2xl border border-gray-100 bg-white shadow-xs divide-y divide-gray-50">
                    <div class="flex items-center justify-between px-6 py-4">
                        <div class="flex flex-col gap-0.5">
                            <code class="text-xs font-medium text-indigo-500">:loading="true"</code>
                            <span class="text-xs text-gray-400">Replaces the icon with a spinner, blocks click</span>
                        </div>
                        <x-button :loading="true">Save</x-button>
                    </div>
                    <div class="flex items-center justify-between px-6 py-4">
                        <div class="flex flex-col gap-0.5">
                            <code class="text-xs font-medium text-indigo-500">:disabled="true"</code>
                            <span class="text-xs text-gray-400">Reduced opacity, pointer-events none</span>
                        </div>
                        <x-button :disabled="true">Disabled</x-button>
                    </div>
                </div>
            </section>

            {{-- 05 LINK --}}
            <section class="flex flex-col gap-6">
                <div class="flex flex-col gap-1">
                    <span class="text-xs font-medium tracking-widest text-gray-400 uppercase">05</span>
                    <h2 class="text-xl font-semibold text-gray-900 tracking-tight">Link</h2>
                    <p class="text-sm text-gray-400">Prop <code class="bg-gray-100 px-1.5 py-0.5 rounded text-gray-600 text-xs">href</code> — renders an <code class="bg-gray-100 px-1.5 py-0.5 rounded text-gray-600 text-xs">&lt;a&gt;</code> tag instead of a <code class="bg-gray-100 px-1.5 py-0.5 rounded text-gray-600 text-xs">&lt;button&gt;</code>.</p>
                </div>

                <div class="rounded-2xl border border-gray-100 bg-white shadow-xs p-6 flex items-center gap-4">
                    <x-button href="/dashboard" variant="ghost" icon="fa-solid fa-house">Home</x-button>
                    <x-button href="/dashboard" variant="outline" icon="fa-solid fa-arrow-right" iconPos="right">View dashboard</x-button>
                </div>
            </section>

        </div>
@endsection
