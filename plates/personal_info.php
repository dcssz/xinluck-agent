<!DOCTYPE html><!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]--><!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]--><!--[if !IE]><!--><html lang="en" class="no-js">	<!--<![endif]-->	<!-- BEGIN HEAD -->	<head>        <meta charset="utf-8"/>        <meta http-equiv="X-UA-Compatible" content="IE=edge">        <!--<meta content="width=device-width, initial-scale=1" name="viewport"/>-->        <meta content="" name="description"/>        <meta content="" name="keywords"/>        <meta content="" name="author"/>        <title>個人資料</title>        <!-- BEGIN PAGE TOP STYLES -->        <!-- END PAGE TOP STYLES -->        <!-- BEGIN GLOBAL MANDATORY STYLES -->        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />        <!-- END GLOBAL MANDATORY STYLES -->        <!-- BEGIN PAGE LEVEL PLUGINS -->        <link href="/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />        <!-- END PAGE LEVEL PLUGINS -->        <!-- BEGIN THEME GLOBAL STYLES -->        <link href="/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />        <link href="/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />        <!-- END THEME GLOBAL STYLES -->        <!-- BEGIN THEME LAYOUT STYLES -->        <link href="/assets/layouts/layout/css/self-layout.css" rel="stylesheet" type="text/css" />        <link href="/assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />        <link href="/assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />        <!-- END THEME LAYOUT STYLES -->        <link href="/templates/css/style.css?cache=206" rel="stylesheet" type="text/css"/>		<link href="/templates/css/tw_style.css?cache=205" rel="stylesheet" type="text/css"/>                <!-- BEGIN PAGE FIRST SCRIPTS -->        <script src="/assets/global/plugins/jquery.min.js" type="text/javascript"></script>        <!-- END PAGE FIRST SCRIPTS -->        <!--<link rel="shortcut icon" href=""/>-->	</head>	<!-- END HEAD -->	<body>       <style>
html{
	overflow-y:auto;
}
</style>
<div class="page-inner-content">
	<!--slot=0-->
<style type="text/css">
.hidden{
	display:none;
}
.ml-10{
	margin-left:10px !important;
}
.ml-20{
	margin-left:20px !important;
}
.mt-10{
	margin-top:10px;
}
.mt-20{
	margin-top:20px;
}
label{
	margin-bottom:0px;
}
.bg-color1{
	background-color:#c3e6fa;
}
.bg-color2{
	background-color:#9dddde;
}
.txt-color1{
	color:red;
}
.game_before {
    background: rgba(180, 230, 200, 0.5);
}
.game_now {
    background: #fce6d8;
}
.page-bar .act-group{
	float:left;
	margin-right:10px;
}
.type-btn1{
	color: #222;
    background-color: #ddd;
    border-color: #dab10d;
	display: inline-block;
    margin-bottom: 0;
    font-weight: 400;
    text-align: center;
    touch-action: manipulation;
    cursor: pointer;
    border: 1px solid transparent;
    white-space: nowrap;
    padding: 6px 12px;
    font-size: 14px;
}
.type-btn1.active{
	color: #fff;
    background-color: #F1C40F;
}
#page-content-mask{
	background-color: #CCC;
    position: fixed;
    width: 100%;
    height: 100%;
    opacity: 0.5;
	display: none;
}
.data-content{
	padding-top:10px;
}
.basic-info-tb td{
	vertical-align:middle!important;
}
.basic-info-tb td.title{
	text-align:right;
	font-weight:bold;
	white-space:nowrap;
	width:10px;
	background-color:#c3e6fa;
}
.gstore100-cus2opt-tb td{
	padding:10px;
}
.gstore100-cus2opt-tb td.title1{
	font-weight:bold;
	padding:5px 10px;
	
}
.gstore100-cus2opt-tb td.title2{
	background-color: #c3e6fa;
	font-weight:bold;
	text-align:right;
}
.tabbable-line>.nav-tabs {
    padding: 8px 5px;
    border-radius: 27px !important;
    background-color: #f4fcfd;
    border: 3px solid #bcecf1;
}
.tabbable-line>.nav-tabs>li.active, .tabbable-line>.nav-tabs>li:hover {
    border-radius: 22px !important;
    background-color: #28adb9;
    border-bottom: 0;
}
.tabbable-line>.nav-tabs>li>a {
    color: #000;
    font-size: 16px;
    font-weight: bold;
}
.tabbable-line>.nav-tabs>li.active>a, .tabbable-line>.nav-tabs>li:hover>a {
    color: #FFF;
}
.tabbable-line>.tab-content {
    border-top: 0;
}
.tab-content{
	padding:10px 0px!important;
}
.password-input{
	/*position:relative;
	top:3px;*/
}
#game-status-table td, .game-occupy-table td{
	padding: 10px;
	border: 1px solid #000;
}
#game-status-table td:nth-child(1){
	background-color: #c3e6fa;
	font-weight: bold;
}
.game-occupy-table{
	display: inline-block;
}
.this-ocpy-bg{
	/*background-color: #c3e6fa;*/
}
.next-ocpy-bg{
	background-color: #aDF7E0;
}
#rule-div{
	padding: 20px;
}
#password-form{
	display: flex;
    align-items: center;
}
</style>
<div class="page-bar">
	<form id="password-form">
        <div class="act-group">
            舊密碼
        </div>
        <div class="act-group">
            <input type="password" class="form-control password-input" name="old_pass" placeholder="Password" value="">
        </div>
        <div class="act-group ml-10">
            新密碼
        </div>
        <div class="act-group">
            <input type="password" class="form-control password-input" name="new_pass1" placeholder="Password" value="">
        </div>
        <div class="act-group ml-10">
            確認密碼
        </div>
        <div class="act-group">
            <input type="password" class="form-control password-input" name="new_pass2" placeholder="Password" value="">
        </div>
        <div class="act-group ml-10">
            <button type="button" class="btn btn-success" onclick="update_password();">修改密碼</button>
        </div>
    </form>              
</div>
<div>
    <button class="type-btn1 active" type="button" onClick="show_data_content(this, 'basic-info-area');">詳細資料</button>
    <button class="type-btn1" type="button" onClick="show_data_content(this, 'open-game-info-area');">開放遊戲設定</button>
    <button class="type-btn1 hidden" type="button" onClick="show_data_content(this, 'opt-occupy-info-area');">佔成設定</button>
    <button class="type-btn1 " type="button" onClick="show_data_content(this, 'retreat-occupy-info-area');">佔水設定</button>
    <button class="type-btn1 " type="button" onclick="show_data_content(this, 'gstore-group1-area');">體育設定</button>
    <button class="type-btn1 " type="button" onclick="show_data_content(this, 'gstore-group2-area');">彩票設定</button>
    <button class="type-btn1 " type="button" onclick="show_data_content(this, 'gstore-group3-area');">真人設定</button>
    <button class="type-btn1 " type="button" onclick="show_data_content(this, 'gstore-group4-area');">電子設定</button>
    <button class="type-btn1 " type="button" onclick="show_data_content(this, 'gstore-group6-area');">電競設定</button>
</div>
<div id="page-content-mask"><img class="temp-waiting" src="templates/images/loading.svg"></div>
<div id="basic-info-area" class="data-content">
<!--slot=3-->
<form>
    <div class="portlet light bordered">
      <div class="portlet-body" >
        <!--slot=4-->
<table class="table table-bordered basic-info-tb">
  <tbody>
    <tr>             
      <td class="title">總代理&nbsp;帳號</td>
      <td >bright09</td>
    </tr>
    <tr>
      <td class="title">總代理&nbsp;名稱</td>
      <td>財測試</td>
    </tr>
    <tr>
      <td class="title">狀態設定</td>
      <td>
        啟用
      </td>
    </tr>
    <tr>
        <td class="title">點數額度</td>
        <td>
            0
        </td>
    </tr>
    <tr>
      <td class="title">帳號類型</td>
      <td>
      	退佣
	  </td>
    </tr>
	<tr class="">
      <td class="title">佣金規則</td>
      <td>
		
	  </td>
    </tr>
	<tr class="">
      <td class="title">退水規則</td>
      <td>
		
	  </td>
    </tr>
	<tr class=" ">
      <td class="title">總輸贏規則</td>
      <td>
		
	  </td>
    </tr>
	<tr>
      <td class="title">邀請碼</td>
      <td>cL4zi6i1MN</td>
    </tr> 
    <tr>
      <td class="title">推廣連結</td>
      <td><a href='javascript:void(0);' onclick='copy_link(this);'>https://bright168.com/sty2_home.php?invite_code=cL4zi6i1MN</a></td>
    </tr>
    <tr>
      <td class="title">備註</td>
      <td></td>
    </tr>
    <tr>
      <td class="title">建立/修改時間</td>
      <td>建立: 2021-12-07 21:16:43<br> 修改: 2021-12-07 21:16:43</td>
    </tr>
    <tr>
      <td class="title">最後登入</td>
      <td>時間: 2021-12-15 16:08:01<br>IP: *.*.96.120</td>
    </tr>
  </tbody>
</table>

      </div>
    </div>
</form>    

</div>
<div id="open-game-info-area" class="data-content hidden">
    <div id="no-data"></div>
</div>
<div id="opt-occupy-info-area" class="data-content hidden">
    <div id="no-data"></div>
</div>
<div id="retreat-occupy-info-area" class="data-content hidden">
    <div id="no-data"></div>
</div>
<div id="gstore-group1-area" class="data-content hidden">
    <div id="no-data"></div>
</div>
<div id="gstore-group2-area" class="data-content hidden">
    <div id="no-data"></div>
</div>
<div id="gstore-group3-area" class="data-content hidden">
    <div id="no-data"></div>
</div>
<div id="gstore-group4-area" class="data-content hidden">
    <div id="no-data"></div>
</div>
<div id="gstore-group6-area" class="data-content hidden">
    <div id="no-data"></div>
</div>
<div id="display-change-quota-area">
</div>
<div id="rule-div" style="display: none;">
</div>
<input type="hidden" value="2794" id="edit-cus-id">
<input type="hidden" value="14" id="edit-cus-level">

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
        <script src="templates/js/personal_info/personal_info.js?cache=223" type="text/javascript"></script>

    </body>
</html>