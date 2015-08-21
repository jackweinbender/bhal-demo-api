<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Input;

class AuthenticationController extends Controller
{
    public function loginWithCredentials(Request $request)
    {
      if(!Input::has('data')){
        return response('No payload provided', 400);
      }

      return response('Logged In Response', 200);
    }
}
