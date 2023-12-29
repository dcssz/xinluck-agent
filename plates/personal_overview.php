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
        <title>個人總攬</title>
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
        <!-- <link href="/templates/css/style.css?cache=206" rel="stylesheet" type="text/css"/> -->
		<!-- <link href="/templates/css/tw_style.css?cache=205" rel="stylesheet" type="text/css"/> -->
		<link href="/templates/css/personal_overview.css?cache=1" rel="stylesheet" type="text/css"/>
		<link href="/templates/css/personal_overview.css?cache=1" rel="stylesheet" type="text/css"/>
        
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
            .container-fluid .block-header h2{
                margin: 10px !important;
                color: #666 !important;
                font-weight: normal;
                font-size: 20px;
                font-weight:bold;
            }
            .table {
                margin-bottom: 0px;
                text-align: center;
            }
            .table thead{
                background-color: #c7c7c7;
            }
            .table th{
                text-align:center;
                border-right: 1px solid #eee;
            }
            .table .title{
                margin-top: 10px;
            }
            .date-div{
                display: inline-block;
            }
        </style>

    <div id="app">
        <div class="container-fluid">
			<div class="row clearfix">
				<div class="block-header"></div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="card">
						<div class="header">
							<div class="dataTables_wrapper form-inline dt-bootstrap">
								<div class="row">
									<div class="col-sm-12">
										<div class="dataTables_length">
											<label><?=_('日期區間')?>：</label>
											<div class="date-div">
												<input id="sdate" type="text" class="form-control input-sm datepicker date-picker" placeholder=""  value="<?=$sdate?>" readonly style="width:100px;">
												<button class="btn blue" type="button"><i class="fa fa-calendar"></i></button>
											</div>
											<div class="date-div">
												<input id="stime" type="text" class="form-control input-sm timepicker timepicker-24" placeholder="" value="<?=$stime?>" readonly style="width:100px;">
												<button class="btn blue" type="button"><i class="fa fa-clock-o"></i></button>
											</div>
											~
											<div class="date-div">
												<input id="edate" type="text" class="form-control input-sm datepicker date-picker" placeholder="" value="<?=$edate?>" readonly style="width:100px;">
												<button class="btn blue" type="button"><i class="fa fa-calendar"></i></button>
											</div>
											<div class="date-div">
												<input id="etime" type="text" class="form-control input-sm timepicker timepicker-24" placeholder="" value="<?=$etime?>" readonly style="width:100px;">
												<button class="btn blue" type="button"><i class="fa fa-clock-o"></i></button>
											</div>
											<button type="button" class="btn btn-warning" @click="onSearch"><?=_('查詢')?></button>
											<button type="button" class="btn btn-danger btn_yesterday" @click="onDate('today')"><?=_('今天')?></button>
											<button type="button" class="btn btn-success btn_yesterday" @click="onDate('yesterday')"><?=_('昨天')?></button>
											<button type="button" class="btn btn-success btn_yesterday" @click="onDate('thisweek')"><?=_('本周')?></button>
											<button type="button" class="btn btn-success btn_yesterday" @click="onDate('lastweek')"><?=_('上週')?></button>
											<button type="button" class="btn btn-success btn_yesterday" @click="onDate('thismonth')"><?=_('本月')?></button>
											<button type="button" class="btn btn-success btn_yesterday" @click="onDate('lastmonth')"><?=_('上月')?></button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

            <div class="row clearfix">
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons"></i>
                        </div>
                        <div class="content">
                            <div class="text">餘額</div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20">125</div>
                        </div>
                    </div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons"></i>
                        </div>
                        <div class="content">
                            <div class="text">充值</div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20">125</div>
                        </div>
                    </div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons"></i>
                        </div>
                        <div class="content">
                            <div class="text">提現</div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20">125</div>
                        </div>
                    </div>
				</div>
			</div>

            <div v-for="gameStoreType in game_store_types" class="row clearfix">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="block-header">
						<h2>${ gameStoreType.name }$</h2>
					</div>
					<div class="card">
						<table class="table">
                            <thead>
                                <th>投注金额</th>
                                <th>有效投注</th>
                                <th>輸贏金額</th>
                                <!-- <th>總和</th> -->
                            </thead>
                            <tbody>
                                <tr>
                                    <td>${ gameStoreType.betReports.amount }$</td>
                                    <td>${ gameStoreType.betReports.valid_amount }$</td>
                                    <td>${ gameStoreType.betReports.winlose }$</td>
                                    <!-- <td>${ parseInt(gameStoreType.betReports.amount + gameStoreType.betReports.valid_amount + gameStoreType.betReports.winlose) }$</td> -->
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
        <!-- <script src="/templates/js/personal_info/personal_info.js?cache=225" type="text/javascript"></script> -->
        <script src="/assets/global/plugins/vue.js" type="text/javascript"></script>
        <script>
            var app = new Vue({
                delimiters: ['${', '}$'],
                el: '#app',
                data: function () {
                    return {
                        current: {
                        },
                        today: '<?= date("Y-m-d")?>',
                        yesterday: '<?= date("Y-m-d", strtotime("-1day"))?>',
                        sThisWeek: '<?=date("Y-m-d", strtotime("this week"))?>',
                        eThisWeek: '<?=date("Y-m-d", strtotime("this week sunday"))?>',
                        sLastWeek: '<?=date("Y-m-d", strtotime("last week"))?>',
                        eLastWeek: '<?=date("Y-m-d", strtotime("last week sunday"))?>',
                        sThisMonth: '<?=date("Y-m-01", strtotime(date("Y-m-d")))?>',
                        eThisMonth: '<?=date("Y-m-d", strtotime(date("Y-m-01", strtotime(date("Y-m-d"))) . "+1 month -1 day"))?>',
                        sLastMonth: '<?=date("Y-m-01", strtotime("last month"))?>',
                        eLastMonth: '<?=date("Y-m-d", strtotime(date("Y-m-01") . "-1 day"))?>',
                        game_store_types: <?= $game_store_types ?>,
                    }
                },
                created: function () {
                    // this.load();
                },
                watch: {
                    
                },
                mounted: function () {
                    //解決jquery與vue衝突,先加载vue.js，让页面渲染完成后加载jq，给jq绑定ready事件
                    // $.getScript('../templates/js/home/home.js');

                    $('.date-picker').datepicker({
                        rtl: App.isRTL(),
                        orientation: "left",
                        autoclose: true,
                        format: "yyyy-mm-dd",
                    });
                    
                    $('.timepicker-24').timepicker({
                        timeFormat: 'H:i:s',
                        autoclose: true,
                        minuteStep: 1,
                        secondStep: 1,
                        showSeconds: true,
                        showMeridian: false
                    });

                    // handle button click
                    $('.datepicker').parent('.date-div').on('click', 'button', function(e){
                        e.preventDefault();
                        $(this).parent('.date-div').find('.datepicker').datepicker('show');
                    });

                    // handle button click
                    $('.timepicker').parent('.date-div').on('click', 'button', function(e){
                        e.preventDefault();
                        $(this).parent('.date-div').find('.timepicker').timepicker('showWidget');
                    });
                },
                methods: {
                    onSearch: function () {
                        var begin = $("#sdate").val() + " " + $("#stime").val();
                        var end = $("#edate").val() + " " + $("#etime").val();
                        console.log(begin);
                        console.log(end);

                        location.href = 'personal_overview?startTime=' + begin + '&endTime=' + end;
                    },
                    onDate:function (type) {
                        var begin = '';
                        var end = '';
                        if (type == 'today') {
                            begin = this.today;
                            end = this.today;
                        } else if (type == 'yesterday') {
                            begin = this.yesterday;
                            end = this.yesterday;
                        } else if (type == 'thisweek') {
                            begin = this.sThisWeek;
                            end = this.eThisWeek;
                        } else if (type == 'lastweek') {
                            begin = this.sLastWeek;
                            end = this.eLastWeek;
                        } else if (type == 'thismonth') {
                            begin = this.sThisMonth;
                            end = this.eThisMonth;
                        } else if (type == 'lastmonth') {
                            begin = this.sLastMonth;
                            end = this.eLastMonth;
                        }
                        
                        $("#sdate").datepicker("update", begin);
                        $("#edate").datepicker("update", end);
                        $("#stime").timepicker("setTime", '0:00:00');
                        $("#etime").timepicker("setTime", '23:59:59');
                    }
                },
            });

        </script>
    </body>
</html>