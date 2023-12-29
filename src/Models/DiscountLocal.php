<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

Class DiscountLocal extends Model
{ 
    use SoftDeletes;
	protected $table = 'discount_locales';
	public function getDates()
    {
        return [];
    }
	 
    protected $hidden = ['deleted_at'];

 
} 
