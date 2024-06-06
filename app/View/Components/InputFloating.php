<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputFloating extends Component
{
    /**
     * Create a new component instance.
     */
    public $placeholder;
    public $label;
    public $type;
    public $rows;
    public $cols;
    public $id;
    public $name;
    public $options;

    public function __construct(
        $placeholder = 'placeholder',
        $label = 'label',
        $type = 'text',
        $rows = 4,
        $cols = 30,
        $id = 'id',
        $name = 'id',
        $options = []
    )
    {
        $this->placeholder = $placeholder;
        $this->label = $label;
        $this->type = $type;
        $this->rows = $rows;
        $this->cols = $cols;
        $this->id = $id;
        $this->name = $name;
        $this->options = $options;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input-floating');
    }
}
