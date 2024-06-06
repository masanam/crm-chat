<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Modal extends Component
{
    /**
     * Create a new component instance.
     */
    public $modalClass;
    public $title;
    public $isUsingBtnFooter;
    public $submitText;
    public $name;
    public $isModalStack;
    public $targetNameModalStack;
    public $isUsingButtonClose;
    public $buttonWrapperSubmitClass;
    public $buttonSubmitClass;
    public $isUsingHeaderTitle;
    public $sideRightHeader;
    public $wrapperModalClass;

    public function __construct(
        $modalClass = 'modal-sm',
        $title = 'title',
        $isUsingBtnFooter = true,
        $submitText = 'Save',
        $name = 'modal',
        $isModalStack = false,
        $targetNameModalStack = '',
        $isUsingButtonClose = true,
        $buttonWrapperSubmitClass = '',
        $buttonSubmitClass = 'w-100',
        $isUsingHeaderTitle = true,
        $sideRightHeader = '',
        $wrapperModalClass = ''
    )
    {
        $this->modalClass = $modalClass;
        $this->title = $title;
        $this->isUsingBtnFooter = $isUsingBtnFooter;
        $this->submitText = $submitText;
        $this->name = $name;
        $this->isModalStack = $isModalStack;
        $this->targetNameModalStack = $targetNameModalStack;
        $this->isUsingButtonClose = $isUsingButtonClose;
        $this->buttonWrapperSubmitClass = $buttonWrapperSubmitClass;
        $this->buttonSubmitClass = $buttonSubmitClass;
        $this->isUsingHeaderTitle = $isUsingHeaderTitle;
        $this->sideRightHeader = $sideRightHeader;
        $this->wrapperModalClass = $wrapperModalClass;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal');
    }
}
