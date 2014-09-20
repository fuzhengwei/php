<?php 
header ( 'Content-type: text/html; charset=utf-8' );
//用户名
$user_name = @$_GET['user_name'];
//图片名
$user_head_img_name = @$_GET['user_head_img_name'];
//三木运算符判断
$user_head_img_name = (!isset($user_head_img_name)? "请输入:（图片名）":$user_head_img_name);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>register</title>
<link type="text/css" rel="stylesheet" href="../../zcss/register_1.css" />
<script language="javascript" type="text/javascript" src="../../zjs/jquery-1.8.3.js"></script>
<script language="javascript" type="text/javascript" src="../../zjs/jquery.corner.js"></script>
<script language="javascript" type="text/javascript">
	$(function(){
		
		//是否是图片
		var isImg = new Boolean(false);
		//验证图片是否上传
		var confirm = "0";
		//圆角
		$(".registerDiv,input,.leftN,.registerUL,img,#imgSuffixPoint").corner();

		$("#imgFile").change(function(){
			
			$("#imgSuffixPoint").fadeOut("slow");
			
			var imgUrl = $(this).val();
			var imgName = "";	//文件名
			var imgSuffix = ""; //文件后缀
			var lastSlashIndex = imgUrl.lastIndexOf("\\");
			//定义能接受的图片类型
			var filterArray = {"jpg":1,
							   "png":1,
							   "jpeg":1,
							   "gif":1,
							   "JPG":1,
							   "PNG":1,
							   "GIF":1,
							   "JPEG":1
							  }
				
			
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
				$("#imgSuffixPoint").fadeIn("slow").text("这个文件类型不能上传");
			}else{
				//是图片类型
				isImg = true;
			}
		});
		
		//图片名称于用户名同步
		$("#user_head_img_name").keyup(function(){
			//清空里面内容,如果里面内容为系统内容
			if($(this).val() == "请输入:（图片名）"){
				$(this).val("");
			}
			
			$("#user_name").val($(this).val());
			
		});
		
		$("#user_name").keyup(function(){
			$("#user_head_img_name").val($(this).val());
		});
		//光标移动到哪个选框内，那么这个边框为红色
        $("#user_name,#up_1,#up_2,#user_email").focus(function(){
      		$(this).css("border","1px red solid");
        }).blur(function(){
        	$(this).css("border","0");
        });
		//提交图片
		$("#subImg").click(function(){
		
			//图片类型为false时，返回false
			if(!isImg){
				$("#imgSuffixPoint").fadeIn("slow").text("这个文件类型不能上传");
				return false;
			}
			
			//图片名称是否为空
			if("" == $("#user_head_img_name").val() || "请输入:（图片名）" == $("#user_head_img_name").val()){
				$("#imgSuffixPoint").fadeIn("slow").text("图片名称不能为空或者为系统提示名");
				return false;
			}
			
		});

		var bool_user_name = new Boolean(false);
		
		//异步提交验证
		$("#user_name").focusout(function(){
			$("#requst").empty();
			$("#userspan").text("验证中ing... ...");

			if($("#user_name").val() != ""){
				$.post(
						"../control/caseusercontrol.php", 
					    { user_name:$("#user_name").val(),
						  type:"isExistUser" 
						},
						function(data){
							$("#requst").append(data);
							
							if($("#isExistUser").text() == "1"){
								$("#userspan").css("color","red").text("账户可注册");
								bool_user_name = true;
							}else{
								$("#userspan").css("color","blue").text("账户被注册");
								bool_user_name = false;
							}
						}
				 );
			}else{
				$("#userspan").css("color","blue").text("用户名不能为空");
			}
		});

	});

	//点击注册各种条件判断验证
	function subUser(){

		var subM = $("#subMess");
		subM.css("color","blue");
		
		//图片提交判断
		if("请输入:（图片名）" == $("#confirm_user_head_img_name").val() || "" == $("#confirm_user_head_img_name").val()){
			subM.text("--!图片没有确认,请确认头像图片");
			return false;
		}

		//用户名判断
		if("请输入:（图片名）" == $("#user_name").val() || "" == $("#user_name").val()){
			subM.text("--!请输入用户名,之后失去焦点验证");
			return false;
		}

		//用户名长度验证
		if($("#user_name").val().length > 12 || $("#user_name").val().length < 3){
			subM.text("--!用户名长度不符合要求");
			return false;
		}

		//密码不能为空
		if("" == $("#up_1").val()){
			subM.text("--!密码不能为空,你是忘记了吗");
			return false;
		}
		
		if($("#user_name").val().indexOf("or") >= 0 || $("#user_name").val().indexOf("OR") >= 0){
			subM.text("--!请更改用户名不要含有or因为这样不安全！");
			return false;
		}
		
		if($("#up_1").val().indexOf("or") >= 0 || $("#up_1").val().indexOf("OR") >= 0){
			subM.text("--!监测密码中含有or请更改，因为这样不安全");
			return false;
		}

		//密码确认必须相同
		if($("#up_1").val() != $("#up_2").val()){
			subM.text("--!您上下两次输入的密码不相同");
			return false;
		}

		//密码长度验证6-12位
		if($("#up_1").val().length < 6 || $("#up_1").val().length > 12){
			subM.text("--!密码长度不符合要求");
			return false;
		}

		//邮箱验证
		if("" == $("#user_email").val()){
			subM.text("--!邮箱不能为空");
			return false;
		}

	}

	//上传图片验证
	function subImgFuc(){

		//图片文件不能为空
		if("" == $("#imgFile").val()){
			$("#imgSuffixPoint").fadeIn("slow").text("没有选择图片不能上传");
			return false;
		}
		
		//图片类型为false时，返回false
		if(!isImg){
			$("#imgSuffixPoint").fadeIn("slow").text("这个文件类型不能上传");
			return false;
		}
		
		//图片名称是否为空
		if("" == $("#user_head_img_name").val() || "请输入:（图片名）" == $("#user_head_img_name").val()){
			$("#imgSuffixPoint").fadeIn("slow").text("图片名称不能为空或者为系统提示名");
			return false;
		}
		
	}
</script>
</head>

<body>
<span style="display: none;" id="requst"></span>
<div class="topDiv">
		<div class="logoDiv">
			<ul>
				<li id="logo"><a href="../../../index.php" style="color:#FFFFFF;text-decoration: none;">ITstack</a></li>
				<li id="logo_cn"><a href="caselist.php" style="color:#CCCCCC;text-decoration: none;">案例仓库</a></li>
				<li id="logo_cn"><a href="../../link/view/linklist.php" style="color:#CCCCCC;text-decoration: none;">链接仓库</a></li>
			</ul>
		</div>
		
		<div class="casestack">
		</div>
</div>
<div class="registerDiv">
	<div class="registerMess">
		<form action="../control/caseusercontrol.php" method="post">
		<input type="hidden" value="registeruser" name="type"/>
		<input type="hidden" value="<?php echo $user_head_img_name;?>" name="confirm_user_head_img_name" id="confirm_user_head_img_name"/>
		<ul class="registerUL">
          <li id="point">3-6个汉字或者12个英文字母<br/>[<font color="black">先确认头像图片，注册更方便</font>]</li>
			<li><div class="leftN">用户帐号</div><input type="text" value="<?php echo $user_name;?>" id="user_name" name="user_name"/><span id="userspan"></span></li>
			<li id="point">写一个你容易记住的密码吧字母数字组合6-12位</li>
			<li><div class="leftN">用户密码</div><input type="password" id="up_1"/><span></span></li>
			<li id="point">把你上面输入的密码在输入一次，免得你弄错</li>
			<li><div class="leftN">确认密码</div><input type="password" name="user_pwd" id="up_2"/><span></span></li>
			<li id="point">输入一个你常用的邮箱，这个邮箱能帮助你找回密码。而且我们保证不会乱发邮件到你的邮箱！</li>
			<li><div class="leftN">常用邮箱</div><input type="email" name="user_email" id="user_email"/><span></span></li>
			<li style="text-align:left;"><input type="submit" value="注   册" onclick="return subUser()" style="background-color:#993333; width:200px; height:30px; margin-top:10px; color:#FFFFFF;"/><span id="subMess"></span></li>
		</ul>
		</form>
	</div>
	<div class="userHeadImg">
		<form action="../control/caseusercontrol.php" method="post" enctype="multipart/form-data">
		<input type="hidden" value="uploadimg" name="type"/>
		<input type="hidden" value="<?php echo $user_head_img_name;?>" name="delete_old_img"/>
		<ul>
			<li>
				<?php 
					if("请输入:（图片名）" != $user_head_img_name){
				?>
						<img src="../../user/userimg/<?php echo $user_head_img_name;?>" width="150" height="150" id="preview"/>
				<?php		
					}else{
				?>
						<img src="../../zimages/dfHeadImg.png" width="150" height="150" id="preview"/>
				<?php	
					}
				?>
				
			</li>
			<li><input type="file" style="width:150px;" accept="image/jpeg,image/gif,image/png" value="选择图片" id="imgFile" name="imgFile" /></li>
			<li><input type="text" style="width:150px; margin-top:5px; background-color:#003366;" value="<?php echo $user_name;?>" id="user_head_img_name" name="user_head_img_name"/></li>
			<li><input type="submit" style="width:150px; background-color:#993300; margin-top:5px;" value="确认头像图片" id="subImg" onclick="return subImgFuc()"/></li>
			<li style="font-size:12px; margin-top:5px; color:#FF0000;" >支持jpg、jpeg、png、gif</li>
			<li id="imgSuffixPoint"></li>
		</ul>
		</form>
	</div>
</div>
</body>
</html>
