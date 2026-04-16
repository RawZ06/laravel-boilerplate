<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Field extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public ?string $label = null,
        public ?string $hint = null,
        public ?string $error = null,
        public bool $required = false,
        public ?string $name = null,
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.field');
    }
}
