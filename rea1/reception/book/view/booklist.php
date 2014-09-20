<?php 
	session_start ();
	
	require_once '../dao/BookDao.php';
	require_once '../../../util/StackConst.php';
	
	$page = 1;
	if('' != @$_GET['page']){
		$page= @$_GET['page'];
	}else{
		$page = 1;
	}
	
	$language= @$_GET['language'];
	$word = @$_GET['resource_book_name'];
	
	//获取书籍列表
	$bookDao = new BookDao();
	$arrBooks = $bookDao->getBookList($page,$language,$word);
	
	//获取书籍数量
	$eachBookCount = $bookDao->getEachBookCount();
	
	//获取书籍页数
	$pageCount = $bookDao->getPageCount($language,$word);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>itstack IT仓库  | IT书库 - 程序员自己的IT仓库</title>
<meta name="keywords" content="itstack,java、书籍、C#、php、oracle、mysql"/>
<meta name="description" content="努力建设程序员自己的IT仓库"/>
<link type="text/css" rel="stylesheet" href="../../zcss/book.css" />
<link rel="stylesheet" title="Default" href="../../zjs/highlight/default.css">
<script src="../../zjs/highlight/highlight.pack.js"></script>
<script>
  hljs.tabReplace = '    ';
  hljs.initHighlightingOnLoad();
</script>
<script language="javascript" type="text/javascript" src="../../zjs/jquery-1.8.3.js"></script>
<script language="javascript" type="text/javascript">
	
	$(function(){

		if(<?php echo count($arrBooks);?> ==  0){
			$(".bookMI").height(500);
		}	
		
		$("#rbn").val('输入搜索关键字');
		
		$("#rbn").keydown(function(){
			if("输入搜索关键字" == $(this).val()){
				$(this).val('');
			}
		});
			
		$("#searchSub").click(function(){
			$("#point").text('');
			if($("#rbn").val().length > 50){
				$("#point").append("文字过长！");
				return false;
			}
		});

	});
</script>
</head>

<body>
<div class="sortListDiv">
	<div class="Announcement">
		<ul>
			<li>公告：</li>
			<li>IT仓库目前上线第一个模块书籍模块</li>
			<li>以后将会陆续上线：文档、案例、源码、视频等模块</li>
			<li>有任何想和需求或者书籍分享链接：<a target="_blank" href="http://mail.qq.com/cgi-bin/qm_share?t=qm_mailme&email=NVxBRkFUVl51REQbVlpY" style="text-decoration:none;">请给我写信</a></li>
		</ul>
	</div>
	<div class="listDiv">
		<ul>
			<li><a href="booklist.php?page=1"><img src="../../zimages/book.png" width="100" height="100" title="书籍"/></a></li>
			<li><img src="../../zimages/case.png" width="100" height="100" title="文档"/></li>
		</ul>
	</div>
</div>
<div class="logoDiv">
	<div class="logoImg">
		<a href="../../../index.php"><div class="logo"></div></a>
		<div class="userMess">
			
			<?php 
				if (isset ( $_SESSION ['userLoginMessage'] )) {
			?>
					<div class="user">
						<ul>
							<li><?php echo $_SESSION ['userLoginMessage']['user_name']?></li>
						</ul>
					</div>
					<div class="userExit">
						<a href="../../case/control/caseusercontrol.php?type=logout" target="_parent" style="color: #CCCCCC;text-decoration:none;">注销</a>
					</div>
			<?php 		
				}else{
			?>
					<div class="user">
						<ul>
							<li>
								<a href="../../case/view/caseuserlogin.php" style="color: white;text-decoration: none;" target="_blank">登录</a>
								|
								<a href="../../case/view/caseuserregister.php" style="color: white;text-decoration: none;" target="_blank">注册</a>
							</li>
						</ul>
					</div>
			<?php
				}
			?>
			
		</div>
	</div>
	<div class="logoWord">
		<ul>
			<li>ITstack - www.itstack.org</li>
			<li style="font-size:12px;">----------------------</li>
			<li style="font-size:12px;">建设程序员自己的IT仓库</li>
		</ul>
	</div>
</div>
<div class="bookListDiv">
	<div class="bookMI">
	
		<?php 
				foreach ($arrBooks as $arrBook){
					$page = $arrBook['page'];
		?>
					<div class="bookMess">
						<div class="bookM"><?php echo $arrBook['resource_book_date'];?></div>
						<div class="bookM"><?php echo $arrBook['user_name'];?></div>
						<div class="bookM"><?php echo $arrBook['resource_book_size'];?> M</div>
						<div class="bookM"><?php echo $arrBook['resource_book_level'];?></div>
					</div>
					<div class="bookIntroduce">
						<div class="bookImg"><img src="https://pcs.baidu.com/rest/2.0/pcs/thumbnail?method=generate&access_token=<?php echo StackConst::access_token();?>&path=<?php echo StackConst::pcs_url().$arrBook['resource_book_url'];?>&quality=100&width=180&height=220" width="157" height="220"/></div>
						<div class="bookName">
							<div class="Bname" title="<?php echo $arrBook['resource_book_name'];?>"><?php echo $arrBook['resource_book_name'];?></div>
						</div>
						<div class="bookDown">
							<div class="Bname">下载书籍=》[<a href="../control/bookcontrol.php?ctype=downbook&path=<?php echo urlencode($arrBook['resource_book_url']);?>" target="_blank" style="color: white;">小伙伴GO</a>]</div>
						</div>
						<div class="bookDiscuss">
							<div class="distitle">书评：</div>
							<div class="discuss">
								<pre><code><?php echo $arrBook['resource_book_review'];?></code></pre>
							</div>
						</div>
					</div>		
		<?php		
				}
		?>
	</div>
	
	
	<div class="bookAssistant">
		<div class="shareBook"><a href="bookshare.php" target="_blank" style="color:white;text-decoration: none;">分享书籍</a></div>
		<div class="searchBook">
			<form action="booklist.php" method="get"">
				<ul>
					<li><input type="text" name="resource_book_name" value="输入搜索关键字" id="rbn"/></li>
					<li><input type="submit" value="搜索" id="searchSub"/></li>
					<li><span id="point" style="color:red;font-size: 12px;"></span></li>
				</ul>
			</form>
		</div>
		<div class="sjfl">书籍分类</div>
		<div class="bookLanguage">
			
			<ul>
				<?php 
					$bookName = "";
					foreach ($eachBookCount as $bookCount){
						$bookName = $bookCount['resource_book_language'];
						echo "<li><a href='booklist.php?language=$bookName&page=1'>".$bookName."(".$bookCount[$bookName].")</a></li>";
					}
				?>
			</ul>
		</div>
	</div>
	
	<div class="page">
		<div class="page_down">
			<?php echo '共'.$pageCount.'页'?>
		</div>
		<div class="page_down">
			<?php echo '第'.$page.'页'?>
		</div>
		<div class="page_up">
			<?php 
				if($page >= 1){
			?>
					<a href="booklist.php?language=<?php echo $language;?>&page=<?php echo ($page - 1);?>" style="color:white;text-decoration: none;">上一页</a>
			<?php		
				}else{
			?>
					<a href="#" style="color:white;text-decoration: none;">上一页</a>
			<?php
				}
			?>
			
		</div>
		<div class="page_down">
			<?php 
				if($page < $pageCount){
			?>
					<a href="booklist.php?language=<?php echo $language;?>&page=<?php echo ($page + 1) ;?>"style="color:white;text-decoration: none;">下一页</a>
			<?php		
				}else{
			?>
					<a href="#" style="color:white;text-decoration: none;">下一页</a>
			<?php		
				}
			?>
		</div>
	</div>
	
</div>
</body>
</html>
