<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../zjs/pixelmatrix/css/uniform.default.css" type="text/css" media="screen">
<script language="javascript" type="text/javascript" src="../zjs/jquery-1.8.3.js"></script>
<script language="javascript" type="text/javascript" src="../zjs/pixelmatrix/jquery.uniform.js"></script>
<script language="javascript" type="text/javascript" src="../zjs/fzw_ht.js" charset="utf-8"></script>
<title>新增图片资源</title>
</head>

<body>
<form action="../control/filecontrol.php" method="post" enctype="multipart/form-data">
<input type="hidden" value="uploadfile" name="type" />
<table border="1" width="100%">
	<tr>
		<td>选择图片</td>
		<td><input type="file" name="file_file"/></td>
	</tr>
	<tr>
		<td>图片名称</td>
		<td><input type="text" name="down_name"/></td>
	</tr>
	<tr>
		<td colspan="2"><input type="submit" value="保存文件" /></td>
	</tr>
</table>
</form>
</body>
</html>
