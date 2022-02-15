var editor;
$(function(){
	change_link_content();
	$('.banner-photo-img').change(function(){
        var lang = $(this).attr('lang');
		var status = $("#up-status-" + lang); 
        var btn = $("#btn-group-" + lang);
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
});

function save_banner(){
	var etype = $("#etype").val();
	var edit_bid = $("#edit-bid").val();
	var banner_name = $("input[name=banner_name]").val();
	//var banner_order = $("input[name=banner_order]").val();
	//var banner_status = ($("input[name=banner_status]").prop("checked") ? "1" : "0");
	//var link_type = $("select[name=link_type]").val();
	//var link_did = $("select[name=link_did]").val();
	var edit_unique_code = $("#edit-unique-code").val();
	
    //檢查是否有傳圖片    
    var banner_pic_path = "";
    $(".pic-path").each(function(index) {
        var lang_name = $(this).attr('name');
        var value = $(this).val();
        if(typeof lang_name != 'undefined' && typeof value != 'undefined' && value != ""){
            banner_pic_path += "&" + lang_name + "=" + value; 
        }
    });
	
	if (typeof banner_name == 'undefined'){
        banner_name = "";
    }
	
	if(banner_name == ""){
		pop_msg(change_lang_txt({"org_txt" : "請輸入圖片名稱"}) + "!");
    }
	//else if(banner_pic_path == ""){
		//pop_msg(change_lang_txt({"org_txt" : "請上傳輪播圖片"}) + "!");
    //}
	else{
		var post_ele = $("#all-post [is-post-data=1]").serialize();
        //requestJSON("banner_op.php", "pdisplay=save_banner", "etype=" + etype +　"&edit_bid=" + edit_bid +　"&banner_name=" + banner_name + "&banner_order=" + banner_order + banner_pic_path + "&banner_status=" + banner_status + "&link_type=" + link_type + "&link_did=" + link_did, "#link-url-form");
		requestJSON("banner_op", "pdisplay=save_banner", "etype=" + etype +　"&edit_bid=" + edit_bid + "&edit_unique_code=" + edit_unique_code + "&" +　post_ele, "");
    }
} 	

function change_link_content(){
	var link_type = $("select[name=link_type]").val();
	$("div[class=link-type-div]").each(function(){
		$(this).hide();
	});
	
	$("div[class=link-type-div][type=" + link_type + "]").show();
}

function delete_banner_pic(lang){
	$("#preview-pic-" + lang).html("");
    $("#up-status-" + lang).hide();
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