<?php 
//引入静态常量
require_once '../../../util/StackConst.php';

//引入ProductDao
require_once '../dao/ProductDao.php';
//实例化ProductDao
$productDao = new ProductDao();
//获取产品列表
$arrProducts = $productDao->getProductList();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../zjs/pixelmatrix/css/uniform.default.css" type="text/css" media="screen">
<script language="javascript" type="text/javascript" src="../zjs/jquery-1.8.3.js"></script>
<script language="javascript" type="text/javascript" src="../zjs/pixelmatrix/jquery.uniform.js"></script>
<script language="javascript" type="text/javascript" src="../zjs/fzw_ht.js" charset="utf-8"></script>
<title>产品中心列表</title>
</head>

<body>
<table border="1" width="100%">
	<tr>
		<th width="5%">序号</th>
		<th width="10%">产品类别</th>
		<th width="10%">产品缩略图</th>
		<th width="10%">产品名称</th>
		<th width="50%">产品简介</th>
		<th width="15%" colspan="2">操作</th>
	</tr>
	<?php 
		$XH = 1;
		foreach ($arrProducts as $product){
	?>
			<tr>
				<td><?php echo $XH++;?></td>
				<td><?php echo $product['fk_pro_cate_name'];?></td>
				<td><img src="../../resourcepic/picstack/<?php echo $product['pic_urlname'];?>" width="150" height="150"/></td>
				<td><?php echo $product['pro_name'];?></td>
				<td><?php echo $product['pro_intro'];?></td>
				<td><a href="productupdate.php?pro_id=<?php echo $product['pro_id']?>">修改</a></td>
				<td><a href="../control/productcontrol.php?type=deleteProduct&pro_id=<?php echo $product['pro_id']?>">删除</a></td>
			</tr>
	<?php		
		}
	?>
	
	
</table>
</body>
</html>
