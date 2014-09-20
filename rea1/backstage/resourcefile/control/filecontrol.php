<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
require_once '../../../util/StackConst.php';

//获取操作类型值
$type = @$_POST['type'] == "" ? @$_GET['type']:@$_POST['type'];

//上传文件
if("uploadfile" == $type){
	if(isset ( $_FILES ["file_file"] )){
		$file = @$_FILES['file_file'];
		
		//上传验证
		if ($file["error"] > 0) {
			echo "上传错误！";
			exit;
		} 
		
		//对文件大小对比1000KB以下的图片可以上传
		$fileSize = sprintf("%.2f",($file["size"] / 1024 / 1024)); //M
		if($fileSize > 100){
			echo "文件太大超过100M不能上传!";
			exit;
		}
		
		//文件名称
		$down_name = $file['name'];
		$down_urlname = StackConst::get_date_str().substr($down_name,strrpos($down_name,"."),strlen($down_name));
		
		//从缓存区移动文件
		if(move_uploaded_file($file["tmp_name"],StackConst::res_file_url().$down_urlname)){
			
			
			//装填信息
			$arrFileInfo = array(
								"down_name"=>@$_POST['down_name'],
								"down_urlname"=>$down_urlname,
								"down_savedate"=>StackConst::get_date()
			);
			
			//引入FileDao
			require_once '../dao/FileDao.php';
			//实例化FileDao
			$fileDao = new FileDao();
			
			if($fileDao->addFileSource($arrFileInfo)){
				echo "文件上传成功！";
				StackConst::jump_page("../view/filelist.php");
			}else{
				echo "文件上传失败！";
			}
		}else{
			echo "文件上传失败！";
		}
		
	}
}else if("deleteFile" == $type){
	
	//引入FileDao
	require_once '../dao/FileDao.php';
	//实例化FileDao
	$fileDao = new FileDao();
	
	if($fileDao->deleteFileById(@$_GET['down_id'])){
		echo "文件资源删除成功！";
		StackConst::jump_page("../view/filelist.php");
	}else{
		echo "文件资源删除失败！";
	}
	
}
?>