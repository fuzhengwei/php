<?php 
//开启session
session_start();
//引入经常常量
require_once '../util/StackConst.php';
if (isset ( $_SESSION ['userLoginMessage'] )){
	$emp_name = $_SESSION ['userLoginMessage'];
	
}else{
	echo "请先登录";
	StackConst::jump_page("../backstage.php");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>REA1-后台控制管理</title>
		<link rel="stylesheet" href="res/scripts/components/easyui/themes/default/easyui.css" type="text/css" />
		<link rel="stylesheet" href="res/scripts/components/easyui/themes/icon.css" type="text/css" />
		<link rel="stylesheet" href="res/styles/main.css" type="text/css" />
		<link rel="stylesheet" href="res/styles/common.css" type="text/css" />

		<script type="text/javascript" src="res/scripts/lib/jquery.min.js"></script>
	    <script type="text/javascript" src="res/scripts/components/easyui/jquery.easyui.min.js"></script>
		<script type="text/javascript" src="res/scripts/common/main.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				top.menuCall('&nbsp;&nbsp;REA1&nbsp;&nbsp;','welcome.html',false);
				tabCloseEven();

				showtime();
			});
			
			function showtime(){
			
				var d = new Date();
				var year = d.getFullYear();
				var month = d.getMonth() + 1;
				var day = d.getDate();
				
				var h=d.getHours()
				var m=d.getMinutes()
				var s=d.getSeconds()
				
				if(m < 10){
					m ="0"+m;
					
				}else if(s < 10){
					s = "0"+s;
				}

				var nowtime;
				nowtime = year+"/"+month+"/"+day+" "+h+":"+m+":"+s;
				
				$(".north-tool-wrap div font").html(nowtime);
				
				setTimeout('showtime()',500);
			}
		</script>
	</head>
    <body class="easyui-layout">
		<div region="north" class="north-back-main" style="height:80px" border="false" ondblclick="menuTop()">
			<!--<div class="north-back-logo"></div>-->
			<div class="north-tool-wrap">
				<div style="padding-left:160px; color:#FFFFFF;">
					<font color="#FF0000"></font> <span>欢迎<?php echo $_SESSION ['userLoginMessage'];?>登录</span>
				</div>
				<div style="padding:25px 0px 0px 400px;">
					<a href="../backstage.html"><span class="icon-exitsystem"></span></a>
				</div>
			</div>
		</div>
		<div region="west" split="true" title="&nbsp;管理选项 &gt;&gt;操作菜单" icon="icon-destop"
			style="width: 280px;overflow: hidden;">
			<div class="easyui-accordion" fit="true" border="true" animate="false" style="padding-bottom:0.5px;">
				<!--雇员管理
				<div title="&nbsp;雇员管理" icon="icon-menu" style="padding:10px;">
					<div style="padding: 5px 0pt 5px 10px;">
						<a href="javascript:void(0)" onclick="javascript:top.menuCall('雇员列表','emp/emplist.html');">
            				<span class="icon-submenu-frame icon-submenu"></span>雇员列表
               			</a>
               		</div>
					<div style="padding: 5px 0pt 5px 10px;">
						<a href="javascript:void(0)" onclick="javascript:top.menuCall('新增雇员','emp/empadd.html');">
            				<span class="icon-submenu-frame icon-submenu"></span>新增雇员
               			</a>
               		</div>
				</div>
				-->
				<!--图片资源管理-->
				<div title="&nbsp;图片资源管理" icon="icon-menu" style="padding:10px;">
					<div style="padding: 5px 0pt 5px 10px;">
						<a href="javascript:void(0)" onclick="javascript:top.menuCall('图片列表','resourcepic/view/piclist.php');">
            				<span class="icon-submenu-frame icon-submenu"></span>图片列表
               			</a>
               		</div>
					<div style="padding: 5px 0pt 5px 10px;">
						<a href="javascript:void(0)" onclick="javascript:top.menuCall('新增图片','resourcepic/view/picadd.php');">
            				<span class="icon-submenu-frame icon-submenu"></span>新增图片
               			</a>
               		</div>
				</div>
				
				<!--文件资源管理-->
				<div title="&nbsp;文件资源管理" icon="icon-menu" style="padding:10px;">
					<div style="padding: 5px 0pt 5px 10px;">
						<a href="javascript:void(0)" onclick="javascript:top.menuCall('文件列表','resourcefile/view/filelist.php');">
            				<span class="icon-submenu-frame icon-submenu"></span>文件列表
               			</a>
               		</div>
					<div style="padding: 5px 0pt 5px 10px;">
						<a href="javascript:void(0)" onclick="javascript:top.menuCall('新增文件','resourcefile/view/fileadd.php');">
            				<span class="icon-submenu-frame icon-submenu"></span>新增文件
               			</a>
               		</div>
				</div>
				
				<!--产品中心管理-->
				<div title="&nbsp;产品中心管理" icon="icon-menu" style="padding:10px;">
					<div style="padding: 5px 0pt 5px 10px;">
						<a href="javascript:void(0)" onclick="javascript:top.menuCall('产品列表','product/view/productlist.php');">
            				<span class="icon-submenu-frame icon-submenu"></span>产品列表
               			</a>
               		</div>
					<div style="padding: 5px 0pt 5px 10px;">
						<a href="javascript:void(0)" onclick="javascript:top.menuCall('新增产品','product/view/productadd.php');">
            				<span class="icon-submenu-frame icon-submenu"></span>新增产品
               			</a>
               		</div>
					<div style="padding: 5px 0pt 5px 10px;">
						<a href="javascript:void(0)" onclick="javascript:top.menuCall('产品类别列表','product/view/categorylist.php');">
            				<span class="icon-submenu-frame icon-submenu"></span>产品类别列表
               			</a>
               		</div>
					<div style="padding: 5px 0pt 5px 10px;">
						<a href="javascript:void(0)" onclick="javascript:top.menuCall('新增产品类别','product/view/categoryadd.php');">
            				<span class="icon-submenu-frame icon-submenu"></span>新增产品类别
               			</a>
               		</div>
				</div>
				
				<!--新闻中心管理-->
				<div title="&nbsp;新闻中心管理" icon="icon-menu" style="padding:10px;">
					<div style="padding: 5px 0pt 5px 10px;">
						<a href="javascript:void(0)" onclick="javascript:top.menuCall('新闻列表','news/view/newslist.php');">
            				<span class="icon-submenu-frame icon-submenu"></span>新闻列表
               			</a>
               		</div>
					<div style="padding: 5px 0pt 5px 10px;">
						<a href="javascript:void(0)" onclick="javascript:top.menuCall('添加新闻','news/view/newsadd.php');">
            				<span class="icon-submenu-frame icon-submenu"></span>添加新闻
               			</a>
               		</div>
				</div>
				
				<!--服务支持源管理-->
				<div title="&nbsp;服务支持源管理" icon="icon-menu" style="padding:10px;">
					<div style="padding: 5px 0pt 5px 10px;">
						<a href="javascript:void(0)" onclick="javascript:top.menuCall('资料下载列表','support/view/resdownlist.php');">
            				<span class="icon-submenu-frame icon-submenu"></span>资料下载列表
               			</a>
               		</div>
					<div style="padding: 5px 0pt 5px 10px;">
						<a href="javascript:void(0)" onclick="javascript:top.menuCall('新增资料下载','support/view/resdownadd.php');">
            				<span class="icon-submenu-frame icon-submenu"></span>新增资料下载
               			</a>
               		</div>
					
					<div style="padding: 5px 0pt 5px 10px;">
						<a href="javascript:void(0)" onclick="javascript:top.menuCall('技术解答列表','support/view/resanswerlist.php');">
            				<span class="icon-submenu-frame icon-submenu"></span>技术解答列表
               			</a>
               		</div>
					<div style="padding: 5px 0pt 5px 10px;">
						<a href="javascript:void(0)" onclick="javascript:top.menuCall('新增技术解答','support/view/resansweradd.php');">
            				<span class="icon-submenu-frame icon-submenu"></span>新增技术解答
               			</a>
               		</div>
					
					<div style="padding: 5px 0pt 5px 10px;">
						<a href="javascript:void(0)" onclick="javascript:top.menuCall('技术支持列表','support/view/restecslist.php');">
            				<span class="icon-submenu-frame icon-submenu"></span>技术支持列表
               			</a>
               		</div>
					<div style="padding: 5px 0pt 5px 10px;">
						<a href="javascript:void(0)" onclick="javascript:top.menuCall('新增技术支持','support/view/restecsadd.php');">
            				<span class="icon-submenu-frame icon-submenu"></span>新增技术支持
               			</a>
               		</div>
				</div>
				
				<!--招聘信息管理-->
				<div title="&nbsp;招聘信息管理" icon="icon-menu" style="padding:10px;">
					<div style="padding: 5px 0pt 5px 10px;">
						<a href="javascript:void(0)" onclick="javascript:top.menuCall('招聘信息列表','inrea1/view/inrea1recruitmentlist.php');">
            				<span class="icon-submenu-frame icon-submenu"></span>招聘信息列表
               			</a>
               		</div>
					<div style="padding: 5px 0pt 5px 10px;">
						<a href="javascript:void(0)" onclick="javascript:top.menuCall('新增招聘信息','inrea1/view/inrea1recruitmentadd.php');">
            				<span class="icon-submenu-frame icon-submenu"></span>新增招聘信息
               			</a>
               		</div>
					<div style="padding: 5px 0pt 5px 10px;">
						<a href="javascript:void(0)" onclick="javascript:top.menuCall('招聘信息类别列表','inrea1/view/inrea1categorylist.php');">
            				<span class="icon-submenu-frame icon-submenu"></span>招聘信息类别列表
               			</a>
               		</div>
					<div style="padding: 5px 0pt 5px 10px;">
						<a href="javascript:void(0)" onclick="javascript:top.menuCall('新增招聘类别信息','inrea1/view/inrea1categoryadd.php');">
            				<span class="icon-submenu-frame icon-submenu"></span>新增招聘类别信息
               			</a>
               		</div>
				</div>
				
				<!--联络我们管理
				<div title="&nbsp;联络我们管理" icon="icon-menu" style="padding:10px;">
					<div style="padding: 5px 0pt 5px 10px;">
						<a href="javascript:void(0)" onclick="javascript:top.menuCall('联络我们信息','resourcefile/filelist.html');">
            				<span class="icon-submenu-frame icon-submenu"></span>联络我们信息
               			</a>
               		</div>
					<div style="padding: 5px 0pt 5px 10px;">
						<a href="javascript:void(0)" onclick="javascript:top.menuCall('新增联络我们','resourcefile/fileadd.html');">
            				<span class="icon-submenu-frame icon-submenu"></span>新增联络我们
               			</a>
               		</div>
				</div>
				-->
				<!--关于我们管理
				<div title="&nbsp;关于我们管理" icon="icon-menu" style="padding:10px;">
					<div style="padding: 5px 0pt 5px 10px;">
						<a href="javascript:void(0)" onclick="javascript:top.menuCall('公司简介信息','resourcefile/filelist.html');">
            				<span class="icon-submenu-frame icon-submenu"></span>公司简介信息
               			</a>
               		</div>
					<div style="padding: 5px 0pt 5px 10px;">
						<a href="javascript:void(0)" onclick="javascript:top.menuCall('新增公司简介信息','resourcefile/fileadd.html');">
            				<span class="icon-submenu-frame icon-submenu"></span>新增公司简介信息
               			</a>
               		</div>
					
				</div>
				-->
			</div>
		</div>
		<div region="center">
			<div id="main-center" class="easyui-tabs" fit="true" border="false">
				<!--选项卡右键功能-->			
				<div id="mm" class="easyui-menu" style="width:150px;">
			        <div id="mm-tabclose">关闭</div>
			        <div id="mm-tabcloseall">关闭所有</div>
			        <div id="mm-tabcloseother">关闭其它页面</div>
			        <div class="menu-sep"></div>
			        <div id="mm-tabcloseright">关闭右侧所有页面</div>
			        <div id="mm-tabcloseleft">关闭左侧所有页面</div>
	  			</div>
			</div>
		</div>
		<div region="south" class="south-back-main" style="height:36px" border="false">
			<table width="100%" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td align="center">REA1后台管理中心--版权所有--盗版必究</td>
				</tr>
			</table>
		</div>
	</body>
</html>

