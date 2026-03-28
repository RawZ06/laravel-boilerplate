@props(['align' => 'left'])

<div
    x-data="{
        open: false,
        x: 0,
        y: 0,
        align: '{{ $align }}',
        toggle(el) {
            const rect = el.getBoundingClientRect();
            this.y = rect.bottom + window.scrollY + 8;
            if (this.align === 'right') {
                this.x = rect.right + window.scrollX;
            } else if (this.align === 'center') {
                this.x = rect.left + window.scrollX + rect.width / 2;
            } else {
                this.x = rect.left + window.scrollX;
            }
            this.open = !this.open;
        }
    }"
    x-on:keydown.escape.window="open = false"
    x-on:click.outside="open = false"
    class="relative inline-block"
>
    {{-- Trigger --}}
    <div @click="toggle($el)" class="cursor-pointer">
        {{ $trigger }}
    </div>

    {{-- Panel téléporté dans body --}}
    <template x-teleport="body">
        <div
            x-show="open"
            x-transition:enter="transition ease-out duration-150"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-100"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            :style="{
                position: 'fixed',
                top: y + 'px',
                left: align === 'right' ? 'auto' : (align === 'center' ? 'auto' : x + 'px'),
                right: align === 'right' ? (document.documentElement.clientWidth - x) + 'px' : 'auto',
                transform: align === 'center' ? `translateX(-50%)` : 'none',
                display: open ? 'block' : 'none'
            }"
            class="z-[9999] min-w-48 bg-white dark:bg-slate-900 border border-gray-100 dark:border-slate-800 rounded-xl shadow-lg overflow-hidden"
            x-cloak
            @click.outside="open = false"
        >
            {{ $slot }}
        </div>
    </template>
</div>
