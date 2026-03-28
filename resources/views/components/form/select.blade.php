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

<div class="flex flex-col gap-1.5" x-data="select({ selected: '{{ $selected }}', options: {{ Js::from($options) }} })" @click.outside="open = false">

    @if($label)
        <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
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
        :class="open ? 'ring-2 ring-indigo-400 border-indigo-400 dark:ring-indigo-500 dark:border-indigo-500' : ''"
        class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl border
            {{ $error ? 'border-rose-300 bg-rose-50 dark:border-rose-500/50 dark:bg-rose-500/10' : 'border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-900' }}
            {{ $disabled ? 'opacity-50 cursor-not-allowed' : 'cursor-pointer hover:border-gray-300 dark:hover:border-slate-600' }}
            text-sm transition-all duration-150 shadow-xs"
    >
        <span :class="selectedLabel ? 'text-gray-800 dark:text-slate-200' : 'text-gray-400 dark:text-slate-500'"
              x-text="selectedLabel || '{{ $placeholder }}'">
        </span>
        <svg class="w-4 h-4 text-gray-400 dark:text-slate-500 transition-transform duration-200" :class="open ? 'rotate-180' : ''"
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
            class="absolute top-0 left-0 right-0 z-50 rounded-xl border border-gray-100 dark:border-slate-800 bg-white dark:bg-slate-900 shadow-lg overflow-hidden"
            style="display:none"
        >
            <ul class="py-1.5 max-h-56 overflow-y-auto">
                <template x-for="option in options" :key="option.value">
                    <li
                        @click="select(option)"
                        :class="selected == option.value
                        ? 'bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 font-medium'
                        : 'text-gray-700 dark:text-slate-300 hover:bg-gray-50 dark:hover:bg-slate-800'"
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
        <p class="text-xs text-gray-400 dark:text-gray-500">{{ $hint }}</p>
    @endif

    @if($error)
        <p class="text-xs text-rose-500">{{ $error }}</p>
    @endif

</div>
