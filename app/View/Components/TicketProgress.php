<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Task;
use App\Models\TaskChat;

class TicketProgress extends Component
{
  public $model;
  public $chats;
  public $listTicketTypes;

  /**
   * Create a new component instance.
   */
  public function __construct($taskId)
  {
    $this->model = Task::with('client', 'status', 'team', 'member', 'lead', 'user')->find($taskId);
    $this->chats = TaskChat::with('profile')
      ->select('created_by')
      ->where('task_id', $this->model->id)
      ->groupBy('created_by')
      ->get();
  }

  /**
   * Get the view / contents that represent the component.
   */
  public function render(): View|Closure|string
  {
    return view('components.ticket-progress');
  }
}
