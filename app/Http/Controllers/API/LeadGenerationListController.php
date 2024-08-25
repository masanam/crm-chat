<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\LeadGenerationList;
use Illuminate\Http\JsonResponse;
use Validator;

class LeadGenerationListController extends BaseController
{
    public function index(Request $request): JsonResponse
    {
        try {
            $model = LeadGenerationList::latest()->get();

            return response()->json(
              [
                'message' => 'Lead generation list successfully',
                'result' => $model
              ],
              200
            );
        } catch (\Throwable $th) {
            return response()->json('Service Error : ' . $th , 500);
        }
    }

    public function store(Request $request)
    {
       $validator = Validator::make($request->all(), [
        'name' => 'required',
       ]);
 
       if ($validator->fails()) {
         return response()->json(
           [
             'message' => 'Bad request',
             'result' => $validator->errors()
           ],
           400
         );
       }
      
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
