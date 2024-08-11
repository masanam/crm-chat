<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\Datatables;

class LeadController extends Controller
{

  public function index(Request $request)
  {
    if ($request->ajax()) {
      $data = Lead::latest()->get();
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
    return view('content.lead.index');
  }

  public function getAllLeads()
  {
    // Mengambil semua data Lead menggunakan Eloquent
    $leads = Lead::all();

    // Mengubah data ke dalam format yang diinginkan
    $formattedData = $leads->map(function ($lead) {
      return [
        'id' => $lead->id,
        'avatar' => "10.png",
        'full_name' => $lead->client_name,
        'location' => $lead->location,
        'whatsapp_number' => "+" . $lead->phone_number,
        'car_unit' => $lead->interest,
        'progress' => $lead->progress,
        'payment_method' => $lead->payment_method,
        'budget' => $lead->budget,
        'need_car' => $lead->need_car,
        'notes' => $lead->notes,
        'lead_id' => $lead->lead_id,
        'lead_name' => "JAYA MOTOR",
        'showroom_handler' => $lead->showroom_handler,
        'created_at' => $lead->created_at->format('F j, Y g:ia'), // Format tanggal
      ];
    });

    $data = ['data' => $formattedData];

    // Mengembalikan custom response sebagai JSON
    return response()->json($data);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('content.lead.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $this->validate($request, [
      'lead_id' => 'required',
      'client_name' => 'required',
      'location' => 'required',
      'phone_number' => 'required',
      'interest' => 'required',
      'progress' => 'required',
      'payment_method' => 'required',
      'budget' => 'required',
      'need_car' => 'required',
      'notes' => 'required',
      'showroom_handler' => 'required',
    ]);
    Lead::create([
      'lead_id' => $request->lead_id,
      'client_name' => $request->client_name,
      'location' => $request->location,
      'phone_number' => $request->phone_number,
      'interest' => $request->interest,
      'progress' => $request->progress,
      'payment_method' => $request->payment_method,
      'budget' => $request->budget,
      'need_car' => $request->need_car,
      'notes' => $request->notes,
      'showroom_handler' => $request->showroom_handler,
    ]);
    $request->session()->flash('success', 'Ubah Data Berhasil');
    return redirect()->back();
  }

  /**
   * Display the specified resource.
   */
  public function show(Lead $lead)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit($id)
  {
    $lead = Lead::find($id);
    return response()->json($lead);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Lead $lead)
  {
    $this->validate($request, [
      'lead_id' => 'required',
      'client_name' => 'required',
      'location' => 'required',
      'phone_number' => 'required',
      'interest' => 'required',
      'progress' => 'required',
      'payment_method' => 'required',
      'budget' => 'required',
      'need_car' => 'required',
      'notes' => 'required',
      'showroom_handler' => 'required',
    ]);
    $lead->update([
      'lead_id' => $request->lead_id,
      'client_name' => $request->client_name,
      'location' => $request->location,
      'phone_number' => $request->phone_number,
      'interest' => $request->interest,
      'progress' => $request->progress,
      'payment_method' => $request->payment_method,
      'budget' => $request->budget,
      'need_car' => $request->need_car,
      'notes' => $request->notes,
      'showroom_handler' => $request->showroom_handler,
    ]);
    $request->session()->flash('success', 'Ubah Data Berhasil');
    return redirect()->back();
  }

    /**
   * Update the specified resource in storage.
   */
  public function updateLead(Request $request, Lead $lead)
  {
    $lead->where('phone_number',$request->contact)->update([
      'client_name' => $request->first_name.' '.$request->last_name,
      'title' => $request->job_title,
    ]);
    $request->session()->flash('success', 'Ubah Data Berhasil');
    return redirect()->back();
  }


  /**
   * Remove the specified resource from storage.
   */
  public function destroy($id)
  {
    Lead::find($id)->delete();
    return response()->json(['success' => 'Data deleted successfully.']);
  }

  public function leadSearchView()
  {
    return view('content.lead.lead-search');
  }
}
