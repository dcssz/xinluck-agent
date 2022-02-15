<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

Class ExtraCommissionRuleDetail extends Model
{ 
    //use SoftDeletes;
    protected $table = 'extra_commission_rule_details';
    //protected $hidden = ['deleted_at'];
	
	public function getDates()
    {
        return [];
    }

    public function gameStores()
    {
        return $this->belongsToMany('App\Models\GameStore', 'extra_commission_rule_detail_game_store', 'extra_commission_rule_detail_id', 'game_store_id')->withPivot('percent');
    }
}
