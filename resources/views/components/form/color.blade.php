@props([
    'name'     => null,
    'label'    => null,
    'hint'     => null,
    'error'    => null,
    'value'    => '#6366f1',
    'disabled' => false,
    'required' => false,
    'swatches' => ['#6366f1','#8b5cf6','#ec4899','#ef4444','#f97316','#eab308','#22c55e','#14b8a6','#3b82f6','#0f172a','#6b7280','#ffffff'],
])

<div class="flex flex-col gap-1.5" x-data="color({ selected: '{{ $value }}', swatches: {{ json_encode($swatches) }} })" @click.outside="open = false">

    @if($label)
        <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
            {{ $label }}
            @if($required) <span class="text-rose-400">*</span> @endif
        </label>
    @endif

    <input type="hidden" name="{{ $name }}" :value="selected">

    <div class="relative">
        <div
            @click="{{ $disabled ? '' : 'open = !open' }}"
            class="flex items-center gap-3 w-full px-3.5 py-2.5 rounded-xl border text-sm transition-all duration-150 shadow-xs select-none
                {{ $error    ? 'border-rose-300 bg-rose-50 dark:border-rose-500/50 dark:bg-rose-500/10' : 'border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-900 hover:border-gray-300 dark:hover:border-slate-600' }}
                {{ $disabled ? 'opacity-50 cursor-not-allowed' : 'cursor-pointer' }}"
            :class="open ? 'ring-2 ring-indigo-400 border-indigo-400 dark:ring-indigo-500 dark:border-indigo-500' : ''"
        >
            <span class="w-5 h-5 rounded-md border border-black/10 dark:border-white/10 shrink-0 shadow-xs"
                  :style="'background:' + selected"></span>
            <span class="flex-1 text-gray-700 dark:text-slate-300 font-mono text-xs" x-text="selected.toUpperCase()"></span>
            <svg class="w-4 h-4 text-gray-300 dark:text-slate-600 transition-transform duration-200"
                 :class="open ? 'rotate-180' : ''"
                 fill="none" stroke="currentColor" stroke-width="2.5"
                 stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <polyline points="6 9 12 15 18 9"/>
            </svg>
        </div>

        <div
            x-show="open"
            x-transition:enter="transition ease-out duration-150"
            x-transition:enter-start="opacity-0 translate-y-1"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-100"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-1"
            class="absolute z-50 mt-2 w-full bg-white dark:bg-slate-900 border border-gray-100 dark:border-slate-800 rounded-2xl shadow-lg p-4 flex flex-col gap-4"
            style="display:none"
        >
            <div class="grid grid-cols-6 gap-2">
                <template x-for="color in swatches" :key="color">
                    <button
                        type="button"
                        @click="pick(color)"
                        :style="'background:' + color"
                        :class="selected === color ? 'ring-2 ring-offset-1 ring-indigo-400 dark:ring-offset-slate-900 scale-110' : 'hover:scale-110'"
                        class="w-8 h-8 rounded-lg border border-black/10 dark:border-white/10 shadow-xs transition-transform duration-100"
                    ></button>
                </template>
            </div>

            <div class="border-t border-gray-100 dark:border-slate-800"></div>

            <div class="flex items-center gap-3">
                <div class="relative w-10 h-10 shrink-0">
                    <span class="absolute inset-0 rounded-xl border border-black/10 dark:border-white/10 shadow-xs"
                          :style="'background:' + custom"></span>
                    <input
                        type="color"
                        :value="custom"
                        @input="onCustom($event)"
                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer rounded-xl"
                    >
                </div>
                <div class="flex flex-col gap-0.5">
                    <span class="text-xs font-medium text-gray-600 dark:text-slate-400">Custom color</span>
                    <span class="text-xs text-gray-400 dark:text-slate-500 font-mono" x-text="custom.toUpperCase()"></span>
                </div>
            </div>
        </div>
    </div>

    @if($error)
        <p class="text-xs text-rose-400 flex items-center gap-1">
            <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                 stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10"/><path d="M12 8v4m0 4h.01"/>
            </svg>
            {{ $error }}
        </p>
    @endif

    @if($hint && !$error)
        <p class="text-xs text-gray-400 dark:text-slate-500">{{ $hint }}</p>
    @endif

</div>
