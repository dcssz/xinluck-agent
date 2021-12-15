$(function() {
	$(".btn-span").click(function(){
		var info_field = $(this).attr("info_field");
		$(".btn-span[info_field=" + info_field + "]").removeClass("active");
		$(this).addClass("active");
		
		if(info_field == "win_amount" || info_field == "extra_win_amount"){
			info_field = "win_amount";
			var search_time_type = $(".btn-span.active[info_field=win_amount]").attr("search_time_type");
			var search_amount_type = $(".btn-span.active[info_field=extra_win_amount]").attr("search_amount_type");
		}else{
			var search_time_type = $(this).attr("search_time_type");
		}
		
		requestJSON("home_op.php", "pdisplay=change_rank_content", "info_field=" + info_field + "&search_time_type=" + search_time_type + "&search_amount_type=" + search_amount_type);
	});
});