<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;

use Yajra\DataTables\Facades\Datatables;
use Illuminate\Http\Request;

class RoleController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $permissions = Permission::get();
    if ($request->ajax()) {
      $data = Role::latest()->get();
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

    return view('content.role.index')->with(['permissions' => $permissions]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    /** @var Permission $permissions */
    $permissions = Permission::get();
    dd($permissions);
    return view('content.role.create')->with(['roles' => $role, 'permissions' => $permissions]);
  }

  /**

   * Store a newly created resource in storage.

   *

   * @param  \Illuminate\Http\Request  $request

   * @return \Illuminate\Http\Response

   */

  public function store(Request $request)
  {
    Role::updateOrCreate(
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
  public function show(Role $role)
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
    $role = Role::find($id);
    return response()->json($role);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Role $role)
  {
    $this->validate($request, [
      'name' => 'required',
      'status' => 'required',
      'subscription_deadline' => 'required',
    ]);

    $role->update([
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
    Role::find($id)->delete();
    return response()->json(['success' => 'Data deleted successfully.']);
  }
}
