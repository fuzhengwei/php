<?php 
//引入静态常量
require_once '../../../util/StackConst.php';
//引入CategoryDao
require_once '../dao/CategoryDao.php';
//实例化CategoryDao
$categoryDao = new CategoryDao();
//获取列表
$arrCagegorys = $categoryDao->getCategoryList();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../zjs/pixelmatrix/css/uniform.default.css" type="text/css" media="screen">
<script language="javascript" type="text/javascript" src="../zjs/jquery-1.8.3.js"></script>
<script language="javascript" type="text/javascript" src="../zjs/pixelmatrix/jquery.uniform.js"></script>
<script language="javascript" type="text/javascript" src="../zjs/fzw_ht.js" charset="utf-8"></script>
<title>产品类别列表</title>
</head>

<body>
<table border="1" width="100%">
	<tr>
		<th>序号</th>
		<th>类别名称</th>
		<th>操作</th>
	</tr>
<?php 
	$XH = 1;
	foreach ($arrCagegorys as $category){
?>
		<tr align="center">
			<td><?php echo $XH++;?></td>
			<td><?php echo $category['pro_cate_name'];?></td>
			<td><a href="../control/categorycontrol.php?type=deleteCate&pro_cate_id=<?php echo $category['pro_cate_id']?>">删除</a></td>
		</tr>
<?php		
	}
?>
	
</table>
</body>
</html>
