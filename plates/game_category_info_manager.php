
<!DOCTYPE html><!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]--><!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]--><!--[if !IE]><!--><html lang="en" class="no-js">	<!--<![endif]-->	<!-- BEGIN HEAD -->	<head>        <meta charset="utf-8"/>        <meta http-equiv="X-UA-Compatible" content="IE=edge">        <!--<meta content="width=device-width, initial-scale=1" name="viewport"/>-->        <meta content="" name="description"/>        <meta content="" name="keywords"/>        <meta content="" name="author"/>        <title>控端</title>        <!-- BEGIN PAGE TOP STYLES -->        <!-- END PAGE TOP STYLES -->        <!-- BEGIN GLOBAL MANDATORY STYLES -->        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />        <!-- END GLOBAL MANDATORY STYLES -->        <!-- BEGIN PAGE LEVEL PLUGINS -->        <link href="/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />        <!-- END PAGE LEVEL PLUGINS -->        <!-- BEGIN THEME GLOBAL STYLES -->        <link href="/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />        <link href="/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />        <!-- END THEME GLOBAL STYLES -->        <!-- BEGIN THEME LAYOUT STYLES -->        <link href="/assets/layouts/layout/css/self-layout.css" rel="stylesheet" type="text/css" />        <link href="/assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />        <link href="/assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />        <!-- END THEME LAYOUT STYLES -->        <link href="/templates/css/style.css?cache=209" rel="stylesheet" type="text/css"/>		<link href="/templates/css/tw_style.css?cache=205" rel="stylesheet" type="text/css"/>                <!-- BEGIN PAGE FIRST SCRIPTS -->        <script src="/assets/global/plugins/jquery.min.js" type="text/javascript"></script>        <!-- END PAGE FIRST SCRIPTS -->        <link rel="shortcut icon" href="#"/>	</head>	<!-- END HEAD -->	<body>       <div class="page-inner-content">
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
#manager_table td{
	vertical-align: middle;
	text-align: center;
}	
.status-btn {
    display: inline-block;
    padding: 2px 5px;
    text-decoration: none;
    font-family: "微軟正黑體";
	background-color: #00000099;
	color: #FFF;
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
	
.status-maintain {
    color: #FFF;
    background-color: #ff0cd6;
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
	
#editor-item-div{
	padding:  10px;
}
	
.min-w-400{
	min-width: 400px;
}
	
.dropdown-menu{
	z-index: 29891031;
}
</style>
<div class="page-bar">
	<div class="act-group">
		<span>遊戲名稱</span>&nbsp;
		<input type="text" size="8" name="search_game_name" value="">
    </div>
	<div class="act-group">
		<span>廠商名稱</span>&nbsp;
		<select name="search_game_store" onChange="change_game_store();">
			<option value="-1">全部</option>
			<!--slot=1-->

	<option  value="13" > KA電子</option>


		</select>
    </div>
	<div class="act-group">
		<span>遊戲類型</span>&nbsp;
		<select id="search-game-category" name="search_game_category">
			<option value="-1">全部</option>
		</select>
    </div>
	<div class="act-group">
		<span>遊戲標籤</span>&nbsp;
		<select name="search_mark">
			<option value="-1">全部</option>
			<option value="0">未設置</option>
			<!--slot=1-->

	<option  value="5" > 123</option>


		</select>
    </div>
	<div class="act-group">
		<span>狀態</span>&nbsp;
		<select name="search_status">
			<option value="-1">全部</option>
			<option value="0">關閉</option>
			<option value="1">服務</option>
			<option value="2">維護</option>
		</select>
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
			<span class="caption-subject font-green-sharp bold uppercase">遊戲管理 - 遊戲設定</span>
		</div>
	</div>
    
	<div class="portlet-body">
       <div id="sample_2_wrapper" class="dataTables_wrapper">
			<div class="table-container">
            	<table class="table table-striped table-bordered table-hover order-column" id="manager_table">
                	<thead>
                    	<tr class="bg-green1 color-white">
							<th>遊戲名稱</th>
                            <th>廠商名稱</th>
							<th>遊戲類型</th>
							<th>遊戲標籤</th>
                            <th>維護區間</th>
							<th>狀態</th>
							<th>操作人</th>
                            <th>最後操作時間</th>
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
<div id="editor-item-div" style="display: none;" ><!--slot=2-->
	<form id="save-game-category-info-form">
		<table class="table editor-table table-bordered">
			<thead>
				<tr>
					<th class="title" colspan="100%">編輯</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>遊戲名稱</td>
					<td>章魚王</td>
				</tr>
				<tr>
					<td>廠商名稱</td>
					<td>KA電子</td>
				</tr>
				<tr>
					<td>遊戲類型</td>
					<td>捕魚機</td>
				</tr>
				<tr>
					<td>遊戲標簽</td>
					<td>
						<select name="edit_mark_id" class="form-control input-inline" style="width:300px;">
							
							<option value="0">請選擇</option>
							<!--slot=1-->
							<?php foreach ($gameMarks as $item) {?>
								<option value="<?= $item->id ?>"> <?= $item->name?></option>
							<?php }?>
						</select>
					</td>
				</tr>
				<tr>
					<td>維護開始時間</td>
					<td>
						<div class="fl-l">
							<div class="input-group input-small date date-picker sddate" data-date="2021-12-15" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
								<input type="text" class="form-control" name="start_date" value="2021-12-15" readonly="">
								<span class="input-group-btn">
									<button class="btn default" type="button">
									<i class="fa fa-calendar"></i>
									</button>
								</span>
							</div>
						</div>
						<div class="fl-l mr-l-10">
							<div class="input-group input-small start-time">
								<input type="text" name="start_time" value="14:58:11" class="form-control timepicker timepicker-24" readonly="">
								<span class="input-group-btn">
									<button class="btn default" type="button">
										<i class="fa fa-clock-o"></i>
									</button>
								</span>
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td>維護結束時間</td>
					<td>
						<div class="fl-l">
							<div class="input-group input-small date date-picker eddate" data-date="2021-12-15" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
								<input type="text" class="form-control" name="end_date" value="2021-12-15" readonly="">
								<span class="input-group-btn">
									<button class="btn default" type="button">
									<i class="fa fa-calendar"></i>
									</button>
								</span>
							</div>
						</div>
						<div class="fl-l mr-l-10">
							<div class="input-group input-small end-time">
								<input type="text" name="end_time" value="14:58:11" class="form-control timepicker timepicker-24" readonly="">
								<span class="input-group-btn">
									<button class="btn default" type="button">
										<i class="fa fa-clock-o"></i>
									</button>
								</span>
							</div>
						</div>
					</td>
				</tr>
				<tr align="right">
					<td colspan="100%"><button type="button" class="btn red" onclick="close_layer({type: 1});">取消</button><button type="button" class="btn green" onclick="save_game_category_info();">儲存</button></td>
				</tr>
			</tbody>
		</table>
	</form>
	<input type="hidden" id="etype" value="edit">
	<input type="hidden" id="edit-info-id" value="2898">
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
        <script src="/templates/js/game_category_info/manager.js?cache=153" type="text/javascript"></script>

    </body>
</html>