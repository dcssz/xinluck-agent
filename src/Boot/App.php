<?php

namespace App\Boot;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Acl\Guard;

class App extends \Slim\App {
	public function __construct(array $userSettings = array(), $role = 'guest') {
		parent::__construct($userSettings);

		$container = $this->getContainer();
		$container->register(new EloquentServiceProvider());
		$container->register(new AclServiceProvider());
		$this->add(new Guard($container->get('acl'), $role));
		/*
		$this->add(function(Request $request, Response $response,callable $next){
			if(!isset($_SESSION['id'])){
				return $response->withRedirect('/agent/login'); 
			}
			return $next($request,$response);
		}); 
		*/
		//$this->setHandlers();
		$this->setRoute();
		
	}

	public function setRoute() {
		$this->get('/[index]', \App\Controllers\Home::class . ':index');

		//后台
        {
            $this->get('/agent[/index]', \App\Controllers\Admin::class . ':index');
			$this->get('/agent/', \App\Controllers\Admin::class . ':index');
            $this->get('/agent/home', \App\Controllers\Admin::class . ':home');
            $this->get('/agent/news', \App\Controllers\Admin::class . ':news');
			
			$this->get('/agent/list_news', \App\Controllers\Admin\News::class . ':listNews');
            $this->get('/agent/marquee', \App\Controllers\Admin::class . ':marquee');
            $this->get('/agent/marquee_edlitor', \App\Controllers\Admin::class . ':marquee');
            $this->get('/agent/site_message', \App\Controllers\Admin::class . ':siteMessage');
            $this->get('/agent/banner', \App\Controllers\Admin::class . ':banner');
            $this->get('/agent/register', \App\Controllers\Admin::class . ':register');
			$this->post('/agent/save_register', \App\Controllers\Admin::class . ':saveRegister');
            $this->get('/agent/sys_service', \App\Controllers\Admin::class . ':sysService');
			$this->post('/agent/sys_service_save', \App\Controllers\Admin::class . ':sysServiceSave');
            $this->get('/agent/customer_info', \App\Controllers\Admin::class . ':customerInfo');
            $this->get('/agent/customer_bank_info', \App\Controllers\Admin::class . ':customerBankInfo');
            $this->get('/agent/customer_grade', \App\Controllers\Admin::class . ':customerGrade');
            $this->get('/agent/customer_mark', \App\Controllers\Admin::class . ':customerMark');
            $this->get('/agent/adjust_quota', \App\Controllers\Admin::class . ':adjustQuota');
            $this->get('/agent/online_customer', \App\Controllers\Admin::class . ':onlineCustomer');
           
			$this->get('/agent/online_cus_op', \App\Controllers\Admin\User::class . ':onlineCusOp');
            $this->get('/agent/news_editor', \App\Controllers\Admin::class . ':newsEditor');
            $this->post('/agent/news_editor', \App\Controllers\Admin::class . ':newsEditor');
            $this->post('/agent/save_news', \App\Controllers\Admin\News::class . ':saveNews');
            $this->post('/agent/delete_news', \App\Controllers\Admin\News::class . ':deleteNews');
            $this->get('/agent/login', \App\Controllers\Admin::class . ':login');
            $this->get('/logout', \App\Controllers\Admin::class . ':login');
            $this->post('/agent/login_check', \App\Controllers\Admin::class . ':loginCheck');
			//代理管理
			$this->get('/agent/agent_info_manager', \App\Controllers\Admin\Agent::class . ':agentInfoManager');
			$this->get('/agent/list_agent_infos', \App\Controllers\Admin\Agent::class . ':listAgentInfos');
			$this->get('/agent/agent_info_editor', \App\Controllers\Admin\Agent::class . ':agentInfoEditor');
			$this->post('/agent/save_agent_info', \App\Controllers\Admin\Agent::class . ':saveAgentInfo');
			$this->get('/agent/effect_cus_rule_manager', \App\Controllers\Admin\Agent::class . ':effectCusRuleManager');
			$this->get('/agent/list_effect_cus_rules', \App\Controllers\Admin\Agent::class . ':listEffectCusRules');
			$this->post('/agent/effect_cus_rule_editor', \App\Controllers\Admin\Agent::class . ':effectCusRulesEditor');
			$this->post('/agent/save_effect_cus_rule', \App\Controllers\Admin\Agent::class . ':saveEffectCusRules');

			$this->get('/agent/commission_rule_manager', \App\Controllers\Admin\Agent::class . ':commissionRuleManager');
			$this->get('/agent/retreat_rule_manager', \App\Controllers\Admin\Agent::class . ':retreatRuleManager');
			$this->get('/agent/extra_commission_rule_manager', \App\Controllers\Admin\Agent::class . ':extraCommissionRuleManager');
			$this->get('/agent/period_manager', \App\Controllers\Admin\Agent::class . ':periodManager');
			$this->get('/agent/period_audit_manager', \App\Controllers\Admin\Agent::class . ':periodAuditManager');
			//遊戲管理
			$this->get('/agent/game_store_info_manager', \App\Controllers\Admin\Game::class . ':gameStoreInfoManager');
			$this->get('/agent/list_game_stores', \App\Controllers\Admin\Game::class . ':listGameStores');
			$this->post('/agent/change_game_store_status', \App\Controllers\Admin\Game::class . ':changeGameStoreStatus');
			$this->post('/agent/game_store_editor', \App\Controllers\Admin\Game::class . ':gameStoreEditor');
			$this->post('/agent/save_game_store', \App\Controllers\Admin\Game::class . ':saveGameStore');

			$this->get('/agent/game_category_info_manager', \App\Controllers\Admin\Game::class . ':gameCategoryInfoManager');
			$this->get('/agent/list_games', \App\Controllers\Admin\Game::class . ':listGames');
			$this->post('/agent/change_game_status', \App\Controllers\Admin\Game::class . ':changeGameStatus');
			$this->post('/agent/game_editor', \App\Controllers\Admin\Game::class . ':gameEditor');
			$this->post('/agent/save_game', \App\Controllers\Admin\Game::class . ':saveGame');

			$this->get('/agent/game_mark_manager', \App\Controllers\Admin\Game::class . ':gameMarkManager');
			$this->get('/agent/list_game_marks', \App\Controllers\Admin\Game::class . ':listGameMarks');
			$this->post('/agent/game_mark_editor', \App\Controllers\Admin\Game::class . ':gameMarkEditor');
			$this->post('/agent/save_game_mark', \App\Controllers\Admin\Game::class . ':saveGameMark');

			$this->get('/agent/game_category_gain_manager', \App\Controllers\Admin\Game::class . ':gameCategoryGainManager');
			//金流設定
			$this->get('/agent/payment_pattern_manager', \App\Controllers\Admin::class . ':paymentPatternManager');
			$this->get('/agent/sys_payment_manager', \App\Controllers\Admin::class . ':sysPaymentManager');
			$this->get('/agent/payment_merchant_manager', \App\Controllers\Admin::class . ':paymentMerchantManager');
			$this->get('/agent/payment_company_manager', \App\Controllers\Admin::class . ':paymentCompanyManager');
			//金流管理
			$this->get('/agent/merchant_deposit_orders_manager', \App\Controllers\Admin::class . ':merchantDepositOrdersManager');
			$this->get('/agent/company_deposit_orders_manager', \App\Controllers\Admin::class . ':companyDepositOrdersManager');
			$this->get('/agent/mem_withdraw_orders_manager', \App\Controllers\Admin::class . ':memWithdrawOrdersManager');
			$this->get('/agent/agent_withdraw_orders_manager', \App\Controllers\Admin::class . ':agentWithdrawOrdersManager');
			$this->get('/agent/manual_payment_manager', \App\Controllers\Admin::class . ':manualPaymentManager');
			$this->get('/agent/cus_withdraw_audit_manager', \App\Controllers\Admin::class . ':cusWithdrawAuditManager');
			//優惠管理
			$this->get('/agent/discount_category_manager', \App\Controllers\Admin::class . ':discountCategoryManager');
			$this->get('/agent/discount_manager', \App\Controllers\Admin::class . ':discountManager');
			$this->get('/agent/cus_discount_audit_manager', \App\Controllers\Admin::class . ':cusDiscountAuditManager');
			$this->get('/agent/cus_discount_apply_manager', \App\Controllers\Admin::class . ':cusDiscountApplyManager');
			$this->get('/agent/cus_retreat_set_manager', \App\Controllers\Admin::class . ':cusRetreatSetManager');
			$this->get('/agent/cus_retreat_audit_manager', \App\Controllers\Admin::class . ':cusRetreatAuditManager');
			//報表管理
			$this->get('/agent/cus_wd_quota_log_manager', \App\Controllers\Admin::class . ':cusWdQuotaLogManager');
			$this->get('/agent/cus_quota_log_manager', \App\Controllers\Admin::class . ':cusQuotaLogManager');
			$this->any('/agent/cus_quota_log_op', \App\Controllers\Admin\Report::class . ':cusQuotaLog');
			$this->get('/agent/agent_quota_log_manager', \App\Controllers\Admin::class . ':agentQuotaLogManager');
			$this->any('/agent/agent_quota_log_op', \App\Controllers\Admin\Report::class . ':agentQuotaLog');
			$this->get('/agent/all_calc_report_manager', \App\Controllers\Admin::class . ':allCalcReportManager');
			$this->get('/agent/all_calc_agent_report_manager', \App\Controllers\Admin::class . ':allCalcAgentReportManager');
			$this->get('/agent/game_report_manager', \App\Controllers\Admin::class . ':gameReportManager');
			$this->get('/agent/cus_instant_bet_info_manager', \App\Controllers\Admin::class . ':cusInstantBetInfoManager');
			$this->get('/agent/cus_bet_info_manager', \App\Controllers\Admin::class . ':cusBetInfoManager');
			$this->any('/agent/cus_bet_info', \App\Controllers\Admin::class . ':cusBetInfo');
			$this->get('/agent/cus_report_manager', \App\Controllers\Admin::class . ':cusReportManager');
			$this->get('/agent/agent_report_manager', \App\Controllers\Admin::class . ':agentReportManager');
			$this->get('/agent/change_order_logs_manager', \App\Controllers\Admin::class . ':changeOrderLogsManager');
			//系統管理
			$this->get('/agent/cus_ip_manager', \App\Controllers\Admin::class . ':cusIpManager');
			$this->get('/agent/employee_manager', \App\Controllers\Admin::class . ':employeeManager');
			$this->get('/agent/sys_func_set_manager', \App\Controllers\Admin::class . ':sysFuncSetManager');
			
			//代理
			$this->get('/agent/personal_info', \App\Controllers\Admin::class . ':personal_info');
		 
			$this->get('/agent/cus_info_manager', \App\Controllers\Admin::class . ':cus_info_manager');
			
			$this->any('/agent/cus_info_editor', \App\Controllers\Admin\User::class . ':cusInfoEditor');
			$this->any('/agent/cus_info_editor_op', \App\Controllers\Admin\User::class . ':cusInfoEditorOp');
			$this->post('/agent/save_customer', \App\Controllers\Admin\User::class . ':saveCustomer');
			
			$this->get('/agent/list_cus_infos', \App\Controllers\Admin\User::class . ':listCusInfos');
			$this->get('/agent/sub_customer_manager', \App\Controllers\Admin::class . ':sub_customer_manager');
			$this->get('/agent/cus_bank_info', \App\Controllers\Admin::class . ':cus_bank_info');
			$this->get('/agent/cus_withdraw', \App\Controllers\Admin::class . ':cus_withdraw');
			$this->get('/agent/online_cus_manager', \App\Controllers\Admin::class . ':onlineCustomer');
			$this->get('/agent/self_quota_log_manager', \App\Controllers\Admin::class . ':self_quota_log_manager');
        }
		
		
	}

	public function setHandlers() {
		$c = $this->getContainer();
		$c['phpErrorHandler'] = function ($c) {
			return function ($request, $response, $error) use ($c) {
				$httpErrorCode = array('200' => 'OK',
					'201' => 'CREATED',
					'202' => 'Accepted',
					'203' => 'Partial Information',
					'204' => 'No Response',
					'400' => 'Bad request', //参数错误
					'401' => 'Unauthorized',
					'402' => 'Payment Required',
					'403' => 'Forbidden',
					'404' => 'Not found',
					'500' => 'Server Internal Error',
					'501' => 'Not implemented',
				);

				$ec = new \stdClass;
				$ec->code = $error->getCode();
				//$ec->msg = $httpErrorCode[$ec->code];
				$ec->msg = $httpErrorCode[isset($ec->code)];
				return $c['response']->withStatus(200)
					->withHeader('Content-Type', 'application/json')
					->withJson($ec);
			};
		};

		$c['errorHandler'] = function ($c) {
			return function ($request, $response, $error) use ($c) {
				if ($error instanceof \QrPay\Acl\Exception) {
					throw $error;
				} else {
					$handler = new \Slim\Handlers\Error(true);
					return $handler->__invoke($request, $response, $error);
				}
			};
		};

		/*
		$c['notAllowedHandler'] = function ($c) {
			return function ($request, $response) use ($c) {
				$ec = new \stdClass;
				$ec->code = 405;
				$ec->msg = 'Forbidden';
				return $c['response']->withStatus(200)
					->withHeader('Content-Type', 'application/json')
					->withJson($ec);
			};
		};
		*/
	}

	/**
	 * @return \Slim\Http\Response
	 */
	public function invoke($method, $path, $data = array()) {
		//Make method uppercase
		$method = strtoupper($method);
		$options = array(
			'REQUEST_METHOD' => $method,
			'REQUEST_URI' => $path,
			'SCRIPT_NAME' => '/api/index.php',
		);
		if ($method === 'GET') {
			$options['QUERY_STRING'] = http_build_query($data);
		} else {
			$params = json_encode($data);
		}
		// Prepare a mock environment
		$env = \Slim\Http\Environment::mock($options);
		$uri = \Slim\Http\Uri::createFromEnvironment($env);
		$headers = \Slim\Http\Headers::createFromEnvironment($env);
		$serverParams = $env->all();
		$body = new \Slim\Http\RequestBody();
		// Attach JSON request
		if (isset($params)) {
			$headers->set('Content-Type', 'application/json;charset=utf8');
			$body->write($params);
		}
		$this->request = new \Slim\Http\Request($method, $uri, $headers, array(), $serverParams, $body);
		$response = new \Slim\Http\Response();
		// Process request
		return $this->process($this->request, $response);
	}
}
