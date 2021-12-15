$(function() {
	
});

function save_info(){
	requestJSON("sys_func_set_op.php", "pdisplay=save_info", "", "#sys-func-setting-form");
}
