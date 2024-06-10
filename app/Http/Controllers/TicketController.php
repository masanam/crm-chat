<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kanban\TicketKanban;

class TicketController extends Controller
{
  public function index(TicketKanban $kanban)
  {
    return $kanban->render('content.ticket.index');
  }
}
