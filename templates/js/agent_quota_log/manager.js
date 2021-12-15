// JavaScript Document
var grid = new Datatable();
var TableDatatablesAjax = function () {
    var handleRecords = function () {
        grid.init({
            src: $("#manager_table"),
            onSuccess: function (grid, response) {
                // grid:        grid object
                // response:    json object of server side ajax response
                // execute some code after table records loaded
            },
            onError: function (grid) {
                // execute some code on network or other general error  
            },
            onDataLoad: function(grid) {
                // execute some code on ajax data load
            },
            loadingMessage: change_lang_txt({"org_txt" : "載入中"}) + '...',
            dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 

                // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
                // So when dropdowns used the scrollable div should be removed. 
                //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
                
                "bStateSave": false, // save datatable state(pagination, sort, etc) in cookie.

                "lengthMenu": 
				[
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 100, // default record count per page
                "ajax": {
                    //"url": "/op/agent_quota_log_op.php?pdisplay=display_manager_list&search_customer_userid=" + $("input[name=search_customer_userid]").val() + "&fuzzy_search=" + ($("input[name=fuzzy_search]").prop("checked") ? "1" : "0") + "&search_start_date=" + $('#search-start-date').val() + "&search_start_time=" + $('#search-start-time').val() + "&search_end_date=" + $('#search-end-date').val() + "&search_end_time=" + $('#search-end-time').val(), // ajax source
					"url": "/op/agent_quota_log_op.php?pdisplay=display_manager_list&" + $('#report-form').serialize(), // ajax source
                },
				 "bSort": false,
                /*"order": [
                    [1, "asc"]
                ]*/// set first column as a default sort by asc
				
				
				"language": { // language settings
					// metronic spesific
					"metronicGroupActions": "_TOTAL_ records selected:  ",
					"metronicAjaxRequestGeneralError": change_lang_txt({"org_txt" : "網路連線錯誤"}) + "!",

					// data tables spesific
					"lengthMenu": "<span class='seperator'>&nbsp;&nbsp;&nbsp;&nbsp;</span>" + change_lang_txt({"org_txt" : "每頁顯示"}) + " _MENU_ " + change_lang_txt({"org_txt" : "筆"}),
					"info": "<span class='seperator'>&nbsp;&nbsp;&nbsp;&nbsp;</span>" + change_lang_txt({"org_txt" : "共有"}) + " _TOTAL_ " + change_lang_txt({"org_txt" : "筆資料"}),
					"infoEmpty": "",
					"emptyTable": change_lang_txt({"org_txt" : "目前沒有資料"}) + "!",
					"zeroRecords": "No matching records found",
					"paginate": {
						"previous": change_lang_txt({"org_txt" : "Prev"}),
						"next": change_lang_txt({"org_txt" : "Next"}),
						"last": change_lang_txt({"org_txt" : "Last"}),
						"first": change_lang_txt({"org_txt" : "First"}),
						"page": change_lang_txt({"org_txt" : "頁數"}),
						"pageOf": change_lang_txt({"org_txt" : "of"}),
					}
				},
            }
        });
    }

    return {
        //main function to initiate the module
        init: function () {
            handleRecords();
        }

    };

}();

$(function(){
	datetime_picker_init();
	initial_item_ckbox_set();
	TableDatatablesAjax.init();
	$(".search-btn").click(function(){
		//grid.getDataTable().ajax.url("/op/agent_quota_log_op.php?pdisplay=display_manager_list&search_customer_userid=" + $("input[name=search_customer_userid]").val() + "&fuzzy_search=" + ($("input[name=fuzzy_search]").prop("checked") ? "1" : "0") + "&search_operate_type=" + $("select[name=search_operate_type]").val() + "&search_trans_type=" + $("select[name=search_trans_type]").val() + "&search_start_date=" + $('#search-start-date').val() + "&search_start_time=" + $('#search-start-time').val() + "&search_end_date=" + $('#search-end-date').val() + "&search_end_time=" + $('#search-end-time').val()).load();
		grid.getDataTable().ajax.url("/op/agent_quota_log_op.php?pdisplay=display_manager_list&" + $('#report-form').serialize()).load();
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

function toggle_div(this_class){
	$("." + this_class).toggle();
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
	var sddate = $("input[name=search_start_date]").val();
	var eddate = $("input[name=search_end_date]").val();
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
	
	$('#search-start-time').timepicker('setTime','00:00:00');
	$('#search-end-time').timepicker('setTime','23:59:59');
})

$(".btn_today").click(function(){
	var Today = new Date($(this).attr("today-date"));
	var date = new Date(Today.getFullYear(),Today.getMonth(),Today.getDate()).Format("yyyy-MM-dd");
	$('.date-picker').each(function(index, element) {
		$(this).datepicker("setDate", date);
    });
	
	$('#search-start-time').timepicker('setTime','00:00:00');
	$('#search-end-time').timepicker('setTime','23:59:59');
})


$(".btn_lastweek").click(function(){
	var Today = new Date($(this).attr("today-date"));
	var now_day_of_week = Today.getDay();
	if(now_day_of_week == 0)
		now_day_of_week = 7;
	var sddate = $("input[name=search_start_date]").val();
	var eddate = $("input[name=search_end_date]").val();
		
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
	
	
	$('#search-start-time').timepicker('setTime','00:00:00');
	$('#search-end-time').timepicker('setTime','23:59:59');
})


$(".btn_thisweek").click(function(){
	var Today = new Date($(this).attr("today-date"));
	var now_day_of_week = Today.getDay();
	if(now_day_of_week == 0)
		now_day_of_week = 7;
	var sd_date = new Date(Today-now_day_of_week*86400000+86400000).Format("yyyy-MM-dd");
	var ed_date = new Date(Today.getFullYear(),Today.getMonth(),Today.getDate()).Format("yyyy-MM-dd");
	
	$('.sddate').each(function(index, element) {
		$(this).datepicker("setDate", sd_date);
    });	
	$('.eddate').each(function(index, element) {
		$(this).datepicker("setDate", ed_date);
    });
	
	$('#search-start-time').timepicker('setTime','00:00:00');
	$('#search-end-time').timepicker('setTime','23:59:59');
})


$(".btn_lastmonth").click(function(){
	var Today = new Date($(this).attr("today-date"));
	var sddate = $("input[name=search_start_date]").val();
	var eddate = $("input[name=search_end_date]").val();
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
	
	$('#search-start-time').timepicker('setTime','00:00:00');
	$('#search-end-time').timepicker('setTime','23:59:59');
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
	
	$('#search-start-time').timepicker('setTime','00:00:00');
	$('#search-end-time').timepicker('setTime','23:59:59');
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