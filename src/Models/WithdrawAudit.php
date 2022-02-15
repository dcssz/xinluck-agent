<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

Class WithdrawAudit extends Model
{ 
    use SoftDeletes;
    protected $table = 'withdraw_audits';
	 
    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }

    public static function getType($type){
		if($type == 0){
			return '資金調度';
		}elseif($type == 1){
			return '人工出入金';
		}elseif($type == 2){
			return '優惠派發';
		}
	}
}
