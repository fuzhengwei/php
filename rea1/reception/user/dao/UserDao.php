<?php

class UserDao {

	/*
	 * 注册用户
     */
	public function registerUser($user_name,$user_pwd,$user_email){
		
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		$conn = ConnMysqlClass::getConnMysql();
		
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		//获得当前时间
    	date_default_timezone_set('Asia/Shanghai');
		$user_create_date = date('Y-m-d H:i:s');
		
		$sql = "insert into stack_user(user_name,user_email,user_pwd,user_create_date) values('$user_name','$user_email','$user_pwd','$user_create_date')";
		
		$myq = mysql_query($sql,$conn);
		
		mysql_close($conn);
		
		return $myq;
	}
	
	/**
	 * 通过传递集合方式注册
	 *
	 * @param 集合 $userMessage
	 */
	public function registerUserByArray($userMessage){
		
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		$conn = ConnMysqlClass::getConnMysql();
		
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$user_name = $userMessage['user_name'];
		$user_email = $userMessage['user_email'];
		$user_head_img_name = $userMessage['user_head_img_name'];
		$user_pwd = $userMessage['user_pwd'];
		$user_create_date = $userMessage['user_create_date'];
		
		$sql = "insert into stack_user(user_name,user_email,user_head_img_name,user_pwd,user_create_date) values('$user_name','$user_email','$user_head_img_name','$user_pwd','$user_create_date')";
		
		$myq = mysql_query($sql,$conn);
		
		mysql_close($conn);
		
		return $myq;
		
	}
	
	/*
	 * 登录用户
     */
	public function loginUser($user_name,$user_pwd){
		
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		$conn = ConnMysqlClass::getConnMysql();
		
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$sql = "select user_id,user_name,user_head_img_name from stack_user where user_name = '$user_name' and user_pwd = '$user_pwd'";
		
		$result = mysql_query($sql);
		
		$row = mysql_fetch_array($result);
		
		$user_name = $row['user_name'];
		$user_id = $row['user_id'];
		$user_head_img_name = $row['user_head_img_name'];
		
		$userArrs = array('user_name'=>$user_name,'user_id'=>$user_id,"user_head_img_name"=>$user_head_img_name);
		
		return $userArrs;
		
	}
	
	/**
	 * 根据id获得用户名字
     */
	public function getUserById($user_id){
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		$conn = ConnMysqlClass::getConnMysql();
		
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$sql = "select user_name from stack_user where user_id = $user_id";
		
		$result = mysql_query($sql);
		
		$row = mysql_fetch_array($result);
		
		$user_name = $row['user_name'];
		
		return $user_name;
	}
	
	/**
	 * 根据id获得用户头像图片名
	 */
	public function getUserHeadImgNameById($user_id){
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		$conn = ConnMysqlClass::getConnMysql();
		
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$sql = "select user_head_img_name from stack_user where user_id = $user_id";
		
		$result = mysql_query($sql);
		
		$row = mysql_fetch_array($result);
		
		$user_head_img_name = $row['user_head_img_name'];
		
		return $user_head_img_name;
	}
	
	/**
	 * 根据用户名获得id
	 * 判断这个用户是否存在
	 *
	 * @param 用户名 $user_name
	 */
	public function getUserIdByName($user_name){
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		$conn = ConnMysqlClass::getConnMysql();
		
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$result = mysql_query("SELECT user_id FROM stack_user WHERE user_name = '$user_name'");
		
		$row = mysql_fetch_array($result);
		
		$user_id = $row['user_id'];

		mysql_close($conn);
		
		//大于0说明已经有这个用户了，不能注册了，小于0说明没这个用户可以注册
		return $user_id > 0 ? "0":"1"; 
	}
	
}

?>