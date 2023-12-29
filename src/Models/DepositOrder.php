<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

Class DepositOrder extends Model
{ 
    use SoftDeletes;
    protected $table = 'deposit_orders';
	 
    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}
