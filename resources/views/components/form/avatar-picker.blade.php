@props([
    'name' => 'avatar',
    'value' => null,
    'label' => 'Avatar',
])

@php
    $styles = [
        'adventurer' => 'Adventurer',
        'avataaars' => 'Avataaars',
        'bottts' => 'Bottts',
        'fun-emoji' => 'Emoji',
        'lorelei' => 'Lorelei',
        'notionists' => 'Notionists',
        'open-peeps' => 'Peeps',
        'personas' => 'Personas',
        'pixel-art' => 'Pixel Art',
    ];

    $initialValue = old($name, $value);
    $isCustomUrl = $initialValue && str_starts_with($initialValue, 'http') && !str_contains($initialValue, 'api.dicebear.com');

    $initialStyle = 'adventurer';
    $initialSeed = '';

    if ($initialValue && str_contains($initialValue, 'api.dicebear.com')) {
        foreach (array_keys($styles) as $style) {
            if (str_contains($initialValue, "/$style/")) {
                $initialStyle = $style;
                break;
            }
        }

        if (preg_match('/seed=([^&]+)/', $initialValue, $matches)) {
            $initialSeed = $matches[1];
        }
    }
@endphp

<div x-data="avatarPicker({
    initialValue: '{{ $initialValue }}',
    mode: '{{ $isCustomUrl ? 'url' : 'generator' }}',
    style: '{{ $initialStyle }}',
    seed: '{{ $initialSeed }}',
    customUrl: '{{ $isCustomUrl ? $initialValue : '' }}'
})" class="space-y-4">
    <x-form.field :label="$label" :name="$name">
        <div class="flex items-center gap-4">
            <div class="relative group">
                <template x-if="currentAvatar">
                    <img :src="currentAvatar" alt="Avatar preview" class="w-20 h-20 rounded-full bg-slate-200 dark:bg-slate-800 border-2 border-indigo-500 object-cover">
                </template>
                <template x-if="!currentAvatar">
                    <div class="w-20 h-20 rounded-full bg-slate-200 dark:bg-slate-800 flex items-center justify-center border-2 border-dashed border-slate-300 dark:border-slate-700">
                        <i class="fa-solid fa-user text-slate-400 text-3xl"></i>
                    </div>
                </template>
            </div>

            <div class="flex flex-col gap-2">
                <x-button type="button" variant="secondary" size="sm" @click="openModal()">
                    <i class="fa-solid fa-pen-to-square mr-2"></i> Edit Avatar
                </x-button>

                <template x-if="currentAvatar">
                    <x-button type="button" variant="ghost" size="xs" @click="currentAvatar = ''; customUrl = ''; seed = '';" class="text-rose-500 hover:text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-500/10">
                        <i class="fa-solid fa-trash-can mr-1"></i> Delete
                    </x-button>
                </template>
            </div>
        </div>

        <input type="hidden" name="{{ $name }}" :value="currentAvatar">
    </x-form.field>

    <x-overlay.modal name="avatar-picker-modal" size="lg">
        <x-slot:header>
            <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Customize Avatar</h3>
            <p class="text-sm text-slate-500">Choose a style or enter a custom URL</p>
        </x-slot:header>

        <div class="space-y-6">
            {{-- Tabs --}}
            <div class="flex p-1 bg-slate-100 dark:bg-slate-800 rounded-xl w-full">
                <x-button type="button"
                    variant="secondary"
                    @click="draftMode = 'generator'; updateFromGenerator()"
                    x-bind:class="draftMode === 'generator' ? '!bg-white dark:!bg-slate-700 !shadow-sm !text-indigo-600 dark:!text-indigo-400' : '!bg-transparent !border-transparent !text-slate-500 hover:!text-slate-700 dark:hover:!text-slate-300'"
                    class="flex-1 !py-2 !text-sm !font-medium !rounded-lg transition-all">
                    DiceBear Generator
                </x-button>
                <x-button type="button"
                    variant="secondary"
                    @click="draftMode = 'url'; updateFromUrl()"
                    x-bind:class="draftMode === 'url' ? '!bg-white dark:!bg-slate-700 !shadow-sm !text-indigo-600 dark:!text-indigo-400' : '!bg-transparent !border-transparent !text-slate-500 hover:!text-slate-700 dark:hover:!text-slate-300'"
                    class="flex-1 !py-2 !text-sm !font-medium !rounded-lg transition-all">
                    Custom Link
                </x-button>
            </div>

            <div x-show="draftMode === 'generator'" class="space-y-6" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <x-form.select
                        label="Avatar Style"
                        name="avatar_style_select"
                        @change="draftStyle = $event.detail"
                        :selected="$initialStyle"
                        :options="array_map(fn($id, $label) => ['value' => $id, 'label' => $label], array_keys($styles), array_values($styles))"
                    />

                    <x-form.field label="Seed" name="avatar_seed">
                        <x-form.input x-model="draftSeed" @input.debounce.300ms="updateFromGenerator()" placeholder="Ex: John, 123, etc." />
                    </x-form.field>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-3">Examples</label>
                    <div class="grid grid-cols-5 gap-3">
                        <template x-for="example in ['Alex', 'Jordan', 'Taylor', 'Morgan', 'Casey']" :key="example">
                            <x-button type="button"
                                variant="secondary"
                                @click="selectExample(example)"
                                class="!p-0 aspect-square rounded-xl border-2 transition-all hover:scale-105 overflow-hidden flex items-center justify-center bg-slate-50 dark:bg-slate-800"
                                x-bind:class="draftSeed === example ? '!border-indigo-500 ring-2 ring-indigo-500/20' : '!border-transparent hover:!border-slate-300 dark:hover:!border-slate-700'">
                                <img :src="`https://api.dicebear.com/7.x/${draftStyle}/svg?seed=${example}`"
                                     class="w-full h-full object-cover"
                                     loading="lazy">
                            </x-button>
                        </template>
                    </div>
                </div>
            </div>

            {{-- URL Content --}}
            <div x-show="draftMode === 'url'" class="space-y-4" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2">
                <x-form.field label="Image URL" name="avatar_url_input">
                    <x-form.input x-model="draftCustomUrl" @input.debounce.300ms="updateFromUrl()" placeholder="https://images.com/my-photo.jpg" />
                </x-form.field>
                <div class="p-4 bg-indigo-50 dark:bg-indigo-500/5 rounded-xl border border-indigo-100 dark:border-indigo-500/20">
                    <p class="text-xs text-indigo-700 dark:text-indigo-300">
                        <i class="fa-solid fa-circle-info mr-1"></i>
                        Use a direct link to an image (PNG, JPG, SVG).
                    </p>
                </div>
            </div>

            {{-- Preview in Modal --}}
            <div class="flex items-center justify-center py-6 border-t border-slate-100 dark:border-slate-800">
                <div class="text-center">
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-3">Final Preview</p>
                    <div class="relative inline-block">
                        <template x-if="draftAvatar">
                            <div class="relative">
                                <img :src="draftAvatar"
                                     :class="isLoading ? 'opacity-50 blur-sm' : 'opacity-100'"
                                     class="w-32 h-32 rounded-full border-4 border-white dark:border-slate-800 shadow-xl bg-slate-50 dark:bg-slate-900 object-cover transition-all duration-300">
                                <div x-show="isLoading" class="absolute inset-0 flex items-center justify-center">
                                    <i class="fa-solid fa-circle-notch fa-spin text-indigo-500 text-2xl"></i>
                                </div>
                            </div>
                        </template>
                        <template x-if="!draftAvatar">
                            <div class="w-32 h-32 rounded-full border-4 border-dashed border-slate-200 dark:border-slate-800 flex items-center justify-center bg-slate-50 dark:bg-slate-900">
                                <i class="fa-solid fa-user text-slate-300 text-5xl"></i>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>

        <x-slot:footer>
            <x-button type="button" variant="secondary" @click="cancel()">Cancel</x-button>
            <x-button type="button" variant="primary" @click="confirm()">Confirm</x-button>
        </x-slot:footer>
    </x-overlay.modal>
</div>
