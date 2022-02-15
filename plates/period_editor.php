
<!DOCTYPE html><!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]--><!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]--><!--[if !IE]><!--><html lang="en" class="no-js">	<!--<![endif]-->	<!-- BEGIN HEAD -->	<head>        <meta charset="utf-8"/>        <meta http-equiv="X-UA-Compatible" content="IE=edge">        <!--<meta content="width=device-width, initial-scale=1" name="viewport"/>-->        <meta content="" name="description"/>        <meta content="" name="keywords"/>        <meta content="" name="author"/>        <title>控端</title>        <!-- BEGIN PAGE TOP STYLES -->        <!-- END PAGE TOP STYLES -->        <!-- BEGIN GLOBAL MANDATORY STYLES -->        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />        <!-- END GLOBAL MANDATORY STYLES -->        <!-- BEGIN PAGE LEVEL PLUGINS -->        <link href="/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />        <link href="/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />        <!-- END PAGE LEVEL PLUGINS -->        <!-- BEGIN THEME GLOBAL STYLES -->        <link href="/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />        <link href="/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />        <!-- END THEME GLOBAL STYLES -->        <!-- BEGIN THEME LAYOUT STYLES -->        <link href="/assets/layouts/layout/css/self-layout.css" rel="stylesheet" type="text/css" />        <link href="/assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />        <link href="/assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />        <!-- END THEME LAYOUT STYLES -->        <link href="/templates/css/style.css?cache=209" rel="stylesheet" type="text/css"/>		<link href="/templates/css/tw_style.css?cache=205" rel="stylesheet" type="text/css"/>                <!-- BEGIN PAGE FIRST SCRIPTS -->        <script src="/assets/global/plugins/jquery.min.js" type="text/javascript"></script>        <!-- END PAGE FIRST SCRIPTS -->        <link rel="shortcut icon" href="#"/>	</head>	<!-- END HEAD -->	<body>       <div class="page-inner-content">
	<!--slot=0-->
<style>
.page-bar .act-group {
    margin-right: 10px;
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
.setting-tb .period-name, .setting-tb .min-payment-amount{
	width:250px;
}
	
.fl-l{
	float: left;
}
.ml-10{
	margin-left: 10px;
}
</style>
<div class="page-bar">
	<div class="act-group">
		<button class="btn btn-danger" type="button" onclick="save_period()">確定儲存</button>
    </div>
    <div class="act-group">
		<button class="btn green-sharp btn-large" type="button" onclick="location.href='/admin/period_manager?edit_unique_code=3'">回上頁</button>
    </div>
</div>
<form id="save-period-form">
<table class="setting-tb">
	<tr>
    	<td class="title">期數名稱</td>
        <td><input type="text" name="period_name" class="period-name" value="<?=e($data->name)?>"></td>
    </tr>
	<tr>
    	<td class="title">結轉項目</td>
        <td>
			<select name="ckout_item" onChange="change_ckout_item();">
				<option  value="0" >--請選擇--</option>
				<!--slot=1-->

                <option  value="1" <?=$data->ckout_item==1?'selected="selected"':''?>> 退佣</option>

                <option  value="2"  <?=$data->ckout_item==2?'selected="selected"':''?>> 退水</option>

                <option  value="3"  <?=$data->ckout_item==3?'selected="selected"':''?>> 總輸贏</option>
			</select>
		</td>
    </tr>
	<tr>
    	<td class="title">結轉類型</td>
        <td>
			<select name="ckout_type" onChange="change_ckout_type();">
				<option  value="0">--請選擇--</option>
				<!--slot=1-->

                <option  value="1" <?=$data->ckout_type==1?'selected="selected"':''?>> 固定月結</option>

                <option  value="4" <?=$data->ckout_type==4?'selected="selected"':''?>> 固定周結</option>

                <option  value="2" <?=$data->ckout_type==2?'selected="selected"':''?>> 固定日結</option>

                <option  value="3" <?=$data->ckout_type==3?'selected="selected"':''?>> 手動設定</option>


			</select>
		</td>
    </tr>
	<tr class="datetime-tr">
    	<td class="title">開始時間</td>
        <td>
			<div class="fl-l">
				<div class="input-group input-small date date-picker sddate" data-date="<?= $etype =='edit'? explode(' ',$data->start_date)[0]:date('Y-m-d')?>" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
					<input type="text" class="form-control" name="start_date" value="<?= $etype =='edit'? explode(' ',$data->start_date)[0]:date('Y-m-d')?>" readonly>
					<span class="input-group-btn">
						<button class="btn default" type="button">
						<i class="fa fa-calendar"></i>
						</button>
					</span>
				</div>
			</div>
			<div class="fl-l ml-10">
				<div class="input-group input-small start-time">
					<input type="text" name="start_time" value="<?= $etype =='edit'? explode(' ',$data->start_date)[1]:date('H:i:s') ?>" class="form-control timepicker timepicker-24" readonly>
					<span class="input-group-btn">
						<button class="btn default" type="button">
							<i class="fa fa-clock-o"></i>
						</button>
					</span>
				</div>
			</div>
		</td>
    </tr>
	<tr class="datetime-tr">
    	<td class="title">結束時間</td>
        <td>
			<div class="fl-l">
				<div class="input-group input-small date date-picker eddate" data-date="<?= $etype =='edit'? explode(' ',$data->end_date)[0]:date('Y-m-d')?>" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
					<input type="text" class="form-control" name="end_date" value="<?= $etype =='edit'? explode(' ',$data->end_date)[0]:date('Y-m-d')?>" readonly>
					<span class="input-group-btn">
						<button class="btn default" type="button">
						<i class="fa fa-calendar"></i>
						</button>
					</span>
				</div>
			</div>
			<div class="fl-l ml-10">
				<div class="input-group input-small end-time">
					<input type="text" name="end_time" value="<?= $etype =='edit'? explode(' ',$data->end_date)[1]:date('H:i:s')?>" class="form-control timepicker timepicker-24" readonly>
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
    	<td class="title">最小支付金額</td>
        <td><input type="text" name="min_payment_amount" class="min-payment-amount" value="<?=e($data->	min_payment_amount)?>"></td>
    </tr>
	<tr>
		<td class="title">套用期數規則</td>
		<td>
            <div class="rule-ckbx-div" ckout_item="1">
                <?php if (count($cr) == 0) {?>
                    <span class="color-red1">目前無未套用之佣金規則!</span>
                <?php } else {?>
                    <input type="checkbox" class="item-ckbox-all" spot="commission_rule_id">全部
                    <?php foreach($cr as $item) {?>
                        <input type="checkbox" class="item-ckbox" name="commission_rule_id_arr[]" value="<?=$item->id?>" spot="commission_rule_id" <?= $data->ckout_item == 1&&in_array($item->id,$ckout_items)?'checked':''?>><?=$item->name?>
                    <?php }?>
                <?php }?>
            </div>
            <div class="rule-ckbx-div" ckout_item="2">
                <?php if (count($rr) == 0) {?>
                    <span class="color-red1">目前無未退水之佣金規則!</span>
                <?php } else {?>
                    <input type="checkbox" class="item-ckbox-all" spot="retreat_rule_id">全部
                    <?php foreach($rr as $item) {?>
                        <input type="checkbox" class="item-ckbox" name="retreat_rule_id_arr[]" value="<?=$item->id?>" spot="retreat_rule_id" <?= $data->ckout_item == 2&&in_array($item->id,$ckout_items)?'checked':''?>><?=$item->name?>
                    <?php }?>
                <?php }?>
            </div>
            <div class="rule-ckbx-div" ckout_item="3">
                <?php if (count($ecr) == 0) {?>
                    <span class="color-red1">目前無未套用之總輸贏規則!</span>
                <?php } else {?>
                    <input type="checkbox" class="item-ckbox-all" spot="extra_commission_rule_id">全部
                    <?php foreach($ecr as $item) {?>
                        <input type="checkbox" class="item-ckbox" name="extra_commission_rule_id_arr[]" value="<?=$item->id?>" spot="extra_commission_rule_id" <?= $data->ckout_item == 3&&in_array($item->id,$ckout_items)?'checked':''?>><?=$item->name?>
                    <?php }?>
                <?php }?>
            </div>
        </td>
	</tr>
</table>
</form>
<input type="hidden" id="etype" value="<?=e($etype)?>" />
<input type="hidden" id="edit-period-id" value="<?=e($data->id)?>" />
<input type="hidden" id="today-date" value="<?=date('Y-m-d')?>" />
<input type="hidden" id="edit-unique-code" name="edit_unique_code" value="3" />

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
        <script src="/templates/js/period/editor.js?cache=158" type="text/javascript"></script>
    </body>
</html>