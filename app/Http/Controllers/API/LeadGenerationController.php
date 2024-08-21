<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\LeadGeneration;
use Validator;
use Illuminate\Http\JsonResponse;


class LeadGenerationController extends BaseController
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function getCustomer($id): JsonResponse
    {
        $cust = LeadGeneration::find($id);

        if (is_null($cust)) {
            return $this->sendError('Customer not found.');
        }

        return $this->sendResponse($cust, 'Customer retrieved successfully.');
    }

    public function update(Request $request, $id)
    {
    //   $request->validate([
    //     'customer_name' => 'required',
    //     'phone' => 'required',
    //     'location' => 'required',
    //     'age' => 'required',
    //     'gender' => 'required',
    //     'income_level' => 'required',
    //     'job_title' => 'required',
    //   ]);
      

    //   $validator = Validator::make($request->all(), [
    //     'customer_name' => ['required', 'string'],
    //     'phone' => ['required', 'string'],
    //     'location' => ['required', 'string'],
    //     'age' => ['required', 'integer'],
    //     'gender' => ['required', 'string'],
    //     'income_level' => ['required', 'string'],
    //     'job_title' => ['required', 'string'],
    //   ]);
      
      try {
        LeadGeneration::where('id', $id)->update([
          'customer_name' => $request->customer_name,
          'phone' => $request->phone,
          'location' => $request->location,
          'age' => $request->age,
          'gender' => $request->gender,
          'income_level' => $request->income_level,
          'job_title' => $request->job_title
        ]);

        return response()->json([], 'Lead generation updated successfully.');
      } catch (\Throwable $th) {
        return response()->json('Service Error : ' . $th , 500);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id): JsonResponse
    {
        try {
            LeadGeneration::find($id)->delete();

            return $this->sendResponse([], 'Lead generation deleted successfully.');
        } catch (\Throwable $th) {
            return response()->json('Service Error : ' . $th , 500);
        }
    }
}
