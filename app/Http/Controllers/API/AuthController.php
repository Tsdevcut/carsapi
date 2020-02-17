<?php

namespace App\Http\Controllers\API;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request){

      $validatedData = $request->validate([
          'name'      => 'required|max:55',
          'email'     => 'email|required',
          'password'  => 'required|confirmed'
      ]);

      //encrypt the password
      //$validatedData['password'] = bcrypt($validatedData['password']);
      $validatedData['password'] = bcrypt($request->password);

      $user = User::create($validatedData);

      $accessToken = $user->createToken('authToken')->accessToken;

      return response(['user' => $user, 'access_token'=> $accessToken]);

    }

    public function login(Request $request){

      $loginData = $request->validate([
          'email'     => 'email|required',
          'password'  => 'required'
      ]);

      
      if(!auth()->attempt($loginData)){
        return response(['message' => 'Invalid credentials']);
      }
      $accessToken = auth()->user()->createToken('authToken')->accessToken;
      return response(['user' => auth()->user(), 'access_token'=> $accessToken]);
    }
}
