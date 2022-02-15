<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

Class User extends Model
{ 
    use SoftDeletes;
	
	public function getDates()
    {
        return [];
    }
	 
    protected $hidden = ['deleted_at', 'passowrd'];

	public static function getRoleName($role){
		if($role == 'agent')
			return '代理';
		elseif($role == 'topagent')
			return '总代';
		elseif($role == 'admin')
			return '后台网站';
		elseif($role == 'customer')
			return '会员';
	}
    public function upper()
    {
        return $this->belongsTo('App\Models\User','pid','id');
    }
	
	public function commissionRule()
    {
        return $this->belongsTo('App\Models\CommissionRule');
    }

    public function extraCommissionRule()
    {
        return $this->belongsTo('App\Models\ExtraCommissionRule');
    }

    public function retreatRule()
    {
        return $this->belongsTo('App\Models\RetreatRule');
    }

    public function cusGrade()
    {
        return $this->belongsTo('App\Models\CusGrade');
    }

    public function cusMark()
    {
        return $this->belongsTo('App\Models\CusMark');
    }
	
	public function verification(){
		return $this->hasOne('App\Models\UserVerification');
	}

	public function gameUser(){
		return $this->hasMany('App\Models\GameUser');
	}
	
	public function login($username, $password)
    {
        $where = array();
        $where[] = array('username', $username);
        $where[] = array('password', crypt($password, '$1$' . substr(md5($username), 5, 8)));
        return User::where($where)->first();
    }

    //取得会员的上级代理
    public static function getAgentNameOfMember($id){
		$member = User::where('id', $id)->first();
        $agent = User::where('id', $member->pid)->whereIn('role', ['agent', 'topagent'])->first();
        if (!$agent) {
            $name = '';
        } else {
            $name = $agent->username;
        }
        return $name;
	}
	
	public function permissions(){
		return $this->hasMany('App\Models\UserPermission','user_id','id');
	}
	
	
	public static function hasPermission($user,$menu_id){
		if($user == null)return false;
		return $user->permissions->where('menu_id',$menu_id)->count() > 0 ;
		 
	}
}
