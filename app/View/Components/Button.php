<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $variant = 'primary',  // primary | secondary | ghost | danger | outline
        public string $size = 'md',        // sm | md | lg
        public string $type = 'button',
        public bool $loading = false,
        public bool $disabled = false,
        public ?string $icon = null,        // fa class ex: "fa-solid fa-plus"
        public string $iconPos = 'left',      // left | right
        public ?string $href = null,        // if defined, render an <a>
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.button');
    }
}
