<?php 
//引入操作Dao
require_once 'dao/DownDao.php';
require_once 'dao/AnswerDao.php';
require_once 'dao/TecsDao.php';

$supType = @$_GET['supType'] == "" ? "资料下载":@$_GET['supType'];

//实例化dao
$downDao = new DownDao();
//获取集合
$arrDowns = $downDao->getDownList();

//实例化dao
$answerDao = new AnswerDao();
//获取集合
$arrAnswers = $answerDao->getAnswerList();

//实例化
$tecsDao = new TecsDao();
//获取集合
$arrTecs = $tecsDao->getTecsList();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" href="../zcss/index.css" />
<link type="text/css" rel="stylesheet" href="css/support.css" />
<script language="javascript" type="text/javascript" src="../zjs/jquery-1.8.3.js"></script>
<script language="javascript" type="text/javascript" src="../zjs/jquery.corner.js"></script>
<script type="text/javascript" language="javascript" src="../zjs/jquery-ui-1.9.2.custom.js"></script>
<script language="javascript" type="text/javascript" src="../zjs/fzw.js"></script>
<script language="javascript" type="text/javascript">
$(function(){
	$(".PMOne,.PMTwo,.PMThree,.PMFour,.offers,.dataDown").corner("5px");
});
</script>
<title>服务支持</title>
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
	<div class="inRea1Menu">
		<div class="PMOne" <?php echo $supType == "资料下载"? "id='BGC'":""?>><a href="support.php?supType=资料下载">资料下载</a></div>
		<div class="PMTwo" <?php echo $supType == "技术解答"? "id='BGC'":""?>><a href="support.php?supType=技术解答">技术解答</a></div>
		<div class="PMThree" <?php echo $supType == "技术支持"? "id='BGC'":""?>><a href="support.php?supType=技术支持">技术支持</a></div>
		<div class="PMFour"></div>
	</div>
	<?php 
		if("资料下载" == $supType){
	?>
			<?php 
				foreach ($arrDowns as $down){
			?>
					<div class="dataDown">
						<!-- 资料下载 -->
						<div class="downRes">
							<div class="resName"><?php echo $down['down_name']?></div>
							<div class="resUrlDown"><a href="../../backstage/resourcefile/filestack/<?php echo $down['down_urlname']?>">点击下载</a></div>
						</div>
					</div>
			<?php	
				}
			?>
	<?php		
		}else if("技术解答" == $supType){
	?>
			<?php 
				foreach ($arrAnswers as $answer){
			?>
					<div class="dataDown">
						<ul>
							<li style="font-weight: bolder; font-size: 18px;color: #000000;"><?php echo $answer['sup_res_answer_title'];?></li>
							<li><?php echo $answer['sup_res_answer_content'];?></li>
						</ul>
					</div>
			<?php	
				}
			?>
		
	<?php		
		}else if("技术支持" == $supType){
	?>
			<?php 
				foreach ($arrTecs as $tec){
			?>
					<div class="dataDown">
						<ul>
							<li><?php echo $tec['sup_res_sup_tecs_coutent'];?></li>
						</ul>
					</div>
			<?php		
				}
			?>
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
			<li><a href="support.php" target="_parent">服务支持</a></li>
			<li><a href="#">English</a></li>
		</ul>
	</div>
</div>
<!--底部模块 end-->
</body>
</html>
