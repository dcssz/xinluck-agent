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
		text-align: center;
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
        <form id="report-form" class="form-horizontal" role="form" method="GET" action="cus_bet_info_manager">
            <div class="page-bar" id="search-data-area">
                <div class="act-group hidden">
                    <button class="btn green-sharp btn-large " onclick="parent.goIframeHistoryBack(this, event);"> <i
                            class="fa fa-mail-reply"></i>
                        <font class="">回上頁</font>
                    </button>
                </div>
                <div class="act-group">
                    <span>日期類型</span>&nbsp;
                    <select name="search_date_type" is-search-data='1'>
                        <option value="1">投注日期</option>
                        <option value="2">結算日期</option>
                        <option value="3">生效日期</option>
                    </select>
                </div>
                <div class="act-group">
                    <div class="date-div">
                        <div>日期區間</div>&nbsp;
                        <div class="input-group input-small date date-picker sddate" data-date="<?=$sddate?>" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                            <input type="text" class="form-control" id="search-start-date" name="sddate" value="<?=$sddate?>" readonly is-search-data='1'>
							<span class="input-group-btn">
                                <button class="btn blue" type="button">
                                    <i class="fa fa-calendar"></i>
                                </button>
                            </span>
                        </div>
                        <div class="input-group input-small search-time">
                            <input type="text" id="search-start-time" name="sdtime" value="<?=$sdtime?>" class="form-control timepicker timepicker-24" readonly is-search-data='1'>
                            <span class="input-group-btn">
                                <button class="btn blue" type="button">
                                    <i class="fa fa-clock-o"></i>
                                </button>
                            </span>
                        </div>
                        <div class="sign">~</div>
                        <div class="input-group input-small date date-picker eddate" data-date="<?=$eddate?>" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                            <input type="text" class="form-control" id="search-end-date" name="eddate" value="<?=$eddate?>" readonly is-search-data='1'>
                            <span class="input-group-btn">
                                <button class="btn blue" type="button">
                                    <i class="fa fa-calendar"></i>
                                </button>
                            </span>
                        </div>
                        <div class="input-group input-small search-time">
                            <input type="text" id="search-end-time" name="edtime" value="<?=$edtime?>" class="form-control timepicker timepicker-24" readonly is-search-data='1'>
                            <span class="input-group-btn">
                                <button class="btn blue" type="button">
                                    <i class="fa fa-clock-o"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="act-group">
                    <span>帳號層級</span>&nbsp;
                    <select name="search_level" is-search-data='1'>
                        <option value="16">會員</option>
                        <option value="15">代理</option>
                        <!-- <option value="14">總代</option> -->
                    </select>
                </div>
                <div class="act-group">
                    <span>帳號</span>&nbsp;
                    <input type="text" size="8" name="search_customer_userid" value="<?=$search_customer_userid?>" is-search-data='1'>
                </div>
                <div class="act-group">
                    <span>廠商名稱</span>&nbsp;
                    <select name="search_game_store" onChange="change_game_store();" is-search-data='1'>
                        <!--slot=1-->

                        <option value="1" selected> 協和體育</option>

                        <option value="8"> 歐博真人</option>

                        <option value="9"> 沙龍真人</option>

                        <option value="11"> WM真人</option>

                        <option value="16"> BTS棋牌</option>

                        <option value="19"> BL棋牌</option>

                        <option value="20"> TF電競</option>

                        <option value="21"> 大立彩票</option>

                        <option value="26"> 皇家電子</option>

                        <option value="27"> 轉轉樂</option>

                        <option value="31"> 皇家真人</option>

                        <option value="32"> BNG電子</option>


                    </select>
                </div>
                <div class="act-group">
                    <span>遊戲類型</span>&nbsp;
                    <select id="search-game-category" name="search_game_category" is-search-data='1'>
                        <!--slot=1-->

                        <option value="-1" selected=true> 全部</option>

                        <option value="1"> 美棒</option>

                        <option value="2"> 彩球</option>

                        <option value="3"> 中華職棒</option>

                        <option value="4"> 日棒</option>

                        <option value="5"> 韓棒</option>

                        <option value="6"> 冰球</option>

                        <option value="7"> 籃球</option>

                        <option value="8"> 賽馬/賽狗</option>

                        <option value="9"> 其他棒球</option>

                        <option value="10"> 其他冰球</option>

                        <option value="11"> 其他籃球</option>

                        <option value="13"> 其他足球</option>

                        <option value="14"> 頂級足球</option>

                        <option value="15"> 美式足球</option>

                        <option value="16"> 電子競技</option>


                    </select>
                </div>
                <div class="act-group">
                    <span>帳務狀態</span>&nbsp;
                    <select id="search-is-finished" name="search_is_finished" is-search-data='1'>
                        <option value="-1">全部</option>
                        <option value="0">未結帳</option>
                        <option value="1">已結帳</option>
                    </select>
                </div>
                <div class="act-group">
                    <span>注單編號</span>&nbsp;
                    <input type="text" size="10" name="search_order_no" value="" is-search-data='1'>
                </div>
                <div class="act-group">
                    <button type="button" class="btn btn-success search-btn" value="search" @click="onQuery">
                        <i class="fa fa-search"></i> 查詢
                    </button>
                </div>
            </div>
            <div class="search-detail-div">
                <div class="detail-bar date-pick-div">
                    <span>快選日期</span>&nbsp;
                    <button type="button" class="btn red btn_yesterday btn-md"
                        today-date="<?=date('Y-m-d')?>">昨日</button>
                    <button type="button" class="btn red btn_today btn-md" today-date="<?=date('Y-m-d')?>">今日</button>
                    <button type="button" class="btn red btn_lastweek btn-md"
                        today-date="<?=date('Y-m-d')?>">上週</button>
                    <button type="button" class="btn red btn_thisweek btn-md"
                        today-date="<?=date('Y-m-d')?>">本周</button>
                    <button type="button" class="btn red btn_lastmonth btn-md"
                        today-date="<?=date('Y-m-d')?>">上月</button>
                    <button type="button" class="btn red btn_thismonth btn-md"
                        today-date="<?=date('Y-m-d')?>">本月</button>
                </div>
                <div class="detail-bar">

                </div>
            </div>
			<div class="page-bar" style="justify-content: space-around;">
				<span class="btn btn-primary btn-md">總筆數:  ${ Cnt }$</span>
				<span class="btn btn-primary btn-md">會員輸贏:  ${ totalWinlose }$</span>
				<span class="btn btn-primary btn-md">總投注:  ${ totalAmount }$</span>
				<span class="btn btn-primary btn-md">總有效投注: ${ totalValidAmount }$</span>
			</div>
		
            <input type="hidden" name="page_now" id="page-now" value="1">
            <input type="hidden" name="start" value="0">
        </form>
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-group font-green-sharp"></i>
                    <span class="caption-subject font-green-sharp bold uppercase">報表管理 - 會員帳變報表</span>
                </div>
            </div>

            <div class="portlet-body">
                <div class="table-container">
                    <table class="table table-striped table-bordered table-hover order-column" id="manager_table">
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
						Cnt: 0,
						totalWinlose: 0,
						totalAmount: 0,
						totalValidAmount: 0,
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
					onQuery: function () {
						initTable();
						
					}
				},
			});

			initTable();
			function initTable() {
				var $table = $('#manager_table');

				$table.bootstrapTable('destroy');

				$table.bootstrapTable({
					url: "/agent/cus_bet_report_op?" + $("#search-data-area [is-search-data=1]").serialize() + "&edit_cus_level=" + $("#edit-cus-level").val() + "&top_cus_id=" + $("#top-cus-id").val() + "&edit_station_code=" + $("#edit-station-code").val(),
					idField: 'id',
					showColumns: false,
					pagination: true,
					pageList: [10, 20, 50, 100],
					pageNumber: 1,
					pageSize: 10,
					sidePagination: 'server',
					smartDisplay: false,
					columns: [
						{
							field: 'id',
							title: 'id',
							visible:false
						},
						{
							field: 'order_no',
							title: '單號',
						},
						{
							field: 'user.username',
							title: '會員',
							formatter: 'usernameFormatter'
						},
						{
							field: 'game.name',
							title: '遊戲商',
							align: 'center',
						},
						{
							field: 'amount',
							title: '投注金額',
							align: 'center',
						},
						{
							field: 'valid_amount',
							title: '有效投注',
							align: 'center',
						},
						{
							field: 'winlose',
							title: '會員輸贏',
							align: 'center',
						},
						{
							field: 'flag',
							title: '注單狀態',
							align: 'center',
							formatter: 'flagFormatter'
						},
						{
							field: 'bet_time',
							title: '投注時間',
							align: 'center',
						},
						{
							field: 'draw_time',
							title: '結算時間',
							align: 'center',
						},
					],
					treeShowField: 'user.username',
					parentIdField: 'user.pid',
					queryParams:function (params) {
						return params;
					},
					responseHandler:function (res) {
						app.Cnt = res.page_summarys.Cnt;
						app.totalWinlose = res.page_summarys.totalWinlose;
						app.totalAmount = res.page_summarys.totalAmount;
						app.totalValidAmount = res.page_summarys.totalValidAmount;
						return { 
							"total": res.recordsTotal,
							"rows": res.data
						}
					},
					onPostBody: function() {
						var columns = $table.bootstrapTable('getOptions').columns

						if (columns && columns[0][1].visible) {
							$table.treegrid({
							treeColumn: 1,
							onChange: function() {
								$table.bootstrapTable('resetView');
							}
							})
						}
					},
					onLoadSuccess: function (res) {
						console.log(res);
					}
				})
			}
		});

		function flagFormatter(value, row, index) {
			var result;

			if (value == 1) {
				result = '<p class="text-success" href="javascript:void(0);" style="margin: 0px 0 0px; color: green;">已結算</p>';
			} else if (value == -1) {
				result = '<p class="text-success" href="javascript:void(0);" style="margin: 0px 0 0px; color: red;">棄單</p>';
			} else if (value == 0) {
				result = '<p class="text-success" href="javascript:void(0);" style="margin: 0px 0 0px; color: black;">未結帳</p>';
			}

			return result;

		}

		function usernameFormatter(value, row, index) {
			var result;

			if (row.role == 'agent') {
				result = '<p class="text-success" style="display: contents; color: green;">(' + row.user.level + '代) </p>' + value;
			} else {
				result = '<p class="text-success" style="display: contents; color: green;">(' + row.user.level + '會) </p>' + value;
			}

			return result;
		}

        
    </script>
</body>

</html>