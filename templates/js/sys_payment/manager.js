$(function() {
	
});

function save_info(){
	requestJSON("sys_payment_op.php", "pdisplay=save_info", "", "#payment-setting-form");
}
