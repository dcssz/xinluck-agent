<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

Class EffectCusRule extends Model
{ 
    use SoftDeletes;
    protected $table = 'effect_cus_rules';
    //protected $hidden = ['deleted_at'];
}
