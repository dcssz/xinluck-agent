<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

Class SystemNotice extends Model
{ 
    use SoftDeletes;
 
    protected $hidden = ['deleted_at'];
	
	public function getDates()
    {
        return [];
    }
	
 
}
