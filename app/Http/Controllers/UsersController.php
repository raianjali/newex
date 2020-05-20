<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class UsersController extends Controller
{
    public function __construct() {
        $this->middleware('auth.role:1', ['only' => ['superadminlogin']]);
        $this->middleware('auth.role:2', ['only' => ['adminlogin']]);
        $this->middleware('auth.role:3', ['only' => ['teacherlogin']]);
        $this->middleware('auth.role:4', ['only' => ['studentlogin']]);
    }

    public function superadminlogin()
    {
        $user = DB::select('select * from users where role_id = 1');
        return response()->json($user);
    }
    public function adminlogin()
    {
        $user = DB::select('select * from users where role_id = 2');
        return response()->json($user);
    }
    public function teacherlogin()
    {
        $user = DB::select('select * from users where role_id = 3');
        return response()->json($user);
    }
    public function studentlogin()
    {
        $user = DB::select('select * from users where role_id = 4');
        return response()->json($user);
    }
}
