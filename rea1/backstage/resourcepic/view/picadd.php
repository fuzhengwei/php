<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新增文件资源</title>
</head>

<body>
<form action="../control/piccontrol.php" method="post" enctype="multipart/form-data">
	<input type="hidden" name="type" value="uploadpic"/>
	<table border="1" width="100%">
		<tr>
			<td>选择文件</td>
			<td><input type="file" name="pic_file"/></td>
		</tr>
		<tr>
			<td>文件名称</td>
			<td><input type="text" name="pic_name"/></td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" value="保存文件" /></td>
		</tr>
	</table>
</form>
</body>
</html>
