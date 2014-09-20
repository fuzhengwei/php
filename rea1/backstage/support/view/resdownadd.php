<?php 
//引入静态常量
require_once '../../../util/StackConst.php';
//引入Down Dao
require_once '../dao/DownDao.php';
//实例化DownDao
$downDao = new DownDao();
//获取资源文件集合
$resDownList = $downDao->getResDownList();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>

<body>
<form action="../control/downcontrol.php" method="post">
	<input type="hidden" name="type" value="addDown"/>
	<table border="1" width="100%">
		<tr>
			<td width="100px;">选取资源文件</td>
			<td>
				<select name="fk_down_id">
					<?php 
						foreach ($resDownList as $resDown){
					?>
							<option value="<?php echo $resDown['down_id']?>"><?php echo $resDown['down_name']?></option>
					<?php		
						}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" value="保存资源文件"/></td>
		</tr>
	</table>
</form>
</body>
</html>
