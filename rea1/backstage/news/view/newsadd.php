<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script language="javascript" type="text/javascript" src="../../zjs/jquery-1.8.3.js"></script>
<title>添加新闻信息</title>
<script type="text/javascript"> 
function hhfwz(){
	var descrip = $("#news_content").val(); 
	descrip=descrip.replace(/\r\n|\n/g,'<br/>'); 
	$("#news_content").val(descrip); 
}
</script> 
</head>

<body>
<form action="../control/newscontrol.php" method="post">
	<input type="hidden" value="addNews" name="type"/>
	<table border="1" width="100%">
		<tr>
			<td width="80px">新闻标题</td>
			<td><input type="text" name="news_title" style="width: 80%;"/></td>
		</tr>
		<tr>
			<td>新闻内容</td>
			<td><textarea cols="120" name="news_content" id="news_content" rows="20"></textarea></td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" value="保存新闻" onclick="hhfwz()"/></td>
		</tr>
	</table>
</form>

</body>
</html>
