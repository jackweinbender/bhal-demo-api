<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Input;
use Hash;
use App\User;

class AuthenticationController extends Controller
{
    public function loginWithCredentials(Request $request)
    {
      if(Input::has('email') && Input::has('password')){

        $user = User::where('email', Input::get('email'))->first();

        if($user){

          if(Hash::check(Input::get('password'), $user->password)){

            return response('Logged In Response', 200);

          }
          
          return response('Incorrect Email or Password', 400);


        }

        return response('Incorrect Email or Password', 400);

      }

      return response('You must include both an email address and password', 400);
    }
}
