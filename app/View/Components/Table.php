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
    public $isUsingTableHeader;
    public $isUsingTableResponsive;
    public $wrapperClass;
    public $isDisableButtonHeader;
    public $isUsingHeaderAction;

    public function __construct(
        $title = 'title',
        $badge = '',
        $buttonHeaderName = 'add',
        $buttonHeaderTarget = '',
        $headers = [],
        $isSelectedTable = false,
        $isUsingTableHeader = true,
        $isUsingTableResponsive = true,
        $isDisableButtonHeader = true,
        $isUsingHeaderAction = true,
    )
    {
        $this->title = $title;
        $this->badge = $badge;
        $this->buttonHeaderName = $buttonHeaderName;
        $this->buttonHeaderTarget = $buttonHeaderTarget;
        $this->headers = $headers;
        $this->isSelectedTable = $isSelectedTable;
        $this->isUsingTableHeader = $isUsingTableHeader;
        $this->isUsingTableResponsive = $isUsingTableResponsive;
        $this->isDisableButtonHeader = $isDisableButtonHeader;
        $this->isUsingHeaderAction = $isUsingHeaderAction;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.table');
    }
}
