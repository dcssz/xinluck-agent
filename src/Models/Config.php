<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

Class Config extends Model
{ 
    use SoftDeletes;
    protected $table = 'configs';
    //protected $hidden = ['deleted_at'];
	
	public function formatRow(){
		
		//$name = 'DT_RowId';
		//$this->$name='row_8';
	}
}
