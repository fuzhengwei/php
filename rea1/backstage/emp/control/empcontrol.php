<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
//开启session
session_start();
//引入静态常量
require_once '../../../util/StackConst.php';

//获取操作类型值
$type = @$_POST['type'] == "" ? @$_GET['type']:@$_POST['type'];


if("doLogin" == $type){
	
	//验证仓库码
	if(StackConst::get_date_min() == @$_POST['loginCk']){
		
		$emp_name = @$_POST['emp_name'];
		$emp_pwd = @$_POST['emp_pwd'];

		if(strlen(strpos($emp_name,"or")) == 0 && strlen(strpos($emp_name,"OR")) == 0 && strlen(strpos($emp_pwd,"or")) == 0 && strlen(strpos($emp_pwd,"OR")) == 0 && strlen(strpos($emp_name,"oR")) == 0 && strlen(strpos($emp_name,"Or")) == 0 && strlen(strpos($emp_pwd,"oR")) == 0 && strlen(strpos($emp_pwd,"Or")) == 0){
			//引入雇员DAO 类
			require_once '../dao/EmpDao.php';
			//实例化dao
			$empDao = new EmpDao();
			$emp_name = $empDao->doLogin($emp_name,$emp_pwd);
			if("" != $emp_name){
				echo "登录成功！";
				$_SESSION['userLoginMessage'] = $emp_name;
				StackConst::jump_page("../../index.php");
			}else{
				echo "登录失败！";
				exit;
			}
			
			
		}else{
			echo "系统监测到账户密码输入异常！";
			exit;
		}
		
	}else{
		echo "REA1 后台仓库码有误，请联系管理员获取仓库码！";		
	}

	
}
?>