<?php 
//引入静态常量
require_once '../../../util/StackConst.php';
//引入PicDao
require_once '../dao/PicDao.php';

//实例化PicDao
$picDao = new PicDao();
//获取pic集合
$arrPics = $picDao->getPicList();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../zjs/pixelmatrix/css/uniform.default.css" type="text/css" media="screen">
<script language="javascript" type="text/javascript" src="../zjs/jquery-1.8.3.js"></script>
<script language="javascript" type="text/javascript" src="../zjs/pixelmatrix/jquery.uniform.js"></script>
<script language="javascript" type="text/javascript" src="../zjs/fzw_ht.js" charset="utf-8"></script>
<title>图片资源管理</title>
</head>

<body>
<table border="1" width="100%">
	<tr align="center">
		<th>图片名称</th>
		<th>图片地址</th>
		<th>保存日期</th>
		<th>缩略图展示</th>
		<th>操作</th>
	</tr>
<?php 
	foreach ($arrPics as $pic){
?>
		<tr align="center">
			<td><?php echo $pic['pic_name'];?></td>
			<td><?php echo $pic['pic_urlname'];?></td>
			<td><?php echo $pic['pic_savedate'];?></td>
			<td><img src="<?php echo StackConst::res_pic_url().$pic['pic_urlname'];?>" width="100" height="100"/></td>
			<td><a href="../control/piccontrol.php?type=deletepic&pic_id=<?php echo $pic['pic_id'];?>">删除</a></td>
		</tr>
<?php		
	}
?>
	
</table>
</body>
</html>
