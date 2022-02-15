<?php
namespace App\Controllers\Admin;

use Illuminate\Database\Capsule\Manager as DB;
use stdClass;
use Interop\Container\ContainerInterface;
use App\Extensions\AdminBase;
use App\Extensions\Functions;
use App\Models\SiteMessage as SiteMessageModel;
use App\Models\User;

class SiteMsg extends AdminBase
{
	public function __Construct(ContainerInterface $container)
    {
		parent::__Construct($container);
	}

	public function listSiteMsg($request, $response)
    {
		$get = $request->getQueryParams();
		// return $response->withJson($get);
		$where = array();
		//$where[] = array('status',1);
		if(isset($get['select_status']) &&  $get['select_status'] != '-1' )
			$where[] = array('status',$get['select_status']);
		if(isset($get['select_site_msg_target']) &&  $get['select_site_msg_target'] != '-1' )
			$where[] = array('target',$get['select_site_msg_target']);
		$start = 0;
		if(isset($get['start']))
			$start = intval($get['start']);
		
		$length = 0;
		if(isset($get['length']))
			$length = intval($get['length']);
		
		$siteMessages = SiteMessageModel::where($where)->skip($start)->take($length)->orderBy('id', 'DESC')->get();
		// return $response->withJson($siteMessages);
		$result = array();
		foreach($siteMessages as $siteMessage){
			if($siteMessage->target === 3)
				$siteMessage->target = _('所有會員');
			elseif($siteMessage->target === 1)
				$siteMessage->target =  _('指定數個会员');		
			elseif($siteMessage->target === 2)
				$siteMessage->target =  _('指定会员等級');
			else
				$siteMessage->target =  $siteMessage->target;

			if ($siteMessage->status === 0) {
				$siteMessage->status='<a class="status-btn status-close" href="javascript:void(0);">'._('未發送').'</a>';
			} else {
				$siteMessage->status='<a class="status-btn status-open" href="javascript:void(0);">'._('已發送').'</a>';
			}

			if ($siteMessage->is_windows === 0) {
				$siteMessage->is_windows= _('無');
			} else {
				$siteMessage->is_windows= _('彈出小窗');
			}

			if ($siteMessage->user_level === 0) {
				$siteMessage->user_level= _('全部');
			} elseif ($siteMessage->user_level === 1)  {
				$siteMessage->user_level= _('一般會員');
			} elseif ($siteMessage->user_level === 2)  {
				$siteMessage->user_level= _('黃金VIP2');
			}

			// $action = "<a href=\"marquee_editor?etype=edit&edit_marquee_id=".$siteMessage->id."\" class=\"btn btn-xs default\"> <i class=\"fa fa-pencil\"></i> 修改 </a>\n\t\t\t\t\t\t\t\t<a href=\"javascript:void(0);\" onclick=\"delete_item(".$siteMessage->id.");\" class=\"btn btn-xs default\"> <i class=\"fa fa-trash-o\"></i> 刪除 </a>";
			$action = "";
		
			$formatItem = array();
			$formatItem[]=$siteMessage->content;
			$formatItem[]=$siteMessage->target;
			$formatItem[]=$siteMessage->username;
			$formatItem[]=$siteMessage->user_level;
			$formatItem[]=$siteMessage->is_windows;
			$formatItem[]=$siteMessage->created_at;
			$formatItem[]=$siteMessage->operator;
			$formatItem[]=$siteMessage->updated_at;
			$formatItem[]=$siteMessage->status;
			$formatItem[]=$action;
			$result[] = $formatItem;
		}
		// return $response->withJson($result);
		//$siteMessage = $siteMessage->toArray();
		$count = SiteMessageModel::where($where)->count();
		if($result == null)$result = [];
		$draw = 1;
		if(isset($get['draw']))
			$draw = intval($get['draw']);
		$result = Functions::listData($draw ,$count,$count,$result);
		return $response->withJson($result);
	}
	
	public function saveSiteMsg($request, $response)
    {
		$get = $request->getQueryParams();
		$post = $request->getParsedBody();
		$id = $post['edit_site_msg_id'];

		$json = new \stdClass();
		$json->code = 0;
		$json->msg = "成功";
		
		// return $response->withJson($post);
		$marquee = new SiteMessageModel;
		$usernames = explode(";", $post['site_msg_username']);
		// return $response->withJson($usernames);
		$noUsers = '';
		foreach ($usernames as $username) {
			$user = User::where("username", $username)->first();
			if (empty($user)) {
				$noUsers .= $username;
			}
		}

		if (!empty($noUsers)) {
			$json->code = 0;
			$json->msg = "無以下帳號:" . $noUsers;
			return $response->withJson($json);
		}
		// return $response->withJson($json);
		// return;
		if($id > 0){
			$marquee = SiteMessageModel::find($id);
		}
		$marquee->target = $post['site_msg_target'];
		$marquee->content = $post['site_msg_content']['tw'];
		$marquee->username = $post['site_msg_username'];
		$marquee->user_level = isset($post['level_type_all']) ? $post['level_type_all'] : $post['level_type'];
		$marquee->is_windows = $post['site_msg_windows_type'];
		$marquee->status = 0;
		$marquee->operator = $_SESSION['username'];
		$marquee->created_at = date('Y-m-d H:i:s');
		$marquee->updated_at = date('Y-m-d H:i:s');
		$marquee->save();
		if($id > 0)
			$msg = Functions::showMsg('site_msg_editor?etype=edit&edit_site_msg_id='.$id,-2,'kangMarquee');
		else
			$msg = Functions::showMsg('site_msg'.$id,-2,'kangMarquee');
		return $response->withJson($msg);
	}
	
	public function deleteMarquee($request, $response)
    {
		$get = $request->getQueryParams();
		$post = $request->getParsedBody();
		$id = $post['edit_site_msg_id'];
		if($id > 0){
			SiteMessageModel::destroy($id);
			$msg = Functions::showMsg('site_msg',-3,'kangNews');
			return $response->withJson($msg);
		}
		 
		
	}
 
}
