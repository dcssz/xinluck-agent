<?php
namespace App\Controllers\Admin;

use Illuminate\Database\Capsule\Manager as DB;
use stdClass;
use Interop\Container\ContainerInterface;
use App\Extensions\AdminBase;
use App\Extensions\Functions;
use App\Models\GameStore as GameStoreModel;
use App\Models\GameMark as GameMarkModel;
use App\Models\Game as GameModel;
class Game extends AdminBase
{
	public function __Construct(ContainerInterface $container)
    {
		parent::__Construct($container);
	}

	public function gameStoreInfoManager($request, $response)
    {
        return $this->view->render('game_store_info_manager');
	}

	public function listGameStores($request, $response)
    {
		$get = $request->getQueryParams();
		$where = array();
		//$where[] = array('status',1);
		$start = 0;
		if(isset($get['start']))
			$start = intval($get['start']);
		
		$length = 0;
		if(isset($get['length']))
			$length = intval($get['length']);
		
		$datas = GameStoreModel::where($where)->skip($start)->take($length)->get();
		$result = array();
		foreach($datas as $data){
			$name = $data->name;
			$percent  = $data->percent;
			if ($data->maintain_end >= date('Y-m-d H:i:s')) {
				$maintain = $data->maintain_start . '~' . $data->maintain_end;
			} else {
				$maintain = '';
			}
			if ($data->status == 1) {
				if ($data->maintain_end >= date('Y-m-d H:i:s')) {
					//维护
					$status = "<a class=\"status-btn status-maintain\" href=\"javascript:void(0);\">維護</a>";
				} else {
					$status = "<a class=\"status-btn status-open\" href=\"javascript:void(0);\">服務</a>";
				} 
				$action = "<a href=\"javascript:void(0);\" onclick=\"change_status('{$data->id}', 0);\" class=\"btn btn-xs default\"> <i class=\"fa fa-pencil\"></i> 關閉 </a>\n\t\t\t\t\t\t\t\t<a href=\"javascript:void(0);\" onclick=\"request_editor_item_div('edit', '{$data->id}');\" class=\"btn btn-xs default\"> <i class=\"fa fa-pencil\"></i> 修改 </a>";
			} else {
				$status = "<a class=\"status-btn status-close\" href=\"javascript:void(0);\">關閉</a>";
				$action = "<a href=\"javascript:void(0);\" onclick=\"change_status('{$data->id}', 1);\" class=\"btn btn-xs default\"> <i class=\"fa fa-pencil\"></i> 啟動 </a>\n\t\t\t\t\t\t\t\t<a href=\"javascript:void(0);\" onclick=\"request_editor_item_div('edit', '{$data->id}');\" class=\"btn btn-xs default\"> <i class=\"fa fa-pencil\"></i> 修改 </a>";
			}
			$operator = $data->operator;
			$updated_at = "<div align= center>".$data->updated_at."</div>";
			
			$formatItem = array();
			$formatItem[] = $name;
			$formatItem[] = $percent;
			$formatItem[] = $maintain;
			$formatItem[] = $status;
			$formatItem[] = $operator;
			$formatItem[] = $updated_at;
			$formatItem[] = $action;
			$result[] = $formatItem;
		}
		
		$count = GameStoreModel::where($where)->count();
		if($result == null)$result = [];
		$draw = 1;
		if(isset($get['draw']))
			$draw = intval($get['draw']);
		$result = Functions::listData($draw ,$count,$count,$result);
		return $response->withJson($result);
	}

	public function changeGameStoreStatus($request, $response)
    {
        $post = $request->getParsedBody();
		$id = $post['edit_info_id'];
		$edit_status = $post['edit_status'];
		GameStoreModel::where('id', $id)->update(['status'=> $edit_status,'operator' => 'admin']);
		$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'-2\', {\"target\":\"kangGameStoreInfo\"}));grid.getDataTable().ajax.reload();"}]}}');
		
		return $response->withJson($msg);
	}

	public function gameStoreEditor($request, $response)
    {
		$post = $request->getParsedBody();
		$etype = $post['etype'];
		$id = $post['edit_info_id'];

		
		$data = GameStoreModel::where('id', $id)->first();
		$name = $data->name;
		$percent = $data->percent;
		$date = date('Y-m-d');
		$time = date('H-i-s');
		$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"#editor-item-div","rtntext":"<!--slot=2-->\n<form id=\"save-game-store-info-form\">\n\t<table class=\"table editor-table table-bordered\">\n\t\t<thead>\n\t\t\t<tr>\n\t\t\t\t<th class=\"title\" colspan=\"100%\">\u7de8\u8f2f<\/th>\n\t\t\t<\/tr>\n\t\t<\/thead>\n\t\t<tbody>\n\t\t\t<tr>\n\t\t\t\t<td>廠商名稱<\/td>\n\t\t\t\t<td>'.$name.'<\/td>\n\t\t\t<\/tr>\n            <tr class=\"\">\n\t\t\t\t<td>\u4e0a\u7e73%\u6578<\/td>\n\t\t\t\t<td><input type=\"text\" name=\"ac_per\" value=\"'.$percent.'\">&nbsp;%<\/td>\n\t\t\t<\/tr>\n\t\t\t<tr class=\"hidden\">\n\t\t\t\t<td>\u806f\u7d61\u7fa4\u540d\u7a31<\/td>\n\t\t\t\t<td><input type=\"text\" size=\"40\" id=\"contact-txt\" name=\"contact_txt\" value=\"\"><\/td>\n\t\t\t<\/tr>\n\t\t\t<tr>\n\t\t\t\t<td>\u7dad\u8b77\u958b\u59cb\u6642\u9593<\/td>\n\t\t\t\t<td>\n\t\t\t\t\t<div class=\"fl-l\">\n\t\t\t\t\t\t<div class=\"input-group input-small date date-picker sddate\" data-date=\"'.$date.'\" data-date-format=\"yyyy-mm-dd\" data-date-viewmode=\"years\">\n\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control\" name=\"start_date\" value=\"'.$date.'\" readonly>\n\t\t\t\t\t\t\t<span class=\"input-group-btn\">\n\t\t\t\t\t\t\t\t<button class=\"btn default\" type=\"button\">\n\t\t\t\t\t\t\t\t<i class=\"fa fa-calendar\"><\/i>\n\t\t\t\t\t\t\t\t<\/button>\n\t\t\t\t\t\t\t<\/span>\n\t\t\t\t\t\t<\/div>\n\t\t\t\t\t<\/div>\n\t\t\t\t\t<div class=\"fl-l mr-l-10\">\n\t\t\t\t\t\t<div class=\"input-group input-small start-time\">\n\t\t\t\t\t\t\t<input type=\"text\" name=\"start_time\" value=\"'.$time.'\" class=\"form-control timepicker timepicker-24\" readonly>\n\t\t\t\t\t\t\t<span class=\"input-group-btn\">\n\t\t\t\t\t\t\t\t<button class=\"btn default\" type=\"button\">\n\t\t\t\t\t\t\t\t\t<i class=\"fa fa-clock-o\"><\/i>\n\t\t\t\t\t\t\t\t<\/button>\n\t\t\t\t\t\t\t<\/span>\n\t\t\t\t\t\t<\/div>\n\t\t\t\t\t<\/div>\n\t\t\t\t<\/td>\n\t\t\t<\/tr>\n\t\t\t<tr>\n\t\t\t\t<td>\u7dad\u8b77\u7d50\u675f\u6642\u9593<\/td>\n\t\t\t\t<td>\n\t\t\t\t\t<div class=\"fl-l\">\n\t\t\t\t\t\t<div class=\"input-group input-small date date-picker eddate\" data-date=\"'.$date.'\" data-date-format=\"yyyy-mm-dd\" data-date-viewmode=\"years\">\n\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control\" name=\"end_date\" value=\"2021-12-14\" readonly>\n\t\t\t\t\t\t\t<span class=\"input-group-btn\">\n\t\t\t\t\t\t\t\t<button class=\"btn default\" type=\"button\">\n\t\t\t\t\t\t\t\t<i class=\"fa fa-calendar\"><\/i>\n\t\t\t\t\t\t\t\t<\/button>\n\t\t\t\t\t\t\t<\/span>\n\t\t\t\t\t\t<\/div>\n\t\t\t\t\t<\/div>\n\t\t\t\t\t<div class=\"fl-l mr-l-10\">\n\t\t\t\t\t\t<div class=\"input-group input-small end-time\">\n\t\t\t\t\t\t\t<input type=\"text\" name=\"end_time\" value=\"'.$time.'\\" class=\"form-control timepicker timepicker-24\" readonly>\n\t\t\t\t\t\t\t<span class=\"input-group-btn\">\n\t\t\t\t\t\t\t\t<button class=\"btn default\" type=\"button\">\n\t\t\t\t\t\t\t\t\t<i class=\"fa fa-clock-o\"><\/i>\n\t\t\t\t\t\t\t\t<\/button>\n\t\t\t\t\t\t\t<\/span>\n\t\t\t\t\t\t<\/div>\n\t\t\t\t\t<\/div>\n\t\t\t\t<\/td>\n\t\t\t<\/tr>\n\t\t\t<tr align=\"right\">\n\t\t\t\t<td colspan=\"100%\"><button type=\"button\" class=\"btn red\" onclick=\"close_layer({type: 1});\">\u53d6\u6d88<\/button><button type=\"button\" class=\"btn green\" onclick=\"save_game_store_info();\">\u5132\u5b58<\/button><\/td>\n\t\t\t<\/tr>\n\t\t<\/tbody>\n\t<\/table>\n<\/form>\n<input type=\"hidden\" id=\"etype\" value=\"edit\" \/>\n<input type=\"hidden\" id=\"edit-info-id\" value=\"'.$id.'\" \/>\n"},{"spanid":"javascript","rtntext":"show_editor_item_div();datetime_picker_init();"}]}}');
		
		return $response->withJson($msg);
	}

	public function saveGameStore($request, $response)
    {
        
        $post = $request->getParsedBody();
		$id = $post['edit_info_id'];
		$data = GameStoreModel::where('id', $id)->first();
		$data->percent = $post['ac_per'];
		$data->maintain_start = $post['start_date'] . ' ' . $post['start_time'] . ':00';
		$data->maintain_end = $post['end_date'] . ' ' . $post['end_time'] . ':00';
		$data->operator = 'admin';
		$data->save();
		$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"close_layer({type: 1});pop_msg(show_msg(\'-1\', {\"target\":\"kangGameStoreInfo\"}));grid.getDataTable().ajax.reload();"}]}}');
		
		return $response->withJson($msg);
	}

	public function gameCategoryInfoManager($request, $response)
    {
		$gameMarks = GameMarkModel::all();
		
        return $this->view->render('game_category_info_manager', [
			"gameMarks" => $gameMarks,
		]);
	}

	public function listGames($request, $response)
    {
		$get = $request->getQueryParams();
		$where = array();
		//$where[] = array('status',1);
		$start = 0;
		if(isset($get['start']))
			$start = intval($get['start']);
		
		$length = 0;
		if(isset($get['length']))
			$length = intval($get['length']);
		
		$datas = GameModel::with('gameStore', 'gameMark')->where($where)->skip($start)->take($length)->get();
		
		$result = array();
		foreach($datas as $data){
			$name = $data->name;
			$store_name = $data->gameStore->name;
			$type = $data->type;
			if ($data->gameMark) {
				$mark = $data->gameMark->name;
			} else {
				$mark = "未設置";
			}
			if ($data->maintain_end >= date('Y-m-d H:i:s')) {
				$maintain = $data->maintain_start . '~' . $data->maintain_end;
			} else {
				$maintain = '';
			}
			if ($data->status == 1) {
				if ($data->maintain_end >= date('Y-m-d H:i:s')) {
					//维护
					$status = "<a class=\"status-btn status-maintain\" href=\"javascript:void(0);\">維護</a>";
				} else {
					$status = "<a class=\"status-btn status-open\" href=\"javascript:void(0);\">服務</a>";
				} 
				$action = "<a href=\"javascript:void(0);\" onclick=\"change_status('{$data->id}', 0);\" class=\"btn btn-xs default\"> <i class=\"fa fa-pencil\"></i> 關閉 </a>\n\t\t\t\t\t\t\t\t<a href=\"javascript:void(0);\" onclick=\"request_editor_item_div('edit', '{$data->id}');\" class=\"btn btn-xs default\"> <i class=\"fa fa-pencil\"></i> 修改 </a>";
			} else {
				$status = "<a class=\"status-btn status-close\" href=\"javascript:void(0);\">關閉</a>";
				$action = "<a href=\"javascript:void(0);\" onclick=\"change_status('{$data->id}', 1);\" class=\"btn btn-xs default\"> <i class=\"fa fa-pencil\"></i> 啟動 </a>\n\t\t\t\t\t\t\t\t<a href=\"javascript:void(0);\" onclick=\"request_editor_item_div('edit', '{$data->id}');\" class=\"btn btn-xs default\"> <i class=\"fa fa-pencil\"></i> 修改 </a>";
			}
			$operator = $data->operator;
			$updated_at = $data->updated_at."";
			
			$formatItem = array();
			$formatItem[] = $name;
			$formatItem[] = $store_name;
			$formatItem[] = $type;
			$formatItem[] = $mark;
			$formatItem[] = $maintain;
			$formatItem[] = $status;
			$formatItem[] = $operator;
			$formatItem[] = $updated_at;
			$formatItem[] = $action;
			$result[] = $formatItem;
		}
		
		$count = GameModel::where($where)->count();
		if($result == null)$result = [];
		$draw = 1;
		if(isset($get['draw']))
			$draw = intval($get['draw']);
		$result = Functions::listData($draw ,$count,$count,$result);
		return $response->withJson($result);
	}

	public function changeGameStatus($request, $response)
    {
        $post = $request->getParsedBody();
		$id = $post['edit_info_id'];
		$edit_status = $post['edit_status'];
		GameModel::where('id', $id)->update(['status'=> $edit_status,'operator' => 'admin']);
		$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'-2\', {\"target\":\"kangGameStoreInfo\"}));grid.getDataTable().ajax.reload();"}]}}');
		
		return $response->withJson($msg);
	}

	public function gameEditor($request, $response)
    {
		$post = $request->getParsedBody();
		$etype = $post['etype'];
		$id = $post['edit_info_id'];

		
		$data = GameModel::with('gameStore', 'gameMark')->where('id', $id)->first();
		$name = $data->name;
		$percent = $data->percent;
		$date = date('Y-m-d');
		$time = date('H-i-s');
		$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"#editor-item-div","rtntext":"<!--slot=2-->\n<form id=\"save-game-category-info-form\">\n\t<table class=\"table editor-table table-bordered\">\n\t\t<thead>\n\t\t\t<tr>\n\t\t\t\t<th class=\"title\" colspan=\"100%\">\u7de8\u8f2f<\/th>\n\t\t\t<\/tr>\n\t\t<\/thead>\n\t\t<tbody>\n\t\t\t<tr>\n\t\t\t\t<td>\u904a\u6232\u540d\u7a31<\/td>\n\t\t\t\t<td>\u7ae0\u9b5a\u738b<\/td>\n\t\t\t<\/tr>\n\t\t\t<tr>\n\t\t\t\t<td>\u5ee0\u5546\u540d\u7a31<\/td>\n\t\t\t\t<td>KA\u96fb\u5b50<\/td>\n\t\t\t<\/tr>\n\t\t\t<tr>\n\t\t\t\t<td>\u904a\u6232\u985e\u578b<\/td>\n\t\t\t\t<td>\u6355\u9b5a\u6a5f<\/td>\n\t\t\t<\/tr>\n\t\t\t<tr>\n\t\t\t\t<td>\u904a\u6232\u6a19\u7c3d<\/td>\n\t\t\t\t<td>\n\t\t\t\t\t<select name=\"edit_mark_id\" class=\"form-control input-inline\" style=\"width:300px;\">\n\t\t\t\t\t\t<option value=\"0\">\u8acb\u9078\u64c7<\/option>\n\t\t\t\t\t\t<!--slot=1-->\n\n\t<option  value=\"5\" > 123<\/option>\n\n\t<option  value=\"8\" > 5<\/option>\n\n\n\t\t\t\t\t<\/select>\n\t\t\t\t<\/td>\n\t\t\t<\/tr>\n\t\t\t<tr>\n\t\t\t\t<td>\u7dad\u8b77\u958b\u59cb\u6642\u9593<\/td>\n\t\t\t\t<td>\n\t\t\t\t\t<div class=\"fl-l\">\n\t\t\t\t\t\t<div class=\"input-group input-small date date-picker sddate\" data-date=\"2021-12-15\" data-date-format=\"yyyy-mm-dd\" data-date-viewmode=\"years\">\n\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control\" name=\"start_date\" value=\"2021-12-15\" readonly>\n\t\t\t\t\t\t\t<span class=\"input-group-btn\">\n\t\t\t\t\t\t\t\t<button class=\"btn default\" type=\"button\">\n\t\t\t\t\t\t\t\t<i class=\"fa fa-calendar\"><\/i>\n\t\t\t\t\t\t\t\t<\/button>\n\t\t\t\t\t\t\t<\/span>\n\t\t\t\t\t\t<\/div>\n\t\t\t\t\t<\/div>\n\t\t\t\t\t<div class=\"fl-l mr-l-10\">\n\t\t\t\t\t\t<div class=\"input-group input-small start-time\">\n\t\t\t\t\t\t\t<input type=\"text\" name=\"start_time\" value=\"14:58:11\" class=\"form-control timepicker timepicker-24\" readonly>\n\t\t\t\t\t\t\t<span class=\"input-group-btn\">\n\t\t\t\t\t\t\t\t<button class=\"btn default\" type=\"button\">\n\t\t\t\t\t\t\t\t\t<i class=\"fa fa-clock-o\"><\/i>\n\t\t\t\t\t\t\t\t<\/button>\n\t\t\t\t\t\t\t<\/span>\n\t\t\t\t\t\t<\/div>\n\t\t\t\t\t<\/div>\n\t\t\t\t<\/td>\n\t\t\t<\/tr>\n\t\t\t<tr>\n\t\t\t\t<td>\u7dad\u8b77\u7d50\u675f\u6642\u9593<\/td>\n\t\t\t\t<td>\n\t\t\t\t\t<div class=\"fl-l\">\n\t\t\t\t\t\t<div class=\"input-group input-small date date-picker eddate\" data-date=\"2021-12-15\" data-date-format=\"yyyy-mm-dd\" data-date-viewmode=\"years\">\n\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control\" name=\"end_date\" value=\"2021-12-15\" readonly>\n\t\t\t\t\t\t\t<span class=\"input-group-btn\">\n\t\t\t\t\t\t\t\t<button class=\"btn default\" type=\"button\">\n\t\t\t\t\t\t\t\t<i class=\"fa fa-calendar\"><\/i>\n\t\t\t\t\t\t\t\t<\/button>\n\t\t\t\t\t\t\t<\/span>\n\t\t\t\t\t\t<\/div>\n\t\t\t\t\t<\/div>\n\t\t\t\t\t<div class=\"fl-l mr-l-10\">\n\t\t\t\t\t\t<div class=\"input-group input-small end-time\">\n\t\t\t\t\t\t\t<input type=\"text\" name=\"end_time\" value=\"14:58:11\" class=\"form-control timepicker timepicker-24\" readonly>\n\t\t\t\t\t\t\t<span class=\"input-group-btn\">\n\t\t\t\t\t\t\t\t<button class=\"btn default\" type=\"button\">\n\t\t\t\t\t\t\t\t\t<i class=\"fa fa-clock-o\"><\/i>\n\t\t\t\t\t\t\t\t<\/button>\n\t\t\t\t\t\t\t<\/span>\n\t\t\t\t\t\t<\/div>\n\t\t\t\t\t<\/div>\n\t\t\t\t<\/td>\n\t\t\t<\/tr>\n\t\t\t<tr align=\"right\">\n\t\t\t\t<td colspan=\"100%\"><button type=\"button\" class=\"btn red\" onclick=\"close_layer({type: 1});\">\u53d6\u6d88<\/button><button type=\"button\" class=\"btn green\" onclick=\"save_game_category_info();\">\u5132\u5b58<\/button><\/td>\n\t\t\t<\/tr>\n\t\t<\/tbody>\n\t<\/table>\n<\/form>\n<input type=\"hidden\" id=\"etype\" value=\"edit\" \/>\n<input type=\"hidden\" id=\"edit-info-id\" value=\"2898\" \/>\n"},{"spanid":"javascript","rtntext":"show_editor_item_div();datetime_picker_init();"}]}}');
		//$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"#editor-item-div","rtntext":"<!--slot=2-->\n<form id=\"save-game-store-info-form\">\n\t<table class=\"table editor-table table-bordered\">\n\t\t<thead>\n\t\t\t<tr>\n\t\t\t\t<th class=\"title\" colspan=\"100%\">\u7de8\u8f2f<\/th>\n\t\t\t<\/tr>\n\t\t<\/thead>\n\t\t<tbody>\n\t\t\t<tr>\n\t\t\t\t<td>廠商名稱<\/td>\n\t\t\t\t<td>'.$name.'<\/td>\n\t\t\t<\/tr>\n            <tr class=\"\">\n\t\t\t\t<td>\u4e0a\u7e73%\u6578<\/td>\n\t\t\t\t<td><input type=\"text\" name=\"ac_per\" value=\"'.$percent.'\">&nbsp;%<\/td>\n\t\t\t<\/tr>\n\t\t\t<tr class=\"hidden\">\n\t\t\t\t<td>\u806f\u7d61\u7fa4\u540d\u7a31<\/td>\n\t\t\t\t<td><input type=\"text\" size=\"40\" id=\"contact-txt\" name=\"contact_txt\" value=\"\"><\/td>\n\t\t\t<\/tr>\n\t\t\t<tr>\n\t\t\t\t<td>\u7dad\u8b77\u958b\u59cb\u6642\u9593<\/td>\n\t\t\t\t<td>\n\t\t\t\t\t<div class=\"fl-l\">\n\t\t\t\t\t\t<div class=\"input-group input-small date date-picker sddate\" data-date=\"'.$date.'\" data-date-format=\"yyyy-mm-dd\" data-date-viewmode=\"years\">\n\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control\" name=\"start_date\" value=\"'.$date.'\" readonly>\n\t\t\t\t\t\t\t<span class=\"input-group-btn\">\n\t\t\t\t\t\t\t\t<button class=\"btn default\" type=\"button\">\n\t\t\t\t\t\t\t\t<i class=\"fa fa-calendar\"><\/i>\n\t\t\t\t\t\t\t\t<\/button>\n\t\t\t\t\t\t\t<\/span>\n\t\t\t\t\t\t<\/div>\n\t\t\t\t\t<\/div>\n\t\t\t\t\t<div class=\"fl-l mr-l-10\">\n\t\t\t\t\t\t<div class=\"input-group input-small start-time\">\n\t\t\t\t\t\t\t<input type=\"text\" name=\"start_time\" value=\"'.$time.'\" class=\"form-control timepicker timepicker-24\" readonly>\n\t\t\t\t\t\t\t<span class=\"input-group-btn\">\n\t\t\t\t\t\t\t\t<button class=\"btn default\" type=\"button\">\n\t\t\t\t\t\t\t\t\t<i class=\"fa fa-clock-o\"><\/i>\n\t\t\t\t\t\t\t\t<\/button>\n\t\t\t\t\t\t\t<\/span>\n\t\t\t\t\t\t<\/div>\n\t\t\t\t\t<\/div>\n\t\t\t\t<\/td>\n\t\t\t<\/tr>\n\t\t\t<tr>\n\t\t\t\t<td>\u7dad\u8b77\u7d50\u675f\u6642\u9593<\/td>\n\t\t\t\t<td>\n\t\t\t\t\t<div class=\"fl-l\">\n\t\t\t\t\t\t<div class=\"input-group input-small date date-picker eddate\" data-date=\"'.$date.'\" data-date-format=\"yyyy-mm-dd\" data-date-viewmode=\"years\">\n\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control\" name=\"end_date\" value=\"2021-12-14\" readonly>\n\t\t\t\t\t\t\t<span class=\"input-group-btn\">\n\t\t\t\t\t\t\t\t<button class=\"btn default\" type=\"button\">\n\t\t\t\t\t\t\t\t<i class=\"fa fa-calendar\"><\/i>\n\t\t\t\t\t\t\t\t<\/button>\n\t\t\t\t\t\t\t<\/span>\n\t\t\t\t\t\t<\/div>\n\t\t\t\t\t<\/div>\n\t\t\t\t\t<div class=\"fl-l mr-l-10\">\n\t\t\t\t\t\t<div class=\"input-group input-small end-time\">\n\t\t\t\t\t\t\t<input type=\"text\" name=\"end_time\" value=\"'.$time.'\\" class=\"form-control timepicker timepicker-24\" readonly>\n\t\t\t\t\t\t\t<span class=\"input-group-btn\">\n\t\t\t\t\t\t\t\t<button class=\"btn default\" type=\"button\">\n\t\t\t\t\t\t\t\t\t<i class=\"fa fa-clock-o\"><\/i>\n\t\t\t\t\t\t\t\t<\/button>\n\t\t\t\t\t\t\t<\/span>\n\t\t\t\t\t\t<\/div>\n\t\t\t\t\t<\/div>\n\t\t\t\t<\/td>\n\t\t\t<\/tr>\n\t\t\t<tr align=\"right\">\n\t\t\t\t<td colspan=\"100%\"><button type=\"button\" class=\"btn red\" onclick=\"close_layer({type: 1});\">\u53d6\u6d88<\/button><button type=\"button\" class=\"btn green\" onclick=\"save_game_store_info();\">\u5132\u5b58<\/button><\/td>\n\t\t\t<\/tr>\n\t\t<\/tbody>\n\t<\/table>\n<\/form>\n<input type=\"hidden\" id=\"etype\" value=\"edit\" \/>\n<input type=\"hidden\" id=\"edit-info-id\" value=\"'.$id.'\" \/>\n"},{"spanid":"javascript","rtntext":"show_editor_item_div();datetime_picker_init();"}]}}');
		
		return $response->withJson($data);
	}

	public function saveGame($request, $response)
    {
        
        $post = $request->getParsedBody();
		$id = $post['edit_info_id'];
		$data = GameModel::where('id', $id)->first();
		$data->percent = $post['ac_per'];
		$data->maintain_start = $post['start_date'] . ' ' . $post['start_time'] . ':00';
		$data->maintain_end = $post['end_date'] . ' ' . $post['end_time'] . ':00';
		$data->operator = 'admin';
		$data->save();
		$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"close_layer({type: 1});pop_msg(show_msg(\'-1\', {\"target\":\"kangGameStoreInfo\"}));grid.getDataTable().ajax.reload();"}]}}');
		//{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"close_layer({type: 1});pop_msg(show_msg('-1', {\"target\":\"kangGameCategoryInfo\"}));grid.getDataTable().ajax.reload();"}]}}
		return $response->withJson($msg);
	}

	public function gameMarkManager($request, $response)
    {
        return $this->view->render('game_mark_manager');
	}

	public function listGameMarks($request, $response)
    {
		$get = $request->getQueryParams();
		$where = array();
		//$where[] = array('status',1);
		$start = 0;
		if(isset($get['start']))
			$start = intval($get['start']);
		
		$length = 0;
		if(isset($get['length']))
			$length = intval($get['length']);
		
		$datas = GameMarkModel::where($where)->skip($start)->take($length)->get();
		$result = array();
		
		foreach($datas as $data){
			$id = $data->id;
			$name = $data->name;
			$operator = $data->operator;
			$updated_at = $data->updated_at;
			
			$action = "<a href=\"javascript:void(0);\" onclick=\"request_editor_item_div('edit', '$id');\" class=\"btn btn-xs default\"> <i class=\"fa fa-pencil\"></i> 修改 </a>";
			
			$formatItem = array();
			$formatItem[] = $id;
			$formatItem[] = $name;
			$formatItem[] = $operator;
			$formatItem[] = $updated_at ."";
			$formatItem[] = $action;
			$result[] = $formatItem;
		}
		
		$count = GameMarkModel::where($where)->count();
		if($result == null)$result = [];
		$draw = 1;
		if(isset($get['draw']))
			$draw = intval($get['draw']);
		$result = Functions::listData($draw ,$count,$count,$result);
		return $response->withJson($result);
	}

	public function gameMarkEditor($request, $response)
    {
		$post = $request->getParsedBody();
		$etype = $post['etype'];
		$id = $post['edit_mark_id'];

		if ($etype == 'add') {
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"#editor-item-div","rtntext":"<!--slot=2-->\n<form id=\'mark-manager-editor\'>\n<table class=\"table editor-table table-bordered\">\n\t<thead>\n\t\t<tr>\n\t\t\t<th class=\"title\" colspan=\"100%\">\u65b0\u589e<\/th>\n\t\t<\/tr>\n\t<\/thead>\n\t<tbody>\n        <!--slot=3-->\n\n<tr>\n    <td>\u6a19\u7c64\u540d\u7a31(\u7e41\u9ad4)<\/td>\n    <td><input type=\"text\" name=\"mark_name[tw]\" value=\"\" class=\'mark-name\'><\/td>\n<\/tr>\n\n\n\t\t<tr align=\"right\">\n\t\t\t<td colspan=\"100%\"><button type=\"button\" class=\"btn red\" onclick=\"close_layer({type: 1});\">\u53d6\u6d88<\/button><button type=\"button\" class=\"btn green\" onclick=\"save_game_mark();\">\u5132\u5b58<\/button><\/td>\n\t\t<\/tr>\n\t<\/tbody>\n<\/table>\n<\/form>\n<input type=\"hidden\" id=\"etype\" value=\"add\" \/>\n<input type=\"hidden\" id=\"edit-mark-id\" value=\"\" \/>\n"},{"spanid":"javascript","rtntext":"show_editor_item_div();App.init();"}]}}');
		} else {
			$data = GameMarkModel::where('id', $id)->first();
			$name = $data->name;
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"#editor-item-div","rtntext":"<!--slot=2-->\n<form id=\'mark-manager-editor\'>\n<table class=\"table editor-table table-bordered\">\n\t<thead>\n\t\t<tr>\n\t\t\t<th class=\"title\" colspan=\"100%\">\u7de8\u8f2f<\/th>\n\t\t<\/tr>\n\t<\/thead>\n\t<tbody>\n        <!--slot=3-->\n\n<tr>\n    <td>\u6a19\u7c64\u540d\u7a31(\u7e41\u9ad4)<\/td>\n    <td><input type=\"text\" name=\"mark_name[tw]\" value=\"'.$name.'\" class=\'mark-name\'><\/td>\n<\/tr>\n\n\n\t\t<tr align=\"right\">\n\t\t\t<td colspan=\"100%\"><button type=\"button\" class=\"btn red\" onclick=\"close_layer({type: 1});\">\u53d6\u6d88<\/button><button type=\"button\" class=\"btn green\" onclick=\"save_game_mark();\">\u5132\u5b58<\/button><\/td>\n\t\t<\/tr>\n\t<\/tbody>\n<\/table>\n<\/form>\n<input type=\"hidden\" id=\"etype\" value=\"edit\" \/>\n<input type=\"hidden\" id=\"edit-mark-id\" value=\"'.$id.'\" \/>\n"},{"spanid":"javascript","rtntext":"show_editor_item_div();App.init();"}]}}');
		}
		return $response->withJson($msg);
	}

	public function saveGameMark($request, $response)
    {
		$post = $request->getParsedBody();
		$id = $post['edit_mark_id'];
		
		$data = new GameMarkModel;
		if($id > 0){
			$data = GameMarkModel::find($id);
		}

		$data->name = $post['mark_name']['tw'];
		$data->operator = 'admin';
		$data->save();
		if($id > 0)
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"close_layer({type: 1});pop_msg(show_msg(\'-2\', {\"target\":\"kangGameMark\"}));grid.getDataTable().ajax.reload();"}]}}');
		else
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"close_layer({type: 1});pop_msg(show_msg(\'-1\', {\"target\":\"kangGameMark\"}));grid.getDataTable().ajax.reload();"}]}}');
		return $response->withJson($msg);
	}

	public function gameCategoryGainManager($request, $response)
    {
        return $this->view->render('game_category_gain_manager');
	}
}
