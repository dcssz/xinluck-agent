<?php
namespace App\Controllers\Admin;

use Illuminate\Database\Capsule\Manager as DB;
use stdClass;
use Interop\Container\ContainerInterface;
use App\Extensions\AdminBase;
use App\Extensions\Functions;
use App\Models\News as NewsModel;
use App\Models\EffectCusRule as EffectCusRuleModel;
use App\Models\CommissionRule as CommissionRuleModel;
use App\Models\CommissionRuleDetail as CommissionRuleDetailModel;
use App\Models\ExtraCommissionRule as ExtraCommissionRuleModel;
use App\Models\ExtraCommissionRuleDetail as ExtraCommissionRuleDetailModel;
use App\Models\RetreatRule as RetreatRuleModel;
use App\Models\RetreatRuleDetail as RetreatRuleDetailModel;
use App\Models\GameStoreType as GameStoreTypeModel;
use App\Models\GameStore as GameStoreModel;
use App\Models\GameMark as GameMarkModel;
use App\Models\Game as GameModel;
use App\Models\User as UserModel;
use App\Models\UserMoney as UserMneyModel;
use App\Models\Period;
use App\Models\UserLog;
use App\Models\Config;
use App\Models\UserGroup;

class Agent extends AdminBase
{
	public function __Construct(ContainerInterface $container)
    {
		parent::__Construct($container);
	}

	public function agentInfoManager($request, $response)
    {
		$get = $request->getQueryParams();
		$commissionRules = CommissionRuleModel::all();
		$retreatRules = RetreatRuleModel::all();
		$extraCommissionRules = ExtraCommissionRuleModel::all();

		if ($get['edit_cus_level'] == 14) {

			return $this->view->render('agent_info_manager_14', [
				"commissionRules" => $commissionRules,
				"retreatRules" => $retreatRules,
				"extraCommissionRules" => $extraCommissionRules,
			]);
		} elseif ($get['edit_cus_level'] == 15) {

			$top_cus_id = isset($get["top_cus_id"]) ? $get["top_cus_id"] : $_SESSION['id'];
			$user = UserModel::find($top_cus_id);
			$agent = UserModel::find($_SESSION['id']);
			return $this->view->render('agent_info_manager_15', [
				"commissionRules" => $commissionRules,
				"retreatRules" => $retreatRules,
				"top_cus_id" => $top_cus_id,
				"user" => $user,
				"agent" => $agent,
			]);
		}
        
	}

	public function listAgentInfos($request, $response)
    {
		$get = $request->getQueryParams();

		$edit_cus_level = intval($get['edit_cus_level']); // 14:总代理,15:代理
		$where = array();
		$where[] = array('parentUid', 0); //不要子帐号
		//$where[] = array('status',1);
		$offset = 0;
		if(isset($get['offset']))
			$offset = intval($get['offset']);
		
		$limit = 10;
		if(isset($get['limit']))
			$limit = intval($get['limit']);
		
		if ($get['search_customer_userid'] != '') {
			$where[] = array('parents', 'like', '%/'.$_SESSION['id'].'/%');
			if (isset($get['fuzzy_search']) && $get['fuzzy_search'] == 1) {
				$where[] = array('username', 'like', "%" . $get['search_customer_userid'] . "%");
			} else {
				$where[] = array('username', $get['search_customer_userid']);
			}
		} else {
			$pid = isset($get['top_cus_id']) ? $get['top_cus_id'] : $_SESSION['id'];
			$where[] = array('role', 'agent');
			$where[] = array('pid', $pid);
		}

		if ($get['search_status'] != -1) {
			$where[] = array('valid', $get['search_status']);
		}

		if ($get['search_commission_rule'] != -1) {
			$where[] = array('commission_rule_id', $get['search_commission_rule']);
		}

		if ($get['search_retreat_rule'] != -1) {
			$where[] = array('retreat_rule_id', $get['search_retreat_rule']);
		}

		if ($get['search_extra_commission_rule'] != -1) {
			$where[] = array('extra_commission_rule_id', $get['search_extra_commission_rule']);
		}

		if ($get['search_invite_code'] != '') {
			$where[] = array('invite_code', $get['search_invite_code']);
		}

		// if (isset($get['top_cus_id']) && $get['top_cus_id'] != '') {
		// 	$where[] = array('pid', $get['top_cus_id']);
		// }
		
		$datas = UserModel::with('commissionRule', 'extraCommissionRule', 'retreatRule')->where($where)->offset($offset)->take($limit)->get();
		$min = collect($datas)->min('level');

		$frontUrl = Config::where('name','frontUrl')->pluck('value')->first();
		$frontUrl .= '/register';

		$result = array();
	 
		foreach($datas as $data){
			if ($data->level == $min) {
				$data->pid = 0;
			}
			$data->username = $data->username . "<br />(" . $data->nickname . ")";

			$child_agent_count = UserModel::where('role', 'agent')->where('parents', 'like', '%/'.$data->id.'/%')->where('level', $data->level +1)->count();
			$data->child_agent_count = "<a href=\"/agent/agent_info_manager?edit_cus_level=15&search_customer_userid={$data->username}&search_level=14&top_cus_id={$data->id}&edit_station_code=3&is_back=1&search_role=-1\">{$child_agent_count}</a>";
			$child_member_count = UserModel::where('role', 'customer')->where('pid', $data->id)->count();
			$data->child_member_count = "<a href=\"/agent/customer_info?edit_cus_level=16&search_customer_userid={$data->username}&search_level=15&top_cus_id={$data->id}&edit_station_code=3&is_back=1\">{$child_member_count}</a>";
			//$data->invite_code_url =  "<span>{$data->invite_code}</span><br><a href='javascript:void(0);' onclick='copy_link(this);'>{$frontUrl}?invite_code={$data->invite_code}</a>";
			$data->invite_code_url = '';
			$action = "<a href=\"javascript:void(0);\" onclick=\"show_qr_code('{$frontUrl}?invite_code={$data->invite_code}');\" class=\"btn btn-xs default\"><i class=\"fa fa-pencil\"></i> QR code </a>\n\t\t\t\t\t\t\t\t";
			
			if ($_SESSION['isChild'] == 0) {
				$action .= "<a href=\"/agent/agent_info_editor?etype=edit&edit_cus_id={$data->id}&edit_cus_level=15\" class=\"btn btn-xs default\"> <i class=\"fa fa-pencil\"></i> 資料 </a>\n\t\t\t\t\t\t\t\t";
				$action .= "<a href=\"javascript:void(0);\" onclick=\"show({$data->id});\" class=\"btn btn-xs default\"> <i class=\"fa fa-pencil\"></i> 調額 </a>\n\t\t\t\t\t\t\t\t";
			}
			$action .= "<a href=\"cus_info_log_list?user_id={$data->id}&is_back=1\"  class=\"btn btn-xs default\"> <i class=\"fa fa-pencil\"></i> 修改歷程 </a>\n\t\t\t\t\t\t\t\t";
			$data->action = $action;
			//  $this->buildTreeAgent(0,$data,$result,$frontUrl);
		}

		$result = $datas;

		$count = UserModel::where($where)->count();
		if($result == null)$result = [];
		$draw = 1;
		if(isset($get['draw']))
			$draw = intval($get['draw']);
		$result = Functions::listData($draw ,$count,$count,$result);
		return $response->withJson($result);
	}

	private function buildTreeAgent($n,$data,&$result,$frontUrl){
		if($data != null){
			
			$parent = UserModel::where('id', $data->pid)->first();
			$parent_name = $parent->username . "<br />(" . $parent->nickname . ")";
			if ($data->valid == 1) {
				$status = "<a class=\"status-btn status-open\" href=\"javascript:void(0);\">啟用</a>";
			} elseif ($data->valid == 2) {
				$status = "<a class=\"status-btn status-close\" href=\"javascript:void(0);\">停押</a>";
			} elseif ($data->valid == 3) {
				$status = "<a class=\"status-btn status-close\" href=\"javascript:void(0);\">鎖定</a>";
			} elseif ($data->valid == 4) {
				$status = "<a class=\"status-btn status-close\" href=\"javascript:void(0);\">停用</a>";
			}
			$commissionRule = $data->commissionRule ? $data->commissionRule->name : "";
			$retreatRule = $data->retreatRule ? $data->retreatRule->name : "";
			$child_member_count = UserModel::where('role', 'customer')->where('pid', $data->id)->count();
			$child_member_count = "<a href=\"/agent/customer_info?edit_cus_level=16&search_customer_userid={$data->username}&search_level=15&top_cus_id={$data->id}&edit_station_code=3&is_back=1\">{$child_member_count}</a>";
			//"<a href=\"cus_info_manager.php?edit_cus_level=16&search_customer_userid=jeffrey1&search_level=15&top_cus_id=51&edit_station_code=3&is_back=1\">1</a>"
			$balance = $data->balance;
			$invite_code =  "<span>{$data->invite_code}</span><br><a href='javascript:void(0);' onclick='copy_link(this);'>{$frontUrl}?invite_code={$data->invite_code}</a>";

			$created_at = "<div align= center>".$data->created_at."</div>";
			$action = "<a href=\"javascript:void(0);\" onclick=\"show_qr_code('{$frontUrl}?invite_code={$data->invite_code}');\" class=\"btn btn-xs default\"><i class=\"fa fa-pencil\"></i> QR code </a>\n\t\t\t\t\t\t\t\t";
			$action .= "<a href=\"/agent/agent_info_editor?etype=edit&edit_cus_id={$data->id}&edit_cus_level=15\" class=\"btn btn-xs default\"> <i class=\"fa fa-pencil\"></i> 資料 </a>\n\t\t\t\t\t\t\t\t";

			//下级
			$where = array();
			$where[] = array('pid',$data->id);
			$datas = UserModel::with('commissionRule', 'extraCommissionRule', 'retreatRule')->where($where)->get();
			
			$treeIcon = '';
			$formatItem = array();
			//if($datas && count($datas) > 0){
			//	$treeIcon = '+';
			//}
			$tag = '';
			for($i = 0;$i<$n;$i++)
				$tag .= '　　　　';
			$name = $tag .'<a class="nav-link" id="'.$data->id.'" parentId="'.$data->pid.'" parents='.$data->parents.$data->id.'/" level="'.$data->level.'" href="javascript:void(0)" onclick="extendChild('.$data->id.')"><img style="width:10px" src="/templates/images/sub-icon.png" />'.$treeIcon.'</a> <a class="status-btn status-open" href="javascript:void(0);">'.$data->level.'代</a>'.$data->username;
			$formatItem[] = $name;
			//$formatItem[] = $parent_name;
			$formatItem[] = $status;
			$formatItem[] = $commissionRule;
			$formatItem[] = $retreatRule;
			$formatItem[] = $child_member_count;
			$formatItem[] = $balance;
			$formatItem[] = $created_at;
			$formatItem[] = $invite_code;
			$formatItem[] = $action;
			$result[] = $formatItem;

			if($datas == null) return;
			foreach($datas as $data){
				$m = $n;
				$this->buildTreeAgent(++$m,$data,$result,$frontUrl);
			}
		}
	}

	public function listAgentInfos_1107($request, $response)
    {
		$get = $request->getQueryParams();

		$edit_cus_level = intval($get['edit_cus_level']); // 14:总代理,15:代理
		$where = array();
		$where[] = array('parentUid', 0); //不要子帐号
		//$where[] = array('status',1);
		$start = 0;
		if(isset($get['start']))
			$start = intval($get['start']);
		
		$length = 0;
		if(isset($get['length']))
			$length = intval($get['length']);
		
		if ($edit_cus_level == 14) { //总代理
			$where[] = array('role', 'topagent');
			
		} else { //代理
			$pid = isset($get['top_cus_id']) ? $get['top_cus_id'] : $_SESSION['id'];
			$where[] = array('role', 'agent');
			$where[] = array('pid', $pid);
		}
		

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

		if ($get['search_commission_rule'] != -1) {
			$where[] = array('commission_rule_id', $get['search_commission_rule']);
		}

		if ($get['search_retreat_rule'] != -1) {
			$where[] = array('retreat_rule_id', $get['search_retreat_rule']);
		}

		if ($get['search_extra_commission_rule'] != -1) {
			$where[] = array('extra_commission_rule_id', $get['search_extra_commission_rule']);
		}

		if ($get['search_invite_code'] != '') {
			$where[] = array('invite_code', $get['search_invite_code']);
		}

		// if (isset($get['top_cus_id']) && $get['top_cus_id'] != '') {
		// 	$where[] = array('pid', $get['top_cus_id']);
		// }
		
		$datas = UserModel::with('commissionRule', 'extraCommissionRule', 'retreatRule')->where($where)->skip($start)->take($length)->get();
		
		$frontUrl = Config::where('name','frontUrl')->pluck('value')->first();
		$frontUrl .= '/register';

		$result = array();
		if ($edit_cus_level == 14) { //总代理
			foreach($datas as $data){
				$name = $data->username . "<br />(" . $data->nickname . ")";
				if ($data->valid == 1) {
					$status = "<a class=\"status-btn status-open\" href=\"javascript:void(0);\">啟用</a>";
				} elseif ($data->valid == 2) {
					$status = "<a class=\"status-btn status-close\" href=\"javascript:void(0);\">停押</a>";
				} elseif ($data->valid == 3) {
					$status = "<a class=\"status-btn status-close\" href=\"javascript:void(0);\">鎖定</a>";
				} elseif ($data->valid == 4) {
					$status = "<a class=\"status-btn status-close\" href=\"javascript:void(0);\">停用</a>";
				}
				$commissionRule = $data->commissionRule ? $data->commissionRule->name : "";
				$retreatRule = $data->retreatRule ? $data->retreatRule->name : "";
				$extraCommissionRule = $data->extraCommissionRule ? $data->extraCommissionRule->name : "";

				$child_count = UserModel::where('role', 'agent')->where('pid', $data->id)->count();
				$child_count = "<a href=\"/agent/agent_info_manager?edit_cus_level=15&search_customer_userid={$data->username}&search_level=14&top_cus_id={$data->id}&edit_station_code=3&is_back=1\">{$child_count}</a>";
				//"<a href=\"agent_info_manager.php?edit_cus_level=15&search_customer_userid=jeffrey&search_level=14&top_cus_id=39&edit_station_code=3&is_back=1\">1</a>"
				$child_member_count = UserModel::getMembersOfTopAgent($data->id)->count();
				$child_member_count = "<a href=\"/agent/customer_info?edit_cus_level=16&search_customer_userid={$data->username}&search_level=14&top_cus_id={$data->id}&edit_station_code=3&is_back=1\">{$child_member_count}</a>";
				//"<a href=\"cus_info_manager.php?edit_cus_level=16&search_customer_userid=jeffrey&search_level=14&top_cus_id=39&edit_station_code=3&is_back=1\">19</a>"
				$balance = $data->balance;
				$invite_code =  "<span>{$data->invite_code}</span><br><a href='javascript:void(0);' onclick='copy_link(this);'>{$frontUrl}?invite_code={$data->invite_code}</a>";
	
				$created_at = "<div align= center>".$data->created_at."</div>";
				$action = "<a href=\"javascript:void(0);\" onclick=\"show_qr_code('{$frontUrl}?invite_code={$data->invite_code}');\" class=\"btn btn-xs default\"><i class=\"fa fa-pencil\"></i> QR code </a>\n\t\t\t\t\t\t\t\t";
				$action .= "<a href=\"/agent/agent_info_editor?etype=edit&edit_cus_id={$data->id}&edit_cus_level=14\" class=\"btn btn-xs default\"> <i class=\"fa fa-pencil\"></i> 資料 </a>\n\t\t\t\t\t\t\t\t";
				$action .= "<a href=\"cus_info_log_list?user_id={$data->id}&is_back=1\"  class=\"btn btn-xs default\"> <i class=\"fa fa-pencil\"></i> 修改歷程 </a>\n\t\t\t\t\t\t\t\t";

				$formatItem = array();
				$formatItem[] = $name;
				$formatItem[] = $status;
				$formatItem[] = $commissionRule;
				$formatItem[] = $retreatRule;
				$formatItem[] = $extraCommissionRule;
				$formatItem[] = $child_count;
				$formatItem[] = $child_member_count;
				$formatItem[] = $balance;
				$formatItem[] = $created_at;
				$formatItem[] = $invite_code;
				$formatItem[] = $action;
				$result[] = $formatItem;
			}
		} else { //代理
			foreach($datas as $data){
				$name = "<a href='/agent/agent_info_manager?edit_cus_level=15&top_cus_id={$data->id}'>" . $data->username . "</a><br />(" . $data->nickname . ")";
				
				// $parent = UserModel::where('role', 'topagent')->where('id', $data->pid)->first();
				$parent = UserModel::where('id', $data->pid)->first();

				$parent_name = $parent->username . "<br />(" . $parent->nickname . ")";
				if ($data->valid == 1) {
					$status = "<a class=\"status-btn status-open\" href=\"javascript:void(0);\">啟用</a>";
				} elseif ($data->valid == 2) {
					$status = "<a class=\"status-btn status-close\" href=\"javascript:void(0);\">停押</a>";
				} elseif ($data->valid == 3) {
					$status = "<a class=\"status-btn status-close\" href=\"javascript:void(0);\">鎖定</a>";
				} elseif ($data->valid == 4) {
					$status = "<a class=\"status-btn status-close\" href=\"javascript:void(0);\">停用</a>";
				}
				$commissionRule = $data->commissionRule ? $data->commissionRule->name : "";
				$retreatRule = $data->retreatRule ? $data->retreatRule->name : "";
				$child_member_count = UserModel::where('role', 'customer')->where('pid', $data->id)->count();
				$child_member_count = "<a href=\"/agent/customer_info?edit_cus_level=16&search_customer_userid={$data->username}&search_level=15&top_cus_id={$data->id}&edit_station_code=3&is_back=1\">{$child_member_count}</a>";
				//"<a href=\"cus_info_manager.php?edit_cus_level=16&search_customer_userid=jeffrey1&search_level=15&top_cus_id=51&edit_station_code=3&is_back=1\">1</a>"
				$balance = $data->balance;
				$invite_code =  "<span>{$data->invite_code}</span><br><a href='javascript:void(0);' onclick='copy_link(this);'>{$frontUrl}?invite_code={$data->invite_code}</a>";
	
				$created_at = "<div align= center>".$data->created_at."</div>";
				$action = "<a href=\"javascript:void(0);\" onclick=\"show_qr_code('{$frontUrl}?invite_code={$data->invite_code}');\" class=\"btn btn-xs default\"><i class=\"fa fa-pencil\"></i> QR code </a>\n\t\t\t\t\t\t\t\t";
				$action .= "<a href=\"/agent/agent_info_editor?etype=edit&edit_cus_id={$data->id}&edit_cus_level=15\" class=\"btn btn-xs default\"> <i class=\"fa fa-pencil\"></i> 資料 </a>\n\t\t\t\t\t\t\t\t";

				$formatItem = array();
				$formatItem[] = $name;
				$formatItem[] = $parent_name;
				$formatItem[] = $status;
				$formatItem[] = $commissionRule;
				$formatItem[] = $retreatRule;
				$formatItem[] = $child_member_count;
				$formatItem[] = $balance;
				$formatItem[] = $created_at;
				$formatItem[] = $invite_code;
				$formatItem[] = $action;
				$result[] = $formatItem;
			}
		}
		
		
		$count = UserModel::where($where)->count();
		if($result == null)$result = [];
		$draw = 1;
		if(isset($get['draw']))
			$draw = intval($get['draw']);
		$result = Functions::listData($draw ,$count,$count,$result);
		return $response->withJson($result);
	}

	public function agentInfoEditor($request, $response)
    {
		//$post = $request->getParsedBody();
		$get = $request->getQueryParams();
		$etype = $get['etype'];
		$edit_level = $get['edit_cus_level'];
		$btn_type = isset($get['btn_type']) ? $get['btn_type']:'basic-info-area';

		$top_agents = array();
		$GameStoreTypes = array();
		$user_open_game_ids = array();
		$retreatRuleArray = array();
		$parentRetreatRuleArray = array();
		$extraCommissionRuleArray = array();
		$parentExtraCommissionRuleArray = array();
		if ($etype == 'edit') {
			//编辑
			$agent = UserModel::find(intval($get['edit_cus_id']));
			$top_cus_id = $agent->pid;
			//开放游戏设定--------------------------------------
			$GameStoreTypes = GameStoreTypeModel::with('games')->get();
			$user_open_game_ids = $agent->games()->pluck('game_id')->toArray();

			//parent退水設定 (整理成前台好用的)
			$games = GameModel::get();
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
			$games = GameModel::get();
			$retreatRule = RetreatRuleModel::with('ruleDetailsGames')->where('user_id', $get['edit_cus_id'])->orderBy('init_date', 'desc')->first();
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
					if (isset($parentRetreatRuleArray[$game->id]['percent']) && $parentRetreatRuleArray[$game->id]['percent'] != '-') {
						$retreatRuleArray[$game->id] = ['percent' => $parentRetreatRuleArray[$game->id]['percent']];
					} else {
						$retreatRuleArray[$game->id] = ['percent' => 0];
					}
				}
			}

			//parent佔成設定 (整理成前台好用的)
			$games = GameModel::get();
			$parentExtraCommissionRule = ExtraCommissionRuleModel::with('ruleDetailsGames')->where('user_id', $top_cus_id)->orderBy('init_date', 'desc')->first();
			if ($parentExtraCommissionRule) {
				foreach ($games as $game) {
					foreach ($parentExtraCommissionRule['ruleDetailsGames'] as $item) {
						if ($game->id == $item->game_id) {
							$parentExtraCommissionRuleArray[$game->id] = ['percent' => $item['percent']];
						}
					}
				}
			} else {
				foreach ($games as $game) {
					if ($top_cus_id == 0 || $top_cus_id == 1) {
						//沒有上層或上層是管理員
						$parentExtraCommissionRuleArray[$game->id] = ['percent' => '-'];
					} else {
						$parentExtraCommissionRuleArray[$game->id] = ['percent' => 0];
					}
					
				}
			}
			//佔成設定 (整理成前台好用的)
			$games = GameModel::get();
			$extraCommissionRule = ExtraCommissionRuleModel::with('ruleDetailsGames')->where('user_id', $get['edit_cus_id'])->orderBy('init_date', 'desc')->first();
			if ($extraCommissionRule) {
				foreach ($games as $game) {
					foreach ($extraCommissionRule['ruleDetailsGames'] as $item) {
						if ($game->id == $item->game_id) {
							$extraCommissionRuleArray[$game->id] = ['percent' => $item['percent']];
						}
					}
				}
			} else {
				foreach ($games as $game) {
					$extraCommissionRuleArray[$game->id] = ['percent' => 0];
				}
			}
		} else {
			//新增
			$agent = new UserModel;
			$top_cus_id = isset($get['top_cus_id']) ? $get['top_cus_id'] : $_SESSION['id'];
			$top_agents = UserModel::where('id', $top_cus_id)->get();
		}
		
		$commissionRules = CommissionRuleModel::all();

		//可用真人限紅組 從上層來判斷
		$parent = UserModel::find($top_cus_id);
		if ($parent->role == 'topagent') {
			$userGroups = UserGroup::all();
		} else {
			$user_group_ids = explode(',', $parent->user_group_id);
			$userGroups = UserGroup::whereIn('id', $user_group_ids)->get();
		}
		//真人限紅組轉為陣列
		$agent->user_group_id = explode(',', $agent->user_group_id ?? '');

        return $this->view->render('agent_info_editor', [
			'btn_type'=>$btn_type,
			'agent'=>$agent,
			'etype'=>$etype,
			'edit_level'=>$edit_level,
			'title'=>'editor',
			"commissionRules" => $commissionRules,
			"top_cus_id" => $top_cus_id,
			"top_agents" => $top_agents,
			"GameStoreTypes" => $GameStoreTypes,
			"user_open_game_ids" => $user_open_game_ids,
			"userGroups" => $userGroups,
			"parentRetreatRuleArray" => $parentRetreatRuleArray,
			"retreatRuleArray" => $retreatRuleArray,
			"parentExtraCommissionRuleArray" => $parentExtraCommissionRuleArray,
			"extraCommissionRuleArray" => $extraCommissionRuleArray,
		]);
	}

	public function saveAgentInfo($request, $response)
    {
		$get = $request->getQueryParams();
		$post = $request->getParsedBody();
		$id = $post['edit_cus_id'];
		$etype = $post['etype'];
		$save_type = $post['save_type'];
		
		if ($save_type == 'basic-info') {
			$editInfo = '';
		
			if($etype == 'edit'){
				$agent = UserModel::find($id);
				if ($post['customer_pass1'] != '') {
					if (strlen($post['customer_pass1']) < 3) {
						$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'6\', {\"target\":\"kangAgentInfoEditor\"}));page_content_mask_hide();"}]}}');
						return $response->withJson($msg);
					}
					if ($post['customer_pass1'] != $post['customer_pass2']) {
						$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'5\', {\"target\":\"kangAgentInfoEditor\"}));page_content_mask_hide();"}]}}');
						return $response->withJson($msg);
					}
					$agent->password = crypt($post['customer_pass1'], '$1$' . substr(md5($agent->username), 5, 8));
					$editInfo .= _('修改密碼').'<br>';
				}
			} else {
				$agent = new UserModel;
				if ($post['customer_userid'] == '') {
					$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'2\', {\"target\":\"kangAgentInfoEditor\"}));page_content_mask_hide();"}]}}');
					return $response->withJson($msg);
				}
				if (strlen($post['customer_userid']) < 2 || strlen($post['customer_userid']) > 10) {
					$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'13\', {\"target\":\"kangAgentInfoEditor\"}));page_content_mask_hide();"}]}}');
					return $response->withJson($msg);
				}
				if ($post['customer_pass1'] == '') {
					$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'3\', {\"target\":\"kangAgentInfoEditor\"}));page_content_mask_hide();"}]}}');
					return $response->withJson($msg);
				}
				if (strlen($post['customer_pass1']) < 3) {
					$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'6\', {\"target\":\"kangAgentInfoEditor\"}));page_content_mask_hide();"}]}}');
					return $response->withJson($msg);
				}
				if ($post['customer_pass1'] != $post['customer_pass2']) {
					$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'5\', {\"target\":\"kangAgentInfoEditor\"}));page_content_mask_hide();"}]}}');
					return $response->withJson($msg);
				}
				$exist = UserModel::where('username', $post['customer_userid'])->first();
				if ($exist) {
					$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'11\', {\"target\":\"kangAgentInfoEditor\"}));page_content_mask_hide();"}]}}');
					return $response->withJson($msg);
				}
				$agent->username = $post['customer_userid'];
				$agent->password = crypt($post['customer_pass1'], '$1$' . substr(md5($post['customer_userid']), 5, 8));
				$agent->level = $post['edit_cus_level'] == 14 ? 0 : 1;
				$agent->pid = $post['top_cus_id'];
				if ($post['top_cus_id']==''){
					$agent->parents = "/1/";
				}elseif ($post['top_cus_id'] == 1) {
					$agent->parents = "/1/";
				} else {
					$top_parent = UserModel::find($post['top_cus_id']);
					$agent->parents = $top_parent->parents . $post['top_cus_id'] ."/";
					$agent->level = $top_parent->level + 1;
				}
				
				
				$agent->role = $post['edit_cus_level'] == 14 ? "topagent" : "agent";
			}
			if ($post['customer_name'] == '') {
				$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'7\', {\"target\":\"kangAgentInfoEditor\"}));page_content_mask_hide();"}]}}');
				return $response->withJson($msg);
			}
			
			if($agent->nickname != $post['customer_name'])$editInfo .= _('修改昵稱').'<br>';
			$agent->nickname = $post['customer_name'];

			if($agent->valid != $post['customer_status']){
				if($post['customer_status'] == '1')
					$editInfo .= _('狀態:啟用').'<br>';
				elseif($post['customer_status'] == '2')
					$editInfo .= _('狀態:停押').'<br>';
				elseif($post['customer_status'] == '3')
					$editInfo .= _('狀態:鎖定').'<br>';
				elseif($post['customer_status'] == '4')
					$editInfo .= _('狀態:停用').'<br>';
			}
			$agent->valid = $post['customer_status'];
			/*$agent->has_control_perm = $post['has_control_perm'];*/
			
			//$agent->fee_percent = $post['fee_percent'];
			if($agent->note != $post['notes'])$editInfo .= _('修改備註').':'.$post['notes'].'<br>';
			$agent->note = $post['notes'];

			if ($post['edit_cus_level'] == 15) {
				/*if (count($post['user_group_id']) == 0) {
					$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(\'請勾選真人限紅組\');page_content_mask_hide();"}]}}');
					return $response->withJson($msg);
				}*/
				
				//$user_group_id = implode(',', $post['user_group_id']);    // 轉成 "1,2,3" 這種格式

				//if($agent->user_group_id != $user_group_id) $editInfo .= _('真人限紅組').':'.$user_group_id.'<br>';
				//$agent->user_group_id = $user_group_id;

				if ($post['memberCount'] < 0) {
					$post['memberCount'] = 0;
				}

				if($agent->memberCount != $post['memberCount'])$editInfo .= _('會員人數上限').':'.$post['memberCount'].'<br>';
				$agent->memberCount = $post['memberCount'];
			}
			
			$agent->save();
			if ($etype == 'add') {
				$agent->invite_code = 'tjs' . ($agent->id + 99);
				$agent->save();
				$agent->games()->sync(GameModel::pluck('id')->all());

				//跳轉退水設定頁面
				$result = [];
				$result['root']['ajaxdata'][] = [
					'spanid' => 'javascript',
					'rtntext' => 'location.href = "/agent/agent_info_editor?etype=edit&edit_cus_level='.$post['edit_cus_level'].'&edit_cus_id='.$agent->id. '&btn_type=retreat-info-area' .'";page_content_mask_hide();',
				];
				return $response->withJson($result);
				//$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'-1\', {\"target\":\"kangAgentInfoEditor\"}));page_content_mask_hide();"}]}}');
			} else {
				if ($editInfo) {
					$userLog = new UserLog;
					$userLog->saveLog($id,1,'修改資料',$_SESSION['username'],$editInfo);
				}
				$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'-2\', {\"m1\":\"\\u57fa\\u672c\\u8cc7\\u6599\",\"target\":\"kangAgentInfoEditor\"}));page_content_mask_hide();"}]}}');
			}
			return $response->withJson($msg);
		} elseif ($save_type == 'open-game-info') {
			//开放游戏设定
			$edit_cus_level = $post['edit_cus_level'];
			$game_status_arr = $post['game_status_arr'];
			$agent = UserModel::find($id);
			$agent->games()->sync($game_status_arr);


			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(show_msg(\'-2\', {\"m1\":\"\\u57fa\\u672c\\u8cc7\\u6599\",\"target\":\"kangAgentInfoEditor\"}));page_content_mask_hide();"}]}}');
			return $response->withJson($msg);
		} elseif ($save_type == 'retreat-info') {
			//取得下個周日的日期
			$init_date = Functions::getNextSundayDate();

			//退水设定
			$retreat_game_arr = $post['retreat_game_arr'];

			//檢查有沒有超過上層
			$agent = UserModel::find($id);
			$checkResult = $agent->checkRetreatRuleNotExceedParent($retreat_game_arr);
		
			if (!$checkResult['success']) {
				$msgText = $checkResult['message'];
				$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(\'' . $msgText . '\', {\"target\":\"kangAgentInfoEditor\"});page_content_mask_hide();"}]}}');
				return $response->withJson($msg);
			}

			//佔成设定
			$extra_commission_game_arr = $post['extra_commission_game_arr'];

			//檢查有沒有超過上層
			$agent = UserModel::find($id);
			$checkResult = $agent->checkExtraCommissionRuleNotExceedParent($extra_commission_game_arr);
			
			if (!$checkResult['success']) {
				$msgText = $checkResult['message'];
				$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"pop_msg(\'' . $msgText . '\', {\"target\":\"kangAgentInfoEditor\"});page_content_mask_hide();"}]}}');
				return $response->withJson($msg);
			}


			////////////////////////////////////////////////////////////////////////////////////////////

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

				$game = GameModel::find($game_id);
				$editInfo .= $game->name .':' . $number .'<br>';
			}
			$userLog = new UserLog;
			$userLog->saveLog($id,1,'設定退水',$_SESSION['username'],$editInfo);

			///////////////////////////////////////////////////////////////////////////////////////////////////
			//佔成设定

			$hasExtraCommissionRule = ExtraCommissionRuleModel::with('ruleDetailsGames')->where('user_id', $id)->count();
			if ($hasExtraCommissionRule == 0) {
				//首次新增
				$data = new ExtraCommissionRuleModel;
				$data->user_id = $id;
				$data->init_date = null;
				$data->operator = $_SESSION['username'];
				$data->save();
			} else {
				//後續修改 
				$extraCommissionRule = ExtraCommissionRuleModel::with('ruleDetailsGames')->where('user_id', $id)->where('init_date', $init_date)->first();
				if ($extraCommissionRule == null) {
					$data = new ExtraCommissionRuleModel;
					$data->user_id = $id;
					$data->init_date = $init_date;
				} else {
					$data = $extraCommissionRule;
					//先清除旧数据
					$details = ExtraCommissionRuleDetailModel::where('extra_commission_rule_id', $data->id)->get();
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
			$detail = new ExtraCommissionRuleDetailModel();
			$detail->extra_commission_rule_id = $data->id;
			$detail->lower_limit = 0;
			$detail->upper_limit = 0;
			$detail->save();
			
			$editInfo = '設定佔成值:<br>';
			foreach ($extra_commission_game_arr as $game_id => $number) {
				if (!$number) {
					$number = 0;
				}
				$detail->games()->attach($game_id, ['percent' => $number]);

				$game = GameModel::find($game_id);
				$editInfo .= $game->name .':' . $number .'<br>';
			}
			$userLog = new UserLog;
			$userLog->saveLog($id,1,'設定佔成',$_SESSION['username'],$editInfo);
			
			if ($hasExtraCommissionRule == 0) {
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

	//有效会员规则设定
	public function effectCusRuleManager($request, $response)
    {
        return $this->view->render('effect_cus_rule_manager');
	}

	public function listEffectCusRules($request, $response)
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
		
		$datas = EffectCusRuleModel::where($where)->skip($start)->take($length)->get();
		$result = array();
		foreach($datas as $data){
			$name = "<div align= center>" . $data->name . "</div>";
			$rule  = "<div align= left><div>總入金：&nbsp;&nbsp".$data->total_deposit."</div><div>總有效投注額：&nbsp;&nbsp;".$data->total_bet_real_amount."</div><div>月入金：&nbsp;&nbsp;".$data->month_deposit."</div><div>月有效投注額：&nbsp;&nbsp;".$data->month_bet_real_amount."</div></div>";
			if ($data->status == 1) {
				$status = "<div align= center><a class=\"status-btn status-open\" href=\"javascript:void(0);\">啟用</a></div>";
			} else {
				$status = "<div align= center><a class=\"status-btn status-close\" href=\"javascript:void(0);\">停用</a></div>";
			}
			$created_at = "<div align= center>".$data->created_at."</div>";
			$operator = "<div align= center>".$data->operator."</div>";
			$updated_at = "<div align= center>".$data->updated_at."</div>";
			$action = "<div align= center>\n\t\t\t\t\t\t\t\t<a href=\"javascript:void(0);\" onclick=\"request_editor_item_div('edit', '".$data->id."');\" class=\"btn btn-xs default\"> <i class=\"fa fa-pencil\"></i> 修改 </a>\n\t\t\t\t\t\t\t\t</div>";
			
			$formatItem = array();
			$formatItem[] = $name;
			$formatItem[] = $rule;
			$formatItem[] = $status;
			$formatItem[] = $created_at;
			$formatItem[] = $operator;
			$formatItem[] = $updated_at;
			$formatItem[] = $action;
			$result[] = $formatItem;
		}
		
		$count = EffectCusRuleModel::where($where)->count();
		if($result == null)$result = [];
		$draw = 1;
		if(isset($get['draw']))
			$draw = intval($get['draw']);
		$result = Functions::listData($draw ,$count,$count,$result);
		return $response->withJson($result);
	}

	public function effectCusRulesEditor($request, $response)
    {
		$post = $request->getParsedBody();
		$etype = $post['etype'];
		$id = $post['edit_effect_cus_rule_id'];

		if ($etype == 'add') {
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"#editor-item-div","rtntext":"<!--slot=2-->\n<form id=\"editor-item-form\">\n\t<table class=\"table editor-table table-bordered\">\n\t\t<thead>\n\t\t\t<tr>\n\t\t\t\t<th class=\"title\" colspan=\"100%\">\u65b0\u589e<\/th>\n\t\t\t<\/tr>\n\t\t<\/thead>\n\t\t<tbody>\n\t\t\t<tr>\n\t\t\t\t<td>\u898f\u5247\u540d\u7a31<\/td>\n\t\t\t\t<td><input type=\"text\" id=\"effect-cus-rule-name\" name=\"effect_cus_rule_name\" value=\"\"><\/td>\n\t\t\t<\/tr>\n\t\t\t<tr>\n\t\t\t\t<td>\u898f\u5247\u689d\u4ef6<\/td>\n\t\t\t\t<td><div>\u7e3d\u5165\u91d1&nbsp;&nbsp;<input type=\"text\" name=\"effect_cus_condition[total_deposit]\" value=\"0\"><\/div><div>\u7e3d\u6709\u6548\u6295\u6ce8\u984d&nbsp;&nbsp;<input type=\"text\" name=\"effect_cus_condition[total_bet_real_amount]\" value=\"0\"><\/div><div>\u6708\u5165\u91d1&nbsp;&nbsp;<input type=\"text\" name=\"effect_cus_condition[month_deposit]\" value=\"0\"><\/div><div>\u6708\u6709\u6548\u6295\u6ce8\u984d&nbsp;&nbsp;<input type=\"text\" name=\"effect_cus_condition[month_bet_real_amount]\" value=\"0\"><\/div><\/td>\n\t\t\t<\/tr>\n\t\t\t<tr>\n\t\t\t\t<td>\u72c0\u614b<\/td>\n\t\t\t\t<td>\u662f\u5426\u555f\u7528<input type=\"checkbox\" name=\"status\" value=\"1\" checked \/><\/td>\n\t\t\t<\/tr>\n\t\t\t<tr align=\"right\">\n\t\t\t\t<td colspan=\"100%\"><button type=\"button\" class=\"btn red\" onclick=\"close_layer({type: 1});\">\u53d6\u6d88<\/button><button type=\"button\" class=\"btn green\" onclick=\"save_cus_effect_cus_rule();\">\u5132\u5b58<\/button><\/td>\n\t\t\t<\/tr>\n\t\t<\/tbody>\n\t<\/table>\n\t<input type=\"hidden\" id=\"etype\" value=\"add\" \/>\n\t<input type=\"hidden\" id=\"edit-effect-cus-rule-id\" value=\"\" \/>\n<\/form>\n"},{"spanid":"javascript","rtntext":"show_editor_item_div();App.init();"}]}}');
		} else {
			$data = EffectCusRuleModel::where('id', $id)->first();
			$name = $data->name;
			$total_deposit = $data->total_deposit;
			$total_bet_real_amount = $data->total_bet_real_amount;
			$month_deposit = $data->month_deposit;
			$month_bet_real_amount = $data->month_bet_real_amount;
			$status = $data->status;
			if ($status) {
				$checked = 'checked';
			} else {
				$checked = '';
			}
			
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"#editor-item-div","rtntext":"<!--slot=2-->\n<form id=\"editor-item-form\">\n\t<table class=\"table editor-table table-bordered\">\n\t\t<thead>\n\t\t\t<tr>\n\t\t\t\t<th class=\"title\" colspan=\"100%\">\u7de8\u8f2f<\/th>\n\t\t\t<\/tr>\n\t\t<\/thead>\n\t\t<tbody>\n\t\t\t<tr>\n\t\t\t\t<td>\u898f\u5247\u540d\u7a31<\/td>\n\t\t\t\t<td><input type=\"text\" id=\"effect-cus-rule-name\" name=\"effect_cus_rule_name\" value=\"'.$name.'\"><\/td>\n\t\t\t<\/tr>\n\t\t\t<tr>\n\t\t\t\t<td>\u898f\u5247\u689d\u4ef6<\/td>\n\t\t\t\t<td><div>\u7e3d\u5165\u91d1&nbsp;&nbsp;<input type=\"text\" name=\"effect_cus_condition[total_deposit]\" value=\"'.$total_deposit.'\"><\/div><div>\u7e3d\u6709\u6548\u6295\u6ce8\u984d&nbsp;&nbsp;<input type=\"text\" name=\"effect_cus_condition[total_bet_real_amount]\" value=\"'.$total_bet_real_amount.'\"><\/div><div>\u6708\u5165\u91d1&nbsp;&nbsp;<input type=\"text\" name=\"effect_cus_condition[month_deposit]\" value=\"'.$month_deposit.'\"><\/div><div>\u6708\u6709\u6548\u6295\u6ce8\u984d&nbsp;&nbsp;<input type=\"text\" name=\"effect_cus_condition[month_bet_real_amount]\" value=\"'.$month_bet_real_amount.'\"><\/div><\/td>\n\t\t\t<\/tr>\n\t\t\t<tr>\n\t\t\t\t<td>\u72c0\u614b<\/td>\n\t\t\t\t<td>\u662f\u5426\u555f\u7528<input type=\"checkbox\" name=\"status\" value=\"1\" '.$checked.' \/><\/td>\n\t\t\t<\/tr>\n\t\t\t<tr align=\"right\">\n\t\t\t\t<td colspan=\"100%\"><button type=\"button\" class=\"btn red\" onclick=\"close_layer({type: 1});\">\u53d6\u6d88<\/button><button type=\"button\" class=\"btn green\" onclick=\"save_cus_effect_cus_rule();\">\u5132\u5b58<\/button><\/td>\n\t\t\t<\/tr>\n\t\t<\/tbody>\n\t<\/table>\n\t<input type=\"hidden\" id=\"etype\" value=\"edit\" \/>\n\t<input type=\"hidden\" id=\"edit-effect-cus-rule-id\" value=\"'.$data->id.'\" \/>\n<\/form>\n"},{"spanid":"javascript","rtntext":"show_editor_item_div();App.init();"}]}}');
		}
		return $response->withJson($msg);
	}

	public function saveEffectCusRule($request, $response)
    {
		$post = $request->getParsedBody();
		$id = $post['edit_effect_cus_rule_id'];
		
		$data = new EffectCusRuleModel;
		if($id > 0){
			$data = EffectCusRuleModel::find($id);
		}

		$data->name = $post['effect_cus_rule_name'];
		$data->total_deposit = isset($post['effect_cus_condition']['total_deposit']) ?$post['effect_cus_condition']['total_deposit']: 0;
		$data->total_bet_real_amount = isset($post['effect_cus_condition']['total_bet_real_amount']) ?$post['effect_cus_condition']['total_bet_real_amount']: 0;
		$data->month_deposit = isset($post['effect_cus_condition']['month_deposit']) ?$post['effect_cus_condition']['month_deposit']: 0;
		$data->month_bet_real_amount = isset($post['effect_cus_condition']['month_bet_real_amount']) ?$post['effect_cus_condition']['month_bet_real_amount']: 0;
		$data->status = isset($post['status']) ?: 0;
		$data->operator = $_SESSION['username'];
		$data->save();
		if($id > 0)
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"close_layer({type: 1});pop_msg(show_msg(\'-2\', {\"target\":\"kangEffectCusRule\"}));grid.getDataTable().ajax.reload();"}]}}');
		else
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"close_layer({type: 1});pop_msg(show_msg(\'-1\', {\"target\":\"kangEffectCusRule\"}));grid.getDataTable().ajax.reload();"}]}}');
		return $response->withJson($msg);
	}

	public function commissionRuleManager($request, $response)
    {
		$gameStoreTypes = GameStoreTypeModel::with('gameStores.games')->get();
		$effectCusRules = EffectCusRuleModel::all();

        return $this->view->render('commission_rule_manager', [
			"gameStoreTypes" => $gameStoreTypes,
			"effectCusRules" => $effectCusRules,
		]);
	}

	public function listCommissionRules($request, $response)
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
		
		$datas = CommissionRuleModel::with('effectCusRule')->where($where)->skip($start)->take($length)->get();
		$result = array();
		foreach($datas as $data){
			$name = $data->name;
			$effect_cus_rule_name = $data->effectCusRule->name;
			if ($data->status == 1) {
				$status = "<a class=\"status-btn status-open\" href=\"javascript:void(0);\">啟用</a>";
			} else {
				$status = "<a class=\"status-btn status-close\" href=\"javascript:void(0);\">停用</a>";
			}
			$created_at = $data->created_at;
			$operator = $data->operator;
			$updated_at = $data->updated_at;
			$action = "<a href=\"javascript:void(0);\" onclick=\"request_editor_item_div('edit', '{$data->id}');\" class=\"btn btn-xs default\"> <i class=\"fa fa-pencil\"></i> 修改 </a>";
			
			$formatItem = array();
			$formatItem[] = $name;
			$formatItem[] = $effect_cus_rule_name;
			$formatItem[] = $status;
			$formatItem[] = $created_at;
			$formatItem[] = $operator;
			$formatItem[] = $updated_at;
			$formatItem[] = $action;
			$result[] = $formatItem;
		}
		
		$count = CommissionRuleModel::where($where)->count();
		if($result == null)$result = [];
		$draw = 1;
		if(isset($get['draw']))
			$draw = intval($get['draw']);
		$result = Functions::listData($draw ,$count,$count,$result);
		return $response->withJson($result);
	}

	public function commissionRuleEditor($request, $response)
    {
		$post = $request->getParsedBody();
		$etype = $post['etype'];
		$id = $post['edit_commission_rule_id'];

		
		$data = CommissionRuleModel::with('CommissionRuleDetails.gameStores', 'effectCusRule')->where('id', $id)->first();

		return $response->withJson($data);
	}

	public function saveCommissionRule($request, $response)
    {
		$post = $request->getParsedBody();
		$id = $post['edit_commission_rule_id'];
		$etype = $post['etype'];
		$commission_condition = isset($post['commission_condition']) ?$post['commission_condition']:array();

		if ($post['commission_rule_name'] == '') {
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"close_layer({type: 1});pop_msg(show_msg(\'2\', {\"target\":\"kangCommissionRule\"}));grid.getDataTable().ajax.reload();"}]}}');
			return $response->withJson($msg);
		}
		try {
			DB::beginTransaction();

			if ($etype == 'add') {
				$data = new CommissionRuleModel;

			} else {
				$data = CommissionRuleModel::find($id);
				//先清除旧数据
				$details = CommissionRuleDetailModel::where('commission_rule_id', $data->id)->get();
				if ($details) {
					foreach ($details as $item) {
						$item->gameStores()->detach();
						$item->delete();
					}
				}
				

			}

			$data->name = $post['commission_rule_name'];
			if (isset($post['status'])) {
				$data->status = $post['status'];
			} else {
				$data->status = 0;
			}
			$data->effect_cus_rule_id = $post['effect_cus_rule_id'];
			$data->operator = $_SESSION['username'];
			$data->save();

			foreach ($commission_condition as $condition) {
				$detail = new CommissionRuleDetailModel();
				$detail->commission_rule_id = $data->id;
				$detail->lower_limit = $condition['lower_limit'];
				$detail->upper_limit = $condition['upper_limit'];
				$detail->effect_cus_num = $condition['effect_cus_num'];
				
				$detail->save();
				
				foreach ($condition as $key => $number) {
					if (strpos($key,'commission') !== false ) {
						$store_id = explode('_', $key);
						$store_id = $store_id[0];
						$detail->gameStores()->attach($store_id, ['percent' => $number]);
					}
				}
				
			}
			DB::commit();
		} catch (\Exception $ex) {
			DB::rollBack();
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"close_layer({type: 1});pop_msg(show_msg(\'1\', {\"target\":\"kangCommissionRule\"}));grid.getDataTable().ajax.reload();"}]}}');
			return $response->withJson($msg);
        }

		if($etype == 'edit')
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"close_layer({type: 1});pop_msg(show_msg(\'-2\', {\"target\":\"kangCommissionRule\"}));grid.getDataTable().ajax.reload();"}]}}');
		else
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"close_layer({type: 1});pop_msg(show_msg(\'-1\', {\"target\":\"kangCommissionRule\"}));grid.getDataTable().ajax.reload();"}]}}');
		return $response->withJson($msg);
	}

	public function retreatRuleManager($request, $response)
    {
		$gameStoreTypes = GameStoreTypeModel::with('games.gameStores')->get();
		$effectCusRules = EffectCusRuleModel::all();
		
        return $this->view->render('retreat_rule_manager', [
			"gameStoreTypes" => $gameStoreTypes,
			"effectCusRules" => $effectCusRules,
		]);
	}

	public function listRetreatRules($request, $response)
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
		$where[] = array('user_id', $_SESSION['id']);
		$datas = RetreatRuleModel::with('effectCusRule')->where($where)->skip($start)->take($length)->get();
		$result = array();
		foreach($datas as $data){
			$name = $data->name;
			if ($data->effectCusRule) {
				$effect_cus_rule_name = $data->effectCusRule->name;
			} else {
				$effect_cus_rule_name = '';
			}
			if ($data->status == 1) {
				$status = "<a class=\"status-btn status-open\" href=\"javascript:void(0);\">啟用</a>";
			} else {
				$status = "<a class=\"status-btn status-close\" href=\"javascript:void(0);\">停用</a>";
			}
			$created_at = $data->created_at;
			$operator = $data->operator;
			$updated_at = $data->updated_at;
			$action = "<a href=\"javascript:void(0);\" onclick=\"request_editor_item_div('edit', '{$data->id}');\" class=\"btn btn-xs default\"> <i class=\"fa fa-pencil\"></i> 修改 </a>";
			
			$formatItem = array();
			$formatItem[] = $name;
			$formatItem[] = $effect_cus_rule_name;
			$formatItem[] = $status;
			$formatItem[] = $created_at;
			$formatItem[] = $operator;
			$formatItem[] = $updated_at;
			$formatItem[] = $action;
			$result[] = $formatItem;
		}
		
		$count = RetreatRuleModel::where($where)->count();
		if($result == null)$result = [];
		$draw = 1;
		if(isset($get['draw']))
			$draw = intval($get['draw']);
		$result = Functions::listData($draw ,$count,$count,$result);
		return $response->withJson($result);
	}

	public function retreatRuleEditor($request, $response)
    {
		$post = $request->getParsedBody();
		$etype = $post['etype'];
		$id = $post['edit_retreat_rule_id'];

		
		$data = RetreatRuleModel::with('RetreatRuleDetails.games', 'effectCusRule', 'games')->where('id', $id)->first();

		return $response->withJson($data);
	}

	public function saveRetreatRule($request, $response)
    {
		$post = $request->getParsedBody();
		$id = $post['edit_retreat_rule_id'];
		$etype = $post['etype'];
		$retreat_condition = isset($post['retreat_condition']) ?$post['retreat_condition']:array();

		if ($post['retreat_rule_name'] == '') {
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"close_layer({type: 1});pop_msg(show_msg(\'2\', {\"target\":\"kangRetreatRule\"}));grid.getDataTable().ajax.reload();"}]}}');
			return $response->withJson($msg);
		}
		try {
			DB::beginTransaction();

			if ($etype == 'add') {
				$data = new RetreatRuleModel;

			} else {
				$data = RetreatRuleModel::find($id);
				//先清除旧数据
				$data->games()->detach();
				$details = RetreatRuleDetailModel::where('retreat_rule_id', $data->id)->get();
				if ($details) {
					foreach ($details as $item) {
						$item->games()->detach();
						$item->delete();
					}
				}
				

			}
			$data->user_id = $_SESSION['id'];
			$data->name = $post['retreat_rule_name'];
			if (isset($post['status'])) {
				$data->status = $post['status'];
			} else {
				$data->status = 0;
			}
			//$data->effect_cus_rule_id = $post['effect_cus_rule_id'];
			$data->operator = $_SESSION['username'];
			$data->save();

			//無需被計算區間(
			if (isset($retreat_condition['is_not_calc'])) {
				foreach ($retreat_condition['is_not_calc'] as $key => $check) {
					$data->games()->attach($key);
				}	
			}
			
			foreach ($retreat_condition as $key => $condition) {
				if ($key == 'is_not_calc') {
					continue;
				}
				$detail = new RetreatRuleDetailModel();
				$detail->retreat_rule_id = $data->id;
				$detail->lower_limit = $condition['lower_limit'];
				$detail->upper_limit = $condition['upper_limit'];
				$detail->effect_cus_num = $condition['effect_cus_num'];
				
				$detail->save();
				
				foreach ($condition as $key => $number) {
					if (strpos($key,'retreat') !== false ) {
						$store_id = explode('_', $key);
						$store_id = $store_id[0];
						$detail->games()->attach($store_id, ['percent' => $number]);
					}
				}
				
			}
			DB::commit();
		} catch (\Exception $ex) {
			DB::rollBack();
			echo $ex->getMessage();
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"close_layer({type: 1});pop_msg(show_msg(\'1\', {\"target\":\"kangRetreatRule\"}));grid.getDataTable().ajax.reload();"}]}}');
			return $response->withJson($msg);
        }

		if($etype == 'edit')
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"close_layer({type: 1});pop_msg(show_msg(\'-2\', {\"target\":\"kangRetreatRule\"}));grid.getDataTable().ajax.reload();"}]}}');
		else
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"close_layer({type: 1});pop_msg(show_msg(\'-1\', {\"target\":\"kangRetreatRule\"}));grid.getDataTable().ajax.reload();"}]}}');
		return $response->withJson($msg);
	}

	public function extraCommissionRuleManager($request, $response)
    {
		$gameStoreTypes = GameStoreTypeModel::with('games.gameStores')->get();
		
        return $this->view->render('extra_commission_rule_manager', [
			"gameStoreTypes" => $gameStoreTypes,
		]);
	}

	public function listExtraCommissionRules($request, $response)
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
		
		$where[] = array('user_id', $_SESSION['id']);	
		$datas = ExtraCommissionRuleModel::where($where)->skip($start)->take($length)->get();
		$result = array();
		foreach($datas as $data){
			$name = $data->name;
			if ($data->status == 1) {
				$status = "<a class=\"status-btn status-open\" href=\"javascript:void(0);\">啟用</a>";
			} else {
				$status = "<a class=\"status-btn status-close\" href=\"javascript:void(0);\">停用</a>";
			}
			$created_at = $data->created_at;
			$operator = $data->operator;
			$updated_at = $data->updated_at;
			$action = "<a href=\"javascript:void(0);\" onclick=\"request_editor_item_div('edit', '{$data->id}');\" class=\"btn btn-xs default\"> <i class=\"fa fa-pencil\"></i> 修改 </a>";
			
			$formatItem = array();
			$formatItem[] = $name;
			$formatItem[] = $status;
			$formatItem[] = $created_at;
			$formatItem[] = $operator;
			$formatItem[] = $updated_at;
			$formatItem[] = $action;
			$result[] = $formatItem;
		}
		
		$count = ExtraCommissionRuleModel::where($where)->count();
		if($result == null)$result = [];
		$draw = 1;
		if(isset($get['draw']))
			$draw = intval($get['draw']);
		$result = Functions::listData($draw ,$count,$count,$result);
		return $response->withJson($result);
	}

	public function extraCommissionRuleEditor($request, $response)
    {
		$post = $request->getParsedBody();
		$etype = $post['etype'];
		$id = $post['edit_extra_commission_rule_id'];

		
		$data = ExtraCommissionRuleModel::with('extraCommissionRuleDetails.games')->where('id', $id)->first();

		return $response->withJson($data);
	}

	public function saveExtraCommissionRule($request, $response)
    {
		$post = $request->getParsedBody();
		$id = $post['edit_extra_commission_rule_id'];
		$etype = $post['etype'];
		$extra_commission_condition = isset($post['extra_commission_condition']) ?$post['extra_commission_condition']:array();

		if ($post['extra_commission_rule_name'] == '') {
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"close_layer({type: 1});pop_msg(show_msg(\'2\', {\"target\":\"kangExtraCommissionRule\"}));grid.getDataTable().ajax.reload();"}]}}');
			return $response->withJson($msg);
		}
		try {
			DB::beginTransaction();

			if ($etype == 'add') {
				$data = new ExtraCommissionRuleModel;

			} else {
				$data = ExtraCommissionRuleModel::find($id);
				//先清除旧数据
				$details = ExtraCommissionRuleDetailModel::where('extra_commission_rule_id', $data->id)->get();
				if ($details) {
					foreach ($details as $item) {
						$item->games()->detach();
						$item->delete();
					}
				}
				

			}

			$data->user_id = $_SESSION['id'];
			$data->name = $post['extra_commission_rule_name'];
			if (isset($post['status'])) {
				$data->status = $post['status'];
			} else {
				$data->status = 0;
			}
			$data->operator = $_SESSION['username'];
			$data->save();

			foreach ($extra_commission_condition as $condition) {
				$detail = new ExtraCommissionRuleDetailModel();
				$detail->extra_commission_rule_id = $data->id;
				$detail->lower_limit = $condition['lower_limit'];
				$detail->upper_limit = $condition['upper_limit'];
				$detail->save();
				
				foreach ($condition as $key => $number) {
					if (strpos($key,'extra_commission') !== false ) {
						$store_id = explode('_', $key);
						$store_id = $store_id[0];
						$detail->games()->attach($store_id, ['percent' => $number]);
					}
				}
				
			}
			DB::commit();
		} catch (\Exception $ex) {
			DB::rollBack();
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"close_layer({type: 1});pop_msg(show_msg(\'1\', {\"target\":\"kangExtraCommissionRule\"}));grid.getDataTable().ajax.reload();"}]}}');
			return $response->withJson($msg);
        }

		if($etype == 'edit')
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"close_layer({type: 1});pop_msg(show_msg(\'-2\', {\"target\":\"kangExtraCommissionRule\"}));grid.getDataTable().ajax.reload();"}]}}');
		else
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"close_layer({type: 1});pop_msg(show_msg(\'-1\', {\"target\":\"kangExtraCommissionRule\"}));grid.getDataTable().ajax.reload();"}]}}');
		return $response->withJson($msg);
	}

	public function periodManager($request, $response)
    {
		$cr = CommissionRuleModel::where('period_id', 0)->get();
		$ecr = ExtraCommissionRuleModel::where('period_id', 0)->get();
		$rr = RetreatRuleModel::where('period_id', 0)->get();
        return $this->view->render('period_manager', [
			'cr' => $cr,
			'ecr' => $ecr,
			'rr' => $rr,
		]);
	}

	public function periodEditor($request, $response)
    {
		$get = $request->getQueryParams();
		$ckout_items = array();
		if ($get['etype'] == 'edit') {
			$data = Period::find($get['edit_period_id']);
			if ($data->ckout_item == 1) {
				$ckout_items = CommissionRuleModel::where('period_id', $data->id)->pluck('id')->toArray();
			} elseif ($data->ckout_item == 2) {
				$ckout_items = RetreatRuleModel::where('period_id', $data->id)->pluck('id')->toArray();
			} elseif ($data->ckout_item == 3) {
				$ckout_items = ExtraCommissionRuleModel::where('period_id', $data->id)->pluck('id')->toArray();
			} 
		} else {
			$data = new Period();
		}

		$cr = CommissionRuleModel::whereIn('period_id', [0, $data->id])->get();
		$ecr = ExtraCommissionRuleModel::whereIn('period_id', [0, $data->id])->get();
		$rr = RetreatRuleModel::whereIn('period_id', [0, $data->id])->get();
        return $this->view->render('period_editor', [
			'data' => $data,
			'ckout_items' => $ckout_items,
			'etype' => $get['etype'],
			'cr' => $cr,
			'ecr' => $ecr,
			'rr' => $rr,
		]);
	}

	public function listPeriods($request, $response)
    {
        $get = $request->getQueryParams();

		$where = array();
		if (isset($get['search_period_name']) && $get['search_period_name'] != '') {
			$where[] = array('name', $get['search_period_name']);
		}
		if (isset($get['search_ckout_type']) && $get['search_ckout_type'] != -1) {
			$where[] = array('ckout_type', $get['search_ckout_type']);
		}
		if (isset($get['search_ckout_item']) && $get['search_ckout_item'] != -1) {
			$where[] = array('ckout_item', $get['search_ckout_item']);
		}
		
		$datas = Period::where($where)->get();
		
		$result = array();
		foreach($datas as $data){
			$name = $data->name;
			$ckout_item = Period::getCkoutItemName($data->ckout_item);
			$ckout_type = Period::getCkoutTypeName($data->ckout_type);
			if ($data->ckout_type == 3) {
				$start_date = $data->start_date;
				$end_date = $data->end_date;
			} else {
				$start_date = '';
				$end_date = '';
			}
			
			$min_payment_amount = $data->min_payment_amount;
			$action =  "<a href=\"/admin/period_editor?edit_period_id={$data->id}&etype=edit\" class=\"btn btn-xs default\"> <i class=\"fa fa-pencil\"></i> 設定 </a>";
			
			
			$formatItem = array();
			$formatItem[] = $name;
			$formatItem[] = $ckout_item;
			$formatItem[] = $ckout_type;
			$formatItem[] = $start_date;
			$formatItem[] = $end_date;
			$formatItem[] = $min_payment_amount;
			$formatItem[] = $action;
			$result[] = $formatItem;
		}
		
		$count = Period::where($where)->count();
		if($result == null)$result = [];
		$draw = 1;
		if(isset($get['draw']))
			$draw = intval($get['draw']);
		$result = Functions::listData($draw ,$count,$count,$result);
		return $response->withJson($result);
	}

	public function savePeriod($request, $response)
    {
		$get = $request->getQueryParams();
		$post = $request->getParsedBody();
		$id = $post['edit_period_id'];
		$etype = $post['etype'];
		if ($post['period_name'] == '') {
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"alert(show_msg(\'2\', {\"target\":\"kangPeriodEditor\"}));"}]}}');
			return $response->withJson($msg);
		}
		if ($post['ckout_item'] == 0) {
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"alert(show_msg(\'3\', {\"target\":\"kangPeriodEditor\"}));"}]}}');
			return $response->withJson($msg);
		}
		if ($post['ckout_type'] == 0) {
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"alert(show_msg(\'4\', {\"target\":\"kangPeriodEditor\"}));"}]}}');
			return $response->withJson($msg);
		}
		
		try {
			DB::beginTransaction();
			$data = new Period;
			if($etype == 'edit'){
				$data = Period::find($id);
			}
			$data->name = $post['period_name'];
			$data->ckout_item = $post['ckout_item'];
			$data->ckout_type = $post['ckout_type'];
			if ($data->ckout_type == 3) {
				$data->start_date = $post['start_date'] .' ' .$post['start_time'];
				$data->end_date = $post['end_date'] .' '.$post['end_time'];
			}
			
			$data->min_payment_amount = $post['min_payment_amount'];
			$data->operator = $_SESSION['username'];
			$data->save();
			
			if($etype == 'edit') {
				//先把套用规则都清除 再加上
				CommissionRuleModel::where('period_id', $data->id)->update(['period_id'=>0]);
				ExtraCommissionRuleModel::where('period_id', $data->id)->update(['period_id'=>0]);
				RetreatRuleModel::where('period_id', $data->id)->update(['period_id'=>0]);
			}
			if ($data->ckout_item == 1) {
				if (!isset($post['commission_rule_id_arr'])) {
					DB::rollBack();
					$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"alert(show_msg(\'5\', {\"target\":\"kangPeriodEditor\"}));"}]}}');
					return $response->withJson($msg);
				}
				CommissionRuleModel::whereIn('id', $post['commission_rule_id_arr'])->update(['period_id'=> $data->id]);
			} elseif ($data->ckout_item == 2) {
				if (!isset($post['retreat_rule_id_arr'])) {
					DB::rollBack();
					$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"alert(show_msg(\'5\', {\"target\":\"kangPeriodEditor\"}));"}]}}');
					return $response->withJson($msg);
				}
				RetreatRuleModel::whereIn('id', $post['retreat_rule_id_arr'])->update(['period_id'=> $data->id]);
			} elseif ($data->ckout_item == 3) {
				if (!isset($post['extra_commission_rule_id_arr'])) {
					DB::rollBack();
					$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"alert(show_msg(\'5\', {\"target\":\"kangPeriodEditor\"}));"}]}}');
					return $response->withJson($msg);
				}
				ExtraCommissionRuleModel::whereIn('id', $post['extra_commission_rule_id_arr'])->update(['period_id'=> $data->id]);
			}
			DB::commit();
		} catch (\Exception $ex) {
			DB::rollBack();
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"alert(show_msg(\'1\', {\"target\":\"kangPeriodEditor\"}));location.href=location.href"}]}}');

			return $response->withJson($msg);
        }
		
		if($etype == 'edit')
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"alert(show_msg(\'-2\', {\"target\":\"kangPeriodEditor\"}));location.href=location.href"}]}}');
		else
			$msg = json_decode('{"root":{"ajaxdata":[{"spanid":"javascript","rtntext":"alert(show_msg(\'-1\', {\"target\":\"kangPeriodEditor\"}));location.href=location.href"}]}}');
		return $response->withJson($msg);
	}

	public function periodAuditManager($request, $response)
    {
        return $this->view->render('period_audit_manager');
	}
 
	public function getAgentInfo($request, $response)
	{
		try {
			// 獲取請求參數
			$params = $request->getParsedBody();
			$id = isset($params['id']) ? intval($params['id']) : 0;
			
			if (!$id) {
				return $response->withJson([
					'status' => 'error',
					'message' => '未提供有效的用戶ID',
					'params' => $params,
				]);
			}

			// 查詢用戶資訊
			$agent = UserModel::with(['commissionRule', 'retreatRule', 'extraCommissionRule'])
				->where('id', $id)
				->first();

			if (!$agent) {
				return $response->withJson([
					'status' => 'error', 
					'message' => '找不到該用戶'
				]);
			}

			// 返回用戶資訊
			return $response->withJson([
				'status' => 'success',
				'data' => [
					'id' => $agent->id,
					'account' => $agent->username,
					'nickname' => $agent->nickname,
					'balance' => $agent->balance,
					'status' => $agent->valid,
					'commissionRule' => $agent->commissionRule ? $agent->commissionRule->name : '',
					'retreatRule' => $agent->retreatRule ? $agent->retreatRule->name : '',
					'extraCommissionRule' => $agent->extraCommissionRule ? $agent->extraCommissionRule->name : '',
					'created_at' => $agent->created_at
				]
			]);

		} catch (\Exception $e) {
			return $response->withJson([
				'status' => 'error',
				'message' => '系統錯誤',
				'debug' => $e->getMessage()
			]);
		}
	}

	public function agentAdjustFunds($request, $response)
	{
		try {
			// 獲取請求參數
			$params = $request->getParsedBody();
			$id = isset($params['id']) ? intval($params['id']) : 0;
			$fundType = isset($params['fundType']) ? intval($params['fundType']) : 1;
			$operationType = isset($params['operationType']) ? $params['operationType'] : '';
			$amount = isset($params['amount']) ? floatval($params['amount']) : 0;
			$reason = isset($params['reason']) ? $params['reason'] : '';
			$notes = isset($params['notes']) ? $params['notes'] : '';

			// 參數驗證
			if (!$id || !$fundType || !$operationType || !$amount || !$reason) {
				return $response->withJson([
					'status' => 'error',
					'message' => '請填寫完整資訊'
				]);
			}

			// 獲取點數比例
			$pointRatio = Config::where('name', 'point_ratio')->pluck('value')->first();

			// 設置交易隔離級別為 SERIALIZABLE
			DB::statement('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
			// 開始交易
			DB::beginTransaction();
			try {
				// 鎖定用戶記錄
				$agent = UserModel::lockForUpdate()->find($id);
				if (!$agent) {
					throw new \Exception('找不到該用戶');
				}

				// 鎖定上層代理記錄
				$parentAgent = null;
				if ($agent->pid > 0) {
					$parentAgent = UserModel::lockForUpdate()->find($agent->pid);
					if (!$parentAgent) {
						throw new \Exception('找不到上層代理');
					}
				}
				
				// 根據不同的fundType處理餘額
				if ($fundType == 1) { // 保證金
					$adjustAmount = $operationType === 'in' ? $amount : -$amount;
					$newMargin = $agent->margin + $adjustAmount;
					$pointAmount = $adjustAmount * $pointRatio;
					$newBalance = $agent->balance + $pointAmount;

					// 檢查本人餘額
					if ($newMargin < 0 || $newBalance < 0) {
						throw new \Exception('餘額不足');
					}

					// 處理上層代理餘額
					if ($parentAgent && $agent->role != 'topagent') {
						$newParentMargin = $parentAgent->margin - $adjustAmount;
						$newParentBalance = $parentAgent->balance - $pointAmount;
						
						// 檢查上層代理餘額
						if ($newParentMargin < 0 || $newParentBalance < 0) {
							throw new \Exception('上層代理餘額不足');
						}

						// 創建上層代理保證金流水
						$parentMarginMoney = new UserMneyModel();
						$parentMarginMoney->user_id = $parentAgent->id;
						$parentMarginMoney->username = $parentAgent->username;
						$parentMarginMoney->assets = $parentAgent->margin;
						$parentMarginMoney->money = $amount;
						$parentMarginMoney->balance = $newParentMargin;
						$parentMarginMoney->reason = sprintf("%s (保證金-下級調整) - %s", $reason, "調整至 {$agent->username}");
						$parentMarginMoney->notes = $notes;
						$parentMarginMoney->order_id = 0;
						$parentMarginMoney->withdraw_id = 0;
						$parentMarginMoney->operate_type = $operationType === 'in' ? 2 : 1; // 相反操作
						$parentMarginMoney->trans_type = 1;
						$parentMarginMoney->money_type = 1;
						$parentMarginMoney->operator = $_SESSION['username'];
						$parentMarginMoney->created_at = date('Y-m-d H:i:s');
						$parentMarginMoney->updated_at = date('Y-m-d H:i:s');
						$parentMarginMoney->status = 1;
						$parentMarginMoney->save();

						// 創建上層代理點數流水
						$parentPointMoney = new UserMneyModel();
						$parentPointMoney->user_id = $parentAgent->id;
						$parentPointMoney->username = $parentAgent->username;
						$parentPointMoney->assets = $parentAgent->balance;
						$parentPointMoney->money = abs($pointAmount);
						$parentPointMoney->balance = $newParentBalance;
						$parentPointMoney->reason = sprintf("%s (點數轉換-下級調整) - %s", $reason, "調整至 {$agent->username}");
						$parentPointMoney->notes = $notes;
						$parentPointMoney->order_id = 0;
						$parentPointMoney->withdraw_id = 0;
						$parentPointMoney->operate_type = $operationType === 'in' ? 2 : 1; // 相反操作
						$parentPointMoney->trans_type = 1;
						$parentPointMoney->money_type = 2;
						$parentPointMoney->operator = $_SESSION['username'];
						$parentPointMoney->created_at = date('Y-m-d H:i:s');
						$parentPointMoney->updated_at = date('Y-m-d H:i:s');
						$parentPointMoney->status = 1;
						$parentPointMoney->save();

						// 更新上層代理餘額
						$parentAgent->margin = $newParentMargin;
						$parentAgent->balance = $newParentBalance;
						$parentAgent->save();
					}

					// 創建保證金流水記錄
					$marginMoney = new UserMneyModel();
					$marginMoney->user_id = $agent->id;
					$marginMoney->username = $agent->username;
					$marginMoney->assets = $agent->margin;
					$marginMoney->money = $amount;
					$marginMoney->balance = $newMargin;
					$marginMoney->reason = sprintf("%s (保證金) - %s", $reason, "調整自 {$agent->username}");
					$marginMoney->notes = $notes;
					$marginMoney->order_id = 0;
					$marginMoney->withdraw_id = 0;
					$marginMoney->operate_type = $operationType === 'in' ? 1 : 2;
					$marginMoney->trans_type = 1;
					$marginMoney->money_type = 1; // 保證金
					$marginMoney->operator = $_SESSION['username'];
					$marginMoney->created_at = date('Y-m-d H:i:s');
					$marginMoney->updated_at = date('Y-m-d H:i:s');
					$marginMoney->status = 1;
					$marginMoney->save();

					// 創建點數流水記錄
					$pointMoney = new UserMneyModel();
					$pointMoney->user_id = $agent->id;
					$pointMoney->username = $agent->username;
					$pointMoney->assets = $agent->balance;
					$pointMoney->money = abs($pointAmount);
					$pointMoney->balance = $newBalance;
					$pointMoney->reason = sprintf("%s (點數轉換) - %s", $reason, "調整自 {$agent->username}");
					$pointMoney->notes = $notes;
					$pointMoney->order_id = 0;
					$pointMoney->withdraw_id = 0;
					$pointMoney->operate_type = $operationType === 'in' ? 1 : 2;
					$pointMoney->trans_type = 1;
					$pointMoney->money_type = 2; // 點數
					$pointMoney->operator = $_SESSION['username'];
					$pointMoney->created_at = date('Y-m-d H:i:s');
					$pointMoney->updated_at = date('Y-m-d H:i:s');
					$pointMoney->status = 1;
					$pointMoney->save();

					// 更新用戶餘額
					$agent->margin = $newMargin;
					$agent->balance = $newBalance;

				} else { // 點數
					$adjustAmount = $operationType === 'in' ? $amount : -$amount;
					$newBalance = $agent->balance + $adjustAmount;

					// 檢查本人餘額
					if ($newBalance < 0) {
						throw new \Exception('餘額不足');
					}

					// 處理上層代理餘額
					if ($parentAgent && $agent->role != 'topagent') {

						$newParentBalance = $parentAgent->balance - $adjustAmount;
						// throw new \Exception($newParentBalance);
						// 檢查上層代理餘額
						if ($newParentBalance < 0) {
							throw new \Exception('代理餘額不足, 無法調整');
						}

						// 創建上層代理點數流水
						$parentUserMoney = new UserMneyModel();
						$parentUserMoney->user_id = $parentAgent->id;
						$parentUserMoney->username = $parentAgent->username;
						$parentUserMoney->assets = $parentAgent->balance;
						$parentUserMoney->money = $amount;
						$parentUserMoney->balance = $newParentBalance;
						$parentUserMoney->reason = sprintf("%s (下級調整) - %s", $reason, "調整自 {$agent->username}");
						$parentUserMoney->notes = $notes;
						$parentUserMoney->order_id = 0;
						$parentUserMoney->withdraw_id = 0;
						$parentUserMoney->operate_type = $operationType === 'in' ? 2 : 1; // 相反操作
						$parentUserMoney->trans_type = 1;
						$parentUserMoney->money_type = 2;
						$parentUserMoney->operator = $_SESSION['username'];
						$parentUserMoney->created_at = date('Y-m-d H:i:s');
						$parentUserMoney->updated_at = date('Y-m-d H:i:s');
						$parentUserMoney->status = 1;
						$parentUserMoney->save();

						// 更新上層代理餘額
						$parentAgent->balance = $newParentBalance;
						$parentAgent->save();
					}

					// 創建點數流水記錄
					$userMoney = new UserMneyModel();
					$userMoney->user_id = $agent->id;
					$userMoney->username = $agent->username;
					$userMoney->assets = $agent->balance;
					$userMoney->money = $amount;
					$userMoney->balance = $newBalance;
					$userMoney->reason = sprintf("%s - %s", $reason, "調整自 {$agent->username}");
					$userMoney->notes = $notes;
					$userMoney->order_id = 0;
					$userMoney->withdraw_id = 0;
					$userMoney->operate_type = $operationType === 'in' ? 1 : 2;
					$userMoney->trans_type = 1;
					$userMoney->money_type = 2; // 點數
					$userMoney->operator = $_SESSION['username'];
					$userMoney->created_at = date('Y-m-d H:i:s');
					$userMoney->updated_at = date('Y-m-d H:i:s');
					$userMoney->status = 1;
					$userMoney->save();

					// 更新用戶餘額
					$agent->balance = $newBalance;
				}

				$agent->save();

				// 記錄用戶操作日誌
				$userLog = new UserLog();
				$logContent = ($operationType === 'in' ? '存入' : '取出') . 
							($fundType === 1 ? '保證金' : '點數') . 
							" {$amount}, 原因: {$reason}";
				if ($fundType === 1) {
					$logContent .= sprintf(", 轉換點數: %.2f", $pointAmount);
				}
				$userLog->saveLog($id, 1, '資金調度', $_SESSION['username'], $logContent);

				DB::commit();

				return $response->withJson([
					'status' => 'success',
					'message' => '操作成功',
					'data' => [
						'newBalance' => $agent->balance,
						'newMargin' => $fundType == 1 ? $agent->margin : null,
						'parentNewBalance' => $parentAgent ? $parentAgent->balance : null,
						'parentNewMargin' => $fundType == 1 && $parentAgent ? $parentAgent->margin : null
					]
				]);

			} catch (\Exception $e) {
				DB::rollBack();
				throw $e;
			}

		} catch (\Exception $e) {
			return $response->withJson([
				'status' => 'error',
				'message' => $e->getMessage()
			]);
		}
	}
}
