<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>user register</title>
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

<div class="registerDiv">
	<div class="logoDiv"></div>
	<div class="registerInfo">
	<form action="../control/usercontrol.php" method="post">
		<input type="hidden" value="register" name="ctype"/>
		<table>
			<tr>
				<td align="left" colspan="2" style="background-color:#330000; color:#FFFFFF; font-size:18px;" width="80px">用户注册</td>
			</tr>
			<tr style="background-color:#003300; color:#FFFFFF; font-size:18px;">
				<td>输入帐号</td><td><input type="text" name="user_name"/></td>
			</tr>
			<tr style="background-color:#003300; color:#FFFFFF; font-size:18px;">
				<td>输入密码</td><td><input type="password" name="user_pwd"/></td>
			</tr>
			<tr style="background-color:#003300; color:#FFFFFF; font-size:18px;">
				<td>确认密码</td><td><input type="password" name="user_pwd"/></td>
			</tr>
			<tr style="background-color:#003300; color:#FFFFFF; font-size:18px;">
				<td>输入邮箱</td><td><input type="email" name="user_email"/></td>
			</tr>
			<tr style="background-color:#333366; color:#FFFFFF; font-size:18px; cursor:pointer; font-size:24px;">
				<td colspan="2" align="center" id="submit">注册</td>
			</tr>
		</table>
	</form>
	</div>
	
</div>

</body>
</html>
