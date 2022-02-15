// JavaScript Document
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
	initial_item_ckbox_set();
	
	$(".search-btn").click(function(){
		/*var sddate = $("#search-start-date").val();
		var eddate = $("#search-end-date").val();
		var search_date_type = $('select[name=search_date_type').val();
		var search_customer_userid = $('input[name=search_customer_userid').val();
		var search_level = $('select[name=search_level').val();*/
		
		layer.open({
			title: false,
			content: change_lang_txt({"org_txt" : "搜尋中"}) + '...',
			closeBtn: false,
			shade: 0.5,
			btn: false,
			type: 0,
			icon: 16
		});
		
		//location.href = "all_calc_agent_report_manager.php?sddate=" + sddate + "&eddate=" + eddate + "&search_date_type=" + search_date_type + "&search_customer_userid=" + search_customer_userid + "&search_level=" + search_level;
		$('#report-form').submit();
	});
});

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

/*function get_search_datetime(){
	var search_start_datetime = "";
	var search_end_datetime = "";
	
	var search_start_datetime_ui = $('#search_start_datetime').datepicker('getDate');
	var search_ends_datetime_ui = $('#search_ends_datetime').datepicker('getDate');
	if (search_start_datetime_ui !== null && search_ends_datetime_ui !== null) {
		search_start_datetime_ui instanceof Date;
		search_ends_datetime_ui instanceof Date;
		
		search_start_datetime = search_start_datetime_ui.getFullYear() + "-" + (search_start_datetime_ui.getMonth() + 1) + "-" + search_start_datetime_ui.getDate() + " " + search_start_datetime_ui.getHours() + ":" + search_start_datetime_ui.getMinutes() + ":" + search_start_datetime_ui.getSeconds();
		search_end_datetime = search_ends_datetime_ui.getFullYear() + "-" + (search_ends_datetime_ui.getMonth() + 1) + "-" + search_ends_datetime_ui.getDate() + " " + search_ends_datetime_ui.getHours() + ":" + search_ends_datetime_ui.getMinutes() + ":" + search_ends_datetime_ui.getSeconds();
	}
	return [search_start_datetime, search_end_datetime];
}*/

function toggle_div(this_class){
	$("." + this_class).toggle();
}

function plus_btn_click(e, class_name){
	var this_e = $(e);
	var class_e = $("." + class_name);
	if(this_e.text() == "+"){
		this_e.text("-");
		class_e.removeClass('hidden');
	}else{
		this_e.text("+");
		class_e.addClass('hidden');
	}
}

function initial_item_ckbox_set(){
	$(".item-ckbox-all").each(function(index, element) {
		var spot = $(this).attr("spot");
		var item_ckbox_all_el = $(this);
		var item_ckbox_el = $("input[class='item-ckbox'][spot='" + spot + "']:enabled");
		
		//預設全選
		//item_ckbox_all_el.prop("checked",true);
		//item_ckbox_all_el.parent().attr("class","checked");
		//item_ckbox_el.prop("checked",true);
		//item_ckbox_el.parent().attr("class","checked");
		
		item_ckbox_all_el.click(function(){
			if($(this).prop("checked")){
				item_ckbox_el.prop("checked",true);
				item_ckbox_el.parent().attr("class","checked");		
			}else{
				item_ckbox_el.prop("checked",false);
				item_ckbox_el.parent().attr("class","");	
			}
		});
		
		
		item_ckbox_el.change(function(){
			if($("input[class='item-ckbox'][spot='" + spot + "']:checked").length == item_ckbox_el.length){
				item_ckbox_all_el.prop("checked",true);
				item_ckbox_all_el.parent().attr("class","checked");
			}
			else{
				item_ckbox_all_el.prop("checked",false);
				item_ckbox_all_el.parent().attr("class","");
			}
		});
		
		item_ckbox_el.change();
	});
}

$(".btn_yesterday").click(function(){
	var Today = new Date($(this).attr("today-date"));
	var sddate = $("input[name=sddate]").val();
	var eddate = $("input[name=eddate]").val();
	var date = new Date(Today.getFullYear(),Today.getMonth(),(Today.getDate()-1)).Format("yyyy-MM-dd");
	var set_date = date;
	//先判斷日期匡的日期是否小於等於昨天日期 是的話 就以日期匡的日期 - 1 不是的話以現在日期 - 1
	if(sddate <= date && eddate <= date && sddate == eddate){
		sddate = new Date(sddate);
		set_date = new Date(sddate.getFullYear(), sddate.getMonth(), (sddate.getDate()-1)).Format("yyyy-MM-dd");
	}
	
	
	$('.date-picker').each(function(index, element) {
		$(this).datepicker("setDate", set_date);
    });
})

$(".btn_today").click(function(){
	var Today = new Date($(this).attr("today-date"));
	var date = new Date(Today.getFullYear(),Today.getMonth(),Today.getDate()).Format("yyyy-MM-dd");
	$('.date-picker').each(function(index, element) {
		$(this).datepicker("setDate", date);
    });
})


$(".btn_lastweek").click(function(){
	var Today = new Date($(this).attr("today-date"));
	var now_day_of_week = Today.getDay();
	if(now_day_of_week == 0)
		now_day_of_week = 7;
	var sddate = $("input[name=sddate]").val();
	var eddate = $("input[name=eddate]").val();
		
	var WeekFirstDay = new Date(Today-now_day_of_week*86400000);
	var WeekLastDay = new Date((WeekFirstDay/1000+6*86400)*1000);
	
	var sd_date = new Date(WeekFirstDay.getFullYear(), WeekFirstDay.getMonth(), (WeekFirstDay.getDate()-6)).Format("yyyy-MM-dd");;
	var ed_date = new Date(WeekLastDay.getFullYear(), WeekLastDay.getMonth(), (WeekLastDay.getDate()-6)).Format("yyyy-MM-dd");;
	
	//先判斷日期匡的日期是否小於等於昨天日期 是的話 就以日期匡的日期 - 1 不是的話以現在日期 - 1
	if(sddate <= sd_date && eddate <= ed_date )
	{
		sddate = new Date(sddate);
		WeekFirstDay = new Date(sddate-(sddate.getDay())*86400000);
		WeekLastDay = new Date((WeekFirstDay/1000+6*86400)*1000);
		
		sd_date = new Date(WeekFirstDay.getFullYear(), WeekFirstDay.getMonth(), (WeekFirstDay.getDate()-6)).Format("yyyy-MM-dd");;
		ed_date = new Date(WeekLastDay.getFullYear(), WeekLastDay.getMonth(), (WeekLastDay.getDate()-6)).Format("yyyy-MM-dd");;
	}
	
	$('.sddate').each(function(index, element) {
		$(this).datepicker("setDate", sd_date);
    });	
	$('.eddate').each(function(index, element) {
		$(this).datepicker("setDate", ed_date);
    });
	
	
	
	
})


$(".btn_thisweek").click(function(){
	var Today = new Date($(this).attr("today-date"));
	var now_day_of_week = Today.getDay();
	if(now_day_of_week == 0)
		now_day_of_week = 7;
	var sd_date = new Date(Today-now_day_of_week*86400000+86400000).Format("yyyy-MM-dd");
	var sd = new Date(sd_date);
	var ed_date = new Date(sd.setDate(sd.getDate() + 6)).Format("yyyy-MM-dd");
	
	$('.sddate').each(function(index, element) {
		$(this).datepicker("setDate", sd_date);
    });	
	$('.eddate').each(function(index, element) {
		$(this).datepicker("setDate", ed_date);
    });
})


$(".btn_lastmonth").click(function(){
	var Today = new Date($(this).attr("today-date"));
	var sddate = $("input[name=sddate]").val();
	var eddate = $("input[name=eddate]").val();
	var sd_date = new Date(Today.getFullYear(),(Today.getMonth()-1),1).Format("yyyy-MM-dd");	
	var ed_date = new Date(Today.getFullYear(),(Today.getMonth()),0).Format("yyyy-MM-dd");	
			
	if(sddate <= sd_date && eddate <= ed_date)
	{
		sddate = new Date(sddate);
		sd_date = new Date(sddate.getFullYear(),(sddate.getMonth()-1),1).Format("yyyy-MM-dd");
		ed_date = new Date(sddate.getFullYear(),(sddate.getMonth()),0).Format("yyyy-MM-dd");
	}
		
	$('.sddate').each(function(index, element) {
		$(this).datepicker("setDate", sd_date);
    });	
	$('.eddate').each(function(index, element) {
		$(this).datepicker("setDate", ed_date);
    });
	
})


$(".btn_thismonth").click(function(){
	var Today = new Date($(this).attr("today-date"));
	
	var sd_date = new Date(Today.getFullYear(),Today.getMonth(),1).Format("yyyy-MM-dd");
	var ed_date = new Date(Today.getFullYear(),Today.getMonth(),Today.getDate()).Format("yyyy-MM-dd");
	
	$('.sddate').each(function(index, element) {
		$(this).datepicker("setDate", sd_date);
    });	
	
	$('.eddate').each(function(index, element) {
		$(this).datepicker("setDate", ed_date);
    })
})

//轉換日期格式用
Date.prototype.Format = function (fmt) { //author: meizz 
    var o = {
        "M+": this.getMonth() + 1, //月份 
        "d+": this.getDate(), //日 
        "h+": this.getHours(), //小时 
        "m+": this.getMinutes(), //分 
        "s+": this.getSeconds(), //秒 
        "q+": Math.floor((this.getMonth() + 3) / 3), //季度 
        "S": this.getMilliseconds() //毫秒 
    };
    if (/(y+)/.test(fmt)) fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
    for (var k in o)
    if (new RegExp("(" + k + ")").test(fmt)) fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
    return fmt;
}



