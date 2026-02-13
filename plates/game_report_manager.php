
<!DOCTYPE html><!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]--><!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]--><!--[if !IE]><!--><html lang="en" class="no-js">	<!--<![endif]-->	<!-- BEGIN HEAD -->	<head>        <meta charset="utf-8"/>        <meta http-equiv="X-UA-Compatible" content="IE=edge">        <!--<meta content="width=device-width, initial-scale=1" name="viewport"/>-->        <meta content="" name="description"/>        <meta content="" name="keywords"/>        <meta content="" name="author"/>        <title>控端</title>        <!-- BEGIN PAGE TOP STYLES -->        <!-- END PAGE TOP STYLES -->        <!-- BEGIN GLOBAL MANDATORY STYLES -->        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />        <!-- END GLOBAL MANDATORY STYLES -->        <!-- BEGIN PAGE LEVEL PLUGINS -->        <link href="/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />        <!-- END PAGE LEVEL PLUGINS -->        <!-- BEGIN THEME GLOBAL STYLES -->        <link href="/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />        <link href="/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />        <!-- END THEME GLOBAL STYLES -->        <!-- BEGIN THEME LAYOUT STYLES -->        <link href="/assets/layouts/layout/css/self-layout.css" rel="stylesheet" type="text/css" />        <link href="/assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />        <link href="/assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />        <!-- END THEME LAYOUT STYLES -->        <link href="/templates/css/style.css?cache=209" rel="stylesheet" type="text/css"/>		<link href="/templates/css/tw_style.css?cache=205" rel="stylesheet" type="text/css"/>                <!-- BEGIN PAGE FIRST SCRIPTS -->        <script src="/assets/global/plugins/jquery.min.js" type="text/javascript"></script>        <!-- END PAGE FIRST SCRIPTS -->        <link rel="shortcut icon" href="#"/>	</head>	<!-- END HEAD -->	<body>       <div class="page-inner-content">
	<!--slot=0-->
<style>
.page-bar{
	margin-bottom: 5px;
}
.page-bar .act-group {
   /*float: left;*/
    margin-right: 10px;
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
th
{
	text-align: center;
}
td
{
	text-align: right;
}	
.nowrap{
	white-space: nowrap;
}	
.min-w-400{
	min-width: 400px;
}
.date-div{
	display: flex;
	align-items: center;
}
.date-div .sign{
	padding:0px 20px;
}
.title-class{
	font-weight: bold;
	margin-left: 5px;
}
/* game ck div*/
.game-ckbox-div{
	margin-bottom: 10px;
	background-color: #e7ecf1 !important;
    padding: 10px !important;
}
.game-ckbox-inner{
	display: none;
}
.gstore-group-ckbox-div{
	/*padding: 10px;*/
}
.gstore-ckbox-div{
	padding: 5px;
}
#report-form{
	display:inline;
}
.search-detail-div{
	margin-bottom: 10px;
	background-color: #e7ecf1 !important;
    padding: 5px !important;
}
.search-detail-div .detail-bar{
	padding: 5px;
}
.search-detail-div .date-pick-div .btn{
	padding: 3px 12px !important;
}
</style>
<form id="report-form" class="form-horizontal" role="form" method="GET" action="game_report_manager">
	<div class="page-bar">
		<div class="act-group hidden">
			<button class="btn green-sharp btn-large " onclick="parent.goIframeHistoryBack(this, event);"> <i class="fa fa-mail-reply"></i> <font class="">回上頁</font> </button>
		</div>
		<div class="act-group">
			<span>日期類型</span>&nbsp;
			<select name="search_date_type">
				<option value="1" <?= $search_date_type == '1' ? "selected=true" : ''?>>投注日期</option>
				<option value="2" <?= $search_date_type == '2' ? "selected=true" : ''?>>結算日期</option>
			</select>
		</div>
		<div class="act-group">
			<div class="date-div">
				<div>日期區間</div>&nbsp;
				<div class="input-group input-small date date-picker sddate" data-date="<?=$sddate?>" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
					<input type="text" class="form-control" id="search-start-date" name="sddate" value="<?=$sddate?>" readonly>
					<span class="input-group-btn">
						<button class="btn blue" type="button">
						<i class="fa fa-calendar"></i>
						</button>
					</span>
				</div>
				<div class="input-group input-small search-time">
					<input type="text" id="search-start-time" name="sdtime" value="<?=$sdtime?>" class="form-control timepicker timepicker-24" readonly>
					<span class="input-group-btn">
						<button class="btn blue" type="button">
							<i class="fa fa-clock-o"></i>
						</button>
					</span>
				</div>
				<div class="sign">~</div>
				<div class="input-group input-small date date-picker eddate" data-date="<?=$eddate?>" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
					<input type="text" class="form-control" id="search-end-date" name="eddate" value="<?=$eddate?>" readonly>
					<span class="input-group-btn">
						<button class="btn blue" type="button">
						<i class="fa fa-calendar"></i>
						</button>
					</span>
				</div>
				<div class="input-group input-small search-time">
					<input type="text" id="search-end-time" name="edtime" value="<?=$edtime?>" class="form-control timepicker timepicker-24" readonly>
					<span class="input-group-btn">
						<button class="btn blue" type="button">
							<i class="fa fa-clock-o"></i>
						</button>
					</span>
				</div>
			</div>
		</div>
		<div class="act-group">
			<span>廠商名稱</span>&nbsp;
			<select name="search_game_store" onChange="change_game_store();">
				<option  value="" <?=isset($search_game_store) ? "selected=true" : ''?>> 全部</option>
				<?php foreach ($games as $game): ?>
					<option  value="<?=$game['id']?>" <?=$search_game_store == $game['id'] ? "selected=true" : ''?> ><?=$game['name']?></option>
				<?php endforeach;?>
			</select>
		</div>
		<div class="act-group">
			<button type="button" class="btn btn-success search-btn" value="search">
				<i class="fa fa-search"></i> 查詢
			</button>
		</div>
	</div>
	<div class="search-detail-div">
		<div class="detail-bar date-pick-div">
			<span>快選日期</span>&nbsp;
			<button type="button" class="btn red btn_yesterday btn-md" today-date="<?=date('Y-m-d')?>">昨日</button>
			<button type="button" class="btn red btn_today btn-md" today-date="<?=date('Y-m-d')?>">今日</button>
			<button type="button" class="btn red btn_lastweek btn-md" today-date="<?=date('Y-m-d')?>">上週</button>	
			<button type="button" class="btn red btn_thisweek btn-md" today-date="<?=date('Y-m-d')?>">本周</button>
			<button type="button" class="btn red btn_lastmonth btn-md" today-date="<?=date('Y-m-d')?>">上月</button>
			<button type="button" class="btn red btn_thismonth btn-md" today-date="<?=date('Y-m-d')?>">本月</button>
		</div>
		<div class="detail-bar">
			
		</div>
	</div>
	<div class="game-ckbox-div" style="display:none;">
		<span>遊戲類別</span>&nbsp;<a href="javascript:void(0);" onclick="toggle_div('game-ckbox-inner');">縮合</a>
		<div id="game-ckbox-inner" class="game-ckbox-inner">
			<div class="gstore-group-ckbox-div">
				
			</div>
			<div class="gstore-ckbox-div">體育&nbsp;&nbsp;<input type="checkbox" class="item-ckbox-all" spot="group-1">全部<input type="checkbox" is-post-data="1" class="item-ckbox" name="game_store[]" value="1" spot="group-1" checked>協和體育</div><div class="gstore-ckbox-div">彩票&nbsp;&nbsp;<input type="checkbox" class="item-ckbox-all" spot="group-2">全部<input type="checkbox" is-post-data="1" class="item-ckbox" name="game_store[]" value="21" spot="group-2" checked>大立彩票<input type="checkbox" is-post-data="1" class="item-ckbox" name="game_store[]" value="27" spot="group-2" checked>轉轉樂</div><div class="gstore-ckbox-div">真人&nbsp;&nbsp;<input type="checkbox" class="item-ckbox-all" spot="group-3">全部<input type="checkbox" is-post-data="1" class="item-ckbox" name="game_store[]" value="8" spot="group-3" checked>歐博真人<input type="checkbox" is-post-data="1" class="item-ckbox" name="game_store[]" value="9" spot="group-3" checked>沙龍真人<input type="checkbox" is-post-data="1" class="item-ckbox" name="game_store[]" value="11" spot="group-3" checked>WM真人<input type="checkbox" is-post-data="1" class="item-ckbox" name="game_store[]" value="31" spot="group-3" checked>皇家真人</div><div class="gstore-ckbox-div">電子&nbsp;&nbsp;<input type="checkbox" class="item-ckbox-all" spot="group-4">全部<input type="checkbox" is-post-data="1" class="item-ckbox" name="game_store[]" value="26" spot="group-4" checked>皇家電子<input type="checkbox" is-post-data="1" class="item-ckbox" name="game_store[]" value="32" spot="group-4" checked>BNG電子</div><div class="gstore-ckbox-div">棋牌&nbsp;&nbsp;<input type="checkbox" class="item-ckbox-all" spot="group-5">全部<input type="checkbox" is-post-data="1" class="item-ckbox" name="game_store[]" value="16" spot="group-5" checked>BTS棋牌<input type="checkbox" is-post-data="1" class="item-ckbox" name="game_store[]" value="19" spot="group-5" checked>BL棋牌</div><div class="gstore-ckbox-div">電競&nbsp;&nbsp;<input type="checkbox" class="item-ckbox-all" spot="group-6">全部<input type="checkbox" is-post-data="1" class="item-ckbox" name="game_store[]" value="20" spot="group-6" checked>TF電競</div>
		</div>
	</div>
</form>	
<div class="portlet light bordered">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-group font-green-sharp"></i>
			<span class="caption-subject font-green-sharp bold uppercase">報表管理 - 遊戲報表</span>
			
		</div>
	</div>
    
	<div class="portlet-body">
       <div class="table-container">
			<table class="table table-striped table-bordered table-hover order-column">
				<thead>
					<tr class="bg-green1 color-white">
						<th>遊戲類別</th>
						<th>總投注筆數</th>
						<th>總投注金額</th>
						<th>總有效投注</th>
						<th>總輸贏</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach($summarys as $bet){
					?> 
					<tr>
						<td><?=$bet->game->name?></td>
						<td><a href="/agent/cus_bet_info_manager?sddate=<?=$_GET['sddate']?>&search_game_store=<?=$bet->game_id?>"><?=$bet->Cnt?></a></td>
						<td><?=$bet->totalAmount?></td>
						<td><?=$bet->totalValidAmount?></td>
						<td><?=$bet->totalNetAmount?></td>
					</tr>
					<?php
					}
					?>
					<tr> 
						<td class="text-left" colspan="1">總計</td> 
						<td class=""><?=$allTotal->Cnt?></td>
						<td class=""><?=$allTotal->totalAmount?></td>
						<td class=""><?=$allTotal->totalValidAmount?></td>
						<td class=""><?=$allTotal->totalNetAmount?></td>
					</tr>
				</tbody>
			 </table>
		</div>
	</div>
</div>

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
		<script src="/templates/js/kang_common.js?cache=108"></script>
		<script src="/templates/js/kang_all.js?cache=203"></script>
		<script src="/templates/js/lang/tw.js?cache=203"></script>
        <script src="/templates/js/game_report/manager.js?cache=126" type="text/javascript"></script>

    </body>
</html>