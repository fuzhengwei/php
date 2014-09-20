<?php 
require_once '../../../util/StackConst.php';
require_once '../dao/CaseDao.php';
session_start ();

//如果没有登录，那么跳转到登录页面
if(!isset ( $_SESSION ['userLoginMessage'] )){
	StackConst::jump_page("caseuserlogin.php");
}

//实例化
$caseDao = new CaseDao();
//获得语言分类
$languageSorts = $caseDao->getLanguageSort();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>caseissue</title>
<link type="text/css" rel="stylesheet" href="../../zcss/caseissue.css" />
<script language="javascript" type="text/javascript" src="../../zjs/jquery-1.8.3.js"></script>
<script language="javascript" type="text/javascript" src="../../zjs/jquery.corner.js"></script>
<script language="javascript" type="text/javascript">
$(function(){
	//圆角
	$("#userHeadImg,.userName,.issueTitle,#resource_case_title,.issueSort,#resource_case_language,#resource_case_content,#issueCaseSub").corner();
	
	$("#issueCaseSub").click(function(e){
		var Pbcss =  (e.pageY-100) + "px 0px 0px "+ (e.pageX-200)+"px";
	
		//验证内容提示
		if($("#resource_case_content").val().length < 10 || $("#resource_case_title").val() > 5000){
			$(".promptbox").fadeIn("slow").css({ margin:Pbcss}).text("内容10到5000个字符！");
		}
	
		//验证标题提示
		if($("#resource_case_title").val().length < 10 || $("#resource_case_title").val() > 100){
			$(".promptbox").fadeIn("slow").css({ margin:Pbcss}).text("标题10到100个字符！");
		}
	
	});
	
	//只要点击页面，提示就消失
	$("body").click(function(){
		$(".promptbox").fadeOut("slow");
	});
	
	//单独验证标题
	$("#resource_case_title").focus(function(){
		//如果里面内容为系统提示，那么清空
		if("请输入案例标题内容" == $(this).val()){
			$(this).val("");
		}
	});
	
	//单独验证提示
	$("#resource_case_title").mouseout(function(e){
		if("" == $(this).val()){
			var Pbcss =  (e.pageY-100) + "px 0px 0px "+ (e.pageX-200)+"px";
			$(".promptbox").fadeIn("slow").css({ margin:Pbcss}).text("请输入标题内容！");
		}
	});
	
	//单独验证内容区域
	
	$("#resource_case_content").mouseout(function(e){
		if("" == $(this).val()){
			var Pbcss =  (e.pageY-100) + "px 0px 0px "+ (e.pageX-200)+"px";
			$(".promptbox").fadeIn("slow").css({ margin:Pbcss}).text("请输入案例内容！");
		}
	});
	
	//淡出
	$("#issueCaseSub").mousemove(function(){
		$(".promptbox").fadeOut("slow");
	});
	
	
});




//提交验证
function verification(){
	
	//标题长度验证
	if($("#resource_case_title").val().length < 10 || $("#resource_case_title").val() > 100){
		return false;
	}
	
	//内容长度验证
	if($("#resource_case_content").val().length < 10 || $("#resource_case_title").val() > 5000){
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
			</ul>
		</div>
		
		<div class="casestack">
		</div>
</div>
<!--发表案例-->
<div class="issueDiv">
	<div class="userDiv">
		<img id="userHeadImg" src="../../user/userimg/<?php echo $_SESSION ['userLoginMessage']['user_head_img_name']?>" width="150" height="150"/>
		<div class="userName"><?php echo $_SESSION ['userLoginMessage']['user_name']?></div>
	</div>
	<div class="issue">
		<form action="../control/caseusercontrol.php" method="post">
		<input type="hidden" value="caseissue" name="type"/>
		<div class="issueTitle"><input type="text" name="resource_case_title" id="resource_case_title" value="请输入案例标题内容"/></div>
		<div class="issueSort">
			<select id="resource_case_language" name="resource_case_language">
				<?php 
					foreach ($languageSorts as $language){
				?>
						<option value="<?php echo $language['language_sort_name'];?>"><?php echo $language['language_sort_name'];?></option>
				<?php		
					}
				?>
			</select>
		</div>
		<textarea id="resource_case_content" name="resource_case_content"></textarea>
		<input type="submit" value="提交案例" id="issueCaseSub" onclick="return verification()"/>
		</form>
	</div>
	<div class="promptbox"></div>
</div>

</body>
</html>
