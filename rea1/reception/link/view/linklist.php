<?php
session_start ();
header ( 'Content-type: text/html; charset=utf-8' );
ini_set("error_reporting","E_ALL & ~E_NOTICE");

require_once '../dao/LinkDao.php';
//获得资源分类
$fk_category_sort_name = @$_GET['fk_category_sort_name'] == "" ? @$_POST['fk_category_sort_name'] : @$_GET['fk_category_sort_name'];
if("" == $fk_category_sort_name){
	$fk_category_sort_name = "书籍";
}
//获得语言分类
$fk_language_sort_name = @$_GET['fk_language_sort_name'];
//获得检索关键字[如果post方式为空，那么就用get方式获得]
$resource_link_name = @$_POST['resource_link_name'] == "" ? @$_GET['resource_link_name'] : @$_POST['resource_link_name'];
//获得页数
$page = @$_GET['page'];
//实例化LinkDao
$linkDao = new LinkDao();
//获得链接集合
$arrLinks = $linkDao->getLinkList($page,$fk_category_sort_name,$fk_language_sort_name,$resource_link_name);
//获得语言分类
$languageSorts = $linkDao->getLanguageSort();
//获得语言分类下链接资源的数量[根据语言有区分]
$eachLinkCount = $linkDao->getEachLinkCount($fk_category_sort_name);
//验证是否登录
$isUserLogin = isset ( $_SESSION ['userLoginMessage'] )?"0":"1";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ITstack|-link 链接库</title>
<link type="text/css" rel="stylesheet" href="../../zcss/link.css" />
<script language="javascript" type="text/javascript" src="../../zjs/jquery-1.8.3.js"></script>
<script language="javascript" type="text/javascript" src="../../zjs/jquery.corner.js"></script>
<script language="javascript" type="text/javascript">
$(function(){

	//分页处的圆角
	$(".pagination ul li").corner();
	//分页处的效果
	$(".pagination ul li[class!='cnzz']").hover(
		function(){
			$(this).css("background-color","#000000");
		},
		function(){
			$(this).css("background-color","#333333");
		}
	
	);
	
	//给资源分类定色
	$.each($(".logoDiv ul li[class='link_common'] a"),function(i,n){
		if("<?php echo $fk_category_sort_name;?>" == $(n).text()){
			$(n).parent("li").addClass("sortselect");
		}
	});
	
	//圆角
	$(".logoDiv ul li,.link_title,.share_title,#search_link_title").corner();
	$(".link_detail").corner("bottom");
	
	$(".logoDiv ul li[class='link_common'][id!='sortselect']").hover(
		function(){
			$(this).css("background-color","#993300");
		},
		function(){
			$(this).css("background-color","#CC6600");
		}
	);
	
	
	$(".bodyLeft ul li").hover(
		function(){
			$(this).css("color","#000000").css("font-weight","900");
		},
		function(){
			$(this).css("color","#333333").css("font-weight","normal");;
		}
	);
	
	$(".link_detail_but").toggle(
		function(){
			$(this).text("关闭介绍").next(".link_detail").slideDown("slow");
		},
		function(){
			$(this).text("展开介绍").next(".link_detail").slideUp("slow");
		}
		
	);
	$(".share_title").toggle(
		function(){
			$(this).css("background-color","#999999").css("color","#FFFFFF").next(".sort_Div").fadeIn("slow").next(".link_name").fadeIn("slow").next(".link_url").fadeIn("slow").next(".link_content").fadeIn("slow").next("#subShare").fadeIn("slow");
		},
		function(){
			$(this).css("background-color","transparent").css("color","#000000").next(".sort_Div").fadeOut("slow").next(".link_name").fadeOut("slow").next(".link_url").fadeOut("slow").next(".link_content").fadeOut("slow").next("#subShare").fadeOut("slow");
		}
	);

	//如果没有登录那么跳转到登录页面
	$(".share_title").click(function(){
		if("<?php echo $isUserLogin;?>" == "1"){
			window.location.href='../../case/view/caseuserlogin.php';
		}
	});
	
	//点击链接名称时候，原有内容清空
	$(".link_name").focus(function(){
		if("输入链接名称" == $(this).val()){
			$(this).val("");
		}
	});
	
	$(".link_name").mouseout(function(){
		if("" == $(this).val()){
			$(this).val("输入链接名称").blur();
		}
	});
	
	//链接地址
	$(".link_url").focus(function(){
		if("链接地址：" == $(this).val()){
			$(this).val("");
		}
	});
	
	$(".link_url").mouseout(function(){
		if("" == $(this).val()){
			$(this).val("链接地址：").blur();
		}
	});
	
	//链接说明
	$(".link_content").focus(function(){
		if("链接内容说明... ..." == $(this).val()){
			$(this).val("");
		}
	});
	
	$(".link_content").mouseout(function(){
		if("" == $(this).val()){
			$(this).val("链接内容说明... ...").blur();
		}
	});
 
	//搜索
	$("#search_link_title").focus(function(){
		if("输入检索关键字" == $(this).val()){
			$(this).val("");
		}
	});
	
	$("#search_link_title").mouseout(function(){
		if("" == $(this).val()){
			$(this).val("输入检索关键字");
		}

		$(this).blur();
	});
	
});

//提交分享时候验证
function subFcs(){
	//链接名称不能为空
	if("" == $(".link_name").val() || "输入链接名称" == $(".link_name").val()){
		return false;
	}
	
	//链接地址不为空
	if("" == $(".link_url").val() || "链接地址：" == $(".link_url").val()){
		return false;
	}
	
	//链接地址不为空
	if("" == $(".link_content").val() || "链接内容说明... ..." == $(".link_content").val()){
		return false;
	}
}

//搜索验证
function subSerFcs(){
	if("输入检索关键字" == $(this).val() || "" == $(this).val()){
		return false;
	}
}
</script>
</head>

<body>
<!--头部DIV-->
<div class="headDiv">
	<div class="logoDiv">
		<ul>
			<li id="logo_it"><a href="../../../index.php">ITstack</a></li>
			<li id="logo_word"><a href="linklist.php">链接库</a></li>
			<li class="link_common" style="margin-left:30px;"><a href="linklist.php?fk_category_sort_name=<?php echo urlencode("书籍")?>">书籍</a></li>
			<li class="link_common"><a href="linklist.php?fk_category_sort_name=<?php echo urlencode("文档")?>">文档</a></li>
			<li class="link_common"><a href="linklist.php?fk_category_sort_name=<?php echo urlencode("案例")?>">案例</a></li>
			<li class="link_common"><a href="linklist.php?fk_category_sort_name=<?php echo urlencode("源码")?>">源码</a></li>
			<li class="link_common"><a href="linklist.php?fk_category_sort_name=<?php echo urlencode("视频")?>">视频</a></li>
			<li class="link_common"><a href="linklist.php?fk_category_sort_name=<?php echo urlencode("软件")?>">软件</a></li>
			<li class="link_common"><a href="linklist.php?fk_category_sort_name=<?php echo urlencode("其他")?>">其他</a></li>
		</ul>
	</div>
</div>
<!--身体div-->
<div class="bodyDiv">
	<div class="bodyLeft">
		<div class="user_div">
			<?php 
				if (isset ( $_SESSION ['userLoginMessage'] )) {
			?>
					<a><?php echo $_SESSION ['userLoginMessage']['user_name']?></a>
					|
					<a href="../../case/control/caseusercontrol.php?type=logout" target="_parent" style="color: #CCCCCC;text-decoration:none;">注销</a>
			<?php		
				}else{
			?>
					<a href="../../case/view/caseuserlogin.php">登录</a>
					|
					<a href="../../case/view/caseuserregister.php">注册</a>
			<?php		
				}
			?>
		</div>
		<ul>
			<?php 
				$linkName = "";
				foreach ($eachLinkCount as $linkCount){
					$linkName = $linkCount['fk_language_sort_name'];
			?>
					<li><a href="linklist.php?fk_category_sort_name=<?php echo urlencode($fk_category_sort_name)?>&fk_language_sort_name=<?php echo urlencode($linkName);?>"><?php echo $linkName;?>(<?php echo $linkCount[$linkName]?>)</a></li>			
			<?php		
				}
			?>
		</ul>
	</div>
	
	<div class="bodyCenter">
		<ul>
		
		<?php 
			foreach ($arrLinks as $link){
				if("" != $link['pageSum']){
					//遇到分页数据退出循环因为它是最后一个
					break;
				}
		?>
				<li>
					<div class="link_div">
						<div class="link_title" data-corner="left 10px"><a href="<?php echo $link['resource_link_url'];?>" target="_blank"><?php echo $link['resource_link_name'];?></a></div>
						<div class="link_detail_but">展开介绍</div>
						<div class="link_detail">
							<ul>
								<li>共享人:<?php echo $link['user_name'];?> 共享时间:<?php echo $link['resource_link_data'];?></li>
								<li><?php echo $link['resource_link_content'];?> </li>
							</ul>
						</div>
					</div>
				</li>	
		<?php	
			}
		?>
			
			
		</ul>
		<!--分页模块-->
		<div class="pagination">
			<ul>
				<?php 
						if(($page == 0 ? 1 : $page) < $arrLinks['pageSum']){
				?>
						<li><a href="linklist.php?fk_category_sort_name=<?php echo urlencode($fk_category_sort_name);?>&fk_language_sort_name=<?php echo urlencode($fk_language_sort_name);?>&resource_link_name=<?php echo urlencode($resource_link_name);?>&page=<?php echo ($page == 0 ? 2:$page + 1) ;?>">下一页</a></li>
				<?php	
					}
				?>
				<?php 
					if($page >= 2){
				?>
						<li><a href="linklist.php?fk_category_sort_name=<?php echo urlencode($fk_category_sort_name);?>&fk_language_sort_name=<?php echo urlencode($fk_language_sort_name);?>&resource_link_name=<?php echo urlencode($resource_link_name);?>&page=<?php echo ($page - 1) ;?>">上一页</a></li>
				<?php			
					}
				?>
				<li class="cnzz" style=" background-image:url(../../zimages/linkbodybg.jpg);">
					<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3Fab125eeb1febde63edd829c062ac6653' type='text/javascript'%3E%3C/script%3E"));
</script>
					<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1000172860'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s22.cnzz.com/z_stat.php%3Fid%3D1000172860%26show%3Dpic1' type='text/javascript'%3E%3C/script%3E"));</script>
				</li>
			</ul>
		</div>
	</div>
	
	<div class="bodyRight">
		<form action="linklist.php" method="post" onsubmit="subSerFcs()">
		<div class="serachDiv">
            <input type="hidden" value="<?php echo $fk_category_sort_name;?>" name="fk_category_sort_name"/>
			    <input type="text" id="search_link_title" name="resource_link_name" value="<?php echo $resource_link_name == "" ? "输入检索关键字":$resource_link_name ;?>"/>
		</div>
		</form>
		<form action="../control/linkcontrol.php" method="post">
			<input type="hidden" value="sharelink" name="type"/>
			<div class="share_link">
				<div class="share_title">分&nbsp;享&nbsp;资&nbsp;源&nbsp;链&nbsp;接</div>
				<div class="sort_Div">
					<select name="fk_category_sort_name">
						<option value="书籍">书籍</option>
						<option value="文档">文档</option>
						<option value="案例">案例</option>
						<option value="源码">源码</option>
						<option value="视频">视频</option>
						<option value="软件">软件</option>
						<option value="其他">其他</option>
					</select>
					<select name="fk_language_sort_name">
					<?php 
						foreach ($languageSorts as $language){
					?>
							<option value="<?php echo $language['language_sort_name']?>"><?php echo $language['language_sort_name']?></option>
					<?php		
						}
					?>
					</select>
				</div>
			
				<input type="text" class="link_name" value="输入链接名称" name="resource_link_name"/>
				<textarea class="link_url" name="resource_link_url">链接地址：</textarea>
				<textarea class="link_content" name="resource_link_content">链接内容说明... ...</textarea>
				<input type="submit" value="提交分享" id="subShare" onclick="return subFcs()"/>
			</div>
		</form>
	</div>
</div>
</body>
</html>
