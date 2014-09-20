<?php 
//引入静态常量
require_once '../../../util/StackConst.php';
//引入文件资源操作类
require_once '../dao/DownDao.php';
//实例化文件资源
$downDao = new DownDao();
//获得文件资源集合对象
$arrDowns = $downDao->getDownList();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>文件资源</title>
</head>

<body>
	<input type="hidden" name="type" value=""/>
	<table border="1" width="100%">
		<tr>
			<th>序号</th>
			<th>资源名称</th>
			<th>测试下载</th>
			<th>操作</th>
		</tr>
		<?php 
			$XH = 1;
			foreach ($arrDowns as $down){
		?>
				<tr align="center">
					<td><?php echo $XH++;?></td>
					<td><?php echo $down['down_name']; ?></td>
					<td><a href="../../resourcefile/filestack/<?php echo urlencode($down['down_urlname']);?>">点击下载</a></td>
					<td><a href="../control/downcontrol.php?type=deleteDown&sup_res_down_id=<?php echo $down['sup_res_down_id']?>">删除</a></td>
				</tr>
		<?php		
			}
		?>
	</table>
</body>
</html>
