
<!DOCTYPE html><!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]--><!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]--><!--[if !IE]><!--><html lang="en" class="no-js">	<!--<![endif]-->	<!-- BEGIN HEAD -->	<head>        <meta charset="utf-8"/>        <meta http-equiv="X-UA-Compatible" content="IE=edge">        <!--<meta content="width=device-width, initial-scale=1" name="viewport"/>-->        <meta content="" name="description"/>        <meta content="" name="keywords"/>        <meta content="" name="author"/>        <title>控端</title>        <!-- BEGIN PAGE TOP STYLES -->        <!-- END PAGE TOP STYLES -->        <!-- BEGIN GLOBAL MANDATORY STYLES -->        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />        <!-- END GLOBAL MANDATORY STYLES -->        <!-- BEGIN PAGE LEVEL PLUGINS -->        <link href="/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />        <!-- END PAGE LEVEL PLUGINS -->        <!-- BEGIN THEME GLOBAL STYLES -->        <link href="/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />        <link href="/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />        <!-- END THEME GLOBAL STYLES -->        <!-- BEGIN THEME LAYOUT STYLES -->        <link href="/assets/layouts/layout/css/self-layout.css" rel="stylesheet" type="text/css" />        <link href="/assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />        <link href="/assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />        <!-- END THEME LAYOUT STYLES -->        <link href="/templates/css/style.css?cache=209" rel="stylesheet" type="text/css"/>		<link href="/templates/css/tw_style.css?cache=205" rel="stylesheet" type="text/css"/>        <link rel="stylesheet" type="text/css" href="/templates/css/member_order.css?cache=108" >
        <!-- BEGIN PAGE FIRST SCRIPTS -->        <script src="/assets/global/plugins/jquery.min.js" type="text/javascript"></script>        <!-- END PAGE FIRST SCRIPTS -->        <link rel="shortcut icon" href="#"/>	</head>	<!-- END HEAD -->	<body>       <div class="page-inner-content">
	<!--slot=0-->
<style>
.page-bar {
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
	text-align: center;
	vertical-align: middle!important;
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
.align-right{
	text-align:right !important;
}
.page-div{
	display:inline-block;
	background-color:#ff5;
	padding:0px 10px;
	line-height: 40px;
}
</style>
<form id="report-form" class="form-horizontal" role="form" method="GET" action="cus_bet_info_manager">
	<div class="page-bar">
		<div class="act-group hidden">
			<button class="btn green-sharp btn-large " onclick="parent.goIframeHistoryBack(this, event);"> <i class="fa fa-mail-reply"></i> <font class="">回上頁</font> </button>
		</div>
		<div class="act-group">
			<span>日期類型</span>&nbsp;
			<select name="search_date_type">
				<option value="1" >投注日期</option>
				<option value="2" >結算日期</option>
				<option value="3" >生效日期</option>
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
			<span>帳號層級</span>&nbsp;
			<select name="search_level">
				<option value="16" >會員</option>
				<option value="15" >代理</option>
				<option value="14" >總代</option>
			</select>
		</div>
		<div class="act-group">
			<span>帳號</span>&nbsp;
			<input type="text" size="8" name="search_customer_userid" value="<?=$search_customer_userid?>">
		</div>
		<div class="act-group">
			<span>廠商名稱</span>&nbsp;
			<select name="search_game_store" onChange="change_game_store();">
				<!--slot=1-->

	<option  value="1" selected> 協和體育</option>

	<option  value="8" > 歐博真人</option>

	<option  value="9" > 沙龍真人</option>

	<option  value="11" > WM真人</option>

	<option  value="16" > BTS棋牌</option>

	<option  value="19" > BL棋牌</option>

	<option  value="20" > TF電競</option>

	<option  value="21" > 大立彩票</option>

	<option  value="26" > 皇家電子</option>

	<option  value="27" > 轉轉樂</option>

	<option  value="31" > 皇家真人</option>

	<option  value="32" > BNG電子</option>


			</select>
		</div>
		<div class="act-group">
			<span>遊戲類型</span>&nbsp;
			<select id="search-game-category" name="search_game_category">
				<!--slot=1-->

	<option  value="-1" selected=true> 全部</option>

	<option  value="1" > 美棒</option>

	<option  value="2" > 彩球</option>

	<option  value="3" > 中華職棒</option>

	<option  value="4" > 日棒</option>

	<option  value="5" > 韓棒</option>

	<option  value="6" > 冰球</option>

	<option  value="7" > 籃球</option>

	<option  value="8" > 賽馬/賽狗</option>

	<option  value="9" > 其他棒球</option>

	<option  value="10" > 其他冰球</option>

	<option  value="11" > 其他籃球</option>

	<option  value="13" > 其他足球</option>

	<option  value="14" > 頂級足球</option>

	<option  value="15" > 美式足球</option>

	<option  value="16" > 電子競技</option>


			</select>
		</div>
		<div class="act-group">
			<span>帳務狀態</span>&nbsp;
			<select id="search-is-finished" name="search_is_finished">
				<option value="-1">全部</option>
				<option value="0" >未結帳</option>
				<option value="1" >已結帳</option>
			</select>
		</div>
		<div class="act-group">
			<span>注單編號</span>&nbsp;
			<input type="text" size="10" name="search_order_no" value="">
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
	<input type="hidden" name="page_now" id="page-now" value="1" >
	<input type="hidden"  name="start" value="0" >
</form>
<div class="portlet light bordered">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-group font-green-sharp"></i>
			<span class="caption-subject font-green-sharp bold uppercase">報表管理 - 會員投注紀錄</span>
		</div>
		<div class="align-right">
			<div class="page-div hidden"><!--slot=0-->
第<select onchange="select_page(this.value)"></select>頁﹐共0頁
</div>
		</div>
	</div>
    
	<div class="portlet-body">
       <div class="table-container">
			<table class="table table-striped table-bordered table-hover order-column">
				<thead>
					<tr class="bg-green1 color-white">
						<th>注單編號</th>
						<th>上層帳號(名稱)</th>
						<th>會員帳號(名稱)</th>
						<th>廠商&遊戲</th>
						<th>狀態</th>
						<th>注單內容</th>
						<th>時間</th>
						<th>投注金額</th>
						<th>有效投注</th>
						<th>投注輸贏</th>
						<th>輸贏結果</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach($bets as $bet){
					?> 
					<tr>
						<td><?=$bet->order_no?></td>
						<td><?= $bet->user->upper ?$bet->user->upper->username.'('.$bet->user->upper->nickname.')': ''?></td>
						<td><?=$bet->user->username?>(<?=$bet->user->nickname?>)</td>
						<td><?=$bet->game->name?></td>
						<td>已结算</td>
						<td><?=$bet->game->name?></td>
						<td><?=$bet->bet_time?></td>
						<td><?=$bet->amount?></td>
						<td><?=$bet->valid_amount?></td>
						<td><?=$bet->winlose?></td>
						<td><?=$bet->netAmount?></td>
					</tr>
					<?php
					}
					?>
					<tr class="all-total-tr">
						<td class="align-r">總計</td>
						<td colspan="6" class="align-r"><?=$summarys->Cnt?>筆</td>
						<td><?=$summarys->totalAmount?></td>
						<td><?=$summarys->totalValidAmount?></td>
						<td class="green-txt"><?=$summarys->totalWinlose?></td>
						<td class="green-txt"><?=$summarys->totalNetAmount?></td>
					</tr>
					<tr class="total-tr">
						<td class="align-r">小計</td>
						<td colspan="6" class="align-r"><?=$page_summarys->Cnt?>筆</td>
						<td><?=$page_summarys->totalAmount?></td>
						<td><?=$page_summarys->totalValidAmount?></td>
						<td class="green-txt"><?=$page_summarys->totalWinlose?></td>
						<td class="green-txt"><?=$page_summarys->totalNetAmount?></td>
					</tr>
				</tbody>
				 
			 </table>
		</div>
		
	</div>
	<div class="align-right">
		<div class="page-div "><!--slot=0-->
		第<select onchange="select_page(this.value)">
			<?php
				for($i=1;$i<=$totalPages;$i++){
					if (($i-1)*$pageSize == $start) {
						echo '<option value="'.($i-1)*$pageSize.'" selected="selected">'.$i.'</option>';

					} else {
						echo '<option value="'.($i-1)*$pageSize.'">'.$i.'</option>';

					}
				}
			?>
		</select>頁﹐共<?=$totalPages?>頁
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
        <script src="/templates/js/cus_bet_info/manager.js?cache=127" type="text/javascript"></script>
		<script>
			function select_page (i){
				$('input[name="start"]').val(i);
				$('#report-form').submit();
			}
		</script>
    </body>
</html>