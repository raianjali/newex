<?php

namespace App\Http\Controllers;

/*use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\JsonUtilTrait;
use App\User;
use Throwable;
use Log;*/
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Support\Facades\Request;
use Log;
use Hash;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function login(Request $request){
                
                if (request::has(['email','password', 'role_id']))
                {
                    $credentials = request(['email', 'password', 'role_id']);
                    try
                    {
                        if ($token = auth()->attempt($credentials)) 
                        {
                            $user = User::where('email', '=', $credentials['email'])->first();
                            if($user->status==1&&$user->role_id==$credentials['role_id'])
                            {
                                return response()->json(['Results' =>['token'=>$token,'user'=>$user],'message'=>'Succesful','requestLocation'=> Request::getRequestUri(),'status'=> 200,'success'=> true,'metadata'=>(object) array()],200);
                            }
                            else
                            {
                                return response()->json(['Results' =>(object) array(),'message'=>'Unauthorized','requestLocation'=> Request::getRequestUri(),'status'=> 401,'success'=> false,'metadata'=>(object) array()],200);
                            } 
                        }
                        else
                        {
                            return response()->json(['Results' =>(object) array(),'message'=>'Unauthorized','requestLocation'=> Request::getRequestUri(),'status'=> 401,'success'=> false,'metadata'=>(object) array()],200);
                        }
                    }
                    catch(JWTException $je)
                    {
                        return response()->json(['Results' =>(object) array(),'message'=>'could_not_create_token','requestLocation'=> Request::getRequestUri(),'status'=> 500,'success'=> false,'metadata'=>(object) array()],500);
                    }
                }
                else if (request::has(['roll_no','password', 'role_id']))
                {
                    $credentials = request(['roll_no', 'password', 'role_id']);

                    try
                    {
                        if ($token = auth()->attempt($credentials)) 
                        {
                            $user = User::where('roll_no', '=', $credentials['roll_no'])->first();
                            if($user->status==1&&$user->role_id==$credentials['role_id'])
                            {
                                return response()->json(['Results' =>['token'=>$token,'user'=>$user],'message'=>'Succesful','requestLocation'=> Request::getRequestUri(),'status'=> 200,'success'=> true,'metadata'=>(object) array()],200);
                            }
                            else
                            {
                                return response()->json(['Results' =>(object) array(),'message'=>'Unauthorized','requestLocation'=> Request::getRequestUri(),'status'=> 401,'success'=> false,'metadata'=>(object) array()],200);
                            } 
                        }
                        else
                        {
                            return response()->json(['Results' =>(object) array(),'message'=>'Unauthorized','requestLocation'=> Request::getRequestUri(),'status'=> 401,'success'=> false,'metadata'=>(object) array()],200);
                        }
                    }
                    catch(JWTException $je)
                    {
                        return response()->json(['Results' =>(object) array(),'message'=>'could_not_create_token','requestLocation'=> Request::getRequestUri(),'status'=> 500,'success'=> false,'metadata'=>(object) array()],500);
                    }
                }
                else
                {
                    return response()->json(['Results' =>(object) array(),'message'=>'Bad request','requestLocation'=> Request::getRequestUri(),'status'=> 400,'success'=> false,'metadata'=>(object) array()],200);
                }
   
    }
}