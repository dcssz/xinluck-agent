<?php
namespace App\Extensions;

class Functions {
	 
	public static function listData($draw,$recordsTotal,$recordsFiltered,$data,$customActionMessage='',$customActionStatus='OK')
	{
		$result = new \stdClass;
		$result->draw = $draw;
		$result->recordsTotal = $recordsTotal;
		$result->recordsFiltered = $recordsFiltered;
		$result->customActionMessage = $customActionMessage;
		$result->customActionStatus = $customActionStatus;
		$result->data = $data;
		return $result;
	}
	
	public static function showMsg($url,$type,$target){
		//参考/templates/js/kang_common.js  function show_msg(msg_code, args){
		$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"alert(show_msg(\"'.$type.'\", {\"target\":\"'.$target.'\"}));location.href=\"'.$url.'\""}]}}');
		return $msg;
	}
}
