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
                
                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

                "lengthMenu": [
                    [100],
                    [100] // change per page values here
                ],
                "pageLength": 100, // default record count per page
                "ajax": {
                    "url": "/op/site_msg_op.php?pdisplay=display_manager_list&select_msg_type=" + $("select[name=select_msg_type]").val() + "&edit_unique_code=" + $("#edit-unique-code").val(), // ajax source
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

var grid2 = new Datatable();
var TableDatatablesAjax2 = function () {
    var handleRecords = function () {
        grid2.init({
            src: $("#manager_table2"),
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
                
                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

                "lengthMenu": [
                    [100],
                    [100] // change per page values here
                ],
                "pageLength": 100, // default record count per page
                "ajax": {
                    "url": "/op/site_msg_op.php?pdisplay=display_detail_list&edit_unique_code=" + $("#edit-unique-code").val(), // ajax source
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
	TableDatatablesAjax2.init();
	
	$(".search-btn").click(function(){
		grid.getDataTable().ajax.url("/op/site_msg_op.php?pdisplay=display_manager_list&select_msg_type=" + $("select[name=select_msg_type]").val() + "&edit_unique_code=" + $("#edit-unique-code").val()).load();
	});
});

function request_editor_item_div(etype, edit_smc_id){
	var edit_unique_code = $("#edit-unique-code").val();
	requestJSON("site_msg_op.php", "pdisplay=request_editor_item_div", "etype=" + etype + "&edit_smc_id=" + edit_smc_id + "&edit_unique_code=" + edit_unique_code);	
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

function change_msg_type(){
	var msg_type = $("select[name=edit_msg_type]").val();
	$("tr[class=msg-type-div]").each(function(){
		$(this).hide();
	});
	
	$("tr[class=msg-type-div][type=" + msg_type + "]").show();
}

function send_msg(){
	var etype = $("#etype").val();
	var edit_smc_id = $("#edit-smc-id").val();
	var edit_unique_code = $("#edit-unique-code").val();
	var set_grade_id_arr = new Array();
	$("input[name='grade_id_arr']:checked").each(function(){
		set_grade_id_arr.push($(this).attr("value"));	
	});
	
    var edit_msg_txt_count = 0;
    $(".edit-msg-txt").each(function(index) {
        var value = $(this).val();
        if (typeof value != 'undefined' && value != ""){
            edit_msg_txt_count++;
        }
    });
                           
    if(edit_msg_txt_count == 0){
        pop_msg(change_lang_txt({"org_txt" : "請輸入消息內容"}) + "!");
    }
    else{ 
	   requestJSON("site_msg_op.php", "pdisplay=send_msg", "etype=" + etype + "&edit_smc_id=" + edit_smc_id + "&set_grade_id_arr=" + set_grade_id_arr + "&edit_unique_code=" + edit_unique_code, "#manager-editor");
    }
}

function delete_item(edit_smc_id){
	if(confirm(change_lang_txt({"org_txt" : "確定要刪除"}) + "?")){
		requestJSON("site_msg_op.php", "pdisplay=delete_item", "edit_smc_id=" + edit_smc_id);
	}
}

function delete_detail_item(edit_msg_id){
	if(confirm(change_lang_txt({"org_txt" : "確定要刪除"}) + "?")){
		requestJSON("site_msg_op.php", "pdisplay=delete_detail_item", "edit_msg_id=" + edit_msg_id);
	}
}

//=== 詳細 ===//
function show_site_msg_detail(edit_smc_id){
	var edit_unique_code = $("#edit-unique-code").val();
	close_layer({type: 1});
	grid2.getDataTable().ajax.url("/op/site_msg_op.php?pdisplay=display_detail_list&edit_smc_id=" + edit_smc_id + "&edit_unique_code=" + edit_unique_code).load();
	customize_layer_open({
		title: false,
		area: 'auto',
		maxWidth: '100%',
		maxHeight: '100%',
		content: $('#show-detail-div'),
		shadeClose: true,
		closeBtn: false,
		type:1,
		btn: [change_lang_txt({"org_txt" : "關閉"})],
		btn1: function(){close_layer({type: 1});}
	});
	//$('.layui-layer-content').height(600);
}


//=== 分站&活動分類 start ===/
function initial_item_ckbox_set(){
	$(".item-ckbox-all").each(function(index, element) {
		var spot = $(this).attr("spot");
		var item_ckbox_all_el = $(this);
		var item_ckbox_el = $("input[class='item-ckbox'][spot='" + spot + "']:enabled");
		
		//預設全選
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