<?php

namespace App\Http\Controllers;

use App\Models\LeadGeneration;
use Yajra\DataTables\Datatables;
use Illuminate\Http\Request;

class LeadGenerationController extends Controller
{
    public function leadSearchView()
    {
      return view('content.lead.lead-search');
    }

    public function index(Request $request)
    {
      if ($request->ajax()) {
        $data = LeadGeneration::latest()->get();
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
      return view('content.lead.lead-index');
    }

    public function store(Request $request)
    {
      $this->validate($request, [
        'customer_name' => 'required',
        'phone' => 'required',
        'location' => 'required',
        'age' => 'required',
        'gender' => 'required',
        'income_level' => 'required',
        'job_title' => 'required',
      ]);
      
      try {
        LeadGeneration::create([
          'customer_name' => $request->customer_name,
          'phone' => $request->phone,
          'location' => $request->location,
          'age' => $request->age,
          'gender' => $request->gender,
          'income_level' => $request->income_level,
          'job_title' => $request->job_title
        ]);
        $request->session()->flash('success', 'Save Data Berhasil');

        return redirect()->back();
      } catch (\Throwable $th) {
        return response()->json('Service Error : ' . $th , 500);
      }
    }
}
