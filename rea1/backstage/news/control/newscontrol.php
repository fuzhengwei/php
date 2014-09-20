<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
require_once '../../../util/StackConst.php';

//获取操作类型值
$type = @$_POST['type'] == "" ? @$_GET['type']:@$_POST['type'];

if("addNews" == $type){
	$arrNewsInfo = array(
						"news_title"=>@$_POST['news_title'],
						"news_content"=>@$_POST['news_content'],
						"news_createdate"=>StackConst::get_date_sort()
	);
	
	//引入NewsDao
	require_once '../dao/NewsDao.php';
	//实例化新闻DAO
	$newsDao = new NewsDao();
	
	if($newsDao->addNews($arrNewsInfo)){
		echo "添加新闻信息成功！";
		StackConst::jump_page("../view/newslist.php");
	}else{
		echo "添加新闻信息失败！";
	}
}else if("deleteNews" == $type){
	//引入NewsDao
	require_once '../dao/NewsDao.php';
	//实例化dao
	$news = new NewsDao();
	if($news->deleteNewsById(@$_GET['news_id'])){
		echo "删除新闻信息成功！";
		StackConst::jump_page("../view/newslist.php");
	}else{
		echo "删除新闻信息失败！";
	}
}else if("updateNews" == $type){
	//修改新闻
	
	//引入NewsDao
	require_once '../dao/NewsDao.php';
	//实例化dao
	$newsDao = new NewsDao();
	
	$arrNewsInfo = array(
						"news_id"=>@$_POST['news_id'],
						"news_title"=>@$_POST['news_title'],
						"news_content"=>@$_POST['news_content'],
						"news_createdate"=>StackConst::get_date_sort()
		);
	
	if($newsDao->updateNewsById($arrNewsInfo)){
		echo "修改新闻信息成功！";
		StackConst::jump_page("../view/newslist.php");
	}else{
		echo "修改新闻信息失败！";
	}
		
	
}
?>