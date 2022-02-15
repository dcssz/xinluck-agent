
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
#manager_table_wrapper > div:first-child{
	display:none;
}
th
{
	text-align: center;
}
#manager_table td{
	vertical-align: middle;
	text-align: center;
}
.date-div{
	display: flex;
	align-items: center;
}
.date-div .search-time{
	margin-left:10px;
}
.date-div .sign{
	padding:0px 20px;
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
<form id="report-form" class="form-horizontal" role="form" method="GET" action="cus_quota_log_manager.php">
	<div class="page-bar">
		<div class="act-group hidden">
			<button class="btn green-sharp btn-large " onclick="parent.goIframeHistoryBack(this, event);"> <i class="fa fa-mail-reply"></i> <font class="">回上頁</font> </button>
		</div>
		<div class="act-group">
			<div class="date-div">
				<div>日期區間</div>&nbsp;
				<div class="input-group input-small date date-picker sddate" data-date="<?=date('Y-m-d')?>" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
					<input type="text" class="form-control" id="search-start-date" name="search_start_date" value="<?=date('Y-m-d')?>" readonly>
					<span class="input-group-btn">
						<button class="btn blue" type="button">
						<i class="fa fa-calendar"></i>
						</button>
					</span>
				</div>
				<div class="input-group input-small search-time">
					<input type="text" id="search-start-time" name="search_start_time" value="00:00:00" class="form-control timepicker timepicker-24" readonly>
					<span class="input-group-btn">
						<button class="btn blue" type="button">
							<i class="fa fa-clock-o"></i>
						</button>
					</span>
				</div>
				<div class="sign">~</div>
				<div class="input-group input-small date date-picker eddate" data-date="<?=date('Y-m-d')?>" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
					<input type="text" class="form-control" id="search-end-date" name="search_end_date" value="<?=date('Y-m-d')?>" readonly>
					<span class="input-group-btn">
						<button class="btn blue" type="button">
						<i class="fa fa-calendar"></i>
						</button>
					</span>
				</div>
				<div class="input-group input-small search-time">
					<input type="text" id="search-end-time" name="search_end_time" value="23:59:59" class="form-control timepicker timepicker-24" readonly>
					<span class="input-group-btn">
						<button class="btn blue" type="button">
							<i class="fa fa-clock-o"></i>
						</button>
					</span>
				</div>
			</div>
		</div>
		<div class="act-group">
			<span>帳號</span>&nbsp;
			<input type="text" name="search_customer_userid" value="<?=$search_customer_userid?>">
		</div>
		<div class="act-group">
			<span>模糊搜尋<input type="checkbox" name="fuzzy_search" value="1" /></span>
		</div>
		<div class="act-group">
			<span>操作類型</span>&nbsp;
			<select name="search_operate_type">
				<option value="-1">全部</option>
				<!--slot=1-->

	<option  value="1" > 存入</option>

	<option  value="2" > 提出</option>


			</select>
		</div>
		<div class="act-group">
			<span>異動類型</span>&nbsp;
			<select name="search_trans_type">
				<option value="-1">全部</option>
				<!--slot=1-->

	<option  value="1" > 資金調度</option>

	<option  value="2" > 平台轉點</option>

	<option  value="3" > 會員出入金</option>

	<option  value="4" > 人工出入金</option>

	<option  value="5" > 返水派發</option>

	<option  value="6" > 優惠派發</option>


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
</form>
<div class="portlet light bordered">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-group font-green-sharp"></i>
			<span class="caption-subject font-green-sharp bold uppercase">報表管理 - 會員資金明細報表</span>
			<span id="title-info-content">總異動額度：<span id="all-trans-quota" class="title-class">0</span></span>
		</div>
	</div>
    
	<div class="portlet-body">
       <div id="sample_2_wrapper" class="dataTables_wrapper">
			<div class="table-container">
            	<table class="table table-striped table-bordered table-hover order-column" id="manager_table">
                	<thead>
                    	<tr class="bg-green1 color-white">
                            <th>會員帳號</th>
							<th>操作類型</th>
							<th>異動類型</th>
							<th>異動原因</th>
							<th>異動前額度</th>
                            <th>異動額度</th>
							<th>異動後額度</th>
							<th>操作人</th>
                            <th>最後操作時間</th>
                    	</tr>
                    </thead>
                    <tbody>
                    	<tr>
                        	<td colspan="100%">資料讀取中...</td>
                        </tr>
                    </tbody>
                 </table>
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
        <script src="/templates/js/cus_quota_log/manager.js?cache=108" type="text/javascript"></script>

    </body>
</html>