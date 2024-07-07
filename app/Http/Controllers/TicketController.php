<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\Team;
use App\Models\Client;
use App\Models\AssignedLead;

class TicketController extends Controller
{
  public function index(Request $request)
  {
    try {
      $validator = Validator::make($request->all(), [
        'q' => ['string'],
      ]);

      if ($validator->fails()) {
        return redirect('index')
          ->withErrors($validator)
          ->withInput();
      }

      $params = $validator->validate();

      $perPage = $params['per_page'] ?? 20;
      $search = $params['q'] ?? null;

      $clients = $clients = DB::select(
        'select
            c.id, o.name as text
        from
            clients c
        join organizations o on o.id = c.organization_id 
        where c.name like ? or o.name like ?
      ',
        ['%' . $search . '%', '%' . $search . '%']
      );

      $statuses = TaskStatus::all();
      $teams = Team::all();

      return view('content.ticket.index', compact('clients', 'statuses', 'teams'));
    } catch (\Exception $e) {
      return view('content.ticket.index');
    }
  }

  public function upsert(Request $request): RedirectResponse
  {
    try {
      $validator = Validator::make($request->all(), [
        'title' => ['string', 'required'],
        'code' => ['string', 'required'],
        'deadline' => ['date', 'required'],
        'priority' => ['string', 'required'],
        'client_id' => ['integer', 'required'],
        'status_id' => ['integer', 'required'],
        'team_id' => ['integer'],
        'member_id' => ['integer'],
        'internal_note' => ['string'],
      ]);

      $params = $validator->validate();

      $assignedLead = AssignedLead::where('profile_id', Auth::user()->profile_id)->first();

      $model = Task::updateOrCreate(
        [
          'id' => $request->id,
        ],
        [
          'title' => $params['title'],
          'code' => $params['code'],
          'deadline' => $params['deadline'],
          'priority' => $params['priority'],
          'client_id' => $params['client_id'],
          'status_id' => $params['status_id'],
          'team_id' => $params['team_id'],
          'member_id' => $params['member_id'],
          'lead_id' => $assignedLead->lead_id ?? null,
          'internal_note' => $params['internal_note'],
          'user_id' => Auth::user()->profile_id,
        ]
      );

      return redirect('/customers/' . $model->id . '/ticket');
    } catch (\Exception $e) {
      dd($e);
    }
  }
}
