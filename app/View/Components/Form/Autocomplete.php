<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Autocomplete extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public ?string $name = null,
        public ?string $label = null,
        public ?string $placeholder = 'Rechercher...',
        public ?string $hint = null,
        public ?string $error = null,
        public array $options = [],
        public ?string $selected = null,
        public bool $disabled = false,
        public bool $required = false,
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.autocomplete');
    }
}
