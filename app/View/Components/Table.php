<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Table extends Component
{
    /**
     * Create a new component instance.
     */
    public $title;
    public $badge;
    public $buttonHeaderName;
    public $buttonHeaderTarget;
    public $headers;
    public $isSelectedTable;

    public function __construct(
        $title = 'title',
        $badge = '',
        $buttonHeaderName = 'add',
        $buttonHeaderTarget = '',
        $headers = [],
        $isSelectedTable = false
    )
    {
        $this->title = $title;
        $this->badge = $badge;
        $this->buttonHeaderName = $buttonHeaderName;
        $this->buttonHeaderTarget = $buttonHeaderTarget;
        $this->headers = $headers;
        $this->isSelectedTable = $isSelectedTable;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.table');
    }
}
