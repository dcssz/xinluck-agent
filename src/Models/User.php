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
	 
    protected $hidden = ['deleted_at'];
	
	public function login($username, $password)
    {
        $where = array();
        $where[] = array('username', $username);
        $where[] = array('password', crypt($password, '$1$' . substr(md5($username), 5, 8)));
        return User::where($where)->first();
    }
}
