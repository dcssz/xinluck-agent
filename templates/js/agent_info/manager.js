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
				//更新上方分站紐的active
				var edit_station_code = response['edit_station_code'];
				$('#station-btn-area .station-btn').removeClass('active');
				
				if(edit_station_code != -1)
					$('#station-btn-area .station-btn[station-code=' + edit_station_code + ']').addClass('active');
				
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
					"type": "get",
                    "url": "/agent/list_agent_infos?pdisplay=display_manager_list&" + $("#search-data-area [is-search-data=1]").serialize() + "&edit_cus_level=" + $("#edit-cus-level").val() + "&top_cus_id=" + $("#top-cus-id").val() + "&edit_station_code=" + $("#edit-station-code").val(), 
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
		/*var param = "search_customer_userid=" + $("input[name=search_customer_userid]").val() + "&edit_cus_level=" + $("#edit-cus-level").val() + "&fuzzy_search=" + ($("input[name=fuzzy_search]").prop("checked") ? "1" : "0") + "&search_level=" + $("select[name=search_level]").val() + "&search_status=" + $("select[name=search_status]").val() + "&search_invite_code=" + $("input[name=search_invite_code]").val() + "&search_commission_rule=" + $("select[name=search_commission_rule]").val() + "&search_retreat_rule=" + $("select[name=search_retreat_rule]").val() + "&search_occupy=" + $("input[name=search_occupy]").val() + "&search_extra_commission_rule=" + $("select[name=search_extra_commission_rule]").val() + "&edit_station_code=" + $("#edit-station-code").val();
		grid.getDataTable().ajax.url("/op/agent_info_manager_op.php?pdisplay=display_manager_list&" + param).load();
		
		var _id = parent.window.currentFrame;
		var current_url = parent.window.iframeHistory[_id].pop().split('?')[0];
		parent.window.iframeHistory[_id].push(current_url + "?" + param);*/
		
		var param = $("#search-data-area [is-search-data=1]").serialize() + "&edit_cus_level=" + $("#edit-cus-level").val() + "&edit_station_code=-1";
		grid.getDataTable().ajax.url("/agent/list_agent_infos?pdisplay=display_manager_list&" + param).load();
		
		//param = param + "&edit_station_code=" + $("#edit-station-code").val();
		var _id = parent.window.currentFrame;
		var current_url = parent.window.iframeHistory[_id].pop().split('?')[0];
		parent.window.iframeHistory[_id].push(current_url + "?" + param);
	});
});

function add_agent(){
	var edit_cus_level = $("#edit-cus-level").val();
	var edit_station_code = $("#edit-station-code").val();
	var top_cus_id = $("#top-cus-id").val();
	location.href = "/agent/agent_info_editor?etype=add&edit_cus_level=" + edit_cus_level + "&edit_station_code=" + edit_station_code + "&top_cus_id=" + top_cus_id;
}

function copy_link(e){
	var TextRange = document.createRange();
    TextRange.selectNode(e);
    sel = window.getSelection();
	sel.removeAllRanges();
	sel.addRange(TextRange);
    document.execCommand("copy");
	pop_msg(change_lang_txt({"org_txt" : "複製成功"}) + "!");
}