// JavaScript Document
$(document).ready( function () {
	//initial_left_menu_hover();
	resize_page_bar_height();
	$(window).resize(function()
	{
		resize_page_bar_height();
	});
	
	document.onkeydown = function(e){  
		var ev = document.all ? window.event : e;
		if(ev.keyCode==13) {// 如（ev.ctrlKey && ev.keyCode==13）为ctrl+Center 触发
		  $(".search-btn").click();
		}
	}
});

function resize_page_bar_height(){
	if($('.page-bar-height').length > 0){
		$('.page-bar-height').height($('.page-bar-fixed').height());
	}
}

function initial_left_menu_hover(){
	var e = $("#left-menu");
	$(this).css({left:0});
	e.hover(function(){
		$(this).css({left:0});
	}, function(){
		$(this).css({left:-133});
	});
}

function change_lang(lang){
	requestJSON("index_op.php", "pdisplay=change_lang", "lang=" + lang, "");
}