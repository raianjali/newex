<?php

namespace App\Http\Controllers;
use JWTAuth;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAuthRequest;
use App\Http\Requests\RegisterAuthRequest;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\User;
use Illuminate\Support\Facades\Request;
use Log;
use Hash;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public $loginAfterSignUp = true;
 
    public function registerStudent(RegisterAuthRequest $request){
        if ($request->role_id==4) {
            $user = new User();
            $user->role_id = $request->role_id;
            $user->organization_id = $request->organization_id;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->roll_no = $request->roll_no;
            $user->password = bcrypt($request->password);
            $user->phone = $request->phone;
            $user->profile_pic = $request->profile_pic;
            $user->save();
    
            return response()->json([
                'success' => true,
                'data' => $user
            ], Response::HTTP_OK);
        }
        else {
            return response()->json(['Results' =>(object) array(),'message'=>'Not a Student','requestLocation'=> Request::getRequestUri(),'status'=> 400,'success'=> false,'metadata'=>(object) array()],200);
        }
    }

    
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
                            if($user->status==1&&$user->role_id==$credentials['role_id']&&$user->role_id!=4)
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
                            if($user->status==1&&$user->role_id==$credentials['role_id']&&$user->role_id==4)
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

    /**
    * Get the authenticated User.
    *
    * @return \Illuminate\Http\JsonResponse
    */
   public function me() {
    try
    {
        //return response()->json(auth()->user());
        return response()->json(['Results' =>auth()->user(),'message'=>'Succesful','requestLocation'=> Request::getRequestUri(),'status'=> 200,'success'=> true,'metadata'=>(object) array()],200);
    }
    catch(\Throwable $e)
    {
        Log::error($e->getMessage());
        return response()->json(['Results' =>(object) array(),'message'=>'Internal server error','requestLocation'=> Request::getRequestUri(),'status'=> 500,'success'=> false,'metadata'=>(object) array()],500);
    }
   }
 
   /**
    * Log the user out (Invalidate the token).
    *
    * @return \Illuminate\Http\JsonResponse
    */
   public function logout() {
    try
    {
        auth()->logout();
 
        return response()->json(['Results' =>auth()->user(),'message'=>'Succesful','requestLocation'=> Request::getRequestUri(),'status'=> 200,'success'=> true,'metadata'=>(object) array()],200);
    }
    catch(\Throwable $e)
    {
        Log::error($e->getMessage());
        return response()->json(['Results' =>(object) array(),'message'=>'Internal server error','requestLocation'=> Request::getRequestUri(),'status'=> 500,'success'=> false,'metadata'=>(object) array()],500);
    }
   }
 
    public function updateStudent(Request $request, $user_id) 
    {
        try {
            $validator = Validator::make($request::all() + ['user_id' => $user_id], 
            [
                'user_id' => 'required|exists:users,user_id',
                'name' => 'required|string|min:1|max:255',
                'email' => 'required|email|string|unique:users',
                'password' => 'required|string|min:6|max:10',
                'phone' => 'required',
                'profile_pic' => 'required|string'
            ]);

            if ($validator->fails()) 
            {
                return response()->json(['Results' =>(object) array(),'message'=>$validator->messages(),'requestLocation'=> Request::getRequestUri(),'status'=> 400,'success'=> false,'metadata'=>(object) array()],400);
            }
            $user = User::find($user_id);
            if (!$user) {
                return response()->json(['Results' =>['user'=>$user],'message'=>'Updation Failed','requestLocation'=> Request::getRequestUri(),'status'=> 401,'success'=> false,'metadata'=>(object) array()],200);
            }
            $user->name = $request::get('name');
            $user->email = $request::get('email');
            $user->password = $request::get('password');
            $user->phone = $request::get('phone');
            $user->profile_pic = $request::get('profile_pic');
            if($user->save()) {
                return response()->json(['Results' =>['user'=>$user],'message'=>'Data Updated Successfully','requestLocation'=> Request::getRequestUri(),'status'=> 200,'success'=> true,'metadata'=>(object) array()],200);
            }
        }
        catch (\Throwable $e) {
            Log::error($e->getMessage());
            return $this->responseWithError('Internal server Error', [], 500, 500);
        }
    }    

    public function destroy_user($user_id)
    {
        try {
        $user=User::Where(['user_id'=>$user_id])->first();

        if(Empty($user))
           {
            return response()->json(['Results' =>[],'message'=>'Invalid user id','requestLocation'=> Request::getRequestUri(),'status'=> 401,'success'=> false,'metadata'=>(object) array()],200);
           }
           $user->status= 0;
           if ($user->save()) 
            {
                return response()->json(['Results' =>['user'=>$user],'message'=>'Deleted Successfully','requestLocation'=> Request::getRequestUri(),'status'=> 200,'success'=> true,'metadata'=>(object) array()],200);
            }
        }
        catch(\Throwable $e)
        {
           Log::error($e->getMessage());
           return $this->responseWithError('Internal server error', [], 500, 500);
        }
    }
    
}
