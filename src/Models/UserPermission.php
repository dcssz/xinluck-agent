<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

Class UserPermission extends Model
{ 
    use SoftDeletes;
	
	public function getDates()
    {
        return [];
    }
	 
    protected $hidden = ['deleted_at'];

	 
    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }
	
	 
}
