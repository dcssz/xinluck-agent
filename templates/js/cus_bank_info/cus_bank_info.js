// JavaScript Document);
$(function(){
	//change_bank_area($('#back-area-select').val());
})

function add_cus_bank_info(){
	close_layer({type: 1});
	customize_layer_open({
		title: false,
		area: 'auto',
		maxWidth: '100%',
		maxHeight: '100%',
		content: $('#edit-cus-bank-info-area'),
		shadeClose: true,
		closeBtn: false,
		type:1,
		btn: [change_lang_txt({"org_txt" : "關閉"})],
		btn1: function(){close_layer({type: 1});}
	});
}

function request_cus_bank_info_detail(info_id){
	requestJSON("cus_bank_info_op", "pdisplay=request_cus_bank_info_detail", "info_id=" + info_id);
}

function show_cus_bank_info_detail(){
	close_layer({type: 1});
	customize_layer_open({
		title: false,
		area: 'auto',
		maxWidth: '100%',
		maxHeight: '100%',
		content: $('#show-cus-bank-info-detail-area'),
		shadeClose: true,
		closeBtn: false,
		type:1,
		btn: [change_lang_txt({"org_txt" : "關閉"})],
		btn1: function(){close_layer({type: 1});}
	});
}

function change_bank_area(bank_area){
	var target_e = $('#bank-name-select');
	var is_show_1 = $('#is-show-1').val();
	target_e.html('');
	if(typeof bank_list[bank_area] !== 'undefined'){
		$.each(bank_list[bank_area], function(none_use_key, bank_opt_arr){
			//console.log(bank_name);
			var show_bank_name = change_lang_txt({"org_txt" : bank_opt_arr['bank_name']});
			if(typeof bank_opt_arr['bank_code'] !== 'undefined'){
				if(bank_opt_arr['bank_code'] == 700 && is_show_1 != 1){
					return;	
				}
				show_bank_name = bank_opt_arr['bank_code'] + " " + show_bank_name;
			}
			target_e.append('<option value="' + show_bank_name + '">' + show_bank_name + '</option>');
		});
	}
}

/*function change_bank_province(){
	//開戶省如果變動, 開戶市要更新為該省內的城市
	var bank_province = $("select[name=bank_province]").val();
	requestJSON("cus_bank_info_op.php", "pdisplay=change_bank_province", "bank_province=" + bank_province);
}*/

function save_cus_bank_info(){
	requestJSON("/agent/cus_bank_info_op", "pdisplay=save_cus_bank_info", "", "#edit-form");
}