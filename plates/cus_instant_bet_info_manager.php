
<!DOCTYPE html><!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]--><!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]--><!--[if !IE]><!--><html lang="en" class="no-js">	<!--<![endif]-->	<!-- BEGIN HEAD -->	<head>        <meta charset="utf-8"/>        <meta http-equiv="X-UA-Compatible" content="IE=edge">        <!--<meta content="width=device-width, initial-scale=1" name="viewport"/>-->        <meta content="" name="description"/>        <meta content="" name="keywords"/>        <meta content="" name="author"/>        <title>控端</title>        <!-- BEGIN PAGE TOP STYLES -->        <!-- END PAGE TOP STYLES -->        <!-- BEGIN GLOBAL MANDATORY STYLES -->        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />        <!-- END GLOBAL MANDATORY STYLES -->        <!-- BEGIN PAGE LEVEL PLUGINS -->        <link href="/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />        <!-- END PAGE LEVEL PLUGINS -->        <!-- BEGIN THEME GLOBAL STYLES -->        <link href="/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />        <link href="/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />        <!-- END THEME GLOBAL STYLES -->        <!-- BEGIN THEME LAYOUT STYLES -->        <link href="/assets/layouts/layout/css/self-layout.css" rel="stylesheet" type="text/css" />        <link href="/assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />        <link href="/assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />        <!-- END THEME LAYOUT STYLES -->        <link href="/templates/css/style.css?cache=209" rel="stylesheet" type="text/css"/>		<link href="/templates/css/tw_style.css?cache=205" rel="stylesheet" type="text/css"/>        <link rel="stylesheet" type="text/css" href="/templates/css/cus_instant_bet_info.css?cache=108" >
        <!-- BEGIN PAGE FIRST SCRIPTS -->        <script src="/assets/global/plugins/jquery.min.js" type="text/javascript"></script>        <!-- END PAGE FIRST SCRIPTS -->        <link rel="shortcut icon" href="#"/>	</head>	<!-- END HEAD -->	<body>       <div class="page-inner-content">
	<!--slot=0-->
<style>
.page-bar {
    margin-bottom: 10px;
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
.timer-bar{
	float:right;
	color: #666;
    padding: 10px 0;
	font-size: 16px;
	font-weight: bold;
}
.timer-bar .change-timer-select{
	margin-right: 10px;
}
#report-form{
	display:inline;
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
<form id="report-form" class="form-horizontal" role="form" method="GET" action="cus_instant_bet_info_manager">
	<div class="page-bar">
		<div class="act-group hidden">
			<button class="btn green-sharp btn-large " onclick="parent.goIframeHistoryBack(this, event);"> <i class="fa fa-mail-reply"></i> <font class="">回上頁</font> </button>
		</div>
		<div class="act-group hidden">
			<span>日期類型</span>&nbsp;
			<select name="search_date_type">
				<option value="1" >投注日期</option>
				<option value="2" >結算日期</option>
				<option value="3" >生效日期</option>
			</select>
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

	<option  value="-1" selected=true> 全部</option>

	<option  value="1" > 協和體育</option>

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
		<div class="act-group hidden">
			<span>注單編號</span>&nbsp;
			<input type="text" size="10" name="search_order_no" value="">
		</div>
		<div class="act-group">
			<span>投注金額</span>&nbsp;
			<input type="text" size="10" name="search_bet_amount" value="">
		</div>
		<div class="act-group">
			<span>輸贏金額</span>&nbsp;
			<input type="text" size="10" name="search_win_amount" value="">
		</div>
		<div class="act-group">
			<button type="button" class="btn btn-success search-btn" value="search">
				<i class="fa fa-search"></i> 查詢
			</button>
		</div>
	</div>
	<input type="hidden" id="page-now" name="page_now" value="" >
	<input type="hidden"  name="start" value="0" >
	<input type="hidden" id="timer" name="timer" value="<?=$timer?>" >
</form>	
<div class="portlet light bordered">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-group font-green-sharp"></i>
			<span class="caption-subject font-green-sharp bold uppercase">報表管理 - 會員即時投注</span>
		</div>
        <div class="timer-bar">
        	<span class="change-timer-select">
                選擇更新時間
                <select id="change-timer-select" onchange="change_countdown_timer();">
                    <option value="-1">不更新</option>
                    <option value="10">10秒</option>
                    <option value="30">30秒</option>
                    <option value="60">60秒</option>
                </select>
            </span>
            <span>
            	更新倒數：<span id="countdown-timer">不更新</span>
            </span>
        </div>
        <div class="clear"></div>
	</div>
    <div id="bet-info-table-div">
    	<!--slot=2-->
<div class="align-right">
    <div class="page-div hidden"><!--slot=0-->
第<select onchange="select_page(this.value)"></select>頁﹐共0頁
</div>
</div>
<br />   
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
                    <th>會員輸贏</th>
                </tr>
            </thead>
            <tbody>
				<?php
					foreach($bets as $bet){
					?> 
					<tr>
						<td><?=$bet->order_no?></td>
						<td><?=$bet->game_username?></td>
						<td><?=$bet->game_username?></td>
						<td><?=$bet->game->name?></td>
						<td>未结算</td>
						<td><?=$bet->game->name?></td>
						<td><?=$bet->bet_time?></td>
						<td><?=$bet->amount?></td>
						<td><?=$bet->valid_amount?></td>
						<td><?=$bet->winlose?></td>
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
					</tr>
					<tr class="total-tr">
						<td class="align-r">小計</td>
						<td colspan="6" class="align-r"><?=$page_summarys->Cnt?>筆</td>
						<td><?=$page_summarys->totalAmount?></td>
						<td><?=$page_summarys->totalValidAmount?></td>
						<td class="green-txt"><?=$page_summarys->totalWinlose?></td>
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
        <script src="/templates/js/cus_instant_bet_info/manager.js?cache=136" type="text/javascript"></script>
		<script>
			function select_page (i){
				$('input[name="start"]').val(i);
				
				$('#report-form').submit();
			}
		</script>
    </body>
</html>