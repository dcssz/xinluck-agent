<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

Class UserIp extends Model
{ 
    use SoftDeletes;
	protected $table = 'user_ips';
	public function getDates()
    {
        return [];
    }
	 
    protected $hidden = ['deleted_at'];

	 

	public function user(){
		return $this->belongsTo('App\Models\User','user_id','id');
	} 
} 
