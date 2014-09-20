<?php
//关闭异常报错
ini_set("error_reporting","E_ALL & ~E_NOTICE");
//设置时间格式
date_default_timezone_set('Asia/Shanghai');

class StackConst {
	
	/**
	 * @return Ymd 20131118
	 *
	 */
	static public function get_date_min(){
		//获取时间
		$dateTime = date('Ymd');
		//返回系统时间
		return $dateTime;
	}
	
	/**
	 * @return Y-m-d
	 */
	static public function get_date_sort(){
		//获取时间
		$dateTime = date('Y-m-d');
		//返回系统时间
		return $dateTime;
	}
	/**
	 * @return Y-m-dH:i:s
	 */
	static public function get_date(){
		//获取时间
		$dateTime = date('Y-m-d H:i:s');
		//返回系统时间
		return $dateTime;
	}
	
	/**
	 * @return 获取时间戳
	 */
	static public function get_date_str(){
		
		//获取时间
		$dateTime = date('Y-m-d H:i:s');
		
		//获得时间串
		$year=((int)substr($dateTime,0,4));//取得年份
		$month=((int)substr($dateTime,5,2));//取得月份
		$day=((int)substr($dateTime,8,2));//取得几号
		$second = ((int)substr($dateTime,11,2));//取得几号
		$minute = ((int)substr($dateTime,14,2));//取得几号
		$hour = ((int)substr($dateTime,17,2));//取得几号
		
		//返回时间戳
		return mktime($hour,$minute,$second,$month,$day,$year);
		
	}
	
	/**
	 * @return 图片路径
	 */
	static public function res_pic_url(){
		return "../picstack/";
	}
	
	/**
	 * @return 文件路径
	 */
	static public function res_file_url(){
		return "../filestack/";
	}
	
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