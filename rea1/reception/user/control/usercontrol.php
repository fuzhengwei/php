<?php
	require_once '../dao/UserDao.php';
	
	session_start ();

	$type = @$_POST['ctype'];

	$userDao = new UserDao();
	
	if(isset($type)){
		
		//执行登录操作
		if('login' == $type){
			
			$arrUsers = $userDao->loginUser(@$_POST['user_name'],@$_POST['user_pwd']);
			
			if("" != $arrUsers['user_id']){
				//登录成功把信息保存到session
				$_SESSION['userLoginMessage'] = $arrUsers;
				
				header ( "Location: ../../book/view/booklist.php" );
				
			}else {
				echo "login error!";
			}
			
		}else if('register' == $type){
			
			$rel = $userDao->registerUser(@$_POST['user_name'],@$_POST['user_pwd'],@$_POST['user_email']);
			
			if($rel){
				echo "注册成功！";
				exit;
			}else{
				echo "注册失败！";
				exit;
			}
		}
		
	}

?>