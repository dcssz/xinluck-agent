
<!DOCTYPE html><!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]--><!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]--><!--[if !IE]><!--><html lang="en" class="no-js">	<!--<![endif]-->	<!-- BEGIN HEAD -->	<head>        <meta charset="utf-8"/>        <meta http-equiv="X-UA-Compatible" content="IE=edge">        <!--<meta content="width=device-width, initial-scale=1" name="viewport"/>-->        <meta content="" name="description"/>        <meta content="" name="keywords"/>        <meta content="" name="author"/>        <title>控端</title>        <!-- BEGIN PAGE TOP STYLES -->        <!-- END PAGE TOP STYLES -->        <!-- BEGIN GLOBAL MANDATORY STYLES -->        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />        <!-- END GLOBAL MANDATORY STYLES -->        <!-- BEGIN PAGE LEVEL PLUGINS -->        <link href="/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />        <!-- END PAGE LEVEL PLUGINS -->        <!-- BEGIN THEME GLOBAL STYLES -->        <link href="/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />        <link href="/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />        <!-- END THEME GLOBAL STYLES -->        <!-- BEGIN THEME LAYOUT STYLES -->        <link href="/assets/layouts/layout/css/self-layout.css" rel="stylesheet" type="text/css" />        <link href="/assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />        <link href="/assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />        <!-- END THEME LAYOUT STYLES -->        <link href="/templates/css/style.css?cache=209" rel="stylesheet" type="text/css"/>		<link href="/templates/css/tw_style.css?cache=205" rel="stylesheet" type="text/css"/>                <!-- BEGIN PAGE FIRST SCRIPTS -->        <script src="/assets/global/plugins/jquery.min.js" type="text/javascript"></script>        <!-- END PAGE FIRST SCRIPTS -->        <link rel="shortcut icon" href="#"/>	</head>	<!-- END HEAD -->	<body>       <div class="page-inner-content">
	<!--slot=0-->
<style>
.page-bar .act-group{
	float:left;
	margin-right:10px;
}
.setting-tb{
	margin-top:15px;

}
.setting-tb td{
	padding:10px;
	border: 1px solid #999;
}
.setting-tb td.title{
	font-weight:bold;
	font-size:16px;
	vertical-align:top;
	text-align: right;
}
.setting-tb div.inner-title{
	text-align: center;
    font-size: 16px;
    font-weight: bold;
    color: red;
}
.setting-tb .deposit-type-div{
	border: 1px solid #ccc;
    padding: 10px;
}
.setting-tb .discount-title{
	width:250px;
}

.fl-l{
	float: left;
}
.ml-10{
	margin-left: 10px;
}

input[type="radio"]{
	margin-left: -10px !important;
}
</style>
<div class="page-bar">
	<div class="act-group">
		<button class="btn btn-danger" type="button" onclick="save_site_msg()">確定儲存</button>
    </div>
    <div class="act-group">
		<button class="btn green-sharp btn-large" type="button" onclick="location.href='site_msg?edit_unique_code=3'">回上頁</button>
    </div>
</div>
<table id="all-post" class="setting-tb">
	
	<!-- <tr>
    	<td class="title">顯示順序(大至小)</td>
        <td><input type="text" is-post-data="1" name="site_msg_order" class="site-msg-order" value="<?=e($site_msg->sort)?>"></td>
    </tr> -->
    <!--slot=3-->

	<tr>
		<td>消息內容(繁體)</td>
		<td>
			<textarea name="site_msg_content[tw]" rows="4" style="width:400px;" class="site-msg-content" lang="tw">
				<?=e($site_msg->content)?>
			</textarea>
		</td>
	</tr>

	<tr>
    	<td class="title">發送方式</td>
        <td>
			<select name="site_msg_target" is-post-data="1">
                <!--slot=1-->
				<option  value="3" selected> 所有會員</option>

				<option  value="1" > 指定數個會員</option>

				<option  value="2" > 指定會員等級</option>
            </select>
		</td>
    </tr>

	<tr class="target-type-1">
    	<td class="title">指定會員帳號</td>
        <td>
			<input type="text" is-post-data="1" name="site_msg_username" value="" placeholder="請輸入會員帳號(發送多個帳號，請用','分隔)" style="width: 100%;"/>
		</td>
    </tr>

	<tr class="target-type-2">
    	<td class="title">指定會員等級</td>
        <td id="level_more">
            <input type="checkbox" id="level_all" is-post-data="1" class="item-ckbox" name="level_type_all" level-type="0" value="0" onchange="change_level_type_all();">全部
            <input type="checkbox" id="level_1" is-post-data="1" class="item-ckbox" name="level_type" level-type="1" value="1" onchange="change_level_type();">一般會員
            <input type="checkbox" id="level_2" is-post-data="1" class="item-ckbox" name="level_type" level-type="2" value="2" onchange="change_level_type();">黃金VIP2
        </td>
    </tr>

	<tr>
		<td class="title">彈窗類型</td>
        <td>
			<select name="site_msg_windows_type" is-post-data="1">
                <!--slot=1-->
				<option  value="0" selected> 無</option>
				
				<option  value="1" > 彈出小窗</option>
            </select>
		</td>
    </tr>
    
</table>
<input type="hidden" id="etype" value="edit" />
<input type="hidden" id="edit-site-msg-id" value="<?=e($site_msg->id)?>" />
<input type="hidden" id="edit-unique-code" name="edit_unique_code" value="3" />
<script>
$(function(){
	$("input[name=level_type_all][level-type=0]").prop("checked",true);
	$("input[name=level_type_all][level-type=0]").attr("class","checked");
	change_level_type_all();
	datetime_picker_init();

	$(".target-type-1").hide();
	$(".target-type-2").hide();

});
</script>

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
        <script src="/kindeditor/kindeditor-all-min.js" type="text/javascript"></script>
<script src="/kindeditor/lang/zh-TW.js" type="text/javascript"></script>
<script src="/templates/js/site_msg/editor.js?cache=168" type="text/javascript"></script>

    </body>
</html>