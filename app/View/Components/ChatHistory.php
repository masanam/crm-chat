<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ChatHistory extends Component
{
    /**
     * Create a new component instance.
     */
    public $title;
    public $typeTask;
    public $people;
    public $isUsingBtnPhone; 
    public $customHeader;
    public $isOneOnOneChat; 
    public $chatHistoryId; 
    public $type; 

    public function __construct(
        $title = 'Title',
        $typeTask = '',
        $people = [],
        $isUsingBtnPhone = true,
        $customHeader = '',
        $isOneOnOneChat = false,
        $chatHistoryId = '',
        $type = ''
    )
    {
        $this->title = $title;
        $this->typeTask = $typeTask;
        $this->people = $people;
        $this->isUsingBtnPhone = $isUsingBtnPhone;
        $this->customHeader = $customHeader;
        $this->isOneOnOneChat = $isOneOnOneChat;
        $this->chatHistoryId = $chatHistoryId;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.chat-history');
    }
}
