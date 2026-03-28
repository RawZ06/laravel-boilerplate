<?php

namespace App\View\Components\Table;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SearchBar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string  $name        = 'q',
        public ?string $placeholder = 'Rechercher…',
        public ?string $value       = null,
    ) {
        $this->value = $value ?? request($this->name, '');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.table.search-bar');
    }
}
