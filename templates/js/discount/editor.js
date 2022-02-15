var editor_arr = new Object();
$(function(){
	datetime_picker_init();
	initial_item_ckbox_set();
	change_discount_type();
	change_rule_pattern();
	
	$('.discount-photo-img').change(function(){
		var lang = $(this).attr('lang');
		var status = $("#up-status-" + lang); 
        var btn = $("#btn-group" + lang);
        $("#image-form-" + lang).ajaxForm({ 
            target: '#preview-pic-' + lang,   
            beforeSubmit:function(){ 
                status.show(); 
                btn.hide();
				$("#preview-pic-" + lang).html("");
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
	
	KindEditor.ready(function(K) {
        $(".discount-content").each(function(index) {
            var lang = $(this).attr('lang');
            editor_arr[lang] = K.create($(this), {
                items:[ 'source',"fullscreen","undo","redo","|","preview","print","code","cut","copy", "|",
                "justifyleft","justifycenter","justifyright","justifyfull","insertorderedlist","insertunorderedlist","subscript","superscript","|",
                "fontname","fontsize","forecolor","hilitecolor","bold","italic","underline","|",
                "table","link","unlink","about"
                ],
                width: "680px",
                height: "200px",
                minWidth: "680px",
                minHeight: "100px",
                allowFileManager: true,
            });
        });
    });
        
    /*editor = K.create('textarea[name="discount_content"]', {
        items:[ 'source',"fullscreen","undo","redo","|","preview","print","code","cut","copy", "|",
        "justifyleft","justifycenter","justifyright","justifyfull","insertorderedlist","insertunorderedlist","subscript","superscript","|",
        "fontname","fontsize","forecolor","hilitecolor","bold","italic","underline","|",
        "table","link","unlink","about"
        ],
        width: "680px",
        height: "200px",
        minWidth: "680px",
        minHeight: "100px",
        allowFileManager: true,
    });*/
    /*K('input[name=submit]').click(function(e) {
        alert(editor.html());
    });
    K('input[name=clear]').click(function(e) {
        editor.html('');
    });*/
});

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

function save_discount(){
	var etype = $("#etype").val();
	var edit_discount_id = $("#edit-discount-id").val();
	var discount_pattern = $("#discount-pattern").val();
	//var discount_title = $("input[name=discount_title]").val();
	//var discount_content = editor.html();
	/*if (typeof discount_title == 'undefined')
		discount_title = "";*/
	
    var discount_title_count = 0;
    $(".discount-title").each(function(index) {
        var value = $(this).val();
        if (typeof value != 'undefined' && value != ""){
            discount_title_count++;
        }
    });
    
    var pic_path_count = 0;
    $(".pic-path").each(function(index) {
        var value = $(this).val();
        if(typeof value != 'undefined' && value != ""){
            pic_path_count++;
        }
    });
    
    var discount_content = "";
    $(".discount-content").each(function(index) {
        var lang = $(this).attr('lang');
        var name = $(this).attr('name');
        if(editor_arr[lang] != 'undefined' && editor_arr[lang].html() != ''){
           var encode_URI = encodeURIComponent(editor_arr[lang].html());
           discount_content += "&" + name + "=" + encode_URI;
        }
    });
    
	if(discount_title_count == 0){
		pop_msg(change_lang_txt({"org_txt" : "請輸入優惠標題"}) + "!");
	}
    if(pic_path_count == 0){
       pop_msg(change_lang_txt({"org_txt" : "請上傳優惠文案圖片"}) + "!");
    }
    else if(discount_content == ""){
        pop_msg(change_lang_txt({"org_txt" : "請輸入優惠文案內容"}) + "!");
    }else{
		var post_ele = $("#all-post [is-post-data=1]").serialize();
		//requestJSON("discount_editor_op.php", "pdisplay=save_discount", "etype=" + etype  + "&edit_discount_id=" + edit_discount_id + "&discount_pattern=" + discount_pattern + "&discount_content=" + discount_content, "#save-discount-form");
		requestJSON("/admin/discount_editor_op", "pdisplay=save_discount", "etype=" + etype  + "&edit_discount_id=" + edit_discount_id + "&discount_pattern=" + discount_pattern + discount_content + "&" + post_ele, "");
	}
} 	

function change_discount_type(){
	var discount_type = $("select[name=discount_type]").val();
	if(discount_type == 2){	//含活動，顯示活動時間
		$(".discount-type").show();
	}else{
		$(".discount-type").hide();
	}
	change_join_target();
}

function change_join_target(){
	var join_target = $("input[spot=join_target]:checked").val();
	var discount_type = $("select[name=discount_type]").val();
	if(join_target == 3 && discount_type == 2){	//指定會員
		$(".join-target").show();
	}else{
		$(".join-target").hide();
	}
}

function change_rule_pattern(){
	var rule_pattern_type = $("select[spot=rule_pattern]").val();
	if(rule_pattern_type == 1){
		$(".rule-pattern-type-1").removeClass('hidden');
		$(".rule-pattern-type-2").addClass('hidden');
	}else{
		$(".rule-pattern-type-2").removeClass('hidden');
		$(".rule-pattern-type-1").addClass('hidden');
	}
}

function change_apply_type(e){
	var apply_type = $(e).val();
	if(apply_type == 1){
		$(".apply-type").removeClass('hidden');
	}else{
		$(".apply-type").addClass('hidden');
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

function add_param_item(elem_id){
	var add_content = $("#" + elem_id + " tr[item_list_index='add-item']").html();
	$("#" + elem_id).append('<tr item_list_index="item" name="activity_param">' + add_content + '</tr>');
	update_param_item_element(elem_id);
	App.init();
}

function delete_param_item(e){
	var item_list_index = $(e).closest("tr").attr("item_list_index");
	var elem_id = $(e).closest("table").attr("id");
	
	$("#" + elem_id + " tr[item_list_index=" + item_list_index + "]").remove();
	update_param_item_element(elem_id);
}

function update_param_item_element(elem_id){
	var check_has_data = 0;
	var item_list_index = 1;
	var id_field = $("#" + elem_id).attr("id-field");
	$("#" + elem_id + " tr[item_list_index]").each(function(){
		if($(this).attr("item_list_index") != "add-item" && $(this).attr("item_list_index") != "no-item"){
			var name = $(this).attr("name");
			$(this).attr("item_list_index", item_list_index);
			$(this).find("input").each(function(){
				$(this).attr("name", name + "[" + id_field + "]" + "[" + item_list_index + "][" + $(this).attr("field") + "]")
				$(this).attr("type", $(this).attr("use-type"))
			});
			$(this).find("select").each(function(){
				$(this).attr("name", name + "[" + id_field + "]" + "[" + item_list_index + "][" + $(this).attr("field") + "]")
				$(this).attr("type", $(this).attr("use-type"))
			});
			
			
			item_list_index = item_list_index + 1;
			check_has_data = 1;
		}
	});
	
	if(check_has_data == 0){
		$("#" + elem_id).append('<tr item_list_index="no-item"><td colspan="100%">' + change_lang_txt({"org_txt" : "沒有資料"}) + '</td></tr>');
	}else{
		$("#" + elem_id + " tr[item_list_index='no-item']").remove();
	}
}

function delete_discount_photo_img(lang){
	$("#preview-pic-" + lang).html("");
    $("#up-status-" + lang).hide();
}