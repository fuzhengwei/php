<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
require_once '../../../util/StackConst.php';

//获取操作类型值
$type = @$_POST['type'] == "" ? @$_GET['type']:@$_POST['type'];

if("addTecs" == $type){
	
	$arrTecsInfo = array(
						"sup_res_sup_tecs_coutent"=>@$_POST['sup_res_sup_tecs_coutent']
	);
	
	//引入技术支持操作DAO
	require_once '../dao/TecsDao.php';
	//实例化DAO
	$tecsDao = new TecsDao();
	
	if($tecsDao->addTecs($arrTecsInfo)){
		echo "新增技术信息成功！";
		StackConst::jump_page("../view/restecslist.php");
	}else {
		echo "新增技术信息失败！";
	}
	
	
}else if("deleteTecs" == $type){
	//引入技术支持操作DAO
	require_once '../dao/TecsDao.php';
	//实例化DAO
	$tecsDao = new TecsDao();
	
	if($tecsDao->deleteTecsById(@$_GET['sup_res_sup_tecs_id'])){
		echo "删除技术信息成功！";
		StackConst::jump_page("../view/restecslist.php");
	}else {
		echo "删除技术信息失败！";
	}
}
?>