<?php

/**
 * add by fuzhengwei 2013年8月28日 23:14:39
 * 获得数据库连接
 */
class ConnMysql {

	static public function getConnMysql(){
		/**
		 * 测试连接
		 */
		$conn = mysql_connect("localhost","root","123");
		
		mysql_query("SET NAMES UTF8");

		return $conn;
	}
	
	/**
	 * 获得数据库名字
	 *
	 * @return 数据库名
	 */
	static public function getDBName(){
		//本地
		return "itstack";
	}
}

?>