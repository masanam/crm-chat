<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardChat extends Component
{
    /**
     * Create a new component instance.
     */
    public $title;
    public $subtitle;
    public $rightBody;
    public $countUnread;
    public $totalMember;
    public $time;
    public $customTitle;

    public function __construct(
        $title = '-',
        $subtitle = '',
        $rightBody = '',
        $countUnread = 0,
        $totalMember = 0,
        $time = '',
        $customTitle = ''
    ) {
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->rightBody = $rightBody;
        $this->countUnread = $countUnread;
        $this->totalMember = $totalMember;
        $this->time = $time;
        $this->customTitle = $customTitle;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card-chat');
    }
}
