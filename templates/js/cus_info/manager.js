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
                   // "url": "/op/cus_info_manager_op.php?pdisplay=display_manager_list&search_customer_userid=" + $("input[name=search_customer_userid]").val() + "&search_level=" + $("select[name=search_level]").val() + "&edit_cus_level=" + $("#edit-cus-level").val()  + "&top_cus_id=" + $("#top-cus-id").val() + "&edit_station_code=" + $("#edit-station-code").val(), // ajax source
				   "type": "get",
				   "url": "/agent/list_cus_infos?pdisplay=display_manager_list&" + $("#search-data-area [is-search-data=1]").serialize() + "&edit_cus_level=" + $("#edit-cus-level").val() + "&top_cus_id=" + $("#top-cus-id").val() + "&edit_station_code=" + $("#edit-station-code").val(), 
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
		//grid.getDataTable().ajax.url("/op/cus_info_manager_op.php?pdisplay=display_manager_list&search_customer_userid=" + $("input[name=search_customer_userid]").val() + "&fuzzy_search=" + ($("input[name=fuzzy_search]").prop("checked") ? "1" : "0") + "&search_level=" + $("select[name=search_level]").val() + "&search_status=" + $("select[name=search_status]").val() + "&search_grade=" + $("select[name=search_grade]").val() + "&search_invite_code=" + $("input[name=search_invite_code]").val() + "&search_customer_name=" + $("input[name=search_customer_name]").val() + "&search_cell_phone=" + $("input[name=search_cell_phone]").val() + "&search_mark=" + $("select[name=search_mark]").val() + "&search_order_by=" + $("select[name=search_order_by]").val() + "&search_order_by_field=" + $("select[name=search_order_by_field]").val()).load();
		var param = $("#search-data-area [is-search-data=1]").serialize() + "&edit_cus_level=" + $("#edit-cus-level").val() + "&edit_station_code=-1";
		grid.getDataTable().ajax.url("/agent/list_cus_infos?pdisplay=display_manager_list&" + param).load();
		
		//param = param + "&edit_station_code=" + $(".station-btn.active").attr("station-code");
		var _id = parent.window.currentFrame;
		var current_url = parent.window.iframeHistory[_id].pop().split('?')[0];
		parent.window.iframeHistory[_id].push(current_url + "?" + param);
	});
});

function add_cus(){
	var edit_cus_level = $("#edit-cus-level").val();
	var edit_station_code = $("#edit-station-code").val();
	var top_cus_id = $("#top-cus-id").val();
	location.href = "/agent/cus_info_editor?etype=add&edit_cus_level=" + edit_cus_level + "&edit_station_code=" + edit_station_code + "&top_cus_id=" + top_cus_id;
}

function request_invitee_info_div(edit_cus_id){
	requestJSON("cus_info_manager_op.php", "pdisplay=request_invitee_info_div", "edit_cus_id=" + edit_cus_id);	
}

function show_invitee_info_div(){
	close_layer({type: 1});
	customize_layer_open({
		title: false,
		area: 'auto',
		maxWidth: '100%',
		maxHeight: '100%',
		content: $('#invitee-info-div'),
		shadeClose: true,
		type:1
	});
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

function request_identity_ver_div(edit_cus_id){
	//requestJSON("cus_info_manager_op", "pdisplay=request_identity_ver_div", "edit_cus_id=" + edit_cus_id);
	show_identity_ver_div();
	$('#preview-pic-1').html('');
	$('#preview-pic-2').html('');
	$('#preview-pic-3').html('');
	$.ajax({
		url:'/agent/cus_info_manager_op?pdisplay=request_identity_ver_div',
		type:'post',
		data:{
			edit_cus_id:edit_cus_id
		},
		success:function(res){
			console.log(res);
			 
			$('input[name="edit_cus_id"]').val(res.id);
			$('#lbl_ver_username').html(res.username);
			$('#lbl_ver_nickname').html(res.nickname);
			if(res.verification != null){
				$('input[name="edit_ver_id"]').val(res.verification.id);
				$('#ver_type').val(res.verification.ver_type);
			 
				$('input[name="identity_name"]').val(res.verification.identity_name);
				$('input[name="identity_number"]').val(res.verification.identity_number);
				var photo1 = '<img src="'+res.verification.photo1+'" />';
				photo1 += '<input type="hidden" is-post-data="1" name="personal_pic[]" value="'+res.verification.photo1+'" class="pic-path">';
				$('#preview-pic-1').html(photo1);
				
				var photo2 = '<img src="'+res.verification.photo2+'" />';
				photo2 += '<input type="hidden" is-post-data="1" name="personal_pic[]" value="'+res.verification.photo2+'" class="pic-path">';
				$('#preview-pic-2').html(photo2);
				
				var photo3 = '<img src="'+res.verification.photo3+'" />';
				photo3 += '<input type="hidden" is-post-data="1" name="personal_pic[]" value="'+res.verification.photo3+'" class="pic-path">';
				$('#preview-pic-3').html(photo3);
				
				
			}
			
			$('select[name="identity_status"]').val(res.identity_status);
			 
			 
		}
	});
}

//檢查img圖片是否都已載入完成 載入完才show layer
function check_identity_ver_div(){
	layer_loading({type:1});
	/*var can_open = -1;
	var img_total = $('#identity-ver-div .identity-img').length;
	if(img_total > 0){
		var load_count = 0;
		$('#identity-ver-div .identity-img').load(function(){
			load_count ++;
			if(load_count == img_total){
				show_identity_ver_div();
			}
		});
		
		$('#identity-ver-div .identity-img').error(function(){
			load_count ++;
			if(load_count == img_total){
				show_identity_ver_div();
			}
		});
	}else{
		show_identity_ver_div();
	}*/
	
	
	show_identity_ver_div();
}

 $('#identity-ver-div .identity-photo-img').change(function(){
	 
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

function show_identity_ver_div(){
	close_layer({type: 1});
	customize_layer_open({
		title: false,
		area: ['auto', '90%'],
		/*maxWidth: '100%',
		maxHeight: '100%',*/
		content: $('#identity-ver-div'),
		shadeClose: false,
		closeBtn: false,
		type:1
	});
}

function save_identity_ver(){
	var post_ele = $("#identity-ver-div [is-post-data=1]").serialize();
	requestJSON("cus_info_manager_op", "pdisplay=save_identity_ver", post_ele);
}
