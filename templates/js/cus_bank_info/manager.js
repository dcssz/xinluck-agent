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
				   "url": "/op/cus_bank_info_manager_op.php?pdisplay=display_manager_list&" + $('#report-form').serialize(), // ajax source
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
	initial_item_ckbox_set();
    TableDatatablesAjax.init();
	$(".search-btn").click(function(){
		grid.getDataTable().ajax.url("/op/cus_bank_info_manager_op.php?pdisplay=display_manager_list&" + $('#report-form').serialize()).load();
	});
});



function request_bank_ver_div(edit_info_id){
	requestJSON("cus_bank_info_manager_op.php", "pdisplay=request_bank_ver_div", "edit_info_id=" + edit_info_id);
}

//檢查img圖片是否都已載入完成 載入完才show layer
function check_bank_ver_div(){
	layer_loading({type:1});
	/*var can_open = -1;
	var img_total = $('#bank-ver-div .bank-img').length;
	if(img_total > 0){
		var load_count = 0;
		$('#bank-ver-div .bank-img').load(function(){
			load_count ++;
			if(load_count == img_total){
				show_bank_ver_div();
			}
		});
		
		$('#bank-ver-div .bank-img').error(function(){
			load_count ++;
			if(load_count == img_total){
				show_bank_ver_div();
			}
		});
	}else{
		show_bank_ver_div();
	}*/
	
	$('#bank-ver-div .bank-photo-img').change(function(){
        var img_no = $(this).attr('img-no');
		var status = $("#up-status-" + img_no); 
        var btn = $("#btn-group-" + img_no);
        $("#image-form-" + img_no).ajaxForm({ 
            target: '#preview-pic-' + img_no,  
            beforeSubmit:function(){ 
                status.show(); 
                btn.hide();
				$("#preview-pic-" + img_no).html("");
            },  
            success:function(){ 
                status.hide(); 
                btn.show(); 
            },  
            error:function(){ 
                status.hide(); 
                btn.show(); 
        } }).submit(); 
	});
	
	change_bank_area($('#bank-area-select').val());
	show_bank_ver_div();
}

function show_bank_ver_div(){
	close_layer({type: 1});
	customize_layer_open({
		title: false,
		area: ['auto', '90%'],
		/*maxWidth: '100%',
		maxHeight: '100%',*/
		content: $('#bank-ver-div'),
		shadeClose: false,
		closeBtn: false,
		type:1
	});
}

function save_bank_ver(){
	var post_ele = $("#bank-ver-div [is-post-data=1]").serialize();
	requestJSON("cus_bank_info_manager_op.php", "pdisplay=save_bank_ver", post_ele);
}

function change_bank_area(bank_area){
	var target_e = $('#bank-name-select');
	var hidden_bank_name = $('#hidden-bank-name').val();
	target_e.html('');
	
	//要先看原本存的銀行名是屬於哪個區域
	if(hidden_bank_name != ""){
		var find_bank_area = -1;
		$.each(bank_list, function(ck_bank_area, ck_bank_area_arr){
			$.each(ck_bank_area_arr, function(none_use_key, bank_opt_arr){
				var show_bank_name = change_lang_txt({"org_txt" : bank_opt_arr['bank_name']});
				if(typeof bank_opt_arr['bank_code'] !== 'undefined'){
					show_bank_name = bank_opt_arr['bank_code'] + " " + show_bank_name;
				}

				if(show_bank_name == hidden_bank_name){
					find_bank_area = ck_bank_area;
					return false;
				}
			});

			if(find_bank_area != -1){
				bank_area = find_bank_area;
				return false;
			}
		});
	}
	
	if(typeof bank_list[bank_area] !== 'undefined'){
		$.each(bank_list[bank_area], function(none_use_key, bank_opt_arr){
			//console.log(bank_name);
			var show_bank_name = change_lang_txt({"org_txt" : bank_opt_arr['bank_name']});
			if(typeof bank_opt_arr['bank_code'] !== 'undefined'){
				show_bank_name = bank_opt_arr['bank_code'] + " " + show_bank_name;
			}
			target_e.append('<option value="' + show_bank_name + '">' + show_bank_name + '</option>');
		});
		
		if(hidden_bank_name != ""){
			target_e.val(hidden_bank_name);
			$('#bank-area-select').val(bank_area);
			//如果hidden_bank_name != "" 表示是編輯修改，值放的是舊資料，需要依照舊資料選中地區和開戶銀行的下拉式，
			//如果選中後不清空，那麼編輯修改進來後不管地區怎麼切換 地區和開戶銀行都不會動，
			//因為會一直被強制選中在舊資料
			$('#hidden-bank-name').val('');
		}
	}
}

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