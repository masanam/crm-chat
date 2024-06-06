<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BadgeStatusCall extends Component
{
    /**
     * Create a new component instance.
     */
    public $status;

    public function __construct($status = 'incoming')
    {
        $this->status = $status;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.badge-status-call');
    }
}
