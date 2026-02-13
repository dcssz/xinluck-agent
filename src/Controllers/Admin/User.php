<?php
namespace App\Controllers\Admin;

use Illuminate\Database\Capsule\Manager as DB;
use stdClass;
use Interop\Container\ContainerInterface;
use App\Extensions\AdminBase;
use App\Extensions\Functions;

use App\GameApp\GameFactory;
use App\Models\User as UserModel;
use App\Models\UserMoney as UserMoney;
use App\Models\CusGrade as CusGradeModel;
use App\Models\CusMark as CusMarkModel;
use App\Models\Game;
use App\Models\GameUser as GameUserModel;
use App\Models\GameStoreType as GameStoreTypeModel;
use App\Models\Config;
use App\Models\UserLog;
use App\Models\Menu;
use App\Models\MenuLocal;
use App\Models\UserPermission;
use App\Models\UserVerification; 
use App\Models\SystemNotice; 
use App\Models\WithdrawAudit;
use App\Models\Withdraw;
use App\Models\DepositOrder;
use App\Models\Bet;
use App\Models\UserGroup;
use App\Models\RetreatRule as RetreatRuleModel;
use App\Models\RetreatRuleDetail as RetreatRuleDetailModel;

class User extends AdminBase
{
	public function __Construct(ContainerInterface $container)
    {
		parent::__Construct($container);
	}

	public function onlineCusOp($request, $response)
    {
		$get = $request->getQueryParams();
		//$begin = date('Y-m-d H:i:s',strtotime('-10 minute'));
		$search_customer_userid = isset($get['search_customer_userid'])?$get['search_customer_userid']:'';
		$where =array();
		$where[] = array('livetime','>=', strtotime('-20 minute'));
		$where[] = array('role','customer');
		$where[] = array('parents', 'like','%/'.$_SESSION['id'].'/%');
		if(isset($search_customer_userid)){
			$where[] = array('username','like','%'.$search_customer_userid.'%');
		}
		$users = UserModel::where($where)->get();
		$result = array();
		foreach($users as $row){
			 
			//$new->release_status='<a class="status-btn status-open" href="javascript:void(0);">'._('常駐').'</a>';
			//$new->status='<a class="status-btn status-open" href="javascript:void(0);">'._('啟用').'</a>';
			$action = "--";//"<a href=\"news_editor?etype=edit&edit_news_id=".$new->id."\" class=\"btn btn-xs default\"> <i class=\"fa fa-pencil\"></i> 修改 </a>\n\t\t\t\t\t\t\t\t<a href=\"javascript:void(0);\" onclick=\"delete_item(".$new->id.");\" class=\"btn btn-xs default\"> <i class=\"fa fa-trash-o\"></i> 刪除 </a>";
		
			$formatItem = array();
			$formatItem[]=$row->username;
			$formatItem[]=date("Y-m-d H:i:s", $row->lgtime);
			$formatItem[]=$row->lgip;
			$formatItem[]=$row->updated_at;
			$formatItem[]=$action;
			$result[] = $formatItem;
		}
		//$news = $news->toArray();
		$count = UserModel::where($where)->count();
		if($result == null)$result = [];
		$draw = 1;
		if(isset($get['draw']))
			$draw = intval($get['draw']);
		$result = Functions::listData($draw ,$count,$count,$result);
		return $response->withJson($result);
	}
	
	public function customerInfo($request, $response)
    {
		$get = $request->getQueryParams();
		$cusGrades = CusGradeModel::all();
		$cusMarks = CusMarkModel::all();
		$top_cus_id = isset($get["top_cus_id"]) ? $get["top_cus_id"] : $_SESSION['id'];
		$user = UserModel::find($top_cus_id);
		$agent = UserModel::find($_SESSION['id']);
		$frontUrl = Config::where('name','baseUrl')->pluck('value')->first();

        return $this->view->render('cus_info_manager', [
			"cusGrades" => $cusGrades,
			"cusMarks" => $cusMarks,
			"search_identity_status" => isset($get['search_identity_status']) ? $get['search_identity_status'] : -1,
			"top_cus_id" => $top_cus_id,
			"user" => $user,
			"agent" => $agent,
			'frontUrl' => $frontUrl
		]);
	}
 
	public function cusInfoLogList($request, $response)
    {
		$get = $request->getQueryParams();

		$where = array();
		$where[] = array('user_id',$get['user_id']);
		$start = 0;
		if(isset($get['start']))
			$start = intval($get['start']);
		
		$length = 10;
		if(isset($get['length']))
			$length = intval($get['length']);
		$user = UserModel::find($get['user_id']);
		$datas = UserLog::where($where)->skip($start)->take($length)->orderBy('id','desc')->get();
		$count = UserLog::where($where)->count();
		 
		 return $this->view->render('cus_info_log_list', [
			"datas" => $datas,
			"count" => $count,
			'user'=>$user
		]);
	}
	
	public function cusInfoLogDetail($request, $response)
    {
		$get = $request->getQueryParams();

	 
		$date = UserLog::find($get['id']);
		$user = UserModel::find($date->user_id);
		 return $this->view->render('cus_info_log_detail', [
			"log" => $date,
			'user'=>$user
		]);
	}
	public function listCusInfos($request, $response)
    {
		$get = $request->getQueryParams();

		$where = array();
		//$where[] = array('status',1);
		$offset = 0;
		if(isset($get['offset']))
			$offset = intval($get['offset']);
		
		$limit = 10;
		if(isset($get['limit']))
			$limit = intval($get['limit']);
		
		// $where[] = array('role', 'customer');

		if ($get['search_customer_userid'] != '') {
			if (isset($get['fuzzy_search']) && $get['fuzzy_search'] == 1) {
				$where[] = array('username', 'like', "%" . $get['search_customer_userid'] . "%");
			} else {
				$where[] = array('username', $get['search_customer_userid']);
			}
		}

		if ($get['search_customer_name'] != '') {
			$where[] = array('nickname', $get['search_customer_name']);
		}

		if ($get['search_cell_phone'] != '') {
			$where[] = array('mobile', $get['search_cell_phone']);
		}

		if ($get['search_status'] != -1) {
			$where[] = array('valid', $get['search_status']);
		}

		if ($get['search_identity_status'] != -1) {
			$where[] = array('identity_status', $get['search_identity_status']);
		}
		
		if ($get['search_grade'] != -1) {
			$where[] = array('cus_grade_id', $get['search_grade']);
		}

		if ($get['search_mark'] != -1) {
			$where[] = array('cus_mark_id', $get['search_mark']);
		}

		if ($get['search_invite_code'] != '') {
			$where[] = array('invite_code', $get['search_invite_code']);
		}
		$field = 'id';
		if ($get['search_order_by_field'] == 'create_datetime') {
			$field = 'created_at';
		}

		if ($get['top_cus_id'] == $_SESSION['id']) {
			//查看自己 列出所有線下
			$where[] = array('parents', 'like','%/'.$get['top_cus_id'].'/%');
		} else {
			$where[] = array('pid', $get['top_cus_id']);
		}
		
		 
		$order = $get['search_order_by'];
		 
		$datas = UserModel::with('cusGrade', 'cusMark')->where($where)->whereIn('role', ['customer'])->offset($offset)->take($limit)->orderBy('id', $order)->get();
		$count = UserModel::where($where)->whereIn('role', ['customer'])->count();
		$frontUrl = Config::where('name','frontUrl')->pluck('value')->first();
		$frontUrl .= '/register';
		$min = collect($datas)->min('level');
		$result = array();
		foreach($datas as $data){
			/*if ($data->level == $min) {
				$data->pid = 0;
			}*/
			$data->amout_in_total = DepositOrder::where('user_id', $data->id)->where('status', 100)->sum('apply_amount');
			$data->amout_out_total = Withdraw::where('user_id', $data->id)->where('status', 100)->sum('amount');
			$data->bet_total = Bet::where('user_id', $data->id)->sum('valid_amount');
			$data->invite_count = UserModel::where('role', 'customer')->where('pid', $data->id)->count();
			//$data->invite_code_url = "<span>{$data->invite_code}</span><br><a href='javascript:void(0);' onclick='copy_link(this);'>{$frontUrl}?invite_code={$data->invite_code}</a>";
			$data->invite_code_url = "";
			$action = "<div class=\"paction-btn-div\">\n\t\t\t\t\t\t\t\t";
			$action .= "<a href=\"javascript:void(0);\" onclick=\"show_qr_code('{$frontUrl}?invite_code={$data->invite_code}');\" class=\"btn btn-xs default\"> <i class=\"fa fa-pencil\"></i> QR code </a>\n\t\t\t\t\t\t\t\t";
			if ($_SESSION['isChild'] == 0) {
				$action .= "<a href=\"cus_info_editor?etype=edit&edit_cus_id={$data->id}\" class=\"btn btn-xs default\"> <i class=\"fa fa-pencil\"></i> 資料 </a>\n\t\t\t\t\t\t\t\t";
			}
			$action .= "<a href=\"cus_instant_bet_info_manager?search_customer_userid={$data->username}&search_level=16&is_back=1\" class=\"btn btn-xs default\"> <i class=\"fa fa-pencil\"></i> 投注 </a>\n\t\t\t\t\t\t\t\t";
			$action .= "<a href=\"cus_report_manager?search_customer_userid={$data->username}&search_level=16&is_back=1\" class=\"btn btn-xs default\"> <i class=\"fa fa-pencil\"></i> 報表 </a>\n\t\t\t\t\t\t\t\t";
			$action .= "<a href=\"cus_quota_log_manager?search_customer_userid={$data->username}&is_back=1\" class=\"btn btn-xs default\"> <i class=\"fa fa-pencil\"></i> 日誌 </a>\n\t\t\t\t\t\t\t\t";
			$action .= "<a href=\"cus_info_log_list?user_id={$data->id}&is_back=1\"  class=\"btn btn-xs default\"> <i class=\"fa fa-pencil\"></i> 修改歷程 </a>\n\t\t\t\t\t\t\t\t";
			if ($_SESSION['isChild'] == 0) {
				$action .= "<a href=\"javascript:void(0);\" onclick=\"show({$data->id});\" class=\"btn btn-xs default\"> <i class=\"fa fa-pencil\"></i> 調額 </a>\n\t\t\t\t\t\t\t\t";
				$action .= "<a href=\"javascript:void(0);\" onclick=\"return_to_main_account({$data->id});\" class=\"btn btn-xs default\"> <i class=\"fa fa-pencil\"></i> 取回主帳 </a>\n\t\t\t\t\t\t\t\t";
			}
			$action .= "</div>";

			$data->action = $action;
		}

		$result = $datas;

		if($result == null)$result = [];
		$draw = 1;
		if(isset($get['draw']))
			$draw = intval($get['draw']);
		$result = Functions::listData($draw ,$count,$count,$result);
		return $response->withJson($result);
	}
	
	public function cusInfoManagerOp($request, $response)
    {
		$post = $request->getParsedBody();
		$get = $request->getQueryParams();
		$pdisplay = $get['pdisplay'];
		$edit_cus_id = $post['edit_cus_id'];
		if('request_identity_ver_div' == $pdisplay){
			$user = UserModel::with('verification')->find($edit_cus_id);
			if($user->verification == null)
				$user->verification = new UserVerification;
			return $response->withJson($user); 
		}elseif('save_identity_ver' ===$pdisplay){
			$ver_type=$post['ver_type'];
			$identity_name=$post['identity_name'];
			$identity_number=$post['identity_number'];
			$personal_pic1=isset($post['personal_pic_path'])?$post['personal_pic_path'][0]:'';
			$personal_pic2=isset($post['personal_pic_path'])?$post['personal_pic_path'][1]:'';
			$personal_pic3=isset($post['personal_pic_path'])?$post['personal_pic_path'][2]:'';
			$identity_status=$post['identity_status'];
			$edit_ver_id = $post['edit_ver_id'];
			$ver = UserVerification::find($edit_ver_id);
			if($ver != null){
				$ver->ver_type = $ver_type;
				$ver->identity_name = $identity_name;
				$ver->identity_number = $identity_number;
				$ver->photo1 = $personal_pic1;
				$ver->photo2 = $personal_pic2;
				$ver->photo3 = $personal_pic3;
				$ver->save();
				$user = UserModel::find($edit_cus_id);
				if($user != null){
					$user->identity_status = $identity_status;
					$user->save();
				}
				
				//通知数量变更
				$cnt = UserModel::where('identity_status' ,'<=',2)->count();
				$notice = SystemNotice::where('project','cus_info_manager')->first();
				if($notice != null){
					$notice->cnt  = $cnt ;
					$notice->save();
				}
				$table = '{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(-1, {\"target\":\"kangCusInfoManager\"})  , 5);window.location.reload();"}]}}';
				return  ($table);
			}else{
				$ver = new UserVerification;
				$ver->user_id = $edit_cus_id;
				$ver->ver_type = $ver_type;
				$ver->identity_name = $identity_name;
				$ver->identity_number = $identity_number;
				$ver->photo1 = $personal_pic1;
				$ver->photo2 = $personal_pic1;
				$ver->photo3 = $personal_pic1;
				$ver->save();
				$table = '{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(-1, {\"target\":\"kangCusInfoManager\"})  , 5);window.location.reload();"}]}}';
				return  ($table);
			}
		}
	}
	public function cusInfoEditor($request, $response)
    {
		$post = $request->getParsedBody();
		$get = $request->getQueryParams();
		$etype = isset($get['etype']) ? $get['etype'] : $post['etype'];
		$pdisplay =  isset($get['pdisplay']) ? $get['pdisplay']:'';
		$edit_cus_id = isset($get['edit_cus_id']) ? $get['edit_cus_id'] : 0;
		$btn_type = isset($get['btn_type']) ? $get['btn_type']:'basic-info-area';
		$balanceHtml = array();
		if($pdisplay =='get_data_content'){

			//$result = '{"root":{"ajaxdata":[{"spanid":"#wallet-info-area","rtntext":"load balance"},{"spanid":"javascript","rtntext":"page_content_mask_hide();initial_nav_all_show();initial_all_set();change_save_btn_area(\'wallet-info-area\');init_portlet_tiile_tools(\'wallet-info-area\');App.init();reload_quota();$(\"#top-save-btn-area\").hide();"}]}}';
			//return $result;
		 
		}
		//详细资料------------------------------------------
		$GameStoreTypes = array();
		$user_open_game_ids = array();
		$retreatRuleArray = array();
		$parentRetreatRuleArray = array();
		if ($etype  == 'edit') {
			//编辑
			$user = UserModel::find($edit_cus_id);
			$top_cus_id = $user->pid;

			$games = Game::all();
			$games->load(["gameUser" => function ($query) use ($edit_cus_id) {
				$query->where('user_id', $edit_cus_id);
			}]);
			//开放游戏设定--------------------------------------
			$GameStoreTypes = GameStoreTypeModel::with('games')->get();
			$user_open_game_ids = $user->games()->pluck('game_id')->toArray();
			 
			//parent退水設定 (整理成前台好用的)
			$games = Game::get();
			$parentRetreatRule = RetreatRuleModel::with('ruleDetailsGames')->where('user_id', $top_cus_id)->orderBy('init_date', 'desc')->first();
			if ($parentRetreatRule) {
				foreach ($games as $game) {
					foreach ($parentRetreatRule['ruleDetailsGames'] as $item) {
						if ($game->id == $item->game_id) {
							$parentRetreatRuleArray[$game->id] = ['percent' => $item['percent']];
						}
					}
				}
			} else {
				foreach ($games as $game) {
					if ($top_cus_id == 0 || $top_cus_id == 1) {
						//沒有上層或上層是管理員
						$parentRetreatRuleArray[$game->id] = ['percent' => '-'];
					} else {
						$parentRetreatRuleArray[$game->id] = ['percent' => 0];
					}
					
				}
			}
			//退水設定 (整理成前台好用的)
			$games = Game::get();
			$retreatRule = RetreatRuleModel::with('ruleDetailsGames')->where('user_id', $edit_cus_id)->orderBy('init_date', 'desc')->first();
			if ($retreatRule) {
				foreach ($games as $game) {
					foreach ($retreatRule['ruleDetailsGames'] as $item) {
						if ($game->id == $item->game_id) {
							$retreatRuleArray[$game->id] = ['percent' => $item['percent']];
						}
					}
				}
			} else {
				foreach ($games as $game) {
					$retreatRuleArray[$game->id] = ['percent' => 0];
				}
			}
		} else  {
			//新增
			$user = new UserModel;
			$top_cus_id = isset($get['top_cus_id']) ? $get['top_cus_id'] : 1;
		}
		
		$cusMarks = CusMarkModel::all();

		//可用真人限紅組 從上層來判斷
		$parent = UserModel::find($top_cus_id);
		if ($parent->role == 'topagent') {
			$userGroups = UserGroup::all();
		} else {
			$user_group_ids = explode(',', $parent->user_group_id);
			$userGroups = UserGroup::whereIn('id', $user_group_ids)->get();
		}
		
		
		//第三方账号及钱包余额--------------------------------
		$games = Game::with(["gameUser" => function ($query) use ($edit_cus_id) {
				$query->where('user_id', $edit_cus_id)->first();
			}])->where('status',1)->get();
		// return $response->withJson($result);


        return $this->view->render('cus_info_editor', [
			'btn_type'=>$btn_type,
			'user'=>$user,
			'etype'=>$etype,
			'title'=>'editor',
			"cusMarks" => $cusMarks,
			"userGroups" => $userGroups,
			"top_cus_id" => $top_cus_id,
			"balanceHtml" => $balanceHtml,
			'games'=>$games,
			"GameStoreTypes" => $GameStoreTypes,
			"user_open_game_ids" => $user_open_game_ids,
			"parentRetreatRuleArray" => $parentRetreatRuleArray,
			"retreatRuleArray" => $retreatRuleArray,
		]);
	}
	
	public function cusInfoEditorOp($request, $response)
    {
		$post = $request->getParsedBody();
		$get = $request->getQueryParams();
		 
		$pdisplay = $get['pdisplay'];
		$edit_cus_id = isset($get['edit_cus_id']) ? $get['edit_cus_id'] : $post['edit_cus_id'];
		$balanceHtml = array();
		if ($pdisplay  == 'request_main_quota') {
			$user = UserModel::find($edit_cus_id); 
			$result = '{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"show_quota(\'main-quota\', \'1\', \''.$user->balance.'\');"}]}}';
			return $result;
			
		}elseif ($pdisplay  == 'request_gstore_quota') {
			//编辑
			$edit_cus_id = $post['edit_cus_id'];
			$game_store= $post['game_store'];
			
		 
			$user = UserModel::find($edit_cus_id); 
			 
			$game = Game::with(["gameUser" => function ($query) use ($edit_cus_id) {
				$query->where('user_id', $edit_cus_id)->first();
			}])->where('id',$game_store)->first();
			if(count($game->gameUser) == 0){
				$result = '{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"show_ext_game_cus_userid(\'gstore-'.$game_store.'-cus-userid\', \''.e('未註冊').'\'); show_quota(\'gstore-'.$game_store.'-quota\', \'2\', \'0\');"}]}}';
				return $result;
			}
			$gameApp = GameFactory::createInstance($game->code);
			$result = $gameApp->getBalance(['userName'=>$user->username, 'game_id'=>$game->id, 'user_id'=> $user->id]);
			
			$balance = 0;
			if (isset($result['status']) && $result['status']) {
				$balance = $result['balance'];
			}  
			
			$result = '{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"show_ext_game_cus_userid(\'gstore-'.$game_store.'-cus-userid\', \''.$game->gameUser[0]->game_username.'\'); show_quota(\'gstore-'.$game_store.'-quota\', \'1\', \''.$balance.'\');"}]}}';
			return $result;
		}elseif($pdisplay  == 'return_to_main_account'){
			$edit_cus_id = $post['edit_cus_id'];
			$games = Game::where('status',1)->get();
			$user = UserModel::find($edit_cus_id);
			foreach($games as $game){
				$gameApp = GameFactory::createInstance($game->code);
				 
				$result = $gameApp->getBalance(['userName'=>$user->username,'user_id'=>$user->id, 'game_id'=>$game->id]);
				error_log(json_encode($result));
				if($result['status'] == true){
					$balance = intval($result['balance']);
					if($balance > 0){
						DB::beginTransaction();
						try{
							$updateUser = UserModel::lockForUpdate()->where('id',$edit_cus_id)->first(); 
							error_log(json_encode($updateUser));
							 
							if($updateUser == null)  throw new Exception(_('会员不存在'));
							$newBalance =  $updateUser->balance + $balance;
							 
							$log = new UserMoney;
							$log->username = $user->username;
							$log->assets = $updateUser->balance;
							$log->money = $balance;
							$log->balance =  $updateUser->balance + $balance;
							$log->reason = $game->name . ' 轉至 主帳戶';
							$log->order_id = 'play-'.date('YmdHis');
							$log->operate_type = 1;
							$log->trans_type = 2;
							$log->operator = $_SESSION['username'];
							$log->created_at = date('Y-m-d H:i:s');
							$log->updated_at = date('Y-m-d H:i:s');
							$log->status = 1;
							$log->save(); 
							
							$updateUser->balance += $balance;
							$updateUser->save();
							
							DB::commit();	
						}catch(\Exception $ex){
		
							DB::rollBack();
							error_log($ex);
						}
						
						try{
							$changeLog = $gameApp->changeBalance(['userName'=>$user->username,'amount'=>$balance, 'transBillno'=>$user->id.'_'.date('YmdHis'),'type'=>'OUT', 'user_id'=>$user->id, 'game_id'=>$game->id]);
							error_log(json_encode($changeLog));
						}catch(\Exception $ex){
							error_log($ex);
						}
					}
					
				}
					 
				
			}
			
			$OK = '{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'-7\', {\"target\":\"kangCusInfoEditor\"}));page_content_mask_hide();return_to_main_account_flag = 1;reload_quota();"}]}}';
			echo $OK;//$result;
		}
	}

	public function saveCustomer($request, $response)
    {
		$get = $request->getQueryParams();
		$post = $request->getParsedBody();
		$id = $post['edit_cus_id'];
		$etype = $post['etype'];
		$save_type = $post['save_type'];
		
		if ($save_type == 'basic-info') {
			$editInfo = '';
			
			if($etype == 'edit'){
				$user = UserModel::find($id);
				if ($post['customer_pass1'] != '') {
					if (strlen($post['customer_pass1']) < 3) {
						$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'6\', {\"target\":\"kangCusInfoEditor\"}));page_content_mask_hide();"}]}}');
						return $response->withJson($msg);
					}
					if ($post['customer_pass1'] != $post['customer_pass2']) {
						$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'5\', {\"target\":\"kangCusInfoEditor\"}));page_content_mask_hide();"}]}}');
						return $response->withJson($msg);
					}
					$user->password = crypt($post['customer_pass1'], '$1$' . substr(md5($user->username), 5, 8));
					$editInfo .= _('修改密碼').'<br>';
				}
				$user->role = $post['role'];
				
			} else {
				$user = new UserModel;
				if ($post['customer_userid'] == '') {
					$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'2\', {\"target\":\"kangCusInfoEditor\"}));page_content_mask_hide();"}]}}');
					return $response->withJson($msg);
				}
				if (strlen($post['customer_userid']) < 2 || strlen($post['customer_userid']) > 10) {
					$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'13\', {\"target\":\"kangCusInfoEditor\"}));page_content_mask_hide();"}]}}');
					return $response->withJson($msg);
				}
				if ($post['customer_pass1'] == '') {
					$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'3\', {\"target\":\"kangCusInfoEditor\"}));page_content_mask_hide();"}]}}');
					return $response->withJson($msg);
				}
				if (strlen($post['customer_pass1']) < 3) {
					$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'6\', {\"target\":\"kangCusInfoEditor\"}));page_content_mask_hide();"}]}}');
					return $response->withJson($msg);
				}
				if ($post['customer_pass1'] != $post['customer_pass2']) {
					$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'5\', {\"target\":\"kangCusInfoEditor\"}));page_content_mask_hide();"}]}}');
					return $response->withJson($msg);
				}
				$exist = UserModel::where('username', $post['customer_userid'])->first();
				if ($exist) {
					$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'11\', {\"target\":\"kangCusInfoEditor\"}));page_content_mask_hide();"}]}}');
					return $response->withJson($msg);
				}
				/*if ($post['cell_phone'] == '') {
					$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(\"请输入手机号码\");page_content_mask_hide();"}]}}');
					return $response->withJson($msg);
				}
				$exist = UserModel::where('mobile', $post['cell_phone'])->first();
				if ($exist) {
					$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'21\', {\"target\":\"kangCusInfoEditor\"}));page_content_mask_hide();"}]}}');
					return $response->withJson($msg);
				}*/
				$user->username = $post['customer_userid'];
				$user->password = crypt($post['customer_pass1'], '$1$' . substr(md5($post['customer_userid']), 5, 8));

				if (isset($post['top_cus_id'])) {
					$loginId = $post['top_cus_id'];
				} else {
					$loginId = $_SESSION['id'];
				}

				$user->pid = $loginId; //$post['top_cus_id'];
				$top_parent = UserModel::find($loginId);
				$user->parents = $top_parent->parents . $loginId ."/";
				$user->level = $top_parent->level + 1;
				
				$user->role = "customer";

				//檢查代理會員人數上限
				if ($top_parent->memberCount > 0) {
					$memberCount = UserModel::where('pid', $top_parent->id)->where('role', 'customer')->count();
					if ($memberCount >= $top_parent->memberCount) {
						$msgText = '超過代理會員人數上限';
						$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(\'' . $msgText . '\', {\"target\":\"kangAgentInfoEditor\"});page_content_mask_hide();"}]}}');
						return $response->withJson($msg);
					}
				}
			}
			if($user->nickname != $post['customer_name'])$editInfo .= _('修改昵稱').'<br>';
			$user->nickname = $post['customer_name'];

			if($user->valid != $post['customer_status']){
				if($post['customer_status'] == '1')
					$editInfo .= _('狀態:啟用').'<br>';
				elseif($post['customer_status'] == '2')
					$editInfo .= _('狀態:停押').'<br>';
				elseif($post['customer_status'] == '3')
					$editInfo .= _('狀態:鎖定').'<br>';
				elseif($post['customer_status'] == '4')
					$editInfo .= _('狀態:停用').'<br>';
			}
			$user->valid = $post['customer_status'];

			/*if($user->user_group_id != $post['user_group_id']) $editInfo .= _('真人限紅組').':'.$post['user_group_id'].'<br>';
			$user->user_group_id = $post['user_group_id'];

			if($user->live_balance_max != $post['live_balance_max']) $editInfo .= _('真人餘額上限').':'.$post['live_balance_max'].'<br>';
			$user->live_balance_max = $post['live_balance_max'];

			if($user->slot_balance_max != $post['slot_balance_max']) $editInfo .= _('電子餘額上限').':'.$post['slot_balance_max'].'<br>';
			$user->slot_balance_max = $post['slot_balance_max'];*/

			if($user->cus_mark_id != $post['mark_id']) $editInfo .= _('標籤設定').':'.$post['mark_id'].'<br>';
			$user->cus_mark_id = $post['mark_id'];;

			if($user->birthday != $post['birthday'])$editInfo .= _('生日').':'.$post['birthday'].'<br>';
			$user->birthday = $post['birthday'];

			if($user->email != $post['email'])$editInfo .= _('信箱').':'.$post['email'].'<br>';
			$user->email = $post['email'];

			if($user->line_id != $post['line'])$editInfo .= _('Line').':'.$post['line'].'<br>';
			$user->line_id = $post['line'];

			if($user->telegram != $post['telegram'])$editInfo .= _('telegram').':'.$post['telegram'].'<br>';
			$user->telegram = $post['telegram'];

			if($user->instagram != $post['instagram'])$editInfo .= _('instagram').':'.$post['instagram'].'<br>';
			$user->instagram = $post['instagram'];

			if($user->qq != $post['qq'])$editInfo .= _('qq').':'.$post['qq'].'<br>';
			$user->qq = $post['qq'];

			if($user->wechat != $post['wechat'])$editInfo .= _('wechat').':'.$post['wechat'].'<br>';
			$user->wechat = $post['wechat'];

			if($user->note != $post['notes'])$editInfo .= _('修改備註').':'.$post['notes'].'<br>';
			$user->note = $post['notes'];
			
			$user->save();
			
			
			if ($etype == 'add') {
				$user->invite_code = 'tjs' . ($user->id + 99);
				$user->save();
				$user->games()->sync(Game::pluck('id')->all());

				//跳轉退水設定頁面
				$result = [];
				$result['root']['ajaxdata'][] = [
					'spanid' => 'javascript',
					'rtntext' => 'location.href = "cus_info_editor?etype=edit&edit_cus_id='.$user->id. '&btn_type=retreat-info-area' .'";page_content_mask_hide();',
				];
				return $response->withJson($result);
				//$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'-1\', {\"target\":\"kangCusInfoEditor\"}));page_content_mask_hide();"}]}}');
			} else {
				
				if ($editInfo) {
					$userLog = new UserLog;
					$userLog->saveLog($id,1,'修改資料',$_SESSION['username'],$editInfo);
				}
				$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'-2\', {\"m1\":\"\\u57fa\\u672c\\u8cc7\\u6599\",\"target\":\"kangCusInfoEditor\"}));page_content_mask_hide();"}]}}');
			}
			return $response->withJson($msg);
		} elseif ($save_type == 'open-game-info') {
			//开放游戏设定
			$edit_cus_level = $post['edit_cus_level'];
			$game_status_arr = $post['game_status_arr'];
			$user = UserModel::find($id);
			$user->games()->sync($game_status_arr);


			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'-2\', {\"m1\":\"\\u57fa\\u672c\\u8cc7\\u6599\",\"target\":\"kangAgentInfoEditor\"}));page_content_mask_hide();"}]}}');
			return $response->withJson($msg);
		} elseif ($save_type == 'retreat-info') {
			//取得下個周日的日期
			$init_date = Functions::getNextSundayDate();

			//退水设定
			$retreat_game_arr = $post['retreat_game_arr'];

			//檢查有沒有超過上層
			$user = UserModel::find($id);
			$checkResult = $user->checkRetreatRuleNotExceedParent($retreat_game_arr);
		
			if (!$checkResult['success']) {
				$msgText = $checkResult['message'];
				$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(\'' . $msgText . '\', {\"target\":\"kangAgentInfoEditor\"});page_content_mask_hide();"}]}}');
				return $response->withJson($msg);
			}

			$hasRetreatRule = RetreatRuleModel::with('ruleDetailsGames')->where('user_id', $id)->count();
			if ($hasRetreatRule == 0) {
				//首次新增
				$data = new RetreatRuleModel;
				$data->user_id = $id;
				$data->init_date = null;
				$data->operator = $_SESSION['username'];
				$data->save();
			} else {
				//後續修改 
				$retreatRule = RetreatRuleModel::with('ruleDetailsGames')->where('user_id', $id)->where('init_date', $init_date)->first();
				if ($retreatRule == null) {
					$data = new RetreatRuleModel;
					$data->user_id = $id;
					$data->init_date = $init_date;
				} else {
					$data = $retreatRule;
					//先清除旧数据
					$details = RetreatRuleDetailModel::where('retreat_rule_id', $data->id)->get();
					if ($details) {
						foreach ($details as $item) {
							$item->games()->detach();
							$item->delete();
						}
					}
				}
				$data->operator = $_SESSION['username'];
				$data->save();
			}
			//新設計用不到 直接設0
			$detail = new RetreatRuleDetailModel();
			$detail->retreat_rule_id = $data->id;
			$detail->lower_limit = 0;
			$detail->upper_limit = 0;
			$detail->effect_cus_num = 0;
			$detail->save();
			
			$editInfo = '退水值:<br>';
			foreach ($retreat_game_arr as $game_id => $number) {
				if (!$number) {
					$number = 0;
				}
				$detail->games()->attach($game_id, ['percent' => $number]);

				$game = Game::find($game_id);
				$editInfo .= $game->name .':' . $number .'<br>';
			}
			$userLog = new UserLog;
			$userLog->saveLog($id,1,'設定退水',$_SESSION['username'],$editInfo);

			if ($hasRetreatRule == 0) {
				//首次新增
				$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'-2\', {\"m1\":\"\\u57fa\\u672c\\u8cc7\\u6599\",\"target\":\"kangAgentInfoEditor\"}));page_content_mask_hide();"}]}}');
				return $response->withJson($msg);
			} else {
				//後續修改
				$msgText = '儲存成功'.$init_date .' 12:00開始生效';
				$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(\'' . $msgText . '\', {\"target\":\"kangAgentInfoEditor\"});page_content_mask_hide();"}]}}');
				return $response->withJson($msg);
			}
		}
	}

	//资金调度
	public function adjustQuota($request, $response)
    {
		$get = $request->getQueryParams();
		$search_customer_userid = isset($get['search_customer_userid']) ? $get['search_customer_userid'] : '';
		
        return $this->view->render('adjust_quota_manager', [
			'search_customer_userid' => $search_customer_userid
		]);
	}

	public function listAdjustQuotas($request, $response)
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
		
		$where[] = array('role', 'customer');

		if ($get['search_customer_userid'] != '') {
			if (isset($get['fuzzy_search']) && $get['fuzzy_search'] == 1) {
				$where[] = array('username', 'like', "%" . $get['search_customer_userid'] . "%");
			} else {
				$where[] = array('username', $get['search_customer_userid']);
			}
		}

		if ($get['search_status'] != -1) {
			$where[] = array('valid', $get['search_status']);
		}
		
		if ($get['search_invite_code'] != '') {
			$where[] = array('invite_code', $get['search_invite_code']);
		}
		
		$datas = UserModel::with('cusGrade')->where($where)->skip($start)->take($length)->orderBy('id', 'desc')->get();
		$result = array();
		foreach($datas as $data){
			$name = "<span class=\"pd-5\" style=\"background-color: \">{$data->username}</span>";
			$parent = UserModel::whereIn('role', ['agent', 'topagent'])->where('id', $data->pid)->first();
			if ($parent) {
				if ($parent->role == 'topagent') {
					$parent1_name = "{$parent->username}";
					$parent2_name = '';
				} else {
					$p_parent = UserModel::where('role', 'topagent')->where('id', $parent->pid)->first();
					$parent1_name = "{$p_parent->username}";
					$parent2_name = "{$parent->username}";
				}
			} else {
				$parent1_name = '';
				$parent2_name = '';
			}

			if ($data->valid == 1) {
				$status = "<a class=\"status-btn status-open\" href=\"javascript:void(0);\">啟用</a>";
			} elseif ($data->valid == 2) {
				$status = "<a class=\"status-btn status-close\" href=\"javascript:void(0);\">停押</a>";
			} elseif ($data->valid == 3) {
				$status = "<a class=\"status-btn status-close\" href=\"javascript:void(0);\">鎖定</a>";
			} elseif ($data->valid == 4) {
				$status = "<a class=\"status-btn status-close\" href=\"javascript:void(0);\">停用</a>";
			}

			
			$balance = "<a href=\"/admin/cus_info_editor?etype=edit&edit_cus_id={$data->id}&btn_type=wallet-info-area\">{$data->balance}</a>";
			$cus_grade = "";
			if ($data->cusGrade) {
				$cus_grade = $data->cusGrade->name;
			}

			$invite_code =  "{$data->invite_code}";

			$action = "<a href=\"javascript:return_to_main_account({$data->id});\" class=\"btn btn-xs default\"> <i class=\"fa fa-refresh\"></i> 取回主帳 </a>
			<a href=\"javascript:void(0);\" onclick=\"request_editor_item_div('in', '{$data->id}', '{$data->username}');\" class=\"btn btn-xs default\"> <i class=\"fa fa-pencil\"></i> 存入 </a>
			<a href=\"javascript:void(0);\" onclick=\"request_editor_item_div('out', '{$data->id}', '{$data->username}');\" class=\"btn btn-xs default\"> <i class=\"fa fa-pencil\"></i> 提出 </a>";
			

			$formatItem = array();
			$formatItem[] = $name;
			$formatItem[] = $parent1_name;
			$formatItem[] = $parent2_name;
			$formatItem[] = $status;
			$formatItem[] = $balance;
			$formatItem[] = $cus_grade;
			$formatItem[] = $invite_code;
			$formatItem[] = $action;
			$result[] = $formatItem;
		}
		
		$count = UserModel::where($where)->count();
		if($result == null)$result = [];
		$draw = 1;
		if(isset($get['draw']))
			$draw = intval($get['draw']);
		$result = Functions::listData($draw ,$count,$count,$result);
		return $response->withJson($result);
	}

	public function saveAdjustQuota($request, $response)
    {
		$post = $request->getParsedBody();
		$id = $post['edit_cus_id'];
		$etype = $post['etype'];
		$adjust_quota = $post['adjust_quota'];
		$audit_multiple = $post['audit_multiple'];
		$audit_fixed_amount = $post['audit_fixed_amount'];

		if ($adjust_quota <= 0) {
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'3\', {\"target\":\"kangAdjustQuota\"}));"}]}}');
			return $response->withJson($msg);
		}
		try {
			DB::beginTransaction();

			$user = UserModel::where('id', $id)->lockForUpdate()->first();
			
			if ($etype == 'in') {
				$operate_type = 1;
				$assets = $user->balance;
				$user->balance += $adjust_quota;
			} else {
				$operate_type = 2;
				$assets = $user->balance;
				$adjust_quota = -$adjust_quota;
				$user->balance += $adjust_quota;
			}
			$user->save();

			$model = new UserMoney();
			$model->username = $user->username;
			$model->assets = $assets;
			$model->money = $adjust_quota;
			$model->balance = $user->balance;
			$model->reason = $post['adjust_reason'];
			$model->operate_type = $operate_type;
			$model->trans_type = 1;
			$model->operator = $_SESSION['username'];
			$model->notes = $post['notes'];
			$model->status = 1;
			$model->save();

			//出款稽核
			if ($etype == 'in') {
				$withdraw = new WithdrawAudit();
				$withdraw->user_id = $user->id;
				$withdraw->type = 0;
				$withdraw->note = $post['adjust_reason'];
				$withdraw->deposit_amount = $adjust_quota;
				$withdraw->discount_amount = 0;
				
				if ($audit_fixed_amount > 0) {
					$withdraw->beishu = 0;
					$withdraw->liushui = $audit_fixed_amount;
				} else {
					$withdraw->beishu = $audit_multiple;
					$withdraw->liushui = $audit_multiple * $adjust_quota;
				}
				$withdraw->status = 0;
				$withdraw->is_audit = 1;
				$withdraw->save();
			}
				
			DB::commit();
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"close_layer({type: 1});pop_msg(show_msg(\'-1\', {\"target\":\"kangAdjustQuota\"}));grid.getDataTable().ajax.reload();"}]}}');

			return $response->withJson($msg);
		} catch (\Exception $ex) {
			DB::rollBack();
			//echo $ex->getMessage();
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'1\', {\"target\":\"kangAdjustQuota\"}));"}]}}');
			return $response->withJson($msg);
        }
		
		
	}

	//人工出入金
	public function manualPaymentManager($request, $response)
    {
        return $this->view->render('manual_payment_manager');
	}

	public function listManualPayments($request, $response)
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
		
		$where[] = array('role', 'customer');

		if ($get['search_customer_userid'] != '') {
			if (isset($get['fuzzy_search']) && $get['fuzzy_search'] == 1) {
				$where[] = array('username', 'like', "%" . $get['search_customer_userid'] . "%");
			} else {
				$where[] = array('username', $get['search_customer_userid']);
			}
		}

		if ($get['search_status'] != -1) {
			$where[] = array('valid', $get['search_status']);
		}
		
		if ($get['search_invite_code'] != '') {
			$where[] = array('invite_code', $get['search_invite_code']);
		}
		
		$datas = UserModel::with('cusGrade')->where($where)->skip($start)->take($length)->orderBy('id', 'desc')->get();
		$result = array();
		foreach($datas as $data){
			$name = "<span class=\"pd-5\" style=\"background-color: \">{$data->username}</span>";
			$parent = UserModel::whereIn('role', ['agent', 'topagent'])->where('id', $data->pid)->first();
			if ($parent) {
				if ($parent->role == 'topagent') {
					$parent1_name = "{$parent->username}";
					$parent2_name = '';
				} else {
					$p_parent = UserModel::where('role', 'topagent')->where('id', $parent->pid)->first();
					$parent1_name = "{$p_parent->username}";
					$parent2_name = "{$parent->username}";
				}
			} else {
				$parent1_name = '';
				$parent2_name = '';
			}

			if ($data->valid == 1) {
				$status = "<a class=\"status-btn status-open\" href=\"javascript:void(0);\">啟用</a>";
			} elseif ($data->valid == 2) {
				$status = "<a class=\"status-btn status-close\" href=\"javascript:void(0);\">停押</a>";
			} elseif ($data->valid == 3) {
				$status = "<a class=\"status-btn status-close\" href=\"javascript:void(0);\">鎖定</a>";
			} elseif ($data->valid == 4) {
				$status = "<a class=\"status-btn status-close\" href=\"javascript:void(0);\">停用</a>";
			}

			
			$balance = "<a href=\"/admin/cus_info_editor?etype=edit&edit_cus_id={$data->id}&btn_type=wallet-info-area\">{$data->balance}</a>";
			$cus_grade = "";
			if ($data->cusGrade) {
				$cus_grade = $data->cusGrade->name;
			}

			$invite_code =  "{$data->invite_code}";

			$action = "<a href=\"javascript:return_to_main_account({$data->id});\" class=\"btn btn-xs default\"> <i class=\"fa fa-refresh\"></i> 取回主帳 </a>
			<a href=\"javascript:void(0);\" onclick=\"request_editor_item_div('in', '{$data->id}', '{$data->username}');\" class=\"btn btn-xs default\"> <i class=\"fa fa-pencil\"></i> 存入 </a>
			<a href=\"javascript:void(0);\" onclick=\"request_editor_item_div('out', '{$data->id}', '{$data->username}');\" class=\"btn btn-xs default\"> <i class=\"fa fa-pencil\"></i> 提出 </a>";
			

			$formatItem = array();
			$formatItem[] = $name;
			$formatItem[] = $parent1_name;
			$formatItem[] = $parent2_name;
			$formatItem[] = $status;
			$formatItem[] = $balance;
			$formatItem[] = $cus_grade;
			$formatItem[] = $invite_code;
			$formatItem[] = $action;
			$result[] = $formatItem;
		}
		
		$count = UserModel::where($where)->count();
		if($result == null)$result = [];
		$draw = 1;
		if(isset($get['draw']))
			$draw = intval($get['draw']);
		$result = Functions::listData($draw ,$count,$count,$result);
		return $response->withJson($result);
	}

	public function saveManualPayment($request, $response)
    {
		$post = $request->getParsedBody();
		$id = $post['edit_cus_id'];
		$etype = $post['etype'];
		$adjust_quota = $post['adjust_quota'];
		$audit_multiple = $post['audit_multiple'];
		$audit_fixed_amount = $post['audit_fixed_amount'];

		if ($adjust_quota <= 0) {
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'3\', {\"target\":\"kangAdjustQuota\"}));"}]}}');
			return $response->withJson($msg);
		}
		try {
			DB::beginTransaction();

			$user = UserModel::where('id', $id)->lockForUpdate()->first();
			
			if ($etype == 'in') {
				$operate_type = 1;
				$assets = $user->balance;
				$user->balance += $adjust_quota;
			} else {
				$operate_type = 2;
				$assets = $user->balance;
				$adjust_quota = -$adjust_quota;
				$user->balance += $adjust_quota;
			}
			$user->save();

			$model = new UserMoney();
			$model->username = $user->username;
			$model->assets = $assets;
			$model->money = $adjust_quota;
			$model->balance = $user->balance;
			$model->reason = $post['adjust_reason'];
			$model->operate_type = $operate_type;
			$model->trans_type = 1;
			$model->operator = $_SESSION['username'];
			$model->notes = $post['notes'];
			$model->status = 1;
			$model->save();

			//出款稽核
			if ($etype == 'in') {
				$withdraw = new WithdrawAudit();
				$withdraw->user_id = $user->id;
				$withdraw->type = 0;
				$withdraw->note = $post['adjust_reason'];
				$withdraw->deposit_amount = $adjust_quota;
				$withdraw->discount_amount = 0;
				
				if ($audit_fixed_amount > 0) {
					$withdraw->beishu = 0;
					$withdraw->liushui = $audit_fixed_amount;
				} else {
					$withdraw->beishu = $audit_multiple;
					$withdraw->liushui = $audit_multiple * $adjust_quota;
				}
				$withdraw->status = 0;
				$withdraw->is_audit = 1;
				$withdraw->save();
			}
				
			DB::commit();
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"close_layer({type: 1});pop_msg(show_msg(\'-1\', {\"target\":\"kangAdjustQuota\"}));grid.getDataTable().ajax.reload();"}]}}');

			return $response->withJson($msg);
		} catch (\Exception $ex) {
			DB::rollBack();
			//echo $ex->getMessage();
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'1\', {\"target\":\"kangAdjustQuota\"}));"}]}}');
			return $response->withJson($msg);
        }
		
		
	}
	
	public function employeeManagerOp($request, $response)
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
		
		$where[] = array('role', 'admin');

		 
		
		$datas = UserModel::with('cusGrade')->where($where)->skip($start)->take($length)->orderBy('id', 'desc')->get();
		$result = array();
		foreach($datas as $data){
		 
			if ($data->valid == 1) {
				$status = "<a class=\"status-btn status-open\" href=\"javascript:void(0);\">啟用</a>";
			} elseif ($data->valid == 2) {
				$status = "<a class=\"status-btn status-close\" href=\"javascript:void(0);\">停押</a>";
			} elseif ($data->valid == 3) {
				$status = "<a class=\"status-btn status-close\" href=\"javascript:void(0);\">鎖定</a>";
			} elseif ($data->valid == 4) {
				$status = "<a class=\"status-btn status-close\" href=\"javascript:void(0);\">停用</a>";
			}

		 

			$action = "<a href=\"/admin/employee_editor?etype=edit&user_id={$data->id}\" class=\"btn btn-xs default\"> <i class=\"fa fa-pencil\"></i> 修改 </a>";
			

			$formatItem = array();
			$formatItem[] = $data->username;
			$formatItem[] = $data->nickname;
		 
			$formatItem[] = $status;
		 
			$formatItem[] = $action;
			$result[] = $formatItem;
		}
		
		$count = UserModel::where($where)->count();
		if($result == null)$result = [];
		$draw = 1;
		if(isset($get['draw']))
			$draw = intval($get['draw']);
		$result = Functions::listData($draw ,$count,$count,$result);
		return $response->withJson($result);
	}
	
	public function employeeManagerEditor($request, $response)
    {
		$get = $request->getQueryParams();
		$menus = Menu::with(['locales'=>function($query){
			$lang = 'zh_TW';
			if(isset($_COOKIE['lang'])){
				$lang = $_COOKIE['lang'] ;
			}
			return $query->where('lang',$lang)->get();
		}])->where('status',1)->orderBy('sort')->get();
		 
		$etype = $get['etype'];
		if($etype == 'add'){
			$user = new UserModel;
			$user->username='';
			$user->nickname='';
			$user->status=1;
		}else{
			$user = UserModel::with('permissions')->find($get['user_id']);
			 $etype = 'edit';
		}
		//echo json_encode($user);
		return $this->view->render('employee_editor',['etype'=>$etype,'user'=>$user,'menus'=>$menus]);
	}
	
	public function employeeManagerEditorOp($request, $response)
    {
		$get = $request->getQueryParams();
		$post = $request->getParsedBody();
		$pdisplay = $get['pdisplay'];
		$etype = $post['etype'];
		
		$employee_userid = $post['employee_userid'];
		$employee_pass= $post['employee_pass'];
		$employee_name= $post['employee_name'];
		$employee_status= $post['employee_status'];
		$menu_perm = $post['menu_perm']; //權限
		$edit_employee_id = 0;
		if($etype == 'edit'){
			 
			$edit_employee_id = $post['edit_employee_id'];
			$user = UserModel::find($edit_employee_id);
			
			if($user != null){
				$user->username = $employee_userid;
				if(!empty($employee_pass) && strlen($employee_pass) > 6)
					$user->password =  crypt($employee_pass, '$1$' . substr(md5($user->username), 5, 8));;
				$user->nickname = $employee_name;
				$user->valid = $employee_status;
				$user->updated_at = date('Y-m-d');
				$user->save();
				
				 
			}
			
			 
		}else{
			$user = new UserModel;
			$user->username = $employee_userid;
			$user->password =  crypt($employee_pass, '$1$' . substr(md5($user->username), 5, 8));;
			$user->nickname = $employee_name;
			$user->valid = $employee_status;
			$user->role = 'admin';
			$user->created_at = date('Y-m-d');
			$user->updated_at = date('Y-m-d');
			 $user->save();
			 
			$edit_employee_id = $user->id;
		}
		DB::delete("delete from user_permissions where user_id={$edit_employee_id}");
		$sql = "insert into user_permissions (user_id,menu_id,created_at,updated_at) values";
		foreach($menu_perm as $permission){
				$sql .= "('{$edit_employee_id}','{$permission}',now(),now()),";	
		}
		$sql = substr($sql,0,strlen($sql)-1);
		//echo $sql;
		DB::insert($sql);
		//$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'1\', {\"target\":\"kangAdjustQuota\"}));"}]}}');
		echo ('<script>window.location="/admin/employee_manager"</script>');
	}
	
	public function customerMark($request, $response)
    {
        return $this->view->render('cus_mark_manager');
	}

	public function listCusMarks($request, $response)
    {
		$get = $request->getQueryParams();

		
		$datas = CusMarkModel::all();
		
		$result = array();
		foreach($datas as $data){
			$id = $data->id;
			$name = $data->name;
			$color = "<div align= center><div class=\"mark-color\" style=\"background-color:{$data->color}\"></div></div>";
			$value = "<div align= left>
						<div>無法入款：&nbsp;&nbsp;". ($data->disabled_deposit == 1 ?"是":"否") ."</div>
						<div>無法取款：&nbsp;&nbsp;". ($data->disabled_withdraw == 1 ?"是":"否") ."</div>
						<div>優惠排除：&nbsp;&nbsp;". ($data->disabled_discount == 1 ?"是":"否") ."</div>
						<div>返水排除：&nbsp;&nbsp;". ($data->disabled_retreat == 1 ?"是":"否") ."</div>
					</div>";
			$count = UserModel::where('cus_mark_id', $data->id)->count();
			$operator = $data->operator;
			$updated_at = $data->updated_at ."";

			$action =  "<a href=\"javascript:void(0);\" onclick=\"request_extra_func_div('set', '{$data->id}', '{$data->name}' ,'{$data->color}')\" class=\"btn btn-xs default\"> <i class=\"fa fa-pencil\"></i> 設置會員 </a>\n\t\t\t\t\t\t\t\t<a href=\"javascript:void(0);\" onclick=\"request_extra_func_div('remove', '{$data->id}', '{$data->name}' ,'{$data->color}')\" class=\"btn btn-xs default\"> <i class=\"fa fa-pencil\"></i> 移除會員 </a>\n\t\t\t\t\t\t\t\t<a href=\"javascript:void(0);\" onclick=\"request_editor_item_div('edit', '{$data->id}');\" class=\"btn btn-xs default\"> <i class=\"fa fa-pencil\"></i> 修改 </a>";
			//$action =  "<a href=\"javascript:void(0);\" onclick=\"request_editor_item_div('edit', '{$data->id}');\" class=\"btn btn-xs default\"> <i class=\"fa fa-pencil\"></i> 修改 </a>";
			
			
			$formatItem = array();
			$formatItem[] = $id;
			$formatItem[] = $name;
			$formatItem[] = $color;
			$formatItem[] = $value;
			$formatItem[] = $count;
			$formatItem[] = $operator;
			$formatItem[] = $updated_at;
			$formatItem[] = $action;
			$result[] = $formatItem;
		}
		
		$count = CusMarkModel::count();
		if($result == null)$result = [];
		$draw = 1;
		if(isset($get['draw']))
			$draw = intval($get['draw']);
		$result = Functions::listData($draw ,$count,$count,$result);
		return $response->withJson($result);
	}

	public function cusMarkEditor($request, $response)
    {
		$post = $request->getParsedBody();
		$etype = $post['etype'];
		$id = $post['edit_mark_id'];

		
		$data = CusMarkModel::where('id', $id)->first();

		return $response->withJson($data);
	}

	public function saveCusMark($request, $response)
    {
		$post = $request->getParsedBody();
		$id = $post['edit_mark_id'];
		$etype = $post['etype'];
		$mark_perm = isset($post['mark_perm']) ?$post['mark_perm']:array();

		if ($post['mark_name'] == '') {
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"close_layer({type: 1});pop_msg(show_msg(\'2\', {\"target\":\"kangCommissionRule\"}));grid.getDataTable().ajax.reload();"}]}}');
			return $response->withJson($msg);
		}
		if ($etype == 'add') {
			$data = new CusMarkModel;

		} else {
			$data = CusMarkModel::find($id);
		}

		$data->name = $post['mark_name'];
		$data->color = $post['mark_color'];
		$data->disabled_deposit = isset($mark_perm['disabled_deposit']) ?$mark_perm['disabled_deposit']:0;
		$data->disabled_withdraw = isset($mark_perm['disabled_withdraw']) ?$mark_perm['disabled_withdraw']:0;
		$data->disabled_discount = isset($mark_perm['disabled_discount']) ?$mark_perm['disabled_discount']:0;
		$data->disabled_retreat = isset($mark_perm['disabled_retreat']) ?$mark_perm['disabled_retreat']:0;
		$data->operator = $_SESSION['username'];
		$data->save();

		if($etype == 'edit')
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"close_layer({type: 1});pop_msg(show_msg(\'-2\', {\"target\":\"kangCusMark\"}));grid.getDataTable().ajax.reload();"}]}}');
		else
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"close_layer({type: 1});pop_msg(show_msg(\'-1\', {\"target\":\"kangCusMark\"}));grid.getDataTable().ajax.reload();"}]}}');
		return $response->withJson($msg);
	}

	public function setCusMark($request, $response)
    {
		$post = $request->getParsedBody();
		$id = $post['edit_mark_id'];
		$etype = $post['etype'];
		$customer_userid_txt = $post['customer_userid_txt'];

		$users = explode(',', $customer_userid_txt);
		
		if ($etype == 'set') {
			//set
			UserModel::whereIn('username', $users)->update(['cus_mark_id'=>$id]);

		} else if ($etype == 'remove') {
			//remove
			UserModel::whereIn('username', $users)->where('cus_mark_id', $id)->update(['cus_mark_id'=>0]);
		}


		$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"close_layer({type: 1});pop_msg(show_msg(\'-4\', {\"target\":\"kangCusMark\"}));grid.getDataTable().ajax.reload();"}]}}');
		return $response->withJson($msg);
	}

	public function customerGrade($request, $response)
    {
        return $this->view->render('cus_grade_manager');
	}

	public function listCusGrades($request, $response)
    {
		$get = $request->getQueryParams();

		
		$datas = CusGradeModel::orderBy('level', 'desc')->get();
		
		$result = array();
		foreach($datas as $data){
			$level = $data->level;
			$name = $data->name;
			$upgrade_condition = "<div align= left>
									<div>總入金：&nbsp;&nbsp;".$data->upgrade_condition_total_deposit."</div>
									<div>總有效投注額：&nbsp;&nbsp;".$data->upgrade_condition_total_bet_real_amount."</div>
									<div>月入金：&nbsp;&nbsp;".$data->upgrade_condition_month_deposit."</div>
									<div>月有效投注額：&nbsp;&nbsp;".$data->upgrade_condition_month_bet_real_amount."</div>
								  </div>";
			$downgrade_condition = "<div align= left>
										<div>月入金：&nbsp;&nbsp;".$data->downgrade_condition_month_deposit."</div>
										<div>月有效投注額：&nbsp;&nbsp;".$data->downgrade_condition_month_bet_real_amount."</div>
									</div>";
			$grade_options_condition = "<div align= left>
											<div>免手續費計算週期：&nbsp;&nbsp;".($data->grade_options_condition_free_withdraw_times_type==0 ?"每日":"每周")."</div>
											<div>出款免手續費次數：&nbsp;&nbsp;".$data->grade_options_condition_free_withdraw_times."</div>
											<div>最小出款金額：&nbsp;&nbsp;".$data->grade_options_condition_min_withdraw_amount."</div>
											<div>最大出款金額：&nbsp;&nbsp;".$data->grade_options_condition_max_withdraw_amount."</div>
											<div>出款次數：&nbsp;&nbsp;".$data->grade_options_condition_withdraw_times."</div>
											<div>最小存款金額：&nbsp;&nbsp;".$data->grade_options_condition_min_deposit_amount."</div>
											<div>最大存款金額：&nbsp;&nbsp;".$data->grade_options_condition_max_deposit_amount."</div>
											<div>嚴謹出款：&nbsp;&nbsp;".($data->grade_options_condition_is_strict_withdraw==0 ?"否":"是")."</div>
										</div>";

			$operator = $data->operator;
			$updated_at = $data->updated_at ."";

			$action =  "<a href=\"javascript:void(0);\" onclick=\"request_editor_item_div('edit', '{$data->id}');\" class=\"btn btn-xs default\"> <i class=\"fa fa-pencil\"></i> 修改 </a>";
			
			$formatItem = array();
			$formatItem[] = $level;
			$formatItem[] = $name;
			$formatItem[] = $upgrade_condition;
			$formatItem[] = $downgrade_condition;
			$formatItem[] = $grade_options_condition;
			$formatItem[] = $operator;
			$formatItem[] = $updated_at;
			$formatItem[] = $action;
			$result[] = $formatItem;
		}
		
		$count = CusMarkModel::count();
		if($result == null)$result = [];
		$draw = 1;
		if(isset($get['draw']))
			$draw = intval($get['draw']);
		$result = Functions::listData($draw ,$count,$count,$result);
		return $response->withJson($result);
	}

	public function cusGradeEditor($request, $response)
    {
		$post = $request->getParsedBody();
		$etype = $post['etype'];
		$id = $post['edit_grade_id'];

		
		$data = CusGradeModel::where('id', $id)->first();

		return $response->withJson($data);
	}

	public function saveCusGrade($request, $response)
    {
		$post = $request->getParsedBody();
		$id = $post['edit_grade_id'];
		$etype = $post['etype'];
		$upgrade_condition = isset($post['upgrade_condition']) ?$post['upgrade_condition']:array();
		$downgrade_condition = isset($post['downgrade_condition']) ?$post['downgrade_condition']:array();
		$grade_options_condition = isset($post['grade_options_condition']) ?$post['grade_options_condition']:array();

		if ($post['grade_level'] <= 0 && $post['grade_level'] != -100) {
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'4\', {\"target\":\"kangCusGrade\"}));"}]}}');
			return $response->withJson($msg);
		}
		$same = CusGradeModel::where('id','<>', $id)->where('level', $post['grade_level'])->first();
		if ($same) {
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'3\', {\"target\":\"kangCusGrade\"}));"}]}}');
			return $response->withJson($msg);
		}


		if ($etype == 'add') {
			$data = new CusGradeModel;

		} else {
			$data = CusGradeModel::find($id);
		}

		$data->name = $post['grade_name'];
		$data->level = $post['grade_level'];
		$data->upgrade_condition_total_deposit = $upgrade_condition['total_deposit'];
		$data->upgrade_condition_total_bet_real_amount = $upgrade_condition['total_bet_real_amount'];
		$data->upgrade_condition_month_deposit = $upgrade_condition['month_deposit'];
		$data->upgrade_condition_month_bet_real_amount = $upgrade_condition['month_bet_real_amount'];
		$data->downgrade_condition_month_deposit = $downgrade_condition['month_deposit'];
		$data->downgrade_condition_month_bet_real_amount = $downgrade_condition['month_bet_real_amount'];
		$data->grade_options_condition_free_withdraw_times_type = $grade_options_condition['free_withdraw_times_type'];
		$data->grade_options_condition_free_withdraw_times = $grade_options_condition['free_withdraw_times'];
		$data->grade_options_condition_min_withdraw_amount = $grade_options_condition['min_withdraw_amount'];
		$data->grade_options_condition_max_withdraw_amount = $grade_options_condition['max_withdraw_amount'];
		$data->grade_options_condition_withdraw_times = $grade_options_condition['withdraw_times'];
		$data->grade_options_condition_min_deposit_amount = $grade_options_condition['min_deposit_amount'];
		$data->grade_options_condition_max_deposit_amount = $grade_options_condition['max_deposit_amount'];
		
		$data->grade_options_condition_is_strict_withdraw = isset($grade_options_condition['is_strict_withdraw']) ?$grade_options_condition['is_strict_withdraw']:0;
		$data->operator = $_SESSION['username'];
		$data->save();

		if($etype == 'edit')
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"close_layer({type: 1});pop_msg(show_msg(\'-2\', {\"target\":\"kangCusGrade\"}));grid.getDataTable().ajax.reload();"}]}}');
		else
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"close_layer({type: 1});pop_msg(show_msg(\'-1\', {\"target\":\"kangCusGrade\"}));grid.getDataTable().ajax.reload();"}]}}');
		return $response->withJson($msg);
	}
	
	public function transferQuotaOp($request,$response){
		$get= $request->getQueryParams();
		$post=$request->getParsedBody();
		$edit_cus_id = $post['edit_cus_id'];
		
	 
		$pdisplay = $get['pdisplay'];
		if($pdisplay == 'request_main_quota'){
			$user = UserModel::find($edit_cus_id);
			if($user != null){
				echo '{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"show_quota(\'main-quota\', 1, '.$user->balance.');"}]}}';
			}else{
				echo '{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"show_quota(\'main-quota\', 2, 0);"}]}}';
			}
		}elseif($pdisplay == 'return_to_main_account'){
			$games = Game::where('status',1)->get();
			 
			$user = UserModel::find($edit_cus_id);
			foreach($games as $game){
				$gameApp = GameFactory::createInstance($game->code);
				 
				$result = $gameApp->getBalance(['userName'=>$user->username,'user_id'=>$user->id, 'game_id'=>$game->id]);
				error_log(json_encode($result));
				if($result['status'] == true){
					$balance = intval($result['balance']);
					if($balance > 0){
						DB::beginTransaction();
						try{
							$updateUser = UserModel::lockForUpdate()->where('id',$edit_cus_id)->first(); 
							error_log(json_encode($updateUser));
							 
							if($updateUser == null)  throw new Exception(_('会员不存在'));
							$newBalance =  $updateUser->balance + $balance;
							 
							$log = new UserMoney;
							$log->username = $user->username;
							$log->assets = $updateUser->balance;
							$log->money = $balance;
							$log->balance =  $updateUser->balance + $balance;
							$log->reason = $game->name . ' 轉至 主帳戶';
							$log->order_id = 'play-'.date('YmdHis');
							$log->operate_type = 1;
							$log->trans_type = 2;
							$log->operator = $_SESSION['username'];
							$log->created_at = date('Y-m-d H:i:s');
							$log->updated_at = date('Y-m-d H:i:s');
							$log->status = 1;
							$log->save(); 
							
							$updateUser->balance += $balance;
							$updateUser->save();
							
							DB::commit();	
						}catch(\Exception $ex){
		
							DB::rollBack();
							error_log($ex);
						}
						
						try{
							$changeLog = $gameApp->changeBalance(['userName'=>$user->username,'amount'=>$balance, 'transBillno'=>$user->id.'_'.date('YmdHis'),'type'=>'OUT', 'user_id'=>$user->id, 'game_id'=>$game->id]);
							error_log(json_encode($changeLog));
						}catch(\Exception $ex){
							error_log($ex);
						}
					}
					
				}
					 
				
			}
			
			 
				echo '{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"return_to_main_account_flag = 1; pop_msg(show_msg(-1, {\"target\":\"kangAdjustQuota\"}));$(\'.search-btn\').click();"}]}}';
			 
		}
		else{
			$gameId = $post['game_store'];
			$game = Game::where('id',$gameId)->first();
			if($game ==null){
				echo '{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"show_quota(\'gstore-'.$gameId.'-quota\', \'2\', \'0\');"}]}}';
				return ;
			}
			
			$gameApp = GameFactory::createInstance($game->code);
			$result = $gameApp->getBalance(['userName'=>$login->username, 'game_id'=>$game->id, 'user_id'=> $login->id]);
			$balance = 0;
			//echo json_encode($result);
			$balance = (isset($result['status']) && $result['status']) ? $result['balance'] : 0;
			echo '{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"show_quota(\'gstore-'.$gameId.'-quota\', \'1\', \''.$balance.'\');"}]}}';
		}
			 
	}
}
