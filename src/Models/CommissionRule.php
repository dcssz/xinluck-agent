<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

Class CommissionRule extends Model
{ 
    use SoftDeletes;
    protected $table = 'commission_rules';
    protected $hidden = ['deleted_at'];
	
	public function getDates()
    {
        return [];
    }

    public function commissionRuleDetails()
    {
        return $this->hasMany('App\Models\CommissionRuleDetail');
    }
	
    public function effectCusRule()
    {
        return $this->belongsTo('App\Models\EffectCusRule');
    }
}
