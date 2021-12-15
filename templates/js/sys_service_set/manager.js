$(function() {
	
});

function save_info(){
	requestJSON("/admin/sys_service_save", "pdisplay=save_info", "", "#sys-service-setting-form");
}
