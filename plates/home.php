
<!DOCTYPE html><!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]--><!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]--><!--[if !IE]><!--><html lang="en" class="no-js">	<!--<![endif]-->	<!-- BEGIN HEAD -->	<head>        <meta charset="utf-8"/>        <meta http-equiv="X-UA-Compatible" content="IE=edge">        <!--<meta content="width=device-width, initial-scale=1" name="viewport"/>-->        <meta content="" name="description"/>        <meta content="" name="keywords"/>        <meta content="" name="author"/>        <title>控端</title>        <!-- BEGIN PAGE TOP STYLES -->        <!-- END PAGE TOP STYLES -->        <!-- BEGIN GLOBAL MANDATORY STYLES -->        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />        <!-- END GLOBAL MANDATORY STYLES -->        <!-- BEGIN PAGE LEVEL PLUGINS -->        <link href="/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />        <!-- END PAGE LEVEL PLUGINS -->        <!-- BEGIN THEME GLOBAL STYLES -->        <link href="/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />        <link href="/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />        <!-- END THEME GLOBAL STYLES -->        <!-- BEGIN THEME LAYOUT STYLES -->        <link href="/assets/layouts/layout/css/self-layout.css" rel="stylesheet" type="text/css" />        <link href="/assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />        <link href="/assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />        <!-- END THEME LAYOUT STYLES -->        <link href="/templates/css/style.css?cache=209" rel="stylesheet" type="text/css"/>		<link href="/templates/css/tw_style.css?cache=205" rel="stylesheet" type="text/css"/>                <!-- BEGIN PAGE FIRST SCRIPTS -->        <script src="/assets/global/plugins/jquery.min.js" type="text/javascript"></script>        <!-- END PAGE FIRST SCRIPTS -->        <link rel="shortcut icon" href="#"/>	</head>	<!-- END HEAD -->	<body>       <div class="page-inner-content">
	<!--slot=0-->
<style>
	#title-info-div{
		border: 1px solid #ccc;
		display: flex;
		background-color: #eee;
	}
	#title-info-div .separator{
		height: 36px;
		border-left: 1px solid #e1e5ec;
		margin: 0 6px 0px 6px;
		display: inline-block;
		position: relative;
		top: 18px;
	}
	#title-info-div .title-info-inner-div{
		padding: 10px;
		flex: 0.2;
		text-align: center;
	}
	#title-info-div .title-info-inner-div .info-content{
		font-size: 24px;
		font-weight: bold;
	}

	#show-rank-div{
		border: 1px solid #ccc;
		display: flex;
		margin-top: 10px;
	}

	#show-rank-div .rank-div{
		border: 1px solid #ccc;
		margin: 10px;
		flex: 0.5;
		/*background-color: #eee;*/

	}

	#show-rank-div .rank-div .btn-span{
		padding: 5px;
		text-decoration: none;
		margin-left: 5px;
		border: 1px solid #337ab7!important;
		border-radius: 5px!important;
		color: #337ab7;
		font-weight: bold;
		font-family: "微軟正黑體";
		cursor: pointer;
		background-color: #FFF;
	}

	#show-rank-div .rank-div .btn-span.active{
		background-color: #337ab7;
    	color: #FFF;
	}

	#show-rank-div .rank-div .rank-bar-div{
		border-bottom: 1px solid #ccc;
	}

	#show-rank-div .rank-div .rank-title-div{
		text-align: center;
		padding: 15px 0px;
		font-weight: bold;
	}

	#show-rank-div .rank-div .rank-title-div .win-lose-btn{
		position: absolute;
	}

	#show-rank-div .rank-div .rank-bar-div .bar-title{
		padding: 5px;
		float: left;
		font-size: 22px;
		font-weight: bold;
	}

	#show-rank-div .rank-div .rank-bar-div .bar-btn{
		padding: 5px;
		display: flex;
		float: right;
	}

	#show-rank-div .rank-div .rank-content-div .rank-table{
		width: 100%;
	}

	#show-rank-div .rank-div .rank-content-div .rank-table th{
		background-color: #eee;
	}

	#show-rank-div .rank-div .rank-content-div .rank-table th, #show-rank-div .rank-div .rank-content-div .rank-table td{
		border: 1px solid #ccc;
		text-align: center;
		padding: 10px 0px;
	}

</style>
<div id="title-info-div">
	<div class="title-info-inner-div">
		<span class="info-content"><?=$totalBalance?></span>
		<br>
		<span><?=_('額度剩餘')?>1</span>
	</div>
	<div class="separator"></div>
	<div class="title-info-inner-div">
		<span class="info-content"><?=$totalUser?>人</span>
		<br>
		<span>總會員數</span>
	</div>
	<div class="separator"></div>
	<div class="title-info-inner-div">
		<span class="info-content"><?=$totalTodayUser?>人</span>
		<br>
		<span>今日新增會員數</span>
	</div>
	<div class="separator"></div>
	<div class="title-info-inner-div">
		<span class="info-content"><?=$totalTodayOnline?>人</span>
		<br>
		<span>今日上線人數</span>
	</div>
	<div class="separator"></div>
	<div class="title-info-inner-div">
		<span class="info-content">0</span>
		<br>
		<span>今日總存款金額</span>
	</div>
	<div class="separator"></div>
	<div class="title-info-inner-div">
		<span class="info-content">0</span>
		<br>
		<span>今日總取款金額</span>
	</div>
	<div class="separator"></div>
	<div class="title-info-inner-div">
		<span class="info-content">0</span>
		<br>
		<span>今日總注單金額</span>
	</div>
	<div class="separator"></div>
	<div class="title-info-inner-div">
		<span class="info-content ">0</span>
		<br>
		<span>今日總會員輸贏</span>
	</div>
</div>
<div id="show-rank-div">
	<div class="rank-div">
		<div class="rank-bar-div">
			<div class="bar-title">會員排行榜</div>
			<div class="bar-btn">
				<span class="btn-span active" info_field="win_amount" search_time_type="1">1小時</span>
				<span class="btn-span" info_field="win_amount" search_time_type="2">今天</span>
				<span class="btn-span" info_field="win_amount" search_time_type="3">前七天</span>
				<span class="btn-span" info_field="win_amount" search_time_type="4">前30天</span>
			</div>
			<div class="clear"></div>
		</div>
		<div class="rank-title-div">
			<div class="win-lose-btn">
				<span class="btn-span active"  info_field="extra_win_amount" search_amount_type="1">盈利</span>
				<span class="btn-span"  info_field="extra_win_amount" search_amount_type="-1">虧損</span>
			</div>
			<span>輸贏金額前10名</span>
		</div>
		<div id="win_amount-rank-div" class="rank-content-div">
			<table class="rank-table"><tr><th>排名</th><th>會員帳號</th><th>盈利金額</th></tr><tr><td>第一名</td><td>虛位以待</td><td>--</td></tr><tr><td>第二名</td><td>虛位以待</td><td>--</td></tr><tr><td>第三名</td><td>虛位以待</td><td>--</td></tr><tr><td>第四名</td><td>虛位以待</td><td>--</td></tr><tr><td>第五名</td><td>虛位以待</td><td>--</td></tr><tr><td>第六名</td><td>虛位以待</td><td>--</td></tr><tr><td>第七名</td><td>虛位以待</td><td>--</td></tr><tr><td>第八名</td><td>虛位以待</td><td>--</td></tr><tr><td>第九名</td><td>虛位以待</td><td>--</td></tr><tr><td>第十名</td><td>虛位以待</td><td>--</td></tr><tr><td>第十一名</td><td>虛位以待</td><td>--</td></tr><tr><td>第十二名</td><td>虛位以待</td><td>--</td></tr><tr><td>第十三名</td><td>虛位以待</td><td>--</td></tr><tr><td>第十四名</td><td>虛位以待</td><td>--</td></tr><tr><td>第十五名</td><td>虛位以待</td><td>--</td></tr><tr><td>第十六名</td><td>虛位以待</td><td>--</td></tr><tr><td>第十七名</td><td>虛位以待</td><td>--</td></tr><tr><td>第十八名</td><td>虛位以待</td><td>--</td></tr><tr><td>第十九名</td><td>虛位以待</td><td>--</td></tr><tr><td>第二十名</td><td>虛位以待</td><td>--</td></tr></table>
		</div>
	</div>

	<div class="rank-div">
		<div class="rank-bar-div">
			<div class="bar-title">會員排行榜</div>
			<div class="bar-btn">
				<span class="btn-span active" info_field="deposit" search_time_type="1">1小時</span>
				<span class="btn-span" info_field="deposit" search_time_type="2">今天</span>
				<span class="btn-span" info_field="deposit" search_time_type="3">前七天</span>
				<span class="btn-span" info_field="deposit" search_time_type="4">前30天</span>
			</div>
			<div class="clear"></div>
		</div>
		<div class="rank-title-div">
			<span>存款金額前10名</span>
		</div>
		<div id="deposit-rank-div" class="rank-content-div">
			<table class="rank-table"><tr><th>排名</th><th>會員帳號</th><th>存款金額</th></tr><tr><td>第一名</td><td>虛位以待</td><td>--</td></tr><tr><td>第二名</td><td>虛位以待</td><td>--</td></tr><tr><td>第三名</td><td>虛位以待</td><td>--</td></tr><tr><td>第四名</td><td>虛位以待</td><td>--</td></tr><tr><td>第五名</td><td>虛位以待</td><td>--</td></tr><tr><td>第六名</td><td>虛位以待</td><td>--</td></tr><tr><td>第七名</td><td>虛位以待</td><td>--</td></tr><tr><td>第八名</td><td>虛位以待</td><td>--</td></tr><tr><td>第九名</td><td>虛位以待</td><td>--</td></tr><tr><td>第十名</td><td>虛位以待</td><td>--</td></tr><tr><td>第十一名</td><td>虛位以待</td><td>--</td></tr><tr><td>第十二名</td><td>虛位以待</td><td>--</td></tr><tr><td>第十三名</td><td>虛位以待</td><td>--</td></tr><tr><td>第十四名</td><td>虛位以待</td><td>--</td></tr><tr><td>第十五名</td><td>虛位以待</td><td>--</td></tr><tr><td>第十六名</td><td>虛位以待</td><td>--</td></tr><tr><td>第十七名</td><td>虛位以待</td><td>--</td></tr><tr><td>第十八名</td><td>虛位以待</td><td>--</td></tr><tr><td>第十九名</td><td>虛位以待</td><td>--</td></tr><tr><td>第二十名</td><td>虛位以待</td><td>--</td></tr></table>
		</div>
	</div>

	<div class="rank-div">
		<div class="rank-bar-div">
			<div class="bar-title">會員排行榜</div>
			<div class="bar-btn">
				<span class="btn-span active" info_field="withdraw" search_time_type="1">1小時</span>
				<span class="btn-span" info_field="withdraw" search_time_type="2">今天</span>
				<span class="btn-span" info_field="withdraw" search_time_type="3">前七天</span>
				<span class="btn-span" info_field="withdraw" search_time_type="4">前30天</span>
			</div>
			<div class="clear"></div>
		</div>
		<div class="rank-title-div">
			<span>取款金額前10名</span>
		</div>
		<div id="withdraw-rank-div" class="rank-content-div">
			<table class="rank-table"><tr><th>排名</th><th>會員帳號</th><th>取款金額</th></tr><tr><td>第一名</td><td>虛位以待</td><td>--</td></tr><tr><td>第二名</td><td>虛位以待</td><td>--</td></tr><tr><td>第三名</td><td>虛位以待</td><td>--</td></tr><tr><td>第四名</td><td>虛位以待</td><td>--</td></tr><tr><td>第五名</td><td>虛位以待</td><td>--</td></tr><tr><td>第六名</td><td>虛位以待</td><td>--</td></tr><tr><td>第七名</td><td>虛位以待</td><td>--</td></tr><tr><td>第八名</td><td>虛位以待</td><td>--</td></tr><tr><td>第九名</td><td>虛位以待</td><td>--</td></tr><tr><td>第十名</td><td>虛位以待</td><td>--</td></tr><tr><td>第十一名</td><td>虛位以待</td><td>--</td></tr><tr><td>第十二名</td><td>虛位以待</td><td>--</td></tr><tr><td>第十三名</td><td>虛位以待</td><td>--</td></tr><tr><td>第十四名</td><td>虛位以待</td><td>--</td></tr><tr><td>第十五名</td><td>虛位以待</td><td>--</td></tr><tr><td>第十六名</td><td>虛位以待</td><td>--</td></tr><tr><td>第十七名</td><td>虛位以待</td><td>--</td></tr><tr><td>第十八名</td><td>虛位以待</td><td>--</td></tr><tr><td>第十九名</td><td>虛位以待</td><td>--</td></tr><tr><td>第二十名</td><td>虛位以待</td><td>--</td></tr></table>
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
        <script src="/templates/js/home/home.js?cache=130" type="text/javascript"></script>

    </body>
</html>