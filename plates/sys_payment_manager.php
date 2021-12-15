
<!DOCTYPE html><!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]--><!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]--><!--[if !IE]><!--><html lang="en" class="no-js">	<!--<![endif]-->	<!-- BEGIN HEAD -->	<head>        <meta charset="utf-8"/>        <meta http-equiv="X-UA-Compatible" content="IE=edge">        <!--<meta content="width=device-width, initial-scale=1" name="viewport"/>-->        <meta content="" name="description"/>        <meta content="" name="keywords"/>        <meta content="" name="author"/>        <title>控端</title>        <!-- BEGIN PAGE TOP STYLES -->        <!-- END PAGE TOP STYLES -->        <!-- BEGIN GLOBAL MANDATORY STYLES -->        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />        <!-- END GLOBAL MANDATORY STYLES -->        <!-- BEGIN PAGE LEVEL PLUGINS -->        <link href="/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />        <!-- END PAGE LEVEL PLUGINS -->        <!-- BEGIN THEME GLOBAL STYLES -->        <link href="/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />        <link href="/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />        <!-- END THEME GLOBAL STYLES -->        <!-- BEGIN THEME LAYOUT STYLES -->        <link href="/assets/layouts/layout/css/self-layout.css" rel="stylesheet" type="text/css" />        <link href="/assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />        <link href="/assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />        <!-- END THEME LAYOUT STYLES -->        <link href="/templates/css/style.css?cache=209" rel="stylesheet" type="text/css"/>		<link href="/templates/css/tw_style.css?cache=205" rel="stylesheet" type="text/css"/>                <!-- BEGIN PAGE FIRST SCRIPTS -->        <script src="/assets/global/plugins/jquery.min.js" type="text/javascript"></script>        <!-- END PAGE FIRST SCRIPTS -->        <link rel="shortcut icon" href="#"/>	</head>	<!-- END HEAD -->	<body>       <div class="page-inner-content">
	<!--slot=0-->
<style>
.portlet.light.bordered 
{
	margin-top:0px;
}
	
.portlet.light.bordered .event-btn 
{
	margin-left: 20px;
}
.portlet-body 
{
	padding-top:0px !important;
	display: block;
} 
.set-title{
	padding: 10px;
    background-color: #4e6cff;
    color: #FFF;
    border-radius: 25px !important;
}
.mr-b-10{
	margin-bottom: 10px;
}
input{
	text-align: right;
	width: 80px;
}
</style>
<div class="portlet light bordered">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-group font-green-sharp"></i>
			<span class="caption-subject font-green-sharp bold uppercase">金流設定 - 出入款管理設定</span>
		</div>
		<button class="btn btn-danger event-btn" onclick="save_info()">儲存</button>
	</div>
    
	<div class="portlet-body">
		<form id="payment-setting-form">
        	<div class="pd-5 mr-b-10">
            	<span class="set-title">充值設定</span>
            </div>
            <div class="pd-5">
				<span>快速儲值設定</span>
				<div class="pd-5">
					<input type="text" name="config_content[amount][]" value="1000">
					<input type="text" name="config_content[amount][]" value="2000">
					<input type="text" name="config_content[amount][]" value="5000">
				</div>
				<div class="pd-5">
					<input type="text" name="config_content[amount][]" value="10000">
					<input type="text" name="config_content[amount][]" value="50000">
					<input type="text" name="config_content[amount][]" value="100000">
				</div>
			</div>
            <div class="pd-5">
				<span>稽核倍數</span>
				<span><input type="text" name="config_content[audit_multiple]" value="1"></span><span class="color-red1 nowrap">&nbsp;(設置0則充值不用打流水)</span>
			</div>
            <div class="pd-5">
				<span>商戶重複提交訂單</span>
				<span><input type="checkbox" name="config_content[merchant_is_repeated_submit]" value="1" ></span>
			</div>
            <div class="pd-5">
				<span>線下重複提交訂單</span>
				<span><input type="checkbox" name="config_content[company_is_repeated_submit]" value="1" ></span>
			</div>
            
            <div class="pd-5">
				<span>是否使用彈窗公告</span>
				<span><input type="checkbox" name="config_content[deposit_is_alert_news]" value="1" ></span>
			</div>
            <!--slot=2-->

<div class="pd-5">
    <span>彈窗公告內容(繁體)</span>
</div>
<div class="pd-5">
    <span><textarea name="config_content[deposit_news_content][tw]">帥哥你好</textarea></span>
</div>


            
            <hr>
            
            <div class="pd-5 mr-b-10">
            	<span  class="set-title">取款設定</span>
            </div>
			<div class="pd-5">
				<span>行政費用</span>&nbsp;<input type="text" name="config_content[admin_fee_percent]" value="0"> %
			</div>
            <div class="pd-5">
				<span>會員取款手續費類型</span>&nbsp;
                <select name="config_content[handling_fee_type]">
					<option value="1" selected>手續費率</option>
					<option value="2" >固定手續費</option>
            	</select>
			</div>
            <div class="pd-5">
				<span>會員手續費率</span>&nbsp;
                <span><input type="text" name="config_content[handling_fee_percent]" value="5"></span> %
			</div>
            <div class="pd-5">
				<span>會員固定手續費</span>&nbsp;
                <span><input type="text" name="config_content[handling_fee_amount]" value="0"></span>
			</div>
            
            <div class="pd-5">
				<span>是否使用彈窗公告</span>
				<span><input type="checkbox" name="config_content[withdraw_is_alert_news]" value="1" ></span>
			</div>
            <!--slot=2-->

<div class="pd-5">
    <span>彈窗公告內容(繁體)</span>
</div>
<div class="pd-5">
    <span><textarea name="config_content[withdraw_news_content][tw]">帥哥掰掰</textarea></span>
</div>


		</form>
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
        <script src="/templates/js/sys_payment/manager.js?cache=124" type="text/javascript"></script>

    </body>
</html>