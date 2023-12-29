<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

Class GameStore extends Model
{ 
    use SoftDeletes;
    protected $table = 'game_stores';
    //protected $hidden = ['deleted_at'];

    public function game()
    {
        return $this->belongsTo('App\Models\Game');
    }

    public function gameMark()
    {
        return $this->belongsTo('App\Models\GameMark');
    }
}
