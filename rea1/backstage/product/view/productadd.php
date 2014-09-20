<?php 
//引入静态常量
require_once '../../../util/StackConst.php';

//引入ProductDao
require_once '../dao/ProductDao.php';
//实例化ProuctDao
$productDao = new ProductDao();
//获取产品图片列表
$arrPics = $productDao->getPicList();
//获取产品类别列表
$arrCagegorys = $productDao->getCategoryList();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script language="javascript" type="text/javascript" src="../../zjs/jquery-1.8.3.js"></script>
<script type="text/javascript"> 
function hhfwz(){
	$("#pro_intro").val($("#pro_intro").val().replace(/\r\n|\n/g,'<br/>')); 
	$("#pro_overview").val($("#pro_overview").val().replace(/\r\n|\n/g,'<br/>')); 
	$("#pro_explanation").val($("#pro_explanation").val().replace(/\r\n|\n/g,'<br/>')); 
	$("#pro_explanation").val($("#pro_explanation").val().replace(/\r\n|\n/g,'<br/>')); 
	$("#pro_parameter").val($("#pro_parameter").val().replace(/\r\n|\n/g,'<br/>')); 
}
</script> 
<title>新增产品</title>
</head>

<body>
<form action="../control/productcontrol.php" method="post">
<input type="hidden" value="addProduct" name="type"/>
<table border="1" width="100%">
	<tr>
		<td width="10%">产品类别</td>
		<td>
			<select name="fk_pro_cate_name">
				<?php 
					foreach ($arrCagegorys as $category){
				?>
						<option value="<?php echo $category['pro_cate_name']?>"><?php echo $category['pro_cate_name']?></option>
				<?php	
					}
				?>
			</select>
		</td>
	</tr>
	<tr>
		<td>选取图片</td>
		<td>
			<select name="fk_pic_id">
				<?php 
					foreach($arrPics as $pic){
				?>
						<option value=" <?php echo urlencode($pic['pic_id'])?>"><?php echo $pic['pic_name']?></option>
				<?php		
					}
				?>
			</select>
		</td>
	</tr>
	<tr>
		<td>产品名称</td>
		<td><input type="text" name="pro_name"/></td>
	</tr>
	<tr>
		<td>产品简介</td>
		<td><textarea name="pro_intro" id="pro_intro" cols="120" rows="15"></textarea></td>
	</tr>
	<tr>
		<td>产品概述</td>
		<td><textarea name="pro_overview" id="pro_overview" cols="120" rows="15"></textarea></td>
	</tr>
	<tr>
		<td>型号说明</td>
		<td><textarea name="pro_explanation" id="pro_explanation" cols="120" rows="15"></textarea></td>
	</tr>
	<tr>
		<td>系统参数</td>
		<td><textarea name="pro_parameter" id="pro_parameter" cols="120" rows="15"></textarea></td>
	</tr>
	<tr>
		<td colspan="2"><input type="submit" value="确认增加" onclick="return hhfwz()"/></td>
	</tr>
</table>

</form>
</body>
</html>
