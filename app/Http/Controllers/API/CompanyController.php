<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;

use App\Models\Client;
use App\Models\Organization;

class CompanyController extends \App\Http\Controllers\Controller
{
  public function change(Request $request): JsonResponse
  {
    try {
      $validator = Validator::make($request->all(), [
        'id' => ['required', 'integer'],
        'text' => ['required', 'string'],
        'type' => ['required', 'string'],
      ]);

      $params = $validator->validate();

      $type = $params['type'];

      $model = Client::find($params['id']);
      $model->organization->$type = $params['text'];
      $model->organization->save();

      return response()->json(
        [
          'message' => 'Client retrieved successfully',
          'results' => $model,
        ],
        200
      );
    } catch (Exception $e) {
      return response()->json(
        [
          'message' => $e->getMessage(),
          'results' => [],
        ],
        500
      );
    }
  }
}
