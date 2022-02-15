var editor_arr = new Object();
$(function(){
	initial_item_ckbox_set();

	KindEditor.ready(function(K) {
        $(".site-msg-content").each(function(index) {
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

		$("select[name='site_msg_target']").change(function(){
			var target_type = $(this).val();
			$(".target-type-1").hide();
			$(".target-type-2").hide();
			if(target_type == 1) {
				$(".target-type-1").show();
			} else if (target_type == 2) {
				$(".target-type-2").show();
			} else {
			}
		});
    });
});

function save_site_msg(){
	var etype = $("#etype").val();
	var edit_site_msg_id = $("#edit-site-msg-id").val();
    var edit_unique_code = $("#edit-unique-code").val();
	
	var site_msg_content = "";
    $(".site-msg-content").each(function(index) {
        var lang = $(this).attr('lang');
        var name = $(this).attr('name');
		if(editor_arr[lang] != 'undefined' && editor_arr[lang].html() != ''){
           var encode_URI = encodeURIComponent(editor_arr[lang].html());
           site_msg_content += "&" + name + "=" + encode_URI;
        }
    });
	 
	 
	if(site_msg_content == ""){
        pop_msg(change_lang_txt({"org_txt" : "請輸入消息內容"}) + "!");
    }else{
		var post_ele = $("#all-post [is-post-data=1]").serialize();
        requestJSON("/admin/save_site_msg", "pdisplay=save_site_msg", "etype=" + etype + "&edit_site_msg_id=" + edit_site_msg_id + "&edit_unique_code=" + edit_unique_code + site_msg_content + "&" + post_ele, "");   
    }
}

function change_level_type_all(){
	var isAll = $("#level_all").prop('checked');

	if (isAll == true) {
		$('#level_more input[name="level_type"]').each(function(){
			var type = $(this).val();
			$(this).prop("checked",true);
			$(this).attr("class","checked");
			$('#uniform-level_' + type + ' span').addClass('checked');
		});
	} else {
		$('#level_more input[name="level_type"]').each(function(){
			var type = $(this).val();
			// $(this).attr("class", "item-ckbox");
			$('#uniform-level_' + type + ' span').removeClass('checked');
		});
	}
}

function change_level_type(){
	var options = $('#level_more input[name="level_type"]').length;
	var conuntOptions = $('#level_more input[name="level_type"]:checked').length;
	$("#level_all").prop("checked",false);
	$("#level_all").parent().attr("class","");
	
	if (options == conuntOptions) {
		$("#level_all").prop("checked",true);
		$("#level_all").parent().attr("class","checked");
	} else {
		$("#level_all").prop("checked",false);
		$("#level_all").parent().attr("class","");
	}
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