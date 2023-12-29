<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
	<!--<![endif]-->
	<!-- BEGIN HEAD -->
	<head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!--<meta content="width=device-width, initial-scale=1" name="viewport"/>-->
        <meta content="" name="description"/>
        <meta content="" name="keywords"/>
        <meta content="" name="author"/>
        <title>取款</title>
        <!-- BEGIN PAGE TOP STYLES -->
        <!-- END PAGE TOP STYLES -->
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
        <link href="/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="/assets/layouts/layout/css/self-layout.css" rel="stylesheet" type="text/css" />
        <link href="/assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="/assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <link href="/templates/css/style.css?cache=206" rel="stylesheet" type="text/css"/>
		<link href="/templates/css/tw_style.css?cache=205" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="/templates/css/cus_withdraw.css?c=105" >

        <!-- BEGIN PAGE FIRST SCRIPTS -->
        <script src="/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <!-- END PAGE FIRST SCRIPTS -->
        <!--<link rel="shortcut icon" href=""/>-->
	</head>
	<!-- END HEAD -->
	<body>
       <style>
html{
	overflow-y:auto;
}
</style>
<div class="page-inner-content">
	<!--slot=0-->
<div class="main-content">
	<form id="withdraw-form">
		<div class="amount-info-content">
			<!--div>可取款金額: 0 ~ 0</div-->
			<div>手續費: <font id="handling-fee">0</font></div>
			<div>行政費: <font id="admin-fee">0</font></div>
			<div>實際取款: <font id="actual-amount">0</font></div>
			<input type="hidden" id="handling-fee-type" value="0">
			<input type="hidden" id="handling-fee-percent" value="0">
			<input type="hidden" id="handling-fee-amount" value="0">
			<input type="hidden" id="is-free-withdraw" value="0">
			<input type="hidden" id="total-remain-audit-amount" value="0">
			<input type="hidden" id="admin-fee-percent" value="0">
		</div>
		<div class="cus-bank-info">
			選擇帳號:&nbsp;
			<select name="info_id" class="cus-bank-info-select">
				<option value="-1">= 請選擇 =</option>
				<!--slot=1-->
                <?php foreach ($banks as $bank) { ?>
                <option value="<?=$bank->id?>"><?=$bank->bank_name?>&nbsp;(<?=$bank->bank_account?>)</option>
                <?php } ?>

			</select>
		</div>
		<div class="apply-amount">
			取款金額:&nbsp;&nbsp;
			<input type="number" name="apply_amount" class="apply-amount-input" id="apply-amount-input" onkeyup="cmp_amount_info()">
		</div>
	</form>	
	<div class="send-btn" onclick="save_withdraw()">確認取款</div>
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
		<script src="/templates/js/kang_common.js?cache=106"></script>
		<script src="/templates/js/kang_all.js?cache=203"></script>
		<script src="/templates/js/lang/tw.js?cache=203"></script>
        <script src="/templates/js/cus_withdraw/cus_withdraw.js?cache=203" type="text/javascript"></script>

    </body>
</html>