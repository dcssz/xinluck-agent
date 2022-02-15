<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

Class CusMark extends Model
{ 
    use SoftDeletes;
    protected $table = 'cus_marks';
    //protected $hidden = ['deleted_at'];
}
