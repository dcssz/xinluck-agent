// JavaScript Document
var grid = new Datatable();
var TableDatatablesAjax = function () {
    var handleRecords = function () {
        grid.init({
            src: $("#manager_table"),
            onSuccess: function (grid, response) {
                // grid:        grid object
                // response:    json object of server side ajax response
                // execute some code after table records loaded
            },
            onError: function (grid) {
                // execute some code on network or other general error  
            },
            onDataLoad: function(grid) {
                // execute some code on ajax data load
            },
            loadingMessage: change_lang_txt({"org_txt" : "載入中"}) + '...',
            dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 

                // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
                // So when dropdowns used the scrollable div should be removed. 
                //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
                
                "bStateSave": false, // save datatable state(pagination, sort, etc) in cookie.

                "lengthMenu": 
				[
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 100, // default record count per page
                "ajax": {
                    "url": "/op/cus_discount_apply_op.php?pdisplay=display_manager_list&search_customer_userid=" + $("input[name=search_customer_userid]").val() + "&fuzzy_search=" + ($("input[name=fuzzy_search]").prop("checked") ? "1" : "0"), // ajax source
                },
				 "bSort": false,
                /*"order": [
                    [1, "asc"]
                ]*/// set first column as a default sort by asc
				
				
				"language": { // language settings
					// metronic spesific
					"metronicGroupActions": "_TOTAL_ records selected:  ",
					"metronicAjaxRequestGeneralError": change_lang_txt({"org_txt" : "網路連線錯誤"}) + "!",

					// data tables spesific
					"lengthMenu": "<span class='seperator'>&nbsp;&nbsp;&nbsp;&nbsp;</span>" + change_lang_txt({"org_txt" : "每頁顯示"}) + " _MENU_ " + change_lang_txt({"org_txt" : "筆"}),
					"info": "<span class='seperator'>&nbsp;&nbsp;&nbsp;&nbsp;</span>" + change_lang_txt({"org_txt" : "共有"}) + " _TOTAL_ " + change_lang_txt({"org_txt" : "筆資料"}),
					"infoEmpty": "",
					"emptyTable": change_lang_txt({"org_txt" : "目前沒有資料"}) + "!",
					"zeroRecords": "No matching records found",
					"paginate": {
						"previous": change_lang_txt({"org_txt" : "Prev"}),
						"next": change_lang_txt({"org_txt" : "Next"}),
						"last": change_lang_txt({"org_txt" : "Last"}),
						"first": change_lang_txt({"org_txt" : "First"}),
						"page": change_lang_txt({"org_txt" : "頁數"}),
						"pageOf": change_lang_txt({"org_txt" : "of"}),
					}
				},
            }
        });
    }

    return {
        //main function to initiate the module
        init: function () {
            handleRecords();
        }

    };

}();

$(function(){
    TableDatatablesAjax.init();
	
	$(".search-btn").click(function(){
		grid.getDataTable().ajax.url("/op/cus_discount_apply_op.php?pdisplay=display_manager_list&search_customer_userid=" + $("input[name=search_customer_userid]").val() + "&fuzzy_search=" + ($("input[name=fuzzy_search]").prop("checked") ? "1" : "0") + "&search_audit_status=" + $("select[name=search_audit_status]").val()).load();
	});
});

function request_add_item_div(){
	requestJSON("cus_discount_apply_op.php", "pdisplay=request_add_item_div", "");	
}

function show_add_item_div(){
	close_layer({type: 1});
	customize_layer_open({
		title: false,
		area: 'auto',
		maxWidth: '100%',
		maxHeight: '100%',
		content: $('#add-item-div'),
		shadeClose: false,
		closeBtn: false,
		type:1
	});
}

function save_add_item(){
	var customer_userid = $("input[name=customer_userid]").val();
	var discount_id = $("select[name=discount_id]").val();
	
	requestJSON("cus_discount_apply_op.php", "pdisplay=save_add_item", "customer_userid=" + customer_userid + "&discount_id=" + discount_id);
}

function request_editor_item_div(etype, edit_audit_id){
	requestJSON("cus_discount_apply_op.php", "pdisplay=request_editor_item_div", "etype=" + etype + "&edit_audit_id=" + edit_audit_id);	
}

function show_editor_item_div(){
	close_layer({type: 1});
	customize_layer_open({
		title: false,
		area: 'auto',
		maxWidth: '100%',
		maxHeight: '100%',
		content: $('#editor-item-div'),
		shadeClose: false,
		closeBtn: false,
		type:1
	});
}

function save_audit(){
	var etype = $("#etype").val();
	var edit_audit_id = $("#edit-audit-id").val();
	var edit_audit_status = $("select[name=audit_status]").val();
	var notes = $("textarea[name=notes]").val();
	requestJSON("cus_discount_apply_op.php", "pdisplay=save_audit", "etype=" + etype + "&edit_audit_id=" + edit_audit_id + "&edit_audit_status=" + edit_audit_status + "&notes=" + notes);
}


function request_audit_log_div(edit_audit_id){
	requestJSON("cus_discount_apply_op.php", "pdisplay=request_audit_log_div", "edit_audit_id=" + edit_audit_id);
}

function show_audit_log_div(){
	close_layer({type: 1});
	customize_layer_open({
		title: false,
		area: 'auto',
		maxWidth: '100%',
		maxHeight: '100%',
		content: $('#audit-log-div'),
		shadeClose: true,
		type:1
	});
}

function request_get_discount_div(edit_audit_id){
	requestJSON("cus_discount_apply_op.php", "pdisplay=request_get_discount_div", "edit_audit_id=" + edit_audit_id);	
}

function show_get_discount_div(){
	close_layer({type: 1});
	customize_layer_open({
		title: false,
		area: 'auto',
		maxWidth: '100%',
		maxHeight: '100%',
		content: $('#get-discount-div'),
		shadeClose: false,
		closeBtn: false,
		type:1
	});
}

function save_discount_quota(){
	var edit_audit_id = $("#edit-audit-id").val();
	var adjust_quota = $("input[name=adjust_quota]").val();
	var audit_multiple = $("input[name=audit_multiple]").val();
	var audit_fixed_amount = $("input[name=audit_fixed_amount]").val();
	var notes = $("input[name=notes]").val();
	if (typeof adjust_quota == 'undefined')
		adjust_quota = "";
	
	if(adjust_quota == "")
		pop_msg(change_lang_txt({"org_txt" : "請輸入優惠金額"}) + "!");
	else
		requestJSON("cus_discount_apply_op.php", "pdisplay=save_discount_quota", "edit_audit_id=" + edit_audit_id + "&adjust_quota=" + adjust_quota + "&audit_multiple=" + audit_multiple + "&audit_fixed_amount=" + audit_fixed_amount + "&notes=" + notes);
}