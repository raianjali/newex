<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QueLevel extends Model
{
    protected $primaryKey= 'que_level_id';
    protected $hidden = ['created_at', 'updated_at' ];
}
