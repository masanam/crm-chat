<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardActivities extends Component
{
    /**
     * Create a new component instance.
     */
    public $title;
    public $createdAt;
    public $subtitle;
    public function __construct(
        $title = '',
        $createdAt = '',
        $subtitle = 'for you'
    )
    {
        $this->title = $title;
        $this->createdAt = $createdAt;
        $this->subtitle = $subtitle;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card-activities');
    }
}
