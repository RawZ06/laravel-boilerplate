<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Color extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public ?string $name     = null,
        public ?string $label    = null,
        public ?string $hint     = null,
        public ?string $error    = null,
        public string  $value    = '#6366f1',
        public bool    $disabled = false,
        public bool    $required = false,
        public array   $swatches = [
            '#6366f1','#8b5cf6','#ec4899','#ef4444',
            '#f97316','#eab308','#22c55e','#14b8a6',
            '#3b82f6','#0f172a','#6b7280','#ffffff',
        ],
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.color');
    }
}
