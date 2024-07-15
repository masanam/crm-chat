<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\DealerResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Validator;

use App\Models\Dealer;
use App\Models\Profile;

class DealerController extends BaseController
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(): JsonResponse
  {
    $dealers = Dealer::all();

    return $this->sendResponse(DealerResource::collection($dealers), 'Dealers retrieved successfully.');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */

  public function store(Request $request): JsonResponse
  {
    $input = $request->all();

    $validator = Validator::make($input, [
      'name' => 'required',
      'detail' => 'required',
    ]);

    if ($validator->fails()) {
      return $this->sendError('Validation Error.', $validator->errors());
    }

    $dealer = Dealer::create($input);

    return $this->sendResponse(new DealerResource($dealer), 'Dealer created successfully.');
  }

  public function isDealer(Request $request, $id): JsonResponse
  {
    $model = Profile::with('dealer', 'assignedLead', 'client')
      ->where('id', $id)
      ->first();

    return response()->json($model);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */

  public function show($id): JsonResponse
  {
    $dealer = Dealer::find($id);

    if (is_null($dealer)) {
      return $this->sendError('Dealer not found.');
    }

    return $this->sendResponse(new DealerResource($dealer), 'Dealer retrieved successfully.');
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Dealer $dealer): JsonResponse
  {
    $input = $request->all();

    $validator = Validator::make($input, [
      'name' => 'required',
      'detail' => 'required',
    ]);

    if ($validator->fails()) {
      return $this->sendError('Validation Error.', $validator->errors());
    }

    $dealer->name = $input['name'];
    $dealer->detail = $input['detail'];
    $dealer->save();

    return $this->sendResponse(new DealerResource($dealer), 'Dealer updated successfully.');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */

  public function destroy(Dealer $dealer): JsonResponse
  {
    $dealer->delete();

    return $this->sendResponse([], 'Dealer deleted successfully.');
  }
}
