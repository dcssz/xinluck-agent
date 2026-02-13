<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

Class Bet extends Model
{ 
    use SoftDeletes;
	protected $table = 'bets';
	public function getDates()
    {
        return [];
    }
	 
    protected $hidden = ['deleted_at'];

	public function game(){
		return $this->belongsTo('App\Models\Game','game_id','id');
	}

	public function gameSub(){
		return $this->belongsTo('App\Models\GameSub','game_sub_id','id');
	}
	
	public function user(){
		return $this->belongsTo('App\Models\User','user_id','id');
	}
	
	public static function getFlag($flag){
		if($flag == 1){
			return '完成';
		}elseif($flag == 0){
			return '未结算';
		}elseif($flag == -1){
			return '弃单';
		}
	}
	 
}
