<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardPlan extends Component
{
    /**
     * Create a new component instance.
     */
    public $id;
    public $headerTitle;
    public $contentTitle;
    public $contentSubtitle;
    public $customWidth;
    public $isUsingDollarSign;
    public $contentRight;

    public function __construct(
        $id = '',
        $headerTitle = 'header title',
        $contentTitle = 'content title',
        $contentSubtitle = 'content subtitle',
        $customWidth = '284px',
        $isUsingDollarSign = true,
        $contentRight = '',
    )
    {
        $this->id = $id;
        $this->headerTitle = $headerTitle;
        $this->contentTitle = $contentTitle;
        $this->contentSubtitle = $contentSubtitle;
        $this->customWidth = $customWidth;
        $this->isUsingDollarSign = $isUsingDollarSign;
        $this->contentRight = $contentRight;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card-plan');
    }
}
