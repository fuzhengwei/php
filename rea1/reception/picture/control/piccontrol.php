<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
require_once '../../../util/StackConst.php';
//开启session
session_start ();
//设置时间格式
date_default_timezone_set('Asia/Shanghai');
//获取操作类型值
$type = @$_POST['type'];
$type = $type == "" ? @$_GET['type'] : $type;

//uploadpic 上传图片
//ajaxgetpiclist 异步获得图片列表【分页方式获得】
if("uploadpic" == $type){
 	$picArray = array("1"=>"GIF","2"=>"JPG","3"=>"PNG");
	//引入PicDao
	require_once '../dao/PicDao.php';
	//实例化
	$picDao = new PicDao();
	
	//验证用户是否登录，或者登录信息已经失效
	if (!isset ( $_SESSION ['userLoginMessage'] )) {
		echo "请先登录";
		
	}
	
	//先验证图片是否提交
	if(isset ( $_FILES ["file"] )){
		
		$file = @$_FILES['file'];
		
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
		//获取时间
		$dateTime = date('Y-m-d H:i:s');
		
		//获得时间串
		$year=((int)substr($dateTime,0,4));//取得年份
		$month=((int)substr($dateTime,5,2));//取得月份
		$day=((int)substr($dateTime,8,2));//取得几号
		$second = ((int)substr($dateTime,11,2));//取得几号
		$minute = ((int)substr($dateTime,14,2));//取得几号
		$hour = ((int)substr($dateTime,17,2));//取得几号
		
		//获取用户id
		$user_id = $_SESSION['userLoginMessage']['user_id'];
		
		//获取图片类型jpg gif png
		$picInfo_typeNum = $picInfo[2];
		//由于转码依旧有乱码，不能正确上传图片，所以用时间串[user_id+时间串+图片名称]
		$pic_name = $user_id.mktime($hour,$minute,$second,$month,$day,$year).".".$picArray[$picInfo_typeNum];
			
		if($picDao->upLoadPic($file["tmp_name"],$pic_name)){
			//装载需要插入数据库的数据
			$arrPicInfo = array(
								"fk_user_id"=>$user_id,	//用户id默认为1以后从session获得
								"pic_name"=>$pic_name,
								"pic_type"=>@$_POST['pic_type'],
								"pic_highlight"=>@$_POST['pic_highlight'],
								"pic_width"=>$picInfo[0],
								"pic_height"=>$picInfo[1],
								"pic_size"=>$fileSize,
								"pic_up_data"=>$dateTime,
								"pic_statue"=>"0"
			);
			
			if($picDao->InsertPic($arrPicInfo)){
				echo "图片上传成功";
				StackConst::jump_page("../view/piclist.php");	
			}else{
				echo "图片保存失败";
			}
		}else{
			echo "图片上传失败";
		}

	}
	
	
}
?>
