<?php
namespace App\Controllers\Admin;

use Illuminate\Database\Capsule\Manager as DB;
use stdClass;
use Interop\Container\ContainerInterface;
use App\Extensions\AdminBase;
use App\Extensions\Functions;
use App\Models\UserMoney;
use App\Models\User;
use App\Models\Bet;
use App\Models\DepositOrder;
use App\Models\Withdraw;

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
		
		 
		// $users = User::select('username')->where('parents','like','%/'.$_SESSION['id'].'/%')->where('role', 'customer')->get();
		$users = User::select('username')->where('parents','like','%/'.$_SESSION['id'].'/%')->orWhere('id', $_SESSION['id'])->get();
		$usernames = array();
		foreach($users as $user){
			$usernames[] = $user->username;
		} 
		
		 

		$rows = UserMoney::select('username','operate_type','trans_type','reason','assets','money','balance','operator','updated_at','id')->whereIn('username',$usernames)->where($where)->skip($start)->take($length)->orderBy('id', 'desc')->get();
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
		$count = UserMoney::where($where)->whereIn('username',$usernames)->count();
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


		$users = User::select('username')->where('parents','like','%/'.$_SESSION['id'].'/%')->where('role', 'agent')->get();
		$usernames = array();
		foreach($users as $user){
			$usernames[] = $user->username;
		} 
		
		$rows = UserMoney::with('user')->select('username','operate_type','trans_type','reason','assets','money','balance','operator','updated_at','id')->whereIn('username',$usernames)->where($where)->skip($start)->take($length)->orderBy('id', 'desc')->get();
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
		$count = UserMoney::where($where)->whereIn('username',$usernames)->count();
		if($result == null)$result = [];
		$draw = 1;
		if(isset($get['draw']))
			$draw = intval($get['draw']);
		//$draw = intval(date('s'));
		$result = Functions::listData($draw ,$count,$count,$result);
		return $response->withJson($result);
	}

	public function selfQuotaLog($request, $response)
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
		/*
		$where[] = array('created_at','>=',$get['search_start_date'].' '.$get['search_start_time']);
		$where[] = array('created_at','<=',$get['search_end_date'].' '.$get['search_end_time']);
		if(!empty($get['search_customer_userid'])){
			if(isset($get['fuzzy_search']) && $get['fuzzy_search'] == 1)
				$where[] = array('username','like','%'.$get['search_customer_userid'].'%');
			else
				$where[] = array('username',$get['search_customer_userid']);
		}
		*/
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


		$users = User::select('username')->where('id',$_SESSION['id'])->get();
		$usernames = array();
		foreach($users as $user){
			$usernames[] = $user->username;
		} 
		
		$rows = UserMoney::with('user')->select('username','operate_type','trans_type','reason','assets','money','balance','operator','updated_at','id')->whereIn('username',$usernames)->where($where)->skip($start)->take($length)->orderBy('id', 'desc')->get();
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
		$count = UserMoney::where($where)->whereIn('username',$usernames)->count();
		if($result == null)$result = [];
		$draw = 1;
		if(isset($get['draw']))
			$draw = intval($get['draw']);
		//$draw = intval(date('s'));
		$result = Functions::listData($draw ,$count,$count,$result);
		$result->all_trans_quota = $all_trans_quota;
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
 
	public function allCalcReportManager($request, $response)
    {
		$get = $request->getQueryParams();
		$where = array();
		$where[] = array('flag',1);
		$dateTimeColumn = 'bet_time';
		if(isset($get['search_date_type'])){
			$search_date_type = $get['search_date_type'];
			if($search_date_type == '1') 
				$dateTimeColumn = 'bet_time';
			elseif($search_date_type == '2') 
				$dateTimeColumn = 'draw_time';
			elseif($search_date_type == '3') 
				$dateTimeColumn = 'bet_time';
		}
		$sddate = isset($get['sddate']) ? $get['sddate']:date('Y-m-01');
		$eddate = isset($get['eddate']) ? $get['eddate']:date('Y-m-d');
		$sdtime = isset($get['sdtime']) ? $get['sdtime'] : date('00:00:00');
		$edtime = isset($get['edtime']) ? $get['edtime'] : date('23:59:59');
		$where[] = array($dateTimeColumn,'>=',$sddate.' ' .$sdtime);
		$where[] = array($dateTimeColumn,'<=',$eddate.' ' .$edtime);
		//if(isset($get['search_customer_userid']))
		//	$where[] = array('game_username','like','%'.$get['search_customer_userid'].'%');
		 
		$id = $_SESSION['id'];
		$summarys = Bet::whereHas('user',function($query) use ($id){
			$query->where('parents','like','%/'.$id.'/%');
			$query->orWhere('user_id', $id);
		})->with('game') 
		->join('games', 'bets.game_id', '=', 'games.id')
		->select(
			DB::raw("DATE_FORMAT({$dateTimeColumn},'%Y-%m-%d') as calDay"),
			DB::raw('count(bets.id) as Cnt'),
			DB::raw('SUM(Amount) as totalAmount'),
			DB::raw('SUM(valid_Amount) as totalValidAmount'),
			DB::raw('SUM(winlose) as totalWinlose'),
			DB::raw('SUM(winlose * games.percent/100 * -1) as totalGameGive'),
			DB::raw('SUM(netAmount) as totalNetAmount')
		)->where($where)->groupBy('calDay')->orderBy('bets.id', 'desc')->get();

		$where = array();
		$where[] = array('created_at','>=',$sddate.' ' .$sdtime);
		$where[] = array('created_at','<=',$eddate.' ' .$edtime);
		//money_in入金,money_out出金,retreat反水
		$userMoneys = UserMoney::whereHas('user',function($query) use ($id){
			$query->where('parents','like','%/'.$id.'/%');
		})->select(
			DB::raw("DATE_FORMAT(created_at,'%Y-%m-%d') as calDay"),
			DB::raw('SUM(CASE WHEN operate_type=1 AND trans_type IN (5) THEN money else null END) as retreat'),
		)->where($where)->groupBy('calDay')->orderBy('id', 'desc')->get();
		//money_in入金
		$money_in = DepositOrder::whereHas('user',function($query) use ($id){
			$query->where('parents','like','%/'.$id.'/%');
		})->select(
			DB::raw("DATE_FORMAT(created_at,'%Y-%m-%d') as calDay"),
			DB::raw('SUM(apply_amount) as money_in'),
		)->where($where)->where('status', 100)->groupBy('calDay')->orderBy('id', 'desc')->get();
		//money_out出金
		$money_out = Withdraw::whereHas('user',function($query) use ($id){
			$query->where('parents','like','%/'.$id.'/%');
		})->select(
			DB::raw("DATE_FORMAT(created_at,'%Y-%m-%d') as calDay"),
			DB::raw('SUM(amount) as money_out'),
		)->where($where)->where('status', 100)->groupBy('calDay')->orderBy('id', 'desc')->get();
		$result = array();
		//找出日期范围,日期当key
		$days = round((strtotime($eddate) - strtotime($sddate))/3600/24) ;
		if ($days > 365) {
			$days = 365;
		}
		$week = array();
		for ($i = 0; $i <= $days; $i++) {
			$result[date("Y-m-d", strtotime($eddate. " -".$i." day"))] = array(
				'totalAmount'=>0,
				'totalValidAmount'=>0,
				'totalWinlose'=>0,
				'totalNetAmount'=>0,
				'totalGameGive'=>0,//厂商上缴
				'money_in'=>0,
				'money_out'=>0,
				'retreat'=>0,
				'Cnt'=>0, 
				'total'=>0, 
			);
		}
		foreach($summarys as $summary){
			$result[$summary->calDay]['totalAmount'] = floatval($summary->totalAmount);
			$result[$summary->calDay]['totalValidAmount'] = floatval($summary->totalValidAmount);
			$result[$summary->calDay]['totalWinlose'] = floatval($summary->totalWinlose);
			$result[$summary->calDay]['totalGameGive'] = floatval($summary->totalGameGive);
			$result[$summary->calDay]['totalNetAmount'] = floatval($summary->totalNetAmount);
			$result[$summary->calDay]['Cnt'] = $summary->Cnt;

			$result[$summary->calDay]['total'] += floatval($summary->totalGameGive);
			$result[$summary->calDay]['total'] += floatval($summary->totalWinlose);
		}
		foreach($userMoneys as $item){
			$result[$item->calDay]['retreat'] = floatval($item->retreat);
			$result[$item->calDay]['total'] += floatval($item->retreat);
		}
		foreach($money_in as $item){
			$result[$item->calDay]['money_in'] = floatval($item->money_in);
		}
		foreach($money_out as $item){
			$result[$item->calDay]['money_out'] = floatval($item->money_out);
		}

		//總計
		$allTotal = new \stdClass;
		$allTotal->totalAmount = 0;
		$allTotal->totalValidAmount = 0;
		$allTotal->totalWinlose = 0;
		$allTotal->totalGameGive = 0;
		$allTotal->totalNetAmount = 0;
		$allTotal->money_in = 0;
		$allTotal->money_out = 0;
		$allTotal->retreat = 0;
		$allTotal->Cnt = 0;
		$allTotal->total = 0;
		foreach($result as $item){
			$allTotal->totalAmount += $item['totalAmount'];
			$allTotal->totalValidAmount += $item['totalValidAmount'];
			$allTotal->totalWinlose += $item['totalWinlose'];
			$allTotal->totalGameGive += $item['totalGameGive'];
			$allTotal->totalNetAmount += $item['totalNetAmount'];
			$allTotal->retreat += $item['retreat'];
			$allTotal->Cnt += $item['Cnt'];
			$allTotal->money_in += $item['money_in'];
			$allTotal->money_out += $item['money_out'];

			$allTotal->total +=  $item['retreat'] + $item['totalWinlose'] + $item['totalGameGive'];
		}
		//echo json_encode($summarys);
        return $this->view->render('all_calc_report_manager',[
			'sddate'=>$sddate,
			'eddate'=>$eddate,
			'sdtime'=>$sdtime,
			'edtime'=>$edtime,
			'summarys'=>$summarys,
			'allTotal'=>$allTotal,
			'result'=>$result
		]);
	}
	public function allCalcAgentReportManager($request, $response)
    {
		$get = $request->getQueryParams();
		$pid = isset($get['pid']) ? $get['pid']: $_SESSION['id'];

		if ($pid == 1) {
			//列出所有总代
			$users = User::where('role', 'topagent')->get();
		} else {
			
			$target = User::find($pid);
			if ($target->role == 'topagent') {
				//列出底下代理,总代理的所有会员(不包刮底下代理的会员)

				//底下代理
				$agents = User::where('pid', $pid)->where('role', 'agent')->get();
				//总代理的会员
				$users = User::getMembersOfTopAgent($pid);
				$users = $agents->merge($users);

			} elseif ($target->role == 'agent') { 
				//列出底下所有会员
				$users = User::where('parents', 'like', '%/' .$pid . '/%')->orWhere('id', $pid)->get();
			}
			
		}
		
		$sddate = isset($get['sddate']) ? $get['sddate']:date('Y-m-01');
		$eddate = isset($get['eddate']) ? $get['eddate']:date('Y-m-d');
		$sdtime = isset($get['sdtime']) ? $get['sdtime'] : date('00:00:00');
		$edtime = isset($get['edtime']) ? $get['edtime'] : date('23:59:59');
		foreach ($users as $k=>$user) {
			if ($user->role == 'customer') {
				//会员
				$where = array();
				$where[] = array('flag',1);
				$dateTimeColumn = 'bet_time';
				if(isset($get['search_date_type'])){
					$search_date_type = $get['search_date_type'];
					if($search_date_type == '1') 
						$dateTimeColumn = 'bet_time';
					elseif($search_date_type == '2') 
						$dateTimeColumn = 'draw_time';
					elseif($search_date_type == '3') 
						$dateTimeColumn = 'bet_time';
				}
				
				$where[] = array($dateTimeColumn,'>=',$sddate.' ' .$sdtime);
				$where[] = array($dateTimeColumn,'<=',$eddate.' ' .$edtime);
				//注单
				$summarys = Bet::join('games', 'bets.game_id', '=', 'games.id')
				->select(
					DB::raw('count(games.id) as Cnt'),
					DB::raw('SUM(Amount) as totalAmount'),
					DB::raw('SUM(valid_Amount) as totalValidAmount'),
					DB::raw('SUM(winlose) as totalWinlose'),
					DB::raw('SUM(winlose * games.percent/100 * -1) as totalGameGive')
				)->where($where)->where('bets.user_id', $user->id)->orderBy('games.id', 'desc')->first();
	
				$where = array();
				$where[] = array('created_at','>=',$sddate.' ' .$sdtime);
				$where[] = array('created_at','<=',$eddate.' ' .$edtime);
				//money_in入金,money_out出金,retreat反水
				$userMoneys = UserMoney::select(
					DB::raw('SUM(CASE WHEN operate_type=1 AND trans_type IN (5) THEN money END) as retreat'),
				)->where($where)->where('username', $user->username)->first();
				//money_in入金
				$money_in = DepositOrder::select(
					DB::raw('SUM(apply_amount) as money_in'),
				)->where($where)->where('status', 100)->where('name', $user->username)->first();
				//money_out出金
				$money_out = Withdraw::select(
					DB::raw('SUM(amount) as money_out'),
				)->where($where)->where('status', 100)->where('name', $user->username)->first();
			} else {
				//总代理,代理
				$where = array();
				$where[] = array('flag',1);
				$dateTimeColumn = 'bet_time';
				if(isset($get['search_date_type'])){
					$search_date_type = $get['search_date_type'];
					if($search_date_type == '1') 
						$dateTimeColumn = 'bet_time';
					elseif($search_date_type == '2') 
						$dateTimeColumn = 'draw_time';
					elseif($search_date_type == '3') 
						$dateTimeColumn = 'bet_time';
				}
				
				$where[] = array($dateTimeColumn,'>=',$sddate.' ' .$sdtime);
				$where[] = array($dateTimeColumn,'<=',$eddate.' ' .$edtime);
				//注单
				$userIds = User::where('id', $user->id)
				->orWhere('parents', 'like', '%/' .$user->id . '/%')
				->pluck('id');

				$summarys = Bet::join('games', 'bets.game_id', '=', 'games.id')
				->join('users', 'bets.user_id', '=', 'users.id')
				->select(
					DB::raw('count(games.id) as Cnt'),
					DB::raw('SUM(Amount) as totalAmount'),
					DB::raw('SUM(valid_Amount) as totalValidAmount'),
					DB::raw('SUM(winlose) as totalWinlose'),
					DB::raw('SUM(winlose * games.percent/100 * -1) as totalGameGive'),
					DB::raw('SUM(netAmount) as totalNetAmount')
				)->where($where)->whereIn('bets.user_id',$userIds)->orderBy('games.id', 'desc')->first();

				$where = array();
				$where[] = array('user_money.created_at','>=',$sddate.' ' .$sdtime);
				$where[] = array('user_money.created_at','<=',$eddate.' ' .$edtime);
				//money_in入金,money_out出金,retreat反水
				$userMoneys = UserMoney::join('users', 'user_money.username', '=', 'users.username')
				->select(
					DB::raw('SUM(CASE WHEN operate_type=1 AND trans_type IN (5) THEN money END) as retreat'),
				)->where($where)->where('users.parents', 'like', '%/' .$user->id . '/%')->first();
				//money_in入金
				$where = array();
				$where[] = array('deposit_orders.created_at','>=',$sddate.' ' .$sdtime);
				$where[] = array('deposit_orders.created_at','<=',$eddate.' ' .$edtime);
				$money_in = DepositOrder::join('users', 'deposit_orders.user_id', '=', 'users.id')
				->select(
					DB::raw('SUM(apply_amount) as money_in'),
				)->where($where)->where('status', 100)->where('users.parents', 'like', '%/' .$user->id . '/%')->first();
				//money_out出金
				$where = array();
				$where[] = array('withdraws.created_at','>=',$sddate.' ' .$sdtime);
				$where[] = array('withdraws.created_at','<=',$eddate.' ' .$edtime);
				$money_out = Withdraw::join('users', 'withdraws.user_id', '=', 'users.id')
				->select(
					DB::raw('SUM(amount) as money_out'),
				)->where($where)->where('status', 100)->where('users.parents', 'like', '%/' .$user->id . '/%')->first();
			}
			
			if ($summarys->Cnt >0 || $money_in->money_in || $money_out->money_out || $userMoneys->retreat) {
				$user->Cnt = $summarys->Cnt;
				$user->totalAmount = floatval($summarys->totalAmount);
				$user->totalValidAmount = floatval($summarys->totalValidAmount);
				$user->totalWinlose = floatval($summarys->totalWinlose);
				$user->totalGameGive = floatval($summarys->totalGameGive);
				$user->money_in = floatval($money_in->money_in);
				$user->money_out = floatval($money_out->money_out);
				$user->retreat = floatval($userMoneys->retreat);
				$user->total +=  $user->retreat + $user->totalWinlose + $user->totalGameGive;
				$user->totalNetAmount +=  $summarys->totalNetAmount;
			} else {
				$users->forget($k);
			}
			

			
		}

		/*
		echo json_encode($users);
		die();
		*/
		
		$allTotal = new \stdClass;
		$allTotal->totalAmount = 0;
		$allTotal->totalValidAmount = 0;
		$allTotal->totalWinlose = 0;
		$allTotal->totalGameGive = 0;
		$allTotal->Cnt = 0;
		$allTotal->money_in = 0;
		$allTotal->money_out = 0;
		$allTotal->retreat = 0;
		$allTotal->total = 0;
		$allTotal->totalNetAmount = 0;
		foreach($users as $user){
			$allTotal->totalAmount += $user->totalAmount;
			$allTotal->totalValidAmount += $user->totalValidAmount;
			$allTotal->totalWinlose += $user->totalWinlose;
			$allTotal->totalGameGive += $user->totalGameGive;
			$allTotal->Cnt += $user->Cnt;
			$allTotal->money_in += $user->money_in;
			$allTotal->money_out += $user->money_out;
			$allTotal->retreat += $user->retreat;

			$allTotal->total +=  $user->retreat + $user->totalWinlose + $user->totalGameGive;
			$allTotal->totalNetAmount +=  $user->totalNetAmount;
		}
		
        return $this->view->render('all_calc_agent_report_manager',[
			'sddate'=>$sddate,
			'eddate'=>$eddate,
			'sdtime'=>$sdtime,
			'edtime'=>$edtime,
			'users'=>$users,
			'allTotal'=>$allTotal
		]);
	} 
}
