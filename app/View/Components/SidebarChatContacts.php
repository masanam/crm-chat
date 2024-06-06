<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SidebarChatContacts extends Component
{
    /**
     * Create a new component instance.
     */
    public $title;
    public $tabs;
    public $customHeader;
    public $isUsingFilterChat;
    public $placeholderSearchText;
    public $body;
    public $targetOpenModal;
    public $isUsingSearch;
    public $targetOpenModalFilter;
    public $wrapperClassname;

    public function __construct(
        $title = 'Chat',
        $tabs = [],
        $customHeader = '',
        $isUsingFilterChat = true,
        $placeholderSearchText = '',
        $body = '',
        $targetOpenModal = '',
        $isUsingSearch = true,
        $targetOpenModalFilter = '',
        $wrapperClassname = 'col-4'
    )
    {
        $this->title = $title;
        $this->tabs = $tabs;
        $this->customHeader = $customHeader;
        $this->isUsingFilterChat = $isUsingFilterChat;
        $this->placeholderSearchText = $placeholderSearchText;
        $this->body = $body;
        $this->targetOpenModal = $targetOpenModal;
        $this->isUsingSearch = $isUsingSearch;
        $this->targetOpenModalFilter = $targetOpenModalFilter;
        $this->wrapperClassname = $wrapperClassname;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar-chat-contacts');
    }
}
