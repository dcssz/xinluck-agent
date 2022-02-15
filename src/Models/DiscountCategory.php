<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

Class DiscountCategory extends Model
{ 
    use SoftDeletes;
	protected $table = 'discount_categories';
	public function getDates()
    {
        return [];
    }
	 
    protected $hidden = ['deleted_at'];

	 
}
