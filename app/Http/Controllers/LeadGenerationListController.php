<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeadGenerationList;
use Illuminate\Http\JsonResponse;

class LeadGenerationListController extends Controller
{
    public function store(Request $request)
    {
      $this->validate($request, [
        'name' => 'required',
      ]);
      
      try {
        LeadGenerationList::create([
          'name' => $request->name
        ]);
        $request->session()->flash('success', 'Save Data Berhasil');

        return response()->json(
            [
              'message' => 'Lead generation created successfully',
              'result' => 'success'
            ],
            200
        );
      } catch (\Throwable $th) {
        return response()->json('Service Error : ' . $th , 500);
      }
    }
}
