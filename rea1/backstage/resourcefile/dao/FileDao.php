<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
header ( 'Content-type: text/html; charset=utf-8' );
ini_set("error_reporting","E_ALL & ~E_NOTICE");

/********************************************************************
 * �ļ�����DAO
 * add by fuzhengwei 
 * 2013��11��17�� 09:38:00
 ********************************************************************/
class FileDao{
	
	/**
	 * ��ȡ�ļ�����
	 *
	 */
	public function getFileList(){
		
		//�������ݿ������
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		//�������ݿ�
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
	 * ����idɾ��������Դ�ļ�
	 * @param �ļ�id $down_id
	 * @return true/false
	 */
	public function deleteFileById($down_id){
		//�������ݿ������
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		//�������ݿ�
		$conn = ConnMysqlClass::getConnMysql();
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$str_sql = "delete from rea1_resource_down where down_id = $down_id";
		
		$myq = mysql_query($str_sql,$conn);
		
		mysql_close($conn);
		
		return $myq;
		
	}
	
	/**
	 * ����ļ���Դ�����ݿ�
	 * @param �ļ���Դ��Ϣ $arrFileInfo
	 */
	public function addFileSource($arrFileInfo){
		
		//�������ݿ������
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		//�������ݿ�
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