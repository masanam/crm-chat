<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\ClientResource;
use Illuminate\Http\JsonResponse;

use App\Models\Client;

class ClientController extends BaseController
{
  public function get(Request $request): JsonResponse
  {
    try {
      $validator = Validator::make($request->all(), [
        'q' => ['string'],
      ]);

      if ($validator->fails()) {
        return response()->json(
          [
            'status' => 422,
            'message' => $validator->errors(),
            'results' => null,
          ],
          422
        );
      }

      $params = $validator->validate();

      $perPage = $params['per_page'] ?? 20;
      $search = $params['q'] ?? null;

      //   $clients = Client::with([
      //     'organization' => function ($query) use ($search) {
      //       $query->where('name', 'like', '%' . $search . '%');
      //     },
      //   ])
      //     ->when($search, function ($query) use ($search) {
      //       $query->where('name', 'like', '%' . $search . '%');
      //     })
      //     ->get();
      $clients = DB::select(
        'select
            c.id, o.name as text
        from
            clients c
        join organizations o on o.id = c.organization_id 
        where c.name like ? or o.name like ?
      ',
        ['%' . $search . '%', '%' . $search . '%']
      );

      return response()->json([
        'status' => 200,
        'message' => 'Data fetched successfully',
        'results' => $clients,
      ]);
    } catch (ValidationException $e) {
      return response()->json(
        [
          'status' => 422,
          'message' => $e->errors(),
          'results' => null,
        ],
        422
      );
    } catch (\Exception $e) {
      $statusCode = $e->getCode() > 100 && $e->getCode() < 600 ? $e->getCode() : 500;

      return response()->json(
        [
          'status' => $statusCode,
          'message' => $e->getMessage(),
          'results' => null,
        ],
        $statusCode
      );
    }
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(): JsonResponse
  {
    $clients = Client::all();

    return $this->sendResponse(ClientResource::collection($clients), 'Clients retrieved successfully.');
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

    $client = Client::create($input);

    return $this->sendResponse(new ClientResource($client), 'Client created successfully.');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */

  public function show($id): JsonResponse
  {
    $client = Client::find($id);

    if (is_null($client)) {
      return $this->sendError('Client not found.');
    }

    return $this->sendResponse(new ClientResource($client), 'Client retrieved successfully.');
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Client $client): JsonResponse
  {
    $input = $request->all();

    $validator = Validator::make($input, [
      'name' => 'required',
      'detail' => 'required',
    ]);

    if ($validator->fails()) {
      return $this->sendError('Validation Error.', $validator->errors());
    }

    $client->name = $input['name'];
    $client->detail = $input['detail'];
    $client->save();

    return $this->sendResponse(new ClientResource($client), 'Client updated successfully.');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */

  public function destroy(Client $client): JsonResponse
  {
    $client->delete();

    return $this->sendResponse([], 'Client deleted successfully.');
  }
}
