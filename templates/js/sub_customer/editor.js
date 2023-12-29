// JavaScript Document
function add_action(){
	var etype = $("#etype").val();
	var edit_cus_id = $("#edit-cus-id").val();
	requestJSON("/agent/sub_customer_op","pdisplay=add_action","etype=" + etype + "&edit_cus_id=" + edit_cus_id, "#ea_form");
}