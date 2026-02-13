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

    public function games()
    {
        return $this->belongsToMany('App\Models\Game', 'retreat_rule_game', 'retreat_rule_id', 'game_id');
    }

    public function ruleDetailsGames()
    {
        return $this->hasManyThrough('App\Models\RetreatRuleDetailGame', 'App\Models\RetreatRuleDetail', 'retreat_rule_id', 'retreat_rule_detail_id');
    }
}
