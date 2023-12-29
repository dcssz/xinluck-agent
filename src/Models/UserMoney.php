<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

Class UserMoney extends Model
{ 
    use SoftDeletes;
	
	public function getDates()
    {
        return [];
    }
	 
    protected $hidden = ['deleted_at'];

	public function user(){
		return $this->belongsTo('App\Models\User','username','username');
	}
	public static function getOpType($type){
		$name = '';
		if($type === 1)
			$name = _('存入');
		elseif($type === 2)
			$name =  _('提出'); 
		return $name;
	}
	public static function getStatus($status){
		$name = '';
		if($status === 0)
			$name = _('待處理');
		elseif($status === 1)
			$name =  _('成功'); 
		elseif($status === 2)
			$name =  _('失敗'); 
		return $name;
	}
	public static function getTransTypeName($type){
		$name = '';
		switch($type){
			case 1:
			$name = '資金調度';
			break;
		case 2:
			$name = '平台轉點';
			break;
		case 3:
			$name = '會員出入金';
			break;
		case 4:
			$name = '人工出入金';
			break;
		case 5:
			$name = '返水派發';
			break;
		case 6:
			$name = '優惠派發';
			break;		
		}
		return $name;
	}
}
