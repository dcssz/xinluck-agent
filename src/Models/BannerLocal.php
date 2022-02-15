<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

Class BannerLocal extends Model
{ 
    use SoftDeletes;
	protected $table = 'banner_locales';
	public function getDates()
    {
        return [];
    }
	 
    protected $hidden = ['deleted_at'];

}
