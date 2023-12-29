<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

Class MenuLocal extends Model
{ 
    use SoftDeletes;
	protected $table = 'menu_locales';
	public function getDates()
    {
        return [];
    }
	 
    protected $hidden = ['deleted_at'];

}
