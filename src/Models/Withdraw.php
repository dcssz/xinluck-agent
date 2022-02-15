<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

Class Withdraw extends Model
{ 
    use SoftDeletes;
    protected $table = 'withdraws';
	 
    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }

    public function userBank()
    {
        return $this->belongsTo('App\Models\UserBank','bank_id','id');
    }
}
