<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

Class RetreatRule extends Model
{ 
    use SoftDeletes;
    protected $table = 'retreat_rules';
    protected $hidden = ['deleted_at'];
	
	public function getDates()
    {
        return [];
    }

    public function retreatRuleDetails()
    {
        return $this->hasMany('App\Models\RetreatRuleDetail');
    }
	
    public function effectCusRule()
    {
        return $this->belongsTo('App\Models\EffectCusRule');
    }

    public function gameStores()
    {
        return $this->belongsToMany('App\Models\GameStore', 'retreat_rule_game_store', 'retreat_rule_id', 'game_store_id');
    }
}
