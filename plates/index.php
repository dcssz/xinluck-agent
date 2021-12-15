
<!DOCTYPE html><!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]--><!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]--><!--[if !IE]><!--><html lang="en" class="no-js">	<!--<![endif]-->	<!-- BEGIN HEAD -->	<head>        <meta charset="utf-8"/>        <meta http-equiv="X-UA-Compatible" content="IE=edge">        <!--<meta content="width=device-width, initial-scale=1" name="viewport"/>-->        <meta content="" name="description"/>        <meta content="" name="keywords"/>        <meta content="" name="author"/>        <title>首頁</title>        <!-- BEGIN PAGE TOP STYLES -->        <!-- END PAGE TOP STYLES -->        <!-- BEGIN GLOBAL MANDATORY STYLES -->        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />        <!-- END GLOBAL MANDATORY STYLES -->        <!-- BEGIN PAGE LEVEL PLUGINS -->        <link href="/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />        <!-- END PAGE LEVEL PLUGINS -->        <!-- BEGIN THEME GLOBAL STYLES -->        <link href="/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />        <link href="/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />        <!-- END THEME GLOBAL STYLES -->        <!-- BEGIN THEME LAYOUT STYLES -->        <link href="/assets/layouts/layout/css/self-layout.css" rel="stylesheet" type="text/css" />        <link href="/assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />        <link href="/assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />        <!-- END THEME LAYOUT STYLES -->        <link href="/templates/css/style.css?cache=204" rel="stylesheet" type="text/css"/>		<link href="/templates/css/tw_style.css?cache=204" rel="stylesheet" type="text/css"/>                <!-- BEGIN PAGE FIRST SCRIPTS -->        <script src="/assets/global/plugins/jquery.min.js" type="text/javascript"></script>        <!-- END PAGE FIRST SCRIPTS -->        <!--<link rel="shortcut icon" href=""/>-->	</head>	<!-- END HEAD -->	<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-sidebar-fixed">       <!--BEGIN HEADER-->
<!--slot0-->
<script>
$(function(){

})
</script>

<!--END HEADER-->
<div class="clearfix">
</div>
<!--BEGIN CONTAINER-->
<div class="page-container">
	<!--BEGIN SIDEBAR-->
	<!--slot=0-->
<style>
.page-sidebar-wrapper .online-cus-div{
	padding: 10px 12px 10px 10px;
    font-size: 15px;
    background-color: brown;
	color:#fff;
}
.page-sidebar-wrapper #online-cus-count{
	background-color: #fff;
    padding: 5px 10px;
    border-radius: 10px;
    color: #222;
    font-weight: bold;
}
.page-sidebar-wrapper .chang-lang-div{
    padding: 10px;
    text-align: center;
}

.page-sidebar-wrapper .mobile-menu-div{
	text-align: right;
    font-weight: bold;
    color: #FFF;
    font-size: 20px;
	padding: 10px 3px 10px 10px;
	background-color: #000;
}
</style>
<div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse" id="left-menu">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 0px !important;">
            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
            <li class="sidebar-toggler-wrapper hide">
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                <div class="sidebar-toggler"> </div>
                <!-- END SIDEBAR TOGGLER BUTTON -->
            </li>

            <li class="nav-item">
                <div class="online-cus-div" style="">
                	線上人數: <font id='online-cus-count'>0</font>
                </div>
            </li>
			<li class="nav-item">
                <div class="chang-lang-div">
					<select id="change-lang" onchange="change_lang(this.value);">
						<!--slot=4-->

<option value="tw" selected>繁體中文</option>


					</select>
				</div>
            </li>
            <!--slot=1-->
<li class="nav-item ">
    <a href="javascript:void(0);" class="nav-link nav-toggle" title_name="帳號管理" >
        <i class=""></i>
        <span class="title">帳號管理</span>
        
        
    </a>
    <!--slot=2-->
<ul class="sub-menu">
	
    <li class="nav-item ">
        <a href="javascript:void(0);" class="nav-link " title_name="個人資料" onclick="show_page(this, 'personal_info', '/agent/personal_info')">
            <i class=""></i>
            <span class="title">個人資料</span>
            
        </a>
        
    </li>
	
    <li class="nav-item ">
        <a href="javascript:void(0);" class="nav-link " title_name="代理" onclick="show_page(this, 'agent_info_manager_15', '/agent/agent_info_manager?edit_cus_level=15')">
            <i class=""></i>
            <span class="title">代理</span>
            
        </a>
        
    </li>
	
    <li class="nav-item ">
        <a href="javascript:void(0);" class="nav-link " title_name="會員" onclick="show_page(this, 'cus_info_manager', '/agent/cus_info_manager?edit_cus_level=16')">
            <i class=""></i>
            <span class="title">會員</span>
            
        </a>
        
    </li>
	
    <li class="nav-item ">
        <a href="javascript:void(0);" class="nav-link " title_name="子帳號" onclick="show_page(this, 'sub_customer_manager', '/agent/sub_customer_manager')">
            <i class=""></i>
            <span class="title">子帳號</span>
            
        </a>
        
    </li>
	
</ul>

</li>
<!--slot=1-->
<li class="nav-item ">
    <a href="javascript:void(0);" class="nav-link nav-toggle" title_name="報表管理" >
        <i class=""></i>
        <span class="title">報表管理</span>


    </a>
    <!--slot=2-->
<ul class="sub-menu">
 

    <li class="nav-item ">
        <a href="javascript:void(0);" class="nav-link " title_name="會員資金明細報表" onclick="show_page(this, 'cus_quota_log_manager', '/agent/cus_quota_log_manager')">
            <i class=""></i>
            <span class="title">會員資金明細報表</span>

        </a>

    </li>

    <li class="nav-item ">
        <a href="javascript:void(0);" class="nav-link " title_name="代理資金明細報表" onclick="show_page(this, 'agent_quota_log_manager', '/agent/agent_quota_log_manager')">
            <i class=""></i>
            <span class="title">代理資金明細報表</span>

        </a>

    </li>

    <li class="nav-item ">
        <a href="javascript:void(0);" class="nav-link " title_name="總報表" onclick="show_page(this, 'all_calc_report_manager', '/agent/all_calc_report_manager')">
            <i class=""></i>
            <span class="title">總報表</span>

        </a>

    </li>

    <li class="nav-item ">
        <a href="javascript:void(0);" class="nav-link " title_name="遊戲報表" onclick="show_page(this, 'game_report_manager', '/agent/game_report_manager')">
            <i class=""></i>
            <span class="title">遊戲報表</span>

        </a>

    </li>

    <li class="nav-item ">
        <a href="javascript:void(0);" class="nav-link " title_name="會員即時投注" onclick="show_page(this, 'cus_instant_bet_info_manager', '/agent/cus_instant_bet_info_manager')">
            <i class=""></i>
            <span class="title">會員即時投注</span>

        </a>

    </li>

    <li class="nav-item ">
        <a href="javascript:void(0);" class="nav-link " title_name="會員投注紀錄" onclick="show_page(this, 'cus_bet_info_manager', '/agent/cus_bet_info_manager')">
            <i class=""></i>
            <span class="title">會員投注紀錄</span>

        </a>

    </li>

    <li class="nav-item ">
        <a href="javascript:void(0);" class="nav-link " title_name="會員輸贏報表" onclick="show_page(this, 'cus_report_manager', '/agent/cus_report_manager')">
            <i class=""></i>
            <span class="title">會員輸贏報表</span>

        </a>

    </li>

     
</ul>

</li>

<li class="nav-item ">
    <a href="javascript:void(0);" class="nav-link nav-toggle" title_name="系統公告" onclick="show_page(this, 'news', '/agent/news')">
        <i class=""></i>
        <span class="title">系統公告</span>
        
        
    </a>
    
</li>

<li class="nav-item ">
    <a href="javascript:void(0);" class="nav-link nav-toggle" title_name="銀行卡" onclick="show_page(this, 'cus_bank_info', '/agent/cus_bank_info')">
        <i class=""></i>
        <span class="title">銀行卡</span>
        
        
    </a>
    
</li>
<!--slot=1-->
<li class="nav-item ">
    <a href="javascript:void(0);" class="nav-link nav-toggle" title_name="取款申請" onclick="show_page(this, 'cus_withdraw', '/agent/cus_withdraw')">
        <i class=""></i>
        <span class="title">取款申請</span>
        
        
    </a>
    
</li>
<!--slot=1-->
<li class="nav-item ">
    <a href="javascript:void(0);" class="nav-link nav-toggle" title_name="在線會員查詢" onclick="show_page(this, 'online_cus_manager', '/agent/online_cus_manager')">
        <i class=""></i>
        <span class="title">在線會員查詢</span>
        
        
    </a>
    
</li>
<!--slot=1-->
<li class="nav-item ">
    <a href="javascript:void(0);" class="nav-link nav-toggle" title_name="資金明細" onclick="show_page(this, 'self_quota_log_manager', '/agent/self_quota_log_manager')">
        <i class=""></i>
        <span class="title">資金明細</span>
        
        
    </a>
    
</li>
 
<!--slot=1-->
<li class="nav-item ">
    <a href="logout" class="nav-link nav-toggle" title_name="登出" >
        <i class=""></i>
        <span class="title">登出</span>


    </a>

</li>

        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
<script>
	$(function(){page2initial_url_arr = {"home":"/agent/home","news_manager":"/agent/news","marquee_manager":"/agent/marquee","site_msg_manager":"/agent/site_message","banner_manager":"/agent/banner","register_manager":"/agent/register","sys_service_set_manager":"/agent/sys_service","cus_info_manager":"/agent/customer_info?edit_cus_level=16","cus_bank_info_manager":"/agent/customer_bank_info","cus_grade_manager":"/agent/customer_grade","cus_mark_manager":"/agent/customer_mark","adjust_quota_manager":"/agent/adjust_quota","online_cus_manager":"/agent/online_customer","agent_info_manager_14":"/agent/agent_info?edit_cus_level=14","agent_info_manager_15":"agent_info_manager.php?edit_cus_level=15","effect_cus_rule_manager":"effect_cus_rule_manager.php","commission_rule_manager":"commission_rule_manager.php","retreat_rule_manager":"retreat_rule_manager.php","extra_commission_rule_manager":"extra_commission_rule_manager.php","period_manager":"period_manager.php","period_audit_manager":"period_audit_manager.php","game_store_info_manager":"game_store_info_manager.php","game_category_info_manager":"game_category_info_manager.php","game_mark_manager":"game_mark_manager.php","game_category_gain_manager":"game_category_gain_manager.php","payment_pattern_manager":"payment_pattern_manager.php","sys_payment_manager":"sys_payment_manager.php","payment_merchant_manager":"payment_merchant_manager.php","payment_company_manager":"payment_company_manager.php","merchant_deposit_orders_manager":"merchant_deposit_orders_manager.php","company_deposit_orders_manager":"company_deposit_orders_manager.php","mem_withdraw_orders_manager":"mem_withdraw_orders_manager.php","agent_withdraw_orders_manager":"agent_withdraw_orders_manager.php","manual_payment_manager":"manual_payment_manager.php","cus_withdraw_audit_manager":"cus_withdraw_audit_manager.php","discount_category_manager":"discount_category_manager.php","discount_manager":"discount_manager.php","cus_discount_audit_manager":"cus_discount_audit_manager.php","cus_retreat_set_manager":"cus_retreat_set_manager.php","cus_retreat_audit_manager":"cus_retreat_audit_manager.php","cus_wd_quota_log_manager":"cus_wd_quota_log_manager.php","cus_quota_log_manager":"cus_quota_log_manager.php","agent_quota_log_manager":"agent_quota_log_manager.php","all_calc_report_manager":"all_calc_report_manager.php","game_report_manager":"game_report_manager.php","cus_instant_bet_info_manager":"cus_instant_bet_info_manager.php","cus_bet_info_manager":"cus_bet_info_manager.php","cus_report_manager":"cus_report_manager.php","agent_report_manager":"agent_report_manager.php?ckout_item=1","change_order_logs_manager":"change_order_logs_manager.php","cus_ip_manager":"cus_ip_manager.php","employee_manager":"employee_manager.php","sys_func_set_manager":"sys_func_set_manager.php"};});
</script>

	<!--END SIDEBAR-->
    <!--BEGIN CONTENT-->
	<div class="page-content-wrapper">
    	<div class="page-content">
    		<!--slot=0-->
<style>
.page-content-wrapper .page-content {
	padding-top: 0px !important;
}
#iframe-div{
	margin-top: 10px;
	background-color: #FFF;
	/*overflow-y:auto;*/
}

#iframe-div .its-iframe{
	width: 100%;
    height: 100%;
	border: none;
}

#iframe-change-btn-div .change-btn-span {
    padding: 4px 6px;
    text-decoration: none;
    margin-right: 10px;
    border: 1px solid #337ab7!important;
	border-radius: 15px!important;
    color: #337ab7;
    font-weight: bold;
    font-family: "微軟正黑體";
	cursor: pointer;
	display: inline-block;
	background-color: #FFF;
}
#iframe-change-btn-div .del-all-btn-span {
    color: #fff;
    background-color: red;
    padding: 4px 6px;
    text-decoration: none;
    margin-right: 10px;
    font-weight: bold;
    font-family: "微軟正黑體";
    cursor: pointer;
    display: inline-block;
}

#iframe-change-btn-div .change-btn-span.active {
    background-color: #337ab7;
    color: #FFF;
}

#iframe-change-btn-div .reload-icon {
	width: 14px;
	margin-bottom: 3px;
	cursor: pointer;
}
#iframe-change-btn-div .delete-item {
	margin-left: 5px
}

#iframe-change-btn-div .reload-icon.active {
    animation: rotate 1.5s linear infinite;
}
#fast-menu-btn-div{
	padding:10px;
	margin-bottom:10px;
	/*text-align: right;*/
    background-color: darkslateblue;
	color:#fff;
}
#fast-menu-btn-div .time-bar{
	float:left;
}
#fast-menu-btn-div .menu-btn{
	float:right;
	margin-left: 20px;
	cursor:pointer;
	position: relative;
}
#fast-menu-btn-div .menu-btn .immediate_total_outer{
	position: absolute;
    top: -10px;
    right: -15px;
    background-color: red;
    border-radius: 25px !important;
    padding: 0px 3px;
	width: 30px;
    text-align: center;
}
</style>
<div id="fast-menu-btn-div">
	<span class="time-bar">
    	現在時間：<span id="now-time">2021-12-15 16:41:04</span>
    </span>
	<span class="menu-btn" style="color: white;">       
        <marquee scrollamount="5" width="80%"><span style="color:#FFF;"></span></marquee>
        <div style="font-size: 15px; color: #FFF; float: right; margin-left: 20px;">[代理]&nbsp;&nbsp;<a style="color:gold; text-decoration: underline;" href="javascript:void(0);" title_name="個人資料" onclick="show_page(this, 'personal_info', 'personal_info')"><?=$_SESSION['username']?></a>&nbsp;&nbsp;</div>
    </span>
    <div class="clear"></div>
</div>
<div id="iframe-change-btn-div">
	<span id="del-all-btn" class="del-all-btn-span" onclick="delete_all_page()">清除
		<i class="fa fa-trash-o"></i>
	</span>
	<span id="home_span" class="change-btn-span active" onclick="change_page('home')">系統公告
		<img src="/templates/images/reload-red-32.ico" class="reload-icon active" onclick="reload_page(this, 'home');">
	</span>
</div>
<div id="iframe-div">
	<iframe id="home_iframe" src="/agent/news" class="its-iframe"></iframe>
</div>
<audio id="msg-sound-1">
	<source src="audio/msg_sound1.mp3" type="audio/mpeg">
</audio>

        </div>
	</div>
	<!--END CONTENT-->
</div>
<!--END CONTAINER-->
<!--BEGIN FOOTER-->
<!--slot0-->

<!--END FOOTER-->

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
		<script src="/templates/js/kang_common.js?cache=104"></script>
		<script src="/templates/js/kang_all.js?cache=203"></script>
		<script src="/templates/js/lang/tw.js?cache=203"></script>
        <script src="/templates/js/index/index.js?cache=140" type="text/javascript"></script>

    </body>
</html>