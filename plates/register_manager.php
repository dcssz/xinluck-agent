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

.register-setting-table{
	width: 100%;
}
.register-setting-table th{
	background-color: #39a8a9;
	color: #FFF;
}
.register-setting-table th, .register-setting-table td{
	border: 1px solid #ccc;
	text-align: center;
	padding: 10px 0px;
}
.register-setting-table .notice-txt{
	color: red;
}
</style>
<div id="unique-btn-area">

</div>
<div class="portlet light bordered">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-group font-green-sharp"></i>
			<span class="caption-subject font-green-sharp bold uppercase">前台設定 - 註冊管理</span>
		</div>
		<button class="btn btn-danger event-btn" onclick="save_info()">儲存</button>
	</div>

	<div class="portlet-body">
		<form id="register-setting-form">
		   <table class="register-setting-table">
				<tr>
					<th>前台註冊欄位</th>
					<th>是否顯示</th>
					<th>是否必填</th>
				</tr>
				<tr>
					<td>會員帳號</td>
					<td>--</td>
					<td>--</td>
				</tr>
				<tr>
					<td>會員密碼</td>
					<td>--</td>
					<td>--</td>
				</tr>
				<tr>
					<td>會員姓名</td>
					<td>
						<input type="checkbox" name="config_content[customer_name][display]" value="1" <?=e($datas['customer_name']['is_show']) == 1 ? 'checked':''?>>
					</td>
					<td>
						<input type="checkbox" name="config_content[customer_name][required]" value="1" <?=e($datas['customer_name']['is_required']) == 1 ? 'checked':''?>>
					</td>
				</tr>
				<tr>
					<td>生日</td>
					<td>
						<input type="checkbox" name="config_content[birthday][display]" value="1" <?=e($datas['birthday']['is_show']) == 1 ? 'checked':''?>>
					</td>
					<td>
						<input type="checkbox" name="config_content[birthday][required]" value="1" <?=e($datas['birthday']['is_required']) == 1 ? 'checked':''?>>
					</td>
				</tr>
				<tr>
					<td>手機</td>
					<td>
						<input type="checkbox" name="config_content[cell_phone][display]" value="1" <?=e($datas['cell_phone']['is_show']) == 1 ? 'checked':''?>>
					</td>
					<td>
						<input type="checkbox" name="config_content[cell_phone][required]" value="1" <?=e($datas['cell_phone']['is_required']) == 1 ? 'checked':''?>>
					</td>
				</tr>
				<tr>
					<td>信箱</td>
					<td>
						<input type="checkbox" name="config_content[email][display]" value="1" <?=e($datas['email']['is_show']) == 1 ? 'checked':''?>>
					</td>
					<td>
						<input type="checkbox" name="config_content[email][required]" value="1" <?=e($datas['email']['is_required']) == 1 ? 'checked':''?>>
					</td>
				</tr>
				<tr>
					<td>Line</td>
					<td>
						<input type="checkbox" name="config_content[line][display]" value="1" <?=e($datas['line']['is_show']) == 1 ? 'checked':''?>>
					</td>
					<td>
						<input type="checkbox" name="config_content[line][required]" value="1" <?=e($datas['line']['is_required']) == 1 ? 'checked':''?>>
					</td>
				</tr>
				<tr>
					<td>Telegram</td>
					<td>
						<input type="checkbox" name="config_content[telegram][display]" value="1" <?=e($datas['telegram']['is_show']) == 1 ? 'checked':''?>>
					</td>
					<td>
						<input type="checkbox" name="config_content[telegram][required]" value="1" <?=e($datas['telegram']['is_required']) == 1 ? 'checked':''?>>
					</td>
				</tr>
				<tr>
					<td>Instagram</td>
					<td>
						<input type="checkbox" name="config_content[instagram][display]" value="1" <?=e($datas['instagram']['is_show']) == 1 ? 'checked':''?>>
					</td>
					<td>
						<input type="checkbox" name="config_content[instagram][required]" value="1" <?=e($datas['instagram']['is_required']) == 1 ? 'checked':''?>>
					</td>
				</tr>
				<tr>
					<td>QQ</td>
					<td>
						<input type="checkbox" name="config_content[qq][display]" value="1" <?=e($datas['qq']['is_show']) == 1 ? 'checked':''?>>
					</td>
					<td>
						<input type="checkbox" name="config_content[qq][required]" value="1" <?=e($datas['qq']['is_required']) == 1 ? 'checked':''?>>
					</td>
				</tr>
				<tr>
					<td>微信</td>
					<td>
						<input type="checkbox" name="config_content[wechat][display]" value="1" <?=e($datas['wechat']['is_show']) == 1 ? 'checked':''?>>
					</td>
					<td>
						<input type="checkbox" name="config_content[wechat][required]" value="1" <?=e($datas['wechat']['is_required']) == 1 ? 'checked':''?>>
					</td>
				</tr>
				<tr>
					<td>邀請碼</td>
					<td>
						<input type="checkbox" name="config_content[invite_code][display]" value="1" <?=e($datas['invite_code']['is_show']) == 1 ? 'checked':''?>>
					</td>
					<td>
						<input type="checkbox" name="config_content[invite_code][required]" value="1" <?=e($datas['invite_code']['is_required']) == 1 ? 'checked':''?>>
					</td>
				</tr>
				<tr>
					<td>手機驗證碼<div class="notice-txt">(須自行提供簡訊api相關資訊，才可使用發送簡訊的功能)</div></td>
					<td>
						<input type="checkbox" name="config_content[verification_code][display]" value="1" <?=e($datas['verification_code']['is_show']) == 1 ? 'checked':''?>>
					</td>
					<td>--</td>
				</tr>
			</table>
            <input type="hidden" id="edit-unique-code" name="edit_unique_code" value="3" />
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
        <script src="/templates/js/register/manager.js?cache=123" type="text/javascript"></script>

    </body>
</html>