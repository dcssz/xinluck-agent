<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

Class CusBank extends Model
{ 
    use SoftDeletes;
    protected $table = 'cus_banks';
    //protected $hidden = ['deleted_at'];
}
