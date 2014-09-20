<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
require_once '../../../util/StackConst.php';

//获取操作类型值
$type = @$_POST['type'] == "" ? @$_GET['type']:@$_POST['type'];

if("addCate" == $type){
	
	$arrCategoryInfo = array(
				"in_cat_content" => @$_POST['in_cat_content']
	);
	
	//引入CategoryDao
	require_once '../dao/CategoryDao.php';
	//实例化CategoryDao
	$categoryDao = new CategoryDao();
	
	if($categoryDao->addCategory($arrCategoryInfo)){
		echo "添加招聘类别成功！";
		StackConst::jump_page("../view/inrea1categorylist.php");
	}else{
		echo "添加招聘类别失败！";
	}
	
}else if("deleteCate" == $type){
	//引入CategoryDao
	require_once '../dao/CategoryDao.php';
	//实例化CategoryDao
	$categoryDao = new CategoryDao();
	
	if($categoryDao->deleteCategoryById(@$_GET['in_cat_id'])){
		echo "添加招聘类别成功！";
		StackConst::jump_page("../view/inrea1categorylist.php");
	}else{
		echo "添加招聘类别失败！";
	}
}
?>