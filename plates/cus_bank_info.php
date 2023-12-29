<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
	<!--<![endif]-->
	<!-- BEGIN HEAD -->
	<head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!--<meta content="width=device-width, initial-scale=1" name="viewport"/>-->
        <meta content="" name="description"/>
        <meta content="" name="keywords"/>
        <meta content="" name="author"/>
        <title>銀行卡</title>
        <!-- BEGIN PAGE TOP STYLES -->
        <!-- END PAGE TOP STYLES -->
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
        <link href="/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="/assets/layouts/layout/css/self-layout.css" rel="stylesheet" type="text/css" />
        <link href="/assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="/assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <link href="/templates/css/style.css?cache=206" rel="stylesheet" type="text/css"/>
		<link href="/templates/css/tw_style.css?cache=205" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="/templates/css/cus_bank_info.css?c=105" >

        <!-- BEGIN PAGE FIRST SCRIPTS -->
        <script src="/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <!-- END PAGE FIRST SCRIPTS -->
        <!--<link rel="shortcut icon" href=""/>-->
	</head>
	<!-- END HEAD -->
	<body>
       <style>
html{
	overflow-y:auto;
}
</style>
<div class="page-inner-content">
	<!--slot=0-->
<div class="main-content">
	<table class="cus-bank-info-list-tb">
		<!--slot=3-->
        <?php foreach ($banks as $bank) {?>
        <tr>
            <td width="1"><i class="fa fa-credit-card"></i></td>
            <td class="cus-bank-info"><?=$bank->bank_name?>&nbsp;&nbsp;<?=$bank->bank_account?></td>
            <td width="1">
                <div class="show-detail-btn" onclick="request_cus_bank_info_detail('<?=$bank->id?>')">查看</div>
            </td>
        </tr>
        <?php } ?>
	</table>
	<div class="add-btn" onclick="add_cus_bank_info();">添加</div>
</div>
<div id="edit-cus-bank-info-area">
	<form id="edit-form">
		<table class="cus-bank-info-editor-tb">
			<tr>
				<td class="title">地區</td>
				<td>
					<select class="select-v1" onchange="change_bank_area(this.value)" id="back-area-select">
						<option value='taiwan'>台灣</option>
					</select>
				</td>
			</tr>
			<tr>
				<td class="title">開戶銀行</td>
				<td>
					<select name="bank_name" class="select-v1" id="bank-name-select"><option value="004 臺灣銀行">004 臺灣銀行</option><option value="005 土地銀行">005 土地銀行</option><option value="006 合作金庫">006 合作金庫</option><option value="007 第一銀行">007 第一銀行</option><option value="008 華南銀行">008 華南銀行</option><option value="009 彰化銀行">009 彰化銀行</option><option value="011 上海商業儲蓄銀行">011 上海商業儲蓄銀行</option><option value="012 台北富邦銀行">012 台北富邦銀行</option><option value="013 國泰世華銀行">013 國泰世華銀行</option><option value="016 高雄銀行">016 高雄銀行</option><option value="017 兆豐國際商業銀行">017 兆豐國際商業銀行</option><option value="018 農業金庫">018 農業金庫</option><option value="020 日商瑞穗銀行">020 日商瑞穗銀行</option><option value="021 花旗(台灣)商業銀行">021 花旗(台灣)商業銀行</option><option value="022 美國銀行">022 美國銀行</option><option value="023 盤谷銀行">023 盤谷銀行</option><option value="025 首都銀行">025 首都銀行</option><option value="039 澳商澳盛銀行">039 澳商澳盛銀行</option><option value="048 王道商業銀行">048 王道商業銀行</option><option value="050 臺灣企銀">050 臺灣企銀</option><option value="052 渣打國際商業銀行">052 渣打國際商業銀行</option><option value="053 台中商業銀行">053 台中商業銀行</option><option value="054 京城商業銀行">054 京城商業銀行</option><option value="072 德意志銀行">072 德意志銀行</option><option value="075 東亞銀行">075 東亞銀行</option><option value="081 匯豐(台灣)銀行">081 匯豐(台灣)銀行</option><option value="082 法國巴黎銀行">082 法國巴黎銀行</option><option value="101 瑞興銀行">101 瑞興銀行</option><option value="102 華泰銀行">102 華泰銀行</option><option value="103 臺灣新光商銀">103 臺灣新光商銀</option><option value="104 台北五信">104 台北五信</option><option value="108 陽信銀行">108 陽信銀行</option><option value="114 基隆一信">114 基隆一信</option><option value="115 基隆二信">115 基隆二信</option><option value="118 板信商業銀行">118 板信商業銀行</option><option value="119 淡水一信">119 淡水一信</option><option value="120 淡水信合社">120 淡水信合社</option><option value="124 宜蘭信合社">124 宜蘭信合社</option><option value="127 桃園信合社">127 桃園信合社</option><option value="130 新竹一信">130 新竹一信</option><option value="132 新竹三信">132 新竹三信</option><option value="146 台中二信">146 台中二信</option><option value="147 三信商業銀行">147 三信商業銀行</option><option value="158 彰化一信">158 彰化一信</option><option value="161 彰化五信">161 彰化五信</option><option value="162 彰化六信">162 彰化六信</option><option value="163 彰化十信">163 彰化十信</option><option value="165 鹿港信合社">165 鹿港信合社</option><option value="178 嘉義三信">178 嘉義三信</option><option value="188 台南三信">188 台南三信</option><option value="204 高雄三信">204 高雄三信</option><option value="215 花蓮一信">215 花蓮一信</option><option value="216 花蓮二信">216 花蓮二信</option><option value="222 澎湖一信">222 澎湖一信</option><option value="223 澎湖二信">223 澎湖二信</option><option value="224 金門信合社">224 金門信合社</option><option value="501 蘇澳漁會">501 蘇澳漁會</option><option value="502 頭城漁會">502 頭城漁會</option><option value="506 桃園漁會">506 桃園漁會</option><option value="507 新竹漁會">507 新竹漁會</option><option value="508 通苑漁會">508 通苑漁會</option><option value="510 南龍漁會">510 南龍漁會</option><option value="511 彰化漁會">511 彰化漁會</option><option value="512 雲林漁會">512 雲林漁會</option><option value="513 瑞芳漁會">513 瑞芳漁會</option><option value="514 萬里漁會">514 萬里漁會</option><option value="515 嘉義漁會">515 嘉義漁會</option><option value="516 基隆漁會">516 基隆漁會</option><option value="517 南市漁會">517 南市漁會</option><option value="518 南縣漁會">518 南縣漁會</option><option value="519 新化農會">519 新化農會</option><option value="521 彌陀區漁會">521 彌陀區漁會</option><option value="523 枋寮區漁會">523 枋寮區漁會</option><option value="524 新港漁會">524 新港漁會</option><option value="525 澎湖漁會">525 澎湖漁會</option><option value="526 金門漁會">526 金門漁會</option><option value="538 宜蘭農會">538 宜蘭農會</option><option value="541 白河農會">541 白河農會</option><option value="542 麻豆農會">542 麻豆農會</option><option value="547 後壁農會">547 後壁農會</option><option value="549 下營農會">549 下營農會</option><option value="551 官田農會">551 官田農會</option><option value="552 大內農會">552 大內農會</option><option value="556 學甲農會">556 學甲農會</option><option value="557 新市農會">557 新市農會</option><option value="558 安定農會">558 安定農會</option><option value="559 山上農會">559 山上農會</option><option value="561 左鎮農會">561 左鎮農會</option><option value="562 仁德農會">562 仁德農會</option><option value="564 關廟農會">564 關廟農會</option><option value="565 龍崎農會">565 龍崎農會</option><option value="567 南化農會">567 南化農會</option><option value="568 七股農會">568 七股農會</option><option value="570 南投農會">570 南投農會</option><option value="573 埔里農會">573 埔里農會</option><option value="574 竹山農會">574 竹山農會</option><option value="575 中寮農會">575 中寮農會</option><option value="577 魚池農會">577 魚池農會</option><option value="578 水里農會">578 水里農會</option><option value="579 國姓農會">579 國姓農會</option><option value="580 鹿谷農會">580 鹿谷農會</option><option value="581 信義農會">581 信義農會</option><option value="582 仁愛農會">582 仁愛農會</option><option value="583 東山農會">583 東山農會</option><option value="585 頭城農會">585 頭城農會</option><option value="586 羅東農會">586 羅東農會</option><option value="587 礁溪農會">587 礁溪農會</option><option value="588 壯圍農會">588 壯圍農會</option><option value="589 員山農會">589 員山農會</option><option value="596 五結農會">596 五結農會</option><option value="598 蘇澳農會">598 蘇澳農會</option><option value="599 三星農會">599 三星農會</option><option value="600 農金資中心">600 農金資中心</option><option value="602 中華民國農會">602 中華民國農會</option><option value="605 高雄市農會">605 高雄市農會</option><option value="612 神岡農會">612 神岡農會</option><option value="613 名間鄉農會">613 名間鄉農會</option><option value="614 彰化地區農會">614 彰化地區農會</option><option value="615 基隆農會">615 基隆農會</option><option value="616 雲林地區農會">616 雲林地區農會</option><option value="617 嘉義地區農會">617 嘉義地區農會</option><option value="618 台南地區農會">618 台南地區農會</option><option value="619 高雄地區農會">619 高雄地區農會</option><option value="620 屏東地區農會">620 屏東地區農會</option><option value="621 花蓮地區農會">621 花蓮地區農會</option><option value="622 台東地區農會">622 台東地區農會</option><option value="624 澎湖農會">624 澎湖農會</option><option value="625 台中農會">625 台中農會</option><option value="627 連江縣農會">627 連江縣農會</option><option value="628 鹿港農會">628 鹿港農會</option><option value="629 和美農會">629 和美農會</option><option value="631 溪湖農會">631 溪湖農會</option><option value="632 田中農會">632 田中農會</option><option value="633 北斗農會">633 北斗農會</option><option value="635 線西農會">635 線西農會</option><option value="636 伸港農會">636 伸港農會</option><option value="638 花壇農會">638 花壇農會</option><option value="639 大村農會">639 大村農會</option><option value="642 社頭農會">642 社頭農會</option><option value="643 二水農會">643 二水農會</option><option value="646 大城農會">646 大城農會</option><option value="647 溪州農會">647 溪州農會</option><option value="649 埔鹽農會">649 埔鹽農會</option><option value="650 福興農會">650 福興農會</option><option value="651 彰化農會">651 彰化農會</option><option value="683 北港農會">683 北港農會</option><option value="685 土庫農會">685 土庫農會</option><option value="693 東勢鄉農會">693 東勢鄉農會</option><option value="696 水林農會">696 水林農會</option><option value="697 元長農會">697 元長農會</option><option value="698 麥寮農會">698 麥寮農會</option><option value="699 林內農會">699 林內農會</option><option value="749 內埔農會">749 內埔農會</option><option value="762 大溪農會">762 大溪農會</option><option value="763 桃園農會">763 桃園農會</option><option value="764 平鎮農會">764 平鎮農會</option><option value="765 楊梅農會">765 楊梅農會</option><option value="766 大園農會">766 大園農會</option><option value="767 蘆竹農會">767 蘆竹農會</option><option value="768 龜山農會">768 龜山農會</option><option value="769 八德農會">769 八德農會</option><option value="770 新屋農會">770 新屋農會</option><option value="771 龍潭農會">771 龍潭農會</option><option value="772 復興農會">772 復興農會</option><option value="773 觀音農會">773 觀音農會</option><option value="775 土城農會">775 土城農會</option><option value="776 三重農會">776 三重農會</option><option value="777 中和農會">777 中和農會</option><option value="778 淡水農會">778 淡水農會</option><option value="779 樹林農會">779 樹林農會</option><option value="780 鶯歌農會">780 鶯歌農會</option><option value="781 三峽農會">781 三峽農會</option><option value="785 蘆洲農會">785 蘆洲農會</option><option value="786 五股農會">786 五股農會</option><option value="787 林口農會">787 林口農會</option><option value="788 泰山農會">788 泰山農會</option><option value="789 坪林農會">789 坪林農會</option><option value="790 八里農會">790 八里農會</option><option value="791 金山農會">791 金山農會</option><option value="792 瑞芳農會">792 瑞芳農會</option><option value="793 新店農會">793 新店農會</option><option value="795 深坑農會">795 深坑農會</option><option value="796 石碇農會">796 石碇農會</option><option value="797 平溪農會">797 平溪農會</option><option value="798 石門農會">798 石門農會</option><option value="799 三芝農會">799 三芝農會</option><option value="803 聯邦商業銀行">803 聯邦商業銀行</option><option value="805 遠東銀行">805 遠東銀行</option><option value="806 元大銀行">806 元大銀行</option><option value="807 永豐銀行">807 永豐銀行</option><option value="808 玉山銀行">808 玉山銀行</option><option value="809 凱基銀行">809 凱基銀行</option><option value="810 星展(台灣)銀行">810 星展(台灣)銀行</option><option value="812 台新銀行">812 台新銀行</option><option value="815 日盛銀行">815 日盛銀行</option><option value="816 安泰銀行">816 安泰銀行</option><option value="822 中國信託">822 中國信託</option><option value="824 連線商業銀行">824 連線商業銀行</option><option value="826 樂天銀行">826 樂天銀行</option><option value="860 中埔農會">860 中埔農會</option><option value="866 阿里山農會">866 阿里山農會</option><option value="868 東勢區農會">868 東勢區農會</option><option value="869 清水農會">869 清水農會</option><option value="870 梧棲農會">870 梧棲農會</option><option value="871 大甲農會">871 大甲農會</option><option value="872 沙鹿農會">872 沙鹿農會</option><option value="874 霧峰農會">874 霧峰農會</option><option value="875 太平農會">875 太平農會</option><option value="876 烏日農會">876 烏日農會</option><option value="877 后里農會">877 后里農會</option><option value="878 大雅農會">878 大雅農會</option><option value="879 潭子農會">879 潭子農會</option><option value="880 石岡農會">880 石岡農會</option><option value="881 新社農會">881 新社農會</option><option value="882 大肚農會">882 大肚農會</option><option value="883 外埔農會">883 外埔農會</option><option value="884 大安農會">884 大安農會</option><option value="885 龍井農會">885 龍井農會</option><option value="886 和平農會">886 和平農會</option><option value="891 花蓮農會">891 花蓮農會</option><option value="895 瑞穗農會">895 瑞穗農會</option><option value="896 玉溪農會">896 玉溪農會</option><option value="897 鳳榮農會">897 鳳榮農會</option><option value="898 光豐農會">898 光豐農會</option><option value="901 大里農會">901 大里農會</option><option value="902 苗栗農會">902 苗栗農會</option><option value="903 汐止農會">903 汐止農會</option><option value="904 新莊農會">904 新莊農會</option><option value="906 頭份農會">906 頭份農會</option><option value="907 竹南農會">907 竹南農會</option><option value="908 通霄農會">908 通霄農會</option><option value="909 苑裡農會">909 苑裡農會</option><option value="912 冬山農會">912 冬山農會</option><option value="913 後龍農會">913 後龍農會</option><option value="914 卓蘭農會">914 卓蘭農會</option><option value="915 西湖農會">915 西湖農會</option><option value="916 草屯農會">916 草屯農會</option><option value="917 公館農會">917 公館農會</option><option value="918 銅鑼農會">918 銅鑼農會</option><option value="919 三義農會">919 三義農會</option><option value="920 造橋農會">920 造橋農會</option><option value="921 南庄農會">921 南庄農會</option><option value="922 臺南農會">922 臺南農會</option><option value="923 獅潭農會">923 獅潭農會</option><option value="924 頭屋農會">924 頭屋農會</option><option value="925 三灣農會">925 三灣農會</option><option value="926 大湖農會">926 大湖農會</option><option value="928 板橋農會">928 板橋農會</option><option value="929 關西農會">929 關西農會</option><option value="930 新埔農會">930 新埔農會</option><option value="931 竹北農會">931 竹北農會</option><option value="932 湖口農會">932 湖口農會</option><option value="933 芎林農會">933 芎林農會</option><option value="934 寶山農會">934 寶山農會</option><option value="935 峨眉農會">935 峨眉農會</option><option value="936 北埔農會">936 北埔農會</option><option value="937 竹東農會">937 竹東農會</option><option value="938 橫山農會">938 橫山農會</option><option value="939 新豐農會">939 新豐農會</option><option value="940 新竹農會">940 新竹農會</option><option value="951 北農中心">951 北農中心</option><option value="953 田尾農會">953 田尾農會</option><option value="984 北投農會">984 北投農會</option><option value="985 士林農會">985 士林農會</option><option value="986 內湖農會">986 內湖農會</option><option value="987 南港農會">987 南港農會</option><option value="988 木柵農會">988 木柵農會</option><option value="989 景美農會">989 景美農會</option></select>
				</td>
			</tr>
			<tr class="hidden">
				<td class="title">開戶省/市</td>
				<td>
					<select name="bank_province" class="select-v1" onchange="change_bank_province();">
						<!--JSO SELECT_BANK_PROVINCE_CONTENT -->
					</select>
					<select name="bank_city" class="select-v1">
						<!--JSO SELECT_BANK_CITY_CONTENT -->
					</select>
				</td>
			</tr>
			<tr>
				<td class="title">開戶支行</td>
				<td>
					<input type="text" name="bank_branch" class="input-v1" value="">
				</td>
			</tr>
			<tr>
				<td class="title">開戶姓名</td>
				<td>
					<input type="text" name="account_name" class="input-v1" value="">
				</td>
			</tr>
			<tr>
				<td class="title">銀行卡號</td>
				<td>
					<input type="text" name="bank_account" class="input-v1" value="">
				</td>
			</tr>
		</table>
	</form>
	<div class="save-btn" onclick="save_cus_bank_info();">儲存</div>
</div>
<input type="hidden" id="is-show-1" value="-1">
<div id="show-cus-bank-info-detail-area">
</div>

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
		<script src="/templates/js/kang_common.js?cache=104"></script>
		<script src="/templates/js/kang_all.js?cache=203"></script>
		<script src="/templates/js/lang/tw.js?cache=203"></script>
        <script src="/templates/js/bank.js?c=101" type="text/javascript"></script>
        <script src="/templates/js/cus_bank_info/cus_bank_info.js?cache=5" type="text/javascript"></script>

    </body>
</html>