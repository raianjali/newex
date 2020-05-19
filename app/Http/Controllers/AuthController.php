<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function login(Request $request){
        $role = $request->role;
        if($role==2 || $role==2 || $role==3){
            $credentials = $request->only(['email', 'password']);
        }
        if($role==4){
            $credentials = $request->only(['roll_no', 'password']);
        }
        if (!$token = JWTAuth::attempt($credentials)) {
           return 'Invalid login details';
        }

        return $token;
     }
}