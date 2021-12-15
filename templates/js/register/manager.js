$(function() {
	
});

function save_info(){
	requestJSON("/admin/save_register", "pdisplay=save_info", "", "#register-setting-form");
}
