<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TextArea extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public ?string $name        = null,
        public ?string $label       = null,
        public ?string $placeholder = null,
        public ?string $value       = null,
        public ?string $hint        = null,
        public ?string $error       = null,
        public bool    $disabled    = false,
        public bool    $required    = false,
        public int     $rows        = 4,
        public bool    $resize      = true,
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.text-area');
    }
}
