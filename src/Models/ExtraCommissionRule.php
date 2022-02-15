<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

Class ExtraCommissionRule extends Model
{ 
    use SoftDeletes;
    protected $table = 'extra_commission_rules';
    protected $hidden = ['deleted_at'];
	
	public function getDates()
    {
        return [];
    }

    public function extraCommissionRuleDetails()
    {
        return $this->hasMany('App\Models\ExtraCommissionRuleDetail');
    }
	
}
