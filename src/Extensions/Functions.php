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

	//每周日中午12點切帳 取得目標當周日日期
	public static function getTargetSundayDate($now = null) {
		// 如果沒傳入時間，預設用當前時間
		$now = $now ? new \DateTime($now) : new \DateTime();
	
		// 找到本周日
		$sunday = clone $now;
		$sunday->modify('sunday this week');
	
		// 設定周日中午 12:00:00
		$sundayNoon = clone $sunday;
		$sundayNoon->setTime(12, 0, 0);
	
		if ($now < $sundayNoon) {
			// 如果在周日中午前 → 回傳上周日
			$sunday->modify('-1 week');
		}
		// 如果在周日中午後 → 保持本周日
	
		return $sunday->format('Y-m-d');
	}

	//每周日中午12點切帳 取得目標下周日日期
	public static function getNextSundayDate($now = null) {
		// 如果沒傳入時間，預設用當前時間
		$now = $now ? new \DateTime($now) : new \DateTime();
	
		// 先找到本周日的日期 (周日是週的最後一天)
		$sunday = clone $now;
		$sunday->modify('sunday this week');
		
		// 設定周日中午 12:00:00
		$sundayNoon = clone $sunday;
		$sundayNoon->setTime(12, 0, 0);
	
		// 判斷當前時間是否在周日中午之後
		if ($now >= $sundayNoon) {
			// 如果超過周日中午，取下周日
			$sunday->modify('+1 week');
		}
	
		return $sunday->format('Y-m-d');
	}
}
