<?php 
//引入操作类
require_once 'dao/RecruitmentDao.php';
$recType = @$_GET['recType'] == "" ? "销售类":@$_GET['recType'];
//实例化dao
$recruitmentDao = new RecruitmentDao();
//获取招聘信息对象集合
$arrRecruitments = $recruitmentDao->getRecruitmentList($recType);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" href="../zcss/index.css" />
<link type="text/css" rel="stylesheet" href="css/inrea1.css" />
<script language="javascript" type="text/javascript" src="../zjs/jquery-1.8.3.js"></script>
<script language="javascript" type="text/javascript" src="../zjs/jquery.corner.js"></script>
<script type="text/javascript" language="javascript" src="../zjs/jquery-ui-1.9.2.custom.js"></script>
<script language="javascript" type="text/javascript" src="../zjs/fzw.js"></script>
<script language="javascript" type="text/javascript">
$(function(){
	$(".PMOne,.PMTwo,.PMThree,.PMFour,.offers").corner("5px");
});
</script>
<title>加入rea1</title>
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
		<li><a href="../news/news.php" target="_parent">新闻中心</a></li>
	</ul>
	<div class="xhx"></div>
</div>
<!--上面模块 end-->
<!--中间模块 start-->
<div class="centerDiv">
	<div class="talents">
		<div style="text-align:center; font-size:24px;">锐意进取、积极向上、正直、负责。</div><br/>
		<div style="text-indent:2em; font-size:14px;">就人人都有闪光之处、都有可服务于社会的某些技能而言，每个人都是人才。就某方面具有突出才能的人就是人才而言，常义上的"能人"可谓人才。但若不对所谓"能人"冠以"品行"之类定义的话，声称是"能人"就放手任用的管理高手越来越少了。因此，一个人是不是某个集体的可用之才，是要因时因地而论的。我们提出"诚信、自律、敬业、创新"的瑞亿精神，及"懂业务、善管理、敢负责、顾大局、肯投入、永进取"等瑞亿的人才观，表达了公司对员工发展的期望。</div>
	</div>
	<div class="inRea1Menu">
		<div class="PMOne" <?php echo $recType == "销售类" ? "id='BGC'":""?>><a href="inrea1.php?recType=<?php echo urlencode('销售类');?>">销售类</a></div>
		<div class="PMTwo" <?php echo $recType == "技术类" ? "id='BGC'":""?>><a href="inrea1.php?recType=<?php echo urlencode('技术类');?>">技术类</a></div>
		<div class="PMThree"></div>
		<div class="PMFour"></div>
	</div>
	
	<?php 
		foreach ($arrRecruitments as $recruitment){
	?>
			<div class="offers">
				<ul>
					<li><?php echo $recruitment['in_content'];?></li>
				</ul>
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
			<li><a href="inrea1.php" target="_parent">加入REA1</a></li>
			<li><a href="../support/support.php" target="_parent">服务支持</a></li>
			<li><a href="#">English</a></li>
		</ul>
	</div>
</div>
<!--底部模块 end-->
</body>
</html>
