<?php

namespace App\View\Components\Feedback;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Toast extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $position = 'bottom-right',
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.feedback.toast');
    }
}
