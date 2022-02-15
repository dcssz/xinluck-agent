<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

Class GameStoreType extends Model
{ 
    use SoftDeletes;
    protected $table = 'game_store_types';
    //protected $hidden = ['deleted_at'];

    public function gameStores()
    {
        return $this->hasMany('App\Models\GameStore');
    }
}
