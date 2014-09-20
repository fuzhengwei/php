<?php
//引入静态常量
require_once '../../../util/StackConst.php';

session_start ();
if (!isset ( $_SESSION ['userLoginMessage'] )) {
  	StackConst::jump_page('../../case/view/caseuserlogin.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>糗图上传</title>
<script src="../../zjs/jquery-1.8.3.js" type="text/javascript" charset="utf-8"></script>
<script src="../../zjs/pixelmatrix/jquery.uniform.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
      $(function(){
        $("input, textarea, select, button").uniform();
		
		//是否是图片
		var isImg = new Boolean(false);
		//图片地址
		var imgUrl = "";
		//图片名称
		var imgName = "";
		//文件后缀
		var imgSuffix = "";
		//定义能接受的图片类型
		//文件最后一个分隔符的位置
		var lastSlashIndex = "";
		//图片过滤
		var filterArray = {"jpg":1,
						   "png":1,
						   "jpeg":1,
						   "gif":1
						   }
						   
		
		//验证图片
		$(".uploader").change(function(){
				
				//提示信息
				TSMess("");
				
				//图片地址
				imgUrl = $(".filename").text();
				//获取最后一个斜杠的位置
				lastSlashIndex = imgUrl.lastIndexOf("\\");
				//获得文件名称
				if(-1 == lastSlashIndex){
					imgName = imgUrl;
				}else{
					imgName = imgUrl.substr(lastSlashIndex+1,imgUrl.length);			   
				}
				
				//获得文件后缀
				imgSuffix = imgName.substr(imgName.lastIndexOf(".")+1,imgName.length);//获得文件后缀
				isFilter = filterArray[imgSuffix];
		
				//如果是undefined说明集合里面没有这类值，那么不允许上传
				if(typeof(isFilter) == "undefined"){
					//不是图片类型
					isImg = false;
					//给与提示
					TSMess("这个文件类型不能上传");
				}else{
					//是图片类型
					isImg = true;
				}
		
				
		});
		var numSub = false;
		//上传限制
		$("#subPic").click(function(){
			if(!isImg){
				TSMess("这个文件类型不能上传");
				return false;
			}
			
			if("" == $(".filename").text()){
				TSMess("没有选择任何要上传的图片");
				return false;
			}
			
			if($("#pic_highlight").val().length >= 300){
				TSMess("图片描述过长");
				return false;
			}
			
			if(numSub){
				TSMess("图片已经在上传队列中请误重复提交... ...");
				return false;
			}
			
			TSMess("图片上传中... ...");
			numSub = true;
			
			
		});
		//图片后面的提示信息
		function TSMess(tWord){
			$(".jsword").fadeIn("slow").text(tWord);
		}
		
      });
	 
</script>
<link rel="stylesheet" href="../../zjs/pixelmatrix/css/uniform.default.css" type="text/css" media="screen">
<link type="text/css" rel="stylesheet" href="../../zcss/picture.css" />
</head>

<body>
<!--头部信息-->
<div class="headDiv">
	<div class="logo">
		<span class="logo_en"><a href="../../../index.php">ITstack</a></span>
		<span class="logo_cn"><a href="piclist.php">糗图图库</a></span>
	</div>
</div>
<!--中间的分享图片信息-->
<div class="centerDiv">
<form action="../control/piccontrol.php" method="post" enctype="multipart/form-data">
	<input type="hidden" value="uploadpic" name="type" />
	<ul>
		<li><div class="pword">选择糗图</div><input type="file" id="file" name="file"/><span class="jsword"></span></li>
		<li><div class="pword">糗图分类</div>
			<select name="pic_type">
				<option value="1">普通</option>
				<option value="2">文艺</option>
				<option value="3">213</option>
			</select>
		</li>
		<li>
			<div class="pword">糗图亮点</div>
			<textarea name="pic_highlight" id="pic_highlight"></textarea>
		</li>
		<li>
			<input type="submit" value="分享糗图" id="subPic"/><span class="jsword">你没有选择图片！</span>
		</li>
	</ul>
</form>
</div>
</body>
</html>
