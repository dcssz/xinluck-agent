$(function() {
	
});

function save_info(){
	var edit_game_store = $("#edit-game-store").val();
	requestJSON("game_category_gain_op.php", "pdisplay=save_info", "edit_game_store = " + edit_game_store, "#gc-name-setting-form");
}

function get_gstore_gc_info(){
	var edit_game_store = $("#edit-game-store").val();
	requestJSON("game_category_gain_op.php", "pdisplay=get_gstore_gc_info", "edit_game_store=" + edit_game_store);
}