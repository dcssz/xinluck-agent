$(function(){
	initial_item_ckbox_set();
});

function show_menu_div(e, spot){
	$(".type-btn1").removeClass("active");
	$(e).addClass("active");
	if(spot == 0){
		$(".show-menu-div").removeClass("hidden");	
	}else{
		$(".show-menu-div").addClass("hidden");
		$(".show-menu-div[spot=" + spot + "]").removeClass("hidden");	
	}
}

//=== 鍒嗙珯&娲诲嫊鍒嗛 start ===/
function initial_item_ckbox_set(){
	$(".item-ckbox-all").each(function(index, element) {
		var spot = $(this).attr("spot");
		var item_ckbox_all_el = $(this);
		var item_ckbox_el = $("input[class='item-ckbox'][spot='" + spot + "']:enabled");
		
		//闋愯ō鍏ㄩ伕
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

function save_employee(){
	var etype = $('#etype').val();
	var edit_employee_id = $('#edit-employee-id').val();
	requestJSON("/admin/employee_editor_op", "pdisplay=save_employee", "etype=" + etype + "&edit_employee_id=" + edit_employee_id, "#save-employee-form");
}