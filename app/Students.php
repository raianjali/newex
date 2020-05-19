<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    protected $primaryKey = 'student_id';
    protected $fillable = ["name", "email", "password", "phone", "profile_pic",];
    protected $hidden = [
        'password', 'remember_token', 'created_at', 'updated_at'
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
