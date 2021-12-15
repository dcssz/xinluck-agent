<!DOCTYPE html><!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]--><!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]--><!--[if !IE]><!--><html lang="en" class="no-js">	<!--<![endif]-->	<!-- BEGIN HEAD -->	<head>        <meta charset="utf-8"/>        <meta http-equiv="X-UA-Compatible" content="IE=edge">        <!--<meta content="width=device-width, initial-scale=1" name="viewport"/>-->        <meta content="" name="description"/>        <meta content="" name="keywords"/>        <meta content="" name="author"/>        <title>銀行卡</title>        <!-- BEGIN PAGE TOP STYLES -->        <!-- END PAGE TOP STYLES -->        <!-- BEGIN GLOBAL MANDATORY STYLES -->        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />        <!-- END GLOBAL MANDATORY STYLES -->        <!-- BEGIN PAGE LEVEL PLUGINS -->        <link href="/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />        <!-- END PAGE LEVEL PLUGINS -->        <!-- BEGIN THEME GLOBAL STYLES -->        <link href="/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />        <link href="/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />        <!-- END THEME GLOBAL STYLES -->        <!-- BEGIN THEME LAYOUT STYLES -->        <link href="/assets/layouts/layout/css/self-layout.css" rel="stylesheet" type="text/css" />        <link href="/assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />        <link href="/assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />        <!-- END THEME LAYOUT STYLES -->        <link href="/templates/css/style.css?cache=206" rel="stylesheet" type="text/css"/>		<link href="/templates/css/tw_style.css?cache=205" rel="stylesheet" type="text/css"/>        <link rel="stylesheet" type="text/css" href="/templates/css/cus_bank_info.css?c=105" >
        <!-- BEGIN PAGE FIRST SCRIPTS -->        <script src="/assets/global/plugins/jquery.min.js" type="text/javascript"></script>        <!-- END PAGE FIRST SCRIPTS -->        <!--<link rel="shortcut icon" href=""/>-->	</head>	<!-- END HEAD -->	<body>       <style>
html{
	overflow-y:auto;
}
</style>
<div class="page-inner-content">
	<!--slot=0-->
<div class="main-content">
	<table class="cus-bank-info-list-tb">
		<!--slot=3-->


	</table>
	<div class="add-btn" onclick="add_cus_bank_info();">添加</div>
</div>
<div id="edit-cus-bank-info-area">
	<form id="edit-form">
		<table class="cus-bank-info-editor-tb">
			<tr>
				<td class="title">地區</td>
				<td>
					<select class="select-v1" onchange="change_bank_area(this.value)" id="back-area-select">
						<option value='-1'>請選擇</option>
						<option value='taiwan'>台灣</option>
					</select>
				</td>
			</tr>
			<tr>
				<td class="title">開戶銀行</td>
				<td>
					<select name="bank_name" class="select-v1" id="bank-name-select">
					</select>
				</td>
			</tr>
			<tr class="hidden">
				<td class="title">開戶省/市</td>
				<td>
					<select name="bank_province" class="select-v1" onchange="change_bank_province();">
						<!--JSO SELECT_BANK_PROVINCE_CONTENT -->
					</select>
					<select name="bank_city" class="select-v1">
						<!--JSO SELECT_BANK_CITY_CONTENT -->
					</select>
				</td>
			</tr>
			<tr>
				<td class="title">開戶支行</td>
				<td>
					<input type="text" name="bank_branch" class="input-v1" value="">
				</td>
			</tr>
			<tr>
				<td class="title">開戶姓名</td>
				<td>
					<input type="text" name="account_name" class="input-v1" value="">
				</td>
			</tr>
			<tr>
				<td class="title">銀行卡號</td>
				<td>
					<input type="text" name="bank_account" class="input-v1" value="">
				</td>
			</tr>
		</table>
	</form>
	<div class="save-btn" onclick="save_cus_bank_info();">儲存</div>
</div>
<input type="hidden" id="is-show-1" value="-1">
<div id="show-cus-bank-info-detail-area">
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
        <script src="layer/layer.js"></script>
        <script src="templates/js/kang_ajax.js?cache=102"></script>
		<script src="templates/js/kang_common.js?cache=104"></script>
		<script src="templates/js/kang_all.js?cache=203"></script>
		<script src="templates/js/lang/tw.js?cache=203"></script>
        <script src="templates/js/bank.js?c=101" type="text/javascript"></script>
<script src="templates/js/cus_bank_info/cus_bank_info.js?cache=4" type="text/javascript"></script>

    </body>
</html>