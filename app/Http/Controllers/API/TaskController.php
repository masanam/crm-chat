<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Http\Resources\TaskResource;
use Illuminate\Http\JsonResponse;

use App\Models\Task;

class TaskController extends BaseController
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(): JsonResponse
  {
    $tasks = Task::all();

    return $this->sendResponse(TaskResource::collection($tasks), 'Tasks retrieved successfully.');
  }

  public function change(Request $request): JsonResponse
  {
    try {
      $validator = Validator::make($request->all(), [
        'id' => ['required', 'integer'],
        'text' => ['required', 'string'],
        'type' => ['required', 'string'],
      ]);

      $params = $validator->validate();

      $type = $params['type'];

      $model = Task::find($params['id']);
      $model->$type = $params['text'];
      $model->save();

      return response()->json(
        [
          'message' => 'Task retrieved successfully',
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

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */

  public function store(Request $request): JsonResponse
  {
    $input = $request->all();

    $validator = Validator::make($input, [
      'name' => 'required',
      'detail' => 'required',
    ]);

    if ($validator->fails()) {
      return $this->sendError('Validation Error.', $validator->errors());
    }

    $task = Task::create($input);

    return $this->sendResponse(new TaskResource($task), 'Task created successfully.');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */

  public function show($id): JsonResponse
  {
    $task = Task::find($id);

    if (is_null($task)) {
      return $this->sendError('Task not found.');
    }

    return $this->sendResponse(new TaskResource($task), 'Task retrieved successfully.');
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  // public function update(Request $request, Task $task): JsonResponse
  // {
  //   $input = $request->all();

  //   $validator = Validator::make($input, [
  //     'name' => 'required',
  //     'detail' => 'required',
  //   ]);

  //   if ($validator->fails()) {
  //     return $this->sendError('Validation Error.', $validator->errors());
  //   }

  //   $task->name = $input['name'];
  //   $task->detail = $input['detail'];
  //   $task->save();

  //   return $this->sendResponse(new TaskResource($task), 'Task updated successfully.');
  // }


  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */

  public function destroy(Task $task): JsonResponse
  {
    $task->delete();

    return $this->sendResponse([], 'Task deleted successfully.');
  }
}
