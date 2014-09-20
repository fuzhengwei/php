<?php 
//引入静态常量
require_once '../../util/StackConst.php';
//引入产品操作DAO
require_once 'dao/ProductDao.php';
//实例化dao
$productDao = new ProductDao();
//获取产品类型
$proType = @$_GET['proType'] == "" ? "中压开关类" :@$_GET['proType'];
//获取对象集合
$arrProducts = $productDao->getProductList($proType);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" href="../zcss/index.css" />
<link type="text/css" rel="stylesheet" href="css/products.css" />
<script language="javascript" type="text/javascript" src="../zjs/jquery-1.8.3.js"></script>
<script language="javascript" type="text/javascript" src="../zjs/jquery.corner.js"></script>
<script type="text/javascript" language="javascript" src="../zjs/jquery-ui-1.9.2.custom.js"></script>
<script language="javascript" type="text/javascript" src="../zjs/fzw.js"></script>
<script language="javascript" type="text/javascript">
$(function(){
	
	//圆角
	$(".productsList,.proImg").corner("5px");
	$(".PMOne,.PMTwo,.PMThree,.PMFour").corner("5px");
});
</script>
<title>产品中心</title>
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
		<li><a href="products.php" target="_parent">产品中心</a></li>
		<li><a href="../news/news.php" target="_parent">新闻中心</a></li>
	</ul>
	<div class="xhx"></div>
</div>
<!--上面模块 end-->
<!--中间模块 start-->
<div class="centerDiv">
	<div class="productsMenu">
		<div class="PMOne" <?php echo $proType == "中压开关类" ? "id=BGC":""?>><a href="products.php?proType=<?php echo urlencode("中压开关类");?>">中压开关类</a></div>
		<div class="PMTwo" <?php echo $proType == "中压成套装置类" ? "id=BGC":""?>><a href="products.php?proType=<?php echo urlencode("中压成套装置类");?>">中压成套装置类</a></div>
		<div class="PMThree"></div>
		<div class="PMFour"></div>
	</div>
	<?php 
		foreach ($arrProducts as $product){
	?>
			<div class="productsList">
			<div class="proName"><a href="#"><?php echo $product['pro_name'];?></a></div>
			<div class="proImg"><img src="../../backstage/resourcepic/picstack/<?php echo $product['pic_urlname'];?>" width="250" height="250"/></div>
			<div class="proIntro">
				<font color="#EBEBEB"><b>简介：</b></font><br/>
				<?php echo $product['pro_intro'];?>
			</div>
			<div class="proReadDetail">
				<div class="ReadInfo">详细介绍</div>
			</div>
			<div class="InfoDetail">
			<br/><?php echo $product['pro_overview'];?><br/>
	 		<br/><?php echo $product['pro_explanation'];?><br/>
			<br/><?php echo $product['pro_parameter'];?><br/>
			</div>
		</div>
	<?php		
		}
	?>
	
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
