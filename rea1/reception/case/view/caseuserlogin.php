<?php 
	//获得上一个页面
	$upPage = @$_SERVER["HTTP_REFERER"];
	//注册后跳转本页面获取登录用户名
	$user_name = @$_GET['user_name'];
	if("" == $user_name){
		$user_name = "请输入用户名";
	}
	
	//检查$upPage内容，如果是从注册页面来的，那么给它的路径为空
	if(strpos($upPage,"caseuserregister.php") || strpos($upPage,"caseusercontrol.php")){
		$upPage = "/index.php";
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>login</title>
<link type="text/css" rel="stylesheet" href="../../zcss/login_1.css" />
<script language="javascript" type="text/javascript" src="../../zjs/jquery-1.8.3.js"></script>
<script language="javascript" type="text/javascript" src="../../zjs/jquery.corner.js"></script>
<script language="javascript" type="text/javascript">
$(function(){
	//圆角
	$(".loginDiv,.infoDisplay,input").corner();
	
	//鼠标点进去的时候，清空里面系统给的内容
	$("#user_name").click(function(){
		
		if("请输入用户名" == $(this).val()){
			$(this).val("");
		}
	});

	//如果登录信息等于空，那么就把提示信息给它赋值
	$("#user_name").mouseout(function(){
		if("" == $(this).val()){
			$(this).val("请输入用户名");
		}
	});
	
	
	//加入动态效果
	$("#user_name,#user_pwd").mouseenter(function(){
		$(this).addClass("jq_user_name");
	}).mouseout(function(){
  		$(this).removeClass("jq_user_name");
	});
	
});

//定义验证函数
function verification(){

	//用户名不能为空
	if("" == $("#user_name").val() || "请输入用户名"== $("#user_name").val()){
		$("#user_name").addClass("jq_user_name");
		return false;
	}

	if("" == $("#user_pwd").val()){
		$("#user_pwd").addClass("jq_user_name");
		return false;
	}

	if($("#user_pwd").val().indexOf("or") >= 0 || $("#user_pwd").val().indexOf("OR") >= 0){
		return false;
	}

	if($("#user_pwd").val().indexOf("or") >= 0 || $("#user_pwd").val().indexOf("OR") >= 0){
		return false;
	}
	

}

</script>
</head> 

<body>
<div class="topDiv">
		<div class="logoDiv">
			<ul>
				<li id="logo"><a href="../../../index.php" style="color:#FFFFFF;text-decoration: none;">ITstack</a></li>
				<li id="logo_cn"><a href="caselist.php" style="color:#CCCCCC;text-decoration: none;">案例仓库</a></li>
				<li id="logo_cn"><a href="../../link/view/linklist.php" style="color:#CCCCCC;text-decoration: none;">链接仓库</a></li>
				<li id="logo_cn"><a href="../../picture/view/piclist.php" style="color:#CCCCCC;text-decoration: none;">糗图仓库</a></li>
			</ul>
		</div>
		
		<div class="casestack">
		</div>
</div>
<!--登录块-->
<div class="loginDiv">
	<form action="../control/caseusercontrol.php" method="post">
	<input type="hidden" value="userlogin" name="type"/>
	<input type="hidden" value="<?php echo $upPage;?>" name="upPageUrl"/>
	<ul>
		<li><input type="text" id="user_name" name="user_name" value="<?php echo $user_name;?>" title="请输入用户名"/></li>
		<li><input type="password" id="user_pwd" name="user_pwd" title="请输入密码"/></li>
		<li><input type="submit" value="登&nbsp;&nbsp;录" onclick="return verification()" style="background-color:#660000; color:#CCCCCC; font-size:24px; cursor:pointer; border:0;"/></li>
		<li>
			<span><a href="#">忘记密码</a></span>
			<span><a href="caseuserregister.php">注册用户</a></span>
		</li>
	</ul>
	</form>
</div>
<!--介绍区域-->
<div class="infoDisplay">
	<ul>
		<li><span style="font-size:32px; color:#CC3300; font-weight:bolder;">介绍</span></li>
		<li><span>本站主旨：</span>本站以建设书籍、文档、案例、源码、视频、工具、软件等程序员的it资料库为主旨。就像我们的站名一样itstack、程序员、程序员的仓库。不求一栈成名，但望一见钟情！</li>
		<li><span>本站介绍：</span>建站想法来源于本群[5307397]，有着广大群友朋友一样的支持，我们不求做到最好，只希望以此为锻炼学习。能给我们群里新手建设一个我们自己的资料库，程序员自己的百度，以及用自己学的东西，贡献给这个it事业！我们的资料不是最全的，但是我们的提供的资料一定准确可用的，不会让你盲目的寻找，又找不到想要的。再这里找资料，一定比你找对象方便，一定比你找工作快捷！</li>
		<li><span>参与建设人员[QQ号顺序]：</span>政委、陈琴、涵涵、小万、萌货、zero、苏二毛、安忆、杜令存、小潘</li>
	</ul>
</div>
</body>
</html>
