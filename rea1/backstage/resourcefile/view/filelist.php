<?php 
//引入静态常量
require_once '../../../util/StackConst.php';
//引入FileDao
require_once '../dao/FileDao.php';
//实例化FileDao
$fileDao = new FileDao();
//获取File集合
$arrFiles = $fileDao->getFileList();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../zjs/pixelmatrix/css/uniform.default.css" type="text/css" media="screen">
<script language="javascript" type="text/javascript" src="../zjs/jquery-1.8.3.js"></script>
<script language="javascript" type="text/javascript" src="../zjs/pixelmatrix/jquery.uniform.js"></script>
<script language="javascript" type="text/javascript" src="../zjs/fzw_ht.js" charset="utf-8"></script>
<title>文件资源管理</title>
</head>

<body>
<table border="1" width="100%">
	<tr align="center">
		<th>序号</th>
		<th>文件名称</th>
		<th>文件地址</th>
		<th>保存日期</th>
		<th>下载文件</th>
		<th>操作</th>
	</tr>
	<?php 
		$XH = 1;
		foreach ($arrFiles as $file){
	?>
			<tr align="center">
				<td><?php echo $XH++;?></td>
				<td><?php echo $file['down_name'];?></td>
				<td><?php echo $file['down_urlname'];?></td>
				<td><?php echo $file['down_savedate'];?></td>
				<td><a href="<?php echo StackConst::res_file_url().$file['down_urlname']?>">测试下载</a></td>
				<td><a href="../control/filecontrol.php?type=deleteFile&down_id=<?php echo $file['down_id']?>">删除</a></td>
			</tr>
	<?php		
		}
	?>
	
	
</table>
</body>
</html>
