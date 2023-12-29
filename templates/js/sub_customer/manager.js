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
            loadingMessage: change_lang_txt({"org_txt" : '載入中'}) + '...',
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
                    "type": 'get',
                    "url": "/agent/sub_customer_op?pdisplay=display_manager_list", // ajax source
                },
				 "bSort": false,
                /*"order": [
                    [1, "asc"]
                ]*/// set first column as a default sort by asc
				
				
				"language": { // language settings
					// metronic spesific
					"metronicGroupActions": "_TOTAL_ records selected:  ",
					"metronicAjaxRequestGeneralError": change_lang_txt({"org_txt" : '網路連線錯誤'}) + "!",

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
		
		// handle group actionsubmit button click
		/*$(".page-bar-fixed").on('click', 'button', function (e) 
		{
			e.preventDefault();
			var action = $(this);
			if(action.val() == "Addnew")
			{
				close_layer({"type":1});
				layer.open({
				  type: 2,
				  title: change_lang_txt({"org_txt" : '新增子帳號'}),
				  maxmin: true,
				  shadeClose: true,
				  area : [330 + 'px' , 280 + 'px'],
				  content: "sub_customer_editor.php?etype=add"
				});
			}
			else if (action.val() == "") 
			{
				grid.noSelectAction();
			}
		});		
        */
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
});

function add_cus(){
	close_layer({"type":1});
	layer.open({
	  type: 2,
	  title: change_lang_txt({"org_txt" : '新增子帳號'}),
	  maxmin: true,
	  shadeClose: true,
	  area : [330 + 'px' , 280 + 'px'],
	  content: "/agent/sub_customer_editor?etype=add"
	});
}

function update_customer(customer_id)
{
	/*if(confirm(change_lang_txt({"org_txt" : '確定修改嗎'}) + "?"))
	{
		var customer_pass = $("input[name=customer_pass_"+customer_id+"]").val();
		var customer_name = $("input[name=customer_name_"+customer_id+"]").val();
		var menu_perm = $("input[name='menu_perm[]'][cus_id="+customer_id+"]").serialize();
		requestJSON("sub_customer_op.php", "pdisplay=update_customer", "customer_id="+customer_id+"&customer_pass="+customer_pass+"&customer_name="+customer_name+"&"+menu_perm);
	}*/
	close_layer({"type":1});
	customize_layer_open({
	  type: 2,
	  title: change_lang_txt({"org_txt" : '修改子帳號'}),
	  maxmin: true,
	  shadeClose: true,
	  area : [330 + 'px' , 280 + 'px'],
	  content: "/agent/sub_customer_editor?etype=edit&edit_cus_id=" + customer_id,
	});
}

function update_sub_status(value,customer_userid)
{
	requestJSON("/agent/sub_customer_op", "pdisplay=update_sub_status", "value="+value+"&customer_id="+customer_userid);
}

function delete_customer(customer_id)
{
	if(confirm(change_lang_txt({"org_txt" : '確定刪除嗎'}) + "?"))
	{
		requestJSON("/agent/sub_customer_op", "pdisplay=delete_customer", "customer_id="+customer_id);
	}
}