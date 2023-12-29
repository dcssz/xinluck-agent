var save_withdraw_flag = 1;
$(function(){
})

function save_withdraw(){
	if(save_withdraw_flag == 0){
		alert(change_lang_txt({"org_txt" : "請稍候"}) + "!");
	}else{
		save_withdraw_flag = 0;
		layer_loading({'type': 1});
		requestJSON("/agent/cus_withdraw_op", "pdisplay=save_withdraw", "", "#withdraw-form");
	}
}

function cmp_amount_info(){
	var apply_amount = $("#apply-amount-input").val();
	var handling_fee_type = $('#handling-fee-type').val();
	var handling_fee_percent = $('#handling-fee-percent').val();
	var handling_fee_amount = $('#handling-fee-amount').val();
	var is_free_withdraw = $('#is-free-withdraw').val();
	var admin_fee_percent = $('#admin-fee-percent').val();
	var total_remain_audit_amount = $("#total-remain-audit-amount").val();
	
	var handling_fee = 0;
	if(is_free_withdraw == 0){
		if(handling_fee_type == 1){
			handling_fee = apply_amount * handling_fee_percent * 0.01;
		}else{
			handling_fee = handling_fee_amount;
		}
	}
	
	var admin_fee = 0;
	if(total_remain_audit_amount > 0)
		admin_fee = total_remain_audit_amount * admin_fee_percent * 0.01;
	
	$('#handling-fee').html(handling_fee);
	$('#admin-fee').html(admin_fee);
	$('#actual-amount').html(apply_amount - handling_fee - admin_fee);
}