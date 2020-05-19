<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QueOption extends Model
{
    protected $primaryKey= 'que_option_id';

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}
