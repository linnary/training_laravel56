<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    
    public function authenticate(Request $request)
    {
        
        $credentials = $request->only('email', 'password');
     
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            // Get the currently authenticated user...
   
            $user = Auth::user();
                    
            $user->generateToken();
            
            $output = array("token" => $user->api_token);
            //return json response
            return response()->json([
                'data' => $output ,
            ]);
           
        }else{
            return response()->json([
                'error' => 'Invalid Authenticated',
            ],401);
        }
    }
    

}


