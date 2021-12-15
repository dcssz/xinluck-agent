<?php
namespace App\Controllers;

use Illuminate\Database\Capsule\Manager as DB;
use stdClass;
use Interop\Container\ContainerInterface;
use App\Extensions\AdminBase;
use App\Extensions\Functions;
use App\Models\News as NewsModel;
use App\Models\Config as ConfigModel;
use App\Models\Register as RegisterModel;
use App\Models\User as User;
class Admin extends AdminBase
{
	public function __Construct(ContainerInterface $container)
    {
		parent::__Construct($container);
	}

	public function index($request, $response, $args)
    {
		
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
        return $this->view->render('cus_wd_quota_log_manager');
	}

	public function cusQuotaLogManager($request, $response)
    {
        return $this->view->render('cus_quota_log_manager');
	}

	public function agentQuotaLogManager($request, $response)
    {
        return $this->view->render('agent_quota_log_manager');
	}

	public function allCalcReportManager($request, $response)
    {
        return $this->view->render('all_calc_report_manager');
	}

	public function gameReportManager($request, $response)
    {
        return $this->view->render('game_report_manager');
	}

	public function cusInstantBetInfoManager($request, $response)
    {
        return $this->view->render('cus_instant_bet_info_manager');
	}

	public function cusBetInfoManager($request, $response)
    {
        return $this->view->render('cus_bet_info_manager');
	}

	public function cusReportManager($request, $response)
    {
        return $this->view->render('cus_report_manager');
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
        return $this->view->render('personal_info');
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
