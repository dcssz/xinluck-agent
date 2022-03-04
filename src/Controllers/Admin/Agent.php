<?php
namespace App\Controllers\Admin;

use Illuminate\Database\Capsule\Manager as DB;
use stdClass;
use Interop\Container\ContainerInterface;
use App\Extensions\AdminBase;
use App\Extensions\Functions;
use App\Models\News as NewsModel;
use App\Models\EffectCusRule as EffectCusRuleModel;
use App\Models\CommissionRule as CommissionRuleModel;
use App\Models\CommissionRuleDetail as CommissionRuleDetailModel;
use App\Models\ExtraCommissionRule as ExtraCommissionRuleModel;
use App\Models\ExtraCommissionRuleDetail as ExtraCommissionRuleDetailModel;
use App\Models\RetreatRule as RetreatRuleModel;
use App\Models\RetreatRuleDetail as RetreatRuleDetailModel;
use App\Models\GameStoreType as GameStoreTypeModel;
use App\Models\GameStore as GameStoreModel;
use App\Models\GameMark as GameMarkModel;
use App\Models\Game as GameModel;
use App\Models\User as UserModel;
use App\Models\Period;
use App\Models\UserLog;

class Agent extends AdminBase
{
	public function __Construct(ContainerInterface $container)
    {
		parent::__Construct($container);
	}

	public function agentInfoManager($request, $response)
    {
		$get = $request->getQueryParams();
		$commissionRules = CommissionRuleModel::all();
		$retreatRules = RetreatRuleModel::all();
		$extraCommissionRules = ExtraCommissionRuleModel::all();

		if ($get['edit_cus_level'] == 14) {

			return $this->view->render('agent_info_manager_14', [
				"commissionRules" => $commissionRules,
				"retreatRules" => $retreatRules,
				"extraCommissionRules" => $extraCommissionRules,
			]);
		} elseif ($get['edit_cus_level'] == 15) {
			return $this->view->render('agent_info_manager_15', [
				"commissionRules" => $commissionRules,
				"retreatRules" => $retreatRules,
				"top_cus_id" => isset($get["top_cus_id"]) ? $get["top_cus_id"] : $_SESSION['id']
			]);
		}
        
	}

	public function listAgentInfos($request, $response)
    {
		$get = $request->getQueryParams();

		$edit_cus_level = intval($get['edit_cus_level']); // 14:总代理,15:代理
		$where = array();
		//$where[] = array('status',1);
		$start = 0;
		if(isset($get['start']))
			$start = intval($get['start']);
		
		$length = 0;
		if(isset($get['length']))
			$length = intval($get['length']);
		
		if ($edit_cus_level == 14) { //总代理
			$where[] = array('role', 'topagent');
			
		} else { //代理
			$where[] = array('role', 'agent');
			$where[] = array('pid', $_SESSION['id']);
		}
		

		if ($get['search_customer_userid'] != '') {
			if (isset($get['fuzzy_search']) && $get['fuzzy_search'] == 1) {
				$where[] = array('username', 'like', "%" . $get['search_customer_userid'] . "%");
			} else {
				$where[] = array('username', $get['search_customer_userid']);
			}
		}

		if ($get['search_status'] != -1) {
			$where[] = array('valid', $get['search_status']);
		}

		if ($get['search_commission_rule'] != -1) {
			$where[] = array('commission_rule_id', $get['search_commission_rule']);
		}

		if ($get['search_retreat_rule'] != -1) {
			$where[] = array('retreat_rule_id', $get['search_retreat_rule']);
		}

		if ($get['search_extra_commission_rule'] != -1) {
			$where[] = array('extra_commission_rule_id', $get['search_extra_commission_rule']);
		}

		if ($get['search_invite_code'] != '') {
			$where[] = array('invite_code', $get['search_invite_code']);
		}

		if (isset($get['top_cus_id']) && $get['top_cus_id'] != '') {
			$where[] = array('pid', $get['top_cus_id']);
		}
		
		$datas = UserModel::with('commissionRule', 'extraCommissionRule', 'retreatRule')->where($where)->skip($start)->take($length)->get();
		$result = array();
		if ($edit_cus_level == 14) { //总代理
			foreach($datas as $data){
				$name = $data->username . "<br />(" . $data->nickname . ")";
				if ($data->valid == 1) {
					$status = "<a class=\"status-btn status-open\" href=\"javascript:void(0);\">啟用</a>";
				} elseif ($data->valid == 2) {
					$status = "<a class=\"status-btn status-close\" href=\"javascript:void(0);\">停押</a>";
				} elseif ($data->valid == 3) {
					$status = "<a class=\"status-btn status-close\" href=\"javascript:void(0);\">鎖定</a>";
				} elseif ($data->valid == 4) {
					$status = "<a class=\"status-btn status-close\" href=\"javascript:void(0);\">停用</a>";
				}
				$commissionRule = $data->commissionRule ? $data->commissionRule->name : "";
				$retreatRule = $data->retreatRule ? $data->retreatRule->name : "";
				$extraCommissionRule = $data->extraCommissionRule ? $data->extraCommissionRule->name : "";

				$child_count = UserModel::where('role', 'agent')->where('pid', $data->id)->count();
				$child_count = "<a href=\"/agent/agent_info_manager?edit_cus_level=15&search_customer_userid={$data->username}&search_level=14&top_cus_id={$data->id}&edit_station_code=3&is_back=1\">{$child_count}</a>";
				//"<a href=\"agent_info_manager.php?edit_cus_level=15&search_customer_userid=jeffrey&search_level=14&top_cus_id=39&edit_station_code=3&is_back=1\">1</a>"
				$child_member_count = UserModel::where('role', 'customer')->where('pid', $data->id)->count();
				$child_member_count = "<a href=\"/agent/customer_info?edit_cus_level=16&search_customer_userid={$data->username}&search_level=14&top_cus_id={$data->id}&edit_station_code=3&is_back=1\">{$child_member_count}</a>";
				//"<a href=\"cus_info_manager.php?edit_cus_level=16&search_customer_userid=jeffrey&search_level=14&top_cus_id=39&edit_station_code=3&is_back=1\">19</a>"
				$balance = $data->balance;
				$invite_code =  "<span>{$data->invite_code}</span><br><a href='javascript:void(0);' onclick='copy_link(this);'>https://tjwww.shopdd.xyz/?invite_code={$data->invite_code}</a>";
	
				$created_at = "<div align= center>".$data->created_at."</div>";
				$action = "<a href=\"javascript:void(0);\" onclick=\"show_qr_code('https://tjwww.shopdd.xyz/?invite_code={$data->invite_code}');\" class=\"btn btn-xs default\"><i class=\"fa fa-pencil\"></i> QR code </a>\n\t\t\t\t\t\t\t\t";
				$action .= "<a href=\"/agent/agent_info_editor?etype=edit&edit_cus_id={$data->id}&edit_cus_level=14\" class=\"btn btn-xs default\"> <i class=\"fa fa-pencil\"></i> 資料 </a>\n\t\t\t\t\t\t\t\t";
				$action .= "<a href=\"cus_info_log_list?user_id={$data->id}&is_back=1\"  class=\"btn btn-xs default\"> <i class=\"fa fa-pencil\"></i> 修改歷程 </a>\n\t\t\t\t\t\t\t\t";

				$formatItem = array();
				$formatItem[] = $name;
				$formatItem[] = $status;
				$formatItem[] = $commissionRule;
				$formatItem[] = $retreatRule;
				$formatItem[] = $extraCommissionRule;
				$formatItem[] = $child_count;
				$formatItem[] = $child_member_count;
				$formatItem[] = $balance;
				$formatItem[] = $created_at;
				$formatItem[] = $invite_code;
				$formatItem[] = $action;
				$result[] = $formatItem;
			}
		} else { //代理
			foreach($datas as $data){
				$name = $data->username . "<br />(" . $data->nickname . ")";
				$parent = UserModel::where('role', 'topagent')->where('id', $data->pid)->first();
				$parent_name = $parent->username . "<br />(" . $parent->nickname . ")";
				if ($data->valid == 1) {
					$status = "<a class=\"status-btn status-open\" href=\"javascript:void(0);\">啟用</a>";
				} elseif ($data->valid == 2) {
					$status = "<a class=\"status-btn status-close\" href=\"javascript:void(0);\">停押</a>";
				} elseif ($data->valid == 3) {
					$status = "<a class=\"status-btn status-close\" href=\"javascript:void(0);\">鎖定</a>";
				} elseif ($data->valid == 4) {
					$status = "<a class=\"status-btn status-close\" href=\"javascript:void(0);\">停用</a>";
				}
				$commissionRule = $data->commissionRule ? $data->commissionRule->name : "";
				$retreatRule = $data->retreatRule ? $data->retreatRule->name : "";
				$child_member_count = UserModel::where('role', 'customer')->where('pid', $data->id)->count();
				$child_member_count = "<a href=\"/agent/customer_info?edit_cus_level=16&search_customer_userid={$data->username}&search_level=15&top_cus_id={$data->id}&edit_station_code=3&is_back=1\">{$child_member_count}</a>";
				//"<a href=\"cus_info_manager.php?edit_cus_level=16&search_customer_userid=jeffrey1&search_level=15&top_cus_id=51&edit_station_code=3&is_back=1\">1</a>"
				$balance = $data->balance;
				$invite_code =  "<span>{$data->invite_code}</span><br><a href='javascript:void(0);' onclick='copy_link(this);'>https://tjwww.shopdd.xyz/?invite_code={$data->invite_code}</a>";
	
				$created_at = "<div align= center>".$data->created_at."</div>";
				$action = "<a href=\"javascript:void(0);\" onclick=\"show_qr_code('https://tjwww.shopdd.xyz/?invite_code={$data->invite_code}');\" class=\"btn btn-xs default\"><i class=\"fa fa-pencil\"></i> QR code </a>\n\t\t\t\t\t\t\t\t";
				$action .= "<a href=\"/agent/agent_info_editor?etype=edit&edit_cus_id={$data->id}&edit_cus_level=15\" class=\"btn btn-xs default\"> <i class=\"fa fa-pencil\"></i> 資料 </a>\n\t\t\t\t\t\t\t\t";
				$action .= "<a href=\"cus_info_log_list?user_id={$data->id}&is_back=1\"  class=\"btn btn-xs default\"> <i class=\"fa fa-pencil\"></i> 修改歷程 </a>\n\t\t\t\t\t\t\t\t";

				$formatItem = array();
				$formatItem[] = $name;
				$formatItem[] = $parent_name;
				$formatItem[] = $status;
				$formatItem[] = $commissionRule;
				$formatItem[] = $retreatRule;
				$formatItem[] = $child_member_count;
				$formatItem[] = $balance;
				$formatItem[] = $created_at;
				$formatItem[] = $invite_code;
				$formatItem[] = $action;
				$result[] = $formatItem;
			}
		}
		
		
		$count = UserModel::where($where)->count();
		if($result == null)$result = [];
		$draw = 1;
		if(isset($get['draw']))
			$draw = intval($get['draw']);
		$result = Functions::listData($draw ,$count,$count,$result);
		return $response->withJson($result);
	}

	public function agentInfoEditor($request, $response)
    {
		//$post = $request->getParsedBody();
		$get = $request->getQueryParams();
		$etype = $get['etype'];
		$edit_level = $get['edit_cus_level'];
		
		
		if ($etype == 'edit') {
			//编辑
			$agent = UserModel::find(intval($get['edit_cus_id']));
			$top_cus_id = $agent->pid;
			
		} else {
			//新增
			$agent = new UserModel;
			$top_cus_id = $_SESSION['id'];
		}
		
		$commissionRules = CommissionRuleModel::all();
		$retreatRules = RetreatRuleModel::all();
		$extraCommissionRules = ExtraCommissionRuleModel::all();

        return $this->view->render('agent_info_editor', [
			'agent'=>$agent,
			'etype'=>$etype,
			'edit_level'=>$edit_level,
			'title'=>'editor',
			"commissionRules" => $commissionRules,
			"retreatRules" => $retreatRules,
			"extraCommissionRules" => $extraCommissionRules,
			"top_cus_id" => $top_cus_id,
		]);
	}

	public function saveAgentInfo($request, $response)
    {
		$get = $request->getQueryParams();
		$post = $request->getParsedBody();
		$id = $post['edit_cus_id'];
		$etype = $post['etype'];
		
		if($etype == 'edit'){
			$agent = UserModel::find($id);
			if ($post['customer_pass1'] != '') {
				if (strlen($post['customer_pass1']) < 3) {
					$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'6\', {\"target\":\"kangAgentInfoEditor\"}));page_content_mask_hide();"}]}}');
					return $response->withJson($msg);
				}
				if ($post['customer_pass1'] != $post['customer_pass2']) {
					$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'5\', {\"target\":\"kangAgentInfoEditor\"}));page_content_mask_hide();"}]}}');
					return $response->withJson($msg);
				}
				$agent->password = crypt($post['customer_pass1'], '$1$' . substr(md5($agent->username), 5, 8));
			}
		} else {
			$agent = new UserModel;
			if ($post['customer_userid'] == '') {
				$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'2\', {\"target\":\"kangAgentInfoEditor\"}));page_content_mask_hide();"}]}}');
				return $response->withJson($msg);
			}
			if (strlen($post['customer_userid']) < 2 || strlen($post['customer_userid']) > 10) {
				$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'13\', {\"target\":\"kangAgentInfoEditor\"}));page_content_mask_hide();"}]}}');
				return $response->withJson($msg);
			}
			if ($post['customer_pass1'] == '') {
				$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'3\', {\"target\":\"kangAgentInfoEditor\"}));page_content_mask_hide();"}]}}');
				return $response->withJson($msg);
			}
			if (strlen($post['customer_pass1']) < 3) {
				$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'6\', {\"target\":\"kangAgentInfoEditor\"}));page_content_mask_hide();"}]}}');
				return $response->withJson($msg);
			}
			if ($post['customer_pass1'] != $post['customer_pass2']) {
				$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'5\', {\"target\":\"kangAgentInfoEditor\"}));page_content_mask_hide();"}]}}');
				return $response->withJson($msg);
			}
			$exist = UserModel::where('username', $post['customer_userid'])->first();
			if ($exist) {
				$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'11\', {\"target\":\"kangAgentInfoEditor\"}));page_content_mask_hide();"}]}}');
				return $response->withJson($msg);
			}
			$agent->username = $post['customer_userid'];
			$agent->password = crypt($post['customer_pass1'], '$1$' . substr(md5($post['customer_userid']), 5, 8));
			$agent->level = $post['edit_cus_level'] == 14 ? 0 : 1;
			$agent->pid = $post['top_cus_id'];
			if ($post['top_cus_id']==''){
				$agent->parents = "/1/";
			}elseif ($post['top_cus_id'] == 1) {
				$agent->parents = "/1/";
			} else {
				$top_parent = UserModel::find($post['top_cus_id']);
				$agent->parents = $top_parent->parents . $post['top_cus_id'] ."/";
			}
			
			
			$agent->role = $post['edit_cus_level'] == 14 ? "topagent" : "agent";
		}
		if ($post['customer_name'] == '') {
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'7\', {\"target\":\"kangAgentInfoEditor\"}));page_content_mask_hide();"}]}}');
			return $response->withJson($msg);
		}
		
		$agent->nickname = $post['customer_name'];
		$agent->valid = $post['customer_status'];
		$agent->has_control_perm = $post['has_control_perm'];
		$agent->commission_rule_id = $post['commission_rule_id'];
		$agent->retreat_rule_id = $post['retreat_rule_id'];
		$agent->extra_commission_rule_id = $post['extra_commission_rule_id'];
		$agent->fee_percent = $post['fee_percent'];
		$agent->note = $post['notes'];
		
		$agent->save();
		if ($etype == 'add') {
			$agent->invite_code = 'tjs' . ($agent->id + 99);
			$agent->save();

			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'-1\', {\"target\":\"kangAgentInfoEditor\"}));page_content_mask_hide();"}]}}');
		} else {
			
			$userLog = new UserLog;
			$userLog->saveLog($id,1,'修改資料',$_SESSION['username'],'修改資料');
			
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'-2\', {\"m1\":\"\\u57fa\\u672c\\u8cc7\\u6599\",\"target\":\"kangAgentInfoEditor\"}));page_content_mask_hide();"}]}}');
		}
		return $response->withJson($msg);
	}

	//有效会员规则设定
	public function effectCusRuleManager($request, $response)
    {
        return $this->view->render('effect_cus_rule_manager');
	}

	public function listEffectCusRules($request, $response)
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
		
		$datas = EffectCusRuleModel::where($where)->skip($start)->take($length)->get();
		$result = array();
		foreach($datas as $data){
			$name = "<div align= center>" . $data->name . "</div>";
			$rule  = "<div align= left><div>總入金：&nbsp;&nbsp".$data->total_deposit."</div><div>總有效投注額：&nbsp;&nbsp;".$data->total_bet_real_amount."</div><div>月入金：&nbsp;&nbsp;".$data->month_deposit."</div><div>月有效投注額：&nbsp;&nbsp;".$data->month_bet_real_amount."</div></div>";
			if ($data->status == 1) {
				$status = "<div align= center><a class=\"status-btn status-open\" href=\"javascript:void(0);\">啟用</a></div>";
			} else {
				$status = "<div align= center><a class=\"status-btn status-close\" href=\"javascript:void(0);\">停用</a></div>";
			}
			$created_at = "<div align= center>".$data->created_at."</div>";
			$operator = "<div align= center>".$data->operator."</div>";
			$updated_at = "<div align= center>".$data->updated_at."</div>";
			$action = "<div align= center>\n\t\t\t\t\t\t\t\t<a href=\"javascript:void(0);\" onclick=\"request_editor_item_div('edit', '".$data->id."');\" class=\"btn btn-xs default\"> <i class=\"fa fa-pencil\"></i> 修改 </a>\n\t\t\t\t\t\t\t\t</div>";
			
			$formatItem = array();
			$formatItem[] = $name;
			$formatItem[] = $rule;
			$formatItem[] = $status;
			$formatItem[] = $created_at;
			$formatItem[] = $operator;
			$formatItem[] = $updated_at;
			$formatItem[] = $action;
			$result[] = $formatItem;
		}
		
		$count = EffectCusRuleModel::where($where)->count();
		if($result == null)$result = [];
		$draw = 1;
		if(isset($get['draw']))
			$draw = intval($get['draw']);
		$result = Functions::listData($draw ,$count,$count,$result);
		return $response->withJson($result);
	}

	public function effectCusRulesEditor($request, $response)
    {
		$post = $request->getParsedBody();
		$etype = $post['etype'];
		$id = $post['edit_effect_cus_rule_id'];

		if ($etype == 'add') {
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"#editor-item-div","rtntext":"<!--slot=2-->\n<form id=\"editor-item-form\">\n\t<table class=\"table editor-table table-bordered\">\n\t\t<thead>\n\t\t\t<tr>\n\t\t\t\t<th class=\"title\" colspan=\"100%\">\u65b0\u589e<\/th>\n\t\t\t<\/tr>\n\t\t<\/thead>\n\t\t<tbody>\n\t\t\t<tr>\n\t\t\t\t<td>\u898f\u5247\u540d\u7a31<\/td>\n\t\t\t\t<td><input type=\"text\" id=\"effect-cus-rule-name\" name=\"effect_cus_rule_name\" value=\"\"><\/td>\n\t\t\t<\/tr>\n\t\t\t<tr>\n\t\t\t\t<td>\u898f\u5247\u689d\u4ef6<\/td>\n\t\t\t\t<td><div>\u7e3d\u5165\u91d1&nbsp;&nbsp;<input type=\"text\" name=\"effect_cus_condition[total_deposit]\" value=\"0\"><\/div><div>\u7e3d\u6709\u6548\u6295\u6ce8\u984d&nbsp;&nbsp;<input type=\"text\" name=\"effect_cus_condition[total_bet_real_amount]\" value=\"0\"><\/div><div>\u6708\u5165\u91d1&nbsp;&nbsp;<input type=\"text\" name=\"effect_cus_condition[month_deposit]\" value=\"0\"><\/div><div>\u6708\u6709\u6548\u6295\u6ce8\u984d&nbsp;&nbsp;<input type=\"text\" name=\"effect_cus_condition[month_bet_real_amount]\" value=\"0\"><\/div><\/td>\n\t\t\t<\/tr>\n\t\t\t<tr>\n\t\t\t\t<td>\u72c0\u614b<\/td>\n\t\t\t\t<td>\u662f\u5426\u555f\u7528<input type=\"checkbox\" name=\"status\" value=\"1\" checked \/><\/td>\n\t\t\t<\/tr>\n\t\t\t<tr align=\"right\">\n\t\t\t\t<td colspan=\"100%\"><button type=\"button\" class=\"btn red\" onclick=\"close_layer({type: 1});\">\u53d6\u6d88<\/button><button type=\"button\" class=\"btn green\" onclick=\"save_cus_effect_cus_rule();\">\u5132\u5b58<\/button><\/td>\n\t\t\t<\/tr>\n\t\t<\/tbody>\n\t<\/table>\n\t<input type=\"hidden\" id=\"etype\" value=\"add\" \/>\n\t<input type=\"hidden\" id=\"edit-effect-cus-rule-id\" value=\"\" \/>\n<\/form>\n"},{"spanid":"javascript","rtntext":"show_editor_item_div();App.init();"}]}}');
		} else {
			$data = EffectCusRuleModel::where('id', $id)->first();
			$name = $data->name;
			$total_deposit = $data->total_deposit;
			$total_bet_real_amount = $data->total_bet_real_amount;
			$month_deposit = $data->month_deposit;
			$month_bet_real_amount = $data->month_bet_real_amount;
			$status = $data->status;
			if ($status) {
				$checked = 'checked';
			} else {
				$checked = '';
			}
			
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"#editor-item-div","rtntext":"<!--slot=2-->\n<form id=\"editor-item-form\">\n\t<table class=\"table editor-table table-bordered\">\n\t\t<thead>\n\t\t\t<tr>\n\t\t\t\t<th class=\"title\" colspan=\"100%\">\u7de8\u8f2f<\/th>\n\t\t\t<\/tr>\n\t\t<\/thead>\n\t\t<tbody>\n\t\t\t<tr>\n\t\t\t\t<td>\u898f\u5247\u540d\u7a31<\/td>\n\t\t\t\t<td><input type=\"text\" id=\"effect-cus-rule-name\" name=\"effect_cus_rule_name\" value=\"'.$name.'\"><\/td>\n\t\t\t<\/tr>\n\t\t\t<tr>\n\t\t\t\t<td>\u898f\u5247\u689d\u4ef6<\/td>\n\t\t\t\t<td><div>\u7e3d\u5165\u91d1&nbsp;&nbsp;<input type=\"text\" name=\"effect_cus_condition[total_deposit]\" value=\"'.$total_deposit.'\"><\/div><div>\u7e3d\u6709\u6548\u6295\u6ce8\u984d&nbsp;&nbsp;<input type=\"text\" name=\"effect_cus_condition[total_bet_real_amount]\" value=\"'.$total_bet_real_amount.'\"><\/div><div>\u6708\u5165\u91d1&nbsp;&nbsp;<input type=\"text\" name=\"effect_cus_condition[month_deposit]\" value=\"'.$month_deposit.'\"><\/div><div>\u6708\u6709\u6548\u6295\u6ce8\u984d&nbsp;&nbsp;<input type=\"text\" name=\"effect_cus_condition[month_bet_real_amount]\" value=\"'.$month_bet_real_amount.'\"><\/div><\/td>\n\t\t\t<\/tr>\n\t\t\t<tr>\n\t\t\t\t<td>\u72c0\u614b<\/td>\n\t\t\t\t<td>\u662f\u5426\u555f\u7528<input type=\"checkbox\" name=\"status\" value=\"1\" '.$checked.' \/><\/td>\n\t\t\t<\/tr>\n\t\t\t<tr align=\"right\">\n\t\t\t\t<td colspan=\"100%\"><button type=\"button\" class=\"btn red\" onclick=\"close_layer({type: 1});\">\u53d6\u6d88<\/button><button type=\"button\" class=\"btn green\" onclick=\"save_cus_effect_cus_rule();\">\u5132\u5b58<\/button><\/td>\n\t\t\t<\/tr>\n\t\t<\/tbody>\n\t<\/table>\n\t<input type=\"hidden\" id=\"etype\" value=\"edit\" \/>\n\t<input type=\"hidden\" id=\"edit-effect-cus-rule-id\" value=\"'.$data->id.'\" \/>\n<\/form>\n"},{"spanid":"javascript","rtntext":"show_editor_item_div();App.init();"}]}}');
		}
		return $response->withJson($msg);
	}

	public function saveEffectCusRule($request, $response)
    {
		$post = $request->getParsedBody();
		$id = $post['edit_effect_cus_rule_id'];
		
		$data = new EffectCusRuleModel;
		if($id > 0){
			$data = EffectCusRuleModel::find($id);
		}

		$data->name = $post['effect_cus_rule_name'];
		$data->total_deposit = isset($post['effect_cus_condition']['total_deposit']) ?$post['effect_cus_condition']['total_deposit']: 0;
		$data->total_bet_real_amount = isset($post['effect_cus_condition']['total_bet_real_amount']) ?$post['effect_cus_condition']['total_bet_real_amount']: 0;
		$data->month_deposit = isset($post['effect_cus_condition']['month_deposit']) ?$post['effect_cus_condition']['month_deposit']: 0;
		$data->month_bet_real_amount = isset($post['effect_cus_condition']['month_bet_real_amount']) ?$post['effect_cus_condition']['month_bet_real_amount']: 0;
		$data->status = isset($post['status']) ?: 0;
		$data->operator = $_SESSION['username'];
		$data->save();
		if($id > 0)
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"close_layer({type: 1});pop_msg(show_msg(\'-2\', {\"target\":\"kangEffectCusRule\"}));grid.getDataTable().ajax.reload();"}]}}');
		else
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"close_layer({type: 1});pop_msg(show_msg(\'-1\', {\"target\":\"kangEffectCusRule\"}));grid.getDataTable().ajax.reload();"}]}}');
		return $response->withJson($msg);
	}

	public function commissionRuleManager($request, $response)
    {
		$gameStoreTypes = GameStoreTypeModel::with('gameStores.games')->get();
		$effectCusRules = EffectCusRuleModel::all();

        return $this->view->render('commission_rule_manager', [
			"gameStoreTypes" => $gameStoreTypes,
			"effectCusRules" => $effectCusRules,
		]);
	}

	public function listCommissionRules($request, $response)
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
		
		$datas = CommissionRuleModel::with('effectCusRule')->where($where)->skip($start)->take($length)->get();
		$result = array();
		foreach($datas as $data){
			$name = $data->name;
			$effect_cus_rule_name = $data->effectCusRule->name;
			if ($data->status == 1) {
				$status = "<a class=\"status-btn status-open\" href=\"javascript:void(0);\">啟用</a>";
			} else {
				$status = "<a class=\"status-btn status-close\" href=\"javascript:void(0);\">停用</a>";
			}
			$created_at = $data->created_at;
			$operator = $data->operator;
			$updated_at = $data->updated_at;
			$action = "<a href=\"javascript:void(0);\" onclick=\"request_editor_item_div('edit', '{$data->id}');\" class=\"btn btn-xs default\"> <i class=\"fa fa-pencil\"></i> 修改 </a>";
			
			$formatItem = array();
			$formatItem[] = $name;
			$formatItem[] = $effect_cus_rule_name;
			$formatItem[] = $status;
			$formatItem[] = $created_at;
			$formatItem[] = $operator;
			$formatItem[] = $updated_at;
			$formatItem[] = $action;
			$result[] = $formatItem;
		}
		
		$count = CommissionRuleModel::where($where)->count();
		if($result == null)$result = [];
		$draw = 1;
		if(isset($get['draw']))
			$draw = intval($get['draw']);
		$result = Functions::listData($draw ,$count,$count,$result);
		return $response->withJson($result);
	}

	public function commissionRuleEditor($request, $response)
    {
		$post = $request->getParsedBody();
		$etype = $post['etype'];
		$id = $post['edit_commission_rule_id'];

		
		$data = CommissionRuleModel::with('CommissionRuleDetails.gameStores', 'effectCusRule')->where('id', $id)->first();

		return $response->withJson($data);
	}

	public function saveCommissionRule($request, $response)
    {
		$post = $request->getParsedBody();
		$id = $post['edit_commission_rule_id'];
		$etype = $post['etype'];
		$commission_condition = isset($post['commission_condition']) ?$post['commission_condition']:array();

		if ($post['commission_rule_name'] == '') {
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"close_layer({type: 1});pop_msg(show_msg(\'2\', {\"target\":\"kangCommissionRule\"}));grid.getDataTable().ajax.reload();"}]}}');
			return $response->withJson($msg);
		}
		try {
			DB::beginTransaction();

			if ($etype == 'add') {
				$data = new CommissionRuleModel;

			} else {
				$data = CommissionRuleModel::find($id);
				//先清除旧数据
				$details = CommissionRuleDetailModel::where('commission_rule_id', $data->id)->get();
				if ($details) {
					foreach ($details as $item) {
						$item->gameStores()->detach();
						$item->delete();
					}
				}
				

			}

			$data->name = $post['commission_rule_name'];
			if (isset($post['status'])) {
				$data->status = $post['status'];
			} else {
				$data->status = 0;
			}
			$data->effect_cus_rule_id = $post['effect_cus_rule_id'];
			$data->operator = $_SESSION['username'];
			$data->save();

			foreach ($commission_condition as $condition) {
				$detail = new CommissionRuleDetailModel();
				$detail->commission_rule_id = $data->id;
				$detail->lower_limit = $condition['lower_limit'];
				$detail->upper_limit = $condition['upper_limit'];
				$detail->effect_cus_num = $condition['effect_cus_num'];
				
				$detail->save();
				
				foreach ($condition as $key => $number) {
					if (strpos($key,'commission') !== false ) {
						$store_id = explode('_', $key);
						$store_id = $store_id[0];
						$detail->gameStores()->attach($store_id, ['percent' => $number]);
					}
				}
				
			}
			DB::commit();
		} catch (\Exception $ex) {
			DB::rollBack();
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"close_layer({type: 1});pop_msg(show_msg(\'1\', {\"target\":\"kangCommissionRule\"}));grid.getDataTable().ajax.reload();"}]}}');
			return $response->withJson($msg);
        }

		if($etype == 'edit')
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"close_layer({type: 1});pop_msg(show_msg(\'-2\', {\"target\":\"kangCommissionRule\"}));grid.getDataTable().ajax.reload();"}]}}');
		else
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"close_layer({type: 1});pop_msg(show_msg(\'-1\', {\"target\":\"kangCommissionRule\"}));grid.getDataTable().ajax.reload();"}]}}');
		return $response->withJson($msg);
	}

	public function retreatRuleManager($request, $response)
    {
		$gameStoreTypes = GameStoreTypeModel::with('gameStores.games')->get();
		$effectCusRules = EffectCusRuleModel::all();
		
        return $this->view->render('retreat_rule_manager', [
			"gameStoreTypes" => $gameStoreTypes,
			"effectCusRules" => $effectCusRules,
		]);
	}

	public function listRetreatRules($request, $response)
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
		
		$datas = RetreatRuleModel::with('effectCusRule')->where($where)->skip($start)->take($length)->get();
		$result = array();
		foreach($datas as $data){
			$name = $data->name;
			if ($data->effectCusRule) {
				$effect_cus_rule_name = $data->effectCusRule->name;
			} else {
				$effect_cus_rule_name = '';
			}
			if ($data->status == 1) {
				$status = "<a class=\"status-btn status-open\" href=\"javascript:void(0);\">啟用</a>";
			} else {
				$status = "<a class=\"status-btn status-close\" href=\"javascript:void(0);\">停用</a>";
			}
			$created_at = $data->created_at;
			$operator = $data->operator;
			$updated_at = $data->updated_at;
			$action = "<a href=\"javascript:void(0);\" onclick=\"request_editor_item_div('edit', '{$data->id}');\" class=\"btn btn-xs default\"> <i class=\"fa fa-pencil\"></i> 修改 </a>";
			
			$formatItem = array();
			$formatItem[] = $name;
			$formatItem[] = $effect_cus_rule_name;
			$formatItem[] = $status;
			$formatItem[] = $created_at;
			$formatItem[] = $operator;
			$formatItem[] = $updated_at;
			$formatItem[] = $action;
			$result[] = $formatItem;
		}
		
		$count = RetreatRuleModel::where($where)->count();
		if($result == null)$result = [];
		$draw = 1;
		if(isset($get['draw']))
			$draw = intval($get['draw']);
		$result = Functions::listData($draw ,$count,$count,$result);
		return $response->withJson($result);
	}

	public function retreatRuleEditor($request, $response)
    {
		$post = $request->getParsedBody();
		$etype = $post['etype'];
		$id = $post['edit_retreat_rule_id'];

		
		$data = RetreatRuleModel::with('RetreatRuleDetails.gameStores', 'effectCusRule', 'gameStores')->where('id', $id)->first();

		return $response->withJson($data);
	}

	public function saveRetreatRule($request, $response)
    {
		$post = $request->getParsedBody();
		$id = $post['edit_retreat_rule_id'];
		$etype = $post['etype'];
		$retreat_condition = isset($post['retreat_condition']) ?$post['retreat_condition']:array();

		if ($post['retreat_rule_name'] == '') {
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"close_layer({type: 1});pop_msg(show_msg(\'2\', {\"target\":\"kangRetreatRule\"}));grid.getDataTable().ajax.reload();"}]}}');
			return $response->withJson($msg);
		}
		try {
			DB::beginTransaction();

			if ($etype == 'add') {
				$data = new RetreatRuleModel;

			} else {
				$data = RetreatRuleModel::find($id);
				//先清除旧数据
				$data->gameStores()->detach();
				$details = RetreatRuleDetailModel::where('retreat_rule_id', $data->id)->get();
				if ($details) {
					foreach ($details as $item) {
						$item->gameStores()->detach();
						$item->delete();
					}
				}
				

			}

			$data->name = $post['retreat_rule_name'];
			if (isset($post['status'])) {
				$data->status = $post['status'];
			} else {
				$data->status = 0;
			}
			$data->effect_cus_rule_id = $post['effect_cus_rule_id'];
			$data->operator = $_SESSION['username'];
			$data->save();

			//無需被計算區間(
			foreach ($retreat_condition['is_not_calc'] as $key => $check) {
				$data->gameStores()->attach($key);
			}

			foreach ($retreat_condition as $key => $condition) {
				if ($key == 'is_not_calc') {
					continue;
				}
				$detail = new RetreatRuleDetailModel();
				$detail->retreat_rule_id = $data->id;
				$detail->lower_limit = $condition['lower_limit'];
				$detail->upper_limit = $condition['upper_limit'];
				$detail->effect_cus_num = $condition['effect_cus_num'];
				
				$detail->save();
				
				foreach ($condition as $key => $number) {
					if (strpos($key,'retreat') !== false ) {
						$store_id = explode('_', $key);
						$store_id = $store_id[0];
						$detail->gameStores()->attach($store_id, ['percent' => $number]);
					}
				}
				
			}
			DB::commit();
		} catch (\Exception $ex) {
			DB::rollBack();
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"close_layer({type: 1});pop_msg(show_msg(\'1\', {\"target\":\"kangRetreatRule\"}));grid.getDataTable().ajax.reload();"}]}}');
			return $response->withJson($msg);
        }

		if($etype == 'edit')
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"close_layer({type: 1});pop_msg(show_msg(\'-2\', {\"target\":\"kangRetreatRule\"}));grid.getDataTable().ajax.reload();"}]}}');
		else
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"close_layer({type: 1});pop_msg(show_msg(\'-1\', {\"target\":\"kangRetreatRule\"}));grid.getDataTable().ajax.reload();"}]}}');
		return $response->withJson($msg);
	}

	public function extraCommissionRuleManager($request, $response)
    {
		$gameStoreTypes = GameStoreTypeModel::with('gameStores.games')->get();
		
        return $this->view->render('extra_commission_rule_manager', [
			"gameStoreTypes" => $gameStoreTypes,
		]);
	}

	public function listExtraCommissionRules($request, $response)
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
		
		$datas = ExtraCommissionRuleModel::where($where)->skip($start)->take($length)->get();
		$result = array();
		foreach($datas as $data){
			$name = $data->name;
			if ($data->status == 1) {
				$status = "<a class=\"status-btn status-open\" href=\"javascript:void(0);\">啟用</a>";
			} else {
				$status = "<a class=\"status-btn status-close\" href=\"javascript:void(0);\">停用</a>";
			}
			$created_at = $data->created_at;
			$operator = $data->operator;
			$updated_at = $data->updated_at;
			$action = "<a href=\"javascript:void(0);\" onclick=\"request_editor_item_div('edit', '{$data->id}');\" class=\"btn btn-xs default\"> <i class=\"fa fa-pencil\"></i> 修改 </a>";
			
			$formatItem = array();
			$formatItem[] = $name;
			$formatItem[] = $status;
			$formatItem[] = $created_at;
			$formatItem[] = $operator;
			$formatItem[] = $updated_at;
			$formatItem[] = $action;
			$result[] = $formatItem;
		}
		
		$count = ExtraCommissionRuleModel::where($where)->count();
		if($result == null)$result = [];
		$draw = 1;
		if(isset($get['draw']))
			$draw = intval($get['draw']);
		$result = Functions::listData($draw ,$count,$count,$result);
		return $response->withJson($result);
	}

	public function extraCommissionRuleEditor($request, $response)
    {
		$post = $request->getParsedBody();
		$etype = $post['etype'];
		$id = $post['edit_extra_commission_rule_id'];

		
		$data = ExtraCommissionRuleModel::with('extraCommissionRuleDetails.gameStores')->where('id', $id)->first();

		return $response->withJson($data);
	}

	public function saveExtraCommissionRule($request, $response)
    {
		$post = $request->getParsedBody();
		$id = $post['edit_extra_commission_rule_id'];
		$etype = $post['etype'];
		$extra_commission_condition = isset($post['extra_commission_condition']) ?$post['extra_commission_condition']:array();

		if ($post['extra_commission_rule_name'] == '') {
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"close_layer({type: 1});pop_msg(show_msg(\'2\', {\"target\":\"kangExtraCommissionRule\"}));grid.getDataTable().ajax.reload();"}]}}');
			return $response->withJson($msg);
		}
		try {
			DB::beginTransaction();

			if ($etype == 'add') {
				$data = new ExtraCommissionRuleModel;

			} else {
				$data = ExtraCommissionRuleModel::find($id);
				//先清除旧数据
				$details = ExtraCommissionRuleDetailModel::where('extra_commission_rule_id', $data->id)->get();
				if ($details) {
					foreach ($details as $item) {
						$item->gameStores()->detach();
						$item->delete();
					}
				}
				

			}

			$data->name = $post['extra_commission_rule_name'];
			if (isset($post['status'])) {
				$data->status = $post['status'];
			} else {
				$data->status = 0;
			}
			$data->operator = $_SESSION['username'];
			$data->save();

			foreach ($extra_commission_condition as $condition) {
				$detail = new ExtraCommissionRuleDetailModel();
				$detail->extra_commission_rule_id = $data->id;
				$detail->lower_limit = $condition['lower_limit'];
				$detail->upper_limit = $condition['upper_limit'];
				$detail->save();
				
				foreach ($condition as $key => $number) {
					if (strpos($key,'extra_commission') !== false ) {
						$store_id = explode('_', $key);
						$store_id = $store_id[0];
						$detail->gameStores()->attach($store_id, ['percent' => $number]);
					}
				}
				
			}
			DB::commit();
		} catch (\Exception $ex) {
			DB::rollBack();
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"close_layer({type: 1});pop_msg(show_msg(\'1\', {\"target\":\"kangExtraCommissionRule\"}));grid.getDataTable().ajax.reload();"}]}}');
			return $response->withJson($msg);
        }

		if($etype == 'edit')
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"close_layer({type: 1});pop_msg(show_msg(\'-2\', {\"target\":\"kangExtraCommissionRule\"}));grid.getDataTable().ajax.reload();"}]}}');
		else
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"close_layer({type: 1});pop_msg(show_msg(\'-1\', {\"target\":\"kangExtraCommissionRule\"}));grid.getDataTable().ajax.reload();"}]}}');
		return $response->withJson($msg);
	}

	public function periodManager($request, $response)
    {
		$cr = CommissionRuleModel::where('period_id', 0)->get();
		$ecr = ExtraCommissionRuleModel::where('period_id', 0)->get();
		$rr = RetreatRuleModel::where('period_id', 0)->get();
        return $this->view->render('period_manager', [
			'cr' => $cr,
			'ecr' => $ecr,
			'rr' => $rr,
		]);
	}

	public function periodEditor($request, $response)
    {
		$get = $request->getQueryParams();
		$ckout_items = array();
		if ($get['etype'] == 'edit') {
			$data = Period::find($get['edit_period_id']);
			if ($data->ckout_item == 1) {
				$ckout_items = CommissionRuleModel::where('period_id', $data->id)->pluck('id')->toArray();
			} elseif ($data->ckout_item == 2) {
				$ckout_items = RetreatRuleModel::where('period_id', $data->id)->pluck('id')->toArray();
			} elseif ($data->ckout_item == 3) {
				$ckout_items = ExtraCommissionRuleModel::where('period_id', $data->id)->pluck('id')->toArray();
			} 
		} else {
			$data = new Period();
		}

		$cr = CommissionRuleModel::whereIn('period_id', [0, $data->id])->get();
		$ecr = ExtraCommissionRuleModel::whereIn('period_id', [0, $data->id])->get();
		$rr = RetreatRuleModel::whereIn('period_id', [0, $data->id])->get();
        return $this->view->render('period_editor', [
			'data' => $data,
			'ckout_items' => $ckout_items,
			'etype' => $get['etype'],
			'cr' => $cr,
			'ecr' => $ecr,
			'rr' => $rr,
		]);
	}

	public function listPeriods($request, $response)
    {
        $get = $request->getQueryParams();

		$where = array();
		if (isset($get['search_period_name']) && $get['search_period_name'] != '') {
			$where[] = array('name', $get['search_period_name']);
		}
		if (isset($get['search_ckout_type']) && $get['search_ckout_type'] != -1) {
			$where[] = array('ckout_type', $get['search_ckout_type']);
		}
		if (isset($get['search_ckout_item']) && $get['search_ckout_item'] != -1) {
			$where[] = array('ckout_item', $get['search_ckout_item']);
		}
		
		$datas = Period::where($where)->get();
		
		$result = array();
		foreach($datas as $data){
			$name = $data->name;
			$ckout_item = Period::getCkoutItemName($data->ckout_item);
			$ckout_type = Period::getCkoutTypeName($data->ckout_type);
			if ($data->ckout_type == 3) {
				$start_date = $data->start_date;
				$end_date = $data->end_date;
			} else {
				$start_date = '';
				$end_date = '';
			}
			
			$min_payment_amount = $data->min_payment_amount;
			$action =  "<a href=\"/admin/period_editor?edit_period_id={$data->id}&etype=edit\" class=\"btn btn-xs default\"> <i class=\"fa fa-pencil\"></i> 設定 </a>";
			
			
			$formatItem = array();
			$formatItem[] = $name;
			$formatItem[] = $ckout_item;
			$formatItem[] = $ckout_type;
			$formatItem[] = $start_date;
			$formatItem[] = $end_date;
			$formatItem[] = $min_payment_amount;
			$formatItem[] = $action;
			$result[] = $formatItem;
		}
		
		$count = Period::where($where)->count();
		if($result == null)$result = [];
		$draw = 1;
		if(isset($get['draw']))
			$draw = intval($get['draw']);
		$result = Functions::listData($draw ,$count,$count,$result);
		return $response->withJson($result);
	}

	public function savePeriod($request, $response)
    {
		$get = $request->getQueryParams();
		$post = $request->getParsedBody();
		$id = $post['edit_period_id'];
		$etype = $post['etype'];
		if ($post['period_name'] == '') {
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"alert(show_msg(\'2\', {\"target\":\"kangPeriodEditor\"}));"}]}}');
			return $response->withJson($msg);
		}
		if ($post['ckout_item'] == 0) {
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"alert(show_msg(\'3\', {\"target\":\"kangPeriodEditor\"}));"}]}}');
			return $response->withJson($msg);
		}
		if ($post['ckout_type'] == 0) {
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"alert(show_msg(\'4\', {\"target\":\"kangPeriodEditor\"}));"}]}}');
			return $response->withJson($msg);
		}
		
		try {
			DB::beginTransaction();
			$data = new Period;
			if($etype == 'edit'){
				$data = Period::find($id);
			}
			$data->name = $post['period_name'];
			$data->ckout_item = $post['ckout_item'];
			$data->ckout_type = $post['ckout_type'];
			if ($data->ckout_type == 3) {
				$data->start_date = $post['start_date'] .' ' .$post['start_time'];
				$data->end_date = $post['end_date'] .' '.$post['end_time'];
			}
			
			$data->min_payment_amount = $post['min_payment_amount'];
			$data->operator = $_SESSION['username'];
			$data->save();
			
			if($etype == 'edit') {
				//先把套用规则都清除 再加上
				CommissionRuleModel::where('period_id', $data->id)->update(['period_id'=>0]);
				ExtraCommissionRuleModel::where('period_id', $data->id)->update(['period_id'=>0]);
				RetreatRuleModel::where('period_id', $data->id)->update(['period_id'=>0]);
			}
			if ($data->ckout_item == 1) {
				if (!isset($post['commission_rule_id_arr'])) {
					DB::rollBack();
					$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"alert(show_msg(\'5\', {\"target\":\"kangPeriodEditor\"}));"}]}}');
					return $response->withJson($msg);
				}
				CommissionRuleModel::whereIn('id', $post['commission_rule_id_arr'])->update(['period_id'=> $data->id]);
			} elseif ($data->ckout_item == 2) {
				if (!isset($post['retreat_rule_id_arr'])) {
					DB::rollBack();
					$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"alert(show_msg(\'5\', {\"target\":\"kangPeriodEditor\"}));"}]}}');
					return $response->withJson($msg);
				}
				RetreatRuleModel::whereIn('id', $post['retreat_rule_id_arr'])->update(['period_id'=> $data->id]);
			} elseif ($data->ckout_item == 3) {
				if (!isset($post['extra_commission_rule_id_arr'])) {
					DB::rollBack();
					$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"alert(show_msg(\'5\', {\"target\":\"kangPeriodEditor\"}));"}]}}');
					return $response->withJson($msg);
				}
				ExtraCommissionRuleModel::whereIn('id', $post['extra_commission_rule_id_arr'])->update(['period_id'=> $data->id]);
			}
			DB::commit();
		} catch (\Exception $ex) {
			DB::rollBack();
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"alert(show_msg(\'1\', {\"target\":\"kangPeriodEditor\"}));location.href=location.href"}]}}');

			return $response->withJson($msg);
        }
		
		if($etype == 'edit')
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"alert(show_msg(\'-2\', {\"target\":\"kangPeriodEditor\"}));location.href=location.href"}]}}');
		else
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"alert(show_msg(\'-1\', {\"target\":\"kangPeriodEditor\"}));location.href=location.href"}]}}');
		return $response->withJson($msg);
	}

	public function periodAuditManager($request, $response)
    {
        return $this->view->render('period_audit_manager');
	}
 
}
