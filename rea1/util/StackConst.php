<?php

class StackConst {

	//access_token
 //https://openapi.baidu.com/oauth/2.0/authorize?response_type=token&client_id=GBTxuPA7GcfEC9NX3yRTr8RT&redirect_uri=oob&scope=netdisk


	static public function access_token(){
		//return "3.d541dbadb6facdd1f5aa4e60265c8677.2592000.1382057441.2503423789-1356231";
		//return "3.323911847ecb3b24dff6b367aa20714c.2592000.1384711244.2503423789-1356231";
		//return "3.ffc11bf550cca29dbdf5949b97049a11.2592000.1384712260.2503423789-1356231";
		//return "3.aa5ceedd8ad9af715b7bfb5631c686e2.2592000.1387364790.2503423789-1356231";
		//2013年12月19日
		//return "23.41a6fe1a11e17dcaa84f71e63338cc86.2592000.1390013904.2503423789-1356231";
		//2014年1月23日
	          return "23.33f487b3ca693d517659fb85bac871b1.2592000.1393055269.1947764420-1356231";
	}
	
	//资源全局路径
	static public function pcs_url(){
		return "/apps/stack/shares/";
	}
	
	//图片路径
	static public function pcs_pic_url(){
		return "/apps/stack/shares/picture/";
	}
	
	//跳转
	static public function jump_page($url){
		echo "<script language='javascript' type='text/javascript'>";
		echo "window.location.href='$url'";
		echo "</script>";
	}
	
}

?>