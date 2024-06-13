<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
  public function loginPage()
  {
    $pageConfigs = ['myLayout' => 'blank'];
    return view(
      'content.authentications.auth-login-basic',
      ['pageConfigs' => $pageConfigs]
    );
  }
  public function login(Request $request)
  {
    $credentials = $request->validate([
      'email' => ['required', 'email'],
      'password' => ['required'],
    ]);

    // $response = \Illuminate\Support\Facades\Http::withHeaders([
    //   'apikey' => env('SUPABASE_KEY'),
    //   'Content-Type' => 'application/json',
    // ])->post(env('SUPABASE_URL') . '/auth/v1/token?grant_type=password', [
    //   'email' => $request->email,
    //   'password' => $request->password,
    // ]);

    // $r = json_decode($response, true);

    // if(empty($r['user']['id'])) {

    if (Auth::attempt($credentials)) {
      $request->session()->regenerate();

      return redirect('dashboard');
    }
    // } else {
    //     if (Auth::attempt($credentials)) {
    //       $request->session()->regenerate();

    //       return redirect('app/chat');
    //     }
    // }

    return back()->withErrors([
      'email' => 'The provided credentials do not match our records.',
    ]);
  }

  public function logout()
  {
    Auth::logout();

    return redirect('/'); // Redirect to the home page or any other page you prefer
  }
}
