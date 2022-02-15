<!DOCTYPE html><!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]--><!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]--><!--[if !IE]><!-->
<html lang="en" class="no-js">	<!--<![endif]-->	<!-- BEGIN HEAD -->	
<head>        
<meta charset="utf-8"/>        
<meta http-equiv="X-UA-Compatible" content="IE=edge">        <!--<meta content="width=device-width, initial-scale=1" name="viewport"/>-->        
<meta content="" name="description"/>        
<meta content="" name="keywords"/>        
<meta content="" name="author"/>        
<title>控端</title>        <!-- BEGIN PAGE TOP STYLES -->        <!-- END PAGE TOP STYLES -->        <!-- BEGIN GLOBAL MANDATORY STYLES -->        
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />        
<link href="/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />        
<link href="/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />        
<link href="/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />        
<link href="/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />        
<link href="/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />        
<!-- END GLOBAL MANDATORY STYLES -->        <!-- BEGIN PAGE LEVEL PLUGINS -->        
<link href="/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />        
<link href="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />        
<link href="/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />        
<link href="/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />        
<!-- END PAGE LEVEL PLUGINS -->        <!-- BEGIN THEME GLOBAL STYLES -->        
<link href="/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />        
<link href="/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />        <!-- END THEME GLOBAL STYLES -->        <!-- BEGIN THEME LAYOUT STYLES -->        
<link href="/assets/layouts/layout/css/self-layout.css" rel="stylesheet" type="text/css" />        
<link href="/assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />        
<link href="/assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />        <!-- END THEME LAYOUT STYLES -->        
<link href="/templates/css/style.css?cache=209" rel="stylesheet" type="text/css"/>		
<link href="/templates/css/tw_style.css?cache=205" rel="stylesheet" type="text/css"/>                <!-- BEGIN PAGE FIRST SCRIPTS -->        
<script src="/assets/global/plugins/jquery.min.js" type="text/javascript"></script>        <!-- END PAGE FIRST SCRIPTS -->        
<link rel="shortcut icon" href="#"/>	
</head>	<!-- END HEAD -->	
<body>       
<div class="page-inner-content">
	<!--slot=0-->
<style>
.page-bar .act-group{
	/*float:left;*/
	margin-right:10px;
}
.setting-tb{
	margin-top:15px;
	
}
.setting-tb td{
	padding:10px;
	border: 1px solid #999;
}
.setting-tb td.title{
	font-weight:bold;
	font-size:16px;
	vertical-align:top;
	text-align: right;
}
.setting-tb .banner-name, .setting-tb .link_url{
	width:250px;
}
	
.setting-tb .banner-order{
	width:50px;
}
	
.image-form .btn{position: relative;overflow: hidden;margin-right: 4px;display:inline-block;*display:inline;padding:4px 10px 4px;font-size:14px;color:#fff;text-align:center;vertical-align:middle;cursor:pointer;background-color:#5bb75b;border:1px solid #cccccc;border-color:#e6e6e6 #e6e6e6 #bfbfbf;border-bottom-color:#b3b3b3;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px;}
.image-form .btn input {position: absolute;top: 0; right: 0;margin: 0;border: solid transparent;opacity: 0;filter:alpha(opacity=0); cursor: pointer;}
.setting-tb .pic-notes{
	color:red;
	margin-top:10px;
}
.setting-tb	.link-type-div{
	margin-top:10px;
}
	
.fl-l{
	float: left;
}
.ml-10{
	margin-left: 10px;
}
    
.btn-delete {
    color: #fff !important;
    background-color: #ed6b75 !important;
    border-color: #ea5460 !important;
}
input[type="radio"]{
	margin-left: -10px !important;
}
    
</style>
<div class="page-bar">
	<div class="act-group">
		<button class="btn btn-danger" type="button" onclick="save_banner()">確定儲存</button>
    </div>
    <div class="act-group">
		<button class="btn green-sharp btn-large" type="button" onclick="location.href='/admin/banner?edit_unique_code=3'">回上頁</button>
    </div>
</div>
<table id="all-post" class="setting-tb">
    <tr>
        <td class="title">圖片名稱</td>
        <td><input type="text" is-post-data="1" name="banner_name" class="banner-name" value="<?=($banner&&$banner->bannerlocal)?$banner->bannerlocal->name:''?>"></td>
    </tr>
    <tr>
        <td class="title">圖片連結</td>
        <td>
            <select is-post-data="1" name="link_type" onchange="change_link_content();">
                <!--slot=1-->

	<option  value="0" selected> 無連結</option>

	<!--option  value="1" > 內部優惠文案</option-->

	<option  value="2" > 自定義連結</option>


            </select>
            <div class="link-type-div" type="1" style="display: none;">
                <select is-post-data="1" name="link_did">
                    <option  value="0">--請選擇--</option>
                    <!--slot=1-->

	<option  value="13" > 首儲送1000</option>

	<option  value="16" > 註冊送100</option>

	<option  value="18" > 應聘代理</option>

	<option  value="20" > 首次儲值100送100</option>

	<option  value="25" > 主頁面優惠金</option>

	<option  value="26" > 百家連六幸運金</option>

	<option  value="27" > 歡慶雙十 每日任務彩金送不完</option>

	<option  value="28" > 註冊首儲送1000</option>

	<option  value="29" > 扭轉老虎機 天天送20%</option>

	<option  value="30" > 週週儲值送1000</option>

	<option  value="31" > 金鈦城 VIP制度</option>

	<option  value="32" > 好友拉好友 介紹紅包領不完</option>

	<option  value="42" > 注册优惠</option>

	<option  value="43" > 线上支付</option>

	<option  value="44" > 代理模式</option>


                </select>
            </div>
            <div class="link-type-div" type="2" style="display: none;">
                <form id="link-url-form">
                    <table>
                    <!--slot=4-->

<tr>
    <td>
        <span>繁體</span>
    </td>
    <td>
        <input type="text" is-post-data="1" name="link_url[tw]" class="link-url" value=""> 
    </td>
</tr>


                    </table>
                </form>
            </div>
        </td>
    </tr>
    <tr>
        <td class="title">顯示順序(大至小)</td>
        <td><input type="text" is-post-data="1" name="banner_order" class="banner-order" value="<?=$banner?$banner->sort:''?>"></td>
    </tr>
    <!--slot=3-->

<tr>
    <td class="title">輪播圖片(<?=App\Extensions\Language::currentLangName()?>)</td>
    <td>
        <form id="image-form-tw" method="post" enctype="multipart/form-data" action="upload_pic" class="image-form">
            <div id="up-status-tw" style="display:none"><img src="/templates/images/loader-sty1.gif" alt="uploading"/></div>
            <div id="btn-group-tw">
                <div class="btn">
                    <span>上傳圖片</span>
                    <input class='banner-photo-img' type="file" name="photoimg" lang="tw">
                </div>
                <div class="btn btn-delete" onClick="delete_banner_pic('tw');">
                    <span>刪除圖片</span>
                </div>
            </div>
            <input type="hidden" name="post_php" value="banner_editor">
            <input type="hidden" name="lang" value="tw">
			<input type="hidden" id="folder" name="folder" value="banner_pic" />
        </form>
        <div class="pic-notes">※寬 * 高 需為 1388px * 576px</div>
        <div class="pic-notes">※圖片最大為5MB, 支援格式為jpg, jpeg, png.</div>
        <div id="preview-pic-tw">
            <img src="<?=($banner&&$banner->bannerlocal)?$banner->bannerlocal->photo:''?>" />
			<input type="hidden" is-post-data="1" name="banner_pic_path[]" value="<?=($banner&&$banner->bannerlocal)?$banner->bannerlocal->photo:''?>" class="pic-path">
        </div>
    </td>
</tr>


    <tr>
        <td class="title">發佈類型</td>
        <td>
            <input type="radio" is-post-data="1" class="item-ckbox" name="publish_type" publish-type="0" value="0" onchange="change_publish_type();">常駐
            <input type="radio" is-post-data="1" class="item-ckbox" name="publish_type" publish-type="1" value="1" onchange="change_publish_type();">按發佈時間
        </td>
    </tr>
    <tr class="publish-type-1">
    	<td class="title">發佈開始時間</td>
        <td>
			<div class="fl-l">
				<div class="input-group input-small date date-picker" data-date="2022-01-10" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
					<input type="text" is-post-data="1" class="form-control" name="publish_start_date" value="2022-01-10" readonly>
					<span class="input-group-btn">
						<button class="btn default" type="button">
						<i class="fa fa-calendar"></i>
						</button>
					</span>
				</div>
			</div>
			<div class="fl-l ml-10">
				<div class="input-group input-small start-time">
					<input type="text" is-post-data="1" name="publish_start_time" value="11:00" class="form-control timepicker timepicker-24" readonly>
					<span class="input-group-btn">
						<button class="btn default" type="button">
							<i class="fa fa-clock-o"></i>
						</button>
					</span>
				</div>
			</div>
		</td>
    </tr>
	<tr class="publish-type-1">
    	<td class="title">發佈結束時間</td>
        <td>
			<div class="fl-l">
				<div class="input-group input-small date date-picker" data-date="2022-01-10" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
					<input type="text" is-post-data="1" class="form-control" name="publish_end_date" value="2022-01-10" readonly>
					<span class="input-group-btn">
						<button class="btn default" type="button">
						<i class="fa fa-calendar"></i>
						</button>
					</span>
				</div>
			</div>
			<div class="fl-l ml-10">
				<div class="input-group input-small end-time">
					<input type="text" is-post-data="1" name="publish_end_time" value="11:00" class="form-control timepicker timepicker-24" readonly>
					<span class="input-group-btn">
						<button class="btn default" type="button">
							<i class="fa fa-clock-o"></i>
						</button>
					</span>
				</div>
			</div>
		</td>
    </tr>
    <tr>
        <td class="title">狀態</td>
        <td>是否啟用<input type="checkbox" is-post-data="1" name="banner_status" value="1" checked /></td>
    </tr>
</table>
<input type="hidden" id="etype" value="<?=$etype?>" />
<input type="hidden" id="edit-bid" value="<?=$banner?$banner->id:'0'?>" />
<input type="hidden" id="edit-unique-code" name="edit_unique_code" value="3" />

<script>
$(function(){
	$("input[name=publish_type][publish-type=0]").prop("checked",true);
	$("input[name=publish_type][publish-type=0]").attr("class","checked");
	change_publish_type();
	datetime_picker_init();
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
		<script src="/templates/js/banner/editor.js?cache=121" type="text/javascript"></script>

    </body>
</html>