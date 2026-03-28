@props(['position' => 'bottom-right'])

@php
    $positions = [
        'top-left'     => 'top-4 left-4',
        'top-center'   => 'top-4 left-1/2 -translate-x-1/2',
        'top-right'    => 'top-4 right-4',
        'bottom-left'  => 'bottom-4 left-4',
        'bottom-center'=> 'bottom-4 left-1/2 -translate-x-1/2',
        'bottom-right' => 'bottom-4 right-4',
    ];

    $pos = $positions[$position] ?? $positions['bottom-right'];
@endphp

<div
    x-data="{
        toasts: [],
        add(toast) {
            const id = Date.now()
            this.toasts.push({ id, ...toast, visible: false })
            this.$nextTick(() => {
                const t = this.toasts.find(t => t.id === id)
                if (t) t.visible = true
            })
            if (toast.duration !== 0) {
                setTimeout(() => this.remove(id), toast.duration ?? 4000)
            }
        },
        remove(id) {
            const t = this.toasts.find(t => t.id === id)
            if (t) {
                t.visible = false
                setTimeout(() => this.toasts = this.toasts.filter(t => t.id !== id), 300)
            }
        }
    }"
    @toast.window="add($event.detail)"
    class="fixed z-50 flex flex-col gap-2 {{ $pos }}"
>
    <template x-for="toast in toasts" :key="toast.id">
        <div
            x-show="toast.visible"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-2 scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
            x-transition:leave-end="opacity-0 translate-y-2 scale-95"
            class="flex items-start gap-3 px-4 py-3 rounded-xl shadow-lg border bg-white w-80"
            :class="{
                'border-blue-200':   toast.variant === 'info',
                'border-green-200':  toast.variant === 'success',
                'border-yellow-200': toast.variant === 'warning',
                'border-red-200':    toast.variant === 'error',
            }"
        >
            {{-- Icon --}}
            <span
                class="mt-0.5 text-sm"
                :class="{
                    'text-blue-500':   toast.variant === 'info',
                    'text-green-500':  toast.variant === 'success',
                    'text-yellow-500': toast.variant === 'warning',
                    'text-red-500':    toast.variant === 'error',
                }"
            >
                <i
                    class="fa-fw fa-solid"
                    :class="{
                        'fa-circle-info':          toast.variant === 'info',
                        'fa-circle-check':         toast.variant === 'success',
                        'fa-triangle-exclamation': toast.variant === 'warning',
                        'fa-circle-xmark':         toast.variant === 'error',
                    }"
                ></i>
            </span>

            {{-- Content --}}
            <div class="flex-1 flex flex-col gap-0.5">
                <p x-show="toast.title" x-text="toast.title" class="text-sm font-semibold text-gray-800"></p>
                <p x-text="toast.message" class="text-sm text-gray-500"></p>
            </div>

            {{-- Close --}}
            <button @click="remove(toast.id)" class="shrink-0 text-gray-400 hover:text-gray-600 transition-colors cursor-pointer">
                <i class="fa-solid fa-xmark text-sm"></i>
            </button>
        </div>
    </template>
</div>
