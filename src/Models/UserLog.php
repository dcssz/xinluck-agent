<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

Class UserLog extends Model
{ 
    use SoftDeletes;
	
	public function getDates()
    {
        return [];
    }
	 
    protected $hidden = ['deleted_at'];

	public static function getType($type){
		if($type == 1)
			return '新增'; 
		else 
			return '其他';
	}
    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }
	
	public function saveLog($userId,$logType,$project,$operator,$details){
		$log = new UserLog;
		$log->user_id = $userId;
		$log->log_type = $logType;
		$log->project = $project;
		$log->operator = $operator;
		$log->details = $details; 
		$log->save();
	}
	
	 
}
