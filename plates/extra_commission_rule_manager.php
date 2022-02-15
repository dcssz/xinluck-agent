
<!DOCTYPE html><!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]--><!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]--><!--[if !IE]><!--><html lang="en" class="no-js">	<!--<![endif]-->	<!-- BEGIN HEAD -->	<head>        <meta charset="utf-8"/>        <meta http-equiv="X-UA-Compatible" content="IE=edge">        <!--<meta content="width=device-width, initial-scale=1" name="viewport"/>-->        <meta content="" name="description"/>        <meta content="" name="keywords"/>        <meta content="" name="author"/>        <title>控端</title>        <!-- BEGIN PAGE TOP STYLES -->        <!-- END PAGE TOP STYLES -->        <!-- BEGIN GLOBAL MANDATORY STYLES -->        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />        <!-- END GLOBAL MANDATORY STYLES -->        <!-- BEGIN PAGE LEVEL PLUGINS -->        <link href="/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />        <!-- END PAGE LEVEL PLUGINS -->        <!-- BEGIN THEME GLOBAL STYLES -->        <link href="/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />        <link href="/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />        <!-- END THEME GLOBAL STYLES -->        <!-- BEGIN THEME LAYOUT STYLES -->        <link href="/assets/layouts/layout/css/self-layout.css" rel="stylesheet" type="text/css" />        <link href="/assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />        <link href="/assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />        <!-- END THEME LAYOUT STYLES -->        <link href="/templates/css/style.css?cache=209" rel="stylesheet" type="text/css"/>		<link href="/templates/css/tw_style.css?cache=205" rel="stylesheet" type="text/css"/>                <!-- BEGIN PAGE FIRST SCRIPTS -->        <script src="/assets/global/plugins/jquery.min.js" type="text/javascript"></script>        <!-- END PAGE FIRST SCRIPTS -->        <link rel="shortcut icon" href="#"/>	</head>	<!-- END HEAD -->	<body>       <div class="page-inner-content">
	<!--slot=0-->
<style>
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
	
.add-extra-commission-rule-btn{
	margin-left:20px;
}
#editor-item-div{
	overflow-y: auto;
	max-height: 600px;
}
	
#editor-item-div .editor-table, #is-open-set-div .editor-table {
	margin: 0 auto;
    width: 80%;
    max-width: 80%;
}
	
#editor-item-div .editor-table .title, #is-open-set-div .editor-table .title{
	padding: 10px;
	font-size: 24px !important;
}
#editor-item-div .editor-table td:nth-child(1) {
	/*white-space: nowrap;*/
}
	
#is-open-set-div .editor-table td, #is-open-set-div .editor-table th {
	white-space: nowrap;
	text-align:  center;
}
	
#editor-item-div, #is-open-set-div{
	padding:  10px;
}
#editor-item-div .editor-table .nowrap{
	white-space: nowrap;
}
	
#editor-item-div .editor-table .is-div-title{
	font-weight: bold;
	font-size: 16px;
	padding-bottom: 5px;
}
#editor-item-div .station-param-tb{
	margin: 0 auto;
	min-width: 600px !important;
}
	
#editor-item-div .station-param-tb td{
	text-align: center;
	vertical-align: middle;
}
	
.min-w-400{
	min-width: 400px;
}
</style>
<div id="unique-btn-area">
	
</div>
<div class="portlet light bordered">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-group font-green-sharp"></i>
			<span class="caption-subject font-green-sharp bold uppercase">代理管理 - 總輸贏規則設定</span>
		</div>
        <button class="btn red add-extra-commission-rule-btn" onclick="request_editor_item_div('add', '');">新增</button>
	</div>
    
	<div class="portlet-body">
       <div id="sample_2_wrapper" class="dataTables_wrapper">
			<div class="table-container">
            	<table class="table table-striped table-bordered table-hover order-column" id="manager_table">
                	<thead>
                    	<tr class="bg-green1 color-white">
							<th>總輸贏規則名稱</th>
							<th>狀態</th>
							<th>建立時間</th>
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
    <input type="hidden" id="edit-unique-code" name="edit_unique_code" value="3" />
</div>
<div id="editor-item-div" style="display: none;">
    <form id="editor-item-form">
        <table class="table editor-table table-bordered">
            <thead>
                <tr>
                    <th class="title" id="editor-item-form-title" colspan="100%">編輯</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>規則名稱</td>
                    <td><input type="text" id="extra-commission-rule-name" name="extra_commission_rule_name" value=""></td>
                </tr>
                <tr>
                    <td colspan="100%">
                        <div class="is-div-title">
                            總輸贏規則條件設定&nbsp;
                            <a href="javascript:void(0);" onclick="add_param_item();" class="btn btn-xs default"> <i class="fa fa-pencil"></i> 新增 </a>
                        </div>
                        <div class="nowrap">
                            <table class="table station-param-tb table-bordered">
                                <thead>
                                    <tr>
                                        <th>區間(總代底下所有代理總輸贏負盈利)</th>
                                        <th>退佣</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr item_list_index="add-item" style="display:none;">
                                        <td>
                                            <input type="text" value="0" field="lower_limit">&nbsp;~&nbsp;
                                            <input type="text" value="0" field="upper_limit">
                                        </td>
                                        <td>
                                            <table class="table editor-table table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <?php foreach ($gameStoreTypes as $item) {?>
                                                            <th colspan="<?=count($item->gameStores)?>"><?= $item->name?></th>
                                                        <?php }?>
                                                        <!--th colspan="3">體育</th>
                                                        <th colspan="2">彩票</th>
                                                        <th colspan="5">真人</th>
                                                        <th colspan="4">電子</th>
                                                        <th colspan="2">棋牌</th>
                                                        <th colspan="1">電競</th-->
                                                    </tr>
                                                    <tr>
                                                        <?php foreach ($gameStoreTypes as $type) {?>
                                                            <?php foreach ($type->gameStores as $store) {?>
                                                            <th><?= $store->name?></th>
                                                            <?php }?>
                                                        <?php }?>
                                                        <!--th>協和體育</th>
                                                        <th>Super體育</th>
                                                        <th>SXB體育</th>
                                                        <th>大立彩票</th>
                                                        <th>轉轉樂</th>
                                                        <th>歐博真人</th>
                                                        <th>沙龍真人</th>
                                                        <th>WM真人</th>
                                                        <th>皇家真人</th>
                                                        <th>DG真人</th>
                                                        <th>ZG電子</th>
                                                        <th>皇家電子</th>
                                                        <th>BNG電子</th>
                                                        <th>VA電子</th>
                                                        <th>BTS棋牌</th>
                                                        <th>BL棋牌</th>
                                                        <th>TF電競</th-->
                                                    </tr>
                                                    <tr>
                                                        <?php foreach ($gameStoreTypes as $type) {?>
                                                            <?php foreach ($type->gameStores as $store) {?>
                                                                <td>
                                                                    <input type="text" size="1" value="" field="<?= $store->id?>_extra_commission">&nbsp;%
                                                                </td>
                                                            <?php }?>
                                                        <?php }?>
                                                        <!--td><input type="text" size="1" value="0" field="1_extra_commission">&nbsp;%</td>
                                                        <td><input type="text" size="1" value="0" field="34_extra_commission">&nbsp;%</td>
                                                        <td><input type="text" size="1" value="0" field="37_extra_commission">&nbsp;%</td>
                                                        <td><input type="text" size="1" value="0" field="21_extra_commission">&nbsp;%</td>
                                                        <td><input type="text" size="1" value="0" field="27_extra_commission">&nbsp;%</td>
                                                        <td><input type="text" size="1" value="0" field="8_extra_commission">&nbsp;%</td>
                                                        <td><input type="text" size="1" value="0" field="9_extra_commission">&nbsp;%</td>
                                                        <td><input type="text" size="1" value="0" field="11_extra_commission">&nbsp;%</td>
                                                        <td><input type="text" size="1" value="0" field="31_extra_commission">&nbsp;%</td>
                                                        <td><input type="text" size="1" value="0" field="36_extra_commission">&nbsp;%</td>
                                                        <td><input type="text" size="1" value="0" field="24_extra_commission">&nbsp;%</td>
                                                        <td><input type="text" size="1" value="0" field="26_extra_commission">&nbsp;%</td>
                                                        <td><input type="text" size="1" value="0" field="32_extra_commission">&nbsp;%</td>
                                                        <td><input type="text" size="1" value="0" field="33_extra_commission">&nbsp;%</td>
                                                        <td><input type="text" size="1" value="0" field="16_extra_commission">&nbsp;%</td>
                                                        <td><input type="text" size="1" value="0" field="19_extra_commission">&nbsp;%</td>
                                                        <td><input type="text" size="1" value="0" field="20_extra_commission">&nbsp;%</td-->
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);" onclick="delete_param_item(this);" class="btn btn-xs default"> <i class="fa fa-pencil"></i> 刪除 </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>狀態</td>
                    <td>是否啟用<input type="checkbox" id="extra-commission-rule-status" name="status" value="1" ></td>
                </tr>
                <tr align="right">
                    <td colspan="100%"><button type="button" class="btn red" onclick="close_layer({type: 1});">取消</button><button type="button" class="btn green" onclick="save_extra_commission_rule();">儲存</button></td>
                </tr>
            </tbody>
        </table>
        <input type="hidden" id="etype" value="edit">
        <input type="hidden" id="edit-extra-commission-rule-id" value="">
    </form>
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
        <script src="/templates/js/extra_commission_rule/manager.js?cache=147" type="text/javascript"></script>

    </body>
</html>