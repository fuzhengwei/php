<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
require_once '../../../util/StackConst.php';

//获取操作类型值
$type = @$_POST['type'] == "" ? @$_GET['type']:@$_POST['type'];

//新增加类别
if("addCategory" == $type){
	
	$arrCategoryInfo = array(
								"pro_cate_name"=>@$_POST['pro_cate_name']
		
	);
	//引入CategoryDao
	require_once '../dao/CategoryDao.php';
	//实例化产品DAO
	$categoryDao = new CategoryDao();
	
	if($categoryDao->addCategory($arrCategoryInfo)){
		echo "新增产品类别成功！";
		StackConst::jump_page("../view/categorylist.php");
	}else{
		echo "新增产品类别失败！";
	}
	
}else if("deleteCate" == $type){
	
	//引入CategoryDao
	require_once '../dao/CategoryDao.php';
	//实例化产品DAO
	$categoryDao = new CategoryDao();
	
	if($categoryDao->deleteCategoryById(@$_GET['pro_cate_id'])){
		echo "删除产品类别成功！";
		StackConst::jump_page("../view/categorylist.php");
	}else{
		echo "删除产品类别失败！";
	}
	
}
?>