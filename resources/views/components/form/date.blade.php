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

<div class="flex flex-col gap-1.5" x-data="{
    open: false,
    selected: '{{ $value }}',
    viewYear: null,
    viewMonth: null,
    today: null,
    init() {
        const base = this.selected ? new Date(this.selected) : new Date()
        this.today = new Date().toISOString().slice(0,10)
        this.viewYear  = base.getFullYear()
        this.viewMonth = base.getMonth()
    },
    get monthLabel() {
        return new Date(this.viewYear, this.viewMonth, 1)
            .toLocaleString('fr-FR', { month: 'long', year: 'numeric' })
            .replace(/^\w/, c => c.toUpperCase())
    },
    get days() {
        const firstDay = new Date(this.viewYear, this.viewMonth, 1).getDay()
        const offset   = (firstDay + 6) % 7
        const total    = new Date(this.viewYear, this.viewMonth + 1, 0).getDate()
        const cells    = []
        for (let i = 0; i < offset; i++) cells.push(null)
        for (let d = 1; d <= total; d++) {
            const iso = this.viewYear + '-' + String(this.viewMonth+1).padStart(2,'0') + '-' + String(d).padStart(2,'0')
            cells.push({ d, iso })
        }
        return cells
    },
    prevMonth() {
        if (this.viewMonth === 0) { this.viewMonth = 11; this.viewYear-- }
        else this.viewMonth--
    },
    nextMonth() {
        if (this.viewMonth === 11) { this.viewMonth = 0; this.viewYear++ }
        else this.viewMonth++
    },
    isDisabled(iso) {
        if ('{{ $min }}' && iso < '{{ $min }}') return true
        if ('{{ $max }}' && iso > '{{ $max }}') return true
        return false
    },
    pick(cell) {
        if (!cell || this.isDisabled(cell.iso)) return
        this.selected = cell.iso
        this.open = false
    },
    get displayValue() {
        if (!this.selected) return ''
        const [y, m, d] = this.selected.split('-')
        return d + '/' + m + '/' + y
    },
    clear() {
        this.selected = ''
    }
}" @click.outside="open = false">

    @if($label)
        <label for="{{ $name }}" class="text-sm font-medium text-gray-700">
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
                {{ $error    ? 'border-rose-300 bg-rose-50' : 'border-gray-200 bg-white hover:border-gray-300' }}
                {{ $disabled ? 'opacity-50 cursor-not-allowed' : '' }}"
            :class="open && !{{ $error ? 'true' : 'false' }} ? 'ring-2 ring-indigo-400 border-indigo-400' : ''"
        >
            {{-- Icône calendrier --}}
            <svg class="w-4 h-4 mr-2.5 shrink-0 {{ $error ? 'text-rose-300' : 'text-gray-300' }}"
                 fill="none" stroke="currentColor" stroke-width="2"
                 stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/>
            </svg>

            <span x-text="displayValue || 'jj/mm/aaaa'"
                  :class="selected ? 'text-gray-800' : 'text-gray-400'"
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
                class="absolute top-1.5 left-0 z-50 w-72 rounded-2xl border border-gray-100 bg-white shadow-lg p-4"
                style="display:none"
            >
                {{-- Header nav --}}
                <div class="flex items-center justify-between mb-3">
                    <button type="button" @click="prevMonth()"
                            class="p-1.5 rounded-lg hover:bg-gray-100 text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5"
                             stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <polyline points="15 18 9 12 15 6"/>
                        </svg>
                    </button>
                    <span class="text-sm font-semibold text-gray-700" x-text="monthLabel"></span>
                    <button type="button" @click="nextMonth()"
                            class="p-1.5 rounded-lg hover:bg-gray-100 text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5"
                             stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <polyline points="9 18 15 12 9 6"/>
                        </svg>
                    </button>
                </div>

                {{-- Jours de la semaine --}}
                <div class="grid grid-cols-7 mb-1">
                    <template x-for="day in ['Lu','Ma','Me','Je','Ve','Sa','Di']">
                        <div class="text-center text-xs font-medium text-gray-400 py-1" x-text="day"></div>
                    </template>
                </div>

                {{-- Grille --}}
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
                                    'bg-indigo-50 text-indigo-500 font-medium ring-1 ring-indigo-200': cell && cell.iso === today && selected !== cell.iso,
                                    'text-gray-700 hover:bg-gray-100': cell && selected !== cell.iso && cell.iso !== today && !isDisabled(cell.iso),
                                    'text-gray-200 cursor-not-allowed': cell && isDisabled(cell.iso),
                                }"
                                class="w-8 h-8 rounded-lg text-sm transition-colors duration-100"
                                x-text="cell ? cell.d : ''"
                            ></button>
                        </div>
                    </template>
                </div>

                {{-- Aujourd'hui --}}
                <div class="mt-3 pt-3 border-t border-gray-100">
                    <button type="button"
                            @click="if(!isDisabled(today)) { selected = today; open = false }"
                            class="w-full text-xs text-center text-indigo-500 hover:text-indigo-600 font-medium transition-colors">
                        Aujourd'hui
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
        <p class="text-xs text-gray-400">{{ $hint }}</p>
    @endif

</div>
