<?php

class ConnMysqlClass {

	static public function getConnMysql(){

		/*
		$host = getenv('HTTP_BAE_ENV_ADDR_SQL_IP');
		$port = getenv('HTTP_BAE_ENV_ADDR_SQL_PORT');
		$user = getenv('HTTP_BAE_ENV_AK');
		$pwd = getenv('HTTP_BAE_ENV_SK');

		$conn = @mysql_connect("{$host}:{$port}",$user,$pwd,true);
		*/
		$conn = mysql_connect("localhost","zjwdb_167564","rea1123456789");
		
		mysql_query("SET NAMES UTF8");

		return $conn;
	}
	
	static public function getDBName(){
		//return "rea1";
		//return "pfFQNGRrQrktvrDclgjn";
		return "zjwdb_167564";
	}
}

?>