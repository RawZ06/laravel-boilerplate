@props([
    'name'     => null,
    'label'    => null,
    'hint'     => null,
    'error'    => null,
    'value'    => null,
    'min'      => null,
    'max'      => null,
    'disabled' => false,
    'required' => false,
])

<div class="flex flex-col gap-1.5" x-data="date({ selected: '{{ $value }}', min: '{{ $min }}', max: '{{ $max }}' })" @click.outside="open = false">

    @if($label)
        <label for="{{ $name }}" class="text-sm font-medium text-gray-700 dark:text-gray-300">
            {{ $label }}
            @if($required) <span class="text-rose-400">*</span> @endif
        </label>
    @endif

    <input type="hidden" name="{{ $name }}" :value="selected">

    <div class="relative">
        {{-- Trigger --}}
        <div
            @click="{{ $disabled ? '' : 'open = !open' }}"
            class="flex items-center w-full px-3.5 py-2.5 rounded-xl border text-sm cursor-pointer transition-all duration-150 shadow-xs select-none
                {{ $error    ? 'border-rose-300 bg-rose-50 dark:border-rose-500/50 dark:bg-rose-500/10' : 'border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-900 hover:border-gray-300 dark:hover:border-slate-600' }}
                {{ $disabled ? 'opacity-50 cursor-not-allowed' : '' }}"
            :class="open && !{{ $error ? 'true' : 'false' }} ? 'ring-2 ring-indigo-400 border-indigo-400 dark:ring-indigo-500 dark:border-indigo-500' : ''"
        >
            {{-- Calendar icon --}}
            <svg class="w-4 h-4 mr-2.5 shrink-0 {{ $error ? 'text-rose-300 dark:text-rose-400' : 'text-gray-300 dark:text-slate-600' }}"
                 fill="none" stroke="currentColor" stroke-width="2"
                 stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/>
            </svg>

            <span x-text="displayValue || 'mm/dd/yyyy'"
                  :class="selected ? 'text-gray-800 dark:text-slate-200' : 'text-gray-400 dark:text-slate-500'"
                  class="flex-1"></span>

            {{-- Clear --}}
            <button type="button" x-show="selected !== ''"
                    @click.stop="clear()"
                    class="text-gray-300 hover:text-gray-500 transition-colors mr-1"
                    style="display:none">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5"
                     stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <path d="M18 6 6 18M6 6l12 12"/>
                </svg>
            </button>

            {{-- Chevron --}}
            <svg class="w-4 h-4 text-gray-300 transition-transform duration-200"
                 :class="open ? 'rotate-180' : ''"
                 fill="none" stroke="currentColor" stroke-width="2"
                 stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <polyline points="6 9 12 15 18 9"/>
            </svg>
        </div>

        {{-- Calendar dropdown --}}
        <div class="relative">
            <div
                x-show="open"
                x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="opacity-0 translate-y-1"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-100"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 translate-y-1"
                class="absolute top-1.5 left-0 z-50 w-72 rounded-2xl border border-gray-100 dark:border-slate-800 bg-white dark:bg-slate-900 shadow-lg p-4"
                style="display:none"
            >
                {{-- Header nav --}}
                <div class="flex items-center justify-between mb-3">
                    <button type="button" @click="prevMonth()"
                            class="p-1.5 rounded-lg hover:bg-gray-100 dark:hover:bg-slate-800 text-gray-400 dark:text-slate-500 hover:text-gray-600 dark:hover:text-slate-300 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5"
                             stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <polyline points="15 18 9 12 15 6"/>
                        </svg>
                    </button>
                    <span class="text-sm font-semibold text-gray-700 dark:text-slate-300" x-text="monthLabel"></span>
                    <button type="button" @click="nextMonth()"
                            class="p-1.5 rounded-lg hover:bg-gray-100 dark:hover:bg-slate-800 text-gray-400 dark:text-slate-500 hover:text-gray-600 dark:hover:text-slate-300 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5"
                             stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <polyline points="9 18 15 12 9 6"/>
                        </svg>
                    </button>
                </div>

                {{-- Week days --}}
                <div class="grid grid-cols-7 mb-1">
                    <template x-for="day in ['Mo','Tu','We','Th','Fr','Sa','Su']">
                        <div class="text-center text-xs font-medium text-gray-400 dark:text-slate-500 py-1" x-text="day"></div>
                    </template>
                </div>

                {{-- Grid --}}
                <div class="grid grid-cols-7 gap-y-0.5">
                    <template x-for="(cell, i) in days" :key="i">
                        <div class="flex items-center justify-center">
                            <button
                                type="button"
                                x-show="cell !== null"
                                @click="pick(cell)"
                                :disabled="cell && isDisabled(cell.iso)"
                                :class="{
                                    'bg-indigo-500 text-white font-semibold hover:bg-indigo-600': cell && selected === cell.iso,
                                    'bg-indigo-50 dark:bg-indigo-500/10 text-indigo-500 dark:text-indigo-400 font-medium ring-1 ring-indigo-200 dark:ring-indigo-500/30': cell && cell.iso === today && selected !== cell.iso,
                                    'text-gray-700 dark:text-slate-300 hover:bg-gray-100 dark:hover:bg-slate-800': cell && selected !== cell.iso && cell.iso !== today && !isDisabled(cell.iso),
                                    'text-gray-200 dark:text-slate-700 cursor-not-allowed': cell && isDisabled(cell.iso),
                                }"
                                class="w-8 h-8 rounded-lg text-sm transition-colors duration-100"
                                x-text="cell ? cell.d : ''"
                            ></button>
                        </div>
                    </template>
                </div>

                {{-- Today --}}
                <div class="mt-3 pt-3 border-t border-gray-100 dark:border-slate-800">
                    <button type="button"
                            @click="if(!isDisabled(today)) { selected = today; open = false }"
                            class="w-full text-xs text-center text-indigo-500 hover:text-indigo-600 dark:text-indigo-400 font-medium transition-colors">
                        Today
                    </button>
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
