<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
header ( 'Content-type: text/html; charset=utf-8' );
ini_set("error_reporting","E_ALL & ~E_NOTICE");

/**
 * PicDao ͼƬ����DAO
 * add by fuzhengwei 
 * 2013��11��16��
 */
class PicDao{
	
	/**
	 * ͼƬ��Ϣ�������ݿ�
	 * @param ͼƬ��Ϣ���� $arrPicInfo
	 */
	public function insertPic($arrPicInfo){
		
		//�������ݿ������
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		//�������ݿ�
		$conn = ConnMysqlClass::getConnMysql();
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$pic_name = $arrPicInfo['pic_name'];
		$pic_urlname = $arrPicInfo['pic_urlname'];
		$pic_savedate = $arrPicInfo['pic_savedate'];
		
		$str_sql = "insert into rea1_resource_pic(pic_name,pic_urlname,pic_savedate) values('$pic_name','$pic_urlname','$pic_savedate')";
		
		$myq = mysql_query($str_sql,$conn);
		
		mysql_close($conn);
		
		return $myq;
	}
	
	/**
	 * ��ȡ���ݿ�ͼƬ��Ϣ
	 *
	 * @param ҳ�� $page
	 */
	public function getPicList(){
		
		//�������ݿ������
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		//�������ݿ�
		$conn = ConnMysqlClass::getConnMysql();
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$str_sql = "select pic_id,pic_name,pic_urlname,pic_savedate,pic_statue from rea1_resource_pic order by pic_id desc limit 0,10";
		
		$result = mysql_query($str_sql);
		
		$arrPics = array();
		$var = 0;
		
		while($row = mysql_fetch_array($result)){
			
			$arrPics[$var++] = array(
									"pic_id"=>$row['pic_id'],
									"pic_name"=>$row['pic_name'],
									"pic_urlname"=>$row['pic_urlname'],
									"pic_savedate"=>$row['pic_savedate'],
									"pic_statue"=>$row['pic_statue']
			);
			
		}
		
		mysql_close($conn);
		
		return $arrPics;
	}
	
	/**
	 * ����pic_idɾ��ͼƬ
	 *
	 * @param ͼƬid $pic_id
	 */
	public function deletePicById($pic_id){
		
		//�������ݿ������
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		//�������ݿ�
		$conn = ConnMysqlClass::getConnMysql();
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$str_sql = "delete from rea1_resource_pic where pic_id = $pic_id";
		
		$myq = mysql_query($str_sql,$conn);
		
		mysql_close($conn);
		
		return $myq;
		
	}
	
	/**
	 * ͨ��ͼƬid���ͼƬ��Ϣ
	 *
	 * @param $pic_id
	 */
	public function getPicUrlNameById($pic_id){
		
		//�������ݿ������
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		//�������ݿ�
		$conn = ConnMysqlClass::getConnMysql();
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$str_sql = "select pic_urlname from rea1_resource_pic where pic_id = $pic_id";
		
		$result = mysql_query($str_sql);
		
		$row = mysql_fetch_array($result);
		
		mysql_close($conn);
		
		return $row['pic_urlname'];
		
	}
}
?>