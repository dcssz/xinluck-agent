
<!DOCTYPE html><!--[if IE 8]> 
<html lang="en" class="ie8 no-js"> <![endif]--><!--[if IE 9]> 
<html lang="en" class="ie9 no-js"> <![endif]--><!--[if !IE]><!-->
<html lang="en" class="no-js">	<!--<![endif]-->	<!-- BEGIN HEAD -->	
<head>        
    <meta charset="utf-8"/>        
    <meta http-equiv="X-UA-Compatible" content="IE=edge">       
     <!--<meta content="width=device-width, initial-scale=1" name="viewport"/>-->        
     <meta content="" name="description"/>        
     <meta content="" name="keywords"/>        
     <meta content="" name="author"/>        
     <title>控端</title>        
     <!-- BEGIN PAGE TOP STYLES -->        
     <!-- END PAGE TOP STYLES -->        
     <!-- BEGIN GLOBAL MANDATORY STYLES -->        
     <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />        
     <link href="/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />        
     <link href="/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />        
     <link href="/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />        
     <link href="/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />        
     <link href="/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />        <!-- END GLOBAL MANDATORY STYLES -->        <!-- BEGIN PAGE LEVEL PLUGINS -->        
     <link href="/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />        
     <link href="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />        
     <link href="/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />        
     <link href="/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />        <!-- END PAGE LEVEL PLUGINS -->        <!-- BEGIN THEME GLOBAL STYLES -->        
     <link href="/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />        
     <link href="/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />        <!-- END THEME GLOBAL STYLES -->        <!-- BEGIN THEME LAYOUT STYLES -->        
     <link href="/assets/layouts/layout/css/self-layout.css" rel="stylesheet" type="text/css" />        
     <link href="/assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />        
     <link href="/assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />        <!-- END THEME LAYOUT STYLES -->        
     <link href="/templates/css/style.css?cache=210" rel="stylesheet" type="text/css"/>		
     <link href="/templates/css/tw_style.css?cache=205" rel="stylesheet" type="text/css"/>                <!-- BEGIN PAGE FIRST SCRIPTS -->        
     <script src="/assets/global/plugins/jquery.min.js" type="text/javascript"></script>        <!-- END PAGE FIRST SCRIPTS -->        
     <link rel="shortcut icon" href="#"/>	
    </head>	<!-- END HEAD -->	
    <body>       
        <div class="page-inner-content">
	<!--slot=0-->
<style>
.page-bar .act-group{
	/*float:left;*/
	margin-right:10px;
}
	
.portlet.light.bordered 
{
	margin-top:0px;
}
.portlet-body 
{
	padding-top:0px !important;
	display: block;
} 
#manager_table_wrapper > div:first-child{
	display:none;
}
th
{
	text-align: center;
}
#manager_table td{
	vertical-align: middle;
}
	
#page-content-mask{
	background-color: #CCC;
    position: fixed;
    width: 100%;
    height: 100%;
    opacity: 0.5;
	display: none;
}
	/***/
.ml-10{
	margin-left:10px !important;
}
.ml-20{
	margin-left:20px !important;
}
.mt-10{
	margin-top:10px;
}
.mt-20{
	margin-top:20px;
}
label{
	margin-bottom:0px;
}
.bg-color1{
	background-color:#c3e6fa;
}
.bg-color2{
	background-color:#9dddde;
}
.txt-color1{
	color:red;
}
.game_before {
    background: rgba(180, 230, 200, 0.5);
}
.game_now {
    background: #fce6d8;
}
/*.type-btn-div{
	border-top: 2px solid #cecece;
    margin-top: 8px;
    padding-top: 8px;
}*/
.type-btn1{
	color: #222;
    background-color: #fff;
    /*border-color: #dab10d;*/
	display: inline-block;
    margin-bottom: 0;
    font-weight: 400;
    text-align: center;
    touch-action: manipulation;
    cursor: pointer;
    border: 1px solid transparent;
    white-space: nowrap;
    padding: 0px 12px;
    font-size: 14px;
	line-height: 30px;
	border: 2px solid #F1C40F;
}
.type-btn1.active{
	color: #fff;
    background-color: #F1C40F;
}
.data-content{
	padding-top:10px;
}
.data-content .top-area{
	padding: 8px 0px 8px 12px;
    background-color: #fce4e6;
}
.basic-info-tb td{
	vertical-align:middle!important;
}
.basic-info-tb td.title{
	text-align:right;
	font-weight:bold;
	white-space:nowrap;
}
.gstore100-cus2opt-tb td{
	padding:10px;
}
.gstore100-cus2opt-tb td.title1{
	font-weight:bold;
	padding:5px 10px;
	
}
.gstore100-cus2opt-tb td.title2{
	background-color: #c3e6fa;
	font-weight:bold;
	text-align:right;
}
.gstore100-cus2opt-tb .ocpy-div-1{
	float:left;
}
.gstore100-cus2opt-tb .ocpy-div-2{
	float:left;
	margin-left:7px;
	position:relative;
	top:22px;
}
.gstore100-cus2opt-tb .ocpy-div-3{
	float:left;
	margin-left:11px;
}
.temp-waiting{
	top: 200px; 
	width: 300px;
}
.tabbable-line>.nav-tabs {
    padding: 8px 5px;
    border-radius: 27px !important;
    background-color: #f4fcfd;
    border: 3px solid #bcecf1;
}
.tabbable-line>.nav-tabs>li.active, .tabbable-line>.nav-tabs>li:hover {
    border-radius: 22px !important;
    background-color: #28adb9;
    border-bottom: 0;
}
.tabbable-line>.nav-tabs>li>a {
    color: #000;
    font-size: 16px;
    font-weight: bold;
}
.tabbable-line>.nav-tabs>li.active>a, .tabbable-line>.nav-tabs>li:hover>a {
    color: #FFF;
}
.tabbable-line>.tab-content {
    border-top: 0;
}
.error-span{
	background-color: #fbe1e3;
    border-color: #fbe1e3;
    color: #e73d4a;
}
.top-max-span{
    border-color: rgba(249, 228, 145, 0.5)!important;
    background-color: rgba(249, 228, 145, 0.5)!important;
    color: #6d5806!important;
}
.tab-content{
	padding:10px 0px!important;
}
	
.font-b{
	font-weight:bold;
}
#game-status-table{
}
#game-status-table td, .game-occupy-table td{
	padding: 10px;
	border: 1px solid #000;
}
#game-status-table td:nth-child(1){
	background-color: #c3e6fa;
	font-weight: bold;
}
.tool{
	float: right;
    display: inline-block;
	padding:14px;
}
.tool > a.expand{
	background-image :url(/assets/global/img/portlet-expand-icon.png);
}
.tool > a.collapse{
	background-image :url(/assets/global/img/portlet-collapse-icon.png);
}
.tool > a {
	width:14px;
    display: inline-block;
    height: 16px;
}
.portlet-title .caption{
	display: inline-block;
}
.info_log .add{
	color: green;
}
.info_log .minus{
	color: red;
}
.info_log .td-r{
	text-align: right;
}

.retreat-setting-table{
	width: 100%;
}
.retreat-setting-table th{
	background-color: #39a8a9;
	color: #FFF;
}
.retreat-setting-table th, .retreat-setting-table td{
	border: 1px solid #ccc;
	text-align: center;
	padding: 10px 0px;
  width: 33%;
}
.retreat-setting-table .notice-txt{
	color: red;
}
</style>
<div class="page-bar">
	<div class="act-group" id="top-save-btn-area">
		<button class="btn btn-danger" type="button" onclick="save_customer('basic-info')">儲存基本資料</button>
    </div>
    <div class="act-group">
		<button class="btn green-sharp btn-large " onclick="parent.goIframeHistoryBack(this, event);"> <i class="fa fa-mail-reply"></i> <font class="">回上頁</font> </button>
    </div>
    <div>
    	<div class="type-btn-div">
        	<span class="hidden">總代理&nbsp;帳號:&nbsp;&nbsp;&nbsp;</span>
            <button class="type-btn1  <?=$btn_type=='basic-info-area'?'active':''?>" type="button" onClick="show_data_content(this, 'basic-info-area');">詳細資料</button>
            <!--button class="type-btn1 <?= $etype == 'add' ? 'hidden': ''?>" type="button" onclick="show_data_content(this, 'bank-info-area');">銀行信息</button-->
            <button class="type-btn1 <?= $etype == 'add' ? 'hidden': ''?>" type="button" onClick="show_data_content(this, 'open-game-info-area');">開放遊戲設定</button>
            <button class="type-btn1 <?=$btn_type=='retreat-info-area'?'active':''?> <?= $etype == 'add' ? 'hidden': ''?> " type="button" onClick="show_data_content(this, 'retreat-info-area');">退水佔成設定</button>
            <!--button class="type-btn1 <?= $etype == 'add' ? 'hidden': ''?> " type="button" onclick="show_data_content(this, 'gstore-group1-area');">體育設定</button>
            <button class="type-btn1 <?= $etype == 'add' ? 'hidden': ''?> " type="button" onclick="show_data_content(this, 'gstore-group2-area');">彩票設定</button>
            <button class="type-btn1 <?= $etype == 'add' ? 'hidden': ''?> " type="button" onclick="show_data_content(this, 'gstore-group3-area');">真人設定</button>
            <button class="type-btn1 <?= $etype == 'add' ? 'hidden': ''?> " type="button" onclick="show_data_content(this, 'gstore-group4-area');">電子設定</button>
            <button class="type-btn1 <?= $etype == 'add' ? 'hidden': ''?> " type="button" onclick="show_data_content(this, 'gstore-group6-area');">電競設定</button-->
        </div>
    </div>                  
</div>
<div id="page-content-mask"><img class="temp-waiting" src="/templates/images/loading.svg"></div>
<div id="basic-info-area" class="data-content  <?=$btn_type=='basic-info-area'?'':'hidden'?>">
    <!--slot=1-->
<div class="hidden save-btn"><button class="btn btn-danger" type="button" onclick="save_customer('basic-info')"><?= $etype == 'add' ? '下一步': '儲存基本資料'?></button></div>
<form>
    <div class="portlet light bordered">
      <div class="portlet-body" >
        <!--slot=2-->
<table class="table table-bordered basic-info-tb">
  <tbody>
    <?php if ($edit_level==15 && $etype == 'add') {?>
      <tr>
        <td class="title">上级</td>
        <td>
          <div class="">
          <select id="top_agent_id" name="top_agent_id" class="form-control input-inline" >
              <!--slot=3-->
              <?php foreach ($top_agents as $item) {?>
              <option value="<?=$item->id?>" <?= $item->id == $top_cus_id ? 'selected': ''?>><?php echo $item->username . '('.$item->nickname.')'?></option>
              <?php } ?>

          </select>
          </div>
        </td>
      </tr>
    <?php } ?>
    <tr>             
      <td class="title"><?= $edit_level==15 ?'代理':'總代理'?>&nbsp;帳號</td>
      <td ><input name="customer_userid" type="text" value="<?=e($agent->username)?>" size="12" <?= $etype == 'edit' ? 'disabled': ''?>></td>
    </tr>
    <tr>
      <td class="title"><?= $edit_level==15 ?'代理':'總代理'?>&nbsp;密碼</td>
      <td><input type="password" size="12" name="customer_pass1" id="customer_pass1" value=""></td>
    </tr>
    <tr>
      <td class="title">確認密碼</td>
      <td><input type="password" size="12" name ="customer_pass2" id="customer_pass2" value=""></td>
    </tr>
    <tr>
      <td class="title"><?= $edit_level==15 ?'代理':'總代理'?>&nbsp;名稱</td>
      <td><input type="text" size="12" name ="customer_name" value="<?=e($agent->nickname)?>"></td>
    </tr>
    <?php if ($edit_level==15) {?>
      <!--tr>
        <td class="title">真人限紅組</td>
        <td>
          <input type="checkbox" id="checkAll"> 全選
          <div>
            <?php foreach ($userGroups as $item) { ?>
              <label class="checkbox-inline">
                <input class="user_group_id" type="checkbox" name="user_group_id[]" value="<?= $item->id ?>"
                  <?= in_array($item->id, $agent->user_group_id ?? []) ? 'checked' : '' ?>>
                <?= $item->content ?>
              </label>
            <?php } ?>
          </div>
        </td>
      </tr-->
    <?php } ?>
    <tr>             
      <td class="title">代理限制會員人數上限</td>
      <td >
        <input name="memberCount" type="text" value="<?=e($agent->memberCount)?>" size="12" >
        <font class="color-red1">(填0為不限制)</font>
      </td>
    </tr>
	<tr>
      <td class="title">狀態設定</td>
      <td>
        <div class="">
        <select name="customer_status" class="form-control input-inline" >
            <!--slot=3-->

            <option value="1" <?= $agent->valid == 1 ? 'selected': ''?>>啟用</option>

            <option value="2" <?= $agent->valid == 2 ? 'selected': ''?>>停押</option>

            <option value="3" <?= $agent->valid == 3 ? 'selected': ''?>>鎖定</option>

            <option value="4" <?= $agent->valid == 4 ? 'selected': ''?>>停用</option>


        </select>&nbsp;<font class="color-red1">[停押]: 全線停押，但可登入&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[停用]: 全線停用，且不可登入&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[鎖定]: 只鎖定該帳號不可登入，其他下線正常</font>
        </div>
        <div class="hidden"><input type="hidden" name="" value=""></div>
      </td>
    </tr>
    
	<tr class="hidden  ">
      <td class="title">帳號類型</td>
      <td>
		<label>
			<input type="radio" name="customer_type" value="1" onChange="change_customer_type();" checked> 退佣
		</label>
		<label class="ml-10">
			<input type="radio" name="customer_type" value="2" onChange="change_customer_type();" > 佔成
		</label>	
	  </td>
    </tr>
    <!--tr>
      <td class="title">代理端權限</td>
      <td>
		<label>
			<input type="radio" name="has_control_perm" value="1"  <?= $agent->has_control_perm == 1 ? 'checked': ''?>> 可控制
		</label>
		<label class="ml-10">
			<input type="radio" name="has_control_perm" value="0" <?= $agent->has_control_perm == 0 ? 'checked': ''?>> 無權限
		</label>	
	  </td>
    </tr-->
	
    <!--tr>
      <td class="title">金流手續費</td>
      <td>
        <input type="text" size="2" id ="fee-percent" name ="fee_percent" value="<?=e($agent->fee_percent)?>" onkeyup="check_error(this.id,this.value)">%
        <input type="hidden" id="fee-percent-max-value" value="100">
        <span class="error-span" id="fee-percent-error"></span>
		<span class="top-max-span" id="fee-percent-max-txt">≤100</span>
      </td>
    </tr-->
    <tr class="<?= $etype == 'add' ? 'hidden': ''?>">
      <td class="title">邀請碼</td>
      <td><input type="text" size="12" name ="invite_code" value="<?=e($agent->invite_code)?>" disabled="disabled"></td>
    </tr>
    <tr>
      <td class="title">備註</td>
      <td><textarea name="notes" cols="80"><?=e($agent->note)?></textarea></td>
    </tr>
    <tr class="<?= $etype == 'add' ? 'hidden': ''?>">
      <td class="title">建立/修改時間</td>
      <td>建立: <?=e($agent->created_at)?><br> 修改: <?=e($agent->updated_at)?></td>
    </tr>
    <tr class="<?= $etype == 'add' ? 'hidden': ''?>">
      <td class="title">最後登入</td>
      <?php if ($agent->lgtime == 0) { ?>
        <td>尚未登入</td>
      <?php } else { ?>
        <td>時間: <?= date('Y-m-d H:i:s', $agent->lgtime)?><br>IP: <?= $agent->lgip?></td>
      <?php } ?>
    </tr>
  </tbody>
</table>

      </div>
    </div>
</form>    

</div>
<div id="bank-info-area" class="data-content">
    <div class="no-data"></div>
</div>
<div id="open-game-info-area" class="data-content hidden">
    <!--slot=3-->
    <div class="hidden save-btn"><button class="btn btn-danger" type="button" onclick="save_customer('open-game-info')">儲存開放遊戲設定</button></div>
    <form>
        <div class="portlet light bordered">
            <div class="portlet-body">
                <!--slot=8-->
                <!-- for occupy&game_status -->
                <div class="portlet-title has_set_tool" style="background-color: rgba(241, 211, 15, 0.3); cursor: pointer;">
                    <div class="caption" style="padding: 14px;">
                        <i class="fa fa-cogs font-green-sharp"></i> <span class="caption-subject font-green-sharp bold uppercase" style="font-size: 16px;">開放遊戲&nbsp;<font class="txt-color1"></font></span>
                    </div>
                    <div class="tool"><a class="collapse" id="sport-title-expand"></a></div>
                </div>
                <div class="tabbable-line mt-20" style="">
                    <div class="tab-content">
                        <table id="game-status-table">
                            <tbody>
                              <?php foreach ($GameStoreTypes as $type) {?>
                                <tr>
                                <td><?= $type->name ?></td>
                                <td>
                                    <input type="checkbox" class="status-ckbox-all" spot="<?= $type->id ?>" />
                                    全部
                                    <?php foreach ($type->games as $game) {?>
                                      <input type="checkbox" class="status-ckbox" name="game_status_arr[]" value="<?= $game->id ?>" spot="<?= $type->id ?>" <?= in_array($game->id, $user_open_game_ids) ? 'checked=""' : '' ?> />
                                      <?= $game->name ?>
                                    <?php } ?>
                                </td>
                                </tr>
                              <?php } ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                <br />
            </div>
        </div>
    </form>
</div>
<div id="opt-occupy-info-area" class="data-content hidden">
    <div id="no-data"></div>
</div>
<div id="retreat-info-area" class="data-content  <?=$btn_type=='retreat-info-area'?'':'hidden'?>">
  <div class="hidden save-btn"><button class="btn btn-danger" type="button" onclick="save_customer('retreat-info')">儲存退水佔成設定</button></div>
  <form>
    <table class="retreat-setting-table">
         <tr>
					<th>遊戲廠商</th>
					<th>退水設定(%)</th>
					<th>佔成設定(%)</th>
				</tr>
        <tr>
					<td></td>
					<td>
            真人退水:<input type="input" id="live_quick" name="live_quick"  style="width: 15%;">
            <br>
            <br>
            電子退水:<input type="input" id="slot_quick" name="slot_quick"  style="width: 15%;">
          </td>
					<td>
            真人佔成:<input type="input" id="live_extra_quick" name="live_extra_quick"  style="width: 15%;">
            <br>
            <br>
            電子佔成::<input type="input" id="slot_extra_quick" name="slot_extra_quick"  style="width: 15%;">
          </td>
				</tr>
      <?php foreach ($GameStoreTypes as $type) {?>
        <?php foreach ($type->games as $game) {?>
          <tr>
            <td><?= $game->name ?></td>
            <td>
              <input type="input" max="<?= $parentRetreatRuleArray[$game->id]['percent'] ?>" <?= $type->type=='slot' ?'class="slot"':'' ?> <?= $type->type=='live' ?'class="live"':'' ?> name="retreat_game_arr[<?= $game->id ?>]" value="<?= $retreatRuleArray[$game->id]['percent'] ?>" style="width: 30%;">
              (最大值:<?= $parentRetreatRuleArray[$game->id]['percent'] ?>)
            </td>
            <td>
              <input type="input" max="<?= $parentExtraCommissionRuleArray[$game->id]['percent'] ?>" <?= $type->type=='slot' ?'class="slot_extra"':'' ?> <?= $type->type=='live' ?'class="live_extra"':'' ?> name="extra_commission_game_arr[<?= $game->id ?>]" value="<?= $extraCommissionRuleArray[$game->id]['percent'] ?>" style="width: 30%;">
              (最大值:<?= $parentExtraCommissionRuleArray[$game->id]['percent'] ?>)
            </td>
          </tr>   
        <?php } ?>
      <?php } ?>
      
    </table>
  </form>
</div>
<div id="gstore-group1-area" class="data-content hidden">
    <div id="no-data"></div>
</div>
<div id="gstore-group2-area" class="data-content hidden">
    <div id="no-data"></div>
</div>
<div id="gstore-group3-area" class="data-content hidden">
    <div id="no-data"></div>
</div>
<div id="gstore-group4-area" class="data-content hidden">
    <div id="no-data"></div>
</div>
<div id="gstore-group6-area" class="data-content hidden">
    <div id="no-data"></div>
</div>
<input type="hidden" value="<?=e($etype)?>" id="etype">
<input type="hidden" value="<?=e($agent->id)?>" id="edit-cus-id">
<input type="hidden" id="edit-cus-level" name="edit_cus_level" value="<?=e($edit_level)?>">
<input type="hidden" value="3" id="edit-station-code">
<input type="hidden" value="<?=$top_cus_id?>" id="top-cus-id">

</div>
        <!--[if lt IE 9]>
<script src="/assets/global/plugins/respond.min.js"></script>
<script src="/assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <!--script src="/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script-->
        <script src="/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="/assets/global/scripts/datatable.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="/assets/global/scripts/self-app.js?c=1" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="/assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
        <script src="/assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
        <script src="/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
        <script src="/layer/layer.js"></script>
        <script src="/templates/js/kang_ajax.js?cache=102"></script>
		<script src="/templates/js/kang_common.js?cache=109"></script>
		<script src="/templates/js/kang_all.js?cache=203"></script>
		<script src="/templates/js/lang/tw.js?cache=203"></script>
        <script src="/templates/js/bank.js" type="text/javascript"></script>
      <script src="/templates/js/agent_info/editor.js?cache=147" type="text/javascript"></script>
      <script>
          $(function(){
            
            $('#live_quick').on('input', function() {
              let newValue = $(this).val();
              $('.live').each(function() {
                let max = $(this).attr('max');   // 讀取每個輸入框的 max 屬性
                let val = newValue;
                if (max !== '-' && Number(val) > Number(max)) {
                  val = max; // 超過最大值就改成最大值
                }
                $(this).val(val);
              });
            });
            $('#slot_quick').on('input', function() {
              let newValue = $(this).val();
              $('.slot').each(function() {
                let max = $(this).attr('max');   // 讀取每個輸入框的 max 屬性
                let val = newValue;
                if (max !== '-' && Number(val) > Number(max)) {
                  val = max; // 超過最大值就改成最大值
                }
                $(this).val(val);
              });
            });
            $('#live_extra_quick').on('input', function() {
              let newValue = $(this).val();
              $('.live_extra').each(function() {
                let max = $(this).attr('max');   // 讀取每個輸入框的 max 屬性
                let val = newValue;
                if (max !== '-' && Number(val) > Number(max)) {
                  val = max; // 超過最大值就改成最大值
                }
                $(this).val(val);
              });
            });
            $('#slot_extra_quick').on('input', function() {
              let newValue = $(this).val();
              $('.slot_extra').each(function() {
                let max = $(this).attr('max');   // 讀取每個輸入框的 max 屬性
                let val = newValue;
                if (max !== '-' && Number(val) > Number(max)) {
                  val = max; // 超過最大值就改成最大值
                }
                $(this).val(val);
              });
            });
            //改變上方儲存按鈕
            change_save_btn_area('<?=$btn_type?>');

            // 點擊「全選」時，勾選或取消所有子項目
            $('#checkAll').on('change', function() {
              console.log($(this).prop('checked'))
              $('.user_group_id').prop('checked', $(this).prop('checked'));
            });
          });
      </script>
    </body>
</html>