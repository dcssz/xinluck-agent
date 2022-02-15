<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

Class Discount extends Model
{ 
    use SoftDeletes;
	protected $table = 'discounts';
	public function getDates()
    {
        return [];
    }
	 
    protected $hidden = ['deleted_at'];

	public function category(){
		return $this->belongsTo('App\Models\DiscountCategory','cid','id');
	} 
	 
	public function discountlocal(){
		return $this->hasOne('App\Models\DiscountLocal');
	}
} 
