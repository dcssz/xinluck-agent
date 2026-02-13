<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

Class UserBetLog extends Model
{ 
    //use SoftDeletes;
	protected $table = 'user_bet_logs';
	public function getDates()
    {
        return [];
    }
	 

	public function game(){
		return $this->belongsTo('App\Models\Game','game_id','id');
	}
	public function user(){
		return $this->belongsTo('App\Models\User','user_id','id');
	}
	
}
