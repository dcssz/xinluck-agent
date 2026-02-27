<?php
namespace App\Controllers;

use Illuminate\Database\Capsule\Manager as DB;
use stdClass;
use Interop\Container\ContainerInterface;
use App\Extensions\AdminBase;
use App\Extensions\Functions;
use App\Extensions\Language;
use App\Models\News as NewsModel;
use App\Models\Marquees as MarqueesModel;
use App\Models\SiteMessage as SiteMessageModel;
use App\Models\Config as ConfigModel;
use App\Models\Register as RegisterModel;
use App\Models\User as User;
use App\Models\Bet;
use App\Models\UserMoney;
use App\Models\Menu;
use App\Models\SystemNotice;
use App\Models\UserBank; 
use App\Models\Banner;
use App\Models\BannerLocal;
use App\Models\Payment;
use App\Models\DiscountCategory;
use App\Models\Discount;
use App\Models\DiscountLocal;
use App\Models\WithdrawAudit;
use App\Models\UserIp;
use App\Models\CusBank;
use App\Models\Withdraw;
use App\Models\GameStoreType;

use App\Extensions\Util;
use App\Models\Game;

class Admin extends AdminBase
{
	public function __Construct(ContainerInterface $container)
    {
		parent::__Construct($container);
	}

	public function index($request, $response, $args)
    {
		if(!isset($_SESSION['id'])){
			header("Location:/agent/login");
			return;
		}
        return $this->view->render('index');
	}

	public function home($request, $response, $args)
    {
		$totalBalance =  User::sum('balance');
		 
		$totalUser = User::count();
		$begin = date('Y-m-d 00:00:00');
		$end = date('Y-m-d 23:59:59');
		$where =array();
		$where[] = array('created_at','>=',$begin);
		$where[] = array('created_at','<=',$end);
		$totalTodayUser = User::where($where)->count();
		$where =array();
		$where[] = array('updated_at','>=',$begin);
		$where[] = array('updated_at','<=',$end);
		$totalTodayOnline = User::where($where)->count();
		$totalTodayDeposit = 0;
		$totalTodayWithdraw = 0;
		$totalTodayOrderAmount = 0;
		$totalTodayWinlose = 0;

	 
        return $this->view->render('home',[
			'totalBalance' =>$totalBalance,
			'totalUser' =>$totalUser,
			'totalTodayUser' =>$totalTodayUser,
			'totalTodayOnline' =>$totalTodayOnline,
			'totalTodayDeposit' =>$totalTodayDeposit,
			'totalTodayWithdraw' =>$totalTodayWithdraw,
			'totalTodayOrderAmount' =>$totalTodayOrderAmount,
			'totalTodayWinlose' =>$totalTodayWinlose,
		]);
	}

	public function news($request, $response)
    {
        return $this->view->render('news');
	}

	public function newsEditor($request, $response)
    {
		//$post = $request->getParsedBody();
		$get = $request->getQueryParams();
		$etype = $get['etype'];
		$news = new NewsModel;
		if ($etype == 'edit') {
			//编辑
			$news = NewsModel::find(intval($get['edit_news_id']));
			
		} else {
			//新增
		}
        return $this->view->render('news_editor',['news'=>$news,'title'=>'editor']);
	}

	public function marquee($request, $response)
    {
        return $this->view->render('marquee_manager');
	}

	public function banner($request, $response)
    {
        return $this->view->render('banner_manager');
	}

	public function register($request, $response)
    {
		$registers = RegisterModel::all();
		$datas = array();
		foreach ($registers as $item) {
			$datas[$item->name] = $item;
		}
        return $this->view->render('register_manager',['datas'=>$datas]);
	}

	public function saveRegister($request, $response)
    {
		$post = $request->getParsedBody();

		RegisterModel::where('name', 'customer_name')
		->update(['is_show' => isset($post['config_content']['customer_name']['display']) ?: 0
		, 'is_required' => isset($post['config_content']['customer_name']['required']) ?: 0]);

		RegisterModel::where('name', 'birthday')
		->update(['is_show' => isset($post['config_content']['birthday']['display']) ?: 0
		, 'is_required' => isset($post['config_content']['birthday']['required']) ?: 0]);

		RegisterModel::where('name', 'cell_phone')
		->update(['is_show' => isset($post['config_content']['cell_phone']['display']) ?: 0
		, 'is_required' => isset($post['config_content']['cell_phone']['required']) ?: 0]);

		RegisterModel::where('name', 'email')
		->update(['is_show' => isset($post['config_content']['email']['display']) ?: 0
		, 'is_required' => isset($post['config_content']['email']['required']) ?: 0]);

		RegisterModel::where('name', 'line')
		->update(['is_show' => isset($post['config_content']['line']['display']) ?: 0
		, 'is_required' => isset($post['config_content']['line']['required']) ?: 0]);

		RegisterModel::where('name', 'telegram')
		->update(['is_show' => isset($post['config_content']['telegram']['display']) ?: 0
		, 'is_required' => isset($post['config_content']['telegram']['required']) ?: 0]);

		RegisterModel::where('name', 'instagram')
		->update(['is_show' => isset($post['config_content']['instagram']['display']) ?: 0
		, 'is_required' => isset($post['config_content']['instagram']['required']) ?: 0]);

		RegisterModel::where('name', 'qq')
		->update(['is_show' => isset($post['config_content']['qq']['display']) ?: 0
		, 'is_required' => isset($post['config_content']['qq']['required']) ?: 0]);

		RegisterModel::where('name', 'wechat')
		->update(['is_show' => isset($post['config_content']['wechat']['display']) ?: 0
		, 'is_required' => isset($post['config_content']['wechat']['required']) ?: 0]);

		RegisterModel::where('name', 'invite_code')
		->update(['is_show' => isset($post['config_content']['invite_code']['display']) ?: 0
		, 'is_required' => isset($post['config_content']['invite_code']['required']) ?: 0]);

		RegisterModel::where('name', 'verification_code')
		->update(['is_show' => isset($post['config_content']['verification_code']['display']) ?: 0
		, 'is_required' => isset($post['config_content']['verification_code']['required']) ?: 0]);

		$msg = Functions::showMsg('register',-1,'kangRegister');
		return $response->withJson($msg);
	}

	public function sysService($request, $response)
    {
		$svs_service = ConfigModel::where('name', 'line_link')->first();
		return $this->view->render('sys_service_set_manager',['svs_service'=>$svs_service]);
	}

	public function sysServiceSave($request, $response)
    {
		$post = $request->getParsedBody();
		
		$svs_service = ConfigModel::where('name', 'line_link')->first();
		$svs_service->value = $post['config_content']['line_link'];
		
		$svs_service->save();

		$msg = Functions::showMsg('sys_service',-1,'kangSysServiceSet');
		return $response->withJson($msg);
	}

	public function adjustQuota($request, $response)
    {
        return $this->view->render('adjust_quota_manager');
	}

	public function onlineCustomer($request, $response)
    {

        return $this->view->render('online_cus_manager');
	}

	public function siteMessage($request, $response)
    {
        return $this->view->render('site_msg_manager');
	}

	public function customerInfo($request, $response)
    {
        return $this->view->render('cus_info_manager');
	}

	public function customerBankInfo($request, $response)
    {
        return $this->view->render('cus_bank_info_manager');
	}

	public function customerGrade($request, $response)
    {
        return $this->view->render('cus_grade_manager');
	}

	public function customerMark($request, $response)
    {
        return $this->view->render('cus_mark_manager');
	}

	public function login($request, $response)
    {
		 
		 $_SESSION = array();
		 /***删除sessin id.由于session默认是基于cookie的，所以使用setcookie删除包含session id的cookie.***/
		 if (isset($_COOKIE[session_name()])) {
			setcookie(session_name(), '', time()-420000, '/');
		 }
		unset($_SESSION['menus']);
		unset($_SESSION['id']);
		unset($_SESSION['username']);
		unset($_SESSION['nickname']);
		unset($_SESSION['role']);
		session_destroy();
        return $this->view->render('login');
	}
	
	public function loginCheck($request, $response)
    {
		$post=$request->getParsedBody();
		$username = $post['luserid'];
		$password = $post['lpassword'];
		$password = crypt($password, '$1$' . substr(md5($username), 5, 8));
		if(strlen($username) < 4 || strlen($username) > 20){
			return $response->withRedirect('/agent/login');
		}
		$where = array();
		$where[]=array('username',$username);
		$where[]=array('password',$password);
		$where[]=array('role', '!=','admin');
		$where[]=array('role', '!=','customer');
        $user = User::select('id','username','nickname','role','valid','parentUid', 'allow_ip')->where($where)->first();

		if($user == null){
			
			return $response->withRedirect('/agent/login');
		}
		//die(json_encode($user->id));
		
		 //检测IP是否锁定 
		$userIp = UserIp::where('ip', Util::ip())->where('user_id',$user->id)->orderBy('id','desc')->first();
		
		if($userIp != null){
			if($userIp->status != 100){
				$ajaxdata =  '<script>alert("IP锁定");history.back();</script>';//['spanid'=>'javascript','rtntext'=>"alert('帐密有误')"];
				die($ajaxdata);
			}
		}
		
		if($user->valid == 3 || $user->valid == 4){
			$ajaxdata =  '<script>alert("帐密鎖定,請聯繫管理員");history.back();</script>';//['spanid'=>'javascript','rtntext'=>"alert('帐密有误')"];
			die($ajaxdata);
		}
		 
		
		//检测IP白名单
		// $userIp = UserIp::where('ip', Util::ip())->where('user_id',$user->id)->orderBy('id','desc')->first();
		$allow = explode(',', $user->allow_ip);
		$allow = array_filter($allow, function ($e) {
			return trim($e) != '';
		});
		if (count($allow) > 0 && !in_array(Util::ip(), $allow)) {
			$ajaxdata =  '<script>alert("不在IP白名單列表,請聯繫管理員");history.back();</script>';//['spanid'=>'javascript','rtntext'=>"alert('帐密有误')"];
			die($ajaxdata);
		}
		if($userIp == null){
			$userIp = new UserIp;
			$userIp->user_id = $user->id;
			$userIp->ip =  Util::ip();
			$userIp->status =  100;
			$userIp->save();
		}
		$user->lgtime = time();
		$user->lgip = Util::ip();
		$user->save();
		if ($user->parentUid == 0) {
			$_SESSION['id'] = $user->id;
			$_SESSION['username'] = $user->username;
			$_SESSION['nickname'] = $user->nickname;
			$_SESSION['role'] = $user->role;
			$_SESSION['isChild'] = 0;
		} else {
			//子账号
			$top = User::find($user->parentUid);
			$_SESSION['id'] = $top->id;
			$_SESSION['username'] = $top->username;
			$_SESSION['nickname'] = $top->nickname;
			$_SESSION['role'] = $top->role;
			$_SESSION['isChild'] = 1;
			$_SESSION['childId'] = $user->id;
			$_SESSION['childUsername'] = $user->username;
		}
		
		return $response->withRedirect('/agent');
	}

	public function paymentPatternManager($request, $response)
    {
        return $this->view->render('payment_pattern_manager');
	}

	public function sysPaymentManager($request, $response)
    {
        return $this->view->render('sys_payment_manager');
	}

	public function paymentMerchantManager($request, $response)
    {
        return $this->view->render('payment_merchant_manager');
	}

	public function paymentCompanyManager($request, $response)
    {
        return $this->view->render('payment_company_manager');
	}

	public function merchantDepositOrdersManager($request, $response)
    {
        return $this->view->render('merchant_deposit_orders_manager');
	}

	public function companyDepositOrdersManager($request, $response)
    {
        return $this->view->render('company_deposit_orders_manager');
	}

	public function memWithdrawOrdersManager($request, $response)
    {
        return $this->view->render('mem_withdraw_orders_manager');
	}

	public function agentWithdrawOrdersManager($request, $response)
    {
        return $this->view->render('agent_withdraw_orders_manager');
	}

	public function manualPaymentManager($request, $response)
    {
        return $this->view->render('manual_payment_manager');
	}

	public function cusWithdrawAuditManager($request, $response)
    {
        return $this->view->render('cus_withdraw_audit_manager');
	}

	public function discountCategoryManager($request, $response)
    {
        return $this->view->render('discount_category_manager');
	}

	public function discountManager($request, $response)
    {
        return $this->view->render('discount_manager');
	}

	public function cusDiscountAuditManager($request, $response)
    {
        return $this->view->render('cus_discount_audit_manager');
	}

	public function cusDiscountApplyManager($request, $response)
    {
        return $this->view->render('cus_discount_apply_manager');
	}

	public function cusRetreatSetManager($request, $response)
    {
        return $this->view->render('cus_retreat_set_manager');
	}

	public function cusRetreatAuditManager($request, $response)
    {
        return $this->view->render('cus_retreat_audit_manager');
	}

	public function cusWdQuotaLogManager($request, $response)
    {
		$get = $request->getQueryParams();
		$type = isset($get['type']) ? $get['type'] : 1;
		$search_trans_type = isset($get['search_trans_type']) ? $get['search_trans_type'] : -1;
		$search_customer_userid = isset($get['search_customer_userid']) ? $get['search_customer_userid'] : '';
		$fuzzy_search = isset($get['fuzzy_search']) ? $get['fuzzy_search'] : 0;

		$where = array();
		$where[] = array('operate_type', $type);
		if ($search_trans_type != -1) {
			$where[] = array('trans_type', $search_trans_type);
		}
		
		if ($search_customer_userid) {
			if ($fuzzy_search) {
				$where[] = array('username', 'like', '%'.$search_customer_userid.'%');
			} else {
				$where[] = array('username', $search_customer_userid);
			}
		}

		$sddate = date('Y-m-d');
		$eddate = date('Y-m-d');
		if(isset($get['sddate'])){
			$sddate = $get['sddate'];
		}
		$where[] = array('created_at','>=',$sddate.' 00:00');
		if(isset($get['eddate'])){
			$eddate = $get['eddate'];
		}
		$where[] = array('created_at','<=',$eddate.' 23:59');
		$trans_type = [3,4];
		
		$start = 0;
		if(isset($get['start']))
			$start = intval($get['start']);
		
		$length = 10;
		if(isset($get['length']))
			$length = intval($get['length']);
			
		$summarys = UserMoney::where($where)->whereIn('trans_type',[3,4])->skip($start)->take($length)->orderBy('id', 'desc')->get();
		$totalRows = UserMoney::where($where)->whereIn('trans_type',[3,4])->count();
		$totalPages = ceil($totalRows / $length);
		
		//统计所有
		$totalMoney =  UserMoney::where($where)->whereIn('trans_type',[3,4])->sum('money');
		$totalFee =  UserMoney::where($where)->whereIn('trans_type',[3,4])->sum('fee');
		$totalReal = $totalMoney - $totalFee;
		//页面统计
		$pageMoney =  $summarys->sum('money');
		$pageFee =  $summarys->sum('fee');
		$pageReal = $pageMoney - $pageFee;
		
        return $this->view->render('cus_wd_quota_log_manager',[
			'sddate'=>$sddate,
			'eddate'=>$eddate,
			'summarys'=>$summarys,
			'totalRows'=>$totalRows,
			'totalPages'=>$totalPages,
			'pageSize'=>$length,
			'start' => $start,
			'type' => $type,
			'search_trans_type' => $search_trans_type,
			'search_customer_userid' => $search_customer_userid,
			'fuzzy_search' => $fuzzy_search,
			'totalFee' => $totalFee,
			'totalMoney' => $totalMoney,
			'totalReal' => $totalReal,
			'pageMoney' => $pageMoney,
			'pageFee' => $pageFee,
			'pageReal' => $pageReal,
		]);
	}

	public function cusQuotaLogManager($request, $response)
    {
		$get = $request->getQueryParams();
		$search_customer_userid = isset($get['search_customer_userid']) ? $get['search_customer_userid'] : '';

        return $this->view->render('cus_quota_log_manager', [
			'search_customer_userid' => $search_customer_userid
		]);
	}

	public function agentQuotaLogManager($request, $response)
    {
        return $this->view->render('agent_quota_log_manager');
	}

	public function gameReportManager($request, $response)
    {
		$get = $request->getQueryParams();
		$where = array();
		$where[] = array('flag',1);
		$search_date_type = 'bet_time';
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
		$sddate = isset($get['sddate']) ? $get['sddate'] : date('Y-m-d');
		$eddate = isset($get['eddate']) ? $get['eddate'] : date('Y-m-d');
		$sdtime = isset($get['sdtime']) ? $get['sdtime'] : date('00:00:00');
		$edtime = isset($get['edtime']) ? $get['edtime'] : date('23:59:59');
		$where[] = array($dateTimeColumn,'>=',$sddate.' ' .$sdtime);
		$where[] = array($dateTimeColumn,'<=',$eddate.' ' .$edtime);
		//if(isset($get['search_customer_userid']))
		//	$where[] = array('game_username','like','%'.$get['search_customer_userid'].'%');
		$id = $_SESSION['id'];
		if (isset($get['search_game_store']) && $get['search_game_store'] != '') {
			$where[] = array('game_id', $get['search_game_store']);
		}
		$summarys = Bet::whereHas('user',function($query) use ($id){
			$query->where('parents','like','%/'.$id.'/%');
		})->with('game')->select(
			'game_id',  
			DB::raw('sum(if(winlose=0, 1 , 0 )) loseCnt'),  
			DB::raw('count(id) as Cnt'),
			DB::raw('SUM(Amount) as totalAmount'),
			DB::raw('SUM(valid_Amount) as totalValidAmount'),
			DB::raw('SUM(netAmount) as totalNetAmount')
		)->where($where)->groupBy('game_id')->get();
		
		 
		foreach($summarys as $summary){
			$summary->killRate = number_format(1 - $summary->loseCnt /   $summary->Cnt ,2) * 100;
		}

		//總計
        $allTotal = new \stdClass;
        $allTotal->Cnt = 0;
        $allTotal->totalAmount = 0;
        $allTotal->totalValidAmount = 0;
        $allTotal->totalNetAmount = 0;
		foreach ($summarys as $item) {
            $allTotal->Cnt += $item['Cnt'];
            $allTotal->totalAmount += $item['totalAmount'];
            $allTotal->totalValidAmount += $item['totalValidAmount'];
            $allTotal->totalNetAmount += $item['totalNetAmount'];
        }
		
		//echo json_encode($summarys);
		$games = Game::where('status', 1)->get();
        return $this->view->render('game_report_manager',[
			'summarys'=>$summarys,
			'search_date_type'=> isset($get['search_date_type']) ? $get['search_date_type'] : '2',
			'search_game_store'=> isset($get['search_game_store']) ? $get['search_game_store'] : '-1',
			'sddate'=>$sddate,
			'eddate'=>$eddate,
			'sdtime'=>$sdtime,
			'edtime'=>$edtime,
			'games' => $games,
			'allTotal' => $allTotal,
		]);
	}


	public function cusInstantBetInfoManager($request, $response)
    {
		$get = $request->getQueryParams();
		$search_customer_userid = isset($get['search_customer_userid']) ? $get['search_customer_userid'] : '';

		$where = array();
		if ($search_customer_userid) {
			$user_search = User::where('username', $search_customer_userid)->first();
			if ($user_search) {
				$where[] = array('user_id', $user_search->id);
			}
		}

		$where[] = array('created_at','>=',date('Y-m-d H:i:s', strtotime(' -120 minute')));
		//$where[] = array('flag',0);

		$start = 0;
		if(isset($get['start']))
			$start = intval($get['start']);
		
		$length = 10;
		if(isset($get['length']))
			$length = intval($get['length']);
		$id = $_SESSION['id'];
		$bets = Bet::whereHas('user',function($query) use ($id){
			$query->where('parents','like','%/'.$id.'/%');
		})->with('game', 'user.upper')->where($where)->skip($start)->take($length)->orderBy('id', 'desc')->get();
		$totalRows = Bet::with('game')->where($where)->count();
		$totalPages = ceil($totalRows / $length);

		$summarys = Bet::whereHas('user',function($query) use ($id){
			$query->where('parents','like','%/'.$id.'/%');
		})->select(
			DB::raw('sum(if(winlose=0, 1 , 0 )) loseCnt'),  
			DB::raw('count(id) as Cnt'),
			DB::raw('SUM(Amount) as totalAmount'),
			DB::raw('SUM(valid_Amount) as totalValidAmount'),
			DB::raw('SUM(winlose) as totalWinlose')
		)->where($where)->first();

		$page_summarys = new stdClass();
		$page_summarys->Cnt = $bets->count();
		$page_summarys->totalAmount = $bets->sum('amount');
		$page_summarys->totalValidAmount = $bets->sum('valid_amount');
		$page_summarys->totalWinlose = $bets->sum('winlose');
		 
        return $this->view->render('cus_instant_bet_info_manager',[
			'totalRows'=>$totalRows,
			'totalPages'=>$totalPages,
			'pageSize'=>$length,
			'start' => $start,
			'bets'=>$bets,
			'search_customer_userid'=>$search_customer_userid,
			'summarys'=>$summarys,
			'page_summarys'=>$page_summarys,
			'timer' => isset($get['timer']) ? $get['timer'] : -1
		]);
	}

	public function cusBetInfoManager($request, $response)
    {
		$get = $request->getQueryParams();
		$where = array();
		 
		$where[] = array('flag',1);
		
		$search_date_type = 'bet_time';
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
		if (isset($get['search_customer_userid']) && $get['search_customer_userid'] != '') {
			$u = User::where('username', $get['search_customer_userid'])->where('role', 'customer')->first();
			if (!empty($u)) {
				$where[] = array('user_id', $u['id']);
			}
		}
		$sddate = isset($get['sddate']) ? $get['sddate'] : date('Y-m-d');
		$eddate = isset($get['eddate']) ? $get['eddate'] : date('Y-m-d');
		$sdtime = isset($get['sdtime']) ? $get['sdtime'] : date('00:00:00');
		$edtime = isset($get['edtime']) ? $get['edtime'] : date('23:59:59');
		$where[] = array($dateTimeColumn,'>=',$sddate.' ' .$sdtime);
		$where[] = array($dateTimeColumn,'<=',$eddate.' ' .$edtime);

		$start = 0;
		if(isset($get['start']))
			$start = intval($get['start']);
		
		$length = 10;
		if(isset($get['length']))
			$length = intval($get['length']);
		
		$id = $_SESSION['id'];
		// echo json_encode($where);
		// return;
		$bets = Bet::whereHas('user',function($query) use ($id, $get){
			$query->where('parents','like','%/'.$id.'/%');
			// Check if search_customer_userid is set and not empty
			if (empty($get['search_customer_userid'])) {
				$query->orWhere('user_id', $id);
			}
		})->with('game', 'user.upper')->where($where)->skip($start)->take($length)->orderBy('id', 'desc')->get();
		$totalRows = Bet::with('game')->where($where)->count();
		$totalPages = ceil($totalRows / $length);
		
		$summarys = Bet::whereHas('user',function($query) use ($id){
			$query->where('parents','like','%/'.$id.'/%');
		})->select(
			DB::raw('sum(if(winlose=0, 1 , 0 )) loseCnt'),  
			DB::raw('count(id) as Cnt'),
			DB::raw('SUM(Amount) as totalAmount'),
			DB::raw('SUM(valid_Amount) as totalValidAmount'),
			DB::raw('SUM(winlose) as totalWinlose'),
			DB::raw('SUM(netAmount) as totalNetAmount'),
		)->where($where)->first();

		$page_summarys = new stdClass();
		$page_summarys->Cnt = $bets->count();
		$page_summarys->totalAmount = $bets->sum('amount');
		$page_summarys->totalValidAmount = $bets->sum('valid_amount');
		$page_summarys->totalWinlose = $bets->sum('winlose');
		$page_summarys->totalNetAmount = $bets->sum('netAmount');
		 
        return $this->view->render('cus_bet_info_manager',[
			'sddate'=>$sddate,
			'eddate'=>$eddate,
			'sdtime'=>$sdtime,
			'edtime'=>$edtime,
			'totalRows'=>$totalRows,
			'totalPages'=>$totalPages,
			'pageSize'=>$length,
			'start' => $start,
			'bets'=>$bets,
			'summarys'=>$summarys,
			'page_summarys'=>$page_summarys,
			'search_customer_userid' => isset($get['search_customer_userid'])?$get['search_customer_userid']:''
		]);
	}

	public function cusReportManager($request, $response)
    {
		$get = $request->getQueryParams();
		$search_customer_userid = isset($get['search_customer_userid']) ? $get['search_customer_userid'] : '';
		
		$where = array();
		if ($search_customer_userid) {
			$user_search = User::where('username', $search_customer_userid)->first();
			if ($user_search) {
				$where[] = array('user_id', $user_search->id);
			}
		}

		$where[] = array('flag',1);
		$search_date_type = 'bet_time';
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
		$sddate = isset($get['sddate']) ? $get['sddate']:date('Y-m-d');
		$eddate = isset($get['eddate']) ? $get['eddate']:date('Y-m-d');
		$sdtime = isset($get['sdtime']) ? $get['sdtime'] : date('00:00:00');
		$edtime = isset($get['edtime']) ? $get['edtime'] : date('23:59:59');
		$where[] = array($dateTimeColumn,'>=',$sddate.' ' .$sdtime);
		$where[] = array($dateTimeColumn,'<=',$eddate.' ' .$edtime);
		$id = $_SESSION['id'];
		$summarys = Bet::whereHas('user',function($query) use ($id){
			$query->where('parents','like','%/'.$id.'/%');
		})->with(['user'=>function($query) use ($search_customer_userid){
				return $query->with('upper');
			}])->select(
			'user_id',  
			DB::raw('sum(if(winlose=0, 1 , 0 )) loseCnt'),  
			DB::raw('count(id) as Cnt'),
			DB::raw('SUM(Amount) as totalAmount'),
			DB::raw('SUM(valid_Amount) as totalValidAmount'),
			DB::raw('SUM(winlose) as totalWinlose')
		)->where($where)->groupBy('user_id')->get();
		
		 
		foreach($summarys as $summary){
			if($summary->user->upper == null)
				$summary->upper = '--';
			else
				$summary->upper = $summary->user->upper->username;
			$summary->killRate = number_format(1 - $summary->loseCnt /   $summary->Cnt ,2) * 100;
		}
		//echo json_encode($summarys);
        return $this->view->render('cus_report_manager',[
			'summarys'=>$summarys,
			'search_customer_userid'=>$search_customer_userid,
			'sddate'=>$sddate,
			'eddate'=>$eddate,
			'sdtime'=>$sdtime,
			'edtime'=>$edtime,
		]);
	}

	public function agentReportManager($request, $response)
    {
        return $this->view->render('agent_report_manager');
	}

	public function changeOrderLogsManager($request, $response)
    {
        return $this->view->render('change_order_logs_manager');
	}

	public function cusIpManager($request, $response)
    {
        return $this->view->render('cus_ip_manager');
	}

	public function employeeManager($request, $response)
    {
        return $this->view->render('employee_manager');
	}

	public function sysFuncSetManager($request, $response)
    {
        return $this->view->render('sys_func_set_manager');
	}
	
	public function personal_info($request, $response)
    {
		$agent = User::where('id',$_SESSION['id'])->first();
		$frontUrl = ConfigModel::where('name','frontUrl')->pluck('value')->first();
		$frontUrl .= ConfigModel::where('name','line_liff_id')->pluck('value')->first();
        return $this->view->render('personal_info',['agent'=>$agent,'frontUrl'=>$frontUrl]);
	}
	public function personalInfoOp($request, $response)
    {
		$get = $request->getQueryParams();
		$post = $request->getParsedBody();
		$pdisplay = $get['pdisplay'];
		
		if ($pdisplay == 'update_password') {
			$old_pass = $post['old_pass'];
			$new_pass1 = $post['new_pass1'];
			$new_pass2 = $post['new_pass2'];

			if ($old_pass == '' || $new_pass1 == '' || $new_pass2 == '') {
				die('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'1\', {\"target\":\"kangPersonalInfo\"}));"}]}}');
			}
			if ($new_pass1 != $new_pass2) {
				die('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'3\', {\"target\":\"kangPersonalInfo\"}));"}]}}');
			}
			if (strlen($new_pass1) < 3) {
				die('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'4\', {\"target\":\"kangPersonalInfo\"}));"}]}}');
			}
			if ($_SESSION['isChild'] == 0) {
				$username = $_SESSION['username'];
			} else {
				$username = $_SESSION['childUsername'];
			}
			$password = crypt($old_pass, '$1$' . substr(md5($username), 5, 8));
			$where = array();
			$where[]=array('username',$username);
			$where[]=array('password',$password);
			$user = User::where($where)->first();
			if($user == null){
				die('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'5\', {\"target\":\"kangPersonalInfo\"}));"}]}}');
			}
			$user->password = crypt($new_pass1, '$1$' . substr(md5($username), 5, 8));
			$user->save();

			die('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'-1\', {\"target\":\"kangPersonalInfo\"}));"}]}}');
		}
	}

	public function personal_overview($request, $response)
	{
		$get = $request->getQueryParams();

		$begin = isset($get['startTime']) ? $get['startTime'] : date('Y-m-d 00:00:00');
		$end = isset($get['endTime']) ? $get['endTime'] : date('Y-m-d 23:59:59');

		if (isset($get['search_user_id'])) {
			$user = User::find($get['search_user_id']);
		} else {
			$user = User::find($_SESSION['id']);
		}
		$game_store_types = GameStoreType::all();

		$where =array();
		$where[] = array('created_at','>=',$begin);
		$where[] = array('created_at','<=',$end);
		$where[] = array('user_id', $user->id);

		// echo json_encode($where);
		// return;
		
		foreach ($game_store_types as $row) {
			$gameIds = $row->games->pluck('id');
			
			$bets = Bet::select([
				DB::raw('IF(ISNULL(amount), 0, sum(amount)) as amount'),
				DB::raw('IF(ISNULL(valid_amount), 0, sum(valid_amount)) as valid_amount'),
				DB::raw('IF(ISNULL(winlose), 0, sum(winlose)) as winlose'),
			])->whereIn('game_id', $gameIds)->where($where)->first();
			
			$row['betReports'] = $bets;
		}

		return $this->view->render('personal_overview', [
			'sdate' =>date("Y-m-d", strtotime($begin)),
			'stime' =>date("H:i:s", strtotime($begin)),
			'edate' =>date("Y-m-d", strtotime($end)),
			'etime' =>date("H:i:s", strtotime($end)),
			'game_store_types' => $game_store_types,
		]);
	}
	
	public function agent_info_manager($request, $response)
    {
        return $this->view->render('agent_info_manager');
	}
	public function cus_info_manager($request, $response)
    {
        return $this->view->render('cus_info_manager');
	}
	public function sub_customer_manager($request, $response)
    {
        return $this->view->render('sub_customer_manager');
	}
	public function subCustomerOp($request, $response, $args)
    {
		$get = $request->getQueryParams();
		$post = $request->getParsedBody();
		$pdisplay = $get['pdisplay'];
		
		if($pdisplay == 'display_manager_list'){

			$where = array();
			//$where[] = array('status',1);
			$start = 0;
			if(isset($get['start']))
				$start = intval($get['start']);
			
			$length = 10;
			if(isset($get['length']))
				$length = intval($get['length']);
			
			$where[] = array('parentUid', $_SESSION['id']);
			
			
			
			
			
			$datas = User::where($where)->skip($start)->take($length)->get();
			
			
			$result = array();
			foreach($datas as $data){
				$username = $data->username;
				$name = $data->nickname;
				$status = '<select class="form-control input-small" name="customer_status" onchange="update_sub_status(this.value,\''.$data->id.'\')">';
				if ($data->valid == 1) {
					$status .=		'<option value="1" selected="true">啟用
					</option>
					
					<option value="3">鎖定
					</option>';
				} else {
					$status .=		'<option value="1" >啟用
					</option>
					
					<option value="3" selected="true">鎖定
					</option>';
				}
				
								
				$status .=			'</select>';
				$created_at = "<div align= center>".$data->created_at."</div>";
				$action = '<button class="btn green" onclick="update_customer(\''.$data->id.'\')"> <i class="fa fa-pencil"></i> 修改</button>';
				$action .= '<button class="btn red" onclick="delete_customer(\''.$data->id.'\')"> <i class="fa fa-trash-o"></i> 刪除</button>';

				$formatItem = array();
				$formatItem[] = $username;
				$formatItem[] = $name;
				$formatItem[] = $status;
				$formatItem[] = $created_at;
				$formatItem[] = $action;
				$result[] = $formatItem;
			}
			
			$count = User::where($where)->count();
			if($result == null)$result = [];
			$draw = 1;
			if(isset($get['draw']))
				$draw = intval($get['draw']);
			$result = Functions::listData($draw ,$count,$count,$result);
			return $response->withJson($result);
		} elseif ($pdisplay == 'add_action') {
			$etype = $post['etype'];
			if ($etype == 'add') {
				if (strlen($post['customer_userid']) < 3 ) {
					$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'7\', {\"target\":\"kangSubCustomer\"}));"}]}}');
					return $response->withJson($msg);
				}
				if (strlen($post['customer_pass']) < 3 ) {
					$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'2\', {\"target\":\"kangSubCustomer\"}));"}]}}');
					return $response->withJson($msg);
				}
				if ($post['customer_name'] == '') {
					$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'8\', {\"target\":\"kangSubCustomer\"}));"}]}}');
					return $response->withJson($msg);
				}
				$exist = User::where('username', $post['customer_userid'])->first();
				if ($exist) {
					$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'9\', {\"target\":\"kangSubCustomer\"}));"}]}}');
					return $response->withJson($msg);
				}

				$top = User::find($_SESSION['id']);
				$agent = new User();
				$agent->parentUid = $top->id;
				$agent->username = $post['customer_userid'];
				$agent->password = crypt($post['customer_pass'], '$1$' . substr(md5($post['customer_userid']), 5, 8));
				$agent->nickname = $post['customer_name'];

				$agent->level = $top->level + 1;
				$agent->pid = $top->pid;
				$agent->parents = $top->parents;
				$agent->role = $top->role;
				$agent->valid = 1;
				$agent->has_control_perm = $top->has_control_perm;
				$agent->fee_percent = $top->note;
				$agent->note = $top->note;
				$agent->save();
				die('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"parent.grid.getDataTable().ajax.reload();parent.close_layer({type: 1});pop_msg(show_msg(\'-3\', {\"target\":\"kangSubCustomer\"}));"}]}}');
			} elseif ($etype == 'edit') {
				if ($post['customer_name'] == '') {
					$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'8\', {\"target\":\"kangSubCustomer\"}));"}]}}');
					return $response->withJson($msg);
				}

				$edit_cus_id = $post['edit_cus_id'];
				$agent = User::find($edit_cus_id);
				$agent->nickname = $post['customer_name'];
				$agent->save();
				die('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"parent.grid.getDataTable().ajax.reload();parent.close_layer({type: 1});pop_msg(show_msg(\'-1\', {\"target\":\"kangSubCustomer\"}));"}]}}');
			} 
		} elseif ($pdisplay == 'delete_customer') {

			$customer_id = $post['customer_id'];
			$agent = User::find($customer_id);
			$agent->delete();
			die('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"grid.getDataTable().ajax.reload();pop_msg(show_msg(\'-2\', {\"target\":\"kangSubCustomer\"}));"}]}}');
		} elseif ($pdisplay == 'update_sub_status') {

			$customer_id = $post['customer_id'];
			$agent = User::find($customer_id);
			$agent->valid = $post['value'];
			$agent->save();
			die('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"grid.getDataTable().ajax.reload();pop_msg(show_msg(\'-1\', {\"target\":\"kangSubCustomer\"}));"}]}}');
		}
	}
	public function sub_customer_editor($request, $response)
    {
		$get = $request->getQueryParams();
		$etype = $get['etype'];
		
		
		
		if ($etype == 'edit') {
			//编辑
			$edit_cus_id = $get['edit_cus_id'];
			$agent = User::find(intval($get['edit_cus_id']));
			
		} else {
			//新增
			$agent = new User();
		}

        return $this->view->render('sub_customer_editor', [
			'agent' => $agent,
			'etype' => $etype,
		]);
	}
	public function cus_bank_info($request, $response)
    {
		$banks = UserBank::where('user_id', $_SESSION['id'])->get();
        return $this->view->render('cus_bank_info',[
			'banks' => $banks
		]);
	}
	public function cusBankInfoOp($request, $response)
    {
        $post = $request->getParsedBody();
		$get = $request->getQueryParams();
		 
		$pdisplay = $get['pdisplay'];
		$edit_id = $_SESSION['id'];

		$balanceHtml = array();
		if ($pdisplay == 'save_cus_bank_info') {
			$bank_name = isset($post['bank_name']) ? $post['bank_name'] : '';
			$bank_branch = isset($post['bank_branch']) ? $post['bank_branch'] : '';
			$account_name = isset($post['account_name']) ? $post['account_name'] : '';
			$bank_account = isset($post['bank_account']) ? $post['bank_account'] : '';

			if ($bank_name == '') {
				die('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'100\', {\"target\":\"kangCusInfoEditor\"}));"}]}}');
			}
			if ($bank_branch == '') {
				die('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'103\', {\"target\":\"kangCusInfoEditor\"}));"}]}}');
			}
			if ($account_name == '') {
				die('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'104\', {\"target\":\"kangCusInfoEditor\"}));"}]}}');
			}
			if ($bank_account == '') {
				die('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'105\', {\"target\":\"kangCusInfoEditor\"}));"}]}}');
			}
			
			$exist = UserBank::where('bank_account', $bank_account)->first();
			if ($exist) {
				die('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"alert(\"银行卡号已注册过\");"}]}}');
			}
	 
			$bank = new UserBank;
			$bank->user_id = $edit_id;
			$bank->status = 100;
			$bank->created_at = date('Y-m-d H:i:s');
			$bank->updated_at = date('Y-m-d H:i:s');
			$bank->bank_area = '';
			$bank->bank_name = $bank_name;
			$bank->bank_branch = $bank_branch;
			$bank->account_name = $account_name;
			$bank->bank_account = $bank_account;
			$bank->save();
			
			//system notice
			$cnt = UserBank::where('status' ,'<=',2)->count();
			$notice = SystemNotice::where('project','cus_bank_info_manager')->first();
			if($notice != null){
				$notice->cnt  = $cnt ;
				$notice->save();
			}
			die('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'-1\', {\"target\":\"kangCusBankInfoManager\"}));location.reload()"}]}}');
		} elseif ($pdisplay == 'request_cus_bank_info_detail') {
			$info_id = $post['info_id'];

			$bank = UserBank::find($info_id);
			die('{"root":{"ajaxdata":[{"spanid":"#show-cus-bank-info-detail-area","rtntext":"<!--slot=1-->\n<table class=\"cus-bank-info-detail-tb\">\n\t<tr>\n\t\t<td class=\"title\">開戶銀行<\/td>\n\t\t<td>\n\t\t\t'.$bank->bank_name.'\n\t\t<\/td>\n\t<\/tr>\n\t<tr class=\"hidden\">\n\t\t<td class=\"title\">開戶省/市<\/td>\n\t\t<td>\n\t\t\t&nbsp;\n\t\t<\/td>\n\t<\/tr>\n\t<tr>\n\t\t<td class=\"title\">開戶支行<\/td>\n\t\t<td>'.$bank->bank_branch.'<\/td>\n\t<\/tr>\n\t<tr>\n\t\t<td class=\"title\">開戶姓名<\/td>\n\t\t<td>'.$bank->account_name.'<\/td>\n\t<\/tr>\n\t<tr>\n\t\t<td class=\"title\">銀行卡號<\/td>\n\t\t<td>'.$bank->bank_account.'<\/td>\n\t<\/tr>\n<\/table>\n"},{"spanid":"javascript","rtntext":"show_cus_bank_info_detail();"}]}}');
		}
	}
	public function cus_withdraw($request, $response)
    {
		$banks = UserBank::where('user_id', $_SESSION['id'])->where('status', 100)->where('is_freeze',0)->get();
		foreach($banks as $bank){
			if(strlen($bank->bank_account) > 6)
				$bank->bank_account = substr($bank->bank_account,0,2).'****'.substr($bank->bank_account,-4); 
		}
        return $this->view->render('cus_withdraw', [
			"banks" => $banks
		]);
	}
	public function cusWithdrawOp($request, $response, $args)
    {
		$get = $request->getQueryParams();
		$post = $request->getParsedBody();
		$pdisplay = $get['pdisplay'];
		
		if($pdisplay == 'save_withdraw'){
			$info_id = $post['info_id'];
			$apply_amount = $post['apply_amount'];

			$id = $_SESSION['id'];
			$user = User::find($id);
			$bank = UserBank::where('id', $info_id)->where('user_id', $user->id)->first();

			if (!$bank) {
				return '{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"save_withdraw_flag = 1;pop_msg(show_msg(\'2\', {\"target\":\"kangCusWithdraw\"}));"}]}}';
			}

			if ($apply_amount <= 0) {
				return '{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"save_withdraw_flag = 1;pop_msg(show_msg(\'1\', {\"target\":\"kangCusWithdraw\"}));"}]}}';
			}

			/*$grade = array();
			$grade = CusGrade::find($user->cus_grade_id);
			if($grade != null){
				if ($apply_amount < $grade->grade_options_condition_min_withdraw_amount) {
					return '{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"save_withdraw_flag = 1;pop_msg(show_msg(\'3\', {\"target\":\"kangCusWithdraw\"}));"}]}}';
				}

				if ($apply_amount > $grade->grade_options_condition_max_withdraw_amount) {
					return '{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"save_withdraw_flag = 1;pop_msg(show_msg(\'4\', {\"target\":\"kangCusWithdraw\"}));"}]}}';
				}
			}*/

			//總流水要求
			/*$total_liushui = WithdrawAudit::where('user_id', $user->id)->whereIn('status', [0,1])->where('is_audit', 1)->sum('liushui');
			//目前打碼量
			$amount = $user->dama;
			//還需打碼量
			$need = ($total_liushui - $amount) < 0? 0 : $total_liushui - $amount;

			if ($need > 0) {
				return '{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"save_withdraw_flag = 1;pop_msg(show_msg(\'9\', {\"target\":\"kangCusWithdraw\"}));"}]}}';
			}
			*/
			if ($apply_amount > $user->balance) {
				return '{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"save_withdraw_flag = 1;pop_msg(show_msg(\'8\', {\"target\":\"kangCusWithdraw\"}));"}]}}';
			}

			$fee = 0;
			$admin_fee = 0;
			$actual_amount = $apply_amount - $fee - $admin_fee;
			DB::beginTransaction();
			try{
				$user = User::lockForUpdate()->find($user->id);

				$withdraw = new Withdraw();
				$withdraw->trans_no =  'WD'.$user->id.date('YmdHis');
				$withdraw->trans_type = 3;
				$withdraw->user_id = $user->id;
				$withdraw->bank_id = $bank->id;
				$withdraw->name = $user->username;
				$withdraw->amount = $apply_amount;
				$withdraw->fee = $fee;
				$withdraw->admin_fee = $admin_fee;
				$withdraw->actual_amount = $actual_amount;
				$withdraw->status =  -100;
				$withdraw->apply_time =  date('Y-m-d H:i:s');
				$withdraw->remark =  '';
				$withdraw->save();
					 
				$log = new UserMoney();
				$log->username = $user->username;
				$log->assets = $user->balance;
				$log->money = -$actual_amount;
				$log->balance = $user->balance - $actual_amount;
				$log->reason = '代理申请出款';
				$log->order_id = 0;
				$log->withdraw_id = $withdraw->id;
				$log->operate_type = 2;
				$log->trans_type = 3;
				$log->operator = $user->username;
				$log->created_at = date('Y-m-d H:i:s');
				$log->updated_at = date('Y-m-d H:i:s');
				$log->status = 1;
				$log->save(); 
				
				$user->balance =  $user->balance - $actual_amount;
				$user->save();

				DB::commit();
				return '{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"save_withdraw_flag = 1;pop_msg(show_msg(\'-1\', {\"target\":\"kangCusWithdraw\"}));"}]}}';
				 
			}catch(\Exception $ex){
				DB::rollBack();
				return '{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"save_withdraw_flag = 1;pop_msg(show_msg(\'10\', {\"target\":\"kangCusWithdraw\"}));"}]}}';	
			}

		}
	}
	public function self_quota_log_manager($request, $response)
    {
        return $this->view->render('self_quota_log_manager');
	} 

	public function cusBetReportManager($request, $response)
	{
		$get = $request->getQueryParams();
		$sddate = isset($get['sddate']) ? $get['sddate'] : date('Y-m-d');
		$eddate = isset($get['eddate']) ? $get['eddate'] : date('Y-m-d');
		$sdtime = isset($get['sdtime']) ? $get['sdtime'] : date('00:00:00');
		$edtime = isset($get['edtime']) ? $get['edtime'] : date('23:59:59');

        return $this->view->render('cus_bet_report_manager',[
			'sddate'=>$sddate,
			'eddate'=>$eddate,
			'sdtime'=>$sdtime,
			'edtime'=>$edtime,
			'search_customer_userid' => isset($get['search_customer_userid'])?$get['search_customer_userid']:''
		]);
	}

	public function cusBetReportOp($request, $response)
	{
		$get = $request->getQueryParams();
		$where = array();
		 
		$where[] = array('flag',1);
		
		$search_date_type = 'bet_time';
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
		if (isset($get['search_customer_userid']) && $get['search_customer_userid'] != '') {
			$u = User::where('username', $get['search_customer_userid'])->where('role', 'customer')->first();
			$where[] = array('user_id', $u['id']);
		}
		$sddate = isset($get['sddate']) ? $get['sddate'] : date('Y-m-d');
		$eddate = isset($get['eddate']) ? $get['eddate'] : date('Y-m-d');
		$sdtime = isset($get['sdtime']) ? $get['sdtime'] : date('00:00:00');
		$edtime = isset($get['edtime']) ? $get['edtime'] : date('23:59:59');
		$where[] = array($dateTimeColumn,'>=',$sddate.' ' .$sdtime);
		$where[] = array($dateTimeColumn,'<=',$eddate.' ' .$edtime);
// echo json_encode($where);
// return;
		$offset = 0;
		if(isset($get['offset']))
			$offset = intval($get['offset']);
		
		$limit = 10;
		if(isset($get['limit']))
			$limit = intval($get['limit']);
		
		$id = $_SESSION['id'];
		$bets = Bet::whereHas('user',function($query) use ($id){
			$query->where('parents','like','%/'.$id.'/%');
		})->with('game', 'user.upper')->where($where)->offset($offset)->take($limit)->orderBy('id', 'desc')->get();

		$count = count($bets);
		$min = collect($bets)->map(function ($bet) {
			return $bet->user;
		})->min('level');

		foreach ($bets as $bet) {
			if ($bet->user->level == $min) {
				$bet->user->pid = 0;
			}
		}
		
		$summarys = Bet::whereHas('user',function($query) use ($id){
			$query->where('parents','like','%/'.$id.'/%');
		})->select(
			DB::raw('sum(if(winlose=0, 1 , 0 )) loseCnt'),  
			DB::raw('count(id) as Cnt'),
			DB::raw('SUM(Amount) as totalAmount'),
			DB::raw('SUM(valid_Amount) as totalValidAmount'),
			DB::raw('SUM(winlose) as totalWinlose')
		)->where($where)->first();

		$page_summarys = new stdClass();
		$page_summarys->Cnt = $bets->count();
		$page_summarys->totalAmount = $bets->sum('amount');
		$page_summarys->totalValidAmount = $bets->sum('valid_amount');
		$page_summarys->totalWinlose = $bets->sum('winlose');
		 
		$result = $bets;
		if($result == null)$result = [];
		$draw = 1;
		if(isset($get['draw']))
			$draw = intval($get['draw']);
		$result = Functions::listData($draw ,$count,$count,$result);
		$result->page_summarys = $page_summarys;
		return $response->withJson($result);
	}

	public function teamReportManager($request, $response)
	{
		$get = $request->getQueryParams();
		$sddate = isset($get['sddate']) ? $get['sddate'] : date('Y-m-d');
		$eddate = isset($get['eddate']) ? $get['eddate'] : date('Y-m-d');
		$sdtime = isset($get['sdtime']) ? $get['sdtime'] : date('00:00:00');
		$edtime = isset($get['edtime']) ? $get['edtime'] : date('23:59:59');

        return $this->view->render('team_report_manager',[
			'sddate'=>date("Y-m-d H:i:s", strtotime($sddate)),
			'eddate'=>$eddate,
			'sdtime'=>$sdtime,
			'edtime'=>$edtime,
			'search_customer_userid' => isset($get['search_customer_userid'])?$get['search_customer_userid']:''
		]);
	}

	public function teamReportWaterOp($request, $response)
	{
		$get = $request->getQueryParams();
		$offset = isset($get['offset']) ? intval($get['offset']) : 0;
		$limit = isset($get['limit']) ? intval($get['limit']) : 10;

		$where = array();
		
		if (isset($get['search'])) {
			$where[] = array('username', 'like', '%' . $get['search'] . '%');
		}

		$id = $_SESSION['id'];
		$where[] = array('parents','like','%/'.$id.'/%');

		$users = User::where($where)->offset($offset)->take($limit)->get();
		$min = collect($users)->min('level');

		foreach ($users as $key => $user) {
			if ($user->level == $min) {
				$user->pid = 0;
			}

			$bets = Bet::where('user_id', $user->id)->get();

			$summarys = new \stdClass;
			$summarys->winLose = $bets->sum('amount');
			$summarys->parentWater = 0;
			$summarys->water = 0;

			$user->summarys = $summarys;
		}

		$result = $users;
		$count = $users->count();
		if($result == null)$result = [];
		$draw = 1;
		if(isset($get['draw']))
			$draw = intval($get['draw']);
		$result = Functions::listData($draw ,$count,$count,$result);
		// $result->page_summarys = $page_summarys;
		return $response->withJson($result);
	}

	public function teamReportTakeOp($request, $response)
	{
		$get = $request->getQueryParams();
		$offset = isset($get['offset']) ? intval($get['offset']) : 0;
		$limit = isset($get['limit']) ? intval($get['limit']) : 10;

		$where = array();
		
		if (isset($get['search'])) {
			$where[] = array('username', 'like', '%' . $get['search'] . '%');
		}
		
		$id = $_SESSION['id'];
		$where[] = array('parents','like','%/'.$id.'/%');

		$users = User::where($where)->offset($offset)->take($limit)->get();
		$min = collect($users)->min('level');

		foreach ($users as $key => $user) {
			if ($user->level == $min) {
				$user->pid = 0;
			}

			$bets = Bet::where('user_id', $user->id)->get();
			
			$summarys = new \stdClass;
			$summarys->winLose = $bets->sum('amount');
			$summarys->totalCost = 0;
			$summarys->parentsWake = 0;
			$summarys->parentsCost = 0;
			$summarys->parentsSurplus = 0;
			$summarys->wake = 0;
			$summarys->cost = 0;
			$summarys->surplus = 0;

			$user->summarys = $summarys;
		}

		$result = $users;
		$count = $users->count();
		if($result == null)$result = [];
		$draw = 1;
		if(isset($get['draw']))
			$draw = intval($get['draw']);
		$result = Functions::listData($draw ,$count,$count,$result);
		// $result->page_summarys = $page_summarys;
		return $response->withJson($result);
	}
}
