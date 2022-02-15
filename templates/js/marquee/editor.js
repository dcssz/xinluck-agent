var editor_arr = new Object();
$(function(){
	initial_item_ckbox_set();

	KindEditor.ready(function(K) {
        $(".marquee-content").each(function(index) {
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
});

function save_marquee(){
	var etype = $("#etype").val();
	var edit_marquee_id = $("#edit-marquee-id").val();
    var edit_unique_code = $("#edit-unique-code").val();
	
	var marquee_content = "";
    $(".marquee-content").each(function(index) {
        var lang = $(this).attr('lang');
        var name = $(this).attr('name');
        if(editor_arr[lang] != 'undefined' && editor_arr[lang].html() != ''){
           var encode_URI = encodeURIComponent(editor_arr[lang].html());
           marquee_content += "&" + name + "=" + encode_URI;
        }
    });
	 
	 
	if(marquee_content == ""){
        pop_msg(change_lang_txt({"org_txt" : "請輸入跑馬燈內容"}) + "!");
    }else{
		var post_ele = $("#all-post [is-post-data=1]").serialize();
        requestJSON("/admin/save_marquee", "pdisplay=save_marquee", "etype=" + etype + "&edit_marquee_id=" + edit_marquee_id + "&edit_unique_code=" + edit_unique_code + marquee_content + "&" + post_ele, "");   
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