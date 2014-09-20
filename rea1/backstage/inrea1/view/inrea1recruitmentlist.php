<?php 
//引入静态常量
require_once '../../../util/StackConst.php';
//引入招聘DAO
require_once '../dao/RecruitmentDao.php';
//实例化招聘dao
$recruitmentDao = new RecruitmentDao();
//获取招聘信息对象数组
$arrRecruitments = $recruitmentDao->getRecruitmentList();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>服务支持|技术解答</title>
</head>

<body>
	<table border="1" width="100%">
		<tr>
			<th width="50px;">序号</th>
			<th width="100px;">招聘类别</th>
			<th>招聘信息</th>
			<th width="200px;" colspan="2">操作</th>
		</tr>
		<?php 
			$XH = 1;
			foreach ($arrRecruitments as $recruitment){
		?>
				<tr>
					<td><?php echo $XH++;?></td>
					<td><?php echo $recruitment['fk_in_category'];?></td>
					<td><?php echo $recruitment['in_content'];?></td>
					<td><a href="inrea1recruitmentupdate.php?in_id=<?php echo $recruitment['in_id'];?>">修改</a></td>
					<td><a href="../control/recruitmentcontrol.php?type=deleteRec&in_id=<?php echo $recruitment['in_id'];?>">删除</a></td>
				</tr>
		<?php		
			}
		?>
	</table>
</body>
</html>
