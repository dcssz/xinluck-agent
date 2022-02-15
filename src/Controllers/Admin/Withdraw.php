<?php
namespace App\Controllers\Admin;

use Illuminate\Database\Capsule\Manager as DB;
use stdClass;
use Interop\Container\ContainerInterface;
use App\Extensions\AdminBase;
use App\Extensions\Functions;
use App\Models\Withdraw as WithdrawModel;
use App\Models\User;
use App\Models\WithdrawAudit;

class Withdraw extends AdminBase
{
	public function __Construct(ContainerInterface $container)
    {
		parent::__Construct($container);
	}
 
	public function memWithdrawOrdersManager($request, $response)
    {
        return $this->view->render('mem_withdraw_orders_manager');
	}

	public function memWithdrawOrdersOp($request, $response)
	{
		$get = $request->getQueryParams();
		$post = $request->getParsedBody();
		$pdisplay = $get['pdisplay'];

		if ($pdisplay == 'display_manager_list') {
			$where = array();
			$start = 0;
			if(isset($get['start']))
				$start = intval($get['start']);
			
			$length = 10;
			if(isset($get['length']))
				$length = intval($get['length']);
			
			
			$search_customer_userid = isset($get['search_customer_userid'])?$get['search_customer_userid']:'';
			$fuzzy_search = isset($get['fuzzy_search'])?$get['fuzzy_search']:0;
			$search_status = isset($get['search_status'])?$get['search_status']:-1;
			$search_order_no = isset($get['search_order_no'])?$get['search_order_no']:'';
			$start_date = $get['search_start_date'] . ' ' . $get['search_start_time'];
			$end_date = $get['search_end_date'] . ' ' . $get['search_end_time'];

			$where[] = array('apply_time', '>=', $start_date);
			$where[] = array('apply_time', '<=', $end_date);
			
			if($fuzzy_search == 1)
				$where[] = array('name','like','%'.$search_customer_userid.'%');
			else if(!empty($search_customer_userid))
				$where[] = array('name',$search_customer_userid);
			
			if($search_status != -1)
				$where[] = array('status',$search_status);
			if ($search_order_no != '') {
				$where[] = array('trans_no',$search_order_no);
			}
			
			$datas = WithdrawModel::with('user', 'userBank')->where($where)->skip($start)->take($length)->orderBy('id', 'desc')->get();
			$count = WithdrawModel::where($where)->count();
			
			$result = array();
			foreach($datas as $data){
				$trans_no = $data->trans_no;
				$user = User::find($data->user_id);
				$parent = User::whereIn('role', ['agent', 'topagent'])->where('id', $user->pid)->first();
				$parent_name = $parent->username;
				$name = "<span class=\"pd-5\" style=\"background-color: \">{$user->username}</span>";
				$nickname = $user->nickname;
				$bank = "<div align='left'>戶名 : {$data->userBank->account_name}<br/>帳號 : {$data->userBank->bank_account}<br/>銀行名稱 : {$data->userBank->bank_name}<br/>開戶行 : {$data->userBank->bank_branch}</div>";
				$amount = $data->amount;
				$fee = $data->fee;
				$admin_fee = $data->admin_fee;
				$actual_amount = $data->actual_amount;

				if ($data->status == -100) {
					$status = "<span class=\"red-txt\">處理中</span>";
				} elseif ($data->status == 1) {
					$status = "<span class=\"red-txt\">未出款</span>";
				} elseif ($data->status == 2) {
					$status = "<span class=\"red-txt\">取消</span>";
				} elseif ($data->status == 100) {
					$status = "<span class=\"green-txt\">已出款</span>";
				}
				$apply_time = $data->apply_time;
				$note = $data->note;
				$updated_at = $data->updated_at."";
				$action = '';

				$formatItem = array();
				$formatItem[] = $trans_no;
				$formatItem[] = $parent_name;
				$formatItem[] = $name;
				$formatItem[] = $nickname;
				$formatItem[] = $bank;
				$formatItem[] = $amount;
				$formatItem[] = $fee;
				$formatItem[] = $admin_fee;
				$formatItem[] = $actual_amount;
				$formatItem[] = $status;
				$formatItem[] = $apply_time;
				$formatItem[] = $updated_at;
				$formatItem[] = $note;
				$formatItem[] = $action;
				$result[] = $formatItem;
			}
			
			
			if($result == null)$result = [];
			$draw = 1;
			if(isset($get['draw']))
				$draw = intval($get['draw']);
			$result = Functions::listData($draw ,$count,$count,$result);
			return $response->withJson($result); 
		} 
	}

	public function agentWithdrawOrdersManager($request, $response)
    {
        return $this->view->render('agent_withdraw_orders_manager');
	}

	public function cusWithdrawAuditManager($request, $response)
    {
		$get = $request->getQueryParams();
		$search_customer_userid = isset($get['search_customer_userid']) ? $get['search_customer_userid'] : '';

        return $this->view->render('cus_withdraw_audit_manager', [
			"search_customer_userid" => $search_customer_userid
		]);
	}

	public function listWithdrawAudits($request, $response)
    {
		$get = $request->getQueryParams();

		$where = array();
		//$where[] = array('status',1);
		$start = 0;
		if(isset($get['start']))
			$start = intval($get['start']);
		
		$length = 10;
		if(isset($get['length']))
			$length = intval($get['length']);
		
		 
		$search_customer_userid = isset($get['search_customer_userid'])?$get['search_customer_userid']:'';
		$fuzzy_search = isset($get['fuzzy_search'])?$get['fuzzy_search']:0;
		$search_is_finished = isset($get['search_is_finished'])?$get['search_is_finished']:-1;
		
		 
		$query = WithdrawAudit::with('user')->whereHas('user',function($query) use ($search_customer_userid,$fuzzy_search,$search_is_finished){
			$selfWhere = array();
			if($fuzzy_search == 1)
				$selfWhere[] = array('username','like','%'.$search_customer_userid.'%');
			else if(!empty($search_customer_userid))
				$selfWhere[] = array('username',$search_customer_userid);
			
			if($search_is_finished != -1)
				$selfWhere[] = array('status',$search_is_finished);
			
			return  $query->where($selfWhere);
		})->where($where);
		//echo $query->toSql();
		$datas = $query->skip($start)->take($length)->orderBy('id', 'desc')->get();
		
		$count = $query->count();
		
		$result = array();
		foreach($datas as $data){
			$name = "<span class=\"pd-5\" style=\"background-color: \">{$data->user->username}</span>";
			$type = WithdrawAudit::getType($data->type);
			$note = $data->note;
			$deposit_amount = $data->deposit_amount;
			$discount_amount = $data->discount_amount;
			$beishu = $data->beishu;
			if ($data->is_audit == 1) {
				$liushui = "<span class=\"red-txt\">{$data->liushui}<span>";
			} else {
				$liushui = "<span class=\"green-txt\">0<span>";
			}
			$created_at = $data->created_at."";

			$status = '其他';
			if ($data->status == 0) {
				$status = "<span class=\"red-txt\">未取款</span>";
				if ($data->is_audit == 1) {
					$action = "<a href=\"javascript:void(0);\" onclick=\"change_is_audit('{$data->id}', 0);\" class=\"btn btn-xs default btn-red\"> <i class=\"fa fa-trash-o\"></i> 清空稽核 </a>";
				} else {
					$action = "<a href=\"javascript:void(0);\" onclick=\"change_is_audit('{$data->id}', 1);\" class=\"btn btn-xs default btn-green\"> <i class=\"fa fa-trash-o\"></i> 恢復稽核  </a>";
				}
			} elseif ($data->status == 1) {
				$status = "<span class=\"pink-txt\">取款申請中</span>";
				$action = '';
			} elseif ($data->status == 2) {
				$status = "<span class=\"green-txt\">已取款</span>";
				$action = '';
			}  

		 
	
			$formatItem = array();
			$formatItem[] = $name;
			$formatItem[] = $type;
			$formatItem[] = $note;
			$formatItem[] = $deposit_amount;
			$formatItem[] = $discount_amount;
			$formatItem[] = $beishu;
			$formatItem[] = $liushui;
			$formatItem[] = $created_at;
			$formatItem[] = $status;
		 
			$formatItem[] = $action;
			$result[] = $formatItem;
		}
		
		
		if($result == null)$result = [];
		$draw = 1;
		if(isset($get['draw']))
			$draw = intval($get['draw']);
		$result = Functions::listData($draw ,$count,$count,$result);
		return $response->withJson($result);
	}

	public function withdrawAuditOp($request, $response)
	{
		$get = $request->getQueryParams();
		$post = $request->getParsedBody();
		$pdisplay = $get['pdisplay'];

		if ($pdisplay == 'change_is_audit') {
			$edit_is_audit = $post['edit_is_audit'];
			$edit_audit_id = $post['edit_audit_id'];
			$model = WithdrawAudit::find($edit_audit_id);
			$model->is_audit = $edit_is_audit;
			$model->save();

			echo '{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"close_layer({type: 1});pop_msg(show_msg(\'-1\', {\"target\":\"kangCusWithdrawAudit\"}));grid.getDataTable().ajax.reload();show_title_info_content();"}]}}'; 
		} elseif ($pdisplay == 'show_title_info_content') {

			if ($post['search_customer_userid'] == '') {
				echo '{"root":{"ajaxdata":[{"spanid":"#title-info-content","rtntext":"<span class=\"title-class\">\u641c\u5c0b\u5e33\u865f\u53ef\u67e5\u770b\u7a3d\u6838\u72c0\u6cc1!<\/span>"},{"spanid":"#show-info-div","rtntext":"<!--slot=2-->\n<table id=\"bet-real-amount-detail-info\" class=\"bet-real-amount-detail-info\">\n    <tr>\n        <td class=\"title2\">\u5ee0\u5546\u540d\u7a31<\/td>\n        <td class=\"title2\">\u6d41\u6c34\u9700\u6c42<\/td>\n        <td class=\"title2\">\u6709\u6548\u6295\u6ce8<\/td>\n    <\/tr>\n    \n    <tr>\n        <td class=\"title2\">\u7e3d\u8a08<\/td>\n        <td><\/td>\n        <td><\/td>\n    <\/tr>\n    \n    <tr align=\"right\">\n        <td colspan=\"100%\"><button type=\"button\" class=\"btn red\" onclick=\"close_layer({type: 1});\">\u95dc\u9589<\/button><\/td>\n    <\/tr>\n<\/table>\n"}]}}'; 
			} else {
				$user = User::where('username', $post['search_customer_userid'])->first();
				if ($user) {
					$total_liushui = WithdrawAudit::where('user_id', $user->id)->whereIn('status', [0,1])->where('is_audit', 1)->sum('liushui');
					$amount = $user->dama;
					$need = ($total_liushui - $amount) < 0? 0 : $total_liushui - $amount;
					echo '{"root":{"ajaxdata":[{"spanid":"#title-info-content","rtntext":"<span class=\"title-class\">\u6703\u54e1\u5e33\u865f:'.$user->username.'&nbsp;\uff5c&nbsp;<span class=\"red-txt\">\u672a\u53d6\u6b3e<\/span> & <span class=\"pink-txt\">\u53d6\u6b3e\u7533\u8acb\u4e2d<\/span>&nbsp;\uff5c&nbsp;\u7e3d\u6d41\u6c34\u8981\u6c42:'.$total_liushui.'&nbsp;\uff5c&nbsp;\u9084\u9700\u6253\u78bc\u91cf:'.$need.'&nbsp;\uff5c&nbsp;\u76ee\u524d\u6253\u78bc\u91cf:'.$amount.'&nbsp;\uff5c&nbsp;<a onclick=\'show_info_div();\'>\u5ee0\u5546\u6709\u6548\u984d<\/a>&nbsp;\uff5c&nbsp;<a onclick=\'request_editor_item_div(\"340\");\'>\u6e05\u7a7a\u6253\u78bc\u91cf<\/a><\/span>"},{"spanid":"#show-info-div","rtntext":"<!--slot=2-->\n<table id=\"bet-real-amount-detail-info\" class=\"bet-real-amount-detail-info\">\n    <tr>\n        <td class=\"title2\">\u5ee0\u5546\u540d\u7a31<\/td>\n        <td class=\"title2\">\u6d41\u6c34\u9700\u6c42<\/td>\n        <td class=\"title2\">\u6709\u6548\u6295\u6ce8<\/td>\n    <\/tr>\n    \n    <tr>\n        <td class=\"title\">\u5354\u548c\u9ad4\u80b2<\/td>\n        <td>0<\/td>\n        <td>0<\/td>\n    <\/tr>\n    \n    <tr>\n        <td class=\"title\">\u6b50\u535a\u771f\u4eba<\/td>\n        <td>0<\/td>\n        <td>0<\/td>\n    <\/tr>\n    \n    <tr>\n        <td class=\"title\">\u6c99\u9f8d\u771f\u4eba<\/td>\n        <td>0<\/td>\n        <td>0<\/td>\n    <\/tr>\n    \n    <tr>\n        <td class=\"title\">WM\u771f\u4eba<\/td>\n        <td>0<\/td>\n        <td>0<\/td>\n    <\/tr>\n    \n    <tr>\n        <td class=\"title\">BTS\u68cb\u724c<\/td>\n        <td>0<\/td>\n        <td>0<\/td>\n    <\/tr>\n    \n    <tr>\n        <td class=\"title\">BL\u68cb\u724c<\/td>\n        <td>0<\/td>\n        <td>0<\/td>\n    <\/tr>\n    \n    <tr>\n        <td class=\"title\">TF\u96fb\u7af6<\/td>\n        <td>0<\/td>\n        <td>0<\/td>\n    <\/tr>\n    \n    <tr>\n        <td class=\"title\">\u5927\u7acb\u5f69\u7968<\/td>\n        <td>0<\/td>\n        <td>0<\/td>\n    <\/tr>\n    \n    <tr>\n        <td class=\"title\">ZG\u96fb\u5b50<\/td>\n        <td>0<\/td>\n        <td>0<\/td>\n    <\/tr>\n    \n    <tr>\n        <td class=\"title\">\u7687\u5bb6\u96fb\u5b50<\/td>\n        <td>0<\/td>\n        <td>0<\/td>\n    <\/tr>\n    \n    <tr>\n        <td class=\"title\">\u8f49\u8f49\u6a02<\/td>\n        <td>0<\/td>\n        <td>0<\/td>\n    <\/tr>\n    \n    <tr>\n        <td class=\"title\">\u7687\u5bb6\u771f\u4eba<\/td>\n        <td>0<\/td>\n        <td>0<\/td>\n    <\/tr>\n    \n    <tr>\n        <td class=\"title\">BNG\u96fb\u5b50<\/td>\n        <td>0<\/td>\n        <td>0<\/td>\n    <\/tr>\n    \n    <tr>\n        <td class=\"title\">VA\u96fb\u5b50<\/td>\n        <td>0<\/td>\n        <td>0<\/td>\n    <\/tr>\n    \n    <tr>\n        <td class=\"title\">Super\u9ad4\u80b2<\/td>\n        <td>0<\/td>\n        <td>0<\/td>\n    <\/tr>\n    \n    <tr>\n        <td class=\"title\">DG\u771f\u4eba<\/td>\n        <td>0<\/td>\n        <td>0<\/td>\n    <\/tr>\n    \n    <tr>\n        <td class=\"title\">\u946b\u5bf6\u9ad4\u80b2<\/td>\n        <td>0<\/td>\n        <td>0<\/td>\n    <\/tr>\n    \n    <tr>\n        <td class=\"title2\">\u7e3d\u8a08<\/td>\n        <td>0<\/td>\n        <td>0<\/td>\n    <\/tr>\n    \n    <tr align=\"right\">\n        <td colspan=\"100%\"><button type=\"button\" class=\"btn red\" onclick=\"close_layer({type: 1});\">\u95dc\u9589<\/button><\/td>\n    <\/tr>\n<\/table>\n"}]}}';
				} else {
					echo '{"root":{"ajaxdata":[{"spanid":"#title-info-content","rtntext":"<span class=\"title-class\"><\/span>"},{"spanid":"#show-info-div","rtntext":"<!--slot=2-->\n<table id=\"bet-real-amount-detail-info\" class=\"bet-real-amount-detail-info\">\n    <tr>\n        <td class=\"title2\">\u5ee0\u5546\u540d\u7a31<\/td>\n        <td class=\"title2\">\u6d41\u6c34\u9700\u6c42<\/td>\n        <td class=\"title2\">\u6709\u6548\u6295\u6ce8<\/td>\n    <\/tr>\n    \n    <tr>\n        <td class=\"title2\">\u7e3d\u8a08<\/td>\n        <td><\/td>\n        <td><\/td>\n    <\/tr>\n    \n    <tr align=\"right\">\n        <td colspan=\"100%\"><button type=\"button\" class=\"btn red\" onclick=\"close_layer({type: 1});\">\u95dc\u9589<\/button><\/td>\n    <\/tr>\n<\/table>\n"}]}}';
				}
			}
		}
	}
}
