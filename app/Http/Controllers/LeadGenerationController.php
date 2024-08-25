<?php

namespace App\Http\Controllers;

use App\Models\LeadGeneration;
use Yajra\DataTables\Datatables;
use Illuminate\Http\Request;
use Validator;
use File;
use Illuminate\Http\JsonResponse;

class LeadGenerationController extends Controller
{
    public function leadSearchView()
    {
      $json = File::json(base_path('public/dummy-job.json'));
      $placeholder = (object) [
        'label' => '- Select -',
        'value' => '',
      ];
      $list_job = array($placeholder);
      foreach ($json as $job) {
        $data = (object) [
          'label' => $job,
          'value' => $job,
        ];
        array_push($list_job, $data);
      }

      return view('content.lead.lead-search', compact('list_job'));
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
      $list_job = File::json(base_path('public/dummy-job.json'));

      return view('content.lead.lead-index', compact('list_job'));
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

    public function destroy($id)
    {
      LeadGeneration::find(1)->delete();
      return response()->json(['success' => 'Data deleted successfully.']);
    }
}
