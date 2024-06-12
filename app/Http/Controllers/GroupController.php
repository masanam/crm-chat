<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\GroupMember;
use App\Models\GroupChat;
use App\Models\InternalChat;
use App\Models\Profile;

use DB;
use Yajra\DataTables\Facades\Datatables;
use Illuminate\Http\Request;

class GroupController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $groups = Group::latest()->get();
    $groupMember = GroupMember::latest()->get();
    $groupChat = GroupChat::latest()->get();
    $chatList = InternalChat::with('from', 'to')->get();

    $chatList = DB::table('get_list_chat as ic')
      ->select('*')
      ->limit(10)
      ->get();


    $internalChat = DB::table('internal_chats as ic')
      ->select('p.first_name', 'p.last_name', 'ic.from')
      ->leftJoin('profiles as p', 'ic.from', '=', 'p.id')
      ->groupBy('p.first_name', 'p.last_name', 'ic.from')
      ->get();

    $groupList = GroupMember::from('group_members as gm')
      ->select('g.name', 'gm.group_id', DB::raw('count(gm.id) as total'), 'gc.message', 'gc.created_at')
      ->leftJoin('groups as g', 'g.id', '=', 'gm.group_id')
      ->leftJoin('group_chats as gc', 'gc.group_id', '=', 'g.id')
      ->distinct('g.name')
      ->groupBy('g.name', 'gm.group_id', 'gc.message', 'gc.created_at')
      ->orderby('g.name', 'asc')
      ->limit(10)
      ->get();

    // dd($chatList);
    if ($request->ajax()) {
      $data = Group::latest()->get();
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
    return view('content.group.index')->with(['groups' => $groups, 'groupList' => $groupList, 'groupChat' => $groupChat, 'groupMember' => $groupMember, 'internalChat' => $internalChat, 'chatList' => $chatList]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('content.group.create');
  }

  /**

   * Store a newly created resource in storage.

   *

   * @param  \Illuminate\Http\Request  $request

   * @return \Illuminate\Http\Response

   */

  public function store(Request $request)
  {
    Group::updateOrCreate(
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
  public function show(Group $group)
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
    $group = Group::find($id);
    return response()->json($group);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Group $group)
  {
    $this->validate($request, [
      'name' => 'required',
      'status' => 'required',
      'subscription_deadline' => 'required',
    ]);

    $group->update([
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
    Group::find($id)->delete();
    return response()->json(['success' => 'Data deleted successfully.']);
  }
}
