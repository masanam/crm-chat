<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

use App\Models\Task;
use App\Models\Lead;

use App\Models\TeamMember;

class TicketController extends Controller
{
  public function get(): JsonResponse
  {
    $tasks = Task::with(['status', 'client.organization'])
      ->orderBy('status_id')
      ->get()
      ->groupBy('status_id')
      ->map(function ($taskGroup, $statusId) {
        $status = $taskGroup->first()->status;
        return [
          'id' => 'board-' . strtolower($status->name),
          'title' => $status->name,
          'badge-title' => $this->getBadgeTitle($status->name),
          'item' => $taskGroup
            ->map(function ($task) {
              return [
                'id' => 'task-' . $task->id,
                'text' => $task->title,
                'company' => $task->client->organization->name,
                'priority' => $task->priority, // Placeholder priority
                'due-date' => $task->deadline, // Placeholder date
              ];
            })
            ->toArray(),
        ];
      })
      ->values()
      ->toArray();

    return response()->json([
      'status' => 200,
      'message' => 'Board list',
      'data' => $tasks,
    ]);
  }

  public function getLead(): JsonResponse
  {
    $tasks = Lead::orderBy('stage')
      ->get()
      ->groupBy('stage')
      ->map(function ($taskGroup, $stage) {
        return [
          'id' => 'board-' . strtolower($stage),
          'title' => $stage,
          'badge-title' => $this->getBadgeTitle($stage),
          'item' => $taskGroup
            ->map(function ($task) {
              return [
                'id' => $task->phone_number,
                'text' => $task->client_name,
                'company' => $task->id,
                'priority' => $task->stage, // Placeholder priority
                'due-date' => $task->closed_date, // Placeholder date
              ];
            })
            ->toArray(),
        ];
      })
      ->values()
      ->toArray();

    return response()->json([
      'status' => 200,
      'message' => 'Board list',
      'data' => $tasks,
    ]);
  }


  public function getMembers(Request $request): JsonResponse
  {
    try {
      $validator = Validator::make($request->all(), [
        'team_id' => ['required', 'integer'],
      ]);

      $params = $validator->validate();

      $model = DB::select(
        "
        select
          team_members.id as id,
          concat(profiles.first_name, ' ', profiles.last_name) as name
        from
          team_members
          inner join profiles on team_members.user_id::varchar = profiles.id::varchar
        where
          team_members.id = " . $params['team_id']
      );

      return response()->json(
        [
          'message' => 'Member retrieved successfully',
          'results' => $model,
        ],
        200
      );
    } catch (Exception $e) {
      return response()->json(
        [
          'message' => $e->getMessage(),
          'results' => [],
        ],
        500
      );
    }
  }

  public function isLead(Request $request, $id): JsonResponse
  {
    try {
      $model = Task::where('id', $id)->first();

      if (empty($model->lead_id)) {
        throw new Exception('Ticket does not exist');
      }

      return response()->json(
        [
          'message' => 'Lead retrieved successfully',
          'results' => $model->lead_id,
        ],
        200
      );
    } catch (Exception $e) {
      return response()->json(
        [
          'message' => $e->getMessage(),
          'results' => [],
        ],
        500
      );
    }
  }

  private function getBadgeTitle($statusName)
  {
    $badges = [
      'Open' => 'secondary',
      'In Progress' => 'success',
      'Closed' => 'info',
      'Pending' => 'danger',
      'KIV' => 'warning',
    ];

    return $badges[$statusName] ?? 'default';
  }
}
