<?php 
session_start ();
	
require_once '../dao/BookDao.php';
require_once '../../../util/StackConst.php';

$page= @$_GET['page'];
$language= @$_GET['language'];
$word = @$_GET['resource_book_name'];

//获取书籍列表
$bookDao = new BookDao();
$arrBooks = $bookDao->getBookList($page,$language,$word);

//获取每类书籍数量
$eachBookCount = $bookDao->getEachBookCount();

//获取书籍全部总量
$bookCount = $bookDao->getBookCount();

//获取书籍页数
$pageCount = $bookDao->getPageCount($language,$word);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>itstack|IT书库</title>
<script language="javascript" type="text/javascript" src="../../zjs/jquery-1.8.3.js"></script>
<script language="javascript" type="text/javascript" src="../../zjs/jquery.corner.js"></script>
<link type="text/css" rel="stylesheet" href="../../zcss/booklist.css" />
<script language="javascript" type="text/javascript">
$(function(){
	$("#seachDiv,.bookimg,.MD").corner();
	
	$(".leftBodyDiv ul li").hover(
		function(){
			$(this).css("color","#000000").css("font-weight","900");
		},
		function(){
			$(this).css("color","#333333").css("font-weight","normal");;
		}
	);
	
	$(".bookbg_img").click(function(e){
	
		var Pbcss =  (e.pageY) + "px 0px 0px "+ (e.pageX)+"px";
		$(".MD").fadeIn("slow").css({ margin:Pbcss});
		
		$childrenUl = $(".MD").children("ul").children("li");
		$childrenLabel = $(this).children("label");
		
		for(var i = 0; i < 7; i ++){
			$childrenUl.eq(i).html($childrenLabel.eq(i).html());
		}
	});
	
	$(".MD").mouseleave(function(){
		$(".MD").fadeOut("slow");
	})
	
	//搜索
	$("#seachDiv").focus(function(){
		if("请输入检索关键字" == $(this).val()){
			$(this).val("");
		}
	});
	
	$("#seachDiv").mouseout(function(){
		if("" == $(this).val()){
			$(this).val("请输入检索关键字");
		}
	}).blur();
	
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
});
</script>
</head>

<body>
<div class="MD" data-corner="right 10px">
	<ul><li></li><li></li><li></li><li></li><li></li><li></li><li></li></ul>
</div>
<!--头部模块-->
<div class="headDiv">
	<div class="logoDiv">
		<div class="leftLogoDiv"><a href="../../../index.php">ITstack</a>&nbsp;<font size="+1"><a href="booklist2.php">IT书库(<?php echo $bookCount;?>)</a></font></div>
		<div class="rightLogoDiv">
			<form action="booklist2.php" method="post">
				<input type="text" id="seachDiv" name="resource_book_name" value="请输入检索关键字"/>
			</form>
		</div>
	</div>
</div>
<!--身体部分-->
<div class="bodyDiv">
	<div class="leftBodyDiv">
		<div class="user_div">
		<?php 
			if (isset ( $_SESSION ['userLoginMessage'] )) {
		?>
				<a href="#"><?php echo $_SESSION ['userLoginMessage']['user_name']?></a>|<a href="../../case/control/caseusercontrol.php?type=logout" target="_parent" style="color: #CCCCCC;text-decoration:none;">注销</a>
		<?php		
			}else{
		?>
				<a href="../../case/view/caseuserlogin.php">登录</a>|<a href="../../case/view/caseuserregister.php">注册</a>
		<?php	
			}
		?>
			
			
		</div>
		<ul>
		<?php 
			$bookName = "";
			foreach ($eachBookCount as $bookCount){
				$bookName = $bookCount['resource_book_language'];
		?>
				<li><a href="booklist2.php?language=<?php echo urlencode($bookName)?>&page=1"><?php echo $bookName." (".$bookCount[$bookName].")" ?></a></li>
		<?php		
			}
		?>
		</ul>
	</div>
	<div class="rightBodyDiv">
		<ul>
		
		<?php 
			foreach ($arrBooks as $arrBook){
				$page = $arrBook['page'];
		?>
				<li>
					<div class="bookbg_img">
						<img class="bookimg" data-corner="right 6px" src="https://pcs.baidu.com/rest/2.0/pcs/thumbnail?method=generate&access_token=<?php echo StackConst::access_token();?>&path=<?php echo urlencode(StackConst::pcs_url().$arrBook['resource_book_url']);?>&quality=100&width=110&height=146" width="110" height="146"/>
						<label><?php echo $arrBook['resource_book_date'];?></label>
						<label><?php echo $arrBook['user_name'];?></label>
						<label><?php echo $arrBook['resource_book_name'];?></label>
						<label><?php echo $arrBook['resource_book_level'];?></label>
						<label><?php echo $arrBook['resource_book_size'];?> M</label>
						<label><?php echo $arrBook['resource_book_review'];?></label>
						<label><a href="../control/bookcontrol.php?ctype=downbook&path=<?php echo urlencode($arrBook['resource_book_url']);?>" id="downBook">下载书籍</a></label>
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
						if(($page == 0 ? 1 : $page) < $pageCount){
				?>
						<li><a href="booklist2.php?language=<?php echo $language;?>&page=<?php echo ($page + 1) ;?>">下一页</a></li>
				<?php	
					}
				?>
				<?php 
					if($page >= 2){
				?>
						<li><a href="booklist2.php?language=<?php echo urlencode($language);?>&page=<?php echo ($page - 1);?>">上一页</a></li>
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
</div>

</body>
</html>
