<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\LeadGeneration;
use App\Models\LeadGenerationList;
use Validator;
use Illuminate\Http\JsonResponse;
use DB;

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
        'industry' => 'required',
        'email' => 'required',
        'linkedin' => 'required',
        'url' => 'required',
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
        $model->industry = $request->industry;
        $model->email = $request->email;
        $model->linkedin = $request->linkedin;
        $model->url = $request->url;
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

    public function searchCustomer(Request $request): JsonResponse
    {
        try {
            $customer_name = $request->query('customer_name');
            $location = $request->query('location');
            $income_level = $request->query('income_level');
            $job_title = $request->query('job_title');
            $min_age = $request->query('min_age');
            $max_age = $request->query('max_age');
            $gender = $request->query('gender');
            $industry = $request->query('industry');
            $customer;

            if ($min_age == '50' || $min_age != '50' && $max_age == '50') {
              $customer = DB::table('lead_generation_customer')
                ->when($customer_name, function($query, $name) {
                  return $query->where('customer_name', 'ilike', "%{$name}%");
                })
                ->when($min_age, function($query, $name) {
                  return $query->where('age', '>=', $name);
                })
                ->when($job_title, function($query, $name) {
                  return $query->where('job_title', '=', $name);
                })
                ->when($gender, function($query, $name) {
                  return $query->where('gender', '=', $name);
                })
                ->when($income_level, function($query, $name) {
                  return $query->whereIn('income_level', explode(',', $name));
                })
                ->when($location, function($query, $name) {
                  return $query->whereIn('location', explode(',', $name));
                })
                ->when($industry, function($query, $name) {
                  return $query->whereIn('industry', explode(',', $name));
                })
                ->get();
            } else {
              $customer = DB::table('lead_generation_customer')
                ->when($customer_name, function($query, $name) {
                  return $query->where('customer_name', 'ilike', "%{$name}%");
                })
                ->when($min_age, function($query, $name) {
                  return $query->where('age', '>=', $name);
                })
                ->when($max_age, function($query, $name) {
                  return $query->where('age', '<=', $name);
                })
                ->when($job_title, function($query, $name) {
                  return $query->where('job_title', '=', $name);
                })
                ->when($gender, function($query, $name) {
                  return $query->where('gender', '=', $name);
                })
                ->when($income_level, function($query, $name) {
                  return $query->whereIn('income_level', explode(',', $name));
                })
                ->when($location, function($query, $name) {
                  return $query->whereIn('location', explode(',', $name));
                })
                ->when($industry, function($query, $name) {
                  return $query->whereIn('industry', explode(',', $name));
                })
                ->leftJoin('lead_generation', 'lead_generation_customer.id', '=', 'lead_generation.lead_gen_customer_id')
                ->leftJoin('lead_generation_list', 'lead_generation.lead_gen_list_id', '=', 'lead_generation_list.id')
                ->select('lead_generation_customer.*', 'lead_generation_list.id as list_id', 'lead_generation_list.name as list_name')
                ->get();
            }

            $customerArray = [];

            foreach ($customer as $cust) {
                if (!isset($customerArray[$cust->id])) {
                    $customerArray[$cust->id] = (object) [
                        'id' => $cust->id,
                        'customer_name' => $cust->customer_name,
                        'email' => $cust->email,
                        'age' => $cust->age,
                        'email' => $cust->email,
                        'gender' => $cust->gender,
                        'income_level' => $cust->income_level,
                        'industry' => $cust->industry,
                        'job_title' => $cust->job_title,
                        'linkedin' => $cust->linkedin,
                        'location' => $cust->location,
                        'phone' => $cust->phone,
                        'url' => $cust->url,
                        'lists' => []
                    ];
                }
              
                if (!is_null($cust->list_id)) {
                  $customerArray[$cust->id]->lists[] = (object) [
                    'id' => $cust->list_id,
                    'name' => $cust->list_name,
                  ];
                }
            }

            // Convert the associative array to an indexed array
            $result = array_values($customerArray);


            return response()->json(
              [
                'message' => 'Lead generation search successfully',
                'result' => $result
              ],
              200
            );
        } catch (\Throwable $th) {
            return response()->json('Service Error : ' . $th , 500);
        }
    }

    public function assignCustomer(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
          'customers' => 'required',
          'list_id' => 'required',
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
          $listId = $request->list_id;
          $customers = $request->customers;

          $leadGenData = array_map(function($cust) use ($listId) {
            return [
              'lead_gen_customer_id' => $cust,
              'lead_gen_list_id' => $listId
            ];
          }, $customers);

          DB::table('lead_generation')->insert($leadGenData);

          return $this->sendResponse([], 'Assign customer successfully.');
        } catch (\Throwable $th) {
          return response()->json('Service Error : ' . $th , 500);
        }
    }
}
