<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\JsonUtilTrait;
use App\User;
use App\Roles;
use Throwable;
use Log;

class AuthController extends Controller
{
    use JsonUtilTrait;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function login(Request $request){
        try {
                $validator = Validator::make($request->all(), [
                    "role" => "required|integer|exists:roles,role_id",
                    "email" => "string",
                    "password" => "required",
                ]);

                if ($validator->fails()) {
                    return $this->responseWithError("Validation Error", $validator->messages(), 400);
                }
                
                $role = $request->role;
                if($role==1 || $role==2 || $role==3){
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
        catch (Throwable $e) {
            Log::error($e->getMessage());
            return $this->responseWithError('Internal server error', [], 500, 500);
        } 
        
     }
}