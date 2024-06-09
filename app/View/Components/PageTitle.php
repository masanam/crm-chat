<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PageTitle extends Component
{
    /**
     * Create a new component instance.
     */
    public $placeholderSearchText;
    public $title;
    public $isUsingMultipleView;
    public $targetOpenModal;

    public function __construct(
        $placeholderSearchText = 'placeholder',
        $title = 'Title',
        $isUsingMultipleView = true,
        $targetOpenModal = ''
    )
    {
        $this->placeholderSearchText = $placeholderSearchText;
        $this->title = $title;
        $this->isUsingMultipleView = $isUsingMultipleView;
        $this->targetOpenModal = $targetOpenModal;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.page-title');
    }
}
