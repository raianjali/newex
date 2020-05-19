<?php

namespace App\Http\Controllers;

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
        return 'This is a super admin route.';
    }
    public function adminlogin()
    {
        return 'This route is for admin users.';
    }
    public function teacherlogin()
    {
        return 'This is a teacher route.';
    }
    public function studentlogin()
    {
        return 'This route is for student users.';
    }
}
