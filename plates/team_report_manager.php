<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--<meta content="width=device-width, initial-scale=1" name="viewport"/>-->
    <meta content="" name="description" />
    <meta content="" name="keywords" />
    <meta content="" name="author" />
    <title>控端</title> <!-- BEGIN PAGE TOP STYLES -->
    <!-- END PAGE TOP STYLES -->
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
        type="text/css" />
    <link href="/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet"
        type="text/css" /> <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet"
        type="text/css" />
    <link href="/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet"
        type="text/css" />
    <link href="/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet"
        type="text/css" /> <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" /> <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="/assets/layouts/layout/css/self-layout.css" rel="stylesheet" type="text/css" />
    <link href="/assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
    <link href="/assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME LAYOUT STYLES -->
    <link href="/templates/css/style.css?cache=209" rel="stylesheet" type="text/css" />
    <link href="/templates/css/tw_style.css?cache=205" rel="stylesheet" type="text/css" />
    <!-- <link rel="stylesheet" type="text/css" href="/templates/css/member_order.css?cache=108"> -->
    <!-- BEGIN PAGE FIRST SCRIPTS -->
    <script src="/assets/global/plugins/jquery.min.js" type="text/javascript"></script> <!-- END PAGE FIRST SCRIPTS -->
    <link rel="shortcut icon" href="#" />
</head> <!-- END HEAD -->
<!--slot=0-->
<style>
	.page-bar {
		margin-bottom: 5px;
	}

	.page-bar .act-group {
		/*float: left;*/
		margin-right: 10px;
	}

	.portlet.light.bordered {
		margin-top: 0px;
	}

	.portlet-body {
		padding-top: 0px !important;
		display: block;
	}

	th {
		text-align: center;
	}

	td {
		/* text-align: center; */
		vertical-align: middle !important;
	}

	.nowrap {
		white-space: nowrap;
	}

	.min-w-400 {
		min-width: 400px;
	}

	.date-div {
		display: flex;
		align-items: center;
	}

	.date-div .sign {
		padding: 0px 20px;
	}

	.title-class {
		font-weight: bold;
		margin-left: 5px;
	}

	#report-form {
		display: inline;
	}

	.search-detail-div {
		margin-bottom: 10px;
		background-color: #e7ecf1 !important;
		padding: 5px !important;
	}

	.search-detail-div .detail-bar {
		padding: 5px;
	}

	.search-detail-div .date-pick-div .btn {
		padding: 3px 12px !important;
	}

	.align-right {
		text-align: right !important;
	}

	.page-div {
		display: inline-block;
		background-color: #ff5;
		padding: 0px 10px;
		line-height: 40px;
	}
</style>
<body>
    <div id="app" class="page-inner-content">
        
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-group font-green-sharp"></i>
                    <span class="caption-subject font-green-sharp bold uppercase">報表管理 - 團隊報表(返水)</span>
                </div>
            </div>

            <div class="portlet-body">
                <div class="table-container">
                    <table class="table table-striped table-bordered table-hover order-column" id="manager_table">
                        <thead>
                            <tr class="bg-green1 color-white">
                            </tr>
                        </thead>
                        <tbody>
						</tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-group font-green-sharp"></i>
                    <span class="caption-subject font-green-sharp bold uppercase">報表管理 - 團隊報表(佔成)</span>
                </div>
            </div>

            <div class="portlet-body">
                <div class="table-container">
                    <table class="table table-striped table-bordered table-hover order-column" id="manager_table_2">
                        <thead>
                            <tr class="bg-green1 color-white">
                                <th>注單編號</th>
                                <th>上層帳號(名稱)</th>
                                <th>會員帳號(名稱)</th>
                                <th>廠商&遊戲</th>
                                <th>狀態</th>
                                <th>注單內容</th>
                                <th>時間</th>
                                <th>投注金額</th>
                                <th>有效投注</th>
                                <th>會員輸贏</th>
                            </tr>
                        </thead>
                        <tbody>
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
    <script src="/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"
        type="text/javascript"></script>
    <script src="/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="/assets/global/scripts/datatable.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js"
        type="text/javascript"></script>
    <script src="/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"
        type="text/javascript"></script>
    <script src="/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"
        type="text/javascript"></script>
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
    <!-- <script src="/templates/js/cus_bet_report/manager.js?cache=128" type="text/javascript"></script> -->
    <script src="/assets/global/plugins/vue.js" type="text/javascript"></script>

	<link href="/assets/global/css/jquery-treegrid/jquery.treegrid.css?cache=1" rel="stylesheet" type="text/css" />
	<link href="/assets/global/css/bootstrap-table/bootstrap-table.min.css" rel="stylesheet">

	<script src="/assets/global/plugins/bootstrap-table/bootstrap-table.min.js?cache=1"></script>
	<script src="/assets/global/plugins/jquery-treegrid/jquery.treegrid.min.js"></script>
	<script src="/assets/global/plugins/bootstrap-table/bootstrap-table-treegrid.min.js?cache=1"></script>
    <script>
		$(function() {
			var app = new Vue({
				delimiters: ['${', '}$'],
				el: '#app',
				data: function () {
					return {
					}
				},
				created: function () {
				},
				watch: {
					
				},
				mounted: function () {
					//解決jquery與vue衝突,先加载vue.js，让页面渲染完成后加载jq，给jq绑定ready事件
					$.getScript('../templates/js/cus_bet_report/manager.js');
				},
				beforeMount: function () {
				},
				methods: {
				},
			});

			initTable();
			function initTable() {
				var $table = $('#manager_table');

				$table.bootstrapTable('destroy');

				$table.bootstrapTable({
					url: "/agent/team_report_water_op",
					idField: 'id',
					showColumns: false,
					pagination: true,
					pageList: [10, 20, 50, 100],
					pageNumber: 1,
					pageSize: 10,
					sidePagination: 'server',
					smartDisplay: false,
                    search: true,
					columns: [
						{
							field: 'id',
							title: 'id',
							visible:false
						},
						{
							field: 'username',
							title: '帳號',
                            formatter: 'usernameFormatter'
						},
						{
							field: 'summarys.winLose',
							title: '輸贏',
                            align: 'center',
						},
						{
							field: 'summarys.parentWater',
							title: '下線返水',
							align: 'center',
						},
						{
							field: 'summarys.water',
							title: '我的返水',
							align: 'center',
						},
					],
					treeShowField: 'username',
					parentIdField: 'pid',
					queryParams:function (params) {
						return params;
					},
					responseHandler:function (res) {
						return { 
							"total": res.recordsTotal,
							"rows": res.data
						}
					},
					onPostBody: function() {
						var columns = $table.bootstrapTable('getOptions').columns

						if (columns && columns[0][1].visible) {
							$table.treegrid({
							treeColumn: 0,
							onChange: function() {
								$table.bootstrapTable('resetView');
							}
							})
						}
					},
				})
			}

            initTable2();
			function initTable2() {
				var $table = $('#manager_table_2');

				$table.bootstrapTable('destroy');

				$table.bootstrapTable({
					url: "/agent/team_report_take_op",
					idField: 'id',
					showColumns: false,
					pagination: true,
					pageList: [10, 20, 50, 100],
					pageNumber: 1,
					pageSize: 10,
					sidePagination: 'server',
					smartDisplay: false,
                    search: true,
					columns: [
						{
							field: 'id',
							title: 'id',
							visible:false
						},
						{
							field: 'username',
							title: '帳號',
                            formatter: 'usernameFormatter'
						},
						{
							field: 'summarys.winLose',
							title: '輸贏',
							align: 'center',
						},
						{
							field: 'summarys.totalCost',
							title: '總成本',
							align: 'center',
						},
						{
							field: 'summarys.parentsWake',
							title: '下線佔成',
							align: 'center',
						},
						{
							field: 'summarys.parentsCost',
							title: '下線成本',
							align: 'center',
						},
						{
							field: 'summarys.parentsSurplus',
							title: '下線盈餘',
							align: 'center',
						},
						{
							field: 'summarys.wake',
							title: '我的佔成',
							align: 'center',
						},
						{
							field: 'summarys.cost',
							title: '我的成本',
							align: 'center',
						},
						{
							field: 'summarys.surplus',
							title: '我的盈餘',
							align: 'center',
						},
					],
					treeShowField: 'username',
					parentIdField: 'pid',
					queryParams:function (params) {
						return params;
					},
					responseHandler:function (res) {
						return { 
							"total": res.recordsTotal,
							"rows": res.data
						}
					},
					onPostBody: function() {
						var columns = $table.bootstrapTable('getOptions').columns

						if (columns && columns[0][1].visible) {
							$table.treegrid({
							treeColumn: 0,
							onChange: function() {
								$table.bootstrapTable('resetView');
							}
							})
						}
					},
				})
			}
		});

		function usernameFormatter(value, row, index) {
			var result;

			if (row.role == 'agent') {
				result = '<p class="text-success" style="display: contents; color: green;">(' + row.level + '代) </p>' + value;
			} else {
				result = '<p class="text-success" style="display: contents; color: green;">(' + row.level + '會) </p>' + value;
			}

			return result;
		}

        
    </script>
</body>

</html>