<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
header ( 'Content-type: text/html; charset=utf-8' );
ini_set("error_reporting","E_ALL & ~E_NOTICE");
//pic 图片dao
class PicDao{
	
	/********************************************
	 *上传图片分两步，第一步图片上传到百度pcs个人云存储
	 *第二步，图片信息写到数据库
	 ********************************************/
	
	/**
	 * 上传图片到PCS
	 * @param 图片路径 $file
	 * @param 图片名称【用户id+时间串】 $fileName 
	 */
	public function upLoadPic($tmp_name,$fileName){
		$rel = false;
		//引入pcs操作类
		require_once '../../../util/pcs/libs/BaiduPCS.class.php';
		require_once '../../../util/StackConst.php';
		
		//请根据实际情况更新$access_token与$appName参数
		$access_token = StackConst::access_token();
		//应用目录名"/apps/stack/shares/picture/"
		$targetPath = StackConst::pcs_pic_url();
		
		$pcs = new BaiduPCS($access_token);
		//新文件名默认给空
		$newFileName = "";
		
		$result = $pcs->upload(file_get_contents($tmp_name), $targetPath, $fileName, $newFileName);
		
		$flist = json_decode($result);
		if(isset($flist)){
			$rel = $flist > 0 ? true : false;
		}
		//成功返回true/失败返回false
		return $rel;
	}
	
	/*
	 * 获取图片信息列表
	 * @param 图片分页 $page
	 */
	public function getPicList($page,$pic_type){
		//引入数据库连接
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		require_once '../../user/dao/UserDao.php';
		//定义每页的条数
	    $pageCount = 10;
		
		//如果是0页或者没有赋值那么默认给第一页
		if("" == $page || 0 == $page){
			$page = 1;
		}
		//分页数据
		$page_start = ($page - 1) * $pageCount;
		//获取数据库链接
		$conn = ConnMysqlClass::getConnMysql();
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$str_sql = "select pic_id,fk_user_id,pic_name,pic_type,pic_highlight,pic_width,pic_height,pic_size,pic_up_data,pic_statue from stack_resource_pic ";
		
		//分页查询【数量】
		$str_sql_count = "select count(pic_id) from stack_resource_pic ";
		
		if("" != $pic_type){
			$str_sql .= "where pic_type = '$pic_type' ";
			$str_sql_count .= "where  pic_type = '$pic_type' ";
		}
		
		$str_sql .= "order by pic_id desc limit $page_start,$pageCount";
		
		$result = mysql_query($str_sql);
		
		$arrPics = array();
		$var = 0;
		//根据用户id查询用户名
		$userDao = new UserDao();
		while($row = mysql_fetch_array($result)){
			$arrPics[$var++] = array(
										"pic_id"=>$row['pic_id'],
										"fk_user_id"=>$row['fk_user_id'],
										'user_head_img_name'=>$userDao->getUserHeadImgNameById($row['fk_user_id']),
										'user_name' =>$userDao->getUserById($row['fk_user_id']),
										"pic_name"=>$row['pic_name'],
										"pic_type"=>$row["pic_type"],
										"pic_highlight"=>$row['pic_highlight'],
										"pic_width"=>$row['pic_width'],
										"pic_height"=>$row['pic_height'],
										"pic_size"=>$row['pic_size'],
										"pic_up_data"=>$row['pic_up_data'],
										"pic_statue"=>$row['pic_statue']
			);
		}
		
		//查询数量能分出来多少页
		$result = mysql_query ( $str_sql_count );
		$row = mysql_fetch_array($result);
		//获得分页		
		$pageNum = ceil($row[0] / $pageCount);
		$arrPics['pageSum'] = strval($pageNum);
		
		mysql_close($conn);
		
		return $arrPics;
	}
	
	/*
	 * 获得图片分类以及数量
	 */
	public function getEachPicCount(){
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		$conn = ConnMysqlClass::getConnMysql();
		
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$str_sql = "select pic_type,count(pic_type) from stack_resource_pic group by pic_type order by count(pic_type) desc";
		$result = mysql_query ( $str_sql );
		$eachPicCount = array();
		$var = 0;
		while($row = mysql_fetch_array($result)){
			$eachPicCount[$var++] = array(		
											    'pic_type'=>$row[0],
												$row[0]=>$row[1]
										   );
		}
		//关闭数据库
		mysql_close($conn);
		
		return $eachPicCount;
	}
	
	/**
	 * 图片信息写入数据库
	 * @param 图片info $arrPicInfo
	 */
	public function InsertPic($arrPicInfo){
		//引入数据库连接
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		$conn = ConnMysqlClass::getConnMysql();
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$fk_user_id = $arrPicInfo['fk_user_id'];
		$pic_name = $arrPicInfo['pic_name'];
		$pic_type = $arrPicInfo['pic_type'];
		$pic_highlight = $arrPicInfo['pic_highlight'];
		$pic_width = $arrPicInfo['pic_width'];
		$pic_height = $arrPicInfo['pic_height'];
		$pic_size = $arrPicInfo['pic_size'];
		$pic_up_data = $arrPicInfo['pic_up_data'];
		$pic_statue = $arrPicInfo['pic_statue'];
		
		$str_sql = "insert into stack_resource_pic(fk_user_id,pic_name,pic_type,pic_highlight,pic_width,pic_height,pic_size,pic_up_data,pic_statue) values($fk_user_id,'$pic_name','$pic_type','$pic_highlight','$pic_width','$pic_height','$pic_size','$pic_up_data','$pic_statue')";
		
		$myq = mysql_query($str_sql,$conn);
		
		mysql_close($conn);
		
		return $myq;
	}
		
}
?>
