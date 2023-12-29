<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

Class Payment extends Model
{ 
    use SoftDeletes;
	protected $table = 'payments';
	public function getDates()
    {
        return [];
    }
	 
    protected $hidden = ['deleted_at'];

	 
}
