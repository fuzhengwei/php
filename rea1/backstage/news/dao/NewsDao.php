<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
header ( 'Content-type: text/html; charset=utf-8' );
ini_set("error_reporting","E_ALL & ~E_NOTICE");

/*********************************************************************
 * 新闻操作DAO
 * add by fuzhengwei
 * 2013年11月16日 18:08:29
 *********************************************************************/
class NewsDao{
	
	/**
	 * 根据id获得信息信息
	 *
	 * @param 新闻id $news_id
	 * @return 新闻对象数组
	 */
	public function getNewsById($news_id){
		//引入数据库操作类
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		//链接数据库
		$conn = ConnMysqlClass::getConnMysql();
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$str_sql = "select news_id,news_title,news_content from rea1_news where news_id = $news_id";
		
		$result = mysql_query($str_sql);
		
		$arrNewsDetail = array();
		$row = mysql_fetch_array($result);
		
		$arrNewsDetail = array(
								"news_id" => $row['news_id'],
								"news_title" => $row['news_title'],
								"news_content" => str_replace("<br/>","\n",$row['news_content'])
		
		);
		
		mysql_close($conn);
		
		return $arrNewsDetail;
	}
	
	/**
	 * 获取新闻列表
	 * @return 新闻列表
	 */
	public function getNewsList(){
		//引入数据库操作类
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
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
	
	/**
	 * 根据id删除新闻信息
	 * @param 新闻id $news_id
	 * @return true/false
	 */
	public function deleteNewsById($news_id){
		//引入数据库操作类
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		//链接数据库
		$conn = ConnMysqlClass::getConnMysql();
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$str_sql = "delete from rea1_news where news_id = $news_id";
		
		$myq = mysql_query($str_sql,$conn);
		
		mysql_close($conn);
		
		return $myq;
	}
	
	/**
	 * 修改新闻信息
	 *
	 * @param 新闻信息 $arrNewsInfo
	 * @return T/F
	 */
	public function updateNewsById($arrNewsInfo){
		//引入数据库操作类
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		//链接数据库
		$conn = ConnMysqlClass::getConnMysql();
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$news_id = $arrNewsInfo['news_id'];
		$news_title = $arrNewsInfo['news_title'];
		$news_content = $arrNewsInfo['news_content'];
		$news_createdate = $arrNewsInfo['news_createdate'];
		
		$str_sql = "update rea1_news set news_title = '$news_title',news_content = '$news_content',news_createdate = '$news_createdate' where news_id = $news_id";
		
		$myq = mysql_query($str_sql,$conn);
		
		mysql_close($conn);
		
		return $myq;
	}
	
	
	/**
	 * 添加新闻信息
	 * @param 新闻信息 $arrNewsInfo
	 */
	public function addNews($arrNewsInfo){
		
		//引入数据库操作类
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		//链接数据库
		$conn = ConnMysqlClass::getConnMysql();
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$news_title = $arrNewsInfo['news_title'];
		$news_content = $arrNewsInfo['news_content'];
		$news_createdate = $arrNewsInfo['news_createdate'];
		
		$str_sql = "insert into rea1_news(news_title,news_content,news_createdate) values('$news_title','$news_content','$news_createdate')";
		
		$myq = mysql_query($str_sql,$conn);
		
		mysql_close($conn);
		
		return $myq;
	}
	
}


?>