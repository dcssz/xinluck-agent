<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

Class RetreatRuleDetail extends Model
{ 
    //use SoftDeletes;
    protected $table = 'retreat_rule_details';
    //protected $hidden = ['deleted_at'];
	
	public function getDates()
    {
        return [];
    }

    public function gameStores()
    {
        return $this->belongsToMany('App\Models\GameStore', 'retreat_rule_detail_game_store', 'retreat_rule_detail_id', 'game_store_id')->withPivot('percent');
    }
}
