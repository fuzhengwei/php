<?php

?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>iOrder - 反馈</title>
<link href="css/iOrder.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="img/exe.ico">
<script type="text/javascript" src="js/jquery-1.8.2.js" href="js/jquery-1.8.2.js"></script>
<script src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="http://v3.jiathis.com/code/jiathis_r.js?uid=1367927434336527&move=0&amp;btn=r5.gif" charset="utf-8"></script>
<script type="text/javascript">
function ok()
{
	try
	{
		if($("#question_user").val()=="")
		{
			alert("未填写完整，请继续填写!");
			return false;
		}
		if($("#title").val()=="")
		{
			alert("未填写完整，请继续填写!");
			return false;
		}
		if($("#content").val()=="")
		{
			alert("未填写完整，请继续填写!");
			return false;
		}
	}
	catch (e)
	{
		alert(e);
	}
}
</script>
</head>
<body>
<script type="text/javascript" src="http://v3.jiathis.com/code/jiathis_r.js" charset="utf-8"></script>
<div class="header">
	<div class="top">
		<p class="top"> <span><a class="top" href="http://www.itstack.org" target="_blank">ITstack   |</a></span> <span class="anyi_sina">
			<wb:follow-button uid="2848087475" type="red_1" width="67" height="22" ></wb:follow-button>
			</span> </p>
	</div>
	<div class="title">
		<p class="title"><span class="logo"><a href="iOrder.php" style="color:black"><img src="img/exe_ico.png" width="80" height="80"/><font class="logo">iOrder</font></a></span> 
		<span class="title">
		<ul class="title">
			<li class="title"> <a class="title" href="iOrder.php">首页</a> </li>
			<li class="title"> <a class="title" href="help.php">帮助</a> </li>
			<li class="title"> <a class="title" href="update.php">更新日志</a> </li>
			<li class="title"> <a class="title" href="feedback.php" style="color:#4CC6F1">反馈</a> </li>
			<li><script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3Fab125eeb1febde63edd829c062ac6653' type='text/javascript'%3E%3C/script%3E"));
</script><script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1000172860'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s22.cnzz.com/z_stat.php%3Fid%3D1000172860%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));
</script></li>
		</ul>
		</span>
		</p>
	</div>
	<hr />
</div>
<div class="feedback_main">
	<form method="post" action="mail.php" id="post_quest" onsubmit="return ok();">
		<p><span class="feedback_remark">尊敬的用户: 在收到您的反馈后，作者会通过邮件回复您，请您填写正确的联系方式。</span></p>
		<div class="feedback_content">
			<ul>
				<li class="feedback_left">联系方式:</li>
				<li class="feedback_right">
					<input type="text" id="question_user" name="question_user" style="width:670px" autocomplete="off"/>
				</li>
			</ul>
			<ul>
				<li class="feedback_left">标题:</li>
				<li class="feedback_right">
					<input id="title" name="title" type="text"  style="width:670px" autocomplete="off"/>
				</li>
			</ul>
			<ul>
				<li class="feedback_left">内容:</li>
				<li class="feedback_right">
					<textarea id="content" name="content" style="width:670px; height:250px;"></textarea>
				</li>
			</ul>
		</div>
		<input class="feedback" type="submit" value="&nbsp;" />
		<input name="add" type="hidden" value="miner" />
	</form>
</div>
<div class="foot">
<p class="foot" style="color: white">© 2013 By 安忆</p>
</div>
</body>