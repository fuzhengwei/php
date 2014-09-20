<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
require_once '../../../util/StackConst.php';

//获取操作类型值
$type = @$_POST['type'] == "" ? @$_GET['type']:@$_POST['type'];
if("addDown" == $type){
	$arrDownInfo = array(
						"fk_down_id"=>@$_POST['fk_down_id']
	);
	
	//引入文件操作类
	require_once '../dao/DownDao.php';
	//实例化文件操作类
	$downDao = new DownDao();
	
	if($downDao->addDown($arrDownInfo)){
		echo "文件资源保存成功！";
		StackConst::jump_page("../view/resdownlist.php");
	}else{
		echo "文件资源保存失败！";
	}
	
}else if("deleteDown" == $type){

	//引入文件操作类
	require_once '../dao/DownDao.php';
	//实例化文件操作类
	$downDao = new DownDao();
	
	if($downDao->deleteDownById(@$_GET['sup_res_down_id'])){
		echo "文件资源删除成功！";
		StackConst::jump_page("../view/resdownlist.php");
	}else{
		echo "文件资源删除失败！";
	}
}
?>