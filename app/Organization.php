<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $primaryKey = 'organization_id';

    public function teachers()
    {
        return $this->hasMany('App\Teachers', 'teacher_id', 'organization_id');
    }

}
