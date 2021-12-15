<!DOCTYPE html><!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]--><!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]--><!--[if !IE]><!--><html lang="en" class="no-js">	<!--<![endif]-->	<!-- BEGIN HEAD -->	<head>        <meta charset="utf-8"/>        <meta http-equiv="X-UA-Compatible" content="IE=edge">        <!--<meta content="width=device-width, initial-scale=1" name="viewport"/>-->        <meta content="" name="description"/>        <meta content="" name="keywords"/>        <meta content="" name="author"/>        <title>控端</title>        <!-- BEGIN PAGE TOP STYLES -->        <!-- END PAGE TOP STYLES -->        <!-- BEGIN GLOBAL MANDATORY STYLES -->        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />        <!-- END GLOBAL MANDATORY STYLES -->        <!-- BEGIN PAGE LEVEL PLUGINS -->        <link href="/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />        <!-- END PAGE LEVEL PLUGINS -->        <!-- BEGIN THEME GLOBAL STYLES -->        <link href="/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />        <link href="/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />        <!-- END THEME GLOBAL STYLES -->        <!-- BEGIN THEME LAYOUT STYLES -->        <link href="/assets/layouts/layout/css/self-layout.css" rel="stylesheet" type="text/css" />        <link href="/assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />        <link href="/assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />        <!-- END THEME LAYOUT STYLES -->        <link href="/templates/css/style.css?cache=209" rel="stylesheet" type="text/css"/>		<link href="/templates/css/tw_style.css?cache=205" rel="stylesheet" type="text/css"/>                <!-- BEGIN PAGE FIRST SCRIPTS -->        <script src="/assets/global/plugins/jquery.min.js" type="text/javascript"></script>        <!-- END PAGE FIRST SCRIPTS -->        <link rel="shortcut icon" href="#"/>	</head>	<!-- END HEAD -->	<body>       <div class="page-inner-content">
	<!--slot=0-->
<style>
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

.editor-table {
	margin: 0 auto;
    width: 80%;
    max-width: 80%;
}

.editor-table .title {
	padding: 10px;
	font-size: 24px !important;
}
.editor-table td:nth-child(1) {
	white-space: nowrap;
}

#editor-item-div, #excel-item-div{
	padding:  10px;
}
.excel-table {
	margin: 0 auto;
    width: 80%;
    max-width: 80%;
}

.excel-table .title {
	padding: 10px;
	font-size: 24px !important;
}
.excel-table td {
	padding: 5px;
	text-align:center;
	white-space: nowrap;
	vertical-align: middle !important;
}
.status-btn {
    display: inline-block;
    padding: 2px 5px;
    text-decoration: none;
    font-family: "微軟正黑體";
}

.status-btn:hover, .status-btn:focus{
    color: #FFF !important;
	text-decoration: none !important;
}

.status-open {
    color: #FFF;
    background-color: green;
    text-align: center;
}

.status-close {
    color: #FFF;
    background-color: red;
    text-align: center;
}
.nowrap{
	white-space: nowrap;
}
.min-w-400{
	min-width: 400px;
}
.upload-excel-area, .download-excel-area{
	float: left;
	margin-left: 10px;
	margin-top: 4px;
}
.upload-excel-area #up-btn{
    position: relative;
    overflow: hidden;
    margin-right: 4px;
    display: inline-block;
    padding: 4px 10px 4px;
    font-size: 14px;
    color: #fff;
    text-align: center;
    vertical-align: middle;
    cursor: pointer;
    background-color: #5bb75b;
    border: 1px solid #cccccc;
    border-color: #e6e6e6 #e6e6e6 #bfbfbf;
    border-bottom-color: #b3b3b3;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
}
.upload-excel-area #excel-upload {
	position: absolute;
	top: 0;
	right: 0;
	margin: 0;
	border: solid transparent;opacity: 0;
	filter:alpha(opacity=0);
	cursor: pointer;
}
.download-excel-area #down-btn {
    position: relative;
    overflow: hidden;
    margin-right: 4px;
    display: inline-block;
    padding: 4px 10px 4px;
    font-size: 14px;
    color: #fff;
    text-align: center;
    vertical-align: middle;
    cursor: pointer;
    background-color: #B75;
    border: 1px solid #cccccc;
    border-color: #e6e6e6 #e6e6e6 #bfbfbf;
    border-bottom-color: #b3b3b3;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
}
</style>
<div class="page-bar">
	<div class="act-group hidden">
    	<button class="btn green-sharp btn-large " onclick="parent.goIframeHistoryBack(this, event);"> <i class="fa fa-mail-reply"></i> <font class="">回上頁</font> </button>
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
		<input type="text" name="search_customer_userid" value="">
    </div>
	<div class="act-group">
		<span>模糊搜尋<input type="checkbox" name="fuzzy_search" value="1" /></span>
    </div>
	<div class="act-group">
		<span>狀態</span>&nbsp;
		<select name="search_status">
			<option value="-1">全部</option>
			<option value="1">啟用</option>
			<option value="2">凍結</option>
		</select>
    </div>
    <div class="act-group">
		<span>邀請碼</span>&nbsp;
		<input type="text" name="search_invite_code" value="">
    </div>
	<div class="act-group">
        <button type="button" class="btn btn-success search-btn" value="search">
            <i class="fa fa-search"></i> 查詢
        </button>
    </div>
</div>
<div class="portlet light bordered">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-group font-green-sharp"></i>
			<span class="caption-subject font-green-sharp bold uppercase">會員管理 - 資金調度</span>

            <!--<div class="excel-notes"><!--</div>-->
		</div>
		<div class="upload-excel-area">
			<form id="excel-form" method="post" enctype="multipart/form-data" action="upload_excel.php">
				<div id="up-btn" class="btn">
					<span>匯入Excel</span>
					<input id="excel-upload" type="file" accept=".xlsx" name="excel_upload">
					<input type="hidden" name="post_php" value="adjust_quota_manager">
				</div>
                <div id="excel-item-div" style="display: none;"></div>
			</form>
		</div>
        <div class="download-excel-area">
			<div id="down-btn" class="btn">
                <span onclick="location.href='download.php';">下載範本</span>
            </div>
		</div>
	</div>

	<div class="portlet-body">
       <div id="sample_2_wrapper" class="dataTables_wrapper">
			<div class="table-container">
            	<table class="table table-striped table-bordered table-hover order-column" id="manager_table">
                	<thead>
                    	<tr class="bg-green1 color-white">
							<th>帳號</th>
							<th>上層總代</th>
							<th>上層代理</th>
							<th>狀態</th>
							<th>總餘額</th>
                            <th>等級</th>
                            <th>邀請碼</th>
                            <th>功能</th>
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
<div id="editor-item-div" style="display: none;">

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
        <script src="/templates/js/jquery.wallform.js?c=6" type="text/javascript"></script>
<script src="/templates/js/adjust_quota/manager.js?cache=228" type="text/javascript"></script>

    </body>
</html>