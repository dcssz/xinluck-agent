<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

Class GameMark extends Model
{ 
    use SoftDeletes;
    protected $table = 'game_marks';
    //protected $hidden = ['deleted_at'];
}
