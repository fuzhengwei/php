<?php

class BookDao {

	/**
	 * 分享书籍
	 * 返回true/false
	 */
	public function shareBook($arrBook){
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		$conn = ConnMysqlClass::getConnMysql();
		
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$fk_user_id = $arrBook['fk_user_id'];
		$resource_book_language = $arrBook['resource_book_language'];
		$resource_book_name = $arrBook['resource_book_name'];
		$resource_book_url = $arrBook['resource_book_url'];
		$resource_book_size = $arrBook['resource_book_size'];
		$resource_book_level = $arrBook['resource_book_level'];
		$resource_book_review = $arrBook['resource_book_review'];
		$resource_book_word = $arrBook['resource_book_word'];
		$resource_book_date = $arrBook['resource_book_date'];
		
		$sql = "insert into stack_resource_book(fk_user_id,resource_book_language,resource_book_name,resource_book_url,resource_book_size,resource_book_level,resource_book_review,resource_book_word,resource_book_date) values($fk_user_id,'$resource_book_language','$resource_book_name','$resource_book_url','$resource_book_size','$resource_book_level','$resource_book_review','$resource_book_word','$resource_book_date')";
		
		$myq = mysql_query($sql,$conn);
		
		mysql_close($conn);
		
		return $myq;
	}
	
	/**
	 * 判断书籍是否存在
	 * 返回true/false
	 */
	public function isExitByBookName($resource_book_name){
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		$conn = ConnMysqlClass::getConnMysql();
		
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$sql = "select resource_book_id from stack_resource_book where resource_book_name = '$resource_book_name'";
		
		$result = mysql_query ( $sql );
		$row = mysql_fetch_array($result);
		
		
		return $row['resource_book_id'] == "" ? true : false;
		
	}
	
}

?>