<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
require_once '../../../util/StackConst.php';

//获取操作类型值
$type = @$_POST['type'] == "" ? @$_GET['type']:@$_POST['type'];

if("addRec" == $type){
	
	$arrRecruitmentInfo = array(
								"fk_in_category" => @$_POST['fk_in_category'],
								"in_content" => @$_POST['in_content']
	);
	
	//引入招聘操作DAO类
	require_once '../dao/RecruitmentDao.php';
	//实例化招聘类
	$recruitmentDao = new RecruitmentDao();
	
	if($recruitmentDao->addRecruitment($arrRecruitmentInfo)){
		echo "招聘信息保存成功！";
		StackConst::jump_page("../view/inrea1recruitmentlist.php");
	}else{
		echo "招聘信息保存失败！";
	}
	
}else if("deleteRec" == $type){
	//引入招聘操作DAO类
	require_once '../dao/RecruitmentDao.php';
	//实例化招聘类
	$recruitmentDao = new RecruitmentDao();
	
	if($recruitmentDao->deleteRecruitmentById(@$_GET['in_id'])){
		echo "招聘信息保存成功！";
		StackConst::jump_page("../view/inrea1recruitmentlist.php");
	}else{
		echo "招聘信息保存失败！";
	}
}else if("updateRec" == $type){
	//引入招聘操作DAO类
	require_once '../dao/RecruitmentDao.php';
	//实例化招聘类
	$recruitmentDao = new RecruitmentDao();
	
	$arrRecruitmentInfo = array(
								"in_id" => @$_POST['in_id'],
								"fk_in_category" => @$_POST['fk_in_category'],
								"in_content" => @$_POST['in_content']
		);
		
	if($recruitmentDao->updateRecruitmentById($arrRecruitmentInfo)){
			echo "招聘信息修改成功！";
			StackConst::jump_page("../view/inrea1recruitmentlist.php");
		}else{
			echo "招聘信息修改失败！";
		}	
		
}
?>