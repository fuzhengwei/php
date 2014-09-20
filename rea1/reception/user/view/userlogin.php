<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>user login</title>
<link type="text/css" rel="stylesheet" href="../../zcss/user.css" />
<script language="javascript" type="text/javascript" src="../../zjs/jquery-1.8.3.js"></script>

<script language="javascript" type="text/javascript">
	$(function(){
	
		$("#submit").click(function(){
				
			$("form:first").submit();	
				
		});
	
	});
</script>
</head>

<body>
<!-- 用于放用户登录信息和导航【每页都有】 -->
<div class="top">

</div>

<div class="loginDiv">
	<div class="logoDiv"></div>
	<div class="logoInfo">
	<form action="../control/usercontrol.php" method="post">
		<input type="hidden" value="login" name="ctype"/>
		<table>
			<tr>
				<td align="left" colspan="2" style="background-color:#330000; color:#FFFFFF; font-size:18px;">用户登录</td>
			</tr>
			<tr style="background-color:#003300; color:#FFFFFF; font-size:18px;">
				<td>帐号</td><td><input type="text" name="user_name"/></td>
			</tr>
			<tr style="background-color:#003300; color:#FFFFFF; font-size:18px;">
				<td>密码</td><td><input type="password" name="user_pwd"/></td>
			</tr>
			<tr style="background-color:#FFFFFF; color:#666666; font-size:12px;">
				<td colspan="2" align="right">找回密码</td>
			</tr>
			<tr style="background-color:#333366; color:#FFFFFF; font-size:18px; cursor:pointer; font-size:24px;">
				<td colspan="2" align="center" id="submit">登 录</td>
			</tr>
		</table>
	</form>
	</div>
	<div class="logoMess">
		<ul>
			<li>Thank you for your login</li>
			<li>You are a force here</li>
			<li>You've only been here a more robust</li>
			<li>There you are here is the programmer's paradise</li>
			<li>Finally I hope you can find what you want here, the resources</li>
			<li>And I hope you can share more resources to other users</li>
			<li>Thanks again for your login</li>
		</ul>
	</div>
</div>

</body>
</html>
