<?php 
//引入静态常量
require_once '../../../util/StackConst.php';
//引入CategoryDao
require_once '../dao/CategoryDao.php';
//实例化dao
$categoryDao = new CategoryDao();
//获取招聘类别集合
$arrCagegorys = $categoryDao->getCategoryList();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script language="javascript" type="text/javascript" src="../../zjs/jquery-1.8.3.js"></script>
<title>服务支持|技术解答</title>
<script type="text/javascript"> 
function hhfwz(){
	var descrip = $("#in_content").val(); 
	descrip=descrip.replace(/\r\n|\n/g,'<br/>'); 
	$("#in_content").val(descrip); 
}
</script> 
</head>

<body>
<form action="../control/recruitmentcontrol.php" method="post">
	<input type="hidden" name="type" value="addRec"/>
	<table border="1" width="100%">
		<tr>
			<td>招聘类别</td>
			<td>
				<select name="fk_in_category">
					<?php 
						foreach ($arrCagegorys as $cate){
					?>
							<option value="<?php echo $cate['in_cat_content']?>"><?php echo $cate['in_cat_content']?></option>
					<?php		
						}
					?>
					
				</select>
			</td>
		</tr>
		<tr>
			<td>招聘信息</td>
			<td><textarea name="in_content" id="in_content" rows="20" cols="100"></textarea></td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" value="保存招聘信息" onclick="hhfwz()"/></td>
		</tr>
	</table>
</form>
</body>
</html>
