<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

Class Game extends Model
{ 
    use SoftDeletes;
    protected $table = 'games';
    //protected $hidden = ['deleted_at'];

    public function gameStores()
    {
        return $this->hasMany('App\Models\GameStore');
    }

    public function gameUser()
    {
        return $this->hasMany('App\Models\GameUser');
    }
}
