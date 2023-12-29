var count_index_time = 0;
var count_sound_time = 0;
var page2initial_url_arr = {};
$(function() {
	resize_iframe_div_initital();
	$(window).bind('resize', function () {
		resize_iframe_div_initital();
	});
	
	setInterval(now_time_run, 1000);//每1000毫秒调用一次函数
});

function now_time_run(){
	var now = new Date();
	var year = now.getFullYear();
	var month = now.getMonth()+1;//月份少1
	if(month < 10){
		month = "0" + month;
	}
	var date = now.getDate();
	if(date < 10){
		date = "0" + date;
	}
	//var week = "星期" + "日一二三四五六".split(/(?!\b)/)[now.getDay()];
	var hours = now.getHours();
	if(hours < 10){
		hours = "0" + hours;
	}
	var minutes = now.getMinutes();
	if(minutes < 10){
		minutes = "0" + minutes;
	}
	var seconds = now.getSeconds();
	if(seconds < 10){
		seconds = "0" + seconds;
	}

	var now_datetime = year + "-" + month + "-" + date + " " + hours + ":" + minutes + ":" + seconds;
	$("#now-time").html(now_datetime);
	
	count_index_time += 1;
	if(count_index_time >= 10){
		count_index_time = 0;
		//requestJSON("index_op.php", "pdisplay=update_info", "" , "");
	}
	
	count_sound_time += 1;	//計算幾秒後要出音效
}

function event_reload_second_countdown_start(){
	clearInterval(countdownid);
	countdownid = window.setInterval(event_reload_second_countdown, 1000);
}

function event_reload_second_countdown(){
	var el = $('#event-reload-second');
	if(el.length > 0){
		var now_second = el.text();
		now_second -= 1;
		el.text(now_second);
		if(now_second == 0){
			//clearInterval(countdownid);
			$("#events-reload-all > img").click();
		}
	}
}

function resize_iframe_div_initital(){
	var fast_menun_btn = $("#fast-menu-btn-div");
	var iframe_change_btn = $("#iframe-change-btn-div");
	var iframe_div = $("#iframe-div");
	//page-content 上下各10padding, iframe_div有margin-top:10, fast-menun-btn 有 10padding, margin-bottom 10
	iframe_div.height($(window).height() - iframe_change_btn.height() - (fast_menun_btn.height()+20+10) - 20 -10);
}

function show_page(e, page_name, file_name){
	var iframe_id = page_name + "_iframe";
	var span_id = page_name + "_span";
	var iframe = $("#" + iframe_id);
	if(iframe.size() > 0){	//已經存在這個iframe
		change_page(page_name);
		reload_page(e, page_name, file_name);
	}else{
		window.currentFrame = iframe_id;
		$("#iframe-div .its-iframe").hide();
		$("#iframe-change-btn-div .change-btn-span.active").removeClass("active");
		var reload_btn = '<img src="/templates/images/reload-red-32.ico" class="reload-icon active" onclick="iframe_reload_btn_click(this, \'' + page_name + '\');">';
		var delete_btn = '&nbsp;<span class="delete-item" onclick="delete_page(\'' + page_name + '\');">X</span>';
		var title_txt = $(e).attr("title_name");
		$("#iframe-change-btn-div").append('<span id="' + span_id + '" class="change-btn-span active" onclick="change_page(\'' + page_name + '\')">' + title_txt + reload_btn + delete_btn + '</span>');
		$("#iframe-div").append('<iframe id="' + iframe_id + '" src="' + file_name + '" class="its-iframe">');
		
		window.frames[iframe_id].onload = function(e){
			var _iframe = window.frames[iframe_id];
			// 檢查儲存位置是否已建立
			if(typeof window.iframeHistory === 'undefined') window.iframeHistory = [];
			if(typeof window.iframeHistory[iframe_id] === 'undefined') window.iframeHistory[iframe_id] = [];
			var currentLocation = _iframe.contentWindow.location.href;
			// 當頁刷新的情況下, 若最後一個是為相同連結, 否則不記錄 
			var _length = window.iframeHistory[iframe_id].length;
			if(_length > 0){
				if(window.iframeHistory[iframe_id][_length-1] === currentLocation){
					return false;
				}else{
					var last_url = window.iframeHistory[iframe_id][_length-1].split('?')[0];
					var current_url = currentLocation.split('?')[0];
					if(last_url === current_url){
						var current_file_name = current_url.split('/')[current_url.split('/').length-1];
						if(current_file_name === "agent_info_editor.php" || current_file_name === "cus_info_editor.php"){
							window.iframeHistory[iframe_id][_length-1] = currentLocation;
							return false;
						}
					}
				}/*else{
					var is_cover = 1;
					var last_url = window.iframeHistory[iframe_id][_length-1].split('?')[0];
					var current_url = currentLocation.split('?')[0];
					if(last_url === current_url){
						//=== 暫時用 start ===//
						var last_param = window.iframeHistory[iframe_id][_length-1].split('?')[1];
						var current_param = currentLocation.split('?')[1];
						var last_param_lev = last_param.split('&')[0];
						var current_param_lev = current_param.split('&')[0];
						if(last_param_lev != current_param_lev)
							is_cover = 0;
						//=== 暫時用 end ===//
						
						if(is_cover == 1){
							window.iframeHistory[iframe_id][_length-1] = currentLocation;
							return false;
						}
					}
				}*/
			}
			// 將各 iframe 的 history 各別儲存
			window.iframeHistory[iframe_id].push(currentLocation);
		}
	}
}

function change_page(page_name){
	var iframe_id = page_name + "_iframe";
	var span_id = page_name + "_span";
	$("#iframe-div .its-iframe").hide();
	$("#iframe-change-btn-div .change-btn-span.active").removeClass("active");
	
	if($("#iframe-div #" + iframe_id).length > 0){
		$("#iframe-div #" + iframe_id).show();
		$("#iframe-change-btn-div #" + span_id).addClass("active");	
	}else{
		//顯示最後一個
		var counts = ($('.change-btn-span').length-1);
		span_id = $("#iframe-change-btn-div .change-btn-span")[counts].id;
		page_name = span_id.replace(/_span/, "");
		iframe_id = page_name + "_iframe";
		//$("#iframe-div .its-iframe")[counts].show();
		//console.log("#iframe-change-btn-div #" + span_id);
		//$("#iframe-change-btn-div #" + span_id).onclick();
		$("#iframe-div #" + iframe_id).show();
		$("#iframe-change-btn-div #" + span_id).addClass("active");
	}
	window.currentFrame = iframe_id;
}

function reload_page(e, page_name, file_name){
	var iframe_id = page_name + "_iframe";
	//change_page(page_name);
	//$(e).addClass("active");
	$('#' + iframe_id).attr('src', file_name);
}

function delete_page(page_name){
	var iframe_id = page_name + "_iframe";
	var span_id = page_name + "_span";
	$("#iframe-div #" + iframe_id).remove();
	$("#iframe-change-btn-div #" + span_id).remove();
}

function delete_all_page(){
	$("#iframe-change-btn-div .delete-item").each(function(index, element) {
        $(this).click();
    });
}

function iframe_reload_btn_click(e, page_name){
	reload_page(e, page_name, page2initial_url_arr[page_name]);
}

// 回上一頁（global用, 在 iframe 頁面中呼叫, parent.goIframeHistoryBack(); ）
function goIframeHistoryBack(obj, event){
    event.preventDefault();
    var _id = window.currentFrame;
	window.iframeHistory[_id].pop(); // 移除當前頁面連結
    var last = window.iframeHistory[_id].pop(); // 上一頁連結
	if(typeof last !== 'undefined')
		document.getElementById(_id).src = last;
}

function play_sound(id){
	if(count_sound_time >= 60){
		$('#' + id).trigger('play');
		count_sound_time = 0;
	}
}

