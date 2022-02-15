<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

Class Marquees extends Model
{ 
    use SoftDeletes;
    protected $table = 'marquees';
    protected $hidden = ['deleted_at'];
	
	public function getDates()
    {
        return [];
    }
	
	public function formatRow(){
		
		//$name = 'DT_RowId';
		//$this->$name='row_8';
	}
}
