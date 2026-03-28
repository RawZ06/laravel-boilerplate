@props([
    'name'        => null,
    'label'       => null,
    'placeholder' => 'Select...',
    'hint'        => null,
    'error'       => null,
    'options'     => [],
    'selected'    => null,
    'disabled'    => false,
    'required'    => false,
])

<div class="flex flex-col gap-1.5" x-data="{
    open: false,
    selected: '{{ $selected }}',
    selectedLabel: '',
    options: {{ Js::from($options) }},
    init() {
        const found = this.options.find(o => o.value == this.selected)
        if (found) this.selectedLabel = found.label
    },
    select(option) {
        this.selected = option.value
        this.selectedLabel = option.label
        this.open = false
    }
}" x-init="init()" @click.outside="open = false">

    @if($label)
        <label class="text-sm font-medium text-gray-700">
            {{ $label }}
            @if($required)
                <span class="text-rose-400">*</span>
            @endif
        </label>
    @endif

    {{-- Hidden input for submit --}}
    <input type="hidden" name="{{ $name }}" :value="selected">

    {{-- Trigger --}}
    <button
        type="button"
        @click="if (!{{ $disabled ? 'true' : 'false' }}) open = !open"
        :class="open ? 'ring-2 ring-indigo-400 border-indigo-400' : ''"
        class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl border
            {{ $error ? 'border-rose-300 bg-rose-50' : 'border-gray-200 bg-white' }}
            {{ $disabled ? 'opacity-50 cursor-not-allowed' : 'cursor-pointer hover:border-gray-300' }}
            text-sm transition-all duration-150 shadow-xs"
    >
        <span :class="selectedLabel ? 'text-gray-800' : 'text-gray-400'"
              x-text="selectedLabel || '{{ $placeholder }}'">
        </span>
        <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''"
             viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
             stroke-linejoin="round">
            <polyline points="4,6 8,10 12,6"/>
        </svg>
    </button>

    {{-- Dropdown --}}
    <div class="relative">
        <div
            x-show="open"
            x-transition:enter="transition ease-out duration-150"
            x-transition:enter-start="opacity-0 translate-y-1"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-100"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-1"
            class="absolute top-0 left-0 right-0 z-50 rounded-xl border border-gray-100 bg-white shadow-lg overflow-hidden"
            style="display:none"
        >
            <ul class="py-1.5 max-h-56 overflow-y-auto">
                <template x-for="option in options" :key="option.value">
                    <li
                        @click="select(option)"
                        :class="selected == option.value
                        ? 'bg-indigo-50 text-indigo-600 font-medium'
                        : 'text-gray-700 hover:bg-gray-50'"
                        class="flex items-center justify-between px-3.5 py-2.5 text-sm cursor-pointer transition-colors duration-100"
                    >
                        <span x-text="option.label"></span>
                        <svg x-show="selected == option.value"
                             class="w-4 h-4 text-indigo-500" viewBox="0 0 16 16" fill="none"
                             stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="3,8 6.5,11.5 13,4.5"/>
                        </svg>
                    </li>
                </template>
            </ul>
        </div>
    </div>


    @if($hint && !$error)
        <p class="text-xs text-gray-400">{{ $hint }}</p>
    @endif

    @if($error)
        <p class="text-xs text-rose-500">{{ $error }}</p>
    @endif

</div>
