// JavaScript Document
var is_layer_loading = -1;//用來判斷當前是否已經有呼叫layer_loading且未關閉的，以免同個流程呼叫兩次layer_loading 會閃爍畫面
function change_lang_txt(args){
	if(typeof lang_obj !== 'undefined' && lang_obj[args["org_txt"]])
		return lang_obj[args["org_txt"]];

	return args["org_txt"];
}

function padLeft(str,lenght){
	if(str.length >= lenght)
		return str;
	else
		return padLeft("0" +str,lenght);
}

function floor_dec(v, precision){
	var c = Math.pow(10, precision);
	var e = Math.abs(v) * c;
	if(v < 0)
		return -1 * Math.floor(e) / c;
	else	
		return Math.floor(e) / c;
}

function customize_layer_open(opt_obj){
	layer.open(opt_obj);
}

function close_layer(opt_obj){
	//opt_obj key 
	//=>type:1 關掉全部layer
	if(opt_obj['type'] == 1){
		layer.closeAll();
		$(".layui-layer-shade").remove();
	}
	is_layer_loading = -1;
}

function layer_loading(opt_obj){
	if(is_layer_loading == -1){
		is_layer_loading = 1;
		if(!opt_obj['msg'])
			opt_obj['msg'] = change_lang_txt({"org_txt" : '載入中'});

		if(opt_obj['type'] == 1){
			customize_layer_open({
				title: false,
				content: (opt_obj['msg'] + "..."),
				closeBtn: false,
				shade: 0.5,
				btn: false,
				type: 0,
				icon: 16
			});
		}
	}
}

function layer_type0_open(msg){
	layer.open({
		title: change_lang_txt({"org_txt" : "訊息"}),
		content:msg,
		btn: change_lang_txt({"org_txt" : "確定"}),
		shadeClose: true,
		//time: 3000,//三秒後自動關閉
	});
}

function layer_type1_open(msg){
	layer.open({
		title: '訊息',
		content:msg,
		btn: "確定",
		shadeClose: true,
		type:1,
		//time: 3000,//三秒後自動關閉
	});
}

function pop_msg(msg){
	layer_type0_open('<div class="font-20">' + msg + '</div>');
}

function change_iframe_url(href){
	var span_id = $(window.parent.document).find("#iframe-change-btn-div .change-btn-span.active").attr('id');
	var page_name = span_id.replace(/_span/, "");
	var iframe_id = page_name + "_iframe";
	$(window.parent.document).find("#" + iframe_id).attr("src", href);
}

function show_qr_code(link_href){
	var content = "";
	var img_src = 'https://api.qrserver.com/v1/create-qr-code/?margin=10&data=' + link_href;
	content = '<img src="' + img_src + '">';
	if(link_href == "")
		content = change_lang_txt({"org_txt" : '無法顯示'});
	layer.open({
		title: 'QR code',
		area: ['250px', '300px'],
		content: content,
		shadeClose: true,
		type:1
		//time: 3000,//三秒後自動關閉
	});
}

function show_msg(msg_code, args){
	var msg = "";
	var target = args.target;
	if(args !== null){
		if(args.hasOwnProperty('m1'))
			args.m1 = '<span class="color-red1">' + args.m1 + '</span>';
		else
			args.m1 = "";
			
		if(args.hasOwnProperty('m2'))
			args.m2 = '<span class="color-red1">' + args.m2 + '</span>';
		else
			args.m2 = "";
			
		if(args.hasOwnProperty('m3'))
			args.m3 = '<span class="color-red1">' + args.m3 + '</span>';
		else
			args.m3 = "";
	}
	
	switch(target) {
		/*case "kangNewsType":
			if(msg_code == -1 || msg_code == -2){
				msg = change_lang_txt({"org_txt" : "儲存成功"}) + "!";
			}else if(msg_code == -3){
				msg = change_lang_txt({"org_txt" : "刪除成功"}) + "!";
			}else if(msg_code == 1){
				msg = change_lang_txt({"org_txt" : "操作失敗"}) + "!";
			}else if(msg_code == 2){
				msg = change_lang_txt({"org_txt" : "請輸入類型名稱"}) + "!";
			}else if(msg_code == 3){
				msg = change_lang_txt({"org_txt" : "已有公告套用此分類, 無法刪除"}) + "!";
			}
			break;*/
		case "kangNews":
			if(msg_code == -1 || msg_code == -2){
				msg = change_lang_txt({"org_txt" : "儲存成功"}) + "!";
			}else if(msg_code == -3){
				msg = change_lang_txt({"org_txt" : "刪除成功"}) + "!";
			}else if(msg_code == 1){
				msg = change_lang_txt({"org_txt" : "操作失敗"}) + "!";
			}else if(msg_code == 2){
				msg = change_lang_txt({"org_txt" : "請輸入公告內容"}) + "!";
			}else if(msg_code == 3){
				msg = change_lang_txt({"org_txt" : "請選擇公告類型"}) + "!";
			}else if(msg_code == 4){
				msg = change_lang_txt({"org_txt" : "請選擇公告對象"}) + "!";
			}
			break;
		case "kangRegister":
			if(msg_code == -1){
				msg = change_lang_txt({"org_txt" : "儲存成功"}) + "!";
			}else if(msg_code == 1){
				msg = change_lang_txt({"org_txt" : "操作失敗"}) + "!";
			}
			break;
		case "kangBanner":
			if(msg_code == -1 || msg_code == -2){
				msg = change_lang_txt({"org_txt" : "儲存成功"}) + "!";
			}else if(msg_code == -3){
				msg = change_lang_txt({"org_txt" : "刪除成功"}) + "!";
			}else if(msg_code == 1){
				msg = change_lang_txt({"org_txt" : "操作失敗"}) + "!";
			}else if(msg_code == 2){
				msg = change_lang_txt({"org_txt" : "請輸入圖片名稱"}) + "!";
			}else if(msg_code == 3){
				msg = change_lang_txt({"org_txt" : "請選擇圖片連結類型"}) + "!";
			}else if(msg_code == 4){
				msg = change_lang_txt({"org_txt" : "請選擇內部優惠文案所對應的文案"}) + "!";
			}else if(msg_code == 5){
				msg = change_lang_txt({"org_txt" : "請輸入自定義連結內容"}) + "!";
			}else if(msg_code == 6){
				msg = change_lang_txt({"org_txt" : "自定義連結非連結格式"}) + "!";
			}else if(msg_code == 7){
				msg = change_lang_txt({"org_txt" : "請上傳輪播圖片"}) + "!";
			}
			break;
		case "kangSiteMsg":
			if(msg_code == -1 || msg_code == -2){
				msg = change_lang_txt({"org_txt" : "儲存成功"}) + "!";
			}else if(msg_code == -3 || msg_code == -4){
				msg = change_lang_txt({"org_txt" : "刪除成功"}) + "!";
			}else if(msg_code == 1){
				msg = change_lang_txt({"org_txt" : "操作失敗"}) + "!";
			}else if(msg_code == 2){
				msg = change_lang_txt({"org_txt" : "請輸入消息內容"}) + "!";
			}else if(msg_code == 3){
				msg = change_lang_txt({"org_txt" : "請選擇發送方式"}) + "!";
			}else if(msg_code == 4){
				msg = change_lang_txt({"org_txt" : "請選擇彈窗類型"}) + "!";
			}else if(msg_code == 5){
				msg = change_lang_txt({"org_txt" : "請輸入指定會員帳號"}) + "!";
			}else if(msg_code == 6){
				msg = change_lang_txt({"org_txt" : "請選擇指定等級"}) + "!";
			}
			break;
		case "kangGameStoreInfo":
			if(msg_code == -1){
				msg = change_lang_txt({"org_txt" : "儲存成功"}) + "!";
			}else if(msg_code == -2){
				msg = change_lang_txt({"org_txt" : "修改狀態成功"}) + "!";
			}else if(msg_code == 1){
				msg = change_lang_txt({"org_txt" : "操作失敗"}) + "!";
			}
			break;
		case "kangGameMark":
			if(msg_code == -1 || msg_code == -2){
				msg = change_lang_txt({"org_txt" : "儲存成功"}) + "!";
			}else if(msg_code == -3){
				msg = change_lang_txt({"org_txt" : "刪除成功"}) + "!";
			}else if(msg_code == 1){
				msg = change_lang_txt({"org_txt" : "操作失敗"}) + "!";
			}else if(msg_code == 2){
				msg = change_lang_txt({"org_txt" : "請輸入標籤名稱"}) + "!";
			}
			break;
		case "kangGameCategoryInfo":
			if(msg_code == -1){
				msg = change_lang_txt({"org_txt" : "儲存成功"}) + "!";
			}else if(msg_code == -2){
				msg = change_lang_txt({"org_txt" : "修改狀態成功"}) + "!";
			}else if(msg_code == 1){
				msg = change_lang_txt({"org_txt" : "操作失敗"}) + "!";
			}
			break;
		case "kangCusGrade":
			if(msg_code == -1 || msg_code == -2){
				msg = change_lang_txt({"org_txt" : "儲存成功"}) + "!";
			}else if(msg_code == -3){
				msg = change_lang_txt({"org_txt" : "刪除成功"}) + "!";
			}else if(msg_code == 1){
				msg = change_lang_txt({"org_txt" : "操作失敗"}) + "!";
			}else if(msg_code == 2){
				msg = change_lang_txt({"org_txt" : "請輸入等級名稱"}) + "!";
			}else if(msg_code == 3){
				msg = change_lang_txt({"org_txt" : "優先度不可重複使用"}) + "!";
			}else if(msg_code == 4){
				msg = change_lang_txt({"org_txt" : "優先度需為正數"}) + "!";
			}
			break;
		case "kangCusMark":
			if(msg_code == -1 || msg_code == -2){
				msg = change_lang_txt({"org_txt" : "儲存成功"}) + "!";
			}else if(msg_code == -3){
				msg = change_lang_txt({"org_txt" : "刪除成功"}) + "!";
			}else if(msg_code == -4){
				msg = change_lang_txt({"org_txt" : "設置成功"}) + "!";
			}else if(msg_code == -5){
				msg = change_lang_txt({"org_txt" : "移除成功"}) + "!";
			}else if(msg_code == 1){
				msg = change_lang_txt({"org_txt" : "操作失敗"}) + "!";
			}else if(msg_code == 2){
				msg = change_lang_txt({"org_txt" : "請輸入標籤名稱"}) + "!";
			}else if(msg_code == 3){
				msg = change_lang_txt({"org_txt" : "請輸入會員帳號"}) + "!";
			}
			break;
		case "kangAdjustQuota":
			if(msg_code == -1){
				msg = change_lang_txt({"org_txt" : "調度成功"}) + "!";
			}else if(msg_code == 1){
				msg = change_lang_txt({"org_txt" : "操作失敗"}) + "!";
			}else if(msg_code == 2){
				msg = change_lang_txt({"org_txt" : "請輸入調度金額"}) + "!";
			}else if(msg_code == 3){
				msg = change_lang_txt({"org_txt" : "調度金額需為正數"}) + "!";
			}else if(msg_code == 4){
				msg = change_lang_txt({"org_txt" : "請選擇調度原因"}) + "!";
			}
			break;
		case "kangMerchantDepositOrders":
		case "kangCompanyDepositOrders":
		case "kangAgentWithdrawOrders":
		case "kangMemWithdrawOrders":
			if(msg_code == -1){
				msg = change_lang_txt({"org_txt" : "操作成功"}) + "!";
			}else if(msg_code == -2){
				msg = change_lang_txt({"org_txt" : "鎖定成功"}) + "!";
			}else if(msg_code == -3){
				msg = change_lang_txt({"org_txt" : "解除鎖定成功"}) + "!";
			}else if(msg_code == 1){
				msg = change_lang_txt({"org_txt" : "操作失敗"}) + "!";
			}else if(msg_code == 2){
				msg = change_lang_txt({"org_txt" : "操作失敗"}) + "! " + change_lang_txt({"org_txt" : "此訂單已被處理"}) + "!";
			}
			break;	
		case "kangManualPayment":
			if(msg_code == -1){
				msg = change_lang_txt({"org_txt" : "操作成功"}) + "!";
			}else if(msg_code == 1){
				msg = change_lang_txt({"org_txt" : "操作失敗"}) + "!";
			}else if(msg_code == 2){
				msg = change_lang_txt({"org_txt" : "請輸入金額"}) + "!";
			}else if(msg_code == 3){
				msg = change_lang_txt({"org_txt" : "金額需為正數"}) + "!";
			}else if(msg_code == 4){
				msg = change_lang_txt({"org_txt" : "會員銀行卡錯誤"}) + "!";
			}else if(msg_code == 5){
				msg = change_lang_txt({"org_txt" : "該帳號當前尚有未處理完成的取款申請單, 無法重複申請"}) + "!";
			}else if(msg_code == 6){
				msg = change_lang_txt({"org_txt" : "請輸入"}) + ' - ' + args.m1 + "!";
			}else if(msg_code == 7){
				msg = args.m1 + ' - ' + change_lang_txt({"org_txt" : "需為正數"}) + "!";
			}else if(msg_code == 8){
				msg = change_lang_txt({"org_txt" : "實際取款金額需大於0"}) + "!";
			}
			break;	
		case "kangEffectCusRule":
			if(msg_code == -1 || msg_code == -2){
				msg = change_lang_txt({"org_txt" : "儲存成功"}) + "!";
			}else if(msg_code == -3){
				msg = change_lang_txt({"org_txt" : "刪除成功"}) + "!";
			}else if(msg_code == 1){
				msg = change_lang_txt({"org_txt" : "操作失敗"}) + "!";
			}else if(msg_code == 2){
				msg = change_lang_txt({"org_txt" : "請輸入規則名稱"}) + "!";
			}
			break;
		case "kangCommissionRule":
			if(msg_code == -1 || msg_code == -2){
				msg = change_lang_txt({"org_txt" : "儲存成功"}) + "!";
			}else if(msg_code == -3){
				msg = change_lang_txt({"org_txt" : "刪除成功"}) + "!";
			}else if(msg_code == 1){
				msg = change_lang_txt({"org_txt" : "操作失敗"}) + "!";
			}else if(msg_code == 2){
				msg = change_lang_txt({"org_txt" : "請輸入規則名稱"}) + "!";
			}
			break;
		case "kangRetreatRule":
			if(msg_code == -1 || msg_code == -2){
				msg = change_lang_txt({"org_txt" : "儲存成功"}) + "!";
			}else if(msg_code == -3){
				msg = change_lang_txt({"org_txt" : "刪除成功"}) + "!";
			}else if(msg_code == 1){
				msg = change_lang_txt({"org_txt" : "操作失敗"}) + "!";
			}else if(msg_code == 2){
				msg = change_lang_txt({"org_txt" : "請輸入規則名稱"}) + "!";
			}
			break;
		case "kangExtraCommissionRule":
			if(msg_code == -1 || msg_code == -2){
				msg = change_lang_txt({"org_txt" : "儲存成功"}) + "!";
			}else if(msg_code == -3){
				msg = change_lang_txt({"org_txt" : "刪除成功"}) + "!";
			}else if(msg_code == 1){
				msg = change_lang_txt({"org_txt" : "操作失敗"}) + "!";
			}else if(msg_code == 2){
				msg = change_lang_txt({"org_txt" : "請輸入規則名稱"}) + "!";
			}
			break;
		case "kangSysPayment":
			if(msg_code == -1){
				msg = change_lang_txt({"org_txt" : "儲存成功"}) + "!";
			}else if(msg_code == 1){
				msg = change_lang_txt({"org_txt" : "操作失敗"}) + "!";
			}
			break;
		case "kangPaymentPattern":
			if(msg_code == -1 || msg_code == -2){
				msg = change_lang_txt({"org_txt" : "儲存成功"}) + "!";
			}else if(msg_code == -3){
				msg = change_lang_txt({"org_txt" : "刪除成功"}) + "!";
			}else if(msg_code == 1){
				msg = change_lang_txt({"org_txt" : "操作失敗"}) + "!";
			}else if(msg_code == 2){
				msg = change_lang_txt({"org_txt" : "請輸入網頁顯示名稱"}) + "!";
			}
			break;
		case "kangDiscountCategory":
			if(msg_code == -1 || msg_code == -2){
				msg = change_lang_txt({"org_txt" : "儲存成功"}) + "!";
			}else if(msg_code == -3){
				msg = change_lang_txt({"org_txt" : "刪除成功"}) + "!";
			}else if(msg_code == 1){
				msg = change_lang_txt({"org_txt" : "操作失敗"}) + "!";
			}else if(msg_code == 2){
				msg = change_lang_txt({"org_txt" : "請輸入優惠分類名稱"}) + "!";
			}
			break;
		case "kangPeriodEditor":
			if(msg_code == -1 || msg_code == -2){
				msg = change_lang_txt({"org_txt" : "儲存成功"}) + "!";
			}else if(msg_code == 1){
				msg = change_lang_txt({"org_txt" : "操作失敗"}) + "!";
			}else if(msg_code == 2){
				msg = change_lang_txt({"org_txt" : "請輸入期數名稱"}) + "!";
			}else if(msg_code == 3){
				msg = change_lang_txt({"org_txt" : "請選擇結轉項目"}) + "!";
			}else if(msg_code == 4){
				msg = change_lang_txt({"org_txt" : "請選擇結轉類型"}) + "!";
			}else if(msg_code == 5){
				msg = change_lang_txt({"org_txt" : "請選擇期數規則"}) + "!";
			}
			break;
		case "kangPeriodAuditManager":
			if(msg_code == -2){
				msg = change_lang_txt({"org_txt" : "計算完成"}) + "!";
			}else if(msg_code == 1){
				msg = change_lang_txt({"org_txt" : "操作失敗"}) + "!";
			}else if(msg_code == 2){
				msg = change_lang_txt({"org_txt" : "請先審核"}) + ' - ' + args.m1 + "!";
			}else if(msg_code == 3){
				msg = change_lang_txt({"org_txt" : "請先計算"}) + ' - ' + args.m1 + "!";
			}else if(msg_code == 4){
				msg = change_lang_txt({"org_txt" : "此期數正在計算中"}) + "!";
			}
			break;
		case "kangPeriodAuditEditor":
			if(msg_code == -1){
				msg = change_lang_txt({"org_txt" : "執行成功"}) + "!";
			}else if(msg_code == 1){
				msg = change_lang_txt({"org_txt" : "操作失敗"}) + ' - ' + args.m1 + "!";
			}else if(msg_code == 2){
				msg = change_lang_txt({"org_txt" : "請先審核"}) + ' - ' + args.m1 + "!";
			}
			break;
		case "kangCusIP":
			if(msg_code == -2){
				msg = change_lang_txt({"org_txt" : "修改狀態成功"}) + "!";
			}else if(msg_code == 1){
				msg = change_lang_txt({"org_txt" : "操作失敗"}) + "!";
			}
			break;
		case "kangOnlineCus":
			if(msg_code == -1){
				msg = change_lang_txt({"org_txt" : "踢出成功"}) + "!";
			}else if(msg_code == 1){
				msg = change_lang_txt({"org_txt" : "操作失敗"}) + "!";
			}
			break;
		case "kangGameCategoryGain":
			if(msg_code == -1){
				msg = change_lang_txt({"org_txt" : "儲存成功"}) + "!";
			}else if(msg_code == -2){
				msg = change_lang_txt({"org_txt" : "獲取成功"}) + "!";
			}else if(msg_code == 1){
				msg = change_lang_txt({"org_txt" : "操作失敗"}) + "!";
			}else if(msg_code == 2){
				msg = change_lang_txt({"org_txt" : "獲取失敗"}) + "! " + change_lang_txt({"org_txt" : "錯誤代碼"}) + ":" + args.code;
			}
			break;
		case "kangCusRetreatSet":
			if(msg_code == -1){
				msg = change_lang_txt({"org_txt" : "修改成功"}) + "!";
			}else if(msg_code == -2){
				msg = change_lang_txt({"org_txt" : "儲存成功"}) + "!";
			}else if(msg_code == 1){
				msg = change_lang_txt({"org_txt" : "操作失敗"}) + "!";
			}else if(msg_code == 2){
				msg = change_lang_txt({"org_txt" : "稽核倍率需為正數"}) + "!";
			}
			break;
		case "kangCusRetreatAudit":
			if(msg_code == -1){
				msg = change_lang_txt({"org_txt" : "審核成功"}) + "!";
			}else if(msg_code == 1){
				msg = change_lang_txt({"org_txt" : "操作失敗"}) + "!";
			}else if(msg_code == 2){
				msg = change_lang_txt({"org_txt" : "請選擇審核狀態"}) + "!";
			}
			break;
		case "kangCusDiscountAudit":
			if(msg_code == -1){
				msg = change_lang_txt({"org_txt" : "審核成功"}) + "!";
			}else if(msg_code == 1){
				msg = change_lang_txt({"org_txt" : "操作失敗"}) + "!";
			}else if(msg_code == 2){
				msg = change_lang_txt({"org_txt" : "請選擇審核狀態"}) + "!";
			}
			break;
		case "kangCusInfoManager":
			if(msg_code == -1){
				msg = change_lang_txt({"org_txt" : "操作成功"}) + "!";
			}else if(msg_code == 1){
				msg = change_lang_txt({"org_txt" : "操作失敗"}) + "!";
			}
			break;
		case "kangCusInfoEditor":
			if(msg_code == -1){
				msg = change_lang_txt({"org_txt" : "新增成功"}) + "!";
			}else if(msg_code == -2){
				msg = args.m1 + '-' + change_lang_txt({"org_txt" : "修改成功"}) + "!";
			}else if(msg_code == -3){
				msg = change_lang_txt({"org_txt" : "新增銀行卡成功"}) + "!";
			}else if(msg_code == -4){
				msg = change_lang_txt({"org_txt" : "修改狀態成功"}) + "!";
			}else if(msg_code == -5){
				msg = change_lang_txt({"org_txt" : "刪除成功"}) + "!";
			}else if(msg_code == -6){
				msg = change_lang_txt({"org_txt" : "轉回主帳戶成功"}) + "!<br />" + change_lang_txt({"org_txt" : "除了"}) + "<br />";	//layer的話用br , alert 用/r/n
			}else if(msg_code == -7){
				msg = change_lang_txt({"org_txt" : "轉回主帳戶成功"}) + "!";
			}else if(msg_code == -8){
				msg = change_lang_txt({"org_txt" : "操作成功"}) + "!";
			}else if(msg_code == 1){
				msg = change_lang_txt({"org_txt" : "操作失敗"}) + "!";
			}else if(msg_code == 2){
				msg = change_lang_txt({"org_txt" : "帳號不能為空"}) + "!";
			}else if(msg_code == 3){
				msg = change_lang_txt({"org_txt" : "密碼不能為空"}) + "!";
			}else if(msg_code == 4){
				msg = change_lang_txt({"org_txt" : "密碼只能英文數字組合"}) + "!";
			}else if(msg_code == 5){
				msg = change_lang_txt({"org_txt" : "輸入密碼與確認密碼不一樣"}) + "!";
			}else if(msg_code == 6){
				msg = change_lang_txt({"org_txt" : "密碼長度需至少三位"}) + "!";				
			}else if(msg_code == 7){
				msg = change_lang_txt({"org_txt" : "名稱不能為空"}) + "!";				
			}else if(msg_code == 8){
				msg = change_lang_txt({"org_txt" : "狀態設定錯誤"}) + "!";
			}else if(msg_code == 9){
				msg = change_lang_txt({"org_txt" : "帳號只能英文數字組合"}) + "!";
			}else if(msg_code == 10){
				msg = change_lang_txt({"org_txt" : "額度類型錯誤"}) + "!";
			}else if(msg_code == 11){
				msg = change_lang_txt({"org_txt" : "此帳號已用過"}) + "!";
			}else if(msg_code == 12){
				msg = change_lang_txt({"org_txt" : "帳號不能為Z開頭"}) + "!";
			}else if(msg_code == 13){
				msg = change_lang_txt({"org_txt" : "帳號長度需至少兩位, 至多八位"}) + "!";
			}else if(msg_code == 16){
				msg = args.m1 + " - " + change_lang_txt({"org_txt" : "請至少選擇一種盤口"}) + "!";
			}else if(msg_code == 17){
				msg = args.m1 + " - " + change_lang_txt({"org_txt" : "會員只能選擇一種盤口"}) + "!";
			}else if(msg_code == 18){	//only cus
				msg = change_lang_txt({"org_txt" : "Email格式不正確"}) + "!";
			}else if(msg_code == 19){	//only cus
				msg = change_lang_txt({"org_txt" : "生日格式不正確"}) + "!";
			}else if(msg_code == 20){	//only cus
				msg = change_lang_txt({"org_txt" : "新增失敗"}) + "! " + change_lang_txt({"org_txt" : "會員銀行卡至多五張"}) + "!";
			}else if(msg_code == 21){
                msg = change_lang_txt({"org_txt" : "手機號碼已注冊過"}) + "!";    
            }else if(msg_code == 25){
				msg = change_lang_txt({"org_txt" : "限額設定需大於或等於0"}) + "!";
			}else if(msg_code == 29){
				msg = change_lang_txt({"org_txt" : "ZG電子"}) + " - " + change_lang_txt({"org_txt" : "單注最高超過上層設定"}) + "!";
			}else if(msg_code == 30){
				msg = change_lang_txt({"org_txt" : "歐博真人"}) + " - " + change_lang_txt({"org_txt" : "點數頂峰上限超過上層設定"}) + "!";
			}else if(msg_code == 31){
				msg = change_lang_txt({"org_txt" : "歐博真人"}) + " - " + args.m1 + " - " + change_lang_txt({"org_txt" : "至少選擇一個"}) + "!";
			}else if(msg_code == 32){
				msg = change_lang_txt({"org_txt" : "歐博真人"}) + " - " + args.m1 + " - " + change_lang_txt({"org_txt" : "會員至少選擇一個, 至多三個"}) + "!";
			}else if(msg_code == 33){
				msg = change_lang_txt({"org_txt" : "歐博真人"}) + " - " + args.m1 + " - " + change_lang_txt({"org_txt" : "會員只能選一個"}) + "!";
			}else if(msg_code == 34){
				msg = change_lang_txt({"org_txt" : "沙龍真人"}) + " - " + change_lang_txt({"org_txt" : "點數頂峰上限超過上層設定"}) + "!";
			}else if(msg_code == 35){
				msg = change_lang_txt({"org_txt" : "沙龍真人"}) + " - " + args.m1 + " - " + change_lang_txt({"org_txt" : "至少選擇兩個"}) + "!";
			}else if(msg_code == 36){
				msg = change_lang_txt({"org_txt" : "沙龍真人"}) + " - " + args.m1 + " - " + change_lang_txt({"org_txt" : "會員至少選擇二個, 至多五個"}) + "!";
			}else if(msg_code == 37){
				msg = change_lang_txt({"org_txt" : "WM真人"}) + " - " + args.m1 + " - " + change_lang_txt({"org_txt" : "超過上層設定"}) + "!";
			}else if(msg_code == 38){
				msg = change_lang_txt({"org_txt" : "WM真人"}) + " - " + args.m1 + " - " + change_lang_txt({"org_txt" : "至少選擇一個"}) + "!";
			}else if(msg_code == 39){
				msg = change_lang_txt({"org_txt" : "DG真人"}) + " - " + change_lang_txt({"org_txt" : "單日限贏金額超過上層設定定"}) + "!";
			}else if(msg_code == 40){
				msg = change_lang_txt({"org_txt" : "DG真人"}) + " - " + args.m1 + " - " + change_lang_txt({"org_txt" : "至少選擇一個"}) + "!";
			}else if(msg_code == 41){
				msg = change_lang_txt({"org_txt" : "DG真人"}) + " - " + args.m1 + " - " + change_lang_txt({"org_txt" : "會員只能選一個"}) + "!";
			}else if(msg_code == 47){
				msg = args.m1 + " - " + change_lang_txt({"org_txt" : "過關輸入錯誤"}) + "!";
			}else if(msg_code == 50){
				msg = change_lang_txt({"org_txt" : "OB真人"}) + " - " + args.m1 + " - " + change_lang_txt({"org_txt" : "至少選擇一個"}) + "!";
			}else if(msg_code == 51){
				msg = change_lang_txt({"org_txt" : "OB真人"}) + " - " + args.m1 + " - " + change_lang_txt({"org_txt" : "會員只能選一個"}) + "!";
			}else if(msg_code == 52){
				msg = change_lang_txt({"org_txt" : "皇家真人"}) + " - " + args.m1 + " - " + change_lang_txt({"org_txt" : "至少選擇一個"}) + "!";
			}else if(msg_code == 53){
				msg = change_lang_txt({"org_txt" : "皇家真人"}) + " - " + args.m1 + " - " + change_lang_txt({"org_txt" : "會員至少選擇一個, 至多三個"}) + "!";
			}else if(msg_code == 54){
				msg = change_lang_txt({"org_txt" : "皇家真人"}) + " - " + change_lang_txt({"org_txt" : "點數頂峰上限超過上層設定"}) + "!";
			}else if(msg_code == 55){
				msg = change_lang_txt({"org_txt" : "此帳號已被停押"}) + "! " +  change_lang_txt({"org_txt" : "請聯絡您的上層"}) + "!";
			}else if(msg_code == 56){
				msg = args.m1 + " - " + change_lang_txt({"org_txt" : "讀取點數錯誤"}) + "!(" + args.code + ")";
			}else if(msg_code == 57){
				msg = args.m1 + " - " + change_lang_txt({"org_txt" : "因剩餘額度大於限制"}) + "! " + change_lang_txt({"org_txt" : "目前無法進行點數提取"}) + "! " + change_lang_txt({"org_txt" : "請聯絡上層"}) + "!";
			}else if(msg_code == 58){
				msg = args.m1 + " - " + change_lang_txt({"org_txt" : "轉帳錯誤"}) + "!(" + args.code + ")";
			}else if(msg_code == 100){
				msg = change_lang_txt({"org_txt" : "請選擇開戶銀行"}) + "!";
			}else if(msg_code == 101){
				msg = change_lang_txt({"org_txt" : "請選擇開戶省"}) + "!";
			}else if(msg_code == 102){
				msg = change_lang_txt({"org_txt" : "請選擇開戶市"}) + "!";
			}else if(msg_code == 103){
				msg = change_lang_txt({"org_txt" : "請輸入銀行支行"}) + "!";
			}else if(msg_code == 104){
				msg = change_lang_txt({"org_txt" : "請輸入開戶姓名"}) + "!";
			}else if(msg_code == 105){
				msg = change_lang_txt({"org_txt" : "請輸入銀行帳號"}) + "!";
			}
			
			break;
		case "kangAgentInfoEditor":
			if(msg_code == -1){
				msg = change_lang_txt({"org_txt" : "新增成功"}) + "!";
			}else if(msg_code == -2){
				msg = args.m1 + " - " + change_lang_txt({"org_txt" : "修改成功"}) + "!";
			}else if(msg_code == -3){
				msg = change_lang_txt({"org_txt" : "新增銀行卡成功"}) + "!";
			}else if(msg_code == -4){
				msg = change_lang_txt({"org_txt" : "修改狀態成功"}) + "!";
			}else if(msg_code == -5){
				msg = change_lang_txt({"org_txt" : "刪除成功"}) + "!";
			}else if(msg_code == 1){
				msg = change_lang_txt({"org_txt" : "操作失敗"}) + "!";
			}else if(msg_code == 2){
				msg = change_lang_txt({"org_txt" : "帳號不能為空"}) + "!";
			}else if(msg_code == 3){
				msg = change_lang_txt({"org_txt" : "密碼不能為空"}) + "!";
			}else if(msg_code == 4){
				msg = change_lang_txt({"org_txt" : "密碼只能英文數字組合"}) + "!";
			}else if(msg_code == 5){
				msg = change_lang_txt({"org_txt" : "輸入密碼與確認密碼不一樣"}) + "!";
			}else if(msg_code == 6){
				msg = change_lang_txt({"org_txt" : "密碼長度需至少三位"}) + "!";				
			}else if(msg_code == 7){
				msg = change_lang_txt({"org_txt" : "名稱不能為空"}) + "!";				
			}else if(msg_code == 8){
				msg = change_lang_txt({"org_txt" : "狀態設定錯誤"}) + "!";
			}else if(msg_code == 9){
				msg = change_lang_txt({"org_txt" : "帳號只能英文數字組合"}) + "!";
			}else if(msg_code == 10){
				msg = change_lang_txt({"org_txt" : "額度類型錯誤"}) + "!";
			}else if(msg_code == 11){
				msg = change_lang_txt({"org_txt" : "此帳號已用過"}) + "!";
			}else if(msg_code == 12){
				msg = change_lang_txt({"org_txt" : "帳號不能為Z開頭"}) + "!";
			}else if(msg_code == 13){
				msg = change_lang_txt({"org_txt" : "帳號長度需至少兩位, 至多八位"}) + "!";
			}else if(msg_code == 14){	//only agent
				msg = change_lang_txt({"org_txt" : "帳號類型設定錯誤"}) + "!";
			}else if(msg_code == 15){
				msg = change_lang_txt({"org_txt" : "限額設定錯誤"}) + "!";
			}else if(msg_code == 16){
				msg = args.m1 + " - " + change_lang_txt({"org_txt" : "請至少選擇一種盤口"}) + "!";
			}else if(msg_code == 17){
				msg = args.m1 + " - " + change_lang_txt({"org_txt" : "會員只能選擇一種盤口"}) + "!";
			}else if(msg_code == 18){
				msg = args.m1 + " - " + change_lang_txt({"org_txt" : "佔成不可高於最大值"}) + "!";
			}else if(msg_code == 19){
				msg = args.m1 + " - " + change_lang_txt({"org_txt" : "佔水不可高於最大值"}) + "!";
			}else if(msg_code == 20){	//only cus
				msg = change_lang_txt({"org_txt" : "新增失敗"}) + "! " + change_lang_txt({"org_txt" : "會員銀行卡至多五張"}) + "!";
			}else if(msg_code == 21){	//only agent
				msg = change_lang_txt({"org_txt" : "金流手續費不可高於上層"}) + "!";
			}else if(msg_code == 23){
				msg = args.m1 + " - " + change_lang_txt({"org_txt" : "佔成設定需大於或等於0"}) + "!";
			}else if(msg_code == 24){
				msg = args.m1 + " - " + change_lang_txt({"org_txt" : "佔水設定需大於或等於0"}) + "!";
			}else if(msg_code == 25){
				msg = change_lang_txt({"org_txt" : "限額設定需大於或等於0"}) + "!";
			}else if(msg_code == 26){
				msg = change_lang_txt({"org_txt" : "佔成需為5的倍數"}) + "!";
			}else if(msg_code == 29){
				msg = change_lang_txt({"org_txt" : "ZG電子"}) + " - " + change_lang_txt({"org_txt" : "單注最高超過上層設定"}) + "!";
			}else if(msg_code == 30){
				msg = change_lang_txt({"org_txt" : "歐博真人"}) + " - " + change_lang_txt({"org_txt" : "點數頂峰上限超過上層設定"}) + "!";
			}else if(msg_code == 31){
				msg = change_lang_txt({"org_txt" : "歐博真人"}) + " - " + args.m1 + " - " + change_lang_txt({"org_txt" : "至少選擇一個"}) + "!";
			}else if(msg_code == 32){
				msg = change_lang_txt({"org_txt" : "歐博真人"}) + " - " + args.m1 + " - " + change_lang_txt({"org_txt" : "會員至少選擇一個, 至多三個"}) + "!";
			}else if(msg_code == 33){
				msg = change_lang_txt({"org_txt" : "歐博真人"}) + " - " + args.m1 + " - " + change_lang_txt({"org_txt" : "會員只能選一個"}) + "!";
			}else if(msg_code == 34){
				msg = change_lang_txt({"org_txt" : "沙龍真人"}) + " - " + change_lang_txt({"org_txt" : "點數頂峰上限超過上層設定"}) + "!";
			}else if(msg_code == 35){
				msg = change_lang_txt({"org_txt" : "沙龍真人"}) + " - " + args.m1 + " - " + change_lang_txt({"org_txt" : "至少選擇兩個"}) + "!";
			}else if(msg_code == 36){
				msg = change_lang_txt({"org_txt" : "沙龍真人"}) + " - " + args.m1 + " - " + change_lang_txt({"org_txt" : "會員至少選擇二個, 至多五個"}) + "!";
			}else if(msg_code == 37){
				msg = change_lang_txt({"org_txt" : "WM真人"}) + " - " + args.m1 + " - " + change_lang_txt({"org_txt" : "超過上層設定"}) + "!";
			}else if(msg_code == 38){
				msg = change_lang_txt({"org_txt" : "WM真人"}) + " - " + args.m1 + " - " + change_lang_txt({"org_txt" : "至少選擇一個"}) + "!";
			}else if(msg_code == 39){
				msg = change_lang_txt({"org_txt" : "DG真人"}) + " - " + change_lang_txt({"org_txt" : "單日限贏金額超過上層設定定"}) + "!";
			}else if(msg_code == 40){
				msg = change_lang_txt({"org_txt" : "DG真人"}) + " - " + args.m1 + " - " + change_lang_txt({"org_txt" : "至少選擇一個"}) + "!";
			}else if(msg_code == 41){
				msg = change_lang_txt({"org_txt" : "DG真人"}) + " - " + args.m1 + " - " + change_lang_txt({"org_txt" : "會員只能選一個"}) + "!";
			}else if(msg_code == 47){
				msg = args.m1 + " - " + change_lang_txt({"org_txt" : "過關輸入錯誤"}) + "!";
			}else if(msg_code == 50){
				msg = change_lang_txt({"org_txt" : "OB真人"}) + " - " + args.m1 + " - " + change_lang_txt({"org_txt" : "至少選擇一個"}) + "!";
			}else if(msg_code == 51){
				msg = change_lang_txt({"org_txt" : "OB真人"}) + " - " + args.m1 + " - " + change_lang_txt({"org_txt" : "會員只能選一個"}) + "!";
			}else if(msg_code == 52){
				msg = change_lang_txt({"org_txt" : "皇家真人"}) + " - " + args.m1 + " - " + change_lang_txt({"org_txt" : "至少選擇一個"}) + "!";
			}else if(msg_code == 53){
				msg = change_lang_txt({"org_txt" : "皇家真人"}) + " - " + args.m1 + " - " + change_lang_txt({"org_txt" : "會員至少選擇一個, 至多三個"}) + "!";
			}else if(msg_code == 54){
				msg = change_lang_txt({"org_txt" : "皇家真人"}) + " - " + change_lang_txt({"org_txt" : "點數頂峰上限超過上層設定"}) + "!";
			}else if(msg_code == 100){
				msg = change_lang_txt({"org_txt" : "請選擇開戶銀行"}) + "!";
			}else if(msg_code == 101){
				msg = change_lang_txt({"org_txt" : "請選擇開戶省"}) + "!";
			}else if(msg_code == 102){
				msg = change_lang_txt({"org_txt" : "請選擇開戶市"}) + "!";
			}else if(msg_code == 103){
				msg = change_lang_txt({"org_txt" : "請輸入銀行支行"}) + "!";
			}else if(msg_code == 104){
				msg = change_lang_txt({"org_txt" : "請輸入開戶姓名"}) + "!";
			}else if(msg_code == 105){
				msg = change_lang_txt({"org_txt" : "請輸入銀行帳號"}) + "!";
			}
			break;
		case "kangCusWithdrawAudit":
			if(msg_code == -1){
				msg = change_lang_txt({"org_txt" : "修改成功"}) + "!";
			}else if(msg_code == 1){
				msg = change_lang_txt({"org_txt" : "操作失敗"}) + "!";
			}
			break;
		case "kangCusWithdraw":
			if(msg_code == -1){
				msg = change_lang_txt({"org_txt" : "申請成功"}) + "!";
			}else if(msg_code == 1){
				msg = change_lang_txt({"org_txt" : "請輸入大於0的整數金額"}) + "!";
			}else if(msg_code == 2){
				msg = change_lang_txt({"org_txt" : "銀行卡錯誤"}) + "!";
			}else if(msg_code == 3){
				msg = change_lang_txt({"org_txt" : "取款金額低於最低取款"}) + "!";
			}else if(msg_code == 4){
				msg = change_lang_txt({"org_txt" : "取款金額高於最高取款"}) + "!";
			}else if(msg_code == 5){
				msg = change_lang_txt({"org_txt" : "當前尚有未處理完成的取款申請單, 無法重複申請"}) + "!";
			}else if(msg_code == 6){
				msg = change_lang_txt({"org_txt" : "今日已達取款次數上限"}) + "!";
			}else if(msg_code == 7){
				msg = change_lang_txt({"org_txt" : "實際取款金額需大於0"}) + "!";
			}else if(msg_code == 8){
				msg = change_lang_txt({"org_txt" : "主帳戶額度不足"}) + "!";
			}else if(msg_code == 9){
				msg = change_lang_txt({"org_txt" : "尚未完成打碼量"}) + "!";
			}else if(msg_code == 10){
				msg = change_lang_txt({"org_txt" : "無法取款"}) + "! " + change_lang_txt({"org_txt" : "請聯繫客服"}) + "!";
			}else if(msg_code == 11){
				msg = change_lang_txt({"org_txt" : "請先至個人資料驗證身分"}) + "!<br/><a class=\"turn-page-btn\" onclick=\"parent.location.href='personal_info';\">" + change_lang_txt({"org_txt" : "點我跳轉"}) + "</a>";
			}else if(msg_code == 12){
				msg = change_lang_txt({"org_txt" : "請先至少綁定一張已驗證的銀行卡"}) + "!<br/><a class=\"turn-page-btn\" onclick=\"parent.location.href='cus_bank_info';\">" + change_lang_txt({"org_txt" : "點我跳轉"}) + "</a>";
			}
			break;
		case "kangMarquee":
			if(msg_code == -1 || msg_code == -2){
				msg = change_lang_txt({"org_txt" : "儲存成功"}) + "!";
			}else if(msg_code == -3){
				msg = change_lang_txt({"org_txt" : "刪除成功"}) + "!";
			}else if(msg_code == 1){
				msg = change_lang_txt({"org_txt" : "操作失敗"}) + "!";
			}else if(msg_code == 2){
				msg = change_lang_txt({"org_txt" : "請輸入跑馬燈內容"}) + "!";
			}else if(msg_code == 3){
				msg = change_lang_txt({"org_txt" : "請選擇跑馬燈對象"}) + "!";
			}
			break;
		case "kangEmployeeEditor":
			if(msg_code == -1 || msg_code == -2){
				msg = change_lang_txt({"org_txt" : "儲存成功"}) + "!";
			}else if(msg_code == -3){
				msg = change_lang_txt({"org_txt" : "刪除成功"}) + "!";
			}else if(msg_code == 1){
				msg = change_lang_txt({"org_txt" : "操作失敗"}) + "!";
			}else if(msg_code == 2){
				msg = change_lang_txt({"org_txt" : "帳號不能為空"}) + "!";
			}else if(msg_code == 3){
				msg = change_lang_txt({"org_txt" : "密碼不能為空"}) + "!";
			}else if(msg_code == 4){
				msg = change_lang_txt({"org_txt" : "帳號長度需至少2位, 至多20位"}) + "!";
			}else if(msg_code == 5){
				msg = change_lang_txt({"org_txt" : "密碼長度需至少三位"}) + "!";				
			}else if(msg_code == 6){
				msg = change_lang_txt({"org_txt" : "名稱不能為空"}) + "!";				
			}else if(msg_code == 7){
				msg = change_lang_txt({"org_txt" : "狀態設定錯誤"}) + "!";
			}else if(msg_code == 8){
				msg = change_lang_txt({"org_txt" : "此帳號已用過"}) + "!";
			}
			break;
		case "kangDiscountManager":
			if(msg_code == -3){
				msg = change_lang_txt({"org_txt" : "刪除成功"}) + "!";
			}else if(msg_code == 1){
				msg = change_lang_txt({"org_txt" : "操作失敗"}) + "!";
			}
			break;
		case "kangDiscountEditor":
			if(msg_code == -1 || msg_code == -2){
				msg = change_lang_txt({"org_txt" : "儲存成功"}) + "!";
			}else if(msg_code == 1){
				msg = change_lang_txt({"org_txt" : "操作失敗"}) + "!";
			}else if(msg_code == 2){
				msg = change_lang_txt({"org_txt" : "請輸入優惠標題"}) + "!";
			}else if(msg_code == 3){
				msg = change_lang_txt({"org_txt" : "請上傳優惠文案圖片"}) + "!";
			}else if(msg_code == 4){
				msg = change_lang_txt({"org_txt" : "請輸入優惠文案內容"}) + "!";
			}else if(msg_code == 5){
				msg = change_lang_txt({"org_txt" : "請輸入優惠分類"}) + "!";
			}else if(msg_code == 6){
				msg = change_lang_txt({"org_txt" : "請選擇發放方式"}) + "!";
			}else if(msg_code == 7){
				msg = change_lang_txt({"org_txt" : "請選擇參與類型"}) + "!";
			}else if(msg_code == 8){
				msg = change_lang_txt({"org_txt" : "請輸入指定代理帳號"}) + "!";
			}else if(msg_code == 9){
				msg = change_lang_txt({"org_txt" : "請勾選指定的會員等級"}) + "!";
			}else if(msg_code == 10){
				msg = change_lang_txt({"org_txt" : "每日首存最小金額需大於或等於0"}) + "!";
			}else if(msg_code == 11){
				msg = change_lang_txt({"org_txt" : "連續存款天數需大於或等於0"}) + "!";
			}else if(msg_code == 12){
				msg = change_lang_txt({"org_txt" : "優惠金額需大於或等於0"}) + "!";
			}else if(msg_code == 13){
				msg = change_lang_txt({"org_txt" : "請選擇領取限制"}) + "!";
			}else if(msg_code == 14){
				msg = change_lang_txt({"org_txt" : "請輸入限定次數"}) + "!";
			}else if(msg_code == 15){
				msg = change_lang_txt({"org_txt" : "請選擇稽核類型"}) + "!";
			}else if(msg_code == 16){
				msg = change_lang_txt({"org_txt" : "請輸入稽核倍率"}) + "!";
			}else if(msg_code == 17){
				msg = change_lang_txt({"org_txt" : "請輸入固定稽核量"}) + "!";
			}else if(msg_code == 18){
				msg = change_lang_txt({"org_txt" : "請選擇重置類型"}) + "!";
			}else if(msg_code == 19){
				msg = change_lang_txt({"org_txt" : "請輸入排除代理帳號"}) + "!";
			}else if(msg_code == 20){
				msg = change_lang_txt({"org_txt" : "存款百分比需大於或等於0"}) + "!";
			}else if(msg_code == 21){
				msg = change_lang_txt({"org_txt" : "請選擇優惠金額類型"}) + "!";
			}else if(msg_code == 22){
				msg = change_lang_txt({"org_txt" : "請輸入優惠金額上限"}) + "!";
			}
            
			break;
		case "kangPaymentMerchantManager":
		case "kangPaymentCompanyManager":
			if(msg_code == -1){
				msg = change_lang_txt({"org_txt" : "操作成功"}) + "!";
			}
			else if(msg_code == 1){
				msg = change_lang_txt({"org_txt" : "操作失敗"}) + "!";
			}
			break;
		case "kangPaymentMerchantEditor":
		case "kangPaymentCompanyEditor":
			if(msg_code == -1 || msg_code == -2){
				msg = change_lang_txt({"org_txt" : "儲存成功"}) + "!";
			}
			else if(msg_code == 1){
				msg = change_lang_txt({"org_txt" : "操作失敗"}) + "!";
			}
			else if(msg_code == 2){
				msg = change_lang_txt({"org_txt" : "請輸入商戶名稱"}) + "!";
			}
			else if(msg_code == 3){
				msg = change_lang_txt({"org_txt" : "請輸入額外描述"}) + "!";
			}
			else if(msg_code == 4){
				msg = change_lang_txt({"org_txt" : "請輸入網頁顯示名稱"}) + "!";
			}
			else if(msg_code == 5){
				msg = change_lang_txt({"org_txt" : "請輸入最低額度"}) + "!";
			}
			else if(msg_code == 6){
				msg = change_lang_txt({"org_txt" : "最低額度數值不可低於0"}) + "!";
			}
			else if(msg_code == 7){
				msg = change_lang_txt({"org_txt" : "請輸入最高額度"}) + "!";
			}
			else if(msg_code == 8){
				msg = change_lang_txt({"org_txt" : "最高額度數值不可低於0"}) + "!";
			}
			else if(msg_code == 9){
				msg = change_lang_txt({"org_txt" : "請輸入會員手續費"}) + "!";
			}
			else if(msg_code == 10){
				msg = change_lang_txt({"org_txt" : "會員手續費數值不可低於0"}) + "!";
			}
			else if(msg_code == 11){
				msg = change_lang_txt({"org_txt" : "請輸入會員固定手續費"}) + "!";
			}
			else if(msg_code == 12){
				msg = change_lang_txt({"org_txt" : "會員固定手續費數值不可低於0"}) + "!";
			}
			else if(msg_code == 13){
				msg = change_lang_txt({"org_txt" : "請選擇會員手續費類型"}) + "!";
			}
			else if(msg_code == 14){
				msg = change_lang_txt({"org_txt" : "請輸入額度上限"}) + "!";
			}
			else if(msg_code == 15){
				msg = change_lang_txt({"org_txt" : "額度上限數值不可低於0"}) + "!";
			}
			else if(msg_code == 16){
				msg = change_lang_txt({"org_txt" : "請輸入排序數值"}) + "!";
			}
			/*else if(msg_code == 17){
				msg = change_lang_txt({"org_txt" : "排序數值不可低於0"}) + "!";
			}*/
			else if(msg_code == 18){
				msg = change_lang_txt({"org_txt" : "請輸入開戶銀行"}) + "!";
			}
			else if(msg_code == 19){
				msg = change_lang_txt({"org_txt" : "請輸入開戶支行"}) + "!";
			}
			else if(msg_code == 20){
				msg = change_lang_txt({"org_txt" : "請輸入開戶姓名"}) + "!";
			}
			else if(msg_code == 21){
				msg = change_lang_txt({"org_txt" : "請輸入銀行卡號"}) + "!";
			}
			break;
		case "kangChangeOrderLogs":
			if(msg_code == -1){
				msg = change_lang_txt({"org_txt" : "操作成功"}) + "!";
			}
			else if(msg_code == 1){
				msg = change_lang_txt({"org_txt" : "操作失敗"}) + "!";
			}
			break;
		case "kangCusBankInfoManager":
			if(msg_code == -1){
				msg = change_lang_txt({"org_txt" : "操作成功"}) + "!";
			}else if(msg_code == 1){
				msg = change_lang_txt({"org_txt" : "操作失敗"}) + "!";
			}
			break;	
		//=====================================
		/*case "kangCusInfoEditor":
			else if(msg_code == -1){
				msg = "轉帳成功!";
			}else if(msg_code == 16){
				msg = "請選擇轉出帳戶!";
			}else if(msg_code == 17){
				msg = "請選擇轉入帳戶!";
			}else if(msg_code == 18){
				msg = "無法同帳戶轉帳!";
			}else if(msg_code == 19){
				msg = "請輸入正確的轉帳金額!";
			}else if(msg_code == 21){
				msg = "轉帳錯誤, 主帳戶點數額度不足";
			}
			break;*/
		/*case "kangActivityCategory":
			if(msg_code == -1 || msg_code == -2){
				msg = change_lang_txt({"org_txt" : "儲存成功"}) + "!";
			}else if(msg_code == -3){
				msg = change_lang_txt({"org_txt" : "刪除成功"}) + "!";
			}else if(msg_code == 1){
				msg = change_lang_txt({"org_txt" : "操作失敗"}) + "!";
			}else if(msg_code == 2){
				msg = change_lang_txt({"org_txt" : "請輸入活動分類名稱"}) + "!";
			}else if(msg_code == 3){
				msg = change_lang_txt({"org_txt" : "已有活動文案套用此分類, 無法刪除"}) + "!";
			}
			break;
		case "kangActivityDetail":
			if(msg_code == -1 || msg_code == -2){
				msg = change_lang_txt({"org_txt" : "儲存成功"}) + "!";
			}else if(msg_code == -3){
				msg = change_lang_txt({"org_txt" : "刪除成功"}) + "!";
			}else if(msg_code == 1){
				msg = change_lang_txt({"org_txt" : "操作失敗"}) + "!";
			}else if(msg_code == 2){
				msg = change_lang_txt({"org_txt" : "請輸入活動文案名稱"}) + "!";
			}else if(msg_code == 3){
				msg = change_lang_txt({"org_txt" : "請選擇分站"}) + "!";
			}else if(msg_code == 4){
				msg = change_lang_txt({"org_txt" : "請選擇活動分類"}) + "!";
			}
			break;
		case "kangCusGroup":
			if(msg_code == -1 || msg_code == -2){
				msg = change_lang_txt({"org_txt" : "儲存成功"}) + "!";
			}else if(msg_code == -3){
				msg = change_lang_txt({"org_txt" : "刪除成功"}) + "!";
			}else if(msg_code == -4){
				msg = change_lang_txt({"org_txt" : "設置默認成功"}) + "!";
			}else if(msg_code == 1){
				msg = change_lang_txt({"org_txt" : "操作失敗"}) + "!";
			}else if(msg_code == 2){
				msg = change_lang_txt({"org_txt" : "請輸入分組名稱"}) + "!";
			}else if(msg_code == 3){
				msg = change_lang_txt({"org_txt" : "默認分組, 無法刪除"}) + "!";
			}
			break;
		case "kangCusMsgBoard":
			if(msg_code == -1 || msg_code == -2){
				msg = change_lang_txt({"org_txt" : "儲存成功"}) + "!";
			}else if(msg_code == -3){
				msg = change_lang_txt({"org_txt" : "刪除成功"}) + "!";
			}else if(msg_code == 1){
				msg = change_lang_txt({"org_txt" : "操作失敗"}) + "!";
			}else if(msg_code == 2){
				msg = change_lang_txt({"org_txt" : "請輸入回覆內容"}) + "!";
			}
			break;
		case "kangSysConfig":
			if(msg_code == -1 || msg_code == -2){
				msg = change_lang_txt({"org_txt" : "儲存成功"}) + "!";
			}else if(msg_code == 1){
				msg = change_lang_txt({"org_txt" : "操作失敗"}) + "!";
			}
			break;*/
		case "kangSysFuncSet":
			if(msg_code == -1){
				msg = change_lang_txt({"org_txt" : "儲存成功"}) + "!";
			}else if(msg_code == 1){
				msg = change_lang_txt({"org_txt" : "操作失敗"}) + "!";
			}
			break;
		case "kangSysServiceSet":
			if(msg_code == -1){
				msg = change_lang_txt({"org_txt" : "儲存成功"}) + "!";
			}else if(msg_code == 1){
				msg = change_lang_txt({"org_txt" : "操作失敗"}) + "!";
			}
			break;
		case "kangSubCustomer":
			if(msg_code == -1){
				msg = change_lang_txt({"org_txt" : "更新成功"}) + "!";
			}else if(msg_code == -2){
				msg = change_lang_txt({"org_txt" : "刪除成功"}) + "!";
			}else if(msg_code == -3){
				msg = change_lang_txt({"org_txt" : "新增成功"}) + "!";
			}else if(msg_code == 1){
				msg = change_lang_txt({"org_txt" : "更新失敗"}) + "!";
			}else if(msg_code == 2){
				msg = change_lang_txt({"org_txt" : "密碼長度需至少三位"}) + "!";
			}else if(msg_code == 3){
				msg = change_lang_txt({"org_txt" : "刪除失敗"}) + "!";
			}else if(msg_code == 4){
				msg = change_lang_txt({"org_txt" : "密碼只能英文數字組合"}) + "!";
			}else if(msg_code == 5){
				msg = change_lang_txt({"org_txt" : "至少選擇一個權限"}) + "!";
			}else if(msg_code == 6){
				msg = change_lang_txt({"org_txt" : "帳號只能英文數字組合"}) + "!";
			}else if(msg_code == 7){
				msg = change_lang_txt({"org_txt" : "帳號須至少填入三位"}) + "!";
			}else if(msg_code == 8){
				msg = change_lang_txt({"org_txt" : "名稱不能為空"}) + "!";
			}else if(msg_code == 9){
				msg = change_lang_txt({"org_txt" : "該帳號已被用過"}) + "!";
			}
			break;
		case "kangPersonalInfo":
			if(msg_code == -1){
				msg = change_lang_txt({"org_txt" : "密碼修改成功"}) + "!";
			}else if(msg_code == 1){
				msg = change_lang_txt({"org_txt" : "請輸入密碼"}) + "!";
			}else if(msg_code == 2){
				msg = change_lang_txt({"org_txt" : "密碼只能英文數字組合"}) + "!";
			}else if(msg_code == 3){
				msg = change_lang_txt({"org_txt" : "新密碼與確認密碼不一致"}) + "!";
			}else if(msg_code == 4){
				msg = change_lang_txt({"org_txt" : "密碼長度需至少三位"}) + "!";
			}else if(msg_code == 5){
				msg = change_lang_txt({"org_txt" : "舊密碼不符合"}) + "!";
			}
			break;
		default:
			msg = change_lang_txt({"org_txt" : "未知錯誤"}) + "!";
	} 
	return msg;
}