<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
header ( 'Content-type: text/html; charset=utf-8' );
//ini_set("error_reporting","E_ALL & ~E_NOTICE");

/*********************************************************************
 * 新闻操作DAO
 * add by fuzhengwei
 * 2013年11月16日 18:08:29
 *********************************************************************/
class NewsDao{
	
	/**
	 * 获取新闻列表
	 * @return 新闻列表
	 */
	public function getNewsList(){
		
		//引入数据库操作类
		require_once '../conndb/mysql/ConnMysqlClass.php';
		
		//链接数据库
		$conn = ConnMysqlClass::getConnMysql();
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$str_sql = "select news_id,news_title,news_content,news_createdate from rea1_news order by news_id desc";
		
		$result = mysql_query($str_sql);
	
		$arrNews = array();
		$var = 0;
		
		while($row = mysql_fetch_array($result)){
			
			$arrNews[$var++] = array(
								"news_id"=>$row['news_id'],
								"news_title"=>$row['news_title'],
								"news_content"=>$row['news_content'],
								"news_createdate"=>	$row['news_createdate']
			);
		}
		
		
		mysql_close($conn);
		
		return $arrNews;
	}
}


?>