<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teachers extends Model
{
    protected $primaryKey = 'teacher_id';
    protected $fillable = ["name", "email", "password", "phone", "profile_pic",];
    protected $hidden = [
        'password', 'remember_token', 'created_at', 'updated_at'
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function organizations()
    {
        return $this->hasOne('App\Organization', 'teacher_id', 'organization_id');
    }
}
