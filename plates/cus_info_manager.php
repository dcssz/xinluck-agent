
<!DOCTYPE html><!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]--><!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]--><!--[if !IE]><!--><html lang="en" class="no-js">	<!--<![endif]-->	<!-- BEGIN HEAD -->	<head>        <meta charset="utf-8"/>        <meta http-equiv="X-UA-Compatible" content="IE=edge">        <!--<meta content="width=device-width, initial-scale=1" name="viewport"/>-->        <meta content="" name="description"/>        <meta content="" name="keywords"/>        <meta content="" name="author"/>        <title>控端</title>        <!-- BEGIN PAGE TOP STYLES -->        <!-- END PAGE TOP STYLES -->        <!-- BEGIN GLOBAL MANDATORY STYLES -->        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />        <!-- END GLOBAL MANDATORY STYLES -->        <!-- BEGIN PAGE LEVEL PLUGINS -->        <link href="/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />        <!-- END PAGE LEVEL PLUGINS -->        <!-- BEGIN THEME GLOBAL STYLES -->        <link href="/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />        <link href="/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />        <!-- END THEME GLOBAL STYLES -->        <!-- BEGIN THEME LAYOUT STYLES -->        <link href="/assets/layouts/layout/css/self-layout.css" rel="stylesheet" type="text/css" />        <link href="/assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />        <link href="/assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />        <!-- END THEME LAYOUT STYLES -->        <link href="/templates/css/style.css?cache=209" rel="stylesheet" type="text/css"/>		<link href="/templates/css/tw_style.css?cache=205" rel="stylesheet" type="text/css"/>                <!-- BEGIN PAGE FIRST SCRIPTS -->        <script src="/assets/global/plugins/jquery.min.js" type="text/javascript"></script>        <!-- END PAGE FIRST SCRIPTS -->        <link rel="shortcut icon" href="#"/>	</head>	<!-- END HEAD -->	<body>       <div class="page-inner-content">
	<!--slot=0-->
<style>
.page-bar{
	display: block;
}
.page-bar .panel{
	display: flex;
	align-items: center;
	background-color: transparent;
	margin:0px;
	padding-top:4px;
}
.page-bar .panel:first-child{
	padding-top:0px;
}
.page-bar .act-group{
	/*float:left;*/
	margin-right:10px;
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
.add-cus-btn{
	margin-left:20px;
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
	
#invitee-info-div{
	padding:  10px;
}
.identity-status-btn {
    display: inline-block;
    padding: 2px 5px;
    text-decoration: none;
    font-family: "微軟正黑體";
	text-align: center;
}
.identity-status-btn.s1{
	color: #FFF;
    background-color: red;
}
.identity-status-btn.s2{
	color: #FFF;
    background-color: goldenrod;
}
.identity-status-btn.s3{
	color: #FFF;
    background-color: mediumpurple;
}
.identity-status-btn.s100{
	color: #FFF;
    background-color: green;
}
.paction-btn-div .btn{
	margin-top:5px;
}
#identity-ver-div{
	padding:  10px;
}
#identity-ver-div .flex-div{
	display: flex;
	align-items: center;
}
#identity-ver-div .identity-ver-tb .image-form .btn{position: relative;overflow: hidden;margin-right: 4px;display:inline-block;*display:inline;padding:4px 10px 4px;font-size:14px;color:#fff;text-align:center;vertical-align:middle;cursor:pointer;background-color:#5bb75b;border:1px solid #cccccc;border-color:#e6e6e6 #e6e6e6 #bfbfbf;border-bottom-color:#b3b3b3;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px; margin-left:10px;}
#identity-ver-div .identity-ver-tb .image-form .btn input {position: absolute;top: 0; right: 0;margin: 0;border: solid transparent;opacity: 0;filter:alpha(opacity=0); cursor: pointer;}
#identity-ver-div .identity-ver-tb .preview-pic img{
	max-width: 200px;
}
#identity-ver-div .identity-ver-tb .pic-notes{
	color:red;
	margin-top:10px;
}
#identity-ver-div .identity-ver-log-tb tr.title{
	background-color: #444;
	color:#fff;
	font-weight:bold;
}
#identity-ver-div .identity-ver-log-tb td{
	padding:8px 10px;
	border:1px solid #ccc;
	text-align: center;
}
</style>
<div class="page-bar" id="search-data-area">
	<div class="panel">
		<div class="act-group hidden">
			<button class="btn green-sharp btn-large " onclick="parent.goIframeHistoryBack(this, event);"> <i class="fa fa-mail-reply"></i> <font class="">回上頁</font> </button>
		</div>
		<div class="act-group">
			<span>帳號層級</span>&nbsp;
			<select name="search_level" is-search-data='1'>
				<option value="16" >會員</option>
				<option value="15" >代理</option>
				<option value="14" >總代</option>
			</select>
		</div>
		<div class="act-group">
			<span>帳號</span>&nbsp;
			<input type="text" size="8" name="search_customer_userid" is-search-data='1' value="">
		</div>
		<div class="act-group">
			<span>模糊搜尋<input type="checkbox" name="fuzzy_search" is-search-data='1' value="1" /></span>
		</div>
		<div class="act-group">
			<span>姓名</span>&nbsp;
			<input type="text" size="8" name="search_customer_name" is-search-data='1' value="">
		</div>
		<div class="act-group">
			<span>手機</span>&nbsp;
			<input type="text" size="10" name="search_cell_phone" is-search-data='1' value="">
		</div>
		<div class="act-group">
			<span>狀態</span>&nbsp;
			<select name="search_status" is-search-data='1'>
				<option value="-1">全部</option>
				<!--slot=1-->

	<option  value="1" > 啟用</option>

	<option  value="2" > 停押</option>

	<option  value="3" > 鎖定</option>

	<option  value="4" > 停用</option>


			</select>
		</div>
		<div class="act-group">
			<span>身分驗證</span>&nbsp;
			<select name="search_identity_status" is-search-data='1'>
				<option value="-1">全部</option>
				<!--slot=1-->

	<option  value="1" > 未驗證</option>

	<option  value="2" > 待審核</option>

	<option  value="3" > 驗證失敗</option>

	<option  value="100" > 已驗證</option>


			</select>
		</div>
	</div>
	<div class="panel">
		<div class="act-group">
			<span>等級</span>&nbsp;
			<select name="search_grade" is-search-data='1'>
				<option value="-1">全部</option>
				<!--slot=1-->

	<option  value="7" > 一般會員</option>

	<option  value="14" > 黃金VIP2</option>

	<option  value="15" > 123</option>


			</select>
		</div>
		<div class="act-group">
			<span>標籤</span>&nbsp;
			<select name="search_mark" is-search-data='1'>
				<option value="-1">全部</option>
				<!--slot=1-->

	<option  value="7" > 123</option>

	<option  value="8" > 風控(高)</option>


			</select>
		</div>
		<div class="act-group">
			<span>邀請碼</span>&nbsp;
			<input type="text" size="8" name="search_invite_code" is-search-data='1' value="">
		</div>
		<div class="act-group">
			<span>排序</span>&nbsp;
			<select name="search_order_by" is-search-data='1'>
				<option value="desc" >降序</option>
				<option value="asc" >升序</option>
			</select>
		</div>
		<div class="act-group">
			<span>升降序條件</span>&nbsp;
			<select name="search_order_by_field" is-search-data='1'>
				<option value="create_datetime" >註冊時間</option>
				<option value="total_deposit" >總入款</option>
				<option value="total_withdraw" >總出款</option>
				<option value="total_cash_quota" >總餘額</option>
			</select>
		</div>
        <div class="act-group">
			<span>查詢天數</span>&nbsp;
			<select name="search_day_int" is-search-data='1'>
				<option value="-1">請選擇</option>
				<option value="1" >7-14天</option>
				<option value="2" >15天以上</option>
			</select>
		</div>
        <div class="act-group">
			<span>未投注<input type="checkbox" name="is_not_bet" is-search-data='1' value="1" /></span>
		</div>
        <div class="act-group">
			<span>未儲值<input type="checkbox" name="is_not_deposit" is-search-data='1' value="1" /></span>
		</div>
		<div class="act-group">
			<button type="button" class="btn btn-success search-btn" value="search">
				<i class="fa fa-search"></i> 查詢
			</button>
		</div>
	</div>
</div>
<div id="station-btn-area">
	
</div>
<div class="portlet light bordered">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-group font-green-sharp"></i>
			<span class="caption-subject font-green-sharp bold uppercase">會員管理 - 會員設定</span>
			<span class="caption-subject bold uppercase mr-l-20 hidden">總會員數：</span>
		</div>
        <button class="btn red add-cus-btn hidden" onclick="add_cus()">新增</button>
	</div>
    
	<div class="portlet-body">
       <div id="sample_2_wrapper" class="dataTables_wrapper">
			<div class="table-container">
            	<table class="table table-striped table-bordered table-hover order-column" id="manager_table">
                	<thead>
                    	<tr class="bg-green1 color-white nowrap">
                            <th>帳號</th>
							<th>上層總代</th>
							<th>上層代理</th>
							<th>狀態</th>
							<th>身分驗證</th>
							<th>總入款</th>
							<th>總出款</th>
							<th>主帳戶餘額</th>
                            <th>總投注</th>
                            <th>等級</th>
							<th>邀請會員數</th>
							<th width="1px">註冊時間</th>
                            <th width="1px">邀請碼/推廣連結</th>
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
<input type="hidden" id="edit-cus-level" name="edit_cus_level" value="16">
<input type="hidden" value="3" id="edit-station-code">
<input type="hidden" value="" id="top-cus-id">
<div id="invitee-info-div" style="display: none;">
	
</div>
<div id="identity-ver-div" style="display: none;">
	
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
        <script src="/templates/js/jquery.wallform.js?c=1" type="text/javascript"></script>
<script src="/templates/js/cus_info/manager.js?cache=150" type="text/javascript"></script>

    </body>
</html>