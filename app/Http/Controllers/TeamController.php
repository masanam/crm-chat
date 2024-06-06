<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Yajra\DataTables\Facades\Datatables;
use Illuminate\Http\Request;

class TeamController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    if ($request->ajax()) {
      $data = Team::latest()->get();
      return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
          $actionBtn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="editRecord btn btn-primary btn-sm">Edit</a> 
              <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="deleteRecord btn btn-danger btn-sm">Delete</a>';
          return $actionBtn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }
    return view('content.team.index');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('content.team.create');
  }

  /**

   * Store a newly created resource in storage.

   *

   * @param  \Illuminate\Http\Request  $request

   * @return \Illuminate\Http\Response

   */

  public function store(Request $request)
  {
    Team::updateOrCreate(
      [
        'id' => $request->id
      ],
      [
        'name' => $request->name,
        'detail' => $request->detail
      ]
    );
    return response()->json(['success' => 'Data saved successfully.']);
  }

  /**
   * Display the specified resource.
   */
  public function show(Team $team)
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
    $team = Team::find($id);
    return response()->json($team);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Team $team)
  {
    $this->validate($request, [
      'name' => 'required',
      'status' => 'required',
      'subscription_deadline' => 'required',
    ]);

    $team->update([
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
    Team::find($id)->delete();
    return response()->json(['success' => 'Data deleted successfully.']);
  }
}
