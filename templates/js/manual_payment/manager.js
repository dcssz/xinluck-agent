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
                    //"url": "/op/manual_payment_op.php?pdisplay=display_manager_list&search_customer_userid=" + $("input[name=search_customer_userid]").val() + "&fuzzy_search=" + ($("input[name=fuzzy_search]").prop("checked") ? "1" : "0") + "&search_status=" + $("select[name=search_status]").val() + "&search_invite_code=" + $("input[name=search_invite_code]").val(), // ajax source
					"url": "/op/manual_payment_op.php?pdisplay=display_manager_list&" + $('#report-form').serialize(), // ajax source
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
		//grid.getDataTable().ajax.url("/op/manual_payment_op.php?pdisplay=display_manager_list&search_customer_userid=" + $("input[name=search_customer_userid]").val() + "&fuzzy_search=" + ($("input[name=fuzzy_search]").prop("checked") ? "1" : "0") + "&search_level=" + $("select[name=search_level]").val() + "&search_status=" + $("select[name=search_status]").val() + "&search_invite_code=" + $("input[name=search_invite_code]").val()).load();
		grid.getDataTable().ajax.url("/op/manual_payment_op.php?pdisplay=display_manager_list&" + $('#report-form').serialize()).load();
	});
});

function request_editor_item_div(etype, edit_cus_id){
	requestJSON("manual_payment_op.php", "pdisplay=request_editor_item_div", "etype=" + etype + "&edit_cus_id=" + edit_cus_id);
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

function save_adjust_quota(){
	var etype = $("#etype").val();
	var edit_cus_id = $("#edit-cus-id").val();
	var adjust_quota = $("#adjust-quota").val();
	if(adjust_quota == "")
		pop_msg(change_lang_txt({"org_txt" : "請輸入金額"}) + "!");
	else
		requestJSON("manual_payment_op.php", "pdisplay=save_adjust_quota", "etype=" + etype + "&edit_cus_id=" + edit_cus_id, "#editor-form");
}

function init_select_change(){
	$('#handling-fee-type').change(function(){
		var handling_fee_type = $('#handling-fee-type').val();
		switch(handling_fee_type){
			case '1':
				$('tr.handling-fee-amount').addClass(" hidden");
				$('tr.handling-fee-percent').removeClass(" hidden");
				break;
			case '2':
				$('tr.handling-fee-percent').addClass(" hidden");
				$('tr.handling-fee-amount').removeClass(" hidden");
				break;
		}
		cmp_amount_info();
	});
}

function cmp_amount_info(){
	var apply_amount = $("#adjust-quota").val();
	var handling_fee_type = $('#handling-fee-type').val();
	var handling_fee_percent = $('#handling-fee-percent').val();
	var handling_fee_amount = $('#handling-fee-amount').val();
	var admin_fee_percent = $('#admin-fee-percent').val();
	var total_remain_audit_amount = $("#total-remain-audit-amount").val();
	
	var handling_fee = 0;
	if(handling_fee_type == 1){
		handling_fee = apply_amount * handling_fee_percent * 0.01;
	}else{
		handling_fee = handling_fee_amount;
	}
	handling_fee = floor_dec(handling_fee, 2);
	
	var etype = $("etype").val();
	if(etype == "in"){
		$('#handling-fee').html(handling_fee);
		$('#actual-amount').html(apply_amount - handling_fee);
	}else{
		var admin_fee = 0;
		if(total_remain_audit_amount > 0)
			admin_fee = total_remain_audit_amount * admin_fee_percent * 0.01;
		
		admin_fee = floor_dec(admin_fee, 2);
			
		$('#handling-fee').html(handling_fee);
		$('#admin-fee').html(admin_fee);
		$('#actual-amount').html(apply_amount - handling_fee - admin_fee);
	}
	
	
}

/*for transfer_quota*/
//點數全數轉回主帳戶
var return_to_main_account_flag = 1;
function return_to_main_account(edit_cus_id){
	if(return_to_main_account_flag == 0){
		pop_msg(change_lang_txt({"org_txt" : "請稍候"}) + "!");
	}else{	
		var bool = confirm(change_lang_txt({"org_txt" : "確定要將點數全數轉回主帳戶"}) + "?")
		return_to_main_account_flag = 0;
		if (bool){
			layer_loading({'type': 1});
			requestJSON("cus_info_editor_op.php", "pdisplay=return_to_main_account", "edit_cus_id=" + edit_cus_id + "&is_outer=1", "");
		}else{
			return_to_main_account_flag = 1;
		}
	}
	
}
/*for transfer_quota*/