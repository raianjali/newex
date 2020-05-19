<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QueBank extends Model
{
    protected $primaryKey= 'que_bank_id';

    protected $hidden = [
        'created_at', 'updated_at'
    ];
    
    public function question()
    {
        return $this->hasMany(Question::class, 'que_bank_id', 'que_bank_id')->with('que_option')->where('questions.status',1);
    }
}
