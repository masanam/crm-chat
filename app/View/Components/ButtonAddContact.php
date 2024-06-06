<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ButtonAddContact extends Component
{
    /**
     * Create a new component instance.
     */
    public $target;
    public $name;

    public function __construct($target = '', $name = '-')
    {
        $this->target = $target;
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.button-add-contact');
    }
}
