
<!DOCTYPE html><!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]--><!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]--><!--[if !IE]><!-->
<html lang="en" class="no-js">	<!--<![endif]-->	<!-- BEGIN HEAD -->	
<head>        
<meta charset="utf-8"/>        
<meta http-equiv="X-UA-Compatible" content="IE=edge">        
<!--<meta content="width=device-width, initial-scale=1" name="viewport"/>-->        
<meta content="" name="description"/>        
<meta content="" name="keywords"/>        
<meta content="" name="author"/>        
<title>控端</title>        <!-- BEGIN PAGE TOP STYLES -->        <!-- END PAGE TOP STYLES -->        <!-- BEGIN GLOBAL MANDATORY STYLES -->        
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />        
<link href="/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />        
<link href="/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />        
<link href="/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />        
<link href="/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />        
<link href="/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />        
<!-- END GLOBAL MANDATORY STYLES -->        <!-- BEGIN PAGE LEVEL PLUGINS -->        
<link href="/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />        
<link href="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />        
<link href="/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />        
<link href="/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />        
<!-- END PAGE LEVEL PLUGINS -->        <!-- BEGIN THEME GLOBAL STYLES -->        
<link href="/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />        
<link href="/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />        <!-- END THEME GLOBAL STYLES -->        <!-- BEGIN THEME LAYOUT STYLES -->        
<link href="/assets/layouts/layout/css/self-layout.css" rel="stylesheet" type="text/css" />        
<link href="/assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />        
<link href="/assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />        <!-- END THEME LAYOUT STYLES -->        
<link href="/templates/css/style.css?cache=209" rel="stylesheet" type="text/css"/>		
<link href="/templates/css/tw_style.css?cache=205" rel="stylesheet" type="text/css"/>                <!-- BEGIN PAGE FIRST SCRIPTS -->        
<script src="/assets/global/plugins/jquery.min.js" type="text/javascript"></script>        <!-- END PAGE FIRST SCRIPTS -->        
<link rel="shortcut icon" href="#"/>	
</head>	<!-- END HEAD -->	
<body>       
<div class="page-inner-content">
	<!--slot=0-->
<style>
.page-bar .act-group {
    margin-right: 10px;
}
	
.portlet.light.bordered {
	margin-top:0px;
}
.portlet-body {
	padding-top:0px !important;
	display: block;
} 	
.setting-tb{
	margin-top:15px;
	min-width: 20%;
}
.setting-tb td{
	padding:10px;
	border: 1px solid #999;
	text-align: center
}
.setting-tb td.title{
	font-weight:bold;
	font-size:16px;
	vertical-align:top;
}
.setting-tb .employee-userid, .setting-tb .employee-pass, .setting-tb .employee-name{
	width:250px;
}
	
.fl-l{
	float: left;
}
.ml-10{
	margin-left: 10px;
}
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
	margin-right: 5px;
}
.type-btn1.active{
	color: #fff;
    background-color: #F1C40F;
}
	
</style>
<div class="page-bar">
	<div class="act-group">
		<button class="btn btn-danger" type="button" onclick="save_employee()">確定儲存</button>
    </div>
    <div class="act-group">
		<button class="btn green-sharp btn-large" type="button" onclick="location.href='/admin/employee_manager'">回上頁</button>
    </div>
</div>
<form id="save-employee-form">
	<div class="portlet light bordered">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-group font-green-sharp"></i>
				<span class="caption-subject font-green-sharp bold uppercase">基本資料 </span>
			</div>
		</div>
		<div class="portlet-body">
			<table class="setting-tb">
				<tr>
					<td class="title">帳號</td>
					<td><input type="text" name="employee_userid" class="employee-userid" value="<?=$user->username?>"></td>
				</tr>
				<tr>
					<td class="title">密碼</td>
					<td><input type="password" name="employee_pass" class="employee-pass" value=""></td>
				</tr>
				<tr>
					<td class="title">名稱</td>
					<td><input type="text" name="employee_name" class="employee-name" value="<?=$user->nickname?>"></td>
				</tr>
				<tr>
					<td class="title">狀態</td>
					<td>
						<select name="employee_status">
							<!--slot=1-->

	<option  value="1" <?php if($user->valid==1) echo 'selected'?> > 啟用</option>

	<option  value="2" <?php if($user->valid==2) echo 'selected'?>  > 鎖定</option>


						</select>
					</td>
				</tr>
			</table>	
		</div>
	</div>
	<div class="portlet light bordered">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-group font-green-sharp"></i>
				<span class="caption-subject font-green-sharp bold uppercase">權限設定 </span>
			</div>
		</div>
		<div class="portlet-body">
			<div class="type-btn-div">
				<button class="type-btn1 active" type="button" onclick="show_menu_div(this, '0');">全部</button>
				<?php
					foreach($menus as $menu){
						if($menu->pid > 0 || $menu->id == 1) continue;
						$title = '';
						if($menu->locales && $menu->locales->count() > 0)
							$title = $menu->locales[0]->title;
				?>
				<button class="type-btn1" type="button" onclick="show_menu_div(this, <?=$menu->id?>);"><?=$title?></button>
				<?php } ?>
				<!--button class="type-btn1" type="button" onclick="show_menu_div(this, 1);">前台設定</button>
				<button class="type-btn1" type="button" onclick="show_menu_div(this, 2);">會員管理</button>
				<button class="type-btn1" type="button" onclick="show_menu_div(this, 3);">代理管理</button>
				<button class="type-btn1" type="button" onclick="show_menu_div(this, 4);">遊戲管理</button>
				<button class="type-btn1" type="button" onclick="show_menu_div(this, 5);">金流設定</button>
				<button class="type-btn1" type="button" onclick="show_menu_div(this, 6);">金流管理</button>
				<button class="type-btn1" type="button" onclick="show_menu_div(this, 7);">優惠管理</button>
				<button class="type-btn1" type="button" onclick="show_menu_div(this, 8);">報表管理</button>
				<button class="type-btn1" type="button" onclick="show_menu_div(this, 10);">系統管理</button-->
			</div>
			<!--slot=3-->

<?php
foreach($menus as $menu){
	if($menu->pid > 0 || $menu->id == 1|| $menu->id == 1000) continue;
	$title = '';
	
	if($menu->locales && $menu->locales->count() > 0)
		$title = $menu->locales[0]->title;
?>
<div class="show-menu-div" spot="<?=$menu->id?>">
	<table class="setting-tb">
		<tr class="bg-green1 color-white">
			<td class="title"><?=$title?></td>
		</tr>
		<tr><td><input type="checkbox" class="item-ckbox-all" name="menu_perm[]" value="<?=$menu->id?>" spot="<?=$menu->id?>">全選</td></tr>
		<?php
			
			foreach($menus as $child){
				if($child->pid != $menu->id) continue;
				$child_title = '';
				if($child->locales && $child->locales->count() > 0)
					$child_title = $child->locales[0]->title;
				
				$check =  App\Models\User::hasPermission($user,$menu->id)?'checked':'';
		?>
		<tr><td><input type="checkbox" class="item-ckbox" name="menu_perm[]" value="<?=$child->id?>" spot="<?=$menu->id?>" <?=$check?>><?=$child_title?></td></tr>
		<?php } ?>
		 
	</table>
</div>
<?php } ?>

<!--div class="show-menu-div" spot="1">
	<table class="setting-tb">
		<tr class="bg-green1 color-white">
			<td class="title">前台設定</td>
		</tr>
		<tr><td><input type="checkbox" class="item-ckbox-all" spot="1">全選</td></tr>
		<tr><td><input type="checkbox" class="item-ckbox" name="menu_perm[]" value="2" spot="1" checked>公告管理</td></tr>
		<tr><td><input type="checkbox" class="item-ckbox" name="menu_perm[]" value="3" spot="1" checked>跑馬燈管理</td></tr>
		<tr><td><input type="checkbox" class="item-ckbox" name="menu_perm[]" value="4" spot="1" checked>站內信管理</td></tr>
		<tr><td><input type="checkbox" class="item-ckbox" name="menu_perm[]" value="5" spot="1" checked>輪播圖管理</td></tr>
		<tr><td><input type="checkbox" class="item-ckbox" name="menu_perm[]" value="6" spot="1" checked>註冊管理</td></tr>
		<tr><td><input type="checkbox" class="item-ckbox" name="menu_perm[]" value="53" spot="1" checked>客服設定</td></tr>
	</table>
</div>

<div class="show-menu-div" spot="2">
	<table class="setting-tb">
		<tr class="bg-green1 color-white">
			<td class="title">會員管理</td>
		</tr>
		<tr><td><input type="checkbox" class="item-ckbox-all" spot="2">全選</td></tr><tr><td><input type="checkbox" class="item-ckbox" name="menu_perm[]" value="7" spot="2" checked>會員設定</td></tr><tr><td><input type="checkbox" class="item-ckbox" name="menu_perm[]" value="51" spot="2" checked>會員銀行卡審核</td></tr><tr><td><input type="checkbox" class="item-ckbox" name="menu_perm[]" value="8" spot="2" checked>等級設定</td></tr><tr><td><input type="checkbox" class="item-ckbox" name="menu_perm[]" value="9" spot="2" checked>標籤設定</td></tr><tr><td><input type="checkbox" class="item-ckbox" name="menu_perm[]" value="10" spot="2" checked>資金調度</td></tr><tr><td><input type="checkbox" class="item-ckbox" name="menu_perm[]" value="11" spot="2" checked>在線會員查詢</td></tr><tr><td><input type="checkbox" class="item-ckbox" name="menu_perm[]" value="55" spot="2" checked>會員移桶</td></tr>
	</table>
</div>

<div class="show-menu-div" spot="3">
	<table class="setting-tb">
		<tr class="bg-green1 color-white">
			<td class="title">代理管理</td>
		</tr>
		<tr><td><input type="checkbox" class="item-ckbox-all" spot="3">全選</td></tr><tr><td><input type="checkbox" class="item-ckbox" name="menu_perm[]" value="12" spot="3" checked>總代理、代理設定</td></tr><tr><td><input type="checkbox" class="item-ckbox" name="menu_perm[]" value="13" spot="3" checked>有效會員規則設定</td></tr><tr><td><input type="checkbox" class="item-ckbox" name="menu_perm[]" value="14" spot="3" checked>佣金規則設定</td></tr><tr><td><input type="checkbox" class="item-ckbox" name="menu_perm[]" value="15" spot="3" checked>退水規則設定</td></tr><tr><td><input type="checkbox" class="item-ckbox" name="menu_perm[]" value="16" spot="3" checked>總輸贏規則設定</td></tr><tr><td><input type="checkbox" class="item-ckbox" name="menu_perm[]" value="17" spot="3" checked>期數設定</td></tr><tr><td><input type="checkbox" class="item-ckbox" name="menu_perm[]" value="18" spot="3" checked>期數審核</td></tr>
	</table>
</div>

<div class="show-menu-div" spot="4">
	<table class="setting-tb">
		<tr class="bg-green1 color-white">
			<td class="title">遊戲管理</td>
		</tr>
		<tr><td><input type="checkbox" class="item-ckbox-all" spot="4">全選</td></tr><tr><td><input type="checkbox" class="item-ckbox" name="menu_perm[]" value="19" spot="4" checked>廠商設定</td></tr><tr><td><input type="checkbox" class="item-ckbox" name="menu_perm[]" value="20" spot="4" checked>遊戲設定</td></tr><tr><td><input type="checkbox" class="item-ckbox" name="menu_perm[]" value="21" spot="4" checked>遊戲標籤設定</td></tr><tr><td><input type="checkbox" class="item-ckbox" name="menu_perm[]" value="22" spot="4" checked>遊戲新增及語系設定</td></tr>
	</table>
</div>

<div class="show-menu-div" spot="5">
	<table class="setting-tb">
		<tr class="bg-green1 color-white">
			<td class="title">金流設定</td>
		</tr>
		<tr><td><input type="checkbox" class="item-ckbox-all" spot="5">全選</td></tr><tr><td><input type="checkbox" class="item-ckbox" name="menu_perm[]" value="23" spot="5" checked>支付渠道設定</td></tr><tr><td><input type="checkbox" class="item-ckbox" name="menu_perm[]" value="24" spot="5" checked>出入款管理設定</td></tr><tr><td><input type="checkbox" class="item-ckbox" name="menu_perm[]" value="34" spot="5" checked>在線商戶設定</td></tr><tr><td><input type="checkbox" class="item-ckbox" name="menu_perm[]" value="35" spot="5" checked>公司入款設定</td></tr>
	</table>
</div>

<div class="show-menu-div" spot="6">
	<table class="setting-tb">
		<tr class="bg-green1 color-white">
			<td class="title">金流管理</td>
		</tr>
		<tr><td><input type="checkbox" class="item-ckbox-all" spot="6">全選</td></tr><tr><td><input type="checkbox" class="item-ckbox" name="menu_perm[]" value="36" spot="6" checked>三方入款審核</td></tr><tr><td><input type="checkbox" class="item-ckbox" name="menu_perm[]" value="37" spot="6" checked>公司入款審核</td></tr><tr><td><input type="checkbox" class="item-ckbox" name="menu_perm[]" value="38" spot="6" checked>會員出款申請審核</td></tr><tr><td><input type="checkbox" class="item-ckbox" name="menu_perm[]" value="45" spot="6" checked>代理出款申請審核</td></tr><tr><td><input type="checkbox" class="item-ckbox" name="menu_perm[]" value="39" spot="6" checked>人工出入金</td></tr><tr><td><input type="checkbox" class="item-ckbox" name="menu_perm[]" value="25" spot="6" checked>出款稽核</td></tr>
	</table>
</div>

<div class="show-menu-div" spot="7">
	<table class="setting-tb">
		<tr class="bg-green1 color-white">
			<td class="title">優惠管理</td>
		</tr>
		<tr><td><input type="checkbox" class="item-ckbox-all" spot="7">全選</td></tr><tr><td><input type="checkbox" class="item-ckbox" name="menu_perm[]" value="26" spot="7" checked>優惠分類設定</td></tr><tr><td><input type="checkbox" class="item-ckbox" name="menu_perm[]" value="27" spot="7" checked>優惠設定</td></tr><tr><td><input type="checkbox" class="item-ckbox" name="menu_perm[]" value="28" spot="7" checked>優惠派發審核</td></tr><tr><td><input type="checkbox" class="item-ckbox" name="menu_perm[]" value="54" spot="7" checked>會員申請優惠審核</td></tr><tr><td><input type="checkbox" class="item-ckbox" name="menu_perm[]" value="29" spot="7" checked>返水設定</td></tr><tr><td><input type="checkbox" class="item-ckbox" name="menu_perm[]" value="30" spot="7" checked>返水派發審核</td></tr>
	</table>
</div>

<div class="show-menu-div" spot="8">
	<table class="setting-tb">
		<tr class="bg-green1 color-white">
			<td class="title">報表管理</td>
		</tr>
		<tr><td><input type="checkbox" class="item-ckbox-all" spot="8">全選</td></tr><tr><td><input type="checkbox" class="item-ckbox" name="menu_perm[]" value="49" spot="8" checked>出入金紀錄報表</td></tr><tr><td><input type="checkbox" class="item-ckbox" name="menu_perm[]" value="31" spot="8" checked>會員資金明細報表</td></tr><tr><td><input type="checkbox" class="item-ckbox" name="menu_perm[]" value="46" spot="8" checked>代理資金明細報表</td></tr><tr><td><input type="checkbox" class="item-ckbox" name="menu_perm[]" value="40" spot="8" checked>總報表</td></tr><tr><td><input type="checkbox" class="item-ckbox" name="menu_perm[]" value="41" spot="8" checked>遊戲報表</td></tr><tr><td><input type="checkbox" class="item-ckbox" name="menu_perm[]" value="50" spot="8" checked>會員即時投注</td></tr><tr><td><input type="checkbox" class="item-ckbox" name="menu_perm[]" value="42" spot="8" checked>會員投注紀錄</td></tr><tr><td><input type="checkbox" class="item-ckbox" name="menu_perm[]" value="43" spot="8" checked>會員輸贏報表</td></tr><tr><td><input type="checkbox" class="item-ckbox" name="menu_perm[]" value="44" spot="8" checked>代理退佣退水報表</td></tr><tr><td><input type="checkbox" class="item-ckbox" name="menu_perm[]" value="47" spot="8" checked>改帳通知</td></tr><tr><td><input type="checkbox" class="item-ckbox" name="menu_perm[]" value="48" spot="8" checked>代理報表</td></tr>
	</table>
</div>

<div class="show-menu-div" spot="10">
	<table class="setting-tb">
		<tr class="bg-green1 color-white">
			<td class="title">系統管理</td>
		</tr>
		<tr><td><input type="checkbox" class="item-ckbox-all" spot="10">全選</td></tr><tr><td><input type="checkbox" class="item-ckbox" name="menu_perm[]" value="32" spot="10" checked>IP管理</td></tr><tr><td><input type="checkbox" class="item-ckbox" name="menu_perm[]" value="33" spot="10" checked>後台帳號權限管理</td></tr><tr><td><input type="checkbox" class="item-ckbox" name="menu_perm[]" value="52" spot="10" checked>功能設定</td></tr>
	</table>
</div-->


		</div>
	</div>
</form>
<input type="hidden" id="etype" value="<?=$etype?>" />
<input type="hidden" id="edit-employee-id" value="<?=$user->id?>" />

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
        <script src="/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
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
        <script src="/templates/js/employee/editor.js?cache=6" type="text/javascript"></script>

    </body>
</html>