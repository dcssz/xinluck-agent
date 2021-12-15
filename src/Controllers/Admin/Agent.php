<?php
namespace App\Controllers\Admin;

use Illuminate\Database\Capsule\Manager as DB;
use stdClass;
use Interop\Container\ContainerInterface;
use App\Extensions\AdminBase;
use App\Extensions\Functions;
use App\Models\News as NewsModel;
use App\Models\EffectCusRule as EffectCusRuleModel;
class Agent extends AdminBase
{
	public function __Construct(ContainerInterface $container)
    {
		parent::__Construct($container);
	}

	public function agentInfoManager($request, $response)
    {
		$get = $request->getQueryParams();
		if ($get['edit_cus_level'] == 14) {
			return $this->view->render('agent_info_manager_14');
		} elseif ($get['edit_cus_level'] == 15) {
			return $this->view->render('agent_info_manager_15');
		}
        
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

	public function saveEffectCusRules($request, $response)
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
		$data->operator = 'admin';
		$data->save();
		if($id > 0)
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"close_layer({type: 1});pop_msg(show_msg(\'-2\', {\"target\":\"kangEffectCusRule\"}));grid.getDataTable().ajax.reload();"}]}}');
		else
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"close_layer({type: 1});pop_msg(show_msg(\'-1\', {\"target\":\"kangEffectCusRule\"}));grid.getDataTable().ajax.reload();"}]}}');
		return $response->withJson($msg);
	}

	public function commissionRuleManager($request, $response)
    {
        return $this->view->render('commission_rule_manager');
	}

	public function retreatRuleManager($request, $response)
    {
        return $this->view->render('retreat_rule_manager');
	}

	public function extraCommissionRuleManager($request, $response)
    {
        return $this->view->render('extra_commission_rule_manager');
	}

	public function periodManager($request, $response)
    {
        return $this->view->render('period_manager');
	}

	public function periodAuditManager($request, $response)
    {
        return $this->view->render('period_audit_manager');
	}
 
}
