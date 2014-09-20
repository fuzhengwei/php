<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../zjs/pixelmatrix/css/uniform.default.css" type="text/css" media="screen">
<script language="javascript" type="text/javascript" src="../zjs/jquery-1.8.3.js"></script>
<script language="javascript" type="text/javascript" src="../zjs/pixelmatrix/jquery.uniform.js"></script>
<script language="javascript" type="text/javascript" src="../zjs/fzw_ht.js" charset="utf-8"></script>
<title>新增产品类别</title>
</head>

<body>
<form action="../control/categorycontrol.php" method="post">
	<input type="hidden" value="addCategory" name="type"/>
	<table border="1">
		<tr>
			<td width="20%">产品类别</td>
			<td><input type="text" name="pro_cate_name"/></td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" value="新增类别"/></td>
		</tr>
	</table>
</form>

</body>
</html>
