<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

Class User extends Model
{ 
    use SoftDeletes;
	
	public function getDates()
    {
        return [];
    }
	 
    protected $hidden = ['deleted_at', 'password'];

	public static function getRoleName($role){
		if($role == 'agent')
			return '代理';
		elseif($role == 'topagent')
			return '总代';
		elseif($role == 'admin')
			return '后台网站';
		elseif($role == 'customer')
			return '会员';
	}
    public function upper()
    {
        return $this->belongsTo('App\Models\User','pid','id');
    }
	
	public function commissionRule()
    {
        return $this->belongsTo('App\Models\CommissionRule');
    }

    public function extraCommissionRule()
    {
        return $this->hasOne('App\Models\ExtraCommissionRule');
    }

    public function retreatRule()
    {
        return $this->hasOne('App\Models\RetreatRule');
    }

    public function cusGrade()
    {
        return $this->belongsTo('App\Models\CusGrade');
    }

    public function cusMark()
    {
        return $this->belongsTo('App\Models\CusMark');
    }
	
	public function verification(){
		return $this->hasOne('App\Models\UserVerification');
	}

	public function gameUser(){
		return $this->hasMany('App\Models\GameUser');
	}

    public function games()
    {
        return $this->belongsToMany('App\Models\Game', 'user_open_games', 'user_id', 'game_id');
    }
	
	
	public function login($username, $password)
    {
        $where = array();
        $where[] = array('username', $username);
        $where[] = array('password', crypt($password, '$1$' . substr(md5($username), 5, 8)));
        return User::where($where)->first();
    }

    //取得会员的上级代理
    public static function getAgentNameOfMember($id){
		$member = User::where('id', $id)->first();
        $agent = User::where('id', $member->pid)->whereIn('role', ['agent', 'topagent'])->first();
        if (!$agent) {
            $name = '';
        } else {
            $name = $agent->username;
        }
        return $name;
	}
	
	public function permissions(){
		return $this->hasMany('App\Models\UserPermission','user_id','id');
	}
	
	
	public static function hasPermission($user,$menu_id){
		if($user == null)return false;
		return $user->permissions->where('menu_id',$menu_id)->count() > 0 ;
		 
	}

    //取得总代理的会员(不包含底下代理的会员)
    public static function getMembersOfTopAgent($id, $query=false){
        $agent = User::where('id', $id)->where('role', 'topagent')->first();
        
        $downAgents = User::where('pid', $agent->id)->where('role', 'agent')->get();

        $id_arrays = array();
        foreach ($downAgents as $item) {
            $members = User::where('parents', 'like', '%/' .$item->id . '/%')->where('role', 'customer')->pluck('id')->toArray();

            $id_arrays = array_merge($id_arrays, $members);
        }
        
        if ($query) {
            $users = User::where('parents', 'like', '%/' . $agent->id . '/%')
            ->whereNotIn('id', $id_arrays)
            ->where('role', 'customer');
        } else {
            $users = User::where('parents', 'like', '%/' . $agent->id . '/%')
            ->whereNotIn('id', $id_arrays)
            ->where('role', 'customer')
            ->get();
        }
        

        return $users;
	}

    public function resetStats(): void
    {
        $this->Cnt = 0;
        $this->totalAmount = 0;
        $this->totalValidAmount = 0;
        $this->totalWinlose = 0;
        $this->totalGameGive = 0;
        $this->totalNetAmount = 0;
        $this->total = 0;
        $this->money_in = 0;
        $this->money_out = 0;
        $this->retreat = 0;

        $this->totalRetreat = 0;
        $this->totalCustomerRetreat = 0;
        $this->totalAgentRetreat = 0;
        $this->totalAgentRetreatRule = 0;
        $this->totalTopAgentRetreat = 0;
        $this->totalTopAgentRetreatRule = 0;

        $this->totalCommission = 0;
        $this->totalAgentCommission = 0;
        $this->totalTopAgentCommission = 0;
        $this->totalCommissionRule = 0;
        $this->totalExtraCommissionRule = 0;
    }

    public function getParentChainFromBottom($gameId, $target_user_id, $report_date, &$user_retreats, &$user_extras)
    {
        $ids = collect(explode('/', trim($this->parents, '/')))
            ->filter()
            ->map(fn($id) => (int)$id)
            ->push($this->id) // ✅ 把自己加進去
            ->filter(fn($id) => $id !== 1)
            ->values();
        
        $ids = $ids->all(); 
    
        // 預載對應的遊戲規則關聯
        $users = User::select([
            'id', 'username', 'role', 'pid', 'parents', 'level'
        ])
        ->whereIn('id', $ids)
        ->get()
        ->sortBy(fn($u) => array_search($u->id, $ids)) // ✅ 根據原始 ids 順序排序（從底層往上）
        ->values(); // ✅ 重建索引，讓後續處理簡單

        foreach ($users as $user) {
            $user->retreatPercent = 0;
            $user->extraCommissionPercent = 0;

            if ($report_date) {
                $report_date_temp = $report_date;
            } else {
                $report_date_temp = 'init';
            }
            //取得退水資料 暫存起來 之後可以直接用
            if (isset($user_retreats[$user->id][$report_date_temp])) {
                $retreatRule = $user_retreats[$user->id][$report_date_temp];
            } else {
                if ($report_date == null) {
                    // 情境一：report_date 為 null
                    $retreatRule = RetreatRule::with('ruleDetailsGames')->where('user_id', $user->id)->whereNull('init_date')->first();
                } else {
                    // 情境二：report_date 不為 null → 取最大值
                    $retreatRule = RetreatRule::with('ruleDetailsGames')->where('user_id', $user->id)
                        ->where(function($query) use($report_date){
                            $query->where('init_date', '<=', $report_date)->orWhereNull('init_date');
                        })->orderBy('init_date', 'desc')->first();
                }
                $user_retreats[$user->id][$report_date_temp] = $retreatRule;
            }

            //取得佔成資料 暫存起來 之後可以直接用
            if (isset($user_extras[$user->id][$report_date_temp])) {
                $extraCommissionRule = $user_extras[$user->id][$report_date_temp];
            } else {
                if ($report_date == null) {
                    // 情境一：report_date 為 null
                    $extraCommissionRule = ExtraCommissionRule::with('ruleDetailsGames')->where('user_id', $user->id)->whereNull('init_date')->first();
                } else {
                    // 情境二：report_date 不為 null → 取最大值
                    $extraCommissionRule = ExtraCommissionRule::with('ruleDetailsGames')->where('user_id', $user->id)
                        ->where(function($query) use($report_date){
                            $query->where('init_date', '<=', $report_date)->orWhereNull('init_date');
                        })->orderBy('init_date', 'desc')->first();
                }
                $user_extras[$user->id][$report_date_temp] = $extraCommissionRule;
            }

            foreach ($retreatRule->ruleDetailsGames as $item) {
                if ($item->game_id == $gameId) {
                    $user->retreatPercent = $item->percent;
                    break;
                }
            }
            foreach ($extraCommissionRule->ruleDetailsGames as $item) {
                if ($item->game_id == $gameId) {
                    $user->extraCommissionPercent = $item->percent;
                    break;
                }
            }
        }

       
        $index = 0;
        $childExtraExceed = false;//下級佔成超過上級
        $childRetreatExceed = false;//下級退水超過上級
        foreach ($users as $key=>$user) {
            if ($user->id == $target_user_id) {
                 //$target_user_id 指定會員 只列出他與底下的會員
                $index = $key;
            }

            $parent = $users[$key]; // 父
            $child = $users[$key + 1]; // 子
            //下級高過上級 下級整個歸0
            if ($childExtraExceed) {
                $parent->extraCommissionPercent = 0;
                $child->extraCommissionPercent = 0;
                
            } else {
                if ($child->extraCommissionPercent > $parent->extraCommissionPercent) {
                    $child->extraCommissionPercent = 0;
                    $childExtraExceed = true;
                }
            }
            //下級高過上級 下級整個歸0
            if ($childRetreatExceed) {
                $parent->retreatPercent = 0;
                $child->retreatPercent = 0;
            } else {
                if ($child->retreatPercent > $parent->retreatPercent) {
                    $child->retreatPercent = 0;
                    $childRetreatExceed = true;
                }
            }
        }
        $users = $users->slice($index)->values(); // 從目標值開始保留
    
        return $users;
    }

    public function getParentChainFromBottomV2(
        int $gameId,
        int $target_user_id,
        string $report_date,
        array &$ruleCache
    ) {
        // ===== 1. chain ids =====
        $ids = collect(explode('/', trim($this->parents . '/' . $this->id, '/')))
            ->filter()
            ->map(fn($id) => (int)$id)
            ->filter(fn($id) => $id !== 1)
            ->values();
    
        if ($ids->isEmpty()) {
            return collect();
        }
    
        // ===== 2. users（0 SQL）=====
        $users = $ids
            ->map(fn($id) => $ruleCache['users'][$id] ?? null)
            ->filter()
            ->values();
    
        if ($users->isEmpty()) {
            return collect();
        }
    
        // ===== 3. 套用生效規則 =====
        foreach ($users as $user) {
            $user->retreatPercent = 0;
            $user->extraCommissionPercent = 0;
    
            // Retreat：找第一筆 init_date <= report_date
            if (!empty($ruleCache['retreat'][$user->id])) {
                $rule = $ruleCache['retreat'][$user->id]
                    ->first(fn($r) =>
                        empty($r->init_date) || $r->init_date <= $report_date
                    );
    
                if ($rule) {
                    $map = $rule->ruleDetailsGames->keyBy('game_id');
                    $user->retreatPercent = $map[$gameId]->percent ?? 0;
                }
            }
    
            // Extra：同上
            if (!empty($ruleCache['extra'][$user->id])) {
                $rule = $ruleCache['extra'][$user->id]
                    ->first(fn($r) =>
                        empty($r->init_date) || $r->init_date <= $report_date
                    );
    
                if ($rule) {
                    $map = $rule->ruleDetailsGames->keyBy('game_id');
                    $user->extraCommissionPercent = $map[$gameId]->percent ?? 0;
                }
            }
        }
    
        // ===== 4. 下級不可高於上級 =====
        $childExtraExceed = false;
        $childRetreatExceed = false;
    
        for ($i = 0; $i < $users->count() - 1; $i++) {
            $parent = $users[$i];
            $child  = $users[$i + 1];
    
            if ($childExtraExceed || $child->extraCommissionPercent > $parent->extraCommissionPercent) {
                $child->extraCommissionPercent = 0;
                $childExtraExceed = true;
            }
    
            if ($childRetreatExceed || $child->retreatPercent > $parent->retreatPercent) {
                $child->retreatPercent = 0;
                $childRetreatExceed = true;
            }
        }
    
        // ===== 5. slice =====
        $index = $users->search(fn($u) => $u->id === $target_user_id);
        if ($index !== false) {
            $users = $users->slice($index)->values();
        }
    
        return $users;
    }

    public function checkRuleNotExceedParent($commissionRuleId, $retreatRuleId, $extraCommissionRuleId)
    {
        // 如果沒有上層或上層是管理員 1，則跳過檢查
        if ($this->pid == 0 || $this->pid == 1) {
            return ['success' => true];
        }

        $parent = User::find($this->pid);
        if (!$parent) {
            return ['success' => false, 'message' => '找不到上層代理'];
        }

        // 假設你有 CommissionRule / RetreatRule / ExtraCommissionRule 三個 Model
        // 並且每個規則都對應「遊戲 ID」與「百分比」
        
        // 各個規則的遊戲明細
        if ($commissionRuleId != 0) {
            // 如果沒有上層的佣金規則，則不允許設定
            if (!$parent->commission_rule_id) {
                return ['success' => false, 'message' => "上層未設佣金規則，不可設定"];
            }

            $commissionRules = CommissionRule::find($commissionRuleId)->ruleDetailsGames()->get(); // game_id, percent
            $parentCommissionRules = CommissionRule::find($parent->commission_rule_id)->ruleDetailsGames()->get();

            // 建立查找表以利比對
            $parentCommissionMap = $parentCommissionRules->keyBy('game_id');
            foreach ($commissionRules as $rule) {
                $parentRule = $parentCommissionMap->get($rule->game_id);
                if ($parentRule && $rule->percent > $parentRule->percent) {
                    // return ['success' => false, 'message' => "佣金規則中遊戲 ID {$rule->game_id} 高於上層"];
                    return ['success' => false, 'message' => "佣金規則 高於上層"];
                }
            }
        }

        if ($retreatRuleId != 0) {
            // 如果沒有上層的退水規則，則不允許設定
            if (!$parent->retreat_rule_id) {
                return ['success' => false, 'message' => "上層未設退水規則，不可設定"];
            }

            $retreatRules = RetreatRule::find($retreatRuleId)->ruleDetailsGames()->get();
            $parentRetreatRules = RetreatRule::find($parent->retreat_rule_id)->ruleDetailsGames()->get();

            $parentRetreatMap = $parentRetreatRules->keyBy('game_id');
            foreach ($retreatRules as $rule) {
                $parentRule = $parentRetreatMap->get($rule->game_id);
                if ($parentRule && $rule->percent > $parentRule->percent) {
                    // return ['success' => false, 'message' => "退水規則中遊戲 ID {$rule->game_id} 高於上層"];
                    return ['success' => false, 'message' => "退水規則 高於上層"];
                }
            }
        }

        if ($extraCommissionRuleId != 0) {
            // 如果沒有上層的佔成規則，則不允許設定
            if (!$parent->extra_commission_rule_id) {
                return ['success' => false, 'message' => "上層未設佔成規則，不可設定"];
            }

            $extraCommissionRules = ExtraCommissionRule::find($extraCommissionRuleId)->ruleDetailsGames()->get();
            $parentExtraCommissionRules = ExtraCommissionRule::find($parent->extra_commission_rule_id)->ruleDetailsGames()->get();
           
            $parentExtraMap = $parentExtraCommissionRules->keyBy('game_id');
            foreach ($extraCommissionRules as $rule) {
                $parentRule = $parentExtraMap->get($rule->game_id);
                if ($parentRule && $rule->percent > $parentRule->percent) {
                    // return ['success' => false, 'message' => "佔成規則中遊戲 ID {$rule->game_id} 高於上層"];
                    return ['success' => false, 'message' => "佔成規則 高於上層"];
                }
            }
        }

        return ['success' => true];
    }

    public function checkRetreatRuleNotExceedParent($retreatRules)
    {
        //retreatRules: ['game_id' => percent]
        // 如果沒有上層或上層是管理員 1，則跳過檢查
        if ($this->pid == 0 || $this->pid == 1) {
            return ['success' => true];
        }

        $parent = User::find($this->pid);
        if (!$parent) {
            return ['success' => false, 'message' => '找不到上層代理'];
        }

        // 如果沒有上層的退水規則，則不允許設定
        if (!RetreatRule::where('user_id', $parent->id)->first()) {
            return ['success' => false, 'message' => "上層未設退水規則，不可設定"];
        }

        $parentRetreatRules = RetreatRule::where('user_id', $parent->id)->orderBy('init_date', 'desc')->first()->ruleDetailsGames()->get();

        $parentRetreatMap = $parentRetreatRules->keyBy('game_id');
        foreach ($retreatRules as $game_id =>$percent) {
            $parentRule = $parentRetreatMap->get($game_id);
            if ($parentRule && $percent > $parentRule->percent) {
                return ['success' => false, 'message' => "退水規則 高於上層"];
            } elseif (!$parentRule && $percent > 0) {
                return ['success' => false, 'message' => "退水規則 高於上層"];
            }
        }


        return ['success' => true];
    }

    public function checkExtraCommissionRuleNotExceedParent($extraCommissionRules)
    {
        //extraCommissionRules: ['game_id' => percent]
        // 如果沒有上層或上層是管理員 1，則跳過檢查
        if ($this->pid == 0 || $this->pid == 1) {
            return ['success' => true];
        }

        $parent = User::find($this->pid);
        if (!$parent) {
            return ['success' => false, 'message' => '找不到上層代理'];
        }

        // 如果沒有上層的退水規則，則不允許設定
        if (!ExtraCommissionRule::where('user_id', $parent->id)->first()) {
            return ['success' => false, 'message' => "上層未設佔成規則，不可設定"];
        }

        $parentExtraCommissionRules = ExtraCommissionRule::where('user_id', $parent->id)->orderBy('init_date', 'desc')->first()->ruleDetailsGames()->get();

        $parentExtraCommissionMap = $parentExtraCommissionRules->keyBy('game_id');
        foreach ($extraCommissionRules as $game_id =>$percent) {
            $parentRule = $parentExtraCommissionMap->get($game_id);
            if ($parentRule && $percent > $parentRule->percent) {
                return ['success' => false, 'message' => "佔成規則 高於上層"];
            } elseif (!$parentRule && $percent > 0) {
                return ['success' => false, 'message' => "佔成規則 高於上層"];
            }
        }


        return ['success' => true];
    }
}
