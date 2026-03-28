<?php

namespace App\View\Components\Feedback;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Badge extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $variant = 'gray',
        public string $size = 'md',
        public bool $dot = false,
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.feedback.badge');
    }
}
