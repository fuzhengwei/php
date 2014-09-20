<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
header ( 'Content-type: text/html; charset=utf-8' );
/**
 * 上传图片
 */
class UpLoad {

	/**
	 * 上传图片
	 *
	 * @param 图片文件 $file
	 * @param 图片名称即用户名 $user_head_img_name
	 */
	public function upLoadImg($file,$user_head_img_name){
		
		//上传验证
		if ($file["error"] > 0) {
			echo "上传错误！";
			exit;
		} 
		
		//对文件大小对比1000KB以下的图片可以上传
		if(($file["size"] / 1024) > 1024){
			echo "图片太大不能上传!";
			exit;
		}
		
		//对文件类型对比
		$imgSuffix = ".jpg";
		if($file["type"] == "image/png"){
			$imgSuffix = ".png";
		}else if($file["type"] == "image/gif"){
			$imgSuffix = ".gif";
		}
		
		//设置时间格式
		date_default_timezone_set('Asia/Shanghai');
		//获得时间
		$dateTime = date('Y-m-d H:i:s');
		
		//获得时间串
		$year=((int)substr($dateTime,0,4));//取得年份
		$month=((int)substr($dateTime,5,2));//取得月份
		$day=((int)substr($dateTime,8,2));//取得几号
		$second = ((int)substr($dateTime,11,2));//取得几号
		$minute = ((int)substr($dateTime,14,2));//取得几号
		$hour = ((int)substr($dateTime,17,2));//取得几号
		
		
		//转编码
		//$iconv_user_head_img_name = iconv("utf-8","gb2312",$user_head_img_name); 
		//由于转码依旧有乱码，不能正确上传图片，所以用时间串树立
		$iconv_user_head_img_name = mktime($hour,$minute,$second,$month,$day,$year);
		
		//配置路径
		$imgUrlAndName = "../../user/userimg/" . $iconv_user_head_img_name . $imgSuffix;
		
		//移动缓存上传图片
		if(!move_uploaded_file ($file["tmp_name"], $imgUrlAndName))
	    {
	        echo "移动文件出错";
	        exit;
	    }
	    
	    //返回图片名有后缀名的
	    return  $iconv_user_head_img_name . $imgSuffix;
		
	}
	
	/**
	 * 删除上传的图片
	 *
	 * @param 图片名称 $delete_old_img_url
	 */
	public function deleteUploadImg($delete_old_img_name){
		$delete_old_img_name = iconv("utf-8","gb2312",$delete_old_img_name);
		
		return unlink("../../user/userimg/" .$delete_old_img_name);
	}
		
}

?>