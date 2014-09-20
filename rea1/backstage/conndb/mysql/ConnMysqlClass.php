<?php

class ConnMysqlClass {

	static public function getConnMysql(){
		//$conn = mysql_connect("localhost","root","123");
		
		$host = getenv('HTTP_BAE_ENV_ADDR_SQL_IP');
		$port = getenv('HTTP_BAE_ENV_ADDR_SQL_PORT');
		$user = getenv('HTTP_BAE_ENV_AK');
		$pwd = getenv('HTTP_BAE_ENV_SK');


		$conn = @mysql_connect("{$host}:{$port}",$user,$pwd,true);

//		$conn = mysql_connect("localhost","root","123");
		
		mysql_query("SET NAMES UTF-8");

		return $conn;
	}
	
	static public function getDBName(){
//		return "stack";
		return "pfFQNGRrQrktvrDclgjn";
	}
}

?>