
<!DOCTYPE html><!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]--><!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]--><!--[if !IE]><!--><html lang="en" class="no-js">	<!--<![endif]-->	<!-- BEGIN HEAD -->	<head>        <meta charset="utf-8"/>        <meta http-equiv="X-UA-Compatible" content="IE=edge">        <!--<meta content="width=device-width, initial-scale=1" name="viewport"/>-->        <meta content="" name="description"/>        <meta content="" name="keywords"/>        <meta content="" name="author"/>        <title>控端</title>        <!-- BEGIN PAGE TOP STYLES -->        <!-- END PAGE TOP STYLES -->        <!-- BEGIN GLOBAL MANDATORY STYLES -->        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />        <!-- END GLOBAL MANDATORY STYLES -->        <!-- BEGIN PAGE LEVEL PLUGINS -->        <link href="/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />        <!-- END PAGE LEVEL PLUGINS -->        <!-- BEGIN THEME GLOBAL STYLES -->        <link href="/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />        <link href="/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />        <!-- END THEME GLOBAL STYLES -->        <!-- BEGIN THEME LAYOUT STYLES -->        <link href="/assets/layouts/layout/css/self-layout.css" rel="stylesheet" type="text/css" />        <link href="/assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />        <link href="/assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />        <!-- END THEME LAYOUT STYLES -->        <link href="/templates/css/style.css?cache=209" rel="stylesheet" type="text/css"/>		<link href="/templates/css/tw_style.css?cache=205" rel="stylesheet" type="text/css"/>                <!-- BEGIN PAGE FIRST SCRIPTS -->        <script src="/assets/global/plugins/jquery.min.js" type="text/javascript"></script>        <!-- END PAGE FIRST SCRIPTS -->        <link rel="shortcut icon" href="#"/>	</head>	<!-- END HEAD -->	<body>       <div class="page-inner-content">
	<!--slot=0-->
<style>
.page-bar .act-group{
	/*float:left;*/
	margin-right:10px;
}
	
.portlet.light.bordered 
{
	margin-top:0px;
}
.portlet-body 
{
	padding-top:0px !important;
	display: block;
} 
#manager_table_wrapper > div:first-child{
	display:none;
}
th
{
	text-align: center;
}
#manager_table td{
	vertical-align: middle;
}
#page-content-mask{
	background-color: #CCC;
    position: fixed;
    width: 100%;
    height: 100%;
    opacity: 0.5;
	display: none;
}
	
	/***/
.ml-10{
	margin-left:10px !important;
}
.ml-20{
	margin-left:20px !important;
}
.mt-10{
	margin-top:10px;
}
.mt-20{
	margin-top:20px;
}
label{
	margin-bottom:0px;
}
.bg-color1{
	background-color:#c3e6fa;
}
.bg-color2{
	background-color:#9dddde;
}
.txt-color1{
	color:red;
}
.game_before {
    background: rgba(180, 230, 200, 0.5);
}
.game_now {
    background: #fce6d8;
}
/*.type-btn-div{
	border-top: 2px solid #cecece;
    margin-top: 8px;
    padding-top: 8px;
}*/
.type-btn1{
	color: #222;
    background-color: #fff;
    /*border-color: #dab10d;*/
	display: inline-block;
    margin-bottom: 0;
    font-weight: 400;
    text-align: center;
    touch-action: manipulation;
    cursor: pointer;
    border: 1px solid transparent;
    white-space: nowrap;
    padding: 0px 12px;
    font-size: 14px;
	line-height: 30px;
	border: 2px solid #F1C40F;
}
.type-btn1.active{
	color: #fff;
    background-color: #F1C40F;
}
.data-content{
	padding-top:10px;
}
.data-content .top-area{
	padding: 8px 0px 8px 12px;
    background-color: #fce4e6;
}
.basic-info-tb td{
	vertical-align:middle!important;
}
.basic-info-tb td.title{
	text-align:right;
	font-weight:bold;
	white-space:nowrap;
}
.gstore100-cus2opt-tb td{
	padding:10px;
}
.gstore100-cus2opt-tb td.title1{
	font-weight:bold;
	padding:5px 10px;
	
}
.gstore100-cus2opt-tb td.title2{
	background-color: #c3e6fa;
	font-weight:bold;
	text-align:right;
}
.gstore100-cus2opt-tb .ocpy-div-1{
	float:left;
}
.gstore100-cus2opt-tb .ocpy-div-2{
	float:left;
	margin-left:7px;
	position:relative;
	top:22px;
}
.gstore100-cus2opt-tb .ocpy-div-3{
	float:left;
	margin-left:11px;
}
.temp-waiting{
	top: 200px; 
	width: 300px;
}
.tabbable-line>.nav-tabs {
    padding: 8px 5px;
    border-radius: 27px !important;
    background-color: #f4fcfd;
    border: 3px solid #bcecf1;
}
.tabbable-line>.nav-tabs>li.active, .tabbable-line>.nav-tabs>li:hover {
    border-radius: 22px !important;
    background-color: #28adb9;
    border-bottom: 0;
}
.tabbable-line>.nav-tabs>li>a {
    color: #000;
    font-size: 16px;
    font-weight: bold;
}
.tabbable-line>.nav-tabs>li.active>a, .tabbable-line>.nav-tabs>li:hover>a {
    color: #FFF;
}
.tabbable-line>.tab-content {
    border-top: 0;
}
.error-span{
	background-color: #fbe1e3;
    border-color: #fbe1e3;
    color: #e73d4a;
}
.top-max-span{
    border-color: rgba(249, 228, 145, 0.5)!important;
    background-color: rgba(249, 228, 145, 0.5)!important;
    color: #6d5806!important;
}
.tab-content{
	padding:10px 0px!important;
}
	
.font-b{
	font-weight:bold;
}
#game-status-table{
}
#game-status-table td, .game-occupy-table td{
	padding: 10px;
	border: 1px solid #000;
}
#game-status-table td:nth-child(1){
	background-color: #c3e6fa;
	font-weight: bold;
}
.tool{
	float: right;
    display: inline-block;
	padding:14px;
}
.tool > a.expand{
	background-image :url(/assets/global/img/portlet-expand-icon.png);
}
.tool > a.collapse{
	background-image :url(/assets/global/img/portlet-collapse-icon.png);
}
.tool > a {
	width:14px;
    display: inline-block;
    height: 16px;
}
.portlet-title .caption{
	display: inline-block;
}
.info_log .add{
	color: green;
}
.info_log .minus{
	color: red;
}
.info_log .td-r{
	text-align: right;
}

/* balanceCss */
#wallet-info-area .total, #wallet-info-area .main-account, #wallet-info-area .update, #wallet-info-area .return-btn{
      font-size: 24px;
        font-weight: bold;
      display: inline-block;
    }
      
    #wallet-info-area .update, #wallet-info-area .return-btn {
      background-color: #54acad;
        cursor: pointer;
        border-radius: 3px !important;
        text-align: center;
        padding: 10px;
      color: #FFF;
    }
    #wallet-info-area .warning-txt{
      color: red;
    }
    .mr-l-50{
      margin-left: 50px !important;
    }
    .info-main{
      padding: 20px;
    }
    .game-store-table{
      margin-top: 15px;
      width: 100%;
    }
    .game-store-table td, .game-store-table th{
      border: 1px solid #eee;
      padding: 5px;
    }
</style>
<div class="page-bar">
	<div class="act-group" id="top-save-btn-area">
		<button class="btn btn-danger" type="button" onclick="save_customer('basic-info')">儲存基本資料</button>
    </div>
    <div class="act-group">
		<button class="btn green-sharp btn-large " onclick="parent.goIframeHistoryBack(this, event);"> <i class="fa fa-mail-reply"></i> <font class="">回上頁</font> </button>
    </div>
    <div>
    	<div class="type-btn-div">
        	<span class="">會員帳號:&nbsp;<?=$user->username?>&nbsp;&nbsp;</span>
            
            <?php if ($btn_type == 'basic-info-area' && $etype =='add') { ?>
              <button class="type-btn1 <?=$btn_type=='basic-info-area'?'active':''?>" type="button" onClick="show_data_content(this, 'basic-info-area');">詳細資料</button>
            <?php } else { ?>
              <button class="type-btn1 <?=$btn_type=='basic-info-area'?'active':''?>" type="button" onClick="show_data_content(this, 'basic-info-area');">詳細資料</button>
              <button class="type-btn1 <?=$btn_type=='wallet-info-area'?'active':''?>" type="button" btn-type="wallet-info-area" onClick="reload_quota();show_data_content(this, 'wallet-info-area');">第三方帳號及錢包餘額</button>
              <!--button class="type-btn1 <?=$btn_type=='bank-info-area'?'active':''?>" type="button" onclick="show_data_content(this, 'bank-info-area');">銀行信息</button-->
              <button class="type-btn1 " type="button" onClick="show_data_content(this, 'open-game-info-area');">開放遊戲設定</button>
              <!--button class="type-btn1  " type="button" onclick="show_data_content(this, 'gstore-group1-area');">體育設定</button>
              <button class="type-btn1  " type="button" onclick="show_data_content(this, 'gstore-group2-area');">彩票設定</button>
              <button class="type-btn1  " type="button" onclick="show_data_content(this, 'gstore-group3-area');">真人設定</button>
              <button class="type-btn1  " type="button" onclick="show_data_content(this, 'gstore-group4-area');">電子設定</button>
              <button class="type-btn1  " type="button" onclick="show_data_content(this, 'gstore-group6-area');">電競設定</button-->
            <?php } ?>
		      	
        </div>
    </div>                  
</div>
<div id="page-content-mask"><img class="temp-waiting" src="/templates/images/loading.svg"></div>
<div id="basic-info-area" class="data-content <?=$btn_type=='basic-info-area'?'':'hidden'?>">
    <!--slot=1-->
  <div class="hidden save-btn"><button class="btn btn-danger" type="button" onclick="save_customer('basic-info')">儲存基本資料</button></div>
  <form>
      <div class="portlet light bordered">
        <div class="portlet-body" >
          <!--slot=2-->
          <table class="table table-bordered basic-info-tb">
            <tbody>
              <tr>
                <td class="title">身份</td>
                <td>
                  <div>
                    <select name="role" class="form-control input-inline">
                      <option value="customer" <?= $user->role == 'customer' ? 'selected' : '' ?>>會員</option>
                      <?php if ($etype == 'edit') { ?>
                        <option value="agent" <?= $user->role == 'agent' ? 'selected' : '' ?>>代理</option>
                      <?php } ?>
                    </select>
                  </div>
                </td>
              </tr>
              <tr>             
                <td class="title">會員帳號</td>
                <td ><input name="customer_userid" type="text" value="<?=e($user->username)?>" size="12" <?= $etype == 'edit' ? 'disabled': ''?>></td>
              </tr>
              <tr>
                <td class="title">會員密碼</td>
                <td><input type="password" size="12" name="customer_pass1" id="customer_pass1" value=""></td>
              </tr>
              <tr>
                <td class="title">確認密碼</td>
                <td><input type="password" size="12" name ="customer_pass2" id="customer_pass2" value=""></td>
              </tr>
              <tr>
                <td class="title">會員名稱</td>
                <td><input type="text" size="12" name ="customer_name" value="<?=e($user->nickname)?>"></td>
              </tr>
            <tr>
                <td class="title">標籤設定</td>
                <td>
                  <div>
                <select name="mark_id" class="form-control input-inline">
                  <option value="0">請選擇</option>
                  <!--slot=4-->
                          <?php foreach ($cusMarks as $item) {?>
                              <option value="<?= $item->id ?>" <?= $user->cus_mark_id == $item->id ? 'selected': ''?>> <?= $item->name?></option>
                          <?php }?>

                </select>
                  </div>
                </td>
              </tr>
            <tr>
                <td class="title">狀態設定</td>
                <td>
                  <div class="">
                  <select name="customer_status" class="form-control input-inline">
                      <!--slot=4-->

                      <option  value="1" <?= $user->valid == 1 ? 'selected': ''?>> 啟用</option>

                      <option  value="2" <?= $user->valid == 2 ? 'selected': ''?>> 停押</option>

                      <option  value="3" <?= $user->valid == 3 ? 'selected': ''?>> 鎖定</option>

                      <option  value="4" <?= $user->valid == 4 ? 'selected': ''?>> 停用</option>
                      <option  value="5" <?= $user->valid == 5 ? 'selected': ''?>> 鎖定錢包</option>

                  </select>&nbsp;<font class="color-red1">[停押]: 全線停押，但可登入&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[停用]: 全線停用，且不可登入&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[鎖定]: 只鎖定該帳號不可登入，其他下線正常</font>
                  </div>
                  <div class="hidden"><input type="hidden" name="" value="1"></div>
                </td>
              </tr>
            <tr>
                <td class="title">生日</td>
                <td><input type="text" size="12" name ="birthday" value="<?=e($user->birthday)?>">&nbsp;<font class="color-red1">(生日格式為YYYY-MM-DD，例：1911-01-01)</font></td>
              </tr>
            <tr>
                <td class="title">手機</td>
                <td><input type="text" size="12" name ="cell_phone" value="<?=e($user->mobile)?>"></td>
              </tr>
            <tr>
                <td class="title">信箱</td>
                <td><input type="text" size="12" name ="email" value="<?=e($user->email)?>"></td>
              </tr>
              <tr>
                <td class="title">Line</td>
                <td><input type="text" size="12" name ="line" value="<?=e($user->line_id)?>"></td>
              </tr>
              <tr>
                <td class="title">Telegram</td>
                <td><input type="text" size="12" name ="telegram" value="<?=e($user->telegram)?>"></td>
              </tr>
              <tr>
                <td class="title">Instagram</td>
                <td><input type="text" size="12" name ="instagram" value="<?=e($user->instagram)?>"></td>
              </tr>
              <tr>
                <td class="title">QQ</td>
                <td><input type="text" size="12" name ="qq" value="<?=e($user->qq)?>"></td>
              </tr>
            <tr>
                <td class="title">微信</td>
                <td><input type="text" size="12" name ="wechat" value="<?=e($user->wechat)?>"></td>
              </tr>
            <tr class="">
                <td class="title">邀請碼</td>
                <td><input type="text" size="12" name ="invite_code" value="<?=e($user->invite_code)?>" disabled="disabled"></td>
              </tr>
              <tr>
                <td class="title">備註</td>
                <td><textarea name="notes" cols="80"><?=e($user->note)?></textarea></td>
              </tr>
              <tr class="">
                <td class="title">建立/修改時間</td>
                <td>建立: <?=e($user->created_at)?><br> 修改: <?=e($user->updated_at)?></td>
              </tr>
              <tr class="">
                  <td class="title">最後登入</td>
                <?php if ($user->lgtime == 0) { ?>
                  <td>尚未登入</td>
                <?php } else { ?>
                  <td>時間: <?= date('Y-m-d H:i:s', $user->lgtime)?><br>IP: <?= $user->lgip?></td>
                <?php } ?>
              </tr>
            </tbody>
          </table>

        </div>
      </div>
  </form>    

</div>
<div id="wallet-info-area" class="data-content <?=$btn_type=='wallet-info-area'?'':'hidden'?>"><!--slot=3-->
  <style>
  #wallet-info-area .total, #wallet-info-area .main-account, #wallet-info-area .update, #wallet-info-area .return-btn{
    font-size: 24px;
      font-weight: bold;
    display: inline-block;
  }
    
  #wallet-info-area .update, #wallet-info-area .return-btn {
    background-color: #54acad;
      cursor: pointer;
      border-radius: 3px !important;
      text-align: center;
      padding: 10px;
    color: #FFF;
  }
  #wallet-info-area .warning-txt{
    color: red;
  }
  .mr-l-50{
    margin-left: 50px !important;
  }
  .info-main{
    padding: 20px;
  }
  .game-store-table{
    margin-top: 15px;
    width: 100%;
  }
  .game-store-table td, .game-store-table th{
    border: 1px solid #eee;
    padding: 5px;
  }
  </style>
  <div class="info-main">
    <div class="info-bar">
      <div class="total">
        <span>總餘額：</span>
        <span class="quota total-quota" id="total-quota" status="0">0</span>
      </div>
      <div class="main-account mr-l-50">
        <span>主帳戶：</span>
        <span id="main-quota" class="quota" status="1">0</span>
      </div>
      <div class="update mr-l-50" onclick="reload_quota();">更新</div>
      <div class="return-btn mr-l-50" onclick="return_to_main_account(0);">取回</div>
    </div>
    <table id="game-store-table" class="game-store-table">
    <tbody>
      <tr class="bg-green1 color-white">
        <th>第三方遊戲</th>
        <th>第三方帳號</th>
        <th>平台餘額</th></tr>
      <?php 
      //echo json_encode($games);
      foreach($games as $game){?>
      <tr>
        <td><?=$game->name?></td>
        <td>
          <div class="gstore-cus-userid" gstore="<?=$game->id?>" id="gstore-<?=$game->id?>-cus-userid"><?=count($game->gameUser) > 0?$game->gameUser[0]->game_username:e('loading')?></div></td>
        <td>
          <div class="gstore-quota quota" gstore="<?=$game->id?>" id="gstore-<?=$game->id?>-quota" status="1">0</div></td>
      </tr>
      <?php } ?>
      
    </tbody>
  </table>
  </div>
</div> 

<div id="bank-info-area" class="data-content <?=$btn_type=='bank-info-area'?'':'hidden'?>"><!--slot=5-->
  <style>
  .info-main{
    padding: 20px;
  }
  .bank-info-table{
    margin-top: 15px;
    width: 100%;
  }
  .bank-info-table td, .bank-info-table th{
    border: 1px solid #eee;
    padding: 5px;
    text-align: center;
  }
  .bank-info-table .status-btn {
      display: inline-block;
      padding: 2px 5px;
      text-decoration: none;
      font-family: "微軟正黑體";
  }
    
  .bank-info-table .status-open {
      color: #FFF;
      background-color: green;
      text-align: center;
  }
    
  .bank-info-table .status-close {
      color: #FFF;
      background-color: red;
      text-align: center;
  }
  .bank-info-table .bank-ver-status-btn {
      display: inline-block;
      padding: 2px 5px;
      text-decoration: none;
      font-family: "微軟正黑體";
  }
  .bank-info-table .bank-ver-status-btn.s2{
    color: #FFF;
      background-color: goldenrod;
  }
  .bank-info-table .bank-ver-status-btn.s3{
    color: #FFF;
      background-color: mediumpurple;
  }
  .bank-info-table .bank-ver-status-btn.s100{
    color: #FFF;
      background-color: green;
  }
  #add-bank-info-div{
    padding:  10px;
  }
    
  .editor-table {
    margin: 0 auto;
      width: 80%;
      max-width: 80%;
  }
    
  .editor-table .title {
    padding: 10px;
    font-size: 24px !important;
  }
  .editor-table td:nth-child(1) {
    white-space: nowrap;
  }
  #bank-ver-div{
    padding:  10px;
  }
  #bank-ver-div .flex-div{
    display: flex;
    align-items: center;
  }
  #bank-ver-div .bank-ver-tb .image-form .btn{position: relative;overflow: hidden;margin-right: 4px;display:inline-block;*display:inline;padding:4px 10px 4px;font-size:14px;color:#fff;text-align:center;vertical-align:middle;cursor:pointer;background-color:#5bb75b;border:1px solid #cccccc;border-color:#e6e6e6 #e6e6e6 #bfbfbf;border-bottom-color:#b3b3b3;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px; margin-left:10px;}
  #bank-ver-div .bank-ver-tb .image-form .btn input {position: absolute;top: 0; right: 0;margin: 0;border: solid transparent;opacity: 0;filter:alpha(opacity=0); cursor: pointer;}
  #bank-ver-div .bank-ver-tb .preview-pic img{
    max-width: 200px;
  }
  #bank-ver-div .bank-ver-tb .pic-notes{
    color:red;
    margin-top:10px;
  }
  #bank-ver-div .bank-ver-log-tb tr.title{
    background-color: #444;
    color:#fff;
    font-weight:bold;
  }
  #bank-ver-div .bank-ver-log-tb td{
    padding:8px 10px;
    border:1px solid #ccc;
    text-align: center;
  }
  </style>
  <div class="info-main">
    <button class="btn red add-bank-info-btn" onclick="show_add_bank_info_div();">新增</button>
    <table class="bank-info-table table">
      <tbody>
        <tr class="bg-green1 color-white">
          <th>開戶銀行</th>
          <th class="hidden">開戶省/市</th>
          <th>開戶支行</th>
          <th>開戶姓名</th>
          <th>銀行帳號</th>
          <th>狀態</th>
          <th>驗證</th>
          <th>更新時間</th>
          <th>功能</th>
        </tr>
        <?php foreach ($banks as $bank) { ?>
        <tr>
          <td><?= $bank->bank_name ?></td>
          <td><?= $bank->bank_branch ?></td>
          <td><?= $bank->account_name ?></td>
          <td><?= $bank->bank_account ?></td>
          <td>
           
            <?php 
              if ($bank->is_freeze == 0) {
                echo '<div class="status-btn status-open" href="javascript:void(0);">啟用</div>';
              } elseif ($bank->is_freeze == 1) {
                echo  '<div class="status-btn status-close" href="javascript:void(0);">凍結</div>';
              } 
            ?>
          </td>
          <td>
            <?php 
              if ($bank->status == 2) {
                echo "<div class='bank-ver-status-btn s2'>待審核</div>";
              } elseif ($bank->status == 100) {
                echo  "<div class='bank-ver-status-btn s100'>已驗證</div>";
              } elseif ($bank->status == 3) {
                echo  "<div class='bank-ver-status-btn s3'>驗證失敗</div>";
              }  
            ?>
          </td>
          <td><?= $bank->updated_at ?></td>
          <td>
              <?php if ($bank->is_freeze == 1) { ?>
                <a href="javascript:void(0);" onclick="change_bank_info_status('<?= $bank->id ?>', 0);" class="btn btn-xs default"> 
                  <i class="fa fa-pencil"></i> 啟用 
                </a>
              <?php } elseif ($bank->is_freeze == 0) { ?>
                <a href="javascript:void(0);" onclick="change_bank_info_status('<?= $bank->id ?>', 1);" class="btn btn-xs default"> 
                  <i class="fa fa-pencil"></i>  凍結  
                </a>
              <?php } ?> 
           
            <a href="javascript:void(0);" onclick="request_bank_ver_div('<?= $bank->id ?>', 1);" class="btn btn-xs default"> 
              <i class="fa fa-pencil"></i> 修改 / 驗證 
            </a>
              <a href="javascript:void(0);" onclick="delete_bank_info('<?= $bank->id ?>');" class="btn btn-xs default"> 
              <i class="fa fa-trash-o"></i> 刪除 
            </a>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
  <div id="add-bank-info-div" style="display: none;"><!--slot=6-->
    <form id="add-bank-info-form">
      <table class="table editor-table table-bordered">
        <thead>
          <tr>
            <th class="title" colspan="100%">新增銀行卡</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>地區</td>
            <td>
              <select class="select-v1" onchange="change_bank_area(this.value)" id="bank-area-select">
                <option value="-1">請選擇</option>
                <option value="taiwan">台灣</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>開戶銀行</td>
            <td>
              <select name="bank_name" id="bank-name-select"><option value="004 臺灣銀行">004 臺灣銀行</option><option value="005 土地銀行">005 土地銀行</option><option value="006 合作金庫">006 合作金庫</option><option value="007 第一銀行">007 第一銀行</option><option value="008 華南銀行">008 華南銀行</option><option value="009 彰化銀行">009 彰化銀行</option><option value="011 上海商業儲蓄銀行">011 上海商業儲蓄銀行</option><option value="012 台北富邦銀行">012 台北富邦銀行</option><option value="013 國泰世華銀行">013 國泰世華銀行</option><option value="016 高雄銀行">016 高雄銀行</option><option value="017 兆豐國際商業銀行">017 兆豐國際商業銀行</option><option value="018 農業金庫">018 農業金庫</option><option value="020 日商瑞穗銀行">020 日商瑞穗銀行</option><option value="021 花旗(台灣)商業銀行">021 花旗(台灣)商業銀行</option><option value="022 美國銀行">022 美國銀行</option><option value="023 盤谷銀行">023 盤谷銀行</option><option value="025 首都銀行">025 首都銀行</option><option value="039 澳商澳盛銀行">039 澳商澳盛銀行</option><option value="048 王道商業銀行">048 王道商業銀行</option><option value="050 臺灣企銀">050 臺灣企銀</option><option value="052 渣打國際商業銀行">052 渣打國際商業銀行</option><option value="053 台中商業銀行">053 台中商業銀行</option><option value="054 京城商業銀行">054 京城商業銀行</option><option value="072 德意志銀行">072 德意志銀行</option><option value="075 東亞銀行">075 東亞銀行</option><option value="081 匯豐(台灣)銀行">081 匯豐(台灣)銀行</option><option value="082 法國巴黎銀行">082 法國巴黎銀行</option><option value="101 瑞興銀行">101 瑞興銀行</option><option value="102 華泰銀行">102 華泰銀行</option><option value="103 臺灣新光商銀">103 臺灣新光商銀</option><option value="104 台北五信">104 台北五信</option><option value="108 陽信銀行">108 陽信銀行</option><option value="114 基隆一信">114 基隆一信</option><option value="115 基隆二信">115 基隆二信</option><option value="118 板信商業銀行">118 板信商業銀行</option><option value="119 淡水一信">119 淡水一信</option><option value="120 淡水信合社">120 淡水信合社</option><option value="124 宜蘭信合社">124 宜蘭信合社</option><option value="127 桃園信合社">127 桃園信合社</option><option value="130 新竹一信">130 新竹一信</option><option value="132 新竹三信">132 新竹三信</option><option value="146 台中二信">146 台中二信</option><option value="147 三信商業銀行">147 三信商業銀行</option><option value="158 彰化一信">158 彰化一信</option><option value="161 彰化五信">161 彰化五信</option><option value="162 彰化六信">162 彰化六信</option><option value="163 彰化十信">163 彰化十信</option><option value="165 鹿港信合社">165 鹿港信合社</option><option value="178 嘉義三信">178 嘉義三信</option><option value="188 台南三信">188 台南三信</option><option value="204 高雄三信">204 高雄三信</option><option value="215 花蓮一信">215 花蓮一信</option><option value="216 花蓮二信">216 花蓮二信</option><option value="222 澎湖一信">222 澎湖一信</option><option value="223 澎湖二信">223 澎湖二信</option><option value="224 金門信合社">224 金門信合社</option><option value="501 蘇澳漁會">501 蘇澳漁會</option><option value="502 頭城漁會">502 頭城漁會</option><option value="506 桃園漁會">506 桃園漁會</option><option value="507 新竹漁會">507 新竹漁會</option><option value="508 通苑漁會">508 通苑漁會</option><option value="510 南龍漁會">510 南龍漁會</option><option value="511 彰化漁會">511 彰化漁會</option><option value="512 雲林漁會">512 雲林漁會</option><option value="513 瑞芳漁會">513 瑞芳漁會</option><option value="514 萬里漁會">514 萬里漁會</option><option value="515 嘉義漁會">515 嘉義漁會</option><option value="516 基隆漁會">516 基隆漁會</option><option value="517 南市漁會">517 南市漁會</option><option value="518 南縣漁會">518 南縣漁會</option><option value="519 新化農會">519 新化農會</option><option value="521 彌陀區漁會">521 彌陀區漁會</option><option value="523 枋寮區漁會">523 枋寮區漁會</option><option value="524 新港漁會">524 新港漁會</option><option value="525 澎湖漁會">525 澎湖漁會</option><option value="526 金門漁會">526 金門漁會</option><option value="538 宜蘭農會">538 宜蘭農會</option><option value="541 白河農會">541 白河農會</option><option value="542 麻豆農會">542 麻豆農會</option><option value="547 後壁農會">547 後壁農會</option><option value="549 下營農會">549 下營農會</option><option value="551 官田農會">551 官田農會</option><option value="552 大內農會">552 大內農會</option><option value="556 學甲農會">556 學甲農會</option><option value="557 新市農會">557 新市農會</option><option value="558 安定農會">558 安定農會</option><option value="559 山上農會">559 山上農會</option><option value="561 左鎮農會">561 左鎮農會</option><option value="562 仁德農會">562 仁德農會</option><option value="564 關廟農會">564 關廟農會</option><option value="565 龍崎農會">565 龍崎農會</option><option value="567 南化農會">567 南化農會</option><option value="568 七股農會">568 七股農會</option><option value="570 南投農會">570 南投農會</option><option value="573 埔里農會">573 埔里農會</option><option value="574 竹山農會">574 竹山農會</option><option value="575 中寮農會">575 中寮農會</option><option value="577 魚池農會">577 魚池農會</option><option value="578 水里農會">578 水里農會</option><option value="579 國姓農會">579 國姓農會</option><option value="580 鹿谷農會">580 鹿谷農會</option><option value="581 信義農會">581 信義農會</option><option value="582 仁愛農會">582 仁愛農會</option><option value="583 東山農會">583 東山農會</option><option value="585 頭城農會">585 頭城農會</option><option value="586 羅東農會">586 羅東農會</option><option value="587 礁溪農會">587 礁溪農會</option><option value="588 壯圍農會">588 壯圍農會</option><option value="589 員山農會">589 員山農會</option><option value="596 五結農會">596 五結農會</option><option value="598 蘇澳農會">598 蘇澳農會</option><option value="599 三星農會">599 三星農會</option><option value="600 農金資中心">600 農金資中心</option><option value="602 中華民國農會">602 中華民國農會</option><option value="605 高雄市農會">605 高雄市農會</option><option value="612 神岡農會">612 神岡農會</option><option value="613 名間鄉農會">613 名間鄉農會</option><option value="614 彰化地區農會">614 彰化地區農會</option><option value="615 基隆農會">615 基隆農會</option><option value="616 雲林地區農會">616 雲林地區農會</option><option value="617 嘉義地區農會">617 嘉義地區農會</option><option value="618 台南地區農會">618 台南地區農會</option><option value="619 高雄地區農會">619 高雄地區農會</option><option value="620 屏東地區農會">620 屏東地區農會</option><option value="621 花蓮地區農會">621 花蓮地區農會</option><option value="622 台東地區農會">622 台東地區農會</option><option value="624 澎湖農會">624 澎湖農會</option><option value="625 台中農會">625 台中農會</option><option value="627 連江縣農會">627 連江縣農會</option><option value="628 鹿港農會">628 鹿港農會</option><option value="629 和美農會">629 和美農會</option><option value="631 溪湖農會">631 溪湖農會</option><option value="632 田中農會">632 田中農會</option><option value="633 北斗農會">633 北斗農會</option><option value="635 線西農會">635 線西農會</option><option value="636 伸港農會">636 伸港農會</option><option value="638 花壇農會">638 花壇農會</option><option value="639 大村農會">639 大村農會</option><option value="642 社頭農會">642 社頭農會</option><option value="643 二水農會">643 二水農會</option><option value="646 大城農會">646 大城農會</option><option value="647 溪州農會">647 溪州農會</option><option value="649 埔鹽農會">649 埔鹽農會</option><option value="650 福興農會">650 福興農會</option><option value="651 彰化農會">651 彰化農會</option><option value="683 北港農會">683 北港農會</option><option value="685 土庫農會">685 土庫農會</option><option value="693 東勢鄉農會">693 東勢鄉農會</option><option value="696 水林農會">696 水林農會</option><option value="697 元長農會">697 元長農會</option><option value="698 麥寮農會">698 麥寮農會</option><option value="699 林內農會">699 林內農會</option><option value="700 郵政儲匯局">700 郵政儲匯局</option><option value="749 內埔農會">749 內埔農會</option><option value="762 大溪農會">762 大溪農會</option><option value="763 桃園農會">763 桃園農會</option><option value="764 平鎮農會">764 平鎮農會</option><option value="765 楊梅農會">765 楊梅農會</option><option value="766 大園農會">766 大園農會</option><option value="767 蘆竹農會">767 蘆竹農會</option><option value="768 龜山農會">768 龜山農會</option><option value="769 八德農會">769 八德農會</option><option value="770 新屋農會">770 新屋農會</option><option value="771 龍潭農會">771 龍潭農會</option><option value="772 復興農會">772 復興農會</option><option value="773 觀音農會">773 觀音農會</option><option value="775 土城農會">775 土城農會</option><option value="776 三重農會">776 三重農會</option><option value="777 中和農會">777 中和農會</option><option value="778 淡水農會">778 淡水農會</option><option value="779 樹林農會">779 樹林農會</option><option value="780 鶯歌農會">780 鶯歌農會</option><option value="781 三峽農會">781 三峽農會</option><option value="785 蘆洲農會">785 蘆洲農會</option><option value="786 五股農會">786 五股農會</option><option value="787 林口農會">787 林口農會</option><option value="788 泰山農會">788 泰山農會</option><option value="789 坪林農會">789 坪林農會</option><option value="790 八里農會">790 八里農會</option><option value="791 金山農會">791 金山農會</option><option value="792 瑞芳農會">792 瑞芳農會</option><option value="793 新店農會">793 新店農會</option><option value="795 深坑農會">795 深坑農會</option><option value="796 石碇農會">796 石碇農會</option><option value="797 平溪農會">797 平溪農會</option><option value="798 石門農會">798 石門農會</option><option value="799 三芝農會">799 三芝農會</option><option value="803 聯邦商業銀行">803 聯邦商業銀行</option><option value="805 遠東銀行">805 遠東銀行</option><option value="806 元大銀行">806 元大銀行</option><option value="807 永豐銀行">807 永豐銀行</option><option value="808 玉山銀行">808 玉山銀行</option><option value="809 凱基銀行">809 凱基銀行</option><option value="810 星展(台灣)銀行">810 星展(台灣)銀行</option><option value="812 台新銀行">812 台新銀行</option><option value="815 日盛銀行">815 日盛銀行</option><option value="816 安泰銀行">816 安泰銀行</option><option value="822 中國信託">822 中國信託</option><option value="824 連線商業銀行">824 連線商業銀行</option><option value="826 樂天銀行">826 樂天銀行</option><option value="860 中埔農會">860 中埔農會</option><option value="866 阿里山農會">866 阿里山農會</option><option value="868 東勢區農會">868 東勢區農會</option><option value="869 清水農會">869 清水農會</option><option value="870 梧棲農會">870 梧棲農會</option><option value="871 大甲農會">871 大甲農會</option><option value="872 沙鹿農會">872 沙鹿農會</option><option value="874 霧峰農會">874 霧峰農會</option><option value="875 太平農會">875 太平農會</option><option value="876 烏日農會">876 烏日農會</option><option value="877 后里農會">877 后里農會</option><option value="878 大雅農會">878 大雅農會</option><option value="879 潭子農會">879 潭子農會</option><option value="880 石岡農會">880 石岡農會</option><option value="881 新社農會">881 新社農會</option><option value="882 大肚農會">882 大肚農會</option><option value="883 外埔農會">883 外埔農會</option><option value="884 大安農會">884 大安農會</option><option value="885 龍井農會">885 龍井農會</option><option value="886 和平農會">886 和平農會</option><option value="891 花蓮農會">891 花蓮農會</option><option value="895 瑞穗農會">895 瑞穗農會</option><option value="896 玉溪農會">896 玉溪農會</option><option value="897 鳳榮農會">897 鳳榮農會</option><option value="898 光豐農會">898 光豐農會</option><option value="901 大里農會">901 大里農會</option><option value="902 苗栗農會">902 苗栗農會</option><option value="903 汐止農會">903 汐止農會</option><option value="904 新莊農會">904 新莊農會</option><option value="906 頭份農會">906 頭份農會</option><option value="907 竹南農會">907 竹南農會</option><option value="908 通霄農會">908 通霄農會</option><option value="909 苑裡農會">909 苑裡農會</option><option value="912 冬山農會">912 冬山農會</option><option value="913 後龍農會">913 後龍農會</option><option value="914 卓蘭農會">914 卓蘭農會</option><option value="915 西湖農會">915 西湖農會</option><option value="916 草屯農會">916 草屯農會</option><option value="917 公館農會">917 公館農會</option><option value="918 銅鑼農會">918 銅鑼農會</option><option value="919 三義農會">919 三義農會</option><option value="920 造橋農會">920 造橋農會</option><option value="921 南庄農會">921 南庄農會</option><option value="922 臺南農會">922 臺南農會</option><option value="923 獅潭農會">923 獅潭農會</option><option value="924 頭屋農會">924 頭屋農會</option><option value="925 三灣農會">925 三灣農會</option><option value="926 大湖農會">926 大湖農會</option><option value="928 板橋農會">928 板橋農會</option><option value="929 關西農會">929 關西農會</option><option value="930 新埔農會">930 新埔農會</option><option value="931 竹北農會">931 竹北農會</option><option value="932 湖口農會">932 湖口農會</option><option value="933 芎林農會">933 芎林農會</option><option value="934 寶山農會">934 寶山農會</option><option value="935 峨眉農會">935 峨眉農會</option><option value="936 北埔農會">936 北埔農會</option><option value="937 竹東農會">937 竹東農會</option><option value="938 橫山農會">938 橫山農會</option><option value="939 新豐農會">939 新豐農會</option><option value="940 新竹農會">940 新竹農會</option><option value="951 北農中心">951 北農中心</option><option value="953 田尾農會">953 田尾農會</option><option value="984 北投農會">984 北投農會</option><option value="985 士林農會">985 士林農會</option><option value="986 內湖農會">986 內湖農會</option><option value="987 南港農會">987 南港農會</option><option value="988 木柵農會">988 木柵農會</option><option value="989 景美農會">989 景美農會</option></select>
            </td>
          </tr>
          <tr class="hidden">
            <td>開戶省/市</td>
            <td>
              <select name="bank_province" onchange="change_bank_province();">
                <!--JSO BANK_PROVINCE_CONTENT -->
              </select>
              <select name="bank_city">
                <!--JSO BANK_CITY_CONTENT -->
              </select>
            </td>
          </tr>
          <tr>
            <td>開戶支行</td>
            <td><input type="text" name="bank_branch" value=""></td>
          </tr>
          <tr>
            <td>開戶姓名</td>
            <td><input type="text" name="account_name" value=""></td>
          </tr>
          <tr>
            <td>銀行帳號</td>
            <td><input type="text" name="bank_account" value=""></td>
          </tr>
          <tr align="right">
            <td colspan="100%"><button type="button" class="btn red" onclick="close_layer({type: 1});">取消</button><button type="button" class="btn green" onclick="save_add_bank_info();">儲存</button></td>
          </tr>
        </tbody>
      </table>
    </form>
  </div>
  <div id="bank-ver-div" style="display: none;" ><!--slot=7-->
    <table class="table bank-ver-tb table-bordered">
      <thead>
        <tr>
          <th class="title" colspan="100%">銀行卡修改/驗證</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>帳號</td>
          <td id="lbl_ver_username">test996</td>
        </tr>
        <tr>
          <td>姓名</td>
          <td id="lbl_ver_nickname">st996</td>
        </tr>
        <tr>
          <td>地區</td>
          <td>
            <select onchange="change_bank_area(this.value)" id="bank-area-select">
              <option value="-1">請選擇</option>
              <option value="taiwan" selected>台灣</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>開戶銀行</td>
          <td>
            <input type="hidden" id="hidden-bank-name" value="">
            <select name="bank_name" is-post-data="1" id="bank-name-select"><option value="004 臺灣銀行">004 臺灣銀行</option><option value="005 土地銀行">005 土地銀行</option><option value="006 合作金庫">006 合作金庫</option><option value="007 第一銀行">007 第一銀行</option><option value="008 華南銀行">008 華南銀行</option><option value="009 彰化銀行">009 彰化銀行</option><option value="011 上海商業儲蓄銀行">011 上海商業儲蓄銀行</option><option value="012 台北富邦銀行">012 台北富邦銀行</option><option value="013 國泰世華銀行">013 國泰世華銀行</option><option value="016 高雄銀行">016 高雄銀行</option><option value="017 兆豐國際商業銀行">017 兆豐國際商業銀行</option><option value="018 農業金庫">018 農業金庫</option><option value="020 日商瑞穗銀行">020 日商瑞穗銀行</option><option value="021 花旗(台灣)商業銀行">021 花旗(台灣)商業銀行</option><option value="022 美國銀行">022 美國銀行</option><option value="023 盤谷銀行">023 盤谷銀行</option><option value="025 首都銀行">025 首都銀行</option><option value="039 澳商澳盛銀行">039 澳商澳盛銀行</option><option value="048 王道商業銀行">048 王道商業銀行</option><option value="050 臺灣企銀">050 臺灣企銀</option><option value="052 渣打國際商業銀行">052 渣打國際商業銀行</option><option value="053 台中商業銀行">053 台中商業銀行</option><option value="054 京城商業銀行">054 京城商業銀行</option><option value="072 德意志銀行">072 德意志銀行</option><option value="075 東亞銀行">075 東亞銀行</option><option value="081 匯豐(台灣)銀行">081 匯豐(台灣)銀行</option><option value="082 法國巴黎銀行">082 法國巴黎銀行</option><option value="101 瑞興銀行">101 瑞興銀行</option><option value="102 華泰銀行">102 華泰銀行</option><option value="103 臺灣新光商銀">103 臺灣新光商銀</option><option value="104 台北五信">104 台北五信</option><option value="108 陽信銀行">108 陽信銀行</option><option value="114 基隆一信">114 基隆一信</option><option value="115 基隆二信">115 基隆二信</option><option value="118 板信商業銀行">118 板信商業銀行</option><option value="119 淡水一信">119 淡水一信</option><option value="120 淡水信合社">120 淡水信合社</option><option value="124 宜蘭信合社">124 宜蘭信合社</option><option value="127 桃園信合社">127 桃園信合社</option><option value="130 新竹一信">130 新竹一信</option><option value="132 新竹三信">132 新竹三信</option><option value="146 台中二信">146 台中二信</option><option value="147 三信商業銀行">147 三信商業銀行</option><option value="158 彰化一信">158 彰化一信</option><option value="161 彰化五信">161 彰化五信</option><option value="162 彰化六信">162 彰化六信</option><option value="163 彰化十信">163 彰化十信</option><option value="165 鹿港信合社">165 鹿港信合社</option><option value="178 嘉義三信">178 嘉義三信</option><option value="188 台南三信">188 台南三信</option><option value="204 高雄三信">204 高雄三信</option><option value="215 花蓮一信">215 花蓮一信</option><option value="216 花蓮二信">216 花蓮二信</option><option value="222 澎湖一信">222 澎湖一信</option><option value="223 澎湖二信">223 澎湖二信</option><option value="224 金門信合社">224 金門信合社</option><option value="501 蘇澳漁會">501 蘇澳漁會</option><option value="502 頭城漁會">502 頭城漁會</option><option value="506 桃園漁會">506 桃園漁會</option><option value="507 新竹漁會">507 新竹漁會</option><option value="508 通苑漁會">508 通苑漁會</option><option value="510 南龍漁會">510 南龍漁會</option><option value="511 彰化漁會">511 彰化漁會</option><option value="512 雲林漁會">512 雲林漁會</option><option value="513 瑞芳漁會">513 瑞芳漁會</option><option value="514 萬里漁會">514 萬里漁會</option><option value="515 嘉義漁會">515 嘉義漁會</option><option value="516 基隆漁會">516 基隆漁會</option><option value="517 南市漁會">517 南市漁會</option><option value="518 南縣漁會">518 南縣漁會</option><option value="519 新化農會">519 新化農會</option><option value="521 彌陀區漁會">521 彌陀區漁會</option><option value="523 枋寮區漁會">523 枋寮區漁會</option><option value="524 新港漁會">524 新港漁會</option><option value="525 澎湖漁會">525 澎湖漁會</option><option value="526 金門漁會">526 金門漁會</option><option value="538 宜蘭農會">538 宜蘭農會</option><option value="541 白河農會">541 白河農會</option><option value="542 麻豆農會">542 麻豆農會</option><option value="547 後壁農會">547 後壁農會</option><option value="549 下營農會">549 下營農會</option><option value="551 官田農會">551 官田農會</option><option value="552 大內農會">552 大內農會</option><option value="556 學甲農會">556 學甲農會</option><option value="557 新市農會">557 新市農會</option><option value="558 安定農會">558 安定農會</option><option value="559 山上農會">559 山上農會</option><option value="561 左鎮農會">561 左鎮農會</option><option value="562 仁德農會">562 仁德農會</option><option value="564 關廟農會">564 關廟農會</option><option value="565 龍崎農會">565 龍崎農會</option><option value="567 南化農會">567 南化農會</option><option value="568 七股農會">568 七股農會</option><option value="570 南投農會">570 南投農會</option><option value="573 埔里農會">573 埔里農會</option><option value="574 竹山農會">574 竹山農會</option><option value="575 中寮農會">575 中寮農會</option><option value="577 魚池農會">577 魚池農會</option><option value="578 水里農會">578 水里農會</option><option value="579 國姓農會">579 國姓農會</option><option value="580 鹿谷農會">580 鹿谷農會</option><option value="581 信義農會">581 信義農會</option><option value="582 仁愛農會">582 仁愛農會</option><option value="583 東山農會">583 東山農會</option><option value="585 頭城農會">585 頭城農會</option><option value="586 羅東農會">586 羅東農會</option><option value="587 礁溪農會">587 礁溪農會</option><option value="588 壯圍農會">588 壯圍農會</option><option value="589 員山農會">589 員山農會</option><option value="596 五結農會">596 五結農會</option><option value="598 蘇澳農會">598 蘇澳農會</option><option value="599 三星農會">599 三星農會</option><option value="600 農金資中心">600 農金資中心</option><option value="602 中華民國農會">602 中華民國農會</option><option value="605 高雄市農會">605 高雄市農會</option><option value="612 神岡農會">612 神岡農會</option><option value="613 名間鄉農會">613 名間鄉農會</option><option value="614 彰化地區農會">614 彰化地區農會</option><option value="615 基隆農會">615 基隆農會</option><option value="616 雲林地區農會">616 雲林地區農會</option><option value="617 嘉義地區農會">617 嘉義地區農會</option><option value="618 台南地區農會">618 台南地區農會</option><option value="619 高雄地區農會">619 高雄地區農會</option><option value="620 屏東地區農會">620 屏東地區農會</option><option value="621 花蓮地區農會">621 花蓮地區農會</option><option value="622 台東地區農會">622 台東地區農會</option><option value="624 澎湖農會">624 澎湖農會</option><option value="625 台中農會">625 台中農會</option><option value="627 連江縣農會">627 連江縣農會</option><option value="628 鹿港農會">628 鹿港農會</option><option value="629 和美農會">629 和美農會</option><option value="631 溪湖農會">631 溪湖農會</option><option value="632 田中農會">632 田中農會</option><option value="633 北斗農會">633 北斗農會</option><option value="635 線西農會">635 線西農會</option><option value="636 伸港農會">636 伸港農會</option><option value="638 花壇農會">638 花壇農會</option><option value="639 大村農會">639 大村農會</option><option value="642 社頭農會">642 社頭農會</option><option value="643 二水農會">643 二水農會</option><option value="646 大城農會">646 大城農會</option><option value="647 溪州農會">647 溪州農會</option><option value="649 埔鹽農會">649 埔鹽農會</option><option value="650 福興農會">650 福興農會</option><option value="651 彰化農會">651 彰化農會</option><option value="683 北港農會">683 北港農會</option><option value="685 土庫農會">685 土庫農會</option><option value="693 東勢鄉農會">693 東勢鄉農會</option><option value="696 水林農會">696 水林農會</option><option value="697 元長農會">697 元長農會</option><option value="698 麥寮農會">698 麥寮農會</option><option value="699 林內農會">699 林內農會</option><option value="700 郵政儲匯局">700 郵政儲匯局</option><option value="749 內埔農會">749 內埔農會</option><option value="762 大溪農會">762 大溪農會</option><option value="763 桃園農會">763 桃園農會</option><option value="764 平鎮農會">764 平鎮農會</option><option value="765 楊梅農會">765 楊梅農會</option><option value="766 大園農會">766 大園農會</option><option value="767 蘆竹農會">767 蘆竹農會</option><option value="768 龜山農會">768 龜山農會</option><option value="769 八德農會">769 八德農會</option><option value="770 新屋農會">770 新屋農會</option><option value="771 龍潭農會">771 龍潭農會</option><option value="772 復興農會">772 復興農會</option><option value="773 觀音農會">773 觀音農會</option><option value="775 土城農會">775 土城農會</option><option value="776 三重農會">776 三重農會</option><option value="777 中和農會">777 中和農會</option><option value="778 淡水農會">778 淡水農會</option><option value="779 樹林農會">779 樹林農會</option><option value="780 鶯歌農會">780 鶯歌農會</option><option value="781 三峽農會">781 三峽農會</option><option value="785 蘆洲農會">785 蘆洲農會</option><option value="786 五股農會">786 五股農會</option><option value="787 林口農會">787 林口農會</option><option value="788 泰山農會">788 泰山農會</option><option value="789 坪林農會">789 坪林農會</option><option value="790 八里農會">790 八里農會</option><option value="791 金山農會">791 金山農會</option><option value="792 瑞芳農會">792 瑞芳農會</option><option value="793 新店農會">793 新店農會</option><option value="795 深坑農會">795 深坑農會</option><option value="796 石碇農會">796 石碇農會</option><option value="797 平溪農會">797 平溪農會</option><option value="798 石門農會">798 石門農會</option><option value="799 三芝農會">799 三芝農會</option><option value="803 聯邦商業銀行">803 聯邦商業銀行</option><option value="805 遠東銀行">805 遠東銀行</option><option value="806 元大銀行">806 元大銀行</option><option value="807 永豐銀行">807 永豐銀行</option><option value="808 玉山銀行">808 玉山銀行</option><option value="809 凱基銀行">809 凱基銀行</option><option value="810 星展(台灣)銀行">810 星展(台灣)銀行</option><option value="812 台新銀行">812 台新銀行</option><option value="815 日盛銀行">815 日盛銀行</option><option value="816 安泰銀行">816 安泰銀行</option><option value="822 中國信託">822 中國信託</option><option value="824 連線商業銀行">824 連線商業銀行</option><option value="826 樂天銀行">826 樂天銀行</option><option value="860 中埔農會">860 中埔農會</option><option value="866 阿里山農會">866 阿里山農會</option><option value="868 東勢區農會">868 東勢區農會</option><option value="869 清水農會">869 清水農會</option><option value="870 梧棲農會">870 梧棲農會</option><option value="871 大甲農會">871 大甲農會</option><option value="872 沙鹿農會">872 沙鹿農會</option><option value="874 霧峰農會">874 霧峰農會</option><option value="875 太平農會">875 太平農會</option><option value="876 烏日農會">876 烏日農會</option><option value="877 后里農會">877 后里農會</option><option value="878 大雅農會">878 大雅農會</option><option value="879 潭子農會">879 潭子農會</option><option value="880 石岡農會">880 石岡農會</option><option value="881 新社農會">881 新社農會</option><option value="882 大肚農會">882 大肚農會</option><option value="883 外埔農會">883 外埔農會</option><option value="884 大安農會">884 大安農會</option><option value="885 龍井農會">885 龍井農會</option><option value="886 和平農會">886 和平農會</option><option value="891 花蓮農會">891 花蓮農會</option><option value="895 瑞穗農會">895 瑞穗農會</option><option value="896 玉溪農會">896 玉溪農會</option><option value="897 鳳榮農會">897 鳳榮農會</option><option value="898 光豐農會">898 光豐農會</option><option value="901 大里農會">901 大里農會</option><option value="902 苗栗農會">902 苗栗農會</option><option value="903 汐止農會">903 汐止農會</option><option value="904 新莊農會">904 新莊農會</option><option value="906 頭份農會">906 頭份農會</option><option value="907 竹南農會">907 竹南農會</option><option value="908 通霄農會">908 通霄農會</option><option value="909 苑裡農會">909 苑裡農會</option><option value="912 冬山農會">912 冬山農會</option><option value="913 後龍農會">913 後龍農會</option><option value="914 卓蘭農會">914 卓蘭農會</option><option value="915 西湖農會">915 西湖農會</option><option value="916 草屯農會">916 草屯農會</option><option value="917 公館農會">917 公館農會</option><option value="918 銅鑼農會">918 銅鑼農會</option><option value="919 三義農會">919 三義農會</option><option value="920 造橋農會">920 造橋農會</option><option value="921 南庄農會">921 南庄農會</option><option value="922 臺南農會">922 臺南農會</option><option value="923 獅潭農會">923 獅潭農會</option><option value="924 頭屋農會">924 頭屋農會</option><option value="925 三灣農會">925 三灣農會</option><option value="926 大湖農會">926 大湖農會</option><option value="928 板橋農會">928 板橋農會</option><option value="929 關西農會">929 關西農會</option><option value="930 新埔農會">930 新埔農會</option><option value="931 竹北農會">931 竹北農會</option><option value="932 湖口農會">932 湖口農會</option><option value="933 芎林農會">933 芎林農會</option><option value="934 寶山農會">934 寶山農會</option><option value="935 峨眉農會">935 峨眉農會</option><option value="936 北埔農會">936 北埔農會</option><option value="937 竹東農會">937 竹東農會</option><option value="938 橫山農會">938 橫山農會</option><option value="939 新豐農會">939 新豐農會</option><option value="940 新竹農會">940 新竹農會</option><option value="951 北農中心">951 北農中心</option><option value="953 田尾農會">953 田尾農會</option><option value="984 北投農會">984 北投農會</option><option value="985 士林農會">985 士林農會</option><option value="986 內湖農會">986 內湖農會</option><option value="987 南港農會">987 南港農會</option><option value="988 木柵農會">988 木柵農會</option><option value="989 景美農會">989 景美農會</option></select></td>
        </tr>
        <tr>
          <td>開戶支行</td>
          <td>
            <input type="text" is-post-data="1" name="bank_branch" value="1">
          </td>
        </tr>
        <tr>
          <td>開戶姓名</td>
          <td>
            <input type="text" is-post-data="1" name="account_name" value="2">
          </td>
        </tr>
        <tr>
          <td>銀行帳號</td>
          <td>
            <input type="text" is-post-data="1" name="bank_account" value="3">
          </td>
        </tr>
        <tr>
          <td colspan="100%">照片</td>
        </tr>
        <!--slot=8-->

        <tr>
          <td colspan="100%">
            <div class="flex-div">
              照片1
              <form id="image-form-1" method="post" enctype="multipart/form-data" action="/admin/upload_pic" class="image-form">
                <div id="up-status-1" style="display:none"><img src="/templates/images/loader-sty1.gif" alt="uploading"></div>
                <div id="btn-group-1">
                  <div class="btn">
                    <span>上傳圖片</span>
                    <input class="bank-photo-img" type="file" name="photoimg" img-no="1">
                  </div>
                </div>
                <input type="hidden" name="post_php" value="cus_bank_info">
                <input type="hidden" name="img_no" value="1">
                <input type="hidden" name="folder" value="bank_pic">
              </form>
            </div>
            <div class="pic-notes">※圖片最大為5MB, 支援格式為jpg, jpeg, png.</div>
            
            <div id="preview-pic-1" class="preview-pic">
              
            </div>
          </td>
        </tr>

        <tr>
          <td colspan="100%">
            <div class="flex-div">
              照片2
              <form id="image-form-2" method="post" enctype="multipart/form-data" action="/admin/upload_pic" class="image-form">
                <div id="up-status-2" style="display:none"><img src="/templates/images/loader-sty1.gif" alt="uploading"></div>
                <div id="btn-group-2">
                  <div class="btn">
                    <span>上傳圖片</span>
                    <input class="bank-photo-img" type="file" name="photoimg" img-no="2">
                  </div>
                </div>
                <input type="hidden" name="post_php" value="cus_bank_info">
                <input type="hidden" name="img_no" value="2">
                <input type="hidden" name="folder" value="bank_pic">
              </form>
            </div>
            <div class="pic-notes">※圖片最大為5MB, 支援格式為jpg, jpeg, png.</div>
            
            <div id="preview-pic-2" class="preview-pic">
              
            </div>
          </td>
        </tr>


          <tr>
            <td>驗證狀態</td>
            <td>
              <select is-post-data="1" name="bank_ver_status">
                <option>請選擇</option>
                <!--slot=4-->

                <option value="2" selected=""> 待審核</option>

                <option value="3"> 驗證失敗</option>

                <option value="100"> 已驗證</option>


              </select>
            </td>
          </tr>
          <tr class="hidden">
            <td>操作歷程</td>
            <td>
              <!--JSO CUS_BANK_VER_LOG -->
            </td>
          </tr>
          <tr align="right">
            <td colspan="100%">
              <button type="button" class="btn grey" onclick="close_layer({type: 1});">關閉</button>
              <button id="btnSave" type="button" class="btn green" onclick="save_bank_ver();">存檔</button>
            </td>
          </tr>
        </tbody>
      </table>
      <input type="hidden" is-post-data="1" name="edit_info_id" value="110">
    </div>
  </div>
</div>
<div id="open-game-info-area" class="data-content hidden">
    <!--slot=3-->
    <div class="hidden save-btn"><button class="btn btn-danger" type="button" onclick="save_customer('open-game-info')">儲存開放遊戲設定</button></div>
    <form>
        <div class="portlet light bordered">
            <div class="portlet-body">
                <!--slot=8-->
                <!-- for occupy&game_status -->
                <div class="portlet-title has_set_tool" style="background-color: rgba(241, 211, 15, 0.3); cursor: pointer;">
                    <div class="caption" style="padding: 14px;">
                        <i class="fa fa-cogs font-green-sharp"></i> <span class="caption-subject font-green-sharp bold uppercase" style="font-size: 16px;">開放遊戲&nbsp;<font class="txt-color1"></font></span>
                    </div>
                    <div class="tool"><a class="collapse" id="sport-title-expand"></a></div>
                </div>
                <div class="tabbable-line mt-20" style="">
                    <div class="tab-content">
                        <table id="game-status-table">
                            <tbody>
                              <?php foreach ($GameStoreTypes as $type) {?>
                                <tr>
                                <td><?= $type->name ?></td>
                                <td>
                                    <input type="checkbox" class="status-ckbox-all" spot="<?= $type->id ?>" />
                                    全部
                                    <?php foreach ($type->games as $game) {?>
                                      <input type="checkbox" class="status-ckbox" name="game_status_arr[]" value="<?= $game->id ?>" spot="<?= $type->id ?>" <?= in_array($game->id, $user_open_game_ids) ? 'checked=""' : '' ?> />
                                      <?= $game->name ?>
                                    <?php } ?>
                                </td>
                                </tr>
                              <?php } ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                <br />
            </div>
        </div>
    </form>
</div>
<div id="gstore-group1-area" class="data-content hidden">
    <div id="no-data"></div>
</div>
<div id="gstore-group2-area" class="data-content hidden">
    <div id="no-data"></div>
</div>
<div id="gstore-group3-area" class="data-content hidden">
    <div id="no-data"></div>
</div>
<div id="gstore-group4-area" class="data-content hidden">
    <div id="no-data"></div>
</div>
<div id="gstore-group6-area" class="data-content hidden">
    <div id="no-data"></div>
</div>
<input type="hidden" value="<?=e($etype)?>" id="etype">
<input type="hidden" value="<?=e($user->id)?>" id="edit-cus-id">
<input type="hidden" id="edit-cus-level" name="edit_cus_level" value="16">
<input type="hidden" value="3" id="edit-station-code">
<input type="hidden" value="<?=$top_cus_id?>" id="top-cus-id">
<script>
$(function() {
 
});
</script>

</div>
        <!--[if lt IE 9]>
<script src="/assets/global/plugins/respond.min.js"></script>
<script src="/assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="/assets/global/scripts/datatable.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="/assets/global/scripts/self-app.js?c=1" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="/assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
        <script src="/assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
        <script src="/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
        <script src="/layer/layer.js"></script>
        <script src="/templates/js/kang_ajax.js?cache=102"></script>
		<script src="/templates/js/kang_common.js?cache=109"></script>
		<script src="/templates/js/kang_all.js?cache=203"></script>
		<script src="/templates/js/lang/tw.js?cache=203"></script>
        <script src="/templates/js/jquery.wallform.js?c=1" type="text/javascript"></script>
        <script src="/templates/js/bank.js?c=100" type="text/javascript"></script>
        <script src="/templates/js/cus_info/editor.js?cache=161" type="text/javascript"></script>

    </body>
</html>