<?php
include("class.phpmailer.php");
include("class.smtp.php"); 

//你只需填写以下信息即可****************************

$smtp = "smtp.qq.com";//必填，设置SMTP服务器 QQ邮箱是smtp.qq.com ，QQ邮箱默认未开启，请在邮箱里设置开通。网易的是 smtp.163.com 或 smtp.126.com

$youremail =  'i_order@qq.com'; // 必填，开通SMTP服务的邮箱；也就是发件人Email。(本系统功能也就是自己给自己发邮件)

$password = "iorder+anyi"; //必填， 以上邮箱对应的密码

$ymail = "i_order@qq.com"; //收信人的邮箱地址，也就是你自己收邮件的邮箱

$yname = "miner"; //收件人称呼

//填写信息结束 ****************************

function get_ip(){
   if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
       $ip = getenv("HTTP_CLIENT_IP");
   else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
       $ip = getenv("HTTP_X_FORWARDED_FOR");
   else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
       $ip = getenv("REMOTE_ADDR");
   else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
       $ip = $_SERVER['REMOTE_ADDR'];
   else
       $ip = "unknown";
   return($ip);
}

$mail = new PHPMailer();

$mail->IsSMTP();
$mail->SMTPAuth = true; 
$mail->Host = $smtp; 


$mail->Username = $youremail; 
$mail->Password = $password; //必填， 以上邮箱对应的密码

$mail->From = $youremail; 
$mail->FromName = "iOrder"; 

$mail->AddAddress($ymail,$yname);

if($_POST['add']=='miner'){
	$email = $_POST['question_user'];
	$title = $_POST['title'];
	$message = $_POST['content'];
	
	$ip = get_ip();
	
	$mail->Subject = "【iOrder反馈】--- ".$_POST['title']; 
	date_default_timezone_set('Asia/Shanghai');
	$time = date("Y-m-d H:i:s",time());

	
	$html = '邮箱：'.$email.'<br>标题：'.$title.'<br>内容：'.$message.'<br>IP：'.$ip.'<br>提交时间：'.$time;
	
	$mail->MsgHTML($html);
	
	$mail->IsHTML(true); 

	if(!$mail->Send()) {
		header("Content-Type: text/html; charset=utf-8"); 
		echo '<script>alert("提交失败了！");history.go(-1);</script>';
	} else {
		header("Content-Type: text/html; charset=utf-8");
	    echo '<script>alert("提交成功！感谢你的反馈。");history.go(-1);</script>';
	}
}
?>