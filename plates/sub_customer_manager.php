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
        <title>子帳號</title>
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
<style>
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
#manager_table td, #manager_table th{
	vertical-align: middle;
	text-align: center;
	white-space:nowrap;
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
</style>
<div class="page-bar hidden">              
</div>
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-group font-green-sharp"></i>
            <span class="caption-subject font-green-sharp bold uppercase">會員管理 - 子帳號</span>
        </div>
        <button class="btn red add-cus-btn" onclick="add_cus()"><i class="fa fa-plus"></i>新增</button>
    </div>
    <div class="portlet-body">
       <div id="sample_2_wrapper" class="dataTables_wrapper">
		  <div class="table-container">
           <table class="table table-striped table-bordered table-hover order-column" id="manager_table">
            <thead>
              <tr class="bg-green1 color-white">
                <th>帳號</th>
                <!--<th width="10%">密碼</th>-->
                <th>名稱</th>
                <!--<th>LANG 權限@#@general</th> -->
                <th>狀態設定</th>
                <th>新增時間</th>
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
        <script src="/templates/js/kang_common.js?cache=105"></script>
        <script src="/templates/js/kang_all.js?cache=203"></script>
        <script src="/templates/js/lang/tw.js?cache=203"></script>
        <script src="/templates/js/sub_customer/manager.js?cache=160" type="text/javascript"></script>

    </body>
</html>