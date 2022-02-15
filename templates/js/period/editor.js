$(function(){
	datetime_picker_init();
	initial_item_ckbox_set();
	initial_display_content();
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
		minuteStep: 5,
		showSeconds: true,
		showMeridian: false
	});

	// handle input group button click
	$('.timepicker').parent('.input-group').on('click', '.input-group-btn', function(e){
		e.preventDefault();
		$(this).parent('.input-group').find('.timepicker').timepicker('showWidget');
	});
}

//=== 分站&活動分類 start ===/
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

function initial_display_content(){
	change_ckout_item();
	change_ckout_type();
}

function change_ckout_item(){
	var ckout_item = $("select[name=ckout_item]").val();
	$("div[class=rule-ckbx-div]").hide();
	$("div[class=rule-ckbx-div][ckout_item=" + ckout_item + "]").show();
	change_ckout_type();
}

function change_ckout_type(){
	var ckout_type = $("select[name=ckout_type]").val();
	var ckout_item = $("select[name=ckout_item]").val();
	var ckout_item_name = "";
	var period_name = "";
	if(ckout_type == 3){	//手動設定 沒有自動產生下期，沒有自動結轉下期
		$("input[name=start_date]").attr('disabled', false);
		$("input[name=end_date]").attr('disabled', false);
		
		$("input[name=start_time]").attr('disabled', false);
		$("input[name=end_time]").attr('disabled', false);
		
		$(".datetime-tr").show();
	}else{
		$("input[name=start_date]").attr('disabled', true);
		$("input[name=end_date]").attr('disabled', true);
		
		$("input[name=start_time]").attr('disabled', true);
		$("input[name=end_time]").attr('disabled', true);
		$(".datetime-tr").hide();
	}
	
}


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


function save_period(){
	//因為是送op更新 不會重整畫面 所以密碼部分一律在按下存檔後 清空
	var etype = $('#etype').val();
	var edit_period_id = $('#edit-period-id').val();
	var edit_unique_code = $("#edit-unique-code").val();
	requestJSON("/admin/save_period", "pdisplay=save_period", "etype=" + etype + "&edit_period_id=" + edit_period_id + "&edit_unique_code=" + edit_unique_code, "#save-period-form");
}

/*
Date.prototype.yyyymmdd = function() {
  var mm = this.getMonth() + 1; // getMonth() is zero-based
  var dd = this.getDate();

  return [this.getFullYear(),
          (mm>9 ? '' : '0') + mm,
          (dd>9 ? '' : '0') + dd
         ].join('');
};
*/