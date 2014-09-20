<?php 
session_start ();
//引入静态常量
require_once '../../../util/StackConst.php';
//引入PicDao
require_once '../dao/PicDao.php';
//实例化
$picDao = new PicDao();

//获得页数
$page = @$_GET['page'];
$pic_type = @$_GET['pic_type'];	
//实例化
$picDao = new PicDao();
//获得图片列表
$arrPics = $picDao->getPicList($page,$pic_type);	
//获得图片分类数量
$eachPicCount = $picDao->getEachPicCount();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>itstack|糗图图库</title>
<link rel="stylesheet" type="text/css" href="../../zcss/piclist.css" />
<script language="javascript" type="text/javascript" src="../../zjs/jquery-1.8.3.js"></script>
<script language="javascript" type="text/javascript" src="../../zjs/jquery.corner.js"></script>
<script language="javascript" type="text/javascript">
	
	
	$(function(){
		
		//圆角
		$(".serachDiv,.serachDiv input").corner();
		
		//是否退出也就是关闭了控制操作【登录、注册、分享】
		var isExit = false;
		//打开操作控制
		$(".controlDiv").click(function(){
			if(!isExit){
				$(".handleDiv").fadeIn("slow");
				isExit = true;
			}else{
				$(".handleDiv").fadeOut("slow");
				isExit = false;
			}
		});
		
		//关闭操作栏
		$("#exit").click(function(){
			isExit = false;
			$(".handleDiv").fadeOut("slow");
		});
		
		//鼠标滑动到控制区换色换图片
		$(".handleList .list").hover(
			function(){
				$(this).css({
					"background-color":"#1F1F1F",
					"background-image":"url(../../zimages/piclogo_"+$(this).attr("id")+"_2.png)",
					"color":"#FA6F57"
				}).children("a").css("color","#FA6F57");
			},
			function(){
				$(this).css({
					"background-color":"#FA6F57",
					"background-image":"url(../../zimages/piclogo_"+$(this).attr("id")+"_1.png)",
					"color":"#1F1F1F"
				}).children("a").css("color","#1F1F1F");
			}
		);
		
		//分页效果切换
		$(".page_next,.page_top").hover(
			function(){
				$(this).css({
					"background-color":"#1F1F1F"
				}).children("a").css("color","#FA6F57");
			},
			function(){
				$(this).css({
					"background-color":"#FA6F57"
				}).children("a").css("color","#1F1F1F");
			}
		);
		
		//搜索框处理
		$("#pic_highlight").focus(function(){
			if("请输入关键字..." == $(this).val()){
				$(this).val("");
			}
		});
		
		$("#pic_highlight").mouseout(function(){
			if("" == $(this).val()){
				$(this).val("请输入关键字...").blur();
			}
		});
	
		/*处理高度兼容
		$(".picInfo_center").each(function(i,n){
			var $cc = $(n).children(".shareInfo");
			var $ccilHeight = parseInt($cc.children("img").css("height")) +parseInt($cc.children(".lightpoint").css("height")) + 70;
			$ccilHeight = $ccilHeight < 240 ? 240 : $ccilHeight;
			$(n).css("height",$ccilHeight);
		});*/
	});
	
	//搜索验证
	function subSear(){
	
		if("请输入关键字..." == $("#pic_highlight").val()){
			return false;
		}
	}
</script>
</head>

<body>
<!--头部信息设置 start-->
<div class="headDiv">
	<div class="headInfo">
		<div class="headLogo">
			<ul>
				<li id="logo"><a href="../../../index.php">IT Stack</a></li>
				<li id="url"><a href="piclist.php">itstack.org</a></li>
			</ul>
		</div>
		
		<div class="serachAndControl">
			<div class="serachDiv">
				<form action="#" method="post" onsubmit="return subSear()">
				<input type="text" value="请输入关键字..." id="pic_highlight"/>
				</form>
			</div>
			<div class="controlDiv"></div>
			<div class="handleDiv">
				<div class="handleList">
					<?php 
						if (isset ( $_SESSION ['userLoginMessage'] )) {
					?>
							<div class="list" id="login"><?php echo $_SESSION ['userLoginMessage']['user_name']?></div>
							<div class="list" id="register"><a href="../../case/control/caseusercontrol.php?type=logout" target="_parent">注&nbsp;销</a></div>
							<div class="list" id="share"><a href="uppicture.php">分&nbsp;享</a></div>
					<?php		
						}else{
					?>
							<div class="list" id="login"><a href="../../case/view/caseuserlogin.php">登&nbsp;录</a></div>
							<div class="list" id="register"><a href="../../case/view/caseuserregister.php">注&nbsp;册</a></div>
					<?php	
						}
					?>
					<div class="list" id="exit">关&nbsp;闭</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--头部信息设置 end-->
<!--身体信息设置 start-->
<div class="bodyDiv">
	<!--left list start-->
	<div class="leftList">
		<div class="ll_new">
			<span class="logo_word"><a href="#">最新<br/>糗图</a></span>
			<div class="ll_logo_new"></div>
		</div>
		<div class="ll_hot">
			<span class="logo_word"><a href="#">最热<br/>糗图</a></span>
			<div class="ll_logo_hot"></div>
		</div>
		<div class="ll_recomm">
			<span class="logo_word"><a href="#">系统<br/>推荐</a></span>
			<div class="ll_logo_recomm"></div>
		</div>
		<div class="ll_history">
			<span class="logo_word"><a href="#">往事<br />如烟</a></span>
			<div class="ll_logo_history"></div>
		</div>
		
	</div>
	<!--left list end-->
	<!--center list start-->
	<ul class="centerList">
		<?php 
			$centerHeight = 0;
			$imgH = 0;//图片高度
			foreach ($arrPics as $pic){
				if("" != $pic['pageSum']){
					//遇到分页数据退出循环因为它是最后一个
					break;
				}
			//获得图片的高度给div赋值
			$imgH = $pic['pic_width'] > 300 ? $pic['pic_height'] / $pic['pic_width'] * 300 : $pic['pic_height'];
			$centerHeight = $pic['pic_width'] < 300 ? $pic['pic_height'] + 230 :($imgH+230);
		?>
				<li>
					<div class="picInfo">
						<div class="picInfo_data"><?php echo $pic['pic_up_data']?></div>
						<div class="picInfo_center" style="height:<?php echo $centerHeight;?>px;">
							<div class="userInfo">
								<div class="picInfo_head_userImg">
									<img src="../../user/userimg/<?php echo $pic['user_head_img_name']?>" width="150" height="150"/>
								</div>
								<div class="picInfo_head_userName">
									分享人：<?php echo $pic['user_name'];?>
								</div>
							</div>
							<div class="shareInfo">
								<img src="https://pcs.baidu.com/rest/2.0/pcs/thumbnail?method=generate&access_token=<?php echo StackConst::access_token();?>&path=<?php echo StackConst::pcs_pic_url();?><?php echo $pic['pic_name']?>&quality=100&width=<?php echo $pic['pic_width']?>&height=<?php echo $pic['pic_height']?>" width="<?php echo $pic['pic_width'] > 300 ? 300 : $pic['pic_width']?>">
								
								<div class="lightpoint">
								<?php 
									if("" == $pic['pic_highlight']){
								?>
										我们期待每一张图片都有它的说明，最好也提出它的亮点与内涵。
										无论这张图片是普通图片、文艺图片还是耳鼻图片，我们都会从中获取到快乐，
										本站站长与站内群友一起努力建设本站，希望做到最好最棒的效果。在这个过程
										中我们也是秉着学习的态度来完善我们的网站，不图有什么虚名，但希望能让我们
									这群年轻的人，获得一点成就。让我们走在拼搏的道路上，有更加坚强的意志。
								<?php	
									}else{
										echo $pic['pic_highlight'];
									}
								?>
								</div>
							</div>
							<div class="picInfo_bottom">
								<div class="picInfo_read"><a href="#">糗图详情</a></div>
							</div>
						</div>
						
					</div>
				</li>	
		<?php
			}
		?>
		
		<li>
			<div class="page">
			<?php 
				if(($page == 0 ? 1 : $page) < $arrPics['pageSum']){
			?>
					<div class="page_top">
						<a href="piclist.php?page=<?php echo ($page == 0 ? 2:$page + 1) ;?>&pic_type=<?php echo $pic_type;?>">下一页</a>
					</div>
			<?php	
				}
				if($page >= 2){
			?>
					<div class="page_next">
						<a href="piclist.php?page=<?php echo ($page - 1) ;?>&pic_type=<?php echo $pic_type;?>">上一页</a>
					</div>
			<?php	
				}
			?>
				<div style=" background-image:url(../../zimages/picbg.jpg)">
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3Fab125eeb1febde63edd829c062ac6653' type='text/javascript'%3E%3C/script%3E"));
</script>
					<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1000172860'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s22.cnzz.com/z_stat.php%3Fid%3D1000172860%26show%3Dpic1' type='text/javascript'%3E%3C/script%3E"));</script>
					</div>
				
			</div>
		</li>
	</ul>
	<!--center list end-->
	<!--right 普通 文艺 213 start-->
	<div class="reghtPW2">
		<?php 
			$picName = "";//1 2 3 分别代表 普通 文艺 213
			foreach ($eachPicCount as $PicCount){
				$picName = $PicCount['pic_type'];
		?>
				<div class="<?php echo $picName == 1 ? "pt":($picName == 2 ? "wy":"b");?>"><a href="piclist.php?pic_type=<?php echo $picName;?>"><?php echo $picName == 1 ? "普通":($picName == 2 ? "文艺":"213");?>(<?php echo $PicCount[$picName]?>)</a></div>
		<?php	
			}
		?>
	</div>
	<!--right 普通 文艺 213 end-->
</div>
<!--身体信息设置 end-->
</body>
</html>
