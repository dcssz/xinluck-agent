<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

Class Menu extends Model
{ 
    use SoftDeletes;
	
	public function getDates()
    {
        return [];
    }
	 
    protected $hidden = ['deleted_at'];

    public function locales()
    {
        return $this->hasMany('App\Models\MenuLocal','menu_id','id');
    }
	
	public static function getUserMenus($lang='zh_TW')
    {
        $parentMenus = null;
		$menus = Menu::with(['locales'=>function ($query) use ($lang) {
			return $query->where('lang',$lang)->get();
		}])->where('status',1)->orderBy('sort')->get();
		$user = User::with('permissions')->find($_SESSION['id']); 
		
		$parentMenus = array();
		foreach($menus as $key=>$menu){
			if($menu->pid == 0){
				$newMenu = new \stdClass;
				$newMenu->menu = $menu;
				$childs = array();
				foreach($menus as $child){
					$isPerm = User::hasPermission($user,$child->id);
					if($child->pid == $menu->id && $isPerm){
						$childs[] = $child;
					}
				}
				
				$newMenu->childMenus = $childs;
				if(count($childs) > 0)
					$parentMenus[] = $newMenu;
			}
		}
		
		return json_encode($parentMenus);
    }
}
