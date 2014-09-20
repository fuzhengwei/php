<?php

class ConnMysqlClass {

	static public function getConnMysql(){

		
		$conn = mysql_connect("zjwdb_167564","zjwdb_167564","rea1123456789");
		
		mysql_query("SET NAMES UTF8");

		return $conn;
	}
	
	static public function getDBName(){
		return "zjwdb_167564";
	}
}

?>