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
			setcookie(session_name(), '', time()-42000, '/');
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
		if(strlen($username) < 5 || strlen($username) > 20){
			return $response->withRedirect('/agent/login');
		}
		$where = array();
		$where[]=array('username',$username);
		$where[]=array('password',$password);
        $user = User::select('id','username','nickname','role')->where($where)->first();
		if($user == null){
			 
			return $response->withRedirect('/agent/login');
		}
		$_SESSION['id'] = $user->id;
		$_SESSION['username'] = $user->username;
		$_SESSION['nickname'] = $user->nickname;
		$_SESSION['role'] = $user->role;
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
		$sddate = date('Y-m-d');
		$eddate = date('Y-m-d');
		if(isset($get['sddate'])){
			$sddate = $get['sddate'];
			$where[] = array($dateTimeColumn,'>=',$sddate.' 00:00');
		}
		if(isset($get['eddate'])){
			$eddate = $get['eddate'];
			$where[] = array($dateTimeColumn,'<=',$eddate.' 23:59');
		}
		//if(isset($get['search_customer_userid']))
		//	$where[] = array('game_username','like','%'.$get['search_customer_userid'].'%');
		 
		$id = $_SESSION['id'];
		$summarys = Bet::whereHas('user',function($query) use ($id){
			$query->where('parents','like','%/'.$id.'/%');
		})->with('game')->select(
			DB::raw("DATE_FORMAT({$dateTimeColumn},'%Y-%m-%d') as calDay"),
			DB::raw('count(id) as Cnt'),
			DB::raw('SUM(Amount) as totalAmount'),
			DB::raw('SUM(valid_Amount) as totalValidAmount'),
			DB::raw('SUM(winlose) as totalWinlose')
		)->where($where)->groupBy('calDay')->orderBy('id', 'desc')->get();
		
		$allTotal = new \stdClass;
		$allTotal->totalAmount = 0;
		$allTotal->totalValidAmount = 0;
		$allTotal->totalWinlose = 0;
		$allTotal->Cnt = 0;
		foreach($summarys as $summary){
			//$summary->killRate = number_format(1 - $summary->loseCnt /   $summary->Cnt ,2) * 100;
			$allTotal->totalAmount += $summary->totalAmount;
			$allTotal->totalValidAmount += $summary->totalValidAmount;
			$allTotal->totalWinlose += $summary->totalWinlose;
			$allTotal->Cnt += $summary->Cnt;
			 
		}
		//echo json_encode($summarys);
        return $this->view->render('all_calc_report_manager',[
			'sddate'=>$sddate,
			'eddate'=>$eddate,
			'summarys'=>$summarys,'allTotal'=>$allTotal
		]);
	}
	public function allCalcAgentReportManager($request, $response)
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
		$sddate = date('Y-m-d');
		$eddate = date('Y-m-d');
		if(isset($get['sddate'])){
			$sddate = $get['sddate'];
			$where[] = array($dateTimeColumn,'>=',$sddate.' 00:00');
		}
		if(isset($get['eddate'])){
			$eddate = $get['eddate'];
			$where[] = array($dateTimeColumn,'<=',$eddate.' 23:59');
		}
		
		$id = $_SESSION['id'];
		$summarys = Bet::whereHas('user',function($query) use ($id){
			$query->where('parents','like','%/'.$id.'/%');
		})->with('user')->select(
			'user_id',
			DB::raw("DATE_FORMAT({$dateTimeColumn},'%Y-%m-%d') as calDay"),
			DB::raw('count(id) as Cnt'),
			DB::raw('SUM(Amount) as totalAmount'),
			DB::raw('SUM(valid_Amount) as totalValidAmount'),
			DB::raw('SUM(winlose) as totalWinlose')
		)->where($where)->groupBy('user_id')->orderBy('id', 'desc')->get();
		
		$allTotal = new \stdClass;
		$allTotal->totalAmount = 0;
		$allTotal->totalValidAmount = 0;
		$allTotal->totalWinlose = 0;
		$allTotal->Cnt = 0;
		foreach($summarys as $summary){
			//$summary->killRate = number_format(1 - $summary->loseCnt /   $summary->Cnt ,2) * 100;
			$allTotal->totalAmount += $summary->totalAmount;
			$allTotal->totalValidAmount += $summary->totalValidAmount;
			$allTotal->totalWinlose += $summary->totalWinlose;
			$allTotal->Cnt += $summary->Cnt;
			 
		}
		
		//echo json_encode($summarys);
		
        return $this->view->render('all_calc_agent_report_manager',[
			'sddate'=>$sddate,
			'eddate'=>$eddate,
			'summarys'=>$summarys,
			'allTotal'=>$allTotal
		]);
	}
	public function gameReportManager($request, $response)
    {
		$get = $request->getQueryParams();
		$where = array();
		$where[] = array('flag',1);
		$search_date_type = 'bet_time';
		if(isset($get['search_date_type'])){
			$search_date_type = $get['search_date_type'];
			if($search_date_type == '1') 
				$dateTimeColumn = 'bet_time';
			elseif($search_date_type == '2') 
				$dateTimeColumn = 'draw_time';
			elseif($search_date_type == '3') 
				$dateTimeColumn = 'bet_time';
		}
		if(isset($get['sddate']))
			$where[] = array($dateTimeColumn,'>=',$get['sddate'].' 00:00');
		if(isset($get['eddate']))
			$where[] = array($dateTimeColumn,'<=',$get['eddate'].' 23:59');
		//if(isset($get['search_customer_userid']))
		//	$where[] = array('game_username','like','%'.$get['search_customer_userid'].'%');
		$id = $_SESSION['id'];
		$summarys = Bet::whereHas('user',function($query) use ($id){
			$query->where('parents','like','%/'.$id.'/%');
		})->with('game')->select(
			'game_id',  
			DB::raw('sum(if(winlose=0, 1 , 0 )) loseCnt'),  
			DB::raw('count(id) as Cnt'),
			DB::raw('SUM(Amount) as totalAmount'),
			DB::raw('SUM(valid_Amount) as totalValidAmount'),
			DB::raw('SUM(winlose) as totalWinlose')
		)->where($where)->groupBy('game_id')->get();
		
		 
		foreach($summarys as $summary){
			$summary->killRate = number_format(1 - $summary->loseCnt /   $summary->Cnt ,2) * 100;
		}
		
		//echo json_encode($summarys);
        return $this->view->render('game_report_manager',['summarys'=>$summarys]);
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

		//$where[] = array('created_at','>=','2021-12-01 00:00:00');
		$where[] = array('flag',0);

		$start = 0;
		if(isset($get['start']))
			$start = intval($get['start']);
		
		$length = 10;
		if(isset($get['length']))
			$length = intval($get['length']);
		$id = $_SESSION['id'];
		$bets = Bet::whereHas('user',function($query) use ($id){
			$query->where('parents','like','%/'.$id.'/%');
		})->with('game')->where($where)->skip($start)->take($length)->orderBy('id', 'desc')->get();
		$totalRows = Bet::with('game')->where($where)->count();
		$totalPages = ceil($totalRows / $length);

		$summarys = Bet::select(
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
			$where[] = array('user_id', $u['id']);
		}
		$sddate = date('Y-m-d');
		$eddate = date('Y-m-d');
		if(isset($get['sddate'])){
			$sddate = $get['sddate'];
		}
		$where[] = array($dateTimeColumn,'>=',$sddate.' 00:00');
		if(isset($get['eddate'])){
			$eddate = $get['eddate'];
		}
		$where[] = array($dateTimeColumn,'<=',$eddate.' 23:59');

		$start = 0;
		if(isset($get['start']))
			$start = intval($get['start']);
		
		$length = 10;
		if(isset($get['length']))
			$length = intval($get['length']);
		
		$id = $_SESSION['id'];
		$bets = Bet::whereHas('user',function($query) use ($id){
			$query->where('parents','like','%/'.$id.'/%');
		})->with('game')->where($where)->skip($start)->take($length)->orderBy('id', 'desc')->get();
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
		 
        return $this->view->render('cus_bet_info_manager',[
			'sddate'=>$sddate,
			'eddate'=>$eddate,
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
		if(isset($get['search_date_type'])){
			$search_date_type = $get['search_date_type'];
			if($search_date_type == '1') 
				$dateTimeColumn = 'bet_time';
			elseif($search_date_type == '2') 
				$dateTimeColumn = 'draw_time';
			elseif($search_date_type == '3') 
				$dateTimeColumn = 'bet_time';
		}
		if(isset($get['sddate']))
			$where[] = array($dateTimeColumn,'>=',$get['sddate'].' 00:00');
		if(isset($get['eddate']))
			$where[] = array($dateTimeColumn,'<=',$get['eddate'].' 23:59');
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
			'search_customer_userid'=>$search_customer_userid
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
        return $this->view->render('personal_info',['agent'=>$agent,'frontUrl'=>$frontUrl]);
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
		public function cus_bank_info($request, $response)
    {
        return $this->view->render('cus_bank_info');
	}
		public function cus_withdraw($request, $response)
    {
        return $this->view->render('cus_withdraw');
	}
		public function self_quota_log_manager($request, $response)
    {
        return $this->view->render('self_quota_log_manager');
	} 
}
