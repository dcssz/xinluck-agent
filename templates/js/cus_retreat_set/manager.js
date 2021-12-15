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
                    "url": "/op/cus_retreat_set_op.php?pdisplay=display_manager_list", // ajax source
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
});

function request_editor_item_div(etype, edit_grade_id){
	requestJSON("cus_retreat_set_op.php", "pdisplay=request_editor_item_div", "etype=" + etype + "&edit_grade_id=" + edit_grade_id);	
}

function show_editor_item_div(){
	close_layer({type: 1});
	customize_layer_open({
		title: false,
		area: '95%',
		maxWidth: '100%',
		maxHeight: '100%',
		content: $('#editor-item-div'),
		shadeClose: false,
		closeBtn: false,
		type:1
	});
}

function add_param_item(){
	var add_content = $("tr[item_list_index='add-item']").html();
	$("#editor-item-div .station-param-tb").append('<tr item_list_index="item" name="cus_retreat_condition">' + add_content + '</tr>');
	update_param_item_element();
}

function delete_param_item(e){
	var item_list_index = $(e).closest("tr").attr("item_list_index");
	$("tr[item_list_index=" + item_list_index + "]").remove();
	update_param_item_element();
}

function update_param_item_element(){
	var check_has_data = 0;
	var item_list_index = 1;
	$("tr[item_list_index]").each(function(){
		if($(this).attr("item_list_index") != "add-item" && $(this).attr("item_list_index") != "no-item"){
			var name = $(this).attr("name");
			$(this).attr("item_list_index", item_list_index);
			$(this).find("input").each(function(){
				$(this).attr("name", name + "[" + item_list_index + "][" + $(this).attr("field") + "]")
			});
			
			
			item_list_index = item_list_index + 1;
			check_has_data = 1;
		}
	});
	
	if(check_has_data == 0){
		$("#editor-item-div .station-param-tb").append('<tr item_list_index="no-item"><td colspan="100%">' + change_lang_txt({"org_txt" : "沒有資料"}) + '</td></tr>');
	}else{
		$("tr[item_list_index='no-item']").remove();
	}
}

function save_grade(){
	var etype = $("#etype").val();
	var edit_grade_id = $("#edit-grade-id").val();

	requestJSON("cus_retreat_set_op.php", "pdisplay=save_grade", "etype=" + etype + "&edit_grade_id=" + edit_grade_id, "#editor-item-form");
}

function change_retreat_set(){
	var retreat_times_type = $("#retreat-times-type").val();
	var retreat_is_auto = $("#retreat-is-auto").val();
	requestJSON("cus_retreat_set_op.php", "pdisplay=change_retreat_set", "retreat_times_type=" + retreat_times_type + "&retreat_is_auto=" + retreat_is_auto);
}
