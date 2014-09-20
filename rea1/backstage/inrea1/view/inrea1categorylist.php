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
<title>服务支持|招聘类别列表</title>
</head>

<body>
	<table border="1" width="100%">
		<tr>
			<th>序号</th>
			<th>招聘类别</th>
			<th>操作</th>
		</tr>
		<?php 
			$XH = 1;
			foreach ($arrCagegorys as $category){
		?>
				<tr align="center">
					<td><?php echo $XH++;?></td>
					<td><?php echo $category['in_cat_content'];?></td>
					<td><a href="../control/categorycontrol.php?type=deleteCate&in_cat_id=<?php echo $category['in_cat_id'];?>">删除</a></td>
				</tr>
		<?php		
			}
		?>
		
	</table>
</body>
</html>
