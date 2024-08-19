<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\Datatables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Models\Task;
use App\Models\TaskChat;
use App\Models\TaskStatus;
use App\Models\Profile;
use App\Models\Contact;
use App\Models\InternalChat;
use App\Models\Lead;
use App\Models\Option;

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

    $lead = \App\Models\Lead::where('id', '156')->first();
    $labels = explode(',', $lead->label);
    $names = explode(',', $lead->name);

    return view('content.customer.index', compact('dataOpen', 'dataPending', 'dataClosed', 'lead', 'labels', 'names'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('content.customer.create');
  }

  public function getLeads()
  {
    $data = Lead::latest()
      ->whereNotNull('phone_number')
      ->get();

    return DataTables::of($data)
      ->addIndexColumn()
      ->addColumn('action', function ($row) {
        $actionBtn =
          '<a href="' .
          $row->phone_number .
          '" data-toggle="tooltip"  data-id="' .
          $row->id .
          '" data-original-title="Edit" class="editRecord btn btn-primary btn-sm">Edit</a>';
        return $actionBtn;
      })
      ->rawColumns(['action'])
      ->make(true);
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

  public function updateStatus(Request $request)
  {
    Option::updateOrCreate(
      [
        'id' => $request->id,
      ],
      [
        'status' => $request->status,
        'quality' => $request->quality,
        'stage' => $request->stage,
        'type' => $request->type,
      ]
    );
    return redirect()->back();
  }

  /**
   * Display the specified resource.
   */
  public function show($id)
  {
    $lead = \App\Models\Lead::with('contacts')
      ->where('phone_number', $id)
      ->first();

    if ($lead == null) {
      $lead = \App\Models\Lead::find(156);
    }

    $tickets = Task::where('lead_id', $lead->id)
      ->orderBy('created_at', 'desc')
      ->get();

    // $cst = \App\Models\Lead::where('id','156')->first();
    $labels = explode(',', $lead->label);
    $names = explode(',', $lead->name);

    return view('content.customer.show', compact('lead', 'labels', 'names', 'tickets'));
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

  /**
   * Display detail email in tab communication sub tab email
   */
  public function detailEmail()
  {
    return view('content.customer.detail-email');
  }

  /**
   * Display detail ticket in tab tickets
   */
  public function detailTicket(Request $request, $id)
  {
    $model = Task::with('client', 'status', 'team', 'member', 'lead', 'user')->find($id);
    $contacts = Contact::where('client_id', $model->client_id)->get();
    $group_chats = TaskChat::join('profiles', 'profiles.id', '=', 'task_chats.created_by')
      ->where('task_chats.task_id', $model->id)
      ->get();

    $members = [];
    foreach ($model->team->members as $key => $value) {
      $members[] = $value->profile->id;
    }

    $profiles = Profile::whereNotIn('id', $members)->get();

    if (empty($model->is_lead) || $model->is_lead == null || !$model->lead->id) {
      redirect('/tickets');
    }

    $statuses = TaskStatus::all();
    $chats = TaskChat::with('profile')
      ->select('created_by')
      ->where('task_id', $model->id)
      ->groupBy('created_by')
      ->get();

    return view(
      'content.customer.detail-ticket',
      compact('model', 'statuses', 'chats', 'group_chats', 'contacts', 'profiles')
    );
  }

  public function addContact(Request $request)
  {
    // dd($request);
    // "client_name" => "Elvis"
    // "first_name" => "Elvis"
    // "last_name" => "Kudo"
    // "whatsapp" => null
    // "phone_number" => "628567638156"
    // "deal_revenue" => null
    // "flatpickr-date" => null
    // "next_step" => null
    // "description" => null
    // 'location' => $request->location,
    // 'interest' => $request->interest,
    // 'progress' => $request->progress,
    // 'payment_method' => $request->payment_method,
    // 'budget' => $request->budget,
    // 'need_car' => $request->need_car,
    // 'notes' => $request->notes,
    // 'showroom_handler' => $request->showroom_handler,

    if (!empty($request->client_name)) {
      Lead::create([
        'client_name' => $request->client_name,
        'phone_number' => $request->phone_number,
      ]);
      $request->session()->flash('success', 'Ubah Data Berhasil');
    }
    return redirect()->back();

    // try {
    //   $validator = Validator::make($request->all(), [
    //     'first_name' => ['required', 'string'],
    //     'last_name' => ['string'],
    //     'job_title' => ['string'],
    //     'whatsapp_contact' => ['string'],
    //     'email_contact' => ['string'],
    //     'client_id' => ['required', 'integer'],
    //     'task_id' => ['required', 'integer'],
    //   ]);

    //   if ($validator->fails()) {
    //     return redirect('customers/' . $request->task_id . '/ticket')
    //       ->withErrors($validator)
    //       ->withInput();
    //   }

    //   $params = $validator->validate();

    //   Contact::updateOrCreate(
    //     [
    //       'client_id' => $params['client_id'],
    //       'whatsapp' => $params['whatsapp_contact'],
    //       'email' => $params['email_contact'],
    //     ],
    //     [
    //       'first_name' => $params['first_name'],
    //       'last_name' => $params['last_name'],
    //       'job_title' => $params['job_title'],
    //       'whatsapp' => $params['whatsapp_contact'],
    //       'email' => $params['email_contact'],
    //       'client_id' => $params['client_id'],
    //       'created_by' => Auth::user()->profile_id,
    //     ]
    //   );

    //   return redirect('customers/' . $params['task_id'] . '/ticket');
    // } catch (Exception $e) {
    //   return redirect('customers/' . $params['task_id'] . '/ticket')->with(
    //     'error',
    //     'Something went wrong. Please try again later.'
    //   );
    // }
  }

  public function addMorePost(Request $request)
  {
    $name_fields = [];
    if (isset($request->name) && is_array($request->name)) {
      $name_fields = implode(',', $request->name);
    }
    $label_fields = [];
    // foreach($request->label as $key => $value) {
    if (isset($request->label) && is_array($request->label)) {
      $label_fields = implode(',', $request->label);
    }

    Lead::where('id', '156')->update(['name' => $name_fields, 'label' => $label_fields]);
    return response()->json(['success' => 'done']);
    // return response()->json(['error'=>$validator->errors()->all()]);
  }
}
