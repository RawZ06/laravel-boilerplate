<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public ?string $name = null,
        public ?string $label = null,
        public string $type = 'text',
        public ?string $placeholder = null,
        public ?string $value = null,
        public ?string $hint = null,
        public ?string $error = null,
        public bool $disabled = false,
        public bool $required = false,
        public ?string $icon = null,
        public string $iconPos = 'left',
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.input');
    }
}
