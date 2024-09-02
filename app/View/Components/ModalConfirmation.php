<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalConfirmation extends Component
{
    /**
   * Create a new component instance.
   */
  public $modalClass;
  public $title;
  public $subtitle;
  public $isUsingBtnFooter;
  public $submitText;
  public $name;
  public $buttonWrapperSubmitClass;
  public $wrapperModalClass;

  public function __construct(
    $modalClass = 'modal-sm',
    $title = 'Are you sure?',
    $subtitle = 'You wont be able to revert this!',
    $isUsingBtnFooter = true,
    $submitText = 'Save',
    $name = 'modal',
    $buttonWrapperSubmitClass = '',
    $wrapperModalClass = '',
  ) {
    $this->modalClass = $modalClass;
    $this->title = $title;
    $this->subtitle = $subtitle;
    $this->isUsingBtnFooter = $isUsingBtnFooter;
    $this->submitText = $submitText;
    $this->name = $name;
    $this->buttonWrapperSubmitClass = $buttonWrapperSubmitClass;
    $this->wrapperModalClass = $wrapperModalClass;
  }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal-confirmation');
    }
}
