@props([
    'name'        => null,
    'label'       => null,
    'placeholder' => 'Search...',
    'hint'        => null,
    'error'       => null,
    'options'     => [],
    'selected'    => null,
    'disabled'    => false,
    'required'    => false,
])

<div class="flex flex-col gap-1.5" x-data="{
    open: false,
    query: '',
    selected: '{{ $selected }}',
    selectedLabel: '',
    options: {{ Js::from($options) }},
    get filtered() {
        if (this.query === '') return this.options
        return this.options.filter(o =>
            o.label.toLowerCase().includes(this.query.toLowerCase())
        )
    },
    init() {
        const found = this.options.find(o => o.value == this.selected)
        if (found) {
            this.selectedLabel = found.label
            this.query = found.label
        }
    },
    select(option) {
        this.selected = option.value
        this.selectedLabel = option.label
        this.query = option.label
        this.open = false
    },
    clear() {
        this.selected = ''
        this.selectedLabel = ''
        this.query = ''
        this.open = false
    }
}" @click.outside="open = false; if (!selectedLabel) query = ''">

    @if($label)
        <label for="{{ $name }}" class="text-sm font-medium text-gray-700 dark:text-gray-300">
            {{ $label }}
            @if($required) <span class="text-rose-400">*</span> @endif
        </label>
    @endif

    {{-- Hidden input --}}
    <input type="hidden" name="{{ $name }}" :value="selected">

    {{-- Visible input --}}
    <div class="relative">
        <div class="relative">
            {{-- Search icon --}}
            <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-300 dark:text-slate-600 pointer-events-none"
                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
            </svg>

            <input
                id="{{ $name }}"
                type="text"
                x-model="query"
                @focus="open = true"
                @input="open = true; selected = ''; selectedLabel = ''"
                @keydown.escape="open = false; if (!selectedLabel) query = ''"
                @keydown.tab="open = false"
                placeholder="{{ $placeholder }}"
                {{ $disabled ? 'disabled' : '' }}
                class="w-full pl-9 pr-9 py-2.5 rounded-xl border text-sm transition-all duration-150 shadow-xs outline-none
                    {{ $error ? 'border-rose-300 bg-rose-50 dark:border-rose-500/50 dark:bg-rose-500/10 focus:ring-2 focus:ring-rose-300 focus:border-rose-400' : 'border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-gray-800 dark:text-slate-200 focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 hover:border-gray-300 dark:hover:border-slate-600' }}
                    {{ $disabled ? 'opacity-50 cursor-not-allowed' : '' }}"
            >

            {{-- Clear cross --}}
            <button
                type="button"
                x-show="query !== ''"
                @click="clear()"
                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-300 hover:text-gray-500 transition-colors"
                style="display:none"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5"
                     stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <path d="M18 6 6 18M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Dropdown --}}
        <div class="relative">
            <div
                x-show="open && filtered.length > 0"
                x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="opacity-0 translate-y-1"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-100"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 translate-y-1"
                class="absolute top-1.5 left-0 right-0 z-50 rounded-xl border border-gray-100 dark:border-slate-800 bg-white dark:bg-slate-900 shadow-lg overflow-hidden"
                style="display:none"
            >
                <ul class="py-1.5 max-h-56 overflow-y-auto">
                    <template x-for="option in filtered" :key="option.value">
                        <li
                            @click="select(option)"
                            :class="selected == option.value
                                ? 'bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 font-medium'
                                : 'text-gray-700 dark:text-slate-300 hover:bg-gray-50 dark:hover:bg-slate-800'"
                            class="flex items-center justify-between px-3.5 py-2.5 text-sm cursor-pointer transition-colors duration-100"
                        >
                            <span x-text="option.label"></span>
                            <svg x-show="selected == option.value"
                                 class="w-4 h-4 text-indigo-500 shrink-0" viewBox="0 0 16 16" fill="none"
                                 stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="3,8 6.5,11.5 13,4.5"/>
                            </svg>
                        </li>
                    </template>
                </ul>
            </div>

            {{-- No Result --}}
            <div
                x-show="open && filtered.length === 0"
                x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="opacity-0 translate-y-1"
                x-transition:enter-end="opacity-100 translate-y-0"
                class="absolute top-1.5 left-0 right-0 z-50 rounded-xl border border-gray-100 dark:border-slate-800 bg-white dark:bg-slate-900 shadow-lg px-4 py-3"
                style="display:none"
            >
                <p class="text-sm text-gray-400">No result for "<span x-text="query"></span>"</p>
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
