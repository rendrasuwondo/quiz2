<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Auth;

class LoginController extends Controller
{
  /**
   * Handle the incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function __invoke(LoginRequest $request)
  {

    $data = [];

    $credentials = $request->only(['no_hp', 'password']);

    if (!$token = auth()->attempt($credentials)) {
      return response()->json(['error' => 'Unauthorized'], 401);
    }

    $data['token'] = $token;
    $data['user'] = Auth::user();

    return response()->json([
      'response_code' => '00',
      'response_message' => 'user berhasil login',
      'data'    => $data

    ], 200);
  }
}
