<?php
header ( 'Content-type: text/html; charset=utf-8' ); 
require_once '../../case/dao/CaseDao.php';
session_start();
$resource_case_id = @$_GET['resource_case_id'];
$resource_case_title = @$_GET['resource_case_title'];
/*
 * 逻辑判断如果恶意进入此页面会跳转到caselist.php页面
 */

//获取案例列表
$caseDao = new CaseDao();
$arrCaseDetail = $caseDao->getCaseDetailById($resource_case_id);

//获取评论信息列表
$caseDiscussList = $caseDao->getCaseDiscussListById($resource_case_id);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $resource_case_title;?></title>
<link type="text/css" rel="stylesheet" href="../../zcss/casedetail.css">
<link rel="stylesheet" title="Default" href="../../zjs/highlight/default.css">
<script src="../../zjs/highlight/highlight.pack.js"></script>
<script>
	  hljs.tabReplace = '    ';
	  hljs.initHighlightingOnLoad();
</script>
<script language="javascript" type="text/javascript" src="../../zjs/jquery-1.8.3.js"></script>
<script language="javascript" type="text/javascript" src="../../zjs/jquery.corner.js"></script>
<script language="javascript" type="text/javascript">
$(function(){

	$(".discussContent,.discussDiv ul li").corner();

	//鼠标移除去掉提示内容
	$("#submitDis").mouseout(function(){
		$("#prompt").text("");
	});
});
//验证
function subFcs(){
	//验证评论内容是否为空
	if("" == $(".discussContent").val()){
		$("#prompt").text("评论内容不能为空！");
		return false;
	}

	if($(".discussContent").val().length < 20 || $(".discussContent").val().length > 500){
		$("#prompt").text("评论内容20到500字！");
		return false;
	}
}
</script>
</head>

<body>

<div class="topDiv">
		<div class="logoDiv">
			<ul>
				<li id="logo"><a href="../../../index.php" style="color: white;text-decoration: none;">ITstack</a></li>
				<li id="logo_cn"><a href="caselist.php" style="color:#CCCCCC;text-decoration: none;">案例仓库</a></li>
				<li id="login">
					<?php 
						if (isset ( $_SESSION ['userLoginMessage'] )) {
					?>
							<a><?php echo $_SESSION ['userLoginMessage']['user_name']?></a>
							|
							<a href="../control/caseusercontrol.php?type=logout" target="_parent" style="color: #CCCCCC;text-decoration:none;">注销</a>
					<?php		
						}else{
					?>
							<a href="caseuserlogin.php" target="_blank" style="color: #CCCCCC;text-decoration:none;">登录</a>
							|
							<a href="caseuserregister.php" target="_blank" style="color: #CCCCCC;text-decoration:none;">注册</a>
					<?php		
						}
					?>
					|
					<a href="caseissue.php" target="_blank" style="color: #CCCCCC;text-decoration:none;">发表案例</a></li>
			</ul>
		</div>
		
		<div class="casestack">
		</div>
</div>

<!--内容区域-->
<div class="bodyDiv">
	<!--案例详情-->
	<div class="caseDetail">
		<!--显示发表案例的用户信息[用户头像]-->
		<div class="userDiv"><img src="../../user/userimg/<?php echo $arrCaseDetail['user_head_img_name']?>" width="150" height="150"/></div>
		<div class="userTopDiv"></div>
		<div class="userName">
			<ul>
				<li><?php echo $arrCaseDetail['user_name'];?></li>
			</ul>
		</div>
		
		<!--case案例区域-->
		<div class="caseContent">
			<div class="caseContentTop"></div>
			<!--内容填充区-->
			<div class="caseContentBody">
				<ul>
					<li class="caseTitle"><?php echo $arrCaseDetail['resource_case_title'];?></li>
					<li class="caseDatas">板块:<?php echo $arrCaseDetail['resource_case_language'];?>
										     时间:<?php echo $arrCaseDetail['resource_case_data'];?>
					</li>
					<li>
						<pre>
							<code><?php echo $arrCaseDetail['resource_case_content'];?></code>
						</pre>
					</li>
					<li style="float:right; margin-right:5px;">结案例</li>
					<li></li>
				</ul>
			</div>
			<div class="caseContentBottom"></div>
		</div>
	</div>
	
	<!--评论详情-->
	<table>
	<?php 
		$var_num = 0;
		foreach ($caseDiscussList as $caseDiscuss){
	?>
		<tr>
			<td valign="top">
			<!-- 显示发表案例的用户信息[用户头像] -->
			<div class="userDiv"><img src="../../user/userimg/<?php echo $caseDiscuss['user_head_img_name']?>" width="150" height="150"/></div>
			<div class="userTopDiv"></div>
			<div class="userName">
				<ul>
					<li><?php echo $caseDiscuss['user_name'];?></li>
				</ul>
			</div>
			</td>
			
			<td valign="top">
			<!-- case案例区域 -->
			<div class="caseContent">
				<div class="caseContentTop"></div>
				<!-- 内容填充区 -->
				<div class="caseContentBody">
					<ul>
						<li class="caseDatas">时间:<?php echo $caseDiscuss['resource_case_discuss_data'];?></li>
						<li>
							<div>
								<pre>
									<code><?php echo $caseDiscuss['resource_case_discuss_content'];?>
									</code>
								</pre>
							</div>
						</li>
						<li style="float:right; margin-right:5px;">#<?php echo (++$var_num);?></li>
						<li></li>
					</ul>
				</div>
				<div class="caseContentBottom"></div>
			</div>
			</td>
		</tr>
	<?php		
		}
	?>
	
	<?php
		//如果没有登录那么不显示这个评论框 
		if (isset ( $_SESSION ['userLoginMessage'] )) {
	?>
		<tr>
			<td valign="top">
				<!--显示发表案例的用户信息[用户头像]-->
				<div class="userDiv"><img src="../../user/userimg/<?php echo $_SESSION ['userLoginMessage']['user_head_img_name']?>" width="150" height="150"/></div>
				<div class="userTopDiv"></div>
				<div class="userName">
					<ul>
						<li><?php echo $_SESSION ['userLoginMessage']['user_name']?></li>
					</ul>
				</div>
			</td>
			
			<td valign="top">
				<form action="../control/caseusercontrol.php" method="post">
					<input type="hidden" value="discuss" name="type"/>
					<input type="hidden" value="<?php echo $resource_case_id;?>" name="fk_resource_case_id"/>
					<div class="discussDiv">
						<textarea class="discussContent" name="resource_case_discuss_content"></textarea>
						<ul>
							<li><input type="submit" id="submitDis" value="提交评论" onclick="return subFcs()"/>						
							</li>
							<li style="background-color:red; color: #CCCCCC;"><span id="prompt"></span></li>
						</ul>
					</div>
				</form>
			</td>
		</tr>
	<?php		
		}
	?>
		
	</table>
</div>

</body>
</html>
