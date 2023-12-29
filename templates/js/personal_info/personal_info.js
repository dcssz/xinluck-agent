$(function(){
	//nav show 全部 tab-pan
	initial_nav_all_show();
});

function show_data_content(el_this, area_id){
	var el_area = $('#' + area_id);
	//按鈕選中
	$('.type-btn1').removeClass('active');
	$(el_this).addClass('active');
	
	//只顯示選中區塊
	$('.data-content').addClass('hidden');
	if($('#' + area_id + " #no-data").length > 0){//沒內容的話 跟伺服器要資料
		page_content_mask_show();
		requestJSON("personal_info_op.php", "pdisplay=get_data_content", "area_id=" + area_id);
		el_area.removeClass('hidden');
	}else{
		el_area.removeClass('hidden');
	}
	//el_area.removeClass('hidden');
}

function init_portlet_tiile_tools(area_id){
	$("#" + area_id + " .has_set_tool").click(function(){
		var tools_icon = $(' > .tool > a',this);
		//console.log(tools_icon.attr('class'));
		if(tools_icon.attr('class') == "expand"){
			tools_icon.attr('class','collapse');
			$(this).next('.tabbable-line').show();
		}else{
			tools_icon.attr('class','expand');
			$(this).next('.tabbable-line').hide();
		}
	});
	
	$('.has_set_tool').css('background-color','#f1d30f4d');
	$('.has_set_tool > .caption , .tools').css('padding','14px');
	$('.has_set_tool').css('cursor','pointer');
	$('.caption-subject').css('font-size','16px');
	
}

//初始化nav show 全部 tab-pan事件 
function initial_nav_all_show(){
	$("a[class=nav-all-show]").click(function()
	{
		$(this).parents(".tabbable-line").children(".tab-content").children(".tab-pane").addClass("active");
	});
}

function page_content_mask_show(){
	$("#page-content-mask").show();
}

function page_content_mask_hide(){
	$("#page-content-mask").hide();
}


function update_password(){
	requestJSON("/agent/personal_info_op", "pdisplay=update_password", "", "#password-form");
}

function request_rule_div(ckout_item, rule_id){
	requestJSON("personal_info_op.php", "pdisplay=request_rule_div", "ckout_item=" + ckout_item + "&rule_id=" + rule_id);	
}

function show_layer_div(id){
	close_layer({type: 1});
	customize_layer_open({
		title: false,
		area: '90%',
		maxWidth: '100%',
		maxHeight: '100%',
		content: $('#' + id),
		shadeClose: true,
		type:1
	});
}

function copy_link(e){
	var TextRange = document.createRange();
    TextRange.selectNode(e);
    sel = window.getSelection();
	sel.removeAllRanges();
	sel.addRange(TextRange);
    document.execCommand("copy");
	pop_msg(change_lang_txt({"org_txt" : "複製成功"}) + "!");
}

//=== add new 20220119 start ===//
function show_line_list(top_cus_id){
	var this_title = change_lang_txt({"org_txt" : 'Line 綁定註冊推薦碼'});
	customize_layer_open({
      type: 2,
      title: this_title,
      shadeClose: true,
      area : ['80%' , '80%'],
      content: 'line_list.php?show_type=1&top_cus_id=' + top_cus_id
    });
}
//=== add new 20220119 end ===//