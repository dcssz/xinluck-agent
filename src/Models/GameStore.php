<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

Class GameStore extends Model
{ 
    use SoftDeletes;
    protected $table = 'game_stores';
    //protected $hidden = ['deleted_at'];

    public function games()
    {
        return $this->hasMany('App\Models\Game');
    }
}
