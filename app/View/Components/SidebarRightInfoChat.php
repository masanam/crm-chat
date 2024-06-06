<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SidebarRightInfoChat extends Component
{
    /**
     * Create a new component instance.
     */
    public $title;
    public $time;
    public $name;
    public $subtitle;
    public $email;
    public $isUsingBtnHeader;
    public $btnHeaderName;
    public $isUsingBtnEdit;
    public $customAvatarClass;
    public $customSubtitleClass;
    public $sidebarClass;

    public function __construct(
        $title = 'Title',
        $time = '',
        $name = '',
        $subtitle = '',
        $email = '',
        $isUsingBtnHeader = true,
        $btnHeaderName = 'Create Task',
        $isUsingBtnEdit = true,
        $customAvatarClass = '',
        $customSubtitleClass = '',
        $sidebarClass = 'sidebar-group'
    )
    {
        $this->title = $title;
        $this->time = $time;
        $this->name = $name;
        $this->subtitle = $subtitle;
        $this->email = $email;
        $this->isUsingBtnHeader = $isUsingBtnHeader;
        $this->btnHeaderName = $btnHeaderName;
        $this->isUsingBtnEdit = $isUsingBtnEdit;
        $this->customAvatarClass = $customAvatarClass;
        $this->customSubtitleClass = $customSubtitleClass;
        $this->sidebarClass = $sidebarClass;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar-right-info-chat');
    }
}
