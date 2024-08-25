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
      $validator = Validator::make($request->all(), [
        'customer_name' => 'required',
        'phone' => 'required',
        'location' => 'required',
        'age' => 'required',
        'gender' => 'required',
        'income_level' => 'required',
        'job_title' => 'required',
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
        $model = LeadGeneration::find($id);
        $model->customer_name = $request->customer_name;
        $model->phone = $request->phone;
        $model->location = $request->location;
        $model->age = $request->age;
        $model->gender = $request->gender;
        $model->income_level = $request->income_level;
        $model->job_title = $request->job_title;
        $model->save();

        response()->json(
          [
            'message' => 'Lead generation updated successfully',
            'result' => $model
          ],
          200
        );
        return redirect()->back();
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
