<?php 
require_once '../../case/dao/CaseDao.php';
session_start ();

$page = @$_GET['page'];											 //获取当前页数
$language = @$_GET['resource_case_language'];					 //获取分类语言
$word = @$_POST['word'] == "" ? @$_GET['word'] : @$_POST['word'];//获取word查询关键字
$statue = @$_GET['resource_case_statue'];						 //获取状态
$fk_user_id = @$_GET['fk_user_id'];//发帖人id

//获取案例列表
$caseDao = new CaseDao();
$arrCases = $caseDao->getCaseList($page,$language,$word,$statue,$fk_user_id);

//获得案例的分类个数
$eachCaseCount = $caseDao->getEachCaseCount();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>itstack|案例仓库-www.itstack.org</title>
<link type="text/css" rel="stylesheet" href="../../zcss/case.css" />
<script language="javascript" type="text/javascript" src="../../zjs/jquery-1.8.3.js"></script>
<script language="javascript" type="text/javascript" src="../../zjs/jquery.corner.js"></script>
<link rel="stylesheet" title="Default" href="../../zjs/highlight/default.css">
<script src="../../zjs/highlight/highlight.pack.js"></script>
<script>
	  hljs.tabReplace = '    ';
	  hljs.initHighlightingOnLoad();
</script>
<script language="javascript" type="text/javascript">
$(function(){
	//圆角
	$(".pagination ul li,#stt").corner();
	
	$(".pagination ul li[class!='cnzz']").hover(
		function(){
			$(this).css("background-color","#000000");
		},
		function(){
			$(this).css("background-color","#333333");
		}
	
	);
	//当焦点到搜索栏里面清空里面内容非用户输入
	$("#stt").focus(function(){
		if("输入检索关键字" == $(this).val()){
			$(this).val("");
		}
	}).mouseout(function(){
		if("" == $(this).val()){
			$(this).val("输入检索关键字");
		}
		$(this).blur();
	});
	
});
//搜索验证
function subImgFuc(){
	if("输入检索关键字" == $("#stt").val()){
		return false;
	}

	if("" ==  $("#stt").val()){
		$("#stt").val("输入检索关键字");
		return false;
	}
}
</script>
</head>

<body>
	<div class="topDiv">
		<div class="logoDiv">
			<ul>
				<li id="logo"><a href="../../../index.php" style="color:#FFFFFF;text-decoration: none;">ITstack</a></li>
				<li id="logo_cn"><a href="caselist.php" style="color:#CCCCCC;text-decoration: none;">案例仓库</a></li>
				<li id="login">
					<?php 
						if (isset ( $_SESSION ['userLoginMessage'] )) {
					?>
							<a style="color: white;"><?php echo $_SESSION ['userLoginMessage']['user_name']?></a>
							|
							<a href="../control/caseusercontrol.php?type=logout" target="_parent" style="color: #CCCCCC;text-decoration:none;">注销</a>
					<?php		
						}else{
					?>
							<a href="caseuserlogin.php" target="_blank" style="color: #CCCCCC;text-decoration:none;">登录</a>
							|
							<a href="caseuserregister.php" target="_blank" style="color: #CCCCCC;text-decoration:none;">注册</a>
					<?php		
						}
					?>
					|
					<a href="caseissue.php" target="_blank" style="color: #CCCCCC;text-decoration:none;">发表案例</a></li>
			</ul>
		</div>
		
		<div class="casestack">
		</div>
	</div>

	<div class="bodyDiv">
		<div class="leftList">
			<ul>
				<li><a href="caselist.php?page=1">最新案例</a></li>
				<li><a href="caselist.php?resource_case_statue=0&page=1">未结案例</a></li>
				<li><a href="caselist.php?resource_case_statue=1&page=1">已结案例</a></li>
				<li><a href="caselist.php?resource_case_statue=2&page=1">经典案例</a></li>
			</ul>
		</div>
		<!--数据填充区-->
		<div class="contentDiv">
		
			<?php 
				foreach ($arrCases as $arrCase){
					if("" != $arrCase['pageSum']){
						//遇到分页数据退出循环因为它是最后一个
						break;
					}
			?>
					<!--数据组start-->
					<div class="userDiv">
						<div class="userHeadImg">
							<img src="../../user/userimg/<?php echo $arrCase['user_head_img_name']?>" width="150" height="150"/>
						</div>
						<div class="userHeadImgBg"></div>
						<div class="userNameBg">
							<ul>
								<li><?php echo $arrCase['user_name'];?></li>
							</ul>
						</div>
					</div>
					<div class="contentDetil">
						<div class="cdHead">
							<ul>
								<li><?php echo $arrCase['resource_case_title'];?></li>
							</ul>
						</div>
						<div class="cdBody">
							<ul>
								<li>板块:<?php echo $arrCase['resource_case_language'];?> &nbsp; 时间:<?php echo $arrCase['resource_case_data'];?></li>
								<li><?php echo $arrCase['resource_case_content'];?>... ...</li>
							</ul>
						</div>
						<div class="cdBottom">
							<ul>
								<li><a href="caselist.php?fk_user_id=<?php echo $arrCase['fk_user_id']?>&page=1" style="color: white;text-decoration: none;">此人案例</a></li>
								<li>收藏案例</li>
								<li>评论案例</li>
								<li><a href="casedetail.php?resource_case_id=<?php echo $arrCase['resource_case_id'];?>&resource_case_title=<?php echo $arrCase['resource_case_title'];?>" target="_blank" style="color: white;text-decoration: none;">阅读案例</a></li>
							</ul>
						</div>
					</div>
					<!--数据组end-->
			<?php		
				}
			?>
			
			<!--分页模块-->
			<div class="pagination">
				<ul>
					<?php 
						if(($page == 0 ? 1 : $page) <= $arrCases['pageSum']){
					?>
							<li><a href="caselist.php?fk_user_id=<?php echo $fk_user_id;?>&word=<?php echo urlencode($word);?>&resource_case_statue=<?php echo $statue;?>&resource_case_language=<?php echo urlencode($language);?>&page=<?php echo ($page == 0 ? 2:$page + 1) ;?>">下一页</a></li>
					<?php	
						}
					?>
					<?php 
						if($page >= 2){
					?>
							<li><a href="caselist.php?fk_user_id=<?php echo $fk_user_id;?>&word=<?php echo urlencode($word);?>&resource_case_statue=<?php echo $statue;?>&resource_case_language=<?php echo urlencode($language);?>&page=<?php echo ($page - 1) ;?>">上一页</a></li>
					<?php			
						}
					?>
					<li class="cnzz" style="background-color:#FFFFFF;">
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3Fab125eeb1febde63edd829c062ac6653' type='text/javascript'%3E%3C/script%3E"));
</script>
					<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1000172860'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s22.cnzz.com/z_stat.php%3Fid%3D1000172860%26show%3Dpic1' type='text/javascript'%3E%3C/script%3E"));</script>
					</li>
				</ul>
			</div>
			
		</div>
		<!--搜索栏-->
		<div class="serachDiv">
			<form action="caselist.php" method="post">
				<input type="hidden" value="1" name="page"/>
				<div class="serach">
					<input type="text" id="stt" name="word" value="输入检索关键字"/>
					<input type="submit" value="" id="sub" onclick="return subImgFuc()"/>
				</div>
			</form>
			<?php 
				$caseName = "";
				foreach ($eachCaseCount as $caseCount){
					$caseName = $caseCount['resource_case_language'];
			?>
					 <div class="language"><a href="caselist.php?resource_case_language=<?php echo urlencode($caseName);?>&page=1"><?php echo urlencode($caseName);?>(<?php echo $caseCount[$caseName]?>)</a></div>
			<?php		
				}
			?>
		</div>
	</div>
</body>
</html>
