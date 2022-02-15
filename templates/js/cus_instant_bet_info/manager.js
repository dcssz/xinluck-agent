// JavaScript Document
var countdownid;
var countdown_timer = 0;
$(function(){
	/*var opt = {
		//以下為日期選擇器部分
		dayNames:["星期日","星期一","星期二","星期三","星期四","星期五","星期六"],
		dayNamesMin:["日","一","二","三","四","五","六"],
		monthNames:["一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"],
		monthNamesShort:["一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"],
		prevText:"上月",
		nextText:"次月",
		weekHeader:"週",
		showMonthAfterYear:true,
		dateFormat:"yy-mm-dd",
		//以下為時間選擇器部分
		timeOnlyTitle:"選擇時分秒",
		timeText:"時間",
		hourText:"時",
		minuteText:"分",
		secondText:"秒",
		millisecText:"毫秒",
		timezoneText:"時區",
		currentText:"現在時間",
		closeText:"確定",
		amNames:["上午","AM","A"],
		pmNames:["下午","PM","P"],
		showSecond:true,
		timeFormat:"HH:mm:ss"
	};
	$('.date-picker').datetimepicker(opt);*/
	datetime_picker_init();
	
	$(".search-btn").click(function(){
		/*var sddate = $("#search-start-date").val();
		var eddate = $("#search-end-date").val();
		var search_date_type = $('select[name=search_date_type').val();
		var search_customer_userid = $('input[name=search_customer_userid').val();
		var search_level = $('select[name=search_level').val();
		var search_game_store = $('select[name=search_game_store').val();
		var search_game_category = $('select[name=search_game_category').val();
		var search_is_finished = $('select[name=search_is_finished').val();
		var search_order_no = $('input[name=search_order_no').val();
		var search_bet_amount = $('input[name=search_bet_amount').val();
		var search_win_amount = $('input[name=search_win_amount').val();
		var page_now = $("#page-now").val();*/
		layer.open({
			title: false,
			content: change_lang_txt({"org_txt" : "搜尋中"}) + '...',
			closeBtn: false,
			shade: 0.5,
			btn: false,
			type: 0,
			icon: 16
		});
		
		//location.href = "cus_instant_bet_info_manager.php?sddate=" + sddate + "&eddate=" + eddate + "&search_date_type=" + search_date_type + "&search_customer_userid=" + search_customer_userid + "&search_level=" + search_level + "&search_game_store=" + search_game_store + "&search_game_category=" + search_game_category + "&search_is_finished=" + search_is_finished + "&search_order_no=" + search_order_no + "&page_now=" + page_now;
		//var param = "search_customer_userid=" + search_customer_userid + "&search_level=" + search_level + "&search_game_store=" + search_game_store + "&search_game_category=" + search_game_category + "&search_is_finished=" + search_is_finished + "&search_bet_amount=" + search_bet_amount + "&search_win_amount=" + search_win_amount + "&page_now=" + page_now;
		//requestJSON("cus_instant_bet_info_op.php", "pdisplay=request_bet_info_table_div", "", "#report-form");
		$('#report-form').submit();
	});

	$("#change-timer-select").val($('#timer').val());
	change_countdown_timer();
});

function data_reload_second_countdown(){
	countdown_timer -= 1;
	if(countdown_timer < 0){
		var time_val = $("#change-timer-select").val();
		countdown_timer = time_val;
		$(".search-btn").click();
	}else if(countdown_timer < 10){
		countdown_timer = "0" + countdown_timer;
	} 
	
	$("#countdown-timer").text(countdown_timer);
}

function change_countdown_timer(){
	clearInterval(countdownid);
	//$(".search-btn").click();
	var time_val = $("#change-timer-select").val();
	$('#timer').val(time_val);
	if(time_val == -1){
		countdown_timer = change_lang_txt({"org_txt" : "不更新"});
	}else{
		countdown_timer = time_val;
		countdownid = window.setInterval(data_reload_second_countdown, 10000);//每1000毫秒调用一次函数
	}
	$("#countdown-timer").text(countdown_timer);
}

function datetime_picker_init() {
	$('.date-picker').datepicker({
		rtl: App.isRTL(),
		orientation: "left",
		autoclose: true
	});
	
	$('.timepicker-24').timepicker({
		timeFormat: 'H:i:s',
		autoclose: true,
		minuteStep: 1,
		secondStep: 1,
		showSeconds: true,
		showMeridian: false
	});

	// handle input group button click
	$('.timepicker').parent('.input-group').on('click', '.input-group-btn', function(e){
		e.preventDefault();
		$(this).parent('.input-group').find('.timepicker').timepicker('showWidget');
	});
}

function change_game_store(){
	var edit_game_store = $("select[name=search_game_store]").val();
	requestJSON("/agent/cus_instant_bet_info_op", "pdisplay=change_game_store", "edit_game_store=" + edit_game_store);
}

function show_order_content_detail(e){
	var game_store = $(e).attr("game_store");
	var order_id = $(e).attr("order_id");
	requestJSON("/agent/cus_instant_bet_info_op", "pdisplay=show_order_content_detail", "game_store=" + game_store + "&order_id=" + order_id, "");
}

function select_page(select_page){
	var page_now = $("#page-now").val(select_page);
	/*var url = location.href.split('?');	
	
	var href = url[0];
	var parameter = url[1];
	if (parameter == undefined){
		parameter = '&page_now=1';
	}else{
		if(parameter.indexOf('page_now') == -1)
			parameter += '&page_now=1';
	}
	
	parameter = parameter.replace("&page_now=" + page_now, "&page_now=" + select_page);
	
	window.location.replace(href + "?" + parameter);//此跳轉方式可讓history.go(-1) 不會記錄這個url*/
	$(".search-btn").click();
}