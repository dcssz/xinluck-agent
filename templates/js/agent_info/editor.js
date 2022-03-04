// JavaScript Document
$(function(){
    change_customer_type();
 });
 
 //初始化nav show 全部 tab-pan事件 
 function initial_nav_all_show(){
     $("a[class=nav-all-show]").click(function()
     {
         $(this).parents(".tabbable-line").children(".tab-content").children(".tab-pane").addClass("active");
     });
 }
 
 function init_portlet_tiile_tools(area_id)
 {
     $("#" + area_id + " .has_set_tool").click(function()
     {
         var tools_icon = $(' > .tool > a',this);
         //console.log(tools_icon.attr('class'));
         if(tools_icon.attr('class') == "expand")
         {
             tools_icon.attr('class','collapse');
             $(this).next('.tabbable-line').show();
         }
         else
         {
             tools_icon.attr('class','expand');
             $(this).next('.tabbable-line').hide();
         }
     });
     
     $('.has_set_tool').css('background-color','#f1d30f4d');
     $('.has_set_tool > .caption , .tools').css('padding','14px');
     $('.has_set_tool').css('cursor','pointer');
     $('.caption-subject').css('font-size','16px');
     
 }
 
 function initial_all_set(){
     $(".all-set").keyup(function(){
         var all_set_this_el = $(this);
         var set_value = all_set_this_el.val();
         all_set_this_el.closest('tr').find('input[type=text]').each(function(){
             var input_this_el = $(this);
             var input_id = input_this_el.attr("id");
             input_this_el.val(set_value);
             if(input_id != undefined){
                 check_error(input_id, set_value);
             }
         });
     });
 }
 
 function check_error(id, set_value){
     var input_el = $("#" + id);
     var over = input_el.attr("over");
     var unlimited = input_el.attr("unlimited");
     var zero_max = input_el.attr("zero_max");
     var max_value = parseFloat($("#" + id + "-max-value").val());
     set_value = parseFloat(set_value);
     if(!unlimited){
         var has_error = 0;
         var error_txt = "";
         var normal_txt = "";
         
         if(over){
             normal_txt = "≥" + max_value;
             if(set_value < max_value){
                 has_error = 1;
                 error_txt = "≥" + max_value;
             }
         }else{
             normal_txt = "≤" + max_value;
             if(!zero_max || (zero_max == 1 && max_value != 0)){
                 if(set_value > max_value || (zero_max == 1 && set_value == 0)){
                     has_error = 1;
                     error_txt = "≤" + max_value;
                 }
             }
         }
         
         if(has_error == 1){
             $("#" + id + "-error").text(error_txt);
             $("#" + id + "-max-txt").text("");
             input_el.css("background-color", "#f06a68");
         }else{
             $("#" + id + "-error").text("");
             $("#" + id + "-max-txt").text(normal_txt);
             input_el.css("background-color", "#fff");
         }
     }
 }
 
 function initial_gstore_fast_set(gstore){
     //遊戲 全選
     $("#gstore" + gstore + "-fast-set-tb .gc-ckbox-all").click(function(){
         if($(this).prop("checked")){
             $("#gstore" + gstore + "-fast-set-tb .gc-ckbox").prop("checked",true);
             $("#gstore" + gstore + "-fast-set-tb .gc-ckbox").parent().attr("class","checked");
         }else{
             $("#gstore" + gstore + "-fast-set-tb .gc-ckbox").prop("checked",false);
             $("#gstore" + gstore + "-fast-set-tb .gc-ckbox").parent().attr("class","");	
         }
     });
     
     //玩法 全選
     if(gstore == 1){
         $("#gstore" + gstore + "-fast-set-tb .gp-ckbox-all").click(function(){
             if($(this).prop("checked")){
                 $("#gstore" + gstore + "-fast-set-tb .gp-ckbox").prop("checked",true);
                 $("#gstore" + gstore + "-fast-set-tb .gp-ckbox").parent().attr("class","checked");
             }else{
                 $("#gstore" + gstore + "-fast-set-tb .gp-ckbox").prop("checked",false);
                 $("#gstore" + gstore + "-fast-set-tb .gp-ckbox").parent().attr("class","");	
             }
         });
     }
     
     //代入上層設定的限額類型 全選
     $("#gstore" + gstore + "-fast-set-tb .bet-limit-ckbox-all").click(function(){
         if($(this).prop("checked")){
             $("#gstore" + gstore + "-fast-set-tb .bet-limit-ckbox").prop("checked",true);
             $("#gstore" + gstore + "-fast-set-tb .bet-limit-ckbox").parent().attr("class","checked");
         }else{
             $("#gstore" + gstore + "-fast-set-tb .bet-limit-ckbox").prop("checked",false);
             $("#gstore" + gstore + "-fast-set-tb .bet-limit-ckbox").parent().attr("class","");	
         }
     });
     
     //自訂設定的限額類型 輸入事件
     $("#gstore" + gstore + "-fast-set-tb .self-input").keyup(function(){
         var this_el = $(this);
         var bet_limit_spot = this_el.attr("spot");
         var gc_spot_array = Array();
         var gp_spot_array = Array();
         gc_spot_array = check_gstore_fast_set(gstore, "gc-ckbox");
         if(gstore == 1){
             gp_spot_array = check_gstore_fast_set(gstore, "gp-ckbox");
             if(gc_spot_array.length > 0 && gp_spot_array.length > 0){
                 if(this_el.val().replace(/(^s*)|(s*$)/g, "").length != 0){
                     gstore_fast_set_self_write_value(gstore, gc_spot_array, gp_spot_array,  bet_limit_spot, this_el.val());
                 }
             }
         }else if(gc_spot_array.length > 0){
             if(this_el.val().replace(/(^s*)|(s*$)/g, "").length != 0){
                 gstore_fast_set_self_write_value(gstore, gc_spot_array, gp_spot_array, bet_limit_spot, this_el.val());
             }	
         }		
     });
     
     //快速設定 自訂 過關關數
     if(gstore == 1){ 
         $("select.fast_set").change(function(){
             var this_el = $(this);
             var gc_spot_array = Array();
             gc_spot_array = check_gstore_fast_set(gstore, "gc-ckbox");
             if(gc_spot_array.length > 0 ){
                 for(var gcs_num = 0; gcs_num < gc_spot_array.length; gcs_num++){
                     var this_el_max = $('#gs' + gstore + '-' + gc_spot_array[gcs_num] +'-opt_7_1-max-value');
                     if(parseInt(this_el.val()) > parseInt(this_el_max.val())){
                         $('#gs' + gstore + '-' + gc_spot_array[gcs_num] +'-opt_7_1').val( this_el_max.val());
                     }else if( parseInt(this_el.val()) > 0){
                         $('#gs' + gstore + '-' + gc_spot_array[gcs_num] +'-opt_7_1').val( this_el.val() );
                     }
                 }
             }	
         });
     }
     
     //自訂設定的全部後丟 點擊事件
     /*$("#gstore" + gstore + "-fast-set-tb .self-ckbox").click(function(){
         var this_el = $(this);
         var bet_limit_spot = this_el.attr("spot");
         var gc_spot_array = Array();
         gc_spot_array = check_gstore_fast_set(gstore, "gc-ckbox");
         if(gc_spot_array.length > 0)
         {
             if(this_el.val().replace(/(^s*)|(s*$)/g, "").length != 0){
                 gstore_fast_set_self_check_ckbox(gstore, gc_spot_array, bet_limit_spot, this_el);
             }	
         }	
     });*/
     
     //代入上層按鈕點擊
     $("#gstore" + gstore + "-apply-top-btn").click(function(){
         var gc_spot_array = Array();
         var gp_spot_array = Array();
         var bet_limit_spot_array = Array();
         gc_spot_array = check_gstore_fast_set(gstore, "gc-ckbox");
         bet_limit_spot_array = check_gstore_fast_set(gstore, "bet-limit-ckbox");
         if(gstore == 1){
             gp_spot_array = check_gstore_fast_set(gstore, "gp-ckbox");
             if(gc_spot_array.length > 0 && gp_spot_array.length > 0 && bet_limit_spot_array.length > 0){			
                 gstore_fast_set_top_write_value(gstore, gc_spot_array, gp_spot_array, bet_limit_spot_array);
             } 
         }else if(gc_spot_array.length > 0 && bet_limit_spot_array.length > 0){			
             gstore_fast_set_top_write_value(gstore, gc_spot_array, gp_spot_array, bet_limit_spot_array);
         } 
     });
 }
 
 function check_gstore_fast_set(gstore, class_name){
     var check_fast_set_bool = false;
     var check_fast_set_array = new Array();
     
     $("#gstore" + gstore + "-fast-set-tb ." + class_name).each(function(){
         if($(this).prop("checked")){
             check_fast_set_bool = true;	  
             check_fast_set_array.push($(this).attr("spot"));			  		  
         }   
     });
     
     if(!check_fast_set_bool){
         var message = "";
         switch (class_name){
             case "gc-ckbox":
                 message = change_lang_txt({"org_txt" : "遊戲"});
                 break;
             case "gp-ckbox":
                 message = change_lang_txt({"org_txt" : "玩法"});
                 break;
             case "bet-limit-ckbox":
                 message = change_lang_txt({"org_txt" : "代入上層設定"});
                 break;	
         }
         pop_msg(change_lang_txt({"org_txt" : "請勾選"}) + " - " + message);
     }
     
     return check_fast_set_array;
 }
 
 function gstore_fast_set_self_write_value(gstore, gc_spot_array, gp_spot_array, bet_limit_spot, set_value){
     var check_spot = "";
     for(var gcs_num = 0; gcs_num < gc_spot_array.length; gcs_num++){
         if(gstore == 1){
             for(var gps_num = 0; gps_num < gp_spot_array.length; gps_num++){
                 trans_arr = gstore_fast_set_transform(gstore, gp_spot_array[gps_num]);
                 for(var trans_arr_num = 0;  trans_arr_num < trans_arr.length; trans_arr_num++){
                     check_spot = "spot-gs" + gstore + "-" + gc_spot_array[gcs_num] + "-" + trans_arr[trans_arr_num] + "-" + bet_limit_spot;
                     $(".bet-opt-tb-" + gstore + " ." + check_spot).each(function(index, element) {
                         var this_el = $(this);
                         this_el.val(set_value);
                         check_error(this_el.attr("id"), set_value);		
                     });
                 }
             }
         }else{
             check_spot = "spot-gs" + gstore + "-" + gc_spot_array[gcs_num] + "-" + bet_limit_spot;
             $(".bet-opt-tb-" + gstore + " ." + check_spot).each(function(index, element) {
                 var this_el = $(this);
                 this_el.val(set_value);
                 check_error(this_el.attr("id"), set_value);		
             });
         }
     }
 }
 
 function gstore_fast_set_self_check_ckbox(gstore, gc_spot_array, bet_limit_spot, this_el){
     var check_spot = "";
     for(var gcs_num = 0; gcs_num < gc_spot_array.length; gcs_num++)
     {	
         check_spot = "spot-gs" + gstore + "-" + gc_spot_array[gcs_num] + "-" + bet_limit_spot;
         var change_el = $(".bet-opt-tb-" + gstore + " ." + check_spot);
         if(this_el.prop("checked")){
             change_el.prop("checked",true);
             change_el.parent().attr("class","checked");
         }else{
             change_el.prop("checked",false);
             change_el.parent().attr("class","");
         }
     }
 }
 
 function gstore_fast_set_top_write_value(gstore, gc_spot_array, gp_spot_array, bet_limit_spot_array){
     var check_spot = "";
     var top_value = "";
     var trans_arr = new Array();
     for(var gcs_num = 0; gcs_num < gc_spot_array.length; gcs_num++)
     {	
         for(var bls_num = 0; bls_num < bet_limit_spot_array.length; bls_num++){
             if(gstore == 1){
                 for(var gps_num = 0; gps_num < gp_spot_array.length; gps_num++){
                     trans_arr = gstore_fast_set_transform(gstore, gp_spot_array[gps_num]);
                     for(var trans_arr_num = 0;  trans_arr_num < trans_arr.length; trans_arr_num++){
                         check_spot = "spot-gs" + gstore + "-" + gc_spot_array[gcs_num] + "-" + trans_arr[trans_arr_num] + "-" + bet_limit_spot_array[bls_num];
                         $(".bet-opt-tb-" + gstore + " ." + check_spot).each(function(index, element) {
                             var this_el = $(this);
                             top_value = $("#" + this_el.attr("id") + "-max-value").val();
                             if(top_value == undefined)
                                 top_value = 0;
                             this_el.val(top_value);
                             check_error(this_el.attr("id"), top_value);			
                         });
                     }
                 }
                 if(bet_limit_spot_array.indexOf("7") >= 0){
                     var this_el_max = $('#gs' + gstore + '-' + gc_spot_array[gcs_num] +'-opt_7_1-max-value');
                     $('#gs' + gstore + '-' + gc_spot_array[gcs_num] +'-opt_7_1').val( this_el_max.val());
                 }
             }else{
 
                 check_spot = "spot-gs" + gstore + "-" + gc_spot_array[gcs_num] + "-" + bet_limit_spot_array[bls_num];
                 $(".bet-opt-tb-" + gstore + " ." + check_spot).each(function(index, element) {
                     var this_el = $(this);
                     top_value = $("#" + this_el.attr("id") + "-max-value").val();
                     this_el.val(top_value);
                     check_error(this_el.attr("id"), top_value);			
                 });
             }
         }
     }
 }
 
 function gstore_fast_set_transform(gstore, transform_key){
     var string_transform = new Array();
     if(gstore == 1){
         switch(transform_key){
             case "1"://讓分
                 string_transform = ["1_1","2_1","3_1","8_1","17_1","18_1","23_1"]; 
                 break;
             case "2"://大小
                 string_transform = ["1_2","2_2","3_2","8_2","17_2","18_2","21_2","22_2", "23_2"];
                 break;
             case "3"://獨贏
                 string_transform = ["1_3","2_3","3_3","8_3","17_3","18_3","23_3"];
                 break;
             case "4"://單雙
                 string_transform = ["1_4","2_4","3_4","8_4","17_4","18_4","23_4"];
                 break;
             case "5"://走地讓分
                 string_transform = ["4_1","5_1","19_1","20_1","30_1"];
                 break;
             case "6"://走地大小
                 string_transform = ["4_2","5_2","19_2","20_2","30_2"];
                 break;
             case "7"://走地獨贏
                 string_transform = ["4_3","5_3","19_3","20_3","30_3"];
                 break;
             case "8"://走地單雙
                 string_transform = ["4_4","5_4","19_4","20_4","30_4"];
                 break;
             case "9"://過關
                 string_transform = ["7_1"];
                 break;
             case "10"://波膽
                 string_transform = ["12_1"];
                 break;
             case "11"://入球數
                 string_transform = ["13_1"];
                 break;
             case "12"://半全場
                 string_transform = ["14_1"];
                 break;
             case "13"://搶首分 搶尾分
                 string_transform = ["15_1","16_1"];
                 break;
         }
     }else{
         string_transform = [transform_key];
     }
     
     
     return string_transform;
 }
 
 function scroll_to_error_place(error_id, args){
     var error_el = $("#" + error_id);
     
     //先把画面上所有限额设定打开显示
     /*for(var index in args.gstore_arr){
         $("#gstore" + args.gstore_arr[index] + "-nav-all-expand").click();
     }*/
     $(".nav-all-show").click();
     $(".portlet-title .tool .expand").click();
     
     var el_top = error_el.offset().top;//offset top 數值解釋(指的是跟有scroll bar 的document的距離，如該原件在一個有scroll bar的div裡 他的top 是會隨這scroll bar拉制的位置而不一樣 因為她是對應document來算距離的)
     /*var scroll_top = $('.page-content').scrollTop();
     var diff_top = el_top - 200;
     
     //拉至错误地方
     $('.page-content').scrollTop(scroll_top + diff_top);*/
     var scroll_top = $(window).scrollTop();
     var diff_top = el_top - 200;
     
     //拉至错误地方
     $(window).scrollTop(diff_top);
     
     
     
 }
 
 function change_gstore_hd_type(e, customer_level){	//add new code
     var this_el = $(e);
     var this_hd_type = this_el.val();
     var game_store = this_el.attr("gstore");
     
     //因為checkbox設定readonly還是可以勾選或取消 所以判斷如果有readonly屬性 要一直選取住
     if(this_el.prop("readonly")){
         this_el.prop("checked", true);
         $(this).parent().attr("class", "checked");
     }
     
     //會員只能勾選一個
     if(customer_level == "16"){
         if(this_el.prop("checked")){
             $("input[type=checkbox][gstore=" + game_store + "]").each(function(index, element) {
                 if($(this).val() != this_hd_type){
                     $(this).prop("checked",false);
                     $(this).parent().attr("class","");
                 }
             });
         }
     }
 }
 
 //=== 真人設定 start ===//
 function change_allbet_hd_type(e, customer_level){	//add new code
     var this_el = $(e);
     var this_hd_type = this_el.val();
     
     //會員只能勾選一個
     if(customer_level == "16" && this_el.hasClass("allbet_vip_handicaps")){
         if(this_el.prop("checked")){
             $(".allbet_vip_handicaps").each(function(index, element) {
                 if($(this).val() != this_hd_type){
                     $(this).prop("checked",false);
                     $(this).parent().attr("class","");
                 }
             });
         }
     }
 }
 
 function change_yb_live_hd_type(e, customer_level){	//add new code
     var this_el = $(e);
     var this_hd_type = this_el.val();
     
     //會員只能勾選一個
     if(customer_level == "16" && this_el.hasClass("yb_live_handicaps")){
         if(this_el.prop("checked")){
             $(".yb_live_handicaps").each(function(index, element) {
                 if($(this).val() != this_hd_type){
                     $(this).prop("checked",false);
                     $(this).parent().attr("class","");
                 }
             });
         }
     }
 }
 
 function change_dg_hd_type(e, customer_level){	//add new code
     var this_el = $(e);
     var this_hd_type = this_el.val();
     
     //會員只能勾選一個
     if(customer_level == "16" && this_el.hasClass("dg_handicaps")){
         if(this_el.prop("checked")){
             $(".dg_handicaps").each(function(index, element) {
                 if($(this).val() != this_hd_type){
                     $(this).prop("checked",false);
                     $(this).parent().attr("class","");
                 }
             });
         }
     }
 }
 //=== 真人設定 end ===//
 
 //=== 開放遊戲設定 start ===/
 function initial_game_status_set(){
     $(".status-ckbox-all").each(function(index, element) {
         var spot = $(this).attr("spot");
         var status_ckbox_all_el = $(this);
         var status_ckbox_el = $("input[class='status-ckbox'][spot='" + spot + "']:enabled");
         
         //預設全選
         //status_ckbox_all_el.prop("checked",true);
         //status_ckbox_all_el.parent().attr("class","checked");
         //status_ckbox_el.prop("checked",true);
         //status_ckbox_el.parent().attr("class","checked");
         
         status_ckbox_all_el.click(function(){
             if($(this).prop("checked")){
                 status_ckbox_el.prop("checked",true);
                 status_ckbox_el.parent().attr("class","checked");		
             }else{
                 status_ckbox_el.prop("checked",false);
                 status_ckbox_el.parent().attr("class","");	
             }
         });
         
         
         status_ckbox_el.change(function(){
             if($("input[class='status-ckbox'][spot='" + spot + "']:checked").length == status_ckbox_el.length){
                 status_ckbox_all_el.prop("checked",true);
                 status_ckbox_all_el.parent().attr("class","checked");
             }
             else{
                 status_ckbox_all_el.prop("checked",false);
                 status_ckbox_all_el.parent().attr("class","");
             }
         });
         
         status_ckbox_el.change();
     });
 }
 //=== 開放遊戲設定 end ===/
 
 function show_data_content(el_this, area_id){
     var el_area = $('#' + area_id);
     //按鈕選中
     $('.type-btn1').removeClass('active');
     $(el_this).addClass('active');
     
     //只顯示選中區塊
     $('.data-content').addClass('hidden');
     /*if($('#' + area_id + " #no-data").length > 0){//沒內容的話 跟伺服器要資料
         page_content_mask_show();
         var etype = $('#etype').val();
         var edit_cus_id = $('#edit-cus-id').val();
         var edit_cus_level = $('#edit-cus-level').val();
         var top_cus_id = $('#top-cus-id').val();
         requestJSON("agent_info_editor_op.php", "pdisplay=get_data_content", "area_id=" + area_id + "&etype=" + etype + "&edit_cus_id=" + edit_cus_id + "&edit_cus_level=" + edit_cus_level + "&top_cus_id=" + top_cus_id);
         el_area.removeClass('hidden');
     }else{
         el_area.removeClass('hidden');
         change_save_btn_area(area_id);
     }*/
     if(area_id != 'basic-info-area'){//改都跟伺服器要資料(但基本資料沒有單獨要資料)
         $("#" + area_id).html("");
         page_content_mask_show();
         var etype = $('#etype').val();
         var edit_cus_id = $('#edit-cus-id').val();
         var edit_cus_level = $('#edit-cus-level').val();
         var top_cus_id = $('#top-cus-id').val();
         requestJSON("agent_info_editor_op.php", "pdisplay=get_data_content", "area_id=" + area_id + "&etype=" + etype + "&edit_cus_id=" + edit_cus_id + "&edit_cus_level=" + edit_cus_level + "&top_cus_id=" + top_cus_id);
         el_area.removeClass('hidden');
     }else{
         el_area.removeClass('hidden');
         change_save_btn_area(area_id);
     }
     
     //el_area.removeClass('hidden');
 }
 
 function change_save_btn_area(area_id){
     //上下方固定條儲存紐換掉
     var save_btn = $('#' + area_id + " .save-btn").html();
     $('#top-save-btn-area').html(save_btn);
     $('#bottom-save-btn-area').html(save_btn);
 }
 
 function page_content_mask_show(){
     $("#page-content-mask").show();
 }
 
 function page_content_mask_hide(){
     $("#page-content-mask").hide();
 }
 
 function save_customer(save_type){
     page_content_mask_show();
     //因為是送op更新 不會重整畫面 所以密碼部分一律在按下存檔後 清空
     var etype = $('#etype').val();
     var edit_cus_id = $('#edit-cus-id').val();
     var edit_cus_level = $('#edit-cus-level').val();
     var edit_station_code = $('#edit-station-code').val();
     var top_cus_id = $('#top-cus-id').val();
     requestJSON("/agent/save_agent_info", "pdisplay=save_customer", "save_type=" + save_type + "&etype=" + etype + "&edit_cus_id=" + edit_cus_id + "&edit_cus_level=" + edit_cus_level + "&edit_station_code=" + edit_station_code + "&top_cus_id=" + top_cus_id, $("#" + save_type + "-area form"));
     $('#customer_pass1').val('');
     $('#customer_pass2').val('');
 }
 
 //=== 行卡相關 ===//
 /*function change_bank_province(){
     //開戶省如果變動, 開戶市要更新為該省內的城市
     var bank_province = $("#bank-province").val();
     requestJSON("agent_info_editor_op.php", "pdisplay=change_bank_province", "bank_province=" + bank_province);
 }*/
 
 function show_add_bank_info_div(){
     var edit_cus_id = $('#edit-cus-id').val();
     if(!$("#add-bank-info-div").is(':visible')){
         close_layer({type: 1});
         requestJSON("agent_info_editor_op.php", "pdisplay=show_add_bank_info_div", "edit_cus_id=" + edit_cus_id);	
     }
 }
 
 function change_bank_area(bank_area){
     var target_e = $('#bank-name-select');
     target_e.html('');
     if(typeof bank_list[bank_area] !== 'undefined'){
         $.each(bank_list[bank_area], function(none_use_key, bank_opt_arr){
             //console.log(bank_name);
             var show_bank_name = change_lang_txt({"org_txt" : bank_opt_arr['bank_name']});
             if(typeof bank_opt_arr['bank_code'] !== 'undefined'){
                 show_bank_name = bank_opt_arr['bank_code'] + " " + show_bank_name;
             }
             target_e.append('<option value="' + show_bank_name + '">' + show_bank_name + '</option>');
         });
     }
 }
 
 function save_add_bank_info(){
     var edit_cus_id = $('#edit-cus-id').val();
     requestJSON("agent_info_editor_op.php", "pdisplay=save_add_bank_info", "edit_cus_id=" + edit_cus_id, "#add-bank-info-form");
 }
 
 function change_bank_info_status(edit_info_id, edit_status){
     var edit_cus_id = $('#edit-cus-id').val();
     requestJSON("agent_info_editor_op.php", "pdisplay=change_bank_info_status", "edit_cus_id=" + edit_cus_id + "&edit_info_id=" + edit_info_id + "&edit_status=" + edit_status);
 }
 
 function delete_bank_info(edit_info_id){
     var edit_cus_id = $('#edit-cus-id').val();
     requestJSON("agent_info_editor_op.php", "pdisplay=delete_bank_info", "edit_cus_id=" + edit_cus_id + "&edit_info_id=" + edit_info_id);
 }
 
 
 //== 代理專用 ===//
 function change_customer_type(){
     var customer_type = $("input[name=customer_type]:checked").val();
     if(customer_type == 1){
         $("tr[customer_type=1]").show();
         $("tr[customer_type=2]").hide();
     }else{
         $("tr[customer_type=1]").hide();
         $("tr[customer_type=2]").show();
     }
 }
 
 
 