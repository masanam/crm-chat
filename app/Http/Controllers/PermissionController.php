<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Yajra\DataTables\Facades\Datatables;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    if ($request->ajax()) {
      $data = Permission::latest()->get();
      return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
          $actionBtn = '<span class="text-nowrap"><button class="btn btn-sm btn-icon me-2" data-bs-target="#editPermissionModal" data-bs-toggle="modal" data-bs-dismiss="modal"><i class="ti ti-edit"></i></button><button class="btn btn-sm btn-icon delete-record"><i class="ti ti-trash"></i></button></span>';
          return $actionBtn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    return view('content.permission.index');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('content.permission.create');
  }

  /**

   * Store a newly created resource in storage.

   *

   * @param  \Illuminate\Http\Request  $request

   * @return \Illuminate\Http\Response

   */

  public function store(Request $request)
  {
    Permission::updateOrCreate(
      [
        'id' => $request->id
      ],
      [
        'name' => $request->name,
        'code' => $request->code,
        'description' => $request->description,
        'brand' => $request->brand,
        'type' => $request->type,
        'category' => $request->category,
        'price' => $request->price,
        'image' => $request->image,
        'video' => $request->video,
        'stock' => $request->stock
      ]
    );
    return redirect()->back();
  }

  /**
   * Display the specified resource.
   */
  public function show(Permission $permission)
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
    $permission = Permission::find($id);
    return response()->json($permission);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Permission $permission)
  {
    $this->validate($request, [
      'name' => 'required',
      'status' => 'required',
      'subscription_deadline' => 'required',
    ]);

    $permission->update([
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
    Permission::find($id)->delete();
    return response()->json(['success' => 'Data deleted successfully.']);
  }
}
