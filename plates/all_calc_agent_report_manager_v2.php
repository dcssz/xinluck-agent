
<!DOCTYPE html><!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]--><!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]--><!--[if !IE]><!--><html lang="en" class="no-js">
	<!--<![endif]-->	<!-- BEGIN HEAD -->	<head>
	<meta charset="utf-8"/>     
	<meta http-equiv="X-UA-Compatible" content="IE=edge">    
    <!--<meta content="width=device-width, initial-scale=1" name="viewport"/>-->    
    <meta content="" name="description"/>   
	<meta content="" name="keywords"/>    
    <meta content="" name="author"/>    
    <title>控端</title>      
	<!-- BEGIN PAGE TOP STYLES -->   
	<!-- END PAGE TOP STYLES -->     
	<!-- BEGIN GLOBAL MANDATORY STYLES -->    
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
	<link href="/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />    
    <!-- END THEME GLOBAL STYLES -->        <!-- BEGIN THEME LAYOUT STYLES -->     
	<link href="/assets/layouts/layout/css/self-layout.css" rel="stylesheet" type="text/css" /> 
	<link href="/assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />    
    <link href="/assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />     
	<!-- END THEME LAYOUT STYLES -->      
	<link href="/templates/css/style.css?cache=209" rel="stylesheet" type="text/css"/>	
	<link href="/templates/css/tw_style.css?cache=205" rel="stylesheet" type="text/css"/>       
	<!-- BEGIN PAGE FIRST SCRIPTS -->     
	<script src="/assets/global/plugins/jquery.min.js" type="text/javascript"></script>    
    <!-- END PAGE FIRST SCRIPTS -->      
	<link rel="shortcut icon" href="#"/>	
	</head>	<!-- END HEAD -->	
<body>
<div class="page-inner-content" >
	<!--slot=0-->
	<style>
		.page-bar {
			margin-bottom: 5px;
		}
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
		th
		{
			text-align: center;
		}
		td
		{
			text-align: right;
		}	
		.nowrap{
			white-space: nowrap;
		}	
		.min-w-400{
			min-width: 400px;
		}
		.date-div{
			display: flex;
			align-items: center;
		}
		.date-div .sign{
			padding:0px 20px;
		}
		.title-class{
			font-weight: bold;
			margin-left: 5px;
		}
		#report-form{
			display:inline;
		}
		.search-detail-div{
			margin-bottom: 10px;
			background-color: #e7ecf1 !important;
			padding: 5px !important;
		}
		.search-detail-div .detail-bar{
			padding: 5px;
		}
		.search-detail-div .date-pick-div .btn{
			padding: 3px 12px !important;
		}
		#ckout-items-btn-area {
			margin-bottom: 10px;
		}
		#ckout-items-btn-area .ckout-items-btn{
			padding: 4px 6px;
			text-decoration: none;
			margin-left: 10px;
			border: 1px solid #337ab7!important;
			color: #337ab7;
			font-weight: bold;
			font-family: "微軟正黑體";
			display:inline-block;
		}
		#ckout-items-btn-area .ckout-items-btn.active{
			background-color:#337ab7;
			color: #FFF;
		}
		.list-table .plus-btn-class{
			display: inline-block;
			padding: 0px 4px;
			background-color: goldenrod;
			line-height: 15px;
			position: relative;
			left: 5px;
			cursor: pointer;
		}
		.notes{
			color:red;
		}
	</style>
	<div id="app">
	
		<form id="report-form" class="form-horizontal" role="form" method="GET" action="all_calc_agent_report_manager_v2">
			<div class="page-bar">
				<div class="act-group hidden">
					<button class="btn green-sharp btn-large " onclick="parent.goIframeHistoryBack(this, event);"> <i class="fa fa-mail-reply"></i> <font class="">回上頁</font> </button>
				</div>
				<div class="act-group">
					<span>日期類型</span>&nbsp;
					<select name="search_date_type">
						<!-- <option value="1" >投注日期</option> -->
						<option value="2" >結算日期</option>
						<!-- <option value="3" >生效日期</option> -->
					</select>
				</div>
				<div class="act-group">
					<div class="date-div">
						<div>日期區間</div>&nbsp;
						<div class="input-group input-small date date-picker sddate" data-date="<?=$sddate?>" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
							<input type="text" class="form-control" id="search-start-date" name="sddate" v-model="sddate" readonly>
							<span class="input-group-btn">
								<button class="btn blue" type="button">
								<i class="fa fa-calendar"></i>
								</button>
							</span>
						</div>
						<div class="input-group input-small search-time">
							<input type="text" id="search-start-time" name="sdtime" v-model="sdtime" class="form-control timepicker timepicker-24" readonly>
							<span class="input-group-btn">
								<button class="btn blue" type="button">
									<i class="fa fa-clock-o"></i>
								</button>
							</span>
						</div>
						<div class="sign">~</div>
						<div class="input-group input-small date date-picker eddate" data-date="<?=$eddate?>" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
							<input type="text" class="form-control" id="search-end-date" name="eddate" v-model="eddate" readonly>
							<span class="input-group-btn">
								<button class="btn blue" type="button">
								<i class="fa fa-calendar"></i>
								</button>
							</span>
						</div>
						<div class="input-group input-small search-time">
							<input type="text" id="search-end-time" name="edtime" v-model="edtime" class="form-control timepicker timepicker-24" readonly>
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
					<select name="search_level">
						<option value="16" >會員</option>
						<option value="15" >代理</option>
						<option value="14" >總代</option>
					</select>
				</div>
				<div class="act-group">
					<span>帳號</span>&nbsp;
					<input type="text" size="8" name="search_customer_userid" value="">
				</div>
				<div class="act-group">
					<button type="button" class="btn btn-success search-btn" value="search">
						<i class="fa fa-search"></i> 查詢
					</button>
				</div>
			</div>
			<div class="search-detail-div">
				<div class="detail-bar date-pick-div">
					<span>快選日期</span>&nbsp;
					<button type="button" class="btn red btn-md" @click="quickSelect('yesterday')">昨日</button>
					<button type="button" class="btn red btn-md" @click="quickSelect('today')">今日</button>
					<button type="button" class="btn red btn-md" @click="quickSelect('lastweek')">上週</button>	
					<button type="button" class="btn red btn-md" @click="quickSelect('thisweek')">本周</button>
					<button type="button" class="btn red btn-md" @click="quickSelect('lastmonth')">上月</button>
					<button type="button" class="btn red btn-md" @click="quickSelect('thismonth')">本月</button>
				</div>
				<div class="detail-bar">
					
				</div>
			</div>
			<input name="pid" type="hidden" v-model="pid">
			<input name="search_member" type="hidden" v-model="search_member">
		</form>	
		<div id="ckout-items-btn-area">
			<!--a class="ckout-items-btn" href="all_calc_report_manager">總報表</a-->
			<a class="ckout-items-btn active" href="all_calc_agent_report_manager_v2">代理報表</a>
			<button type="button" class="btn blue btn-md" @click="back()">返回上層</button>
		</div>
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-group font-green-sharp"></i>
					<span class="caption-subject font-green-sharp bold uppercase">報表管理 - 代理報表V2</span>
					<span class="title-class">日期：<?=$sddate?>&nbsp;~&nbsp;<?=$eddate?></span>
				</div>
			</div>
			<div class="notes ">
				<!--div>※ 廠商上繳 = 會員輸贏 * 廠商上繳%</div>
				<div>※ 總計 = 商戶金流手續費 + 總優惠 + 總返水 + 會員輸贏 + 總佣金 + 廠商上繳</div-->
			</div>
			<div class="portlet-body">
			<div class="table-container">
				<table class="table table-striped table-bordered table-hover list-table"> 
				<thead> 
					<tr class="bg-green1 color-white"> 
					<th>層級</th>
					<th>帳號</th> 
					<th>會員數</th>
					<th>總筆數</th> 
					<th>下注金額</th> 
					<th>有效金額</th> 
					<th>會員輸贏</th>
					<th class="total-merchant-fee hidden">商戶金流手續費<span class="plus-btn-class " onclick="plus_btn_click(this, 'total-merchant-fee');">+</span></th>
					<th class="total-merchant-fee hidden">代理負擔</th>
					<th class="total-merchant-fee hidden">總代負擔</th>
					<th class="total-merchant-fee hidden">公司負擔</th>
					<th class="total-merchant-fee hidden">總優惠<span class="plus-btn-class " onclick="plus_btn_click(this, 'total-discount');">+</span></th>
					<th class="total-discount hidden">推薦優惠</th>
					<th class="total-discount hidden">其他優惠</th>
					<th>總退水</th>
					<th>未拆帳</th>
					<th>會員退水</th>
					<th>個人佔成</th>
					<th>個人退水</th>
					<th>應收下線</th>
					<th>應繳上線</th>
					<th>個人盈虧</th>
					<th>詳細內容</th>
					<!--th>總計</th--> 
					</tr> 
				</thead> 
				<tbody> 
					<tr v-for="user in users" :key="user.id">
						<td class="text-left" style="width:5rem;">${ getRoleName(user.role) }$</td>
						<td class="text-left">
							<template v-if="user.role === 'customer'">
								${ user.username }$&nbsp;(${ user.nickname }$)
							</template>
							<template v-else>
								<a @click="search(user.id)" >
									${ user.username }$&nbsp;(${ user.nickname }$)
								</a>
							</template>
						</td>
						<td>

							<a @click="search(user.id, 1)" >
								${ user.memerb_cnt }$
							</a>
						</td>
						<td>${ user.Cnt }$</td>
						<template v-if="user.role === 'customer'">
							<td>
								<a :href="'/agent/cus_bet_info_manager?sddate='+ sddate + '&sdtime=' + sdtime + '&eddate=' + eddate + '&edtime=' + edtime  + '&search_customer_userid=' + user.username ">${ user.totalAmount }$</a>
							</td>
							<td >
								<a :href="'/agent/cus_bet_info_manager?sddate='+ sddate + '&sdtime=' + sdtime + '&eddate=' + eddate + '&edtime=' + edtime  + '&search_customer_userid=' + user.username ">${ user.totalValidAmount }$</a>
							</td>
						</template>
						<template v-else>
							<td>${ user.totalAmount }$</td>
							<td>${ user.totalValidAmount }$</td>
						</template>
						<td :class="user.totalNetAmount > 0 ? 'green-txt' : 'red-txt'">${ user.totalNetAmount }$</td>
						<td :class="">${ user.totalRetreat }$</td>
						<td :class="user.temp > 0 ? 'green-txt' : 'red-txt'">${ user.temp }$</td>
						<td class="total-merchant-fee hidden">0</td>
						<td class="total-merchant-fee hidden">0</td>
						<td class="total-merchant-fee hidden">0</td>
						<td class="total-merchant-fee hidden">0</td>
						<td class="total-merchant-fee hidden">0</td>
						<td class="total-discount hidden">0</td>
						<td class="total-discount hidden">0</td>
						<td :class="user.totalCustomerRetreat > 0 ? 'green-txt' : 'red-txt'">${ user.totalCustomerRetreat }$</td>
						<td :class="user.selfExtraCommission > 0 ? 'green-txt' : 'red-txt'">${ user.selfExtraCommission }$</td>
						<td :class="user.selfRetreat > 0 ? 'green-txt' : 'red-txt'">${ user.selfRetreat }$</td>
						<td :class="user.receiveBot > 0 ? 'green-txt' : 'red-txt'">${ user.receiveBot }$</td>
						<td :class="user.giveTop > 0 ? 'green-txt' : 'red-txt'">${ user.giveTop }$</td>
						<td :class="user.winlose > 0 ? 'green-txt' : 'red-txt'">${ user.winlose }$</td>
						<!--td :class="user.total > 0 ? 'green-txt' : 'red-txt'">${ user.total }$</td-->
						<td>
							<div class="paction-btn-div">
								<a href="javascript:;" class="btn btn-xs default" @click="openRetreatDetail(user.username, user.details[user.id])" >
									<i class="fa fa-pencil"></i> 查看 </a>
								</a>
							</div>
						</td>
					</tr>
					<tr> 
						<td class="text-left" colspan="1" style="width:5rem;">總計</td> 
						<td class=""></td> 
						<td class=""></td> 
						<td class=""><?=$allTotal->Cnt?></td>
						<td class=""><?=$allTotal->totalAmount?></td>
						<td class=""><?=$allTotal->totalValidAmount?></td>
						<td class="<?=$allTotal->totalNetAmount > 0 ? 'green-txt' : 'red-txt' ?>"><?=$allTotal->totalNetAmount?></td>
						<td class=""><?=$allTotal->totalRetreat?></td>
						<td class="<?=$allTotal->temp > 0 ? 'green-txt' : 'red-txt' ?>"><?=$allTotal->temp?></td>
						<td class="hidden">0</td>
						<td class=" total-merchant-fee hidden">0</td>
						<td class=" total-merchant-fee hidden">0</td>
						<td class=" total-merchant-fee hidden">0</td>
						<td class="green-txt hidden">0</td>
						<td class=" total-discount hidden">0</td>
						<td class="green-txt total-discount hidden">0</td>
						<td class="<?=$allTotal->totalCustomerRetreat > 0 ? 'green-txt' : 'red-txt' ?>"><?=$allTotal->totalCustomerRetreat?></td>
						<td class="<?=$allTotal->selfExtraCommission > 0 ? 'green-txt' : 'red-txt' ?>"><?=$allTotal->selfExtraCommission?></td>					
						<td class="<?=$allTotal->selfRetreat > 0 ? 'green-txt' : 'red-txt' ?>"><?=$allTotal->selfRetreat?></td>
						<td class="<?=$allTotal->receiveBot > 0 ? 'green-txt' : 'red-txt' ?>"><?=$allTotal->receiveBot?></td>
						<td class="<?=$allTotal->giveTop > 0 ? 'green-txt' : 'red-txt' ?>"><?=$allTotal->giveTop?></td>
						<td class="<?=$allTotal->winlose > 0 ? 'green-txt' : 'red-txt' ?>"><?=$allTotal->winlose?></td>
					</tr>
					<tr v-if="users.length === 0">
						<td class="text-center" colspan="34">沒有資料</td>
					</tr>

				</tbody> 
				</table>

				</div>
			</div>

			<el-dialog
				:title="`退水明細 - ${selectedUser.username}`"
				:visible.sync="dialogRetreatVisible"
				width="95%" 
				top="5vh"
				custom-class="mobile-retreat-dialog">
				
				<div style="max-height: 70vh; overflow: hidden; display: flex; flex-direction: column;">
					
					<el-table 
						:data="selectedUser.details" 
						:cell-style="cellStyle" 
						style="width: 100%" 
						height="450" 
						border
						:stripe="true">
						
						<el-table-column prop="game_name" label="遊戲" min-width="100"></el-table-column>
						<el-table-column prop="Cnt" label="總筆數" min-width="100">
						<template #default="scope">
								<template v-if="scope.row.game_name=='總計'">
									${ scope.row.Cnt }$
								</template>
								<template v-else-if="selectedUser.username=='admin'">
									${ scope.row.Cnt }$
								</template>
								<template v-else>
									<a :href="'/agent/cus_bet_info_manager?sddate='+ sddate + '&sdtime=' + sdtime + '&eddate=' + eddate + '&edtime=' + edtime + '&search_customer_userid=' + selectedUser.username + '&search_game_store=' + scope.row.game_id ">${ scope.row.Cnt }$</a>
								</template>
							</template>
						</el-table-column>
						<el-table-column prop="totalAmount" label="下注金額" min-width="100"></el-table-column>
						<el-table-column prop="amount" label="有效投注" min-width="100"></el-table-column>
						<el-table-column prop="netAmount" label="輸贏金額" min-width="100"></el-table-column>
						<el-table-column prop="totalRetreat" label="總退水" min-width="100"></el-table-column>
						<el-table-column prop="retreatRate" label="退水規則(%)" min-width="120"></el-table-column>
						<el-table-column prop="retreatValue" label="個人退水" min-width="100"></el-table-column>
						<el-table-column prop="extraRate" label="佔成規則(%)" min-width="120"></el-table-column>
						<el-table-column prop="extraCommissionValue" label="個人佔成" min-width="100"></el-table-column>
						
					</el-table>
				</div>

				<template #footer>
					<el-button @click="dialogRetreatVisible = false">關閉</el-button>
				</template>
			</el-dialog>
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
		<script src="/templates/js/kang_common.js?cache=109"></script>
		<script src="/templates/js/kang_all.js?cache=203"></script>
		<script src="/templates/js/lang/tw.js?cache=203"></script>
        <script src="/templates/js/all_calc_agent_report/manager.js?cache=119" type="text/javascript"></script>
		<script src="/assets/global/plugins/vue.js" type="text/javascript"></script>
		<!-- 引入样式 -->
		<link rel="stylesheet" href="/assets/global/plugins/element-ui/theme-chalk/index.css">
		<!-- 引入组件库 -->
		<script src="/assets/global/plugins/element-ui/index.js"></script>
		<script src="/assets/global/plugins/axios.min.js"></script>

		<script>
			var app = new Vue({
				delimiters: ['${', '}$'],
				el: '#app',
				data: function () {
					return {
						// 這裡可以定義 Vue 的數據
						users: <?=json_encode($users)?>,
						sddate: "<?=$sddate?>",
						eddate: "<?=$eddate?>",
						sdtime: "<?=$sdtime?>",
						edtime: "<?=$edtime?>",
						pid: "<?=$pid?>",
						last_pid: "<?=$last_pid?>",
						search_member: "<?=$search_member?>",
						dialogRetreatVisible: false,
						selectedUser: {
							username: '',
							details: []
						}
					};
				},
				created() {
					console.log(this.users);
					console.log(this.sddate);
				},
				methods: {
					openRetreatDetail(username, details) {
						let arr = Object.values(details);
						arr.push({
							game_name: '總計',
							Cnt: arr.reduce((sum, item) => sum + item.Cnt, 0),
							totalAmount: arr.reduce((sum, item) => sum + item.totalAmount, 0).toFixed(2),
							amount: arr.reduce((sum, item) => sum + item.amount, 0).toFixed(2),
							netAmount: arr.reduce((sum, item) => sum + item.netAmount, 0).toFixed(2),
							retreatValue: arr.reduce((sum, item) => sum + item.retreatValue, 0).toFixed(2),
							extraCommissionValue: arr.reduce((sum, item) => sum + item.extraCommissionValue, 0).toFixed(2),
							totalRetreat: arr.reduce((sum, item) => sum + item.totalRetreat, 0).toFixed(2),
						})
						this.selectedUser = {
							username: username,
							details: arr,//轉為陣列
						};
						this.dialogRetreatVisible = true;
					},
					getRoleName(role) {
						const map = {
							customer: '會員',
							agent: '代理',
							topagent: '總代',
							// 根據實際定義補上其他角色
						};
						return map[role] || role;
					},
					quickSelect(type) {
						const now = new Date();
						let start, end;

						const pad = (n) => n.toString().padStart(2, '0');
						const formatDate = (date) => {
							return `${date.getFullYear()}-${pad(date.getMonth() + 1)}-${pad(date.getDate())}`;
						};

						switch (type) {
							case 'yesterday': {
								const temp = new Date(now);
								temp.setDate(now.getDate() - 1);
								start = end = temp;
								break;
							}
							case 'today': {
								start = end = new Date();
								break;
							}
							case 'lastweek': {
								const weekday = now.getDay(); // 0=周日, 1=周一, ... 6=周六
								const hours = now.getHours();

								if (weekday === 0 && hours >= 12) {
									end = new Date(now);
									start = new Date(end);
									start.setDate(end.getDate() - 7);
								} else {
									// 正常邏輯：周一到周日
									const wd = weekday || 7; // 把周日(0)轉成7
									end = new Date(now);
									end.setDate(now.getDate() - wd);
									start = new Date(end);
									start.setDate(end.getDate() - 7);
								}
								break;
							}
							case 'thisweek': {
								const weekday = now.getDay(); // 0=周日, 1=周一, ... 6=周六
								const hours = now.getHours();

								if (weekday === 0 && hours >= 12) {
									// 如果是周日中午12點後
									start = new Date(now);
									end = new Date(start);
									// 下週日
									end.setDate(start.getDate() + 7);
								} else {
									// 正常邏輯：周一到周日
									const wd = weekday || 7; // 把周日(0)轉成7
									start = new Date(now);
									start.setDate(now.getDate() - wd);
									end = new Date(start);
									end.setDate(start.getDate() + 7); 
								}
								break;
							}
							case 'lastmonth': {
								start = new Date(now.getFullYear(), now.getMonth() - 1, 1);
								end = new Date(now.getFullYear(), now.getMonth(), 0); // 上個月的最後一天
								break;
							}
							case 'thismonth': {
								start = new Date(now.getFullYear(), now.getMonth(), 1);
								end = new Date(now.getFullYear(), now.getMonth() + 1, 0); // 本月的最後一天
								break;
							}
							default:
								return;
						}

						this.sddate = formatDate(start);
						this.eddate = formatDate(end);
						if (type == 'thisweek' || type == 'lastweek') {
							this.sdtime = '12:00:00';
							this.edtime = '11:59:59';
						} else {
							this.sdtime = '00:00:00';
							this.edtime = '23:59:59';
						}

						this.search();
					},
					search(pid=null, search_member=null) {
						if (pid) {
							this.pid = pid
						}
						if (search_member !== null) {
							this.search_member = search_member
						}
						location.href = "all_calc_agent_report_manager_v2?report_lev=2&pid="+this.pid+"&sddate="+this.sddate+"&eddate="+this.eddate+"&sdtime="+this.sdtime+"&edtime="+this.edtime+"&asearch_date_type=1&astation_code_all=all&search_member="+this.search_member;
					},
					back() {
						if (this.pid > 0) {
							this.pid = this.last_pid
							this.search(this.pid, 0);
						}
					},
					cellStyle({row, column, rowIndex, columnIndex}) {
						if (column.property === 'netAmount') { 
							if (row.netAmount > 0) {
								return { color: 'green'};
							} else {
								return { color: 'red' };
							}
						}
						if (column.property === 'retreatValue' ) { 
							if (row.retreatValue > 0) {
								return { color: 'green'};
							} else {
								return { color: 'red' };
							}
						}
						if (column.property === 'extraCommissionValue') { 
							if (row.extraCommissionValue > 0) {
								return { color: 'green'};
							} else {
								return { color: 'red' };
							}
						}
						return "";
					}
				}
			});
		</script>
    </body>
</html>