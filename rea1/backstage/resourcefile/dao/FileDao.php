<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
header ( 'Content-type: text/html; charset=utf-8' );
ini_set("error_reporting","E_ALL & ~E_NOTICE");

/********************************************************************
 * 文件操作DAO
 * add by fuzhengwei 
 * 2013年11月17日 09:38:00
 ********************************************************************/
class FileDao{
	
	/**
	 * 获取文件集合
	 *
	 */
	public function getFileList(){
		
		//引入数据库操作类
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		//链接数据库
		$conn = ConnMysqlClass::getConnMysql();
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$str_sql = "select down_id,down_name,down_urlname,down_savedate,down_statue from rea1_resource_down order by down_id desc";
		
		$result = mysql_query($str_sql);
		
		$arrFiles = array();
		$var = 0;
		
		while($row = mysql_fetch_array($result)){
			$arrFiles[$var++] = array(
										"down_id"=>$row['down_id'],
										"down_name"=>$row['down_name'],
										"down_urlname"=>$row['down_urlname'],
										"down_savedate"=>$row['down_savedate'],
										"down_statue"=>$row['down_statue']
			);
		}
		
		mysql_close($conn);
		
		return $arrFiles;
	}
	
	/**
	 * 根据id删除下载资源文件
	 * @param 文件id $down_id
	 * @return true/false
	 */
	public function deleteFileById($down_id){
		//引入数据库操作类
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		//链接数据库
		$conn = ConnMysqlClass::getConnMysql();
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$str_sql = "delete from rea1_resource_down where down_id = $down_id";
		
		$myq = mysql_query($str_sql,$conn);
		
		mysql_close($conn);
		
		return $myq;
		
	}
	
	/**
	 * 添加文件资源到数据库
	 * @param 文件资源信息 $arrFileInfo
	 */
	public function addFileSource($arrFileInfo){
		
		//引入数据库操作类
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		//链接数据库
		$conn = ConnMysqlClass::getConnMysql();
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$down_name = $arrFileInfo['down_name'];
		$down_urlname = $arrFileInfo['down_urlname'];
		$down_savedate = $arrFileInfo['down_savedate'];
		
		$str_sql = "insert into rea1_resource_down(down_name,down_urlname,down_savedate) values('$down_name','$down_urlname','$down_savedate')";
		
		$myq = mysql_query($str_sql,$conn);
		
		mysql_close($conn);
		
		return $myq;
		
	}
	
}


?>