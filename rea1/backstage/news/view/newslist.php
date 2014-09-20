<?php 
//引入静态常量
require_once '../../../util/StackConst.php';

//引入新闻操作DAO
require_once '../dao/NewsDao.php';
//实例化新闻DAO
$newsDao = new NewsDao();
//获取新闻列表
$arrNews = $newsDao->getNewsList();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新闻中心列表</title>
</head>

<body>
<table border="1" width="100%">
	<tr>
		<th width="5%">序号</th>
		<th width="25%">标题</th>
		<th>内容</th>
		<th width="10%" colspan="2">操作</th>
	</tr>
	<?php 
		$XH = 1;
		foreach ($arrNews as $news){
	?>
			<tr>
				<td><?php echo $XH++;?></td>
				<td><?php echo $news['news_title'];?></td>
				<td><?php echo $news['news_content'];?></td>
				<td><a href="newsupdate.php?news_id=<?php echo $news['news_id'];?>">修改</a></td>
				<td><a href="../control/newscontrol.php?type=deleteNews&news_id=<?php echo $news['news_id'];?>">删除</a></td>
			</tr>
	<?php		
		}
	?>
	
</table>
</body>
</html>
