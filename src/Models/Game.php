<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

Class Game extends Model
{ 
    use SoftDeletes;
    protected $table = 'games';
    //protected $hidden = ['deleted_at'];

    public function gameStore()
    {
        return $this->belongsTo('App\Models\GameStore');
    }

    public function gameMark()
    {
        return $this->belongsTo('App\Models\GameMark');
    }
}
