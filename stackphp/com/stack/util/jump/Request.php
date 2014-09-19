<?php
/**
 * create by fuzhengwei
 * date 2014-5-18
 * QQ 184172133
 */
class Request {

	/**
	 * @param 跳转 $url
	 */
	static public function jump_page($url){
		echo "<script language='javascript' type='text/javascript'>";
		echo "window.location.href='$url'";
		echo "</script>";
	}
	
}

?>