
<!DOCTYPE html><!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]--><!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]--><!--[if !IE]><!--><html lang="en" class="no-js">	<!--<![endif]-->	<!-- BEGIN HEAD -->	<head>        <meta charset="utf-8"/>        <meta http-equiv="X-UA-Compatible" content="IE=edge">        <!--<meta content="width=device-width, initial-scale=1" name="viewport"/>-->        <meta content="" name="description"/>        <meta content="" name="keywords"/>        <meta content="" name="author"/>        <title>控端</title>        <!-- BEGIN PAGE TOP STYLES -->        <!-- END PAGE TOP STYLES -->        <!-- BEGIN GLOBAL MANDATORY STYLES -->        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />        <!-- END GLOBAL MANDATORY STYLES -->        <!-- BEGIN PAGE LEVEL PLUGINS -->        <link href="/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />        <!-- END PAGE LEVEL PLUGINS -->        <!-- BEGIN THEME GLOBAL STYLES -->        <link href="/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />        <link href="/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />        <!-- END THEME GLOBAL STYLES -->        <!-- BEGIN THEME LAYOUT STYLES -->        <link href="/assets/layouts/layout/css/self-layout.css" rel="stylesheet" type="text/css" />        <link href="/assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />        <link href="/assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />        <!-- END THEME LAYOUT STYLES -->        <link href="/templates/css/style.css?cache=209" rel="stylesheet" type="text/css"/>		<link href="/templates/css/tw_style.css?cache=205" rel="stylesheet" type="text/css"/>                <!-- BEGIN PAGE FIRST SCRIPTS -->        <script src="/assets/global/plugins/jquery.min.js" type="text/javascript"></script>        <!-- END PAGE FIRST SCRIPTS -->        <link rel="shortcut icon" href="#"/>	</head>	<!-- END HEAD -->	<body>       <div class="page-inner-content">
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
#ckout-items-btn-area {
	margin-bottom: 10px;
}
#ckout-items-btn-area .ckout-items-btn{
	padding: 4px 6px;
    text-decoration: none;
    margin-left: 10px;
    border: 1px solid #337ab7!important;
    color: #337ab7;
    font-weight: bold;
	font-family: "微軟正黑體";
	display:inline-block;
}
#ckout-items-btn-area .ckout-items-btn.active{
	background-color:#337ab7;
	color: #FFF;
}
.list-table .plus-btn-class{
	display: inline-block;
	padding: 0px 4px;
	background-color: goldenrod;
	line-height: 15px;
	position: relative;
	left: 5px;
	cursor: pointer;
}
</style>
<form id="report-form" class="form-horizontal" role="form" method="GET" action="all_calc_report_manager">
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
			<input type="text" size="8" name="search_customer_userid" value="">
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
</form>	
<div id="ckout-items-btn-area">
	<a class="ckout-items-btn active" href="all_calc_report_manager">總報表</a>
    <a class="ckout-items-btn" href="all_calc_agent_report_manager">代理報表</a>
</div>
<div class="portlet light bordered">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-group font-green-sharp"></i>
			<span class="caption-subject font-green-sharp bold uppercase">報表管理 - 總報表</span>
			
		</div>
	</div>
    
	<div class="portlet-body">
       <div class="table-container">
			<table class="table table-striped table-bordered table-hover list-table">
				<thead>
					<tr class="bg-green1 color-white">
						<th>日期</th>
						<th>總筆數</th>
						<th>總投注</th>
						<th>總有效</th>
						<th>總入款</th>
						<th>總出款</th>
						<th>商戶金流手續費<span class="plus-btn-class" onclick="plus_btn_click(this, 'total-merchant-fee');">+</span></th>
						<th class="total-merchant-fee hidden">代理負擔</th>
						<th class="total-merchant-fee hidden">總代負擔</th>
						<th class="total-merchant-fee hidden">公司負擔</th>
						<th>總優惠<span class="plus-btn-class" onclick="plus_btn_click(this, 'total-discount');">+</span></th>
						<th class="total-discount hidden">推薦優惠</th>
						<th class="total-discount hidden">其他優惠</th>
						<th>總返水</th><th>會員返水</th>
						<th>代理反水<span class="plus-btn-class" onclick="plus_btn_click(this, 'cus-lev15-retreat');">+</span></th>
						<th class="cus-lev15-retreat hidden">退水規則</th>
						<th class="cus-lev15-retreat hidden">佔水</th>
						<th>總代返水<span class="plus-btn-class" onclick="plus_btn_click(this, 'cus-lev14-retreat');">+</span></th>
						<th class="cus-lev14-retreat hidden">退水規則</th>
						<th class="cus-lev14-retreat hidden">佔水</th>
						<th>會員輸贏</th><th>總佣金</th><th>代理佣金</th>
						<th>總代佣金<span class="plus-btn-class" onclick="plus_btn_click(this, 'cus-lev14-commission');">+</span></th>
						<th class="cus-lev14-commission hidden">佣金規則</th><th class="cus-lev14-commission hidden">總輸贏規則</th>
						<th>廠商上繳</th>
						<th>總計</th>
					</tr>
				</thead>
				<tbody>
				<tr>
						<td class="text-left" colspan="1">總計</td>
						<td class="" ><?=$allTotal->Cnt?></td>
						<td><?=$allTotal->totalAmount?></td>
						<td><?=$allTotal->totalValidAmount?></td>
						<td><?=$allTotal->money_in?></td>
						<td class="" ><?=$allTotal->money_out?></td>
						<td class="" >0</td>
						<td class=" total-merchant-fee hidden" >0</td>
						<td class=" total-merchant-fee hidden" >0</td>
						<td class=" total-merchant-fee hidden" >0</td>
						<td class="green-txt" >0</td>
						<td class=" total-discount hidden" >0</td>
						<td class="green-txt total-discount hidden" >0</td>
						<td class="" ><?=$allTotal->retreat?></td>
						<td class="" ><?=$allTotal->retreat?></td>
						<td class="" >0</td>
						<td class=" cus-lev15-retreat hidden" >0</td>
						<td class=" cus-lev15-retreat hidden" >0</td>
						<td class="" >0</td>
						<td class=" cus-lev14-retreat hidden" >0</td>
						<td class=" cus-lev14-retreat hidden" >0</td>
						<td class="red-txt" ><?=$allTotal->totalWinlose?></td>
						<td class="" >0</td>
						<td class="" >0</td>
						<td class="" >0</td>
						<td class=" cus-lev14-commission hidden" >0</td>
						<td class=" cus-lev14-commission hidden" >0</td>
						<td class="green-txt" ><?=$allTotal->totalGameGive?></td>
						<td class="red-txt" ><?=$allTotal->total?></td>
					</tr>
					<?php
						foreach($result as $date => $bet){
					?> 
					<tr>
						<td class="text-left" colspan="1"><a href="all_calc_agent_report_manager?report_lev=2&sddate=<?=$date?>&eddate=<?=$date?>&is_back=1&search_date_type=1&station_code_all=all"><?=$date?><a></td>
						<td class="" ><?=$bet['Cnt']?></td>
						<td><?=$bet['totalAmount']?></td>
						<td><?=$bet['totalValidAmount']?></td>
						<td><?=$bet['money_in']?></td>
						<td class="" ><?=$bet['money_out']?></td>
						<td class="" >0</td>
						<td class=" total-merchant-fee hidden" >0</td>
						<td class=" total-merchant-fee hidden" >0</td>
						<td class=" total-merchant-fee hidden" >0</td>
						<td class="green-txt" >0</td>
						<td class=" total-discount hidden" >0</td>
						<td class="green-txt total-discount hidden" >0</td>
						<td class="" ><?=$bet['retreat']?></td>
						<td class="" ><?=$bet['retreat']?></td>
						<td class="" >0</td>
						<td class=" cus-lev15-retreat hidden" >0</td>
						<td class=" cus-lev15-retreat hidden" >0</td>
						<td class="" >0</td>
						<td class=" cus-lev14-retreat hidden" >0</td>
						<td class=" cus-lev14-retreat hidden" >0</td>
						<td class="red-txt" ><?=$bet['totalWinlose']?></td>
						<td class="" >0</td>
						<td class="" >0</td>
						<td class="" >0</td>
						<td class=" cus-lev14-commission hidden" >0</td>
						<td class=" cus-lev14-commission hidden" >0</td>
						<td class="green-txt" ><?=$bet['totalGameGive']?></td>
						<td class="red-txt" ><?=$bet['total']?></td>
					</tr>
					<?php
						}
					?>
						
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
        <script src="/templates/js/all_calc_report/manager.js?cache=119" type="text/javascript"></script>

    </body>
</html>