<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
header ( 'Content-type: text/html; charset=utf-8' );
ini_set("error_reporting","E_ALL & ~E_NOTICE");
class BookDao {
	
	/**
	 * 分享书籍
     */
	public function shareBook($arrBook){
		
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		$conn = ConnMysqlClass::getConnMysql();
		
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		//获得当前时间
    	date_default_timezone_set('Asia/Shanghai');
		
		$fk_user_id = $arrBook['fk_user_id'];
		$resource_book_language = $arrBook['resource_book_language'];
		$resource_book_name = $arrBook['resource_book_name'];
		$resource_book_url = $arrBook['resource_book_url'];
		$resource_book_size = $arrBook['resource_book_size'];
		$resource_book_level = $arrBook['resource_book_level'];
		$resource_book_review = $arrBook['resource_book_review'];
		$resource_book_word = $arrBook['resource_book_word'];
		$resource_book_date = date('Y-m-d H:i:s');
		
		$sql = "insert into stack_resource_book(fk_user_id,resource_book_language,resource_book_name,resource_book_url,resource_book_size,resource_book_level,resource_book_review,resource_book_word,resource_book_date) values($fk_user_id,'$resource_book_language','$resource_book_name','$resource_book_url','$resource_book_size','$resource_book_level','$resource_book_review','$resource_book_word','$resource_book_date')";
		
		$myq = mysql_query($sql,$conn);
		
		mysql_close($conn);
		
		return $myq;
	}
	
	/**
	 * 获取书籍 
	 * 初始化方式的
     */
	public function getBookList($page,$language,$word){
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		require_once '../../user/dao/UserDao.php';
		
		//定义每页10本
		$pageSize = 30;
		
		//如果是0页或者没有赋值那么默认给第一页
		if("" == $page || 0 == $page){
			$page = 1;
		}
		
		$page_start = ($page-1) * $pageSize;
		
		$userDao = new UserDao();
		
		$conn = ConnMysqlClass::getConnMysql();
		
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$str_sql = "";
		//如果language不等于空，那么就加上这个条件
		if("" != $language){
			$str_sql = "select * from stack_resource_book where resource_book_language = '$language' order by resource_book_id desc limit $page_start,$pageSize ";
		}else if("" != $word){
			$str_sql = "select * from stack_resource_book where resource_book_name like '%$word%' order by resource_book_id desc limit $page_start,$pageSize ";
		}else{
			$str_sql = "select * from stack_resource_book order by resource_book_id desc limit $page_start,$pageSize "; //0 1,3 4  
		}
		
		$result = mysql_query ( $str_sql );
		
		$arrBooks = array();
		$var = 0;
		
		while($row = mysql_fetch_array($result)){
			
			$arrBooks[$var++] = array(
										'page' =>$page,
										'resource_book_name' => $row['resource_book_name'],	
										'resource_book_size' => $row['resource_book_size'],	
										'resource_book_level' => $row['resource_book_level'],	
										'resource_book_review' => $row['resource_book_review'],	
										'resource_book_word' => $row['resource_book_word'],
										'resource_book_date' => $row['resource_book_date'],
										'user_name' => $userDao->getUserById($row['fk_user_id']),
										'resource_book_url' =>$row['resource_book_url']
							         );
			
		}

		mysql_close($conn);
		
		return $arrBooks;
	}
	
	/**
	 * 获得总页数【每页30条数据】
	 *
	 * @param unknown_type $language
	 * @param unknown_type $word
	 */
	public function getPageCount($language,$word){
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		$conn = ConnMysqlClass::getConnMysql();
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		$sql = "select count(resource_book_id) from stack_resource_book ";
		//组合sql
		if("" != $language && "" == $word){
			$sql .= "where resource_book_language = '$language'";		
		}else if("" != $word && "" == $language){
			$sql .= "where resource_book_name like '%$word%'";
		}else if("" != $word && "" != $language){
			$sql .= "where resource_book_language = '$language' and resource_book_name like '%$word%'";
		}
		
		$result = mysql_query ( $sql );
		$row = mysql_fetch_array($result);
		$pageCount = $row[0];
		mysql_close($conn);
		
		$pageNum = $pageCount / 30;
		
		ceil($pageNum);
	
		mysql_close($conn);		

		//返回页数
		return ceil($pageNum);
	}
	
	/**
	 * 获得每类书的数量
	 */
	public function getEachBookCount(){
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		$conn = ConnMysqlClass::getConnMysql();
		
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$str_sql = "select resource_book_language,count(resource_book_language) from stack_resource_book group by resource_book_language order by count(resource_book_language) desc"; 
		
		$result = mysql_query ( $str_sql );
		$eachBookCount = array();
		$var = 0;
		while($row = mysql_fetch_array($result)){
			$eachBookCount[$var++] = array(		
												'resource_book_language'=>$row[0],
												$row[0]=>$row[1]
										   );
		}
		
		mysql_close($conn);
		
		return $eachBookCount;
	}
	
	/**
         * 获得所有书籍总量
	 */
	public function getBookCount(){

		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		$conn = ConnMysqlClass::getConnMysql();
		
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);

		$str_sql = "select count(resource_book_id) from stack_resource_book";

		$result = mysql_query ( $str_sql );

		$row = mysql_fetch_array($result);

		$bookCount = $row[0];

		mysql_close($conn);		

		return $bookCount;
		
	}
}

?>