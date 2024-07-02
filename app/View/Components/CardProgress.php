<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardProgress extends Component
{
  public $statusId;
  public $statusName;

  /**
   * Create a new component instance.
   */
  public function __construct($statusId = 1, $statusName = '')
  {
    $this->statusId = $statusId;
    $this->statusName = $statusName;
  }

  /**
   * Get the view / contents that represent the component.
   */
  public function render(): View|Closure|string
  {
    return view('components.card-progress');
  }
}
