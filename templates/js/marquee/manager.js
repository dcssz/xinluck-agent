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
                    [10],
                    [10] // change per page values here
                ],
                "pageLength": 10, // default record count per page
                "ajax": {
					"type":"GET",
                    // "url": "/admin/list_marquee?pdisplay=display_manager_list&select_status=" + $("select[name=select_status]").val() + "&select_marquee_target=" + $("select[name=select_marquee_target]").val() + "&edit_unique_code=" + $("#edit-unique-code").val(), // ajax source
                    "url": "/admin/list_marquee?select_status=" + $("select[name=select_status]").val() + "&select_marquee_target=" + $("select[name=select_marquee_target]").val() + "&select_nt_id=" + $("select[name=select_nt_id]").val() + "&edit_unique_code=" + $("#edit-unique-code").val(), // ajax source
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
				
				"drawCallback": function(oSettings) {
					//內容先變存文字
					$(".news-content-div").each(function(index) {
						var this_text = $(this).text();
						if(this_text.length > 20)
							this_text = this_text.substr(0, 20) + " . . .";
						$(this).html(this_text);
					});
					/*$("#manager_table > thead > tr > th").each(function(index, element) {
						if($(this).attr("id") == "is-top-th"){
							$("#manager_table > tbody > tr > td:nth-child(" + (index + 1) + ")").each(function(index, element) {
								var this_el = $(this);
								if($('select', this).val() == 1){
									this_el.addClass("is-top-active");
								}
							});
						}else if($(this).attr("id") == "is-marquee-th"){
							$("#manager_table > tbody > tr > td:nth-child(" + (index + 1) + ")").each(function(index, element) {
								var this_el = $(this);
								if($('select', this).val() == 1){
									this_el.addClass("is-marquee-active");
								}
							});
						}
					});*/
				}
				
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
		grid.getDataTable().ajax.url("/admin/list_marquee?select_status=" + $("select[name=select_status]").val() + "&select_marquee_target=" + $("select[name=select_marquee_target]").val() + "&select_nt_id=" + $("select[name=select_nt_id]").val() + "&edit_unique_code=" + $("#edit-unique-code").val()).load();
	});
});

function request_editor_item_div(etype, edit_marquee_id){
	requestJSON("marquee_op.php", "pdisplay=request_editor_item_div", "etype=" + etype + "&edit_marquee_id=" + edit_marquee_id);	
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

function save_marquee(){
	var etype = $("#etype").val();
	var edit_marquee_id = $("#edit-marquee-id").val();
    var edit_unique_code = $("#edit-unique-code").val();
	
    var marquee_content_count = 0;
    $(".marquee-content").each(function(index) {
        var value = $(this).val();
        if (typeof value != 'undefined' && value != ""){
            marquee_content_count++;
        }
    });
                           
    if(marquee_content_count == 0){
        pop_msg(change_lang_txt({"org_txt" : "請輸入跑馬燈內容"}) + "!");
    }
    else{
       requestJSON("marquee_op.php", "pdisplay=save_marquee", "etype=" + etype + "&edit_marquee_id=" + edit_marquee_id + "&edit_unique_code=" + edit_unique_code, "#manager-editor");
    }
}

function delete_item(edit_marquee_id){
	if(confirm(change_lang_txt({"org_txt" : "確定要刪除"}) + "?")){
		requestJSON("/admin/delete_marquee", "pdisplay=delete_item", "edit_marquee_id=" + edit_marquee_id);
	}
}

function change_publish_type(){
	var publish_type = $("input[name=publish_type]:checked").val();
	if(publish_type == 0)
		$(".publish-type-1").hide();
	else
		$(".publish-type-1").show();
}

function datetime_picker_init() {
	$('.date-picker').datepicker({
		rtl: App.isRTL(),
		orientation: "left",
		autoclose: true
	});
	
	$('.timepicker-24').timepicker({
		timeFormat: 'H:i:s',
		autoclose: true,
		minuteStep: 5,
		showSeconds: true,
		showMeridian: false
	});

	// handle input group button click
	$('.timepicker').parent('.input-group').on('click', '.input-group-btn', function(e){
		e.preventDefault();
		$(this).parent('.input-group').find('.timepicker').timepicker('showWidget');
	});
}

function add_managee (id=0) {
	var edit_unique_code = $("#edit-unique-code").val();
	location.href = "/admin/marquee_editor?id="+id+"&etype=add&edit_unique_code=" + edit_unique_code;
}