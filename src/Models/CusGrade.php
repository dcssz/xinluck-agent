<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

Class CusGrade extends Model
{ 
    use SoftDeletes;
    protected $table = 'cus_grades';
    //protected $hidden = ['deleted_at'];
}
