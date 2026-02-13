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
use App\Models\UserBetLog;
use App\Models\DepositOrder;
use App\Models\Withdraw;
use App\Models\ExtraCommissionRule;
use App\Models\RetreatRule;

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
 
	public function allCalcReportManager_back_20250806($request, $response)
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

	public function allCalcReportManager($request, $response)
    {
		$get = $request->getQueryParams();
		$where = array();
		$where[] = array('flag',1);
		$dateTimeColumn = 'draw_time';
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
		})->with('game')->with('user')
		->join('games', 'bets.game_id', '=', 'games.id')
		->select(
			'user_id',
			'game_id',
			DB::raw("DATE_FORMAT({$dateTimeColumn},'%Y-%m-%d') as calDay"),
			DB::raw('count(bets.id) as Cnt'),
			DB::raw('SUM(Amount) as totalAmount'),
			DB::raw('SUM(valid_Amount) as totalValidAmount'),
			DB::raw('SUM(winlose) as totalWinlose'),
			DB::raw('SUM(winlose * games.percent/100 * -1) as totalGameGive'),
			DB::raw('SUM(netAmount) as totalNetAmount')
		)->where($where)->groupBy('calDay', 'user_id', 'game_id')->orderBy('bets.id', 'desc')->get();
		// echo json_encode($summarys);
		// return;
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
				'totalTopAgentCommission'=>0,
				'totalCommission'=>0,
				'totalExtraCommissionRule'=>0,
				'totalAgentRetreat'=>0,
				'totalAgentRetreatRule'=>0,
				'totalRetreat'=>0,
				'totalTopAgentRetreat'=>0,
				'totalTopAgentRetreatRule'=>0,
				'totalGameGive'=>0,//厂商上缴
				'money_in'=>0,
				'money_out'=>0,
				'retreat'=>0,
				'Cnt'=>0, 
				'total'=>0, 
			);
		}

		foreach($summarys as $summary){
			$result[$summary->calDay]['totalAmount'] = bcadd($result[$summary->calDay]['totalAmount'] ?? '0', $summary->totalAmount, 4);
            $result[$summary->calDay]['totalValidAmount'] = bcadd($result[$summary->calDay]['totalValidAmount'] ?? '0', $summary->totalValidAmount, 4);
            $result[$summary->calDay]['totalWinlose'] = bcadd($result[$summary->calDay]['totalWinlose'] ?? '0', $summary->totalWinlose, 4);
            $result[$summary->calDay]['totalGameGive'] = bcadd($result[$summary->calDay]['totalGameGive'] ?? '0', $summary->totalGameGive, 4);
            $result[$summary->calDay]['totalNetAmount'] = bcadd($result[$summary->calDay]['totalNetAmount'] ?? '0', $summary->totalNetAmount, 4);
            $result[$summary->calDay]['total'] = bcadd($result[$summary->calDay]['total'] ?? '0', $summary->totalGameGive, 4);
            $result[$summary->calDay]['Cnt'] = ($result[$summary->calDay]['Cnt'] ?? 0) + $summary->Cnt;
			
			if ($summary->user != null) {
                $amount = floatval(abs($summary->totalValidAmount));

                // $result[$summary->calDay]['totalMargin'] += floatval($user->margin);
                
                $chain = $summary->user->getParentChainFromBottom($summary->game_id);
				
				for ($i = 0; $i < count($chain); $i++) {
					$parent = $chain[$i]; // 父
                    $child = $chain[$i + 1] ?? null; // 子
                    // echo "child: " . json_encode($child) . "<br><br>";
                    // echo "parent: " . json_encode($parent) . "<br>";
                    // 退水差額計算
                    $parentRate = $parent->retreatRule->ruleDetailsGames[0]['percent'] ?? 0;
                    $childRate = $child->retreatRule->ruleDetailsGames[0]['percent'] ?? 0;
                    $diffRetreat = bcsub($parentRate, $childRate, 4);
                    $diffRetreat = bcdiv($diffRetreat, 100, 4); // 除以100轉為百分比
                    // echo "退水差率: " . $diffRetreat . "<br>";
                    if ($diffRetreat > 0) {
                        $retreatName = $parent->role === 'topagent' ? 'totalTopAgentRetreat' : 'totalAgentRetreat';
                        $retreatRuleName = $parent->role === 'topagent' ? 'totalTopAgentRetreatRule' : 'totalAgentRetreatRule';

                        $retreatValue = bcmul($amount, $diffRetreat, 4);

                        $result[$summary->calDay][$retreatName] += $retreatValue;
                        $result[$summary->calDay][$retreatRuleName] += $retreatValue;
                        $result[$summary->calDay]['totalRetreat'] += $retreatValue;
                        $result[$summary->calDay]['total'] += $retreatValue;
                    }
                    // echo "退水差額: " . $value . "<br>";

                    // 傭金差額計算
                    $parentCommission = $parent->commissionRule->ruleDetailsGames[0]['percent'] ?? 0;
                    $childCommission = $child->commissionRule->ruleDetailsGames[0]['percent'] ?? 0;
                    $diffCommission = bcsub($parentCommission, $childCommission, 4);
                    $diffCommission = bcdiv($diffCommission, 100, 4); // 除以100轉為百分比

                    // echo "傭金差率" . $diffCommission . "<br>";
                    if ($diffCommission > 0) {
                        $commissionName = $parent->role === 'topagent' ? 'totalTopAgentCommission' : 'totalAgentCommission';

                        $commissionValue = bcmul($amount, $diffCommission, 4);

                        $result[$summary->calDay][$commissionName] += $commissionValue;
                        $result[$summary->calDay]['totalCommission'] += $commissionValue;
                        $result[$summary->calDay]['totalCommissionRule'] += $commissionValue;
                        $result[$summary->calDay]['total'] += $commissionValue;
                    }
                    // echo "傭金差額: " . $value . "<br>";

                    // 額外佣金差額
                    $parentExtra = $parent->extraCommissionRule->ruleDetailsGames[0]['percent'] ?? 0;
                    $childExtra = $child->extraCommissionRule->ruleDetailsGames[0]['percent'] ?? 0;
                    $diffExtra = bcsub($parentExtra, $childExtra, 4);
                    $diffExtra = bcdiv($diffExtra, 100, 4);

                    // echo "額外佣金差率: " . $diffExtra . "<br>";
                    if ($diffExtra > 0) {
                        $commissionName = $parent->role === 'topagent' ? 'totalTopAgentCommission' : 'totalAgentCommission';

                        $extraCommissionValue = bcmul($amount, $diffExtra, 4);

                        $result[$summary->calDay][$commissionName] += $extraCommissionValue;
                        $result[$summary->calDay]['totalCommission'] += $extraCommissionValue;
                        $result[$summary->calDay]['totalExtraCommissionRule'] += $extraCommissionValue;
                        $result[$summary->calDay]['total'] += $extraCommissionValue;
                    }
                    // echo "額外佣金差額: " . $value . "<br>";
                    // echo "<br>";

                    $detailType = $parent->role === 'topagent' ? 'topAgentDetails' : 'agentDetails';
                    $result[$summary->calDay]['details'][$detailType][] = [
                        'parent_id' => $parent->id,
                        'parent_role' => $parent->role,
                        'parent_username' => $parent->username,
                        'child_id' => $child->id ?? 0,
                        'amount' => $amount,
                        'diffRetreatRate' => $diffRetreat,
                        'retreatValue' => $diffRetreat > 0 ? $retreatValue : 0,
                        'diffCommissionRate' => $diffCommission,
                        'commissionValue' => $diffCommission > 0 ? $commissionValue : 0,
                        'diffExtraRate' => $diffExtra,
                        'extraCommissionValue' => $diffExtra > 0 ? $extraCommissionValue : 0,
                        'game_id' => $summary->game_id,
                        'game_name' => $summary->game->name,
                    ];
                }
            }
		}
		// echo json_encode($result);
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
		$allTotal->totalRetreat = 0;
		$allTotal->totalCustomerRetreat = 0;
		$allTotal->totalAgentRetreat = 0;
		$allTotal->totalTopAgentRetreat = 0;
		$allTotal->totalCommission = 0;
		$allTotal->totalAgentCommission = 0;
		$allTotal->totalTopAgentCommission = 0;
		$allTotal->totalCommissionRule = 0;
		$allTotal->totalExtraCommissionRule = 0;
		foreach($result as $item){
			// echo json_encode($item) . "<br>";
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

	public function allCalcAgentReportManager_back_20250806($request, $response)
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

	public function allCalcAgentReportManager($request, $response)
    {
		ini_set('memory_limit', -1);
		$get = $request->getQueryParams();

		$search_member = isset($get['search_member']) ? $get['search_member'] : 0;
		$pid = isset($get['pid']) ? $get['pid'] : 0;

		if ($pid == $_SESSION['id']) {
			$last_pid = 0;
		} else {
			$parent = User::find($pid);
			$last_pid = $parent ? $parent->pid : 0;
		}

		if ($pid) {
			$users = $this->getTargetUsers($get['pid'], $search_member);
		} else {
			//只顯示自己
			$users = $this->getTargetUser($_SESSION['id']);
		}

		
		$sddate = $get['sddate'] ?? date('Y-m-d');
        $eddate = $get['eddate'] ?? date('Y-m-d');
        $sdtime = $get['sdtime'] ?? '00:00:00';
        $edtime = $get['edtime'] ?? '23:59:59';
		$sdtime = \DateTime::createFromFormat("H:i:s", $sdtime)->format("H:i:s");
        $edtime = \DateTime::createFromFormat("H:i:s", $edtime)->format("H:i:s");
		$datetimeRange = [$sddate . ' ' . $sdtime, $eddate . ' ' . $edtime];


		$searchDateColumn = $this->getDateColumn($get['search_date_type'] ?? '2');

		foreach ($users as $k=>$user) {
			$user->resetStats();

			if ($user->role == 'customer') {
				$summarys = $this->getBetSummaryForCustomer($user, $datetimeRange, $searchDateColumn);
			} else {
				$summarys = $this->getBetSummaryForAgent($user, $target ?? null, $datetimeRange, $searchDateColumn);
			}
			
			if (count($summarys) > 0) {
				$this->calculateUserStats($user, $summarys);
			} else {
				$users->forget($k);
			}
		}

		/*
		echo json_encode($users);
		die();
		*/
			
		//$allTotal = $this->aggregateAllTotals($users);
		$allTotal = new \stdClass;
		$allTotal->Cnt = 0;
		$allTotal->totalAmount = 0;
		$allTotal->totalValidAmount = 0;
		$allTotal->totalNetAmount = 0;
		$allTotal->totalRetreat = 0;
		$allTotal->totalCustomerRetreat = 0;
		$allTotal->selfExtraCommission = 0;
		$allTotal->selfRetreat = 0;
		$allTotal->receiveBot = 0;
		$allTotal->giveTop = 0;
		$allTotal->winlose = 0;
		foreach($users as $user){
			$allTotal->Cnt += $user->Cnt;
			$allTotal->totalAmount +=  $user->totalAmount;
			$allTotal->totalValidAmount +=  $user->totalValidAmount;
			$allTotal->totalNetAmount +=  $user->totalNetAmount;
			$allTotal->totalRetreat +=  $user->totalRetreat;
			$allTotal->totalCustomerRetreat +=  $user->totalCustomerRetreat;
			$allTotal->selfExtraCommission +=  $user->selfExtraCommission;
			$allTotal->selfRetreat +=  $user->selfRetreat;
			$allTotal->receiveBot +=  $user->receiveBot;
			$allTotal->giveTop +=  $user->giveTop;
			$allTotal->winlose +=  $user->winlose;
		}
		
        return $this->view->render('all_calc_agent_report_manager',[
			'sddate'=>$sddate,
			'eddate'=>$eddate,
			'sdtime'=>$sdtime,
			'edtime'=>$edtime,
			'users'=>$users,
			'allTotal'=>$allTotal,
			'pid'=>$pid,
			'last_pid'=>$last_pid,
			'search_member'=>$search_member,
		]);
	}

	public function allCalcAgentReportManagerV2($request, $response)
    {
		ini_set('memory_limit', -1);
		$get = $request->getQueryParams();

		$search_member = isset($get['search_member']) ? $get['search_member'] : 0;
		$pid = isset($get['pid']) ? $get['pid'] : 0;

		if ($pid == $_SESSION['id']) {
			$last_pid = 0;
		} else {
			$parent = User::find($pid);
			$last_pid = $parent ? $parent->pid : 0;
		}

		if ($pid) {
			$users = $this->getTargetUsers($get['pid'], $search_member);
		} else {
			//只顯示自己
			$users = $this->getTargetUser($_SESSION['id']);
		}

		
		$sddate = $get['sddate'] ?? date('Y-m-d');
        $eddate = $get['eddate'] ?? date('Y-m-d');
        $sdtime = $get['sdtime'] ?? '00:00:00';
        $edtime = $get['edtime'] ?? '23:59:59';
		$sdtime = \DateTime::createFromFormat("H:i:s", $sdtime)->format("H:i:s");
        $edtime = \DateTime::createFromFormat("H:i:s", $edtime)->format("H:i:s");
		$datetimeRange = [$sddate . ' ' . $sdtime, $eddate . ' ' . $edtime];


		foreach ($users as $k=>$user) {
			$user->resetStats();

			if ($user->role == 'customer') {
				$summarys = $this->getUserBetLogForCustomer($user, $datetimeRange);
			} else {
				$summarys = $this->geUserBetLogForAgent($user, $target ?? null, $datetimeRange);
			}
			
			if (count($summarys) > 0) {
				$this->calculateUserStatsV2($user, $summarys);
			} else {
				$users->forget($k);
			}
		}

		/*
		echo json_encode($users);
		die();
		*/
			
		//$allTotal = $this->aggregateAllTotals($users);
		$allTotal = new \stdClass;
		$allTotal->Cnt = 0;
		$allTotal->totalAmount = 0;
		$allTotal->totalValidAmount = 0;
		$allTotal->totalNetAmount = 0;
		$allTotal->totalRetreat = 0;
		$allTotal->totalCustomerRetreat = 0;
		$allTotal->selfExtraCommission = 0;
		$allTotal->selfRetreat = 0;
		$allTotal->receiveBot = 0;
		$allTotal->giveTop = 0;
		$allTotal->winlose = 0;
		$allTotal->temp = 0;
		foreach($users as $user){
			$allTotal->Cnt += $user->Cnt;
			$allTotal->totalAmount +=  $user->totalAmount;
			$allTotal->totalValidAmount +=  $user->totalValidAmount;
			$allTotal->totalNetAmount +=  $user->totalNetAmount;
			$allTotal->totalRetreat +=  $user->totalRetreat;
			$allTotal->totalCustomerRetreat +=  $user->totalCustomerRetreat;
			$allTotal->selfExtraCommission +=  $user->selfExtraCommission;
			$allTotal->selfRetreat +=  $user->selfRetreat;
			$allTotal->receiveBot +=  $user->receiveBot;
			$allTotal->giveTop +=  $user->giveTop;
			$allTotal->winlose +=  $user->winlose;
			$allTotal->temp +=  $user->temp;
		}
		
        return $this->view->render('all_calc_agent_report_manager_v2',[
			'sddate'=>$sddate,
			'eddate'=>$eddate,
			'sdtime'=>$sdtime,
			'edtime'=>$edtime,
			'users'=>$users,
			'allTotal'=>$allTotal,
			'pid'=>$pid,
			'last_pid'=>$last_pid,
			'search_member'=>$search_member,
		]);
	}

	private function getTargetUser($id)
    {
        $field = ['id', 'username', 'nickname', 'pid', 'parents', 'role', 'created_at', 'commission_rule_id', 'extra_commission_rule_id', 'retreat_rule_id'];
        return User::select($field)->where('id', $id)->get();
    }

	private function getTargetUsers($pid, $search_member=0)
    {
        $field = ['id', 'username', 'nickname', 'pid', 'parents', 'role', 'created_at', 'commission_rule_id', 'extra_commission_rule_id', 'retreat_rule_id'];
        
		if ($search_member == 1) {
            //只查詢會員
            return User::select($field)->where('pid', $pid)->where('role', 'customer')->get();
        }
		
		if ($pid == 1) {
            return User::select($field)->where('role', 'topagent')->get();
        }

        return User::select($field)->where('pid', $pid)->where('role', 'agent')->get();
    }

	private function getDateColumn(string $type): string
    {
        if ($type === '2') {
            return 'draw_time';
        }
        return 'bet_time';
    }

	private function getBetSummaryForAgent($user, $target, array $datetimeRange, string $dateTimeColumn)
    {
        [$startTime, $endTime] = $datetimeRange;

        // 判斷查詢哪些 user_id
        if ($user->role == 'agent' && isset($target) && $target->role == 'agent') {
            // 本身代理，只抓自己
            $userIds = [$user->id];
        } else {
            // 總代或代理但不是自己看的，只抓自己與下線
            $userIds = User::where('id', $user->id)
                ->orWhere('parents', 'like', '%/' . $user->id . '/%')
                ->pluck('id')
                ->toArray();
        }

        return Bet::select(
                'bets.user_id',
                'bets.game_id',
				'bets.report_date',
                DB::raw('COUNT(*) as Cnt'),
                DB::raw('SUM(Amount) as totalAmount'),
                DB::raw('SUM(valid_Amount) as totalValidAmount'),
                DB::raw('SUM(netAmount) as totalNetAmount')
            )
			->with(['user', 'game'])
            ->where('flag', 1)
            ->whereBetween("bets.{$dateTimeColumn}", [$startTime, $endTime])
            ->whereIn('bets.user_id', $userIds)
            ->groupBy('bets.user_id', 'bets.game_id', 'bets.report_date')
            ->orderBy('bets.game_id', 'desc')
            ->get();
    }

    private function getBetSummaryForCustomer($user, array $datetimeRange, string $dateTimeColumn)
    {
        [$startTime, $endTime] = $datetimeRange;

        return Bet::select(
                'bets.user_id',
                'bets.game_id',
                'bets.report_date',
                DB::raw('COUNT(*) as Cnt'),
                DB::raw('SUM(Amount) as totalAmount'),
                DB::raw('SUM(valid_Amount) as totalValidAmount'),
                DB::raw('SUM(netAmount) as totalNetAmount')
            )
			->with(['user', 'game'])
            ->where('bets.user_id', $user->id)
            ->where('flag', 1)
            ->whereBetween("bets.{$dateTimeColumn}", [$startTime, $endTime])
            ->groupBy('bets.user_id', 'bets.game_id', 'bets.report_date')
            ->orderBy('bets.game_id', 'desc')
            ->get();
    }

	private function geUserBetLogForAgent($user, $target, array $datetimeRange)
    {
        [$startTime, $endTime] = $datetimeRange;

        // 判斷查詢哪些 user_id
        if ($user->role == 'agent' && isset($target) && $target->role == 'agent') {
            // 本身代理，只抓自己
            $userIds = [$user->id];
        } else {
            // 總代或代理但不是自己看的，只抓自己與下線
            $userIds = User::where('id', $user->id)
                ->orWhere('parents', 'like', '%/' . $user->id . '/%')
                ->pluck('id')
                ->toArray();
        }

        return UserBetLog::select(
                'user_id',
                'game_id',
                'report_date',
                DB::raw('SUM(bet_count) as Cnt'),
                DB::raw('SUM(amount) as totalAmount'),
                DB::raw('SUM(valid_Amount) as totalValidAmount'),
                DB::raw('SUM(netAmount) as totalNetAmount')
            )
            ->with(['user', 'game'])
            ->whereBetween("draw_time", [$startTime, $endTime])
            ->whereIn('user_id', $userIds)
            ->groupBy('user_id', 'game_id', 'report_date')
            ->get();
    }

    private function getUserBetLogForCustomer($user, array $datetimeRange)
    {
        [$startTime, $endTime] = $datetimeRange;

        return UserBetLog::select(
                'user_id',
                'game_id',
                'report_date',
                DB::raw('SUM(bet_count) as Cnt'),
                DB::raw('SUM(amount) as totalAmount'),
                DB::raw('SUM(valid_Amount) as totalValidAmount'),
                DB::raw('SUM(netAmount) as totalNetAmount')
            )
            ->with(['user', 'game'])
            ->where('user_id', $user->id)
            ->whereBetween("draw_time", [$startTime, $endTime])
            ->groupBy('user_id', 'game_id', 'report_date')
            ->get();
    }

    private function getMoneyStatsForCustomer($user, array $datetimeRange)
    {
        [$startTime, $endTime] = $datetimeRange;

        $retreat = UserMoney::selectRaw('SUM(CASE WHEN operate_type = 1 AND trans_type IN (5) THEN money END) as retreat')
            ->where('username', $user->username)
            ->whereBetween('created_at', [$startTime, $endTime])
            ->first();

        $money_in = DepositOrder::selectRaw('SUM(apply_amount) as money_in')
            ->where('name', $user->username)
            ->where('status', 100)
            ->whereBetween('created_at', [$startTime, $endTime])
            ->first();

        $money_out = Withdraw::selectRaw('SUM(amount) as money_out')
            ->where('name', $user->username)
            ->where('status', 100)
            ->whereBetween('created_at', [$startTime, $endTime])
            ->first();

        return (object)[
            'retreat'   => floatval($retreat->retreat),
            'money_in'  => floatval($money_in->money_in),
            'money_out' => floatval($money_out->money_out),
        ];
    }

    private function getMoneyStatsForAgent($user, array $datetimeRange)
    {
        [$startTime, $endTime] = $datetimeRange;

        // 返水（user_money）
        $retreat = UserMoney::join('users', 'user_money.username', '=', 'users.username')
            ->selectRaw('SUM(CASE WHEN operate_type = 1 AND trans_type IN (5) THEN money END) as retreat')
            ->where('users.parents', 'like', '%/' . $user->id . '/%')
            ->whereBetween('user_money.created_at', [$startTime, $endTime])
            ->first();

        // 入金
        $money_in = DepositOrder::join('users', 'deposit_orders.user_id', '=', 'users.id')
            ->selectRaw('SUM(amount) as money_in')
            ->where('users.parents', 'like', '%/' . $user->id . '/%')
            ->where('deposit_orders.trans_type', 3)
            ->where('deposit_orders.order_type', 2)
            ->where('deposit_orders.status', 100)
            ->whereBetween('deposit_orders.created_at', [$startTime, $endTime])
            ->first();

        // 出金
        $money_out = Withdraw::join('users', 'withdraws.user_id', '=', 'users.id')
            ->selectRaw('SUM(actual_amount) as money_out')
            ->where('users.parents', 'like', '%/' . $user->id . '/%')
            ->where('withdraws.status', 100)
            ->whereBetween('withdraws.created_at', [$startTime, $endTime])
            ->first();

        return (object)[
            'retreat'   => floatval($retreat->retreat),
            'money_in'  => floatval($money_in->money_in),
            'money_out' => floatval($money_out->money_out),
        ];
    }

    private function calculateUserStats($user, $summarys)
    {
        $Cnt = 0;
        $totalValidAmount = 0;
        $totalNetAmount = 0;
        $totalAmount = 0;
		$totalRetreat = 0;//線下總退水

        $commission = 0;
        $extraCommission = 0;
        $retreatCommission = 0;

        $totalRetreat = 0;
        $totalCustomerRetreat = 0;
        $totalAgentRetreat = 0;
        $totalTopAgentRetreat = 0;

        $totalExtraCommission = 0;
        $totalAgentExtraCommission = 0;
        $totalTopAgentExtraCommission = 0;

        $receiveBot = 0;//應收下線
        $giveTop =0;//應繳上線

        $myReport = [];
        $childReport = [];
        $user_retreats = [];//暫存會員退水資料
        $user_extras = [];//暫存會員佔成資料
        foreach ($summarys as $row) {

            $Cnt += $row['Cnt'];
            $totalAmount     = bcadd($totalAmount, $row['totalAmount'], 2);
            $totalValidAmount = bcadd($totalValidAmount, $row['totalValidAmount'], 2);
            $totalNetAmount  = bcadd($totalNetAmount, $row['totalNetAmount'], 2);
            // echo json_encode($row) . "<br><br>";

            $amount = floatval(abs($row->totalValidAmount));
            $netAmount = floatval($row->totalNetAmount);
            //最上層要只到自己 (只需要統計自己底下的)
            $chain = $row->user->getParentChainFromBottom($row['game_id'], $user->id, $row['report_date'], $user_retreats, $user_extras);  
            //echo json_encode($chain) . "<br><br>";

            $childExtraExceed = false;//下級佔成超過上級
            $childRetreatExceed = false;//下級退水超過上級
            for ($i = 0; $i < count($chain); $i++) {
                $parent = $chain[$i]; // 父
                $child = $chain[$i + 1]; // 子
                // echo "parent: " . json_encode($parent) . "<br>";
                // echo "child: " . json_encode($child) . "<br><br>";

                //統計每個人的佔成(輸贏),退水 算出盈虧
                //------------------------------------------------------------------------------------------
                // 佔成差額
                $parentExtra = $parent->extraCommissionPercent;
                $childExtra = $child->extraCommissionPercent;
                
                $diffExtra = bcsub($parentExtra, $childExtra, 4);
                $diffExtra = bcdiv($diffExtra, 100, 4);
                $parentExtra = bcdiv($parentExtra, 100, 4);
                $childExtra = bcdiv($childExtra, 100, 4);
                $extraCommissionValue = 0;
                // echo "佔成差率: " . $diffExtra . "<br>";
                if ($diffExtra > 0) {
                    if ($parent->role === 'topagent') {
                        $extraCommissionName = 'totalTopAgentExtraCommission';
                    } elseif ($parent->role === 'agent') {
                        $extraCommissionName = 'totalAgentExtraCommission';
                    } elseif ($parent->role === 'customer') {
                        //應該不會有會員佔成
                        $extraCommissionName = 'totalCustomerExtraCommission';
                    }

                    // (會員輸贏 * -1) * 佔成%數 
                    $extraCommissionValue = bcmul($netAmount * -1, $diffExtra, 2);
                    $$extraCommissionName += $extraCommissionValue; // 這裡是可變參數名稱

                    if ($parent->id == $user->id) {
                        $myReport['extraCommission'] += $extraCommissionValue;
                    } else {
                        $childReport[$parent->id]['extraCommission'] += $extraCommissionValue;
                    }
                    
                }
                // echo "額外佣金差額: " . $extraCommissionValue . "<br>";
                // echo "<br>";
                //------------------------------------------------------------------------------------------
                // 退水差額計算

                //退水計算方式
                //會員:有效投注 * 會員退水%數 
                //代理總代:賺取退水 - 負擔退水 = (有效投注 * 個人退水差額%數 * 上級佔成%數) - (有效投注 * 下級退水%數 * 個人佔成差額%數)
                //代理:賺取退水 - 負擔退水 = (有效投注 * 代理退水差額%數 * 上級佔成%數) - (有效投注 * 會員退水%數 * 代理佔成差額%數)
                //總代:賺取退水 - 負擔退水 = (有效投注 * 總代退水差額%數 * 上級佔成%數) - (有效投注 * 代理退水%數 * 總代佔成差額%數)
                $parentRate = $parent->retreatPercent ?? 0;
                $childRate = $child->retreatPercent ?? 0;
                $diffRetreat = bcsub($parentRate, $childRate, 4);
                $diffRetreat = bcdiv($diffRetreat, 100, 4); // 除以100轉為百分比
                $parentRate = bcdiv($parentRate, 100, 4); // 除以100轉為百分比
                $childRate = bcdiv($childRate, 100, 4); // 除以100轉為百分比
                $retreatValue = 0;
                // echo "退水差率: " . $diffRetreat . "<br>";

                if ($parent->role === 'customer') {
                    //會員退水
                    //有效投注 * 會員退水%數 
                    if ($diffRetreat > 0) {
                        $retreatName = 'totalCustomerRetreat';
                        $retreatValue = bcmul($amount, $diffRetreat, 2);

                        $$retreatName = bcadd($$retreatName, $retreatValue, 2);// 這裡是可變參數名稱
                        if ($parent->id == $user->id) {
                            $myReport['retreat'] += $retreatValue;
                        } else {
                            $childReport[$parent->id]['retreat'] += $retreatValue;
                        }
                        //echo 'retreatValue:' . $retreatValue .'<br>'.'<br>';
                    }
                    
                } elseif ($parent->role === 'agent') {
                    //代理
                    //賺取退水 - 負擔退水 = (有效投注 * 代理退水差額%數 * 上級佔成%數) - (有效投注 * 會員退水%數 * 代理佔成差額%數)
                    $retreatName = 'totalAgentRetreat';
                    $earn = bcmul($amount, $diffRetreat * (1-$parentExtra), 2);
                    $afford = bcmul($amount, $childRate * $diffExtra, 2);
                    $retreatValue = bcsub($earn, $afford, 2);

                    $$retreatName = bcadd($$retreatName, $retreatValue, 2);// 這裡是可變參數名稱
                    if ($parent->id == $user->id) {
                        $myReport['retreat'] += $retreatValue;
                    } else {
                        $childReport[$parent->id]['retreat'] += $retreatValue;
                    }
                    //echo 'amount:' . $amount .'<br>';
                    //echo 'earn:' . $earn .'<br>';
                    //echo 'afford:' . $afford .'/'.$amount.'*'.$childRate.'*'.$diffExtra.'<br>';
                    //echo 'retreatValue:' . $retreatValue .'<br>'.'<br>';
                } elseif ($parent->role === 'topagent') {
                    //總代理
                    //賺取退水 - 負擔退水 = (有效投注 * 總代退水差額%數 * 上級佔成%數) - (有效投注 * 代理退水%數 * 總代佔成差額%數)
                    $retreatName = 'totalTopAgentRetreat';
                    $earn = bcmul($amount, $diffRetreat * (1-$parentExtra), 2);
                    $afford = bcmul($amount, $childRate * $diffExtra, 2);
                    $retreatValue = bcsub($earn, $afford, 2);

                    $$retreatName = bcadd($$retreatName, $retreatValue, 2);// 這裡是可變參數名稱
                    if ($parent->id == $user->id) {
                        $myReport['retreat'] += $retreatValue;
                    } else {
                        $childReport[$parent->id]['retreat'] += $retreatValue;
                    }
                    //echo 'amount:' . $amount .'<br>';
                    //echo 'earn:' . $earn .'<br>';
                    //echo 'afford:' . $afford .'<br>';
                    //echo 'retreatValue:' . $retreatValue .'<br>'.'<br>';
                }
                //admin 的負擔退水
                if ($user->id == 1 && $i ==0 && $parent->role === 'topagent') {
                    //admin
                    //賺取退水 - 負擔退水 = 0 - (有效投注 * 總代退水%數 * (1 - 總代佔成)%數)
                    $retreatName = 'adminRetreat';
                    $earn = 0;
                    $afford = bcmul($amount, $parentRate * (1-$parentExtra), 2);
                    $retreatValue = bcsub($earn, $afford, 2);
                    $$retreatName = bcadd($$retreatName, $retreatValue, 2);// 這裡是可變參數名稱

                    $myReport['retreat'] += $retreatValue;
                }
				//線下總退水
                if ($parent->id == $user->id) {
                    $totalRetreat += bcmul($amount, $parentRate, 2);
                }
                // echo "退水差額: " . $retreatValue . "<br>";
                //------------------------------------------------------------------------------------------

                //各個遊戲廠商的詳細內容
                if ($parent->id == $user->id) {
                    $details[$user->id][$row['game_id'].'/'.$row['report_date']]['parent_id'] = $parent->id;
                    $details[$user->id][$row['game_id'].'/'.$row['report_date']]['report_date'] = $row['report_date'];
                    $details[$user->id][$row['game_id'].'/'.$row['report_date']]['parent_username'] = $parent->username ?? '';
                    $details[$user->id][$row['game_id'].'/'.$row['report_date']]['retreatRate'] = floatval(bcmul($parentRate, 100, 4));
                    $details[$user->id][$row['game_id'].'/'.$row['report_date']]['extraRate'] = floatval(bcmul($parentExtra, 100, 4));
                    $details[$user->id][$row['game_id'].'/'.$row['report_date']]['game_id'] = $row['game_id'];
                    $details[$user->id][$row['game_id'].'/'.$row['report_date']]['game_name'] = $row->game->name;
                    $details[$user->id][$row['game_id'].'/'.$row['report_date']]['totalAmount'] += floatval($row['totalAmount']);
                    $details[$user->id][$row['game_id'].'/'.$row['report_date']]['amount'] += $amount;
                    $details[$user->id][$row['game_id'].'/'.$row['report_date']]['netAmount'] += $netAmount;
                    $details[$user->id][$row['game_id'].'/'.$row['report_date']]['retreatValue'] += $retreatValue * -1;
                    $details[$user->id][$row['game_id'].'/'.$row['report_date']]['extraCommissionValue'] += $extraCommissionValue * -1;
                    
					//不知道啥bug 所以改成這樣
					if (isset($details[$user->id][$row['game_id'].'/'.$row['report_date']]['totalRetreat'])) {
						$details[$user->id][$row['game_id'].'/'.$row['report_date']]['totalRetreat'] += bcmul($amount, $parentRate, 2);
					} else {
						$details[$user->id][$row['game_id'].'/'.$row['report_date']]['totalRetreat'] = 0;
						$details[$user->id][$row['game_id'].'/'.$row['report_date']]['totalRetreat'] += bcmul($amount, $parentRate, 2);
					}

					$details[$user->id][$row['game_id'].'/'.$row['report_date']]['totalAmount'] = round($details[$user->id][$row['game_id'].'/'.$row['report_date']]['totalAmount'], 2);
					$details[$user->id][$row['game_id'].'/'.$row['report_date']]['amount'] = round($details[$user->id][$row['game_id'].'/'.$row['report_date']]['amount'], 2);
					$details[$user->id][$row['game_id'].'/'.$row['report_date']]['netAmount'] = round($details[$user->id][$row['game_id'].'/'.$row['report_date']]['netAmount'], 2);
                    $details[$user->id][$row['game_id'].'/'.$row['report_date']]['retreatValue'] = round($details[$user->id][$row['game_id'].'/'.$row['report_date']]['retreatValue'], 2);
                    $details[$user->id][$row['game_id'].'/'.$row['report_date']]['extraCommissionValue'] = round($details[$user->id][$row['game_id'].'/'.$row['report_date']]['extraCommissionValue'], 2);
                    $details[$user->id][$row['game_id'].'/'.$row['report_date']]['totalRetreat'] = round($details[$user->id][$row['game_id'].'/'.$row['report_date']]['totalRetreat'], 2);
                }
                //admin 遊戲廠商的詳細內容
                if ($user->id == 1 && $i ==0&& $parent->role === 'topagent') {
                    $details[$user->id][$row['game_id'].'/'.$row['report_date']]['parent_id'] = $user->id;
                    $details[$user->id][$row['game_id'].'/'.$row['report_date']]['report_date'] = $row['report_date'];
                    $details[$user->id][$row['game_id'].'/'.$row['report_date']]['parent_username'] = $parent->username ?? '';
                    $details[$user->id][$row['game_id'].'/'.$row['report_date']]['retreatRate'] = '-';
                    $details[$user->id][$row['game_id'].'/'.$row['report_date']]['extraRate'] = '-';
                    $details[$user->id][$row['game_id'].'/'.$row['report_date']]['game_id'] = $row['game_id'];
                    $details[$user->id][$row['game_id'].'/'.$row['report_date']]['game_name'] = $row->game->name;
                    $details[$user->id][$row['game_id'].'/'.$row['report_date']]['totalAmount'] += floatval($row['totalAmount']);
                    $details[$user->id][$row['game_id'].'/'.$row['report_date']]['amount'] += $amount;
                    $details[$user->id][$row['game_id'].'/'.$row['report_date']]['netAmount'] += $netAmount;
                    $details[$user->id][$row['game_id'].'/'.$row['report_date']]['retreatValue'] += $retreatValue * -1;
                    $details[$user->id][$row['game_id'].'/'.$row['report_date']]['extraCommissionValue'] = 0;
                    $details[$user->id][$row['game_id'].'/'.$row['report_date']]['totalRetreat'] = 0;

                    $details[$user->id][$row['game_id'].'/'.$row['report_date']]['totalAmount'] = round($details[$user->id][$row['game_id'].'/'.$row['report_date']]['totalAmount'], 2);
					$details[$user->id][$row['game_id'].'/'.$row['report_date']]['amount'] = round($details[$user->id][$row['game_id'].'/'.$row['report_date']]['amount'], 2);
					$details[$user->id][$row['game_id'].'/'.$row['report_date']]['netAmount'] = round($details[$user->id][$row['game_id'].'/'.$row['report_date']]['netAmount'], 2);
                    $details[$user->id][$row['game_id'].'/'.$row['report_date']]['retreatValue'] = round($details[$user->id][$row['game_id'].'/'.$row['report_date']]['retreatValue'], 2);
                }
                // echo json_encode($row) . "<br><br>";
            }
        }

        // 預設所有都歸零
        $user->Cnt = $Cnt;
        $user->totalValidAmount = round($totalValidAmount, 2);
        $user->totalNetAmount   = round($totalNetAmount, 2);
        $user->totalAmount      = round($totalAmount, 2);
		$user->totalRetreat      = round($totalRetreat, 2);

        // 佣金處理（只有代理 & 總代才有）
        $user->commission = 0;
        $user->extraCommission = 0;
        $user->retreatCommission  = 0;

        $user->totalAgentExtraCommission = $totalAgentExtraCommission;
        $user->totalTopAgentExtraCommission = $totalTopAgentExtraCommission;

        $user->totalCustomerRetreat = $totalCustomerRetreat;
        $user->totalAgentRetreat = $totalAgentRetreat;
        $user->totalTopAgentRetreat = $totalTopAgentRetreat;
        $user->details = $details;

        //實際計算 
        //echo 'my:'.json_encode($myReport) . "<br><br>";
        //echo 'child:'.json_encode($childReport) . "<br><br>";
        //個人佔成
        $user->selfExtraCommission = isset($myReport['extraCommission'])?$myReport['extraCommission']:0;
        //個人退水
        $user->selfRetreat = isset($myReport['retreat'])?$myReport['retreat']:0;
        //個人盈虧
        if ($user->role == 'customer') {
            //個人輸贏 + 個人退水
            $user->winlose = $totalNetAmount  + $user->selfRetreat;
        } else {
            //個人佔成 + 個人退水
            $user->winlose = $user->selfExtraCommission  + $user->selfRetreat;
        }
        //應收下線
        if ($user->role == 'customer') {
            $user->receiveBot = 0;
        } else {
            //(會員輸贏+下線所有退水+下線所有佔成) * -1;
            $user->receiveBot = 0;
            $user->receiveBot += $totalNetAmount;
            foreach ($childReport as $item) {
                $user->receiveBot += isset($item['extraCommission'])?$item['extraCommission']:0;
                $user->receiveBot += isset($item['retreat'])?$item['retreat']:0;
            }
            $user->receiveBot *= -1;
        }
        //應繳上線 = (應收 - 盈虧) * -1 
        $user->giveTop = ($user->receiveBot - $user->winlose) * -1;

        //總後台另外定義
        if ($user->role == 'admin') {
            $user->giveTop = 0;
            $user->selfExtraCommission = 0;
            $user->winlose =  $user->receiveBot;
        } 


        $user->receiveBot = round($user->receiveBot, 2) * -1;
        $user->giveTop = round($user->giveTop, 2) * -1;
        $user->winlose = round($user->winlose, 2) * -1;
        $user->selfExtraCommission = round($user->selfExtraCommission, 2) * -1;
        $user->selfRetreat = round($user->selfRetreat, 2) * -1;

        //會員數量
        $user->memerb_cnt = User::where('pid', $user->id)->where('role', 'customer')->count();
        return $user;
    }

	private function calculateUserStatsV2($user, $summarys)
    {
        $Cnt = 0;
        $totalValidAmount = 0;
        $totalNetAmount = 0;
        $totalAmount = 0;
		$totalRetreat = 0;//線下總退水

        $commission = 0;
        $extraCommission = 0;
        $retreatCommission = 0;

        $totalRetreat = 0;
		$adminTotalRetreat = 0; //控端總退水: 總代理總退水的總和
        $totalCustomerRetreat = 0;
        $totalAgentRetreat = 0;
        $totalTopAgentRetreat = 0;
		$adminRetreat = 0;

        $totalExtraCommission = 0;
        $totalAgentExtraCommission = 0;
        $totalTopAgentExtraCommission = 0;

        $receiveBot = 0;//應收下線
        $giveTop =0;//應繳上線

		$details = []; 
		$myReport = ['extraCommission' => 0, 'retreat' => 0];
		$childReport = [];
        //暫存陣列
        $ruleCache = [
            'users'   => [],
            'retreat' => [],
            'extra'   => [],
        ];
        //先收集「所有 user_ids」
        $allUserIds = [];
        foreach ($summarys as $row) {
            foreach (
                explode('/', trim($row->user->parents . '/' . $row->user->id, '/'))
                as $id
            ) {
                $id = (int)$id;
                if ($id !== 1) {
                    $allUserIds[$id] = 1; // 去重
                }
            }
        }
        $allUserIds = array_keys($allUserIds);

        //preload 所有 users
        $ruleCache['users'] = User::whereIn('id', $allUserIds)
            ->select('id', 'username', 'role', 'pid', 'parents', 'level')
            ->get()
            ->keyBy('id');
        

        //preload 規則
        $ruleCache['retreat'] = RetreatRule::with([
                'ruleDetailsGames' => fn($q) =>
                    $q->select('retreat_rule_id', 'game_id', 'percent')
            ])
            ->whereIn('user_id', $allUserIds)
            ->orderBy('init_date', 'desc')
            ->get()
            ->groupBy('user_id');
    
        $ruleCache['extra'] = ExtraCommissionRule::with([
                'ruleDetailsGames' => fn($q) =>
                    $q->select('extra_commission_rule_id', 'game_id', 'percent')
            ])
            ->whereIn('user_id', $allUserIds)
            ->orderBy('init_date', 'desc')
            ->get()
            ->groupBy('user_id');
    

        //echo json_encode( $ruleCache).'<br>';

        ///開始計算
        foreach ($summarys as $row) {

            $Cnt += $row['Cnt'];
            $totalAmount     = bcadd($totalAmount, $row['totalAmount'], 2);
            $totalValidAmount = bcadd($totalValidAmount, $row['totalValidAmount'], 2);
            $totalNetAmount  = bcadd($totalNetAmount, $row['totalNetAmount'], 2);
            // echo json_encode($row) . "<br><br>";

            $amount = floatval(abs($row->totalValidAmount));
            $netAmount = floatval($row->totalNetAmount);
            //最上層要只到自己 (只需要統計自己底下的)
            $chain = $row->user->getParentChainFromBottomV2($row['game_id'], $user->id, $row['report_date'], $ruleCache);  
            //echo json_encode($chain) . "<br><br>";
            $childExtraExceed = false;//下級佔成超過上級
            $childRetreatExceed = false;//下級退水超過上級
            for ($i = 0; $i < count($chain); $i++) {
                $parent = $chain[$i]; // 父
                $child = $chain[$i + 1]; // 子
                // echo "parent: " . json_encode($parent) . "<br>";
                // echo "child: " . json_encode($child) . "<br><br>";

                //統計每個人的佔成(輸贏),退水 算出盈虧
                //------------------------------------------------------------------------------------------
                // 佔成差額
                $parentExtra = $parent->extraCommissionPercent;
                $childExtra = $child->extraCommissionPercent;
                
                $diffExtra = bcsub($parentExtra, $childExtra, 4);
                $diffExtra = bcdiv($diffExtra, 100, 4);
                $parentExtra = bcdiv($parentExtra, 100, 4);
                $childExtra = bcdiv($childExtra, 100, 4);
                $extraCommissionValue = 0;
                // echo "佔成差率: " . $diffExtra . "<br>";
                if ($diffExtra > 0) {
                    if ($parent->role === 'topagent') {
                        $extraCommissionName = 'totalTopAgentExtraCommission';
                    } elseif ($parent->role === 'agent') {
                        $extraCommissionName = 'totalAgentExtraCommission';
                    } elseif ($parent->role === 'customer') {
                        //應該不會有會員佔成
                        $extraCommissionName = 'totalCustomerExtraCommission';
                    }

                    // (會員輸贏 * -1) * 佔成%數 
                    $extraCommissionValue = bcmul($netAmount * -1, $diffExtra, 2);
                    $$extraCommissionName += $extraCommissionValue; // 這裡是可變參數名稱

                    if ($parent->id == $user->id) {
                        $myReport['extraCommission'] += $extraCommissionValue;
                    } else {
                        $childReport[$parent->id]['extraCommission'] += $extraCommissionValue;
                    }
                    
                }
                // echo "額外佣金差額: " . $extraCommissionValue . "<br>";
                // echo "<br>";
                //------------------------------------------------------------------------------------------
                // 退水差額計算

                //退水計算方式
                //會員:有效投注 * 會員退水%數 
                //代理總代:賺取退水 - 負擔退水 = (有效投注 * 個人退水差額%數 * 上級佔成%數) - (有效投注 * 下級退水%數 * 個人佔成差額%數)
                //代理:賺取退水 - 負擔退水 = (有效投注 * 代理退水差額%數 * 上級佔成%數) - (有效投注 * 會員退水%數 * 代理佔成差額%數)
                //總代:賺取退水 - 負擔退水 = (有效投注 * 總代退水差額%數 * 上級佔成%數) - (有效投注 * 代理退水%數 * 總代佔成差額%數)
                $parentRate = $parent->retreatPercent ?? 0;
                $childRate = $child->retreatPercent ?? 0;
                $diffRetreat = bcsub($parentRate, $childRate, 4);
                $diffRetreat = bcdiv($diffRetreat, 100, 4); // 除以100轉為百分比
                $parentRate = bcdiv($parentRate, 100, 4); // 除以100轉為百分比
                $childRate = bcdiv($childRate, 100, 4); // 除以100轉為百分比
                $retreatValue = 0;
                // echo "退水差率: " . $diffRetreat . "<br>";

                if ($parent->role === 'customer') {
                    //會員退水
                    //有效投注 * 會員退水%數 
                    if ($diffRetreat > 0) {
                        $retreatName = 'totalCustomerRetreat';
                        $retreatValue = bcmul($amount, $diffRetreat, 2);

                        $$retreatName = bcadd($$retreatName, $retreatValue, 2);// 這裡是可變參數名稱
                        if ($parent->id == $user->id) {
                            $myReport['retreat'] += $retreatValue;
                        } else {
                            $childReport[$parent->id]['retreat'] += $retreatValue;
                        }
                        //echo 'retreatValue:' . $retreatValue .'<br>'.'<br>';
                    }
                    
                } elseif ($parent->role === 'agent') {
                    //代理
                    //賺取退水 - 負擔退水 = (有效投注 * 代理退水差額%數 * 上級佔成%數) - (有效投注 * 會員退水%數 * 代理佔成差額%數)
                    $retreatName = 'totalAgentRetreat';
                    $earn = bcmul($amount, $diffRetreat * (1-$parentExtra), 2);
                    $afford = bcmul($amount, $childRate * $diffExtra, 2);
                    $retreatValue = bcsub($earn, $afford, 2);

                    $$retreatName = bcadd($$retreatName, $retreatValue, 2);// 這裡是可變參數名稱
                    if ($parent->id == $user->id) {
                        $myReport['retreat'] += $retreatValue;
                    } else {
                        $childReport[$parent->id]['retreat'] += $retreatValue;
                    }
                    //echo 'amount:' . $amount .'<br>';
                    //echo 'earn:' . $earn .'<br>';
                    //echo 'afford:' . $afford .'/'.$amount.'*'.$childRate.'*'.$diffExtra.'<br>';
                    //echo 'retreatValue:' . $retreatValue .'<br>'.'<br>';
                } elseif ($parent->role === 'topagent') {
                    //總代理
                    //賺取退水 - 負擔退水 = (有效投注 * 總代退水差額%數 * 上級佔成%數) - (有效投注 * 代理退水%數 * 總代佔成差額%數)
                    $retreatName = 'totalTopAgentRetreat';
                    $earn = bcmul($amount, $diffRetreat * (1-$parentExtra), 2);
                    $afford = bcmul($amount, $childRate * $diffExtra, 2);
                    $retreatValue = bcsub($earn, $afford, 2);

                    $$retreatName = bcadd($$retreatName, $retreatValue, 2);// 這裡是可變參數名稱
                    if ($parent->id == $user->id) {
                        $myReport['retreat'] += $retreatValue;
                    } else {
                        $childReport[$parent->id]['retreat'] += $retreatValue;
                    }
                    //echo 'amount:' . $amount .'<br>';
                    //echo 'earn:' . $earn .'<br>';
                    //echo 'afford:' . $afford .'<br>';
                    //echo 'retreatValue:' . $retreatValue .'<br>'.'<br>';
                }
                //admin 的負擔退水
                if ($user->id == 1 && $i ==0 && $parent->role === 'topagent') {
                    //admin
                    //賺取退水 - 負擔退水 = 0 - (有效投注 * 總代退水%數 * (1 - 總代佔成)%數)
                    $retreatName = 'adminRetreat';
                    $earn = 0;
                    $afford = bcmul($amount, $parentRate * (1-$parentExtra), 2);
                    $retreatValue = bcsub($earn, $afford, 2);
                    $$retreatName = bcadd($$retreatName, $retreatValue, 2);// 這裡是可變參數名稱

                    $myReport['retreat'] += $retreatValue;

					//控端總退水: 總代理總退水的總和
                    $adminTotalRetreat += bcmul($amount, $parentRate, 2);
                }
				//線下總退水
                if ($parent->id == $user->id) {
                    $totalRetreat += bcmul($amount, $parentRate, 2);
                }
                // echo "退水差額: " . $retreatValue . "<br>";
                //------------------------------------------------------------------------------------------

                //各個遊戲廠商的詳細內容
                if ($parent->id == $user->id) {
					// 確保路徑存在，避免 502
					if (!isset($details[$user->id])) $details[$user->id] = [];
					if (!isset($details[$user->id][$row['game_id']])) $details[$user->id][$row['game_id']] = [];

                    $details[$user->id][$row['game_id']]['parent_id'] = $parent->id;
                    $details[$user->id][$row['game_id']]['report_date'] = $row['report_date'];
                    $details[$user->id][$row['game_id']]['parent_username'] = $parent->username ?? '';
                    $details[$user->id][$row['game_id']]['retreatRate'] = floatval(bcmul($parentRate, 100, 4));
                    $details[$user->id][$row['game_id']]['extraRate'] = floatval(bcmul($parentExtra, 100, 4));
                    $details[$user->id][$row['game_id']]['game_id'] = $row['game_id'];
                    $details[$user->id][$row['game_id']]['game_name'] = $row->game->name;

					if (isset($details[$user->id][$row['game_id']]['Cnt'])) {
						$details[$user->id][$row['game_id']]['Cnt'] += floatval($row['Cnt']);
					} else {
						$details[$user->id][$row['game_id']]['Cnt'] = 0;
						$details[$user->id][$row['game_id']]['Cnt'] += floatval($row['Cnt']);
					}

					if (isset($details[$user->id][$row['game_id']]['totalAmount'])) {
						$details[$user->id][$row['game_id']]['totalAmount'] += floatval($row['totalAmount']);
					} else {
						$details[$user->id][$row['game_id']]['totalAmount'] = 0;
						$details[$user->id][$row['game_id']]['totalAmount'] += floatval($row['totalAmount']);
					}

					if (isset($details[$user->id][$row['game_id']]['amount'])) {
						$details[$user->id][$row['game_id']]['amount'] += $amount;
					} else {
						$details[$user->id][$row['game_id']]['amount'] = 0;
						$details[$user->id][$row['game_id']]['amount'] += $amount;
					}

					if (isset($details[$user->id][$row['game_id']]['netAmount'])) {
						$details[$user->id][$row['game_id']]['netAmount'] += $netAmount;
					} else {
						$details[$user->id][$row['game_id']]['netAmount'] = 0;
						$details[$user->id][$row['game_id']]['netAmount'] += $netAmount;
					}

					if (isset($details[$user->id][$row['game_id']]['retreatValue'])) {
						$details[$user->id][$row['game_id']]['retreatValue'] += $retreatValue * -1;
					} else {
						$details[$user->id][$row['game_id']]['retreatValue'] = 0;
						$details[$user->id][$row['game_id']]['retreatValue'] += $retreatValue * -1;
					}

					if (isset($details[$user->id][$row['game_id']]['extraCommissionValue'])) {
						$details[$user->id][$row['game_id']]['extraCommissionValue'] += $extraCommissionValue * -1;
					} else {
						$details[$user->id][$row['game_id']]['extraCommissionValue'] = 0;
						$details[$user->id][$row['game_id']]['extraCommissionValue'] += $extraCommissionValue * -1;
					}

					if (isset($details[$user->id][$row['game_id']]['totalRetreat'])) {
						$details[$user->id][$row['game_id']]['totalRetreat'] += bcmul($amount, $parentRate, 2);
					} else {
						$details[$user->id][$row['game_id']]['totalRetreat'] = 0;
						$details[$user->id][$row['game_id']]['totalRetreat'] += bcmul($amount, $parentRate, 2);
					}

					$details[$user->id][$row['game_id']]['totalAmount'] = round($details[$user->id][$row['game_id']]['totalAmount'], 2);
					$details[$user->id][$row['game_id']]['amount'] = round($details[$user->id][$row['game_id']]['amount'], 2);
					$details[$user->id][$row['game_id']]['netAmount'] = round($details[$user->id][$row['game_id']]['netAmount'], 2);
                    $details[$user->id][$row['game_id']]['retreatValue'] = round($details[$user->id][$row['game_id']]['retreatValue'], 2);
                    $details[$user->id][$row['game_id']]['extraCommissionValue'] = round($details[$user->id][$row['game_id']]['extraCommissionValue'], 2);
                    $details[$user->id][$row['game_id']]['totalRetreat'] = round($details[$user->id][$row['game_id']]['totalRetreat'], 2);
                }
                //admin 遊戲廠商的詳細內容
                if ($user->id == 1 && $i ==0&& $parent->role === 'topagent') {
                    $details[$user->id][$row['game_id']]['parent_id'] = $user->id;
					$details[$user->id][$row['game_id']]['Cnt'] += floatval($row['Cnt']);
                    $details[$user->id][$row['game_id']]['report_date'] = $row['report_date'];
                    $details[$user->id][$row['game_id']]['parent_username'] = $parent->username ?? '';
                    $details[$user->id][$row['game_id']]['retreatRate'] = '-';
                    $details[$user->id][$row['game_id']]['extraRate'] = '-';
                    $details[$user->id][$row['game_id']]['game_id'] = $row['game_id'];
                    $details[$user->id][$row['game_id']]['game_name'] = $row->game->name;
                    $details[$user->id][$row['game_id']]['totalAmount'] += floatval($row['totalAmount']);
                    $details[$user->id][$row['game_id']]['amount'] += $amount;
                    $details[$user->id][$row['game_id']]['netAmount'] += $netAmount;
                    $details[$user->id][$row['game_id']]['retreatValue'] += $retreatValue * -1;
                    $details[$user->id][$row['game_id']]['extraCommissionValue'] = 0;
                    $details[$user->id][$row['game_id']]['totalRetreat'] = 0;

                    $details[$user->id][$row['game_id']]['totalAmount'] = round($details[$user->id][$row['game_id']]['totalAmount'], 2);
					$details[$user->id][$row['game_id']]['amount'] = round($details[$user->id][$row['game_id']]['amount'], 2);
					$details[$user->id][$row['game_id']]['netAmount'] = round($details[$user->id][$row['game_id']]['netAmount'], 2);
                    $details[$user->id][$row['game_id']]['retreatValue'] = round($details[$user->id][$row['game_id']]['retreatValue'], 2);
                }
                // echo json_encode($row) . "<br><br>";
            }
        }

        // 預設所有都歸零
        $user->Cnt = $Cnt;
        $user->totalValidAmount = round($totalValidAmount, 2);
        $user->totalNetAmount   = round($totalNetAmount, 2);
        $user->totalAmount      = round($totalAmount, 2);
		$user->totalRetreat      = round($totalRetreat, 2);

        // 佣金處理（只有代理 & 總代才有）
        $user->commission = 0;
        $user->extraCommission = 0;
        $user->retreatCommission  = 0;

        $user->totalAgentExtraCommission = $totalAgentExtraCommission;
        $user->totalTopAgentExtraCommission = $totalTopAgentExtraCommission;

        $user->totalCustomerRetreat = $totalCustomerRetreat;
        $user->totalAgentRetreat = $totalAgentRetreat;
        $user->totalTopAgentRetreat = $totalTopAgentRetreat;
        $user->details = $details;

        //實際計算 
        //echo 'my:'.json_encode($myReport) . "<br><br>";
        //echo 'child:'.json_encode($childReport) . "<br><br>";
        //個人佔成
        $user->selfExtraCommission = isset($myReport['extraCommission'])?$myReport['extraCommission']:0;
        //個人退水
        $user->selfRetreat = isset($myReport['retreat'])?$myReport['retreat']:0;
        //個人盈虧
        if ($user->role == 'customer') {
            //個人輸贏 + 個人退水
            $user->winlose = $totalNetAmount  + $user->selfRetreat;
        } else {
            //個人佔成 + 個人退水
            $user->winlose = $user->selfExtraCommission  + $user->selfRetreat;
        }
        //應收下線
        if ($user->role == 'customer') {
            $user->receiveBot = 0;
        } else {
            //(會員輸贏+下線所有退水+下線所有佔成) * -1;
            $user->receiveBot = 0;
            $user->receiveBot += $totalNetAmount;
            foreach ($childReport as $item) {
                $user->receiveBot += isset($item['extraCommission'])?$item['extraCommission']:0;
                $user->receiveBot += isset($item['retreat'])?$item['retreat']:0;
            }
            $user->receiveBot *= -1;
        }
        //應繳上線 = (應收 - 盈虧) * -1 
        $user->giveTop = ($user->receiveBot - $user->winlose) * -1;

        //總後台另外定義
        if ($user->role == 'admin') {
            $user->giveTop = 0;
            $user->selfExtraCommission = 0;
            $user->winlose =  $user->receiveBot;
			$user->totalRetreat = round($adminTotalRetreat, 2);
        } 

		$user->temp = round($user->totalNetAmount + $user->totalRetreat, 2);
        $user->receiveBot = round($user->receiveBot, 2) * -1;
        $user->giveTop = round($user->giveTop, 2) * -1;
        $user->winlose = round($user->winlose, 2) * -1;
        $user->selfExtraCommission = round($user->selfExtraCommission, 2) * -1;
        $user->selfRetreat = round($user->selfRetreat, 2) * -1;

        //會員數量
        $user->memerb_cnt = User::where('pid', $user->id)->where('role', 'customer')->count();
        return $user;
    }

    private function aggregateAllTotals($userList)
    {
        $total = [
            'user_name'             => '總計',
            'totalAmount'           => 0,
            'totalValidAmount'      => 0,
            'totalNetAmount'        => 0,
            'totalWinlose'          => 0,
            'money_in'              => 0,
            'money_out'             => 0,
            'retreat'               => 0,
            'self_commission'       => 0,
            'children_commission'   => 0,
            'total_commission'      => 0,
        ];
    
        foreach ($userList as $user) {
            $total['totalAmount']           += $user->totalAmount ?? 0;
            $total['totalValidAmount']      += $user->totalValidAmount ?? 0;
            $total['totalNetAmount']        += $user->totalNetAmount ?? 0;
            $total['totalWinlose']          += $user->totalWinlose ?? 0;
            $total['money_in']              += $user->money_in ?? 0;
            $total['money_out']             += $user->money_out ?? 0;
            $total['retreat']               += $user->retreat ?? 0;
            $total['self_commission']       += $user->self_commission ?? 0;
            $total['children_commission']   += $user->children_commission ?? 0;
            $total['total_commission']      += $user->total_commission ?? 0;
        }
    
        return $total;
    }
}
