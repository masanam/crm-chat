<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Task;

class TicketController extends Controller
{
  public function get()
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
