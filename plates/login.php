<!DOCTYPE html><!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]--><!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]--><!--[if !IE]><!-->
<html lang="en" class="no-js">	<!--<![endif]-->	<!-- BEGIN HEAD -->	
<head>        
<meta charset="utf-8"/>        
<meta http-equiv="X-UA-Compatible" content="IE=edge">        
<meta content="width=device-width, initial-scale=1" name="viewport"/>        
<meta content="" name="description"/>        <meta content="" name="keywords"/>
<meta content="" name="author"/>
<title>代理後台系統</title>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
<link href="/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
<link href="/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL STYLES -->
<link href="/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
<link href="/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
<!-- END THEME GLOBAL STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN THEME LAYOUT STYLES -->
<!-- END THEME LAYOUT STYLES -->
<link href="/templates/css/login.css?cache=107" rel="stylesheet" type="text/css" />
<link href="/templates/css/style.css" rel="stylesheet" type="text/css"/>
<!--<link rel="shortcut icon" href=""/>-->	</head>	<!-- END HEAD -->
<body class=" login">
<!-- BEGIN LOGO -->
<div class="logo">
    <a href="index.html">
        <!--<img src="<? /*print TEMPLATES_DIR2;*/ ?>assets/pages/img/logo-big.png" alt="" />--> </a>
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content">
	<!--slot=0-->
<!-- BEGIN LOGIN FORM -->
<style>
.login{
	/* background-image:url(/templates/images/yabo3838-login-bk.png?cache=100); */
}

</style>
<form class="login-form" action="/agent/login_check" method="post">
	<!--<div><img src="/templates/images/logo.jpg" width="100%"></div>-->
    <!--<h3 class="form-title">代理登入介面</h3>-->
    <div class="chang-lang-div">
    	<select id="change-lang" onchange="change_lang(this.value);">
        	<!--slot=1-->

<option value="tw" selected>繁體中文</option>


        </select>
    </div>
    <div class="alert alert-danger display-hide">
        <button class="close" data-close="alert"></button>
        <span>帳密錯誤!</span>
    </div>
    <div class="form-group">
        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
        <label class="control-label visible-ie8 visible-ie9">代理帳號</label>
        <div class="input-icon">
            <i class="fa fa-user"></i>
            <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="代理帳號" name="luserid" value="" /> </div>
    </div>
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">代理密碼</label>
        <div class="input-icon">
            <i class="fa fa-lock"></i>
            <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="代理密碼" name="lpassword" value="" /> </div>
    </div>
    <div class="form-group">
    	<input type="checkbox" value="1" name="remember" /> <span style="color:#FFF;">記住我的帳密</span>
    </div>
    <div class="form-actions">
        <!--<label class="checkbox">
            <input type="checkbox" name="remember" value="1" /> Remember me </label>-->
        <button type="submit" class="btn login-btn"> 代理登入 </button>
        <div class="clear"></div>
    </div>
    <input type="hidden" name="paction" value="login-processing">
</form>
<!-- END LOGIN FORM -->
 
</div>
    	<!-- BEGIN PAGE FIRST SCRIPTS -->
        <script src="/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="/templates/js/jquery.cookie.js" type="text/javascript"></script>
        <!-- END PAGE FIRST SCRIPTS -->
        <!--[if lt IE 9]>
<script src="/assets/global/plugins/respond.min.js"></script>
<script src="/assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <noscript src="/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></noscript>
        <script src="/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <noscript src="/assets/global/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></noscript>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="/assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
        
        <script src="layer/layer.js"></script>
        <script src="/templates/js/kang_ajax.js"></script>
        <script src="/templates/js/kang_common.js?c=105"></script>
		<script src="/templates/js/lang/tw.js?cache=100"></script>
        <script src="/templates/js/login/login.js?cache=210" type="text/javascript"></script>

    </body>
</html>