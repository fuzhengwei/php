<?php 
//引入静态常量
//require_once '../../util/StackConst.php';

//引入新闻操作DAO
require_once 'dao/NewsDao.php';

//实例化新闻DAO
$newsDao = new NewsDao();

//获取新闻列表
$arrNews = $newsDao->getNewsList();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" href="../zcss/index.css" />
<link type="text/css" rel="stylesheet" href="css/news.css" />
<script language="javascript" type="text/javascript" src="../zjs/jquery-1.8.3.js"></script>
<script language="javascript" type="text/javascript" src="../zjs/jquery.corner.js"></script>
<script type="text/javascript" language="javascript" src="../zjs/jquery-ui-1.9.2.custom.js"></script>
<script language="javascript" type="text/javascript" src="../zjs/fzw.js"></script>
<script language="javascript" type="text/javascript">
$(function(){
	
	//圆角
	$(".newTitle").corner();
	$(".newDetail").corner("bottom");
	
	
});
</script>
<title>新闻中心</title>
</head>

<body>
<!--头部div logo start-->
<div class="headDiv">
	<a href="../../index.php" target="_parent"><div class="lLogoDiv"></div></a>
</div>
<!--头部div logo end-->
<!--上面模块 start-->
<div class="topDiv">
	<ul>
		<li><a href="../abtus/abtus.html" target="_parent">关于我们</a></li>
		<li><a href="../products/products.php" target="_parent">产品中心</a></li>
		<li><a href="news.php" target="_parent">新闻中心</a></li>
	</ul>
	<div class="xhx"></div>
</div>
<!--上面模块 end-->
<!--中间模块 start-->
<div class="centerDiv">
	<ul>
		<?php 
			foreach ($arrNews as $news){
		?>
			<li>
				<div class="newTitle" data-corner="left 10px"><?php echo $news['news_createdate'];?> &nbsp;&nbsp;&nbsp;&nbsp;  <?php echo $news['news_title'];?></div><div class="openAndClose">展开详情</div>
				<div class="newDetail"><?php echo $news['news_content'];?></div>
			</li>
		<?php		
			}
		?>
	</ul>
</div>
<!--中间模块 end-->
<!--底部模块 start-->
<div class="bottomDiv">
	<div class="bleftDiv">
		<div class="bldLogo"></div>
		<ul>
			<li><font color="#666666" style="font-size: 9px;">Copyrights@2013 Rea1 Intelligent Control Equipment (Shenzhen) Co.,Ltd. </font></li>
			<li><font color="#666666" style="font-size: 9px;">Rea1瑞亿智能控制设备（深圳）有限公司</font></li>
			<li><font color="#666666">京ICP备120401110号-1</font></li>
		</ul>
	</div>
	<div class="brightDiv">
		<ul>
			<li><a href="../contact/contact.html" target="_parent">联络我们</a></li>
			<li><a href="../inrea1/inrea1.php" target="_parent">加入REA1</a></li>
			<li><a href="../support/support.php" target="_parent">服务支持</a></li>
			<li><a href="#">English</a></li>
		</ul>
	</div>
</div>
<!--底部模块 end-->
</body>
</html>
