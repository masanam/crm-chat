<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Yajra\DataTables\Facades\Datatables;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    //   if ($request->ajax()) {
    //     return DataTables::of((new TaskDataTable())->get($request->only([
    //         'name',
    //         'filter_project',
    //         'filter_status',
    //         'filter_user',
    //         'due_date_filter',
    //     ])))->editColumn('title', function (Task $task) {
    //         return $task->prefix_task_number.' '.$task->title;
    //     })->filterColumn('title', function (Builder $query, $search) {
    //         $query->where(function (Builder $query) use ($search) {
    //             $query->where('title', 'like', "%$search%")
    //                 ->orWhereRaw(
    //                     "concat(ifnull(p.prefix,''),'-',ifnull(tasks.task_number,'')) LIKE ?",
    //                     ["%$search%"]
    //                 );
    //         });
    //     })
    //         ->make(true);
    // }

    if ($request->ajax()) {
      $data = Task::latest()->get();
      return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
          $actionBtn =
            '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' .
            $row->id .
            '" data-original-title="Edit" class="editRecord btn btn-primary btn-sm">Edit</a> 
              <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' .
            $row->id .
            '" data-original-title="Delete" class="deleteRecord btn btn-danger btn-sm">Delete</a>';
          return $actionBtn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    $dataOpen = Task::where('status_id', 0)->get();
    $dataPending = Task::where('status_id', 1)->get();
    $dataClosed = Task::where('status_id', 2)->get();

    return view('content.customer.index', compact('dataOpen', 'dataPending', 'dataClosed'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('content.customer.create');
  }

  /**

   * Store a newly created resource in storage.

   *

   * @param  \Illuminate\Http\Request  $request

   * @return \Illuminate\Http\Response

   */

  public function store(Request $request)
  {
    Task::updateOrCreate(
      [
        'id' => $request->id,
      ],
      [
        'project_id' => $request->project_id,
        'user_id' => $request->user_id,
        'status_id' => $request->status_id,
        'title' => $request->title,
        'description' => $request->description,
        'deadline' => now(),
        'priority' => $request->priority,
        'code' => $request->priority,
      ]
    );
    return redirect()->back();
  }

  /**
   * Display the specified resource.
   */
  public function show(Task $task)
  {
    //
  }

  /**
   * Show the form for editingthe specified resource.
   *
   * @return \Illuminate\Http\Response
   */

  public function edit($id)
  {
    $task = Task::find($id);
    return response()->json($task);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Task $task)
  {
    $this->validate($request, [
      'name' => 'required',
      'status' => 'required',
      'subscription_deadline' => 'required',
    ]);

    $task->update([
      'name' => $request->name,
      'status' => $request->status,
      'subscription_deadline' => $request->subscription_deadline,
    ]);

    return redirect()->back();
  }

  /**
   * Remove the specified resource from storage.
   *
   * @return \Illuminate\Http\Response
   */

  public function destroy($id)
  {
    Task::find($id)->delete();
    return response()->json(['success' => 'Data deleted successfully.']);
  }
}
