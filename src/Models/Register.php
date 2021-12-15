<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

Class Register extends Model
{ 
    use SoftDeletes;
    //protected $hidden = ['deleted_at'];
	
}
