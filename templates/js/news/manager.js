// JavaScript Document
var editor_arr = new Object();
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
                    "url": "/admin/list_news?select_status=" + $("select[name=select_status]").val() + "&select_news_target=" + $("select[name=select_news_target]").val() + "&select_nt_id=" + $("select[name=select_nt_id]").val() + "&edit_unique_code=" + $("#edit-unique-code").val(), // ajax source
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
		grid.getDataTable().ajax.url("/admin/list_news?select_status=" + $("select[name=select_status]").val() + "&select_news_target=" + $("select[name=select_news_target]").val() + "&select_nt_id=" + $("select[name=select_nt_id]").val() + "&edit_unique_code=" + $("#edit-unique-code").val()).load();
	});
});

function request_editor_item_div(etype, edit_news_id){
	//add_news(edit_news_id);
	requestJSON("news_editor?etype=add", "pdisplay=request_editor_item_div", "etype=" + etype + "&edit_news_id=" + edit_news_id);
	init_KindEditor();
}

function init_KindEditor(){
	console.log(0);
	 console.log(KindEditor);
 console.log(KindEditor.ready());
	KindEditor.ready(function(K) {
		console.log(1);
		$(".news-content").each(function(index) {
			console.log(2);
			var lang = $(this).attr('lang');
			editor_arr[lang] = K.create($(this), {
				items:[ 'source',"undo","redo","|","preview","print","code","cut","copy", "|",
				"justifyleft","justifycenter","justifyright","justifyfull","insertorderedlist","insertunorderedlist","subscript","superscript","|",
				"fontname","fontsize","forecolor","hilitecolor","bold","italic","underline","|",
				"table","link","unlink","about"
				],
				width: "400px",
				height: "200px",
				minWidth: "400px",
				minHeight: "100px",
				allowFileManager: true,
			});
		});
	});
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

function add_news(id=0){
	var edit_unique_code = $("#edit-unique-code").val();
	location.href = "/admin/news_editor?id="+id+"&etype=add&edit_unique_code=" + edit_unique_code;
}

function delete_item(edit_news_id){
	if(confirm(change_lang_txt({"org_txt" : "確定要刪除"}) + "?")){
		requestJSON("/admin/delete_news", "pdisplay=delete_item", "edit_news_id=" + edit_news_id);
	}
}