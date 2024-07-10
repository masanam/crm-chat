<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Task;
use App\Models\Contact;

class ClientTicket extends Component
{
  public $model;
  public $contacts;
  public $taskId;

  /**
   * Create a new component instance.
   */
  public function __construct($taskId = '')
  {
    $this->model = Task::with('client', 'status', 'team', 'member', 'lead', 'user')->find($taskId);
    $this->contacts = Contact::where('client_id', $this->model->client_id)->get();
  }

  /**
   * Get the view / contents that represent the component.
   */
  public function render(): View|Closure|string
  {
    return view('components.client-ticket');
  }
}
