
<!DOCTYPE html>
<!--[if IE 8]> 
<html lang="en" class="ie8 no-js"> 
<![endif]--><!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]--><!--[if !IE]><!-->
<html lang="en" class="no-js">	
<!--<![endif]-->	<!-- BEGIN HEAD -->	
<head>        
<meta charset="utf-8"/>        
<meta http-equiv="X-UA-Compatible" content="IE=edge">        <!--<meta content="width=device-width, initial-scale=1" name="viewport"/>-->        
<meta content="" name="description"/>        
<meta content="" name="keywords"/>        
<meta content="" name="author"/>        
<title>歷程</title>        <!-- BEGIN PAGE TOP STYLES -->        <!-- END PAGE TOP STYLES -->        <!-- BEGIN GLOBAL MANDATORY STYLES -->        
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />        
<link href="/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />        
<link href="/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />        
<link href="/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />        
<link href="/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />        
<link href="/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />        
<!-- END GLOBAL MANDATORY STYLES -->        <!-- BEGIN PAGE LEVEL PLUGINS -->        
<link href="/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />        
<link href="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />        
<link href="/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />        
<link href="/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />        
<!-- END PAGE LEVEL PLUGINS -->        <!-- BEGIN THEME GLOBAL STYLES -->        
<link href="/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />        
<link href="/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />        <!-- END THEME GLOBAL STYLES -->        <!-- BEGIN THEME LAYOUT STYLES -->        
<link href="/assets/layouts/layout/css/self-layout.css" rel="stylesheet" type="text/css" />        
<link href="/assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />        
<link href="/assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />        <!-- END THEME LAYOUT STYLES -->        
<link href="/templates/css/style.css?cache=209" rel="stylesheet" type="text/css"/>		
<link href="/templates/css/<!--JSO LANG -->_style.css?cache=205" rel="stylesheet" type="text/css"/>                <!-- BEGIN PAGE FIRST SCRIPTS -->        
<script src="/assets/global/plugins/jquery.min.js" type="text/javascript"></script>        <!-- END PAGE FIRST SCRIPTS -->        
<link rel="shortcut icon" href="#"/>	</head>	<!-- END HEAD -->	<body>       <div class="page-inner-content">
	<!--slot=0-->
<style>
.portlet{
	margin-top: 20px;
}
.list-table td,th{
	text-align:center;
}
	
.list-table th{
	background-color:#34495e;
	color:#eee;
	letter-spacing: 1px;
}
.page-content{
	margin-left:0px!important;
}
.mt-20{
	margin-top:20px;
}
</style>
<div class="page-bar">
		<label class="customer_userid">帳號：<?=$user->username?>(<?=$user->nickname?>)</label>
</div>
<div class="portlet mt-20">
    <div class="portlet-body">
        <div class="table-responsive">       
            <table class="table table-striped table-bordered table-hover list-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>修改時間</th>
                        <th>修改類型</th>                        
                        <th>修改項目</th>
                        <th>修改人</th>
                    </tr>
                </thead>
                 <tbody>
                  <!--slot=1-->
<?php
foreach($datas as $row){
?>
<tr>
	<td><?=$row->id?></td>
    <td><?=$row->created_at?></td>
    <td><?=$row->log_type?></td>
    <td><a href="" onclick="window.open(`cus_info_log_detail?id=<?=$row->id?>&user_id=<?=$row->user_id?>`,`修改內容`,config=`height=800,width=1300`);" ><?=$row->project?></a></td>
    <td><?=$row->user->username?> </td>
</tr>
<?php } ?>
 

                                                                                                                   
                </tbody>
            </table>
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
        <script src="layer/layer.js"></script>
        <script src="/templates/js/kang_ajax.js?cache=102"></script>
		<script src="/templates/js/kang_common.js?cache=109"></script>
		<script src="/templates/js/kang_all.js?cache=203"></script>
		<script src="/templates/js/lang/<!--JSO LANG -->.js?cache=203"></script>
        
    </body>
</html>