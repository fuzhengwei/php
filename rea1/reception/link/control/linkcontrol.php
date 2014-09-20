<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
session_start ();
// 保存一天 
$lifeTime = 24 * 3600; 
setcookie(session_name(), session_id(), time() + $lifeTime, "/");
header ( 'Content-type: text/html; charset=utf-8' );
ini_set("error_reporting","E_ALL & ~E_NOTICE");
//设置时间格式
date_default_timezone_set('Asia/Shanghai');
//获得时间
$dateTime = date('Y-m-d H:i:s');

$type = @$_POST['type'];

if("sharelink" == $type){
	require_once '../dao/LinkDao.php';
	require_once '../../../util/StackConst.php';
	$linkDao = new LinkDao();
	//分享链接
	$fk_user_id = $_SESSION['userLoginMessage']['user_id'];
	$fk_category_sort_name = @$_POST['fk_category_sort_name'];
	$fk_language_sort_name = @$_POST['fk_language_sort_name'];
	$resource_link_name = @$_POST['resource_link_name'];
	$resource_link_url = @$_POST['resource_link_url'];
	$resource_link_content = @$_POST['resource_link_content'];
	$resource_link_data = $dateTime;
	
	$resourceLink = array(
						"fk_user_id"=>$fk_user_id,
						"fk_category_sort_name"=>$fk_category_sort_name,
						"fk_language_sort_name"=>$fk_language_sort_name,
						"resource_link_name"=>$resource_link_name,
						"resource_link_url"=>$resource_link_url,
						"resource_link_content"=>$resource_link_content,
						"resource_link_data"=>$resource_link_data
					);
	if($linkDao->shareLink($resourceLink)){
		StackConst::jump_page("../view/linklist.php?fk_category_sort_name=$fk_category_sort_name");			
	}
	
}
?>