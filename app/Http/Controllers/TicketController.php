<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

use App\Kanban\TicketKanban;
use App\Models\Task;

class TicketController extends Controller
{
  public function index(TicketKanban $kanban)
  {
    return view('content.ticket.index');
  }
}
