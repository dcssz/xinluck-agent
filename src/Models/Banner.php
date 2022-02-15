<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

Class Banner extends Model
{ 
    use SoftDeletes;
	protected $table = 'banners';
	public function getDates()
    {
        return [];
    }
	 
    protected $hidden = ['deleted_at'];

	public function bannerlocal(){
		return $this->hasOne('App\Models\BannerLocal');
	}
}
