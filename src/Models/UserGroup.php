<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

Class UserGroup extends Model
{ 
    use SoftDeletes;
    protected $table = 'user_groups';
    //protected $hidden = ['deleted_at'];
}
