<?php
namespace App\Controllers\Admin;

use Illuminate\Database\Capsule\Manager as DB;
use stdClass;
use Interop\Container\ContainerInterface;
use App\Extensions\AdminBase;
use App\Extensions\Functions;
use App\Models\UserMoney;
use App\Models\User;
class Report extends AdminBase
{
	public function __Construct(ContainerInterface $container)
    {
		parent::__Construct($container);
	}

	public function cusQuotaLog($request, $response)
    {
		$get = $request->getQueryParams();
		$where = array();
		/*
		search_start_date: 2021-10-16
		search_start_time: 20:32:20
		search_end_date: 2021-10-30
		search_end_time: 20:32:20
		search_customer_userid: 
		fuzzy_search: 1
		search_operate_type: 1
		search_trans_type: 6
		*/
		$where[] = array('created_at','>=',$get['search_start_date'].' '.$get['search_start_time']);
		$where[] = array('created_at','<=',$get['search_end_date'].' '.$get['search_end_time']);
		if(!empty($get['search_customer_userid'])){
			if(isset($get['fuzzy_search']) && $get['fuzzy_search'] == 1)
				$where[] = array('username','like','%'.$get['search_customer_userid'].'%');
			else
				$where[] = array('username',$get['search_customer_userid']);
		}
		
		if(isset($get['search_operate_type']) &&  $get['search_operate_type'] != '-1' )
			$where[] = array('operate_type',$get['search_operate_type']);
		if(isset($get['search_trans_type']) &&  $get['search_trans_type'] != '-1' )
			$where[] = array('trans_type',$get['search_trans_type']);
		
		
		
		$start = 0;
		if(isset($get['start']))
			$start = intval($get['start']);
		
		$length = 10;
		if(isset($get['length']))
			$length = intval($get['length']);

		$rows = UserMoney::select('username','operate_type','trans_type','reason','assets','money','balance','operator','updated_at','id')->where($where)->skip($start)->take($length)->orderBy('id', 'desc')->get();
		$result = array();
		$all_trans_quota = 0;
		foreach($rows as $row){
			$all_trans_quota += $row->money;

			$row->username = '<span class="pd-5" style="background-color: #ff0000">'.$row->username.'</span>';
			if($row->assets >=0)
				$row->assets = '<span class="green-txt">'.$row->assets.'</span>';
			else
				$row->assets = '<span class="red-txt">'.$row->assets.'</span>';
			
			if($row->money >=0)
				$row->money = '<span class="green-txt">'.$row->money.'</span>';
			else
				$row->money = '<span class="red-txt">'.$row->money.'</span>';
			
			if($row->balance >=0)
				$row->balance = '<span class="green-txt">'.$row->balance.'</span>';
			else
				$row->balance = '<span class="red-txt">'.$row->balance.'</span>';
			
			$row->operate_type = UserMoney::getOpType($row->operate_type);
			$row->trans_type = UserMoney::getTransTypeName($row->trans_type);
			
			//$new->release_status='<a class="status-btn status-open" href="javascript:void(0);">'._('常駐').'</a>';
			//$new->status='<a class="status-btn status-open" href="javascript:void(0);">'._('啟用').'</a>';
			//$action = "<a href=\"news_editor?etype=edit&edit_news_id=".$new->id."\" class=\"btn btn-xs default\"> <i class=\"fa fa-pencil\"></i> 修改 </a>\n\t\t\t\t\t\t\t\t<a href=\"javascript:void(0);\" onclick=\"delete_item(".$new->id.");\" class=\"btn btn-xs default\"> <i class=\"fa fa-trash-o\"></i> 刪除 </a>";
		
			$formatItem = array();
			$formatItem[]=$row->username;
			$formatItem[]=$row->operate_type;
			$formatItem[]=$row->trans_type;
			$formatItem[]=$row->reason;
			$formatItem[]=$row->assets;
			$formatItem[]=$row->money;
			$formatItem[]=$row->balance; 
			$formatItem[]=$row->operator;
			$formatItem[]=$row->updated_at;
			//$formatItem['debug'] = $where;
			$result[] = $formatItem;
		}
		
		//$news = $news->toArray();
		$count = UserMoney::where($where)->count();
		if($result == null)$result = [];
		$draw = 1;
		if(isset($get['draw']))
			$draw = intval($get['draw']);
		//$draw = intval(date('s'));
		$result = Functions::listData($draw ,$count,$count,$result);
		$result->all_trans_quota = $all_trans_quota;
		return $response->withJson($result);
	}
	
	public function agentQuotaLog($request, $response)
    {
		$get = $request->getQueryParams();
		$where = array();
		/*
		search_start_date: 2021-10-16
		search_start_time: 20:32:20
		search_end_date: 2021-10-30
		search_end_time: 20:32:20
		search_customer_userid: 
		fuzzy_search: 1
		search_operate_type: 1
		search_trans_type: 6
		*/
		$where[] = array('created_at','>=',$get['search_start_date'].' '.$get['search_start_time']);
		$where[] = array('created_at','<=',$get['search_end_date'].' '.$get['search_end_time']);
		if(!empty($get['search_customer_userid'])){
			if(isset($get['fuzzy_search']) && $get['fuzzy_search'] == 1)
				$where[] = array('username','like','%'.$get['search_customer_userid'].'%');
			else
				$where[] = array('username',$get['search_customer_userid']);
		}
		
		if(isset($get['search_operate_type']) &&  $get['search_operate_type'] != '-1' )
			$where[] = array('operate_type',$get['search_operate_type']);
		if(isset($get['search_trans_type']) &&  $get['search_trans_type'] != '-1' )
			$where[] = array('trans_type',$get['search_trans_type']);
		
		
		
		$start = 0;
		if(isset($get['start']))
			$start = intval($get['start']);
		
		$length = 10;
		if(isset($get['length']))
			$length = intval($get['length']);

		$rows = UserMoney::with('user')->select('username','operate_type','trans_type','reason','assets','money','balance','operator','updated_at','id')->where($where)->skip($start)->take($length)->orderBy('id', 'desc')->get();
		$result = array();
	 
		foreach($rows as $row){
			$row->username = '<span class="pd-5" style="background-color: #ff0000">'.$row->username.'</span>';
			if($row->assets >=0)
				$row->assets = '<span class="green-txt">'.$row->assets.'</span>';
			else
				$row->assets = '<span class="red-txt">'.$row->assets.'</span>';
			
			if($row->money >=0)
				$row->money = '<span class="green-txt">'.$row->money.'</span>';
			else
				$row->money = '<span class="red-txt">'.$row->money.'</span>';
			
			if($row->balance >=0)
				$row->balance = '<span class="green-txt">'.$row->balance.'</span>';
			else
				$row->balance = '<span class="red-txt">'.$row->balance.'</span>';
			
			$row->operate_type = UserMoney::getOpType($row->operate_type);
			$row->trans_type = UserMoney::getTransTypeName($row->trans_type);
			
			//$new->release_status='<a class="status-btn status-open" href="javascript:void(0);">'._('常駐').'</a>';
			//$new->status='<a class="status-btn status-open" href="javascript:void(0);">'._('啟用').'</a>';
			//$action = "<a href=\"news_editor?etype=edit&edit_news_id=".$new->id."\" class=\"btn btn-xs default\"> <i class=\"fa fa-pencil\"></i> 修改 </a>\n\t\t\t\t\t\t\t\t<a href=\"javascript:void(0);\" onclick=\"delete_item(".$new->id.");\" class=\"btn btn-xs default\"> <i class=\"fa fa-trash-o\"></i> 刪除 </a>";
		
			$formatItem = array();
			$formatItem[]= User::getRoleName($row->user->role);
			$formatItem[]=$row->username;
			$formatItem[]=$row->operate_type;
			$formatItem[]=$row->trans_type;
			$formatItem[]=$row->reason;
			$formatItem[]=$row->assets;
			$formatItem[]=$row->money;
			$formatItem[]=$row->balance; 
			$formatItem[]=$row->operator;
			$formatItem[]=$row->updated_at;
			//$formatItem['debug'] = $where;
			$result[] = $formatItem;
		}
		
		//$news = $news->toArray();
		$count = UserMoney::where($where)->count();
		if($result == null)$result = [];
		$draw = 1;
		if(isset($get['draw']))
			$draw = intval($get['draw']);
		//$draw = intval(date('s'));
		$result = Functions::listData($draw ,$count,$count,$result);
		return $response->withJson($result);
	}
	
	public function cusBetInfo($request, $response)
    {
		$get = $request->getQueryParams();
		$where = array();
		/*
		search_start_date: 2021-10-16
		search_start_time: 20:32:20
		search_end_date: 2021-10-30
		search_end_time: 20:32:20
		search_customer_userid: 
		fuzzy_search: 1
		search_operate_type: 1
		search_trans_type: 6
		*/
		$where[] = array('created_at','>=',$get['search_start_date'].' '.$get['search_start_time']);
		$where[] = array('created_at','<=',$get['search_end_date'].' '.$get['search_end_time']);
		if(!empty($get['search_customer_userid'])){
			if(isset($get['fuzzy_search']) && $get['fuzzy_search'] == 1)
				$where[] = array('username','like','%'.$get['search_customer_userid'].'%');
			else
				$where[] = array('username',$get['search_customer_userid']);
		}
		
		if(isset($get['search_operate_type']) &&  $get['search_operate_type'] != '-1' )
			$where[] = array('operate_type',$get['search_operate_type']);
		if(isset($get['search_trans_type']) &&  $get['search_trans_type'] != '-1' )
			$where[] = array('trans_type',$get['search_trans_type']);
		
		
		
		$start = 0;
		if(isset($get['start']))
			$start = intval($get['start']);
		
		$length = 10;
		if(isset($get['length']))
			$length = intval($get['length']);

		$rows = UserMoney::select('username','operate_type','trans_type','reason','assets','money','balance','operator','updated_at','id')->where($where)->skip($start)->take($length)->get();
		$result = array();
	 
		foreach($rows as $row){
			$row->username = '<span class="pd-5" style="background-color: #ff0000">'.$row->username.'</span>';
			if($row->assets >=0)
				$row->assets = '<span class="green-txt">'.$row->assets.'</span>';
			else
				$row->assets = '<span class="red-txt">'.$row->assets.'</span>';
			
			if($row->money >=0)
				$row->money = '<span class="green-txt">'.$row->money.'</span>';
			else
				$row->money = '<span class="red-txt">'.$row->money.'</span>';
			
			if($row->balance >=0)
				$row->balance = '<span class="green-txt">'.$row->balance.'</span>';
			else
				$row->balance = '<span class="red-txt">'.$row->balance.'</span>';
			
			$row->operate_type = UserMoney::getOpType($row->operate_type);
			$row->trans_type = UserMoney::getTransTypeName($row->trans_type);
			
			//$new->release_status='<a class="status-btn status-open" href="javascript:void(0);">'._('常駐').'</a>';
			//$new->status='<a class="status-btn status-open" href="javascript:void(0);">'._('啟用').'</a>';
			//$action = "<a href=\"news_editor?etype=edit&edit_news_id=".$new->id."\" class=\"btn btn-xs default\"> <i class=\"fa fa-pencil\"></i> 修改 </a>\n\t\t\t\t\t\t\t\t<a href=\"javascript:void(0);\" onclick=\"delete_item(".$new->id.");\" class=\"btn btn-xs default\"> <i class=\"fa fa-trash-o\"></i> 刪除 </a>";
		
			$formatItem = array();
			$formatItem[]=$row->username;
			$formatItem[]=$row->operate_type;
			$formatItem[]=$row->trans_type;
			$formatItem[]=$row->reason;
			$formatItem[]=$row->assets;
			$formatItem[]=$row->money;
			$formatItem[]=$row->balance; 
			$formatItem[]=$row->operator;
			$formatItem[]=$row->updated_at;
			//$formatItem['debug'] = $where;
			$result[] = $formatItem;
		}
		
		//$news = $news->toArray();
		$count = UserMoney::where($where)->count();
		if($result == null)$result = [];
		$draw = 1;
		if(isset($get['draw']))
			$draw = intval($get['draw']);
		//$draw = intval(date('s'));
		$result = Functions::listData($draw ,$count,$count,$result);
		return $response->withJson($result);
	}
 
}
