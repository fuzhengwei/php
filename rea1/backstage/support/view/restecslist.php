<?php 
//引入静态常量
require_once '../../../util/StackConst.php';
//引入操作类
require_once '../dao/TecsDao.php';
//实例化TecsDao
$tecsDao = new TecsDao();
//获得技术支持对象集合
$arrTecs = $tecsDao->getTecsList();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>

<body>
	<input type="hidden" name="type" value=""/>
	<table border="1" width="100%">
		<tr>
			<th>序号</th>
			<th>技术支持信息</th>
			<th>操作</th>
		</tr>
		<?php 
			$XH = 1;
			foreach ($arrTecs as $tec){
		?>
				<tr align="center">
					<td><?php echo $XH++;?></td>
					<td><?php echo $tec['sup_res_sup_tecs_coutent'];?></td>
					<td><a href="../control/tecscontrol.php?type=deleteTecs&sup_res_sup_tecs_id=<?php echo $tec['sup_res_sup_tecs_id']?>">删除</a></td>
				</tr>
		<?php		
			}
		?>
	</table>
</body>
</html>
