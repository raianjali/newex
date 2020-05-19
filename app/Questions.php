<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    protected $primaryKey= 'que_id';
    protected $hidden = ['created_at', 'updated_at' ];
    public function que_option()
    {
        return $this->hasMany(QueOption::class, 'que_id', 'que_id')->where('que_options.status',1);
    }
}
