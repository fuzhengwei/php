<?php
header ( 'Content-type: text/html; charset=utf-8' );
session_start ();
require_once '../common/UpLoad.php';
//设置时间格式
date_default_timezone_set('Asia/Shanghai');
//获得要执行的操作
$type = @$_POST['type'];
$type_get = @$_GET['type'];
//执行上传图片
if("uploadimg" == $type){
	//上传图片
	$upload = new UpLoad();
	if(isset ( $_FILES ["imgFile"] )){
		
		$user_name = $_POST["user_head_img_name"];
		
		$delete_old_img = @$_POST['delete_old_img'];
		//删除图片
		if(isset($delete_old_img)){
			if(""!=$delete_old_img && "请输入:（图片名）"!=$delete_old_img){
				$upload->deleteUploadImg($delete_old_img);
			}
			
		}
		
		//调用上传图片的方法
		$user_head_img_name = $upload->upLoadImg($_FILES ["imgFile"],$_POST["user_head_img_name"]);
		
		require_once '../../../util/StackConst.php';
		StackConst::jump_page("../view/caseuserregister.php?user_name=$user_name&user_head_img_name=$user_head_img_name");
	}
}else if("isExistUser" == $type){
	//判断用户是否存在
	require_once '../../user/dao/UserDao.php';
	
	$userDao = new UserDao();
	$rel = $userDao->getUserIdByName(@$_POST['user_name']);
	
	echo "<span id='isExistUser'>$rel</span>";

}else if("registeruser" == $type){
	
	//注册用户
	require_once '../../user/dao/UserDao.php';
	require_once '../../../util/StackConst.php';
	
	$userDao = new UserDao();

	//获得时间
	$dateTime = date('Y-m-d H:i:s');
	
	$user_name = @$_POST['user_name'];
	$user_pwd = @$_POST['user_pwd'];
	
	//注册用户
	$userMessage = array(
						  "user_name" =>$user_name,
						  "user_email" =>@$_POST['user_email'],
						  "user_head_img_name" =>@$_POST['confirm_user_head_img_name'],
						  "user_pwd" => $user_pwd,
						  "user_create_date" => $dateTime
						 );

	$rel = $userDao->registerUserByArray($userMessage);
	
	if($rel){
		//跳转登录页
		StackConst::jump_page("../view/caseuserlogin.php?user_name=$user_name");
		exit;
	}
}else if("userlogin" == $type){
	//用户登录
	require_once '../../user/dao/UserDao.php';
	require_once '../../../util/StackConst.php';
	
	$userDao = new UserDao();
	
	$user_name = @$_POST['user_name'];
	$user_pwd = @$_POST['user_pwd'];
	$upPageUrl = @$_POST['upPageUrl'];
	
	$arrUsers = $userDao->loginUser($user_name,$user_pwd);
	if("" != $arrUsers['user_id']){
		
		//登录成功把信息保存到session
		$_SESSION['userLoginMessage'] = $arrUsers;
		//如果没有传递页面，那么登录后跳转到案例页面
		if("" == $upPageUrl){
			$upPageUrl = "../view/caselist.php";
		}
		//跳转回页面 
		StackConst::jump_page($upPageUrl);
	}else{
		echo "login error!";
	}
}else if("caseissue" == $type){
	require_once '../dao/CaseDao.php';
	require_once '../../../util/StackConst.php';
	
	//实例化dao
	$caseDao = new CaseDao();
	//获得时间
	$dateTime = date('Y-m-d H:i:s');
	//组合数据
	$issueDetail = array(
							"fk_user_id" => $_SESSION['userLoginMessage']['user_id'],
					        "resource_case_language" =>@$_POST['resource_case_language'],
							"resource_case_data"=>$dateTime,
							"resource_case_title"=>@$_POST['resource_case_title'],
							"resource_case_content"=>@$_POST['resource_case_content']
						);
  	$resource_case_id = $caseDao->issueCase($issueDetail);
	//调用dao保存案例
	if($resource_case_id != 0){
		StackConst::jump_page("../view/casedetail.php?resource_case_id=$resource_case_id");
	}else{
		echo "案例保存失败！";
		exit;
	}
}else if("discuss" == $type){
	require_once '../dao/CaseDao.php';
	require_once '../../../util/StackConst.php';
	//提交评论
	//再次验证登录
	if(isset($_SESSION['userLoginMessage'])){
		//获得从哪来的页面
		$upPageUrl = @$_SERVER["HTTP_REFERER"];
		//获得时间
		$dateTime = date('Y-m-d H:i:s');
		//提交评论
		$discussDetail = array(
							"fk_resource_case_id" => @$_POST['fk_resource_case_id'],
							"fk_user_id" => $_SESSION['userLoginMessage']['user_id'],
							"resource_case_discuss_data" => $dateTime,
							"resource_case_discuss_content" => @$_POST['resource_case_discuss_content']
					     );
		//实例化dao
		$caseDao = new CaseDao();
		if($caseDao->addDiscuss($discussDetail)){
			//跳转回页面 
			StackConst::jump_page($upPageUrl);
		}else{
			echo "添加评论失败！";
			exit;
		}
	}else{
		//跳转到登录页面
		StackConst::jump_page("../view/caseuserlogin.php");
	}
	
	
}

//注销登录
if("logout" == $type_get){
	require_once '../../../util/StackConst.php';
	//获得从哪来的页面
	$upPageUrl = @$_SERVER["HTTP_REFERER"];
	//注销信息
	unset($_SESSION['userLoginMessage']);
	//跳转回页面 
	StackConst::jump_page($upPageUrl);
}

?>