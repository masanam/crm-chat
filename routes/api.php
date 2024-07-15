<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\apps\Chat;
use App\Http\Controllers\apps\InternalNoteController;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\TicketController;
use App\Http\Controllers\API\CompanyController;
use App\Http\Controllers\API\LeadController;
use App\Http\Controllers\API\TaskController;
use App\Http\Controllers\API\ClientController;
use App\Http\Controllers\API\DealerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});

Route::controller(RegisterController::class)->group(function () {
  Route::post('register', 'register');
  Route::post('login', 'login');
});

Route::middleware('auth:sanctum')->group(function () {
  Route::resource('products', ProductController::class);
  // Route::post('/users/logout', [UserController::class, 'logoutUser']); // Done
  // Route::get('/users', [UserController::class, 'getUsers'])->middleware('permission:can-access-all-users'); // Done
  // Route::get('/users/{id}', [UserController::class, 'getUser'])->middleware('permission:can-access-all-users'); // Done
  // Route::delete('/users/{id}', [UserController::class, 'deleteUser'])->middleware('permission:can-access-all-users'); // Done
  // Route::put('/users/{id}', [UserController::class, 'updateUser'])->middleware('permission:can-access-all-users'); // Done

  // Route for TaskController
  // Route::post('/tasks', [TaskController::class, 'postTasks'])->middleware('permission:can-create-task');
  // Route::get('/tasks', [TaskController::class, 'getTasks'])->middleware('permission:can-view-task');
  // Route::get('/tasks/{id}', [TaskController::class, 'showTasks'])->middleware('permission:can-view-task');
  // Route::delete('/tasks/{id}', [TaskController::class, 'deleteTasks'])->middleware('permission:can-delete-task');
  // Route::put('/tasks/{id}', [TaskController::class, 'updateTasks'])->middleware('permission:can-update-task'); // for updating complete start
  // Route::put('/tasks/reassign/{id}', [TaskController::class, 'reassignTasks'])->middleware(
  //   'permission:can-reassign-task'
  // ); // for reassigning the task

  // // Routes for TeamController
  // Route::get('/teams', [TeamController::class, 'getTeams'])->middleware('permission:can-view-teams');
  // Route::get('/user/teams', [TeamController::class, 'getUserTeams'])->middleware('permission:can-view-teams');
  // Route::post('/team/add', [TeamController::class, 'postTeam'])->middleware('permission:can-create-teams');
  // Route::get('/teams/{id}', [TeamController::class, 'showTeams'])->middleware('permission:can-view-specific-team');
  // Route::put('/teams/{id}', [TeamController::class, 'updateTeams'])->middleware('permission:can-update-teams');
  // Route::delete('/teams/{id}', [TeamController::class, 'deleteTeams'])->middleware('permission:can-delete-team');

  // // Routes for DealerController
  // Route::get('/dealers', [DealerController::class, 'getDealers'])->middleware('permission:can-view-dealers');
  // Route::get('/user/dealers', [DealerController::class, 'getUserDealers'])->middleware('permission:can-view-dealers');
  // Route::post('/dealer/add', [DealerController::class, 'postDealer'])->middleware('permission:can-create-dealers');
  // Route::get('/dealers/{id}', [DealerController::class, 'showDealers'])->middleware(
  //   'permission:can-view-specific-dealer'
  // );
  // Route::put('/dealers/{id}', [DealerController::class, 'updateDealers'])->middleware('permission:can-update-dealers');
  // Route::delete('/dealers/{id}', [DealerController::class, 'deleteDealers'])->middleware(
  //   'permission:can-delete-dealer'
  // );

  // Route::get('/clients', [ClientController::class, 'getClients'])->middleware('permission:can-view-clients');
  // Route::get('/user/clients', [ClientController::class, 'getUserClients'])->middleware('permission:can-view-clients');
  // Route::post('/client/add', [ClientController::class, 'postClient'])->middleware('permission:can-create-clients');
  // Route::get('/clients/{id}', [ClientController::class, 'showClients'])->middleware(
  //   'permission:can-view-specific-client'
  // );
  // Route::put('/clients/{id}', [ClientController::class, 'updateClients'])->middleware('permission:can-update-clients');
  // Route::delete('/clients/{id}', [ClientController::class, 'deleteClients'])->middleware(
  //   'permission:can-delete-client'
  // );
});
Route::get('/tickets', [TicketController::class, 'get']);
Route::get('/get-members', [TicketController::class, 'getMembers']);
Route::get('/is_lead/{id}', [TicketController::class, 'isLead']);
Route::get('/clients', [ClientController::class, 'get']);

Route::get('/is_dealer/{id}', [DealerController::class, 'isDealer']);

Route::post('/companies/{id}/change', [CompanyController::class, 'change']);
Route::post('/leads/{id}/change', [LeadController::class, 'change']);
Route::post('/tasks/{id}/change', [TaskController::class, 'change']);

Route::post('/send-whatsapp', [Chat::class, 'sendWhatsAppMessage']);
Route::post('/receive-chat', [Chat::class, 'receiveWhatsAppMessage']);
Route::post('/add-contact', [Chat::class, 'addContact']);
Route::get('/get-chats/{phone}', function ($phone) {
  return \App\Models\Chat::where('from', $phone)
    ->orWhere('to', $phone)
    ->get();
});

Route::get('/internal-notes/{lead}', 'App\Http\Controllers\InternalNoteController@getInternalNotesByLead')->name(
  'getInternalNotesByLead'
);
Route::post('/internal-notes', 'App\Http\Controllers\InternalNoteController@store')->name('store');

Route::post('/signup', function (Request $request) {
  $organization = \App\Models\Organization::create([
    'name' => $request->company_name,
    'industry' => $request->industry,
    'number_of_team_members' => $request->number_of_team_members,
    'use_case' => $request->use_case,
  ]);
  $dealer = \App\Models\Dealer::create([
    'name' => $request->company_name,
    'business_phone' => $request->business_phone,
    'meta_business' => $request->meta_business,
    'wa_business' => $request->wa_business,
  ]);

  if ($organization) {
    $client = \App\Models\Client::create([
      'organization_id' => $organization->id,
      'name' => $request->company_name,
      'email' => $request->email,
      'phone' => $request->phone,
      // 'status' => $request->name,
      // 'quota' => $request->name,
      // 'expired_at' => $request->name,
      'meta_business' => $request->meta_business,
      'wa_business' => $request->wa_business,
    ]);

    $response = Http::withHeaders([
      'apikey' => env('SUPABASE_KEY'),
      'Content-Type' => 'application/json',
    ])->post(env('SUPABASE_URL') . '/auth/v1/signup', [
      'email' => $request->email,
      'password' => $request->password,
    ]);

    $r = json_decode($response, true);

    // dd($r['id']);

    if (empty($r['id'])) {
      return redirect('https://pasima.co/sign-up.html?error=true');
    } else {
      $profile = \App\Models\Profile::create([
        'id' => $r['id'],
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'role' => 'manager',
        'dealer_id' => $dealer->id,
        'client_id' => $client->id,
        'job_title' => $request->job_title,
      ]);

      if ($profile) {
        \App\Models\User::create([
          'profile_id' => $r['id'],
          'name' => $request->company_name,
          'email' => $request->email,
          'password' => \Illuminate\Support\Facades\Hash::make($request->password),
        ]);

        return redirect('/');
      } else {
        return redirect('https://pasima.co/sign-up.html?error=true');
      }
    }
  } else {
    return redirect('https://pasima.co/sign-up.html?error=true');
  }
});

Route::get('/generate', function () {
  return \Illuminate\Support\Facades\Hash::make('Pasima123');
});
