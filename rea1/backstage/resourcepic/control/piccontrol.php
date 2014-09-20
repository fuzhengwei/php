<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
require_once '../../../util/StackConst.php';

//获取操作类型值
$type = @$_POST['type'] == "" ? @$_GET['type']:@$_POST['type'];
//uploadpic 上传图片
if("uploadpic" == $type){
	//预设置图片类型
	$picArray = array("1"=>"GIF","2"=>"JPG","3"=>"PNG");
	//先验证图片是否提交
	if(isset ( $_FILES ["pic_file"] )){
		$file = @$_FILES['pic_file'];
		
		//上传验证
		if ($file["error"] > 0) {
			echo "上传错误！";
			exit;
		} 
		
		//对文件大小对比1000KB以下的图片可以上传
		$fileSize = sprintf("%.2f",($file["size"] / 1024 / 1024)); //M
		if($fileSize > 1){
			echo "图片太大超过1M不能上传!";
			exit;
		}
		
		//获得图片信息，宽度 高度 类型
		$picInfo = GetImageSize($file["tmp_name"]);
		
		//获取图片类型jpg gif png
		$picInfo_typeNum = $picInfo[2];
		
		//图片路径名
		$pic_urlname = StackConst::get_date_str().".".$picArray[$picInfo_typeNum];
		
		if(move_uploaded_file($file["tmp_name"],StackConst::res_pic_url().$pic_urlname)){
			//图片上传成功后引入数据库操作
			require_once '../dao/PicDao.php';
			//实例化数据库
			$picDao = new PicDao();
			
			//装载需要插入数据库的数据
			$arrPicInfo = array(
						"pic_name"=>@$_POST['pic_name'],
						"pic_urlname"=>$pic_urlname,
						"pic_savedate"=>StackConst::get_date()
			);
		
			//保存图片信息到数据
			if($picDao->insertPic($arrPicInfo)){
				echo "图片上传成功！";
				StackConst::jump_page("../view/piclist.php");
			}else{
				echo "图片上传失败！";
			}
		}else{
			echo "图片上传失败！";
		}
		
		
	}
}else if("deletepic" == $type){
	//删除图片
	
	//图片上传成功后引入数据库操作
	require_once '../dao/PicDao.php';
	//实例化数据库
	$picDao = new PicDao();
	
	if($picDao->deletePicById(@$_GET['pic_id'])){
		echo "图片删除成功！";
		StackConst::jump_page("../view/piclist.php");
	}else{
		echo "图片删除失败！";
	}
	
	
}
?>
