<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
header ( 'Content-type: text/html; charset=utf-8' );
ini_set("error_reporting","E_ALL & ~E_NOTICE");

/*********************************************************************
 * ��Դ���ز���DAO
 * add by fuzhengwei
 * 2013��11��17�� 12:05:50
 *********************************************************************/
class DownDao{
	
	/**
	 * ��ȡ��Դ�ļ��б�
	 *
	 * @return ResDownList
	 */
	public function getResDownList(){
		require_once '../../resourcefile/dao/FileDao.php';
		$fileDao = new FileDao();
		return $fileDao->getFileList();
	}
	
	/**
	 * ��ȡ������Դ�б�
	 *
	 * @return ��Դ���󼯺�
	 */
	public function getDownList(){
		//�������ݿ������
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		//�������ݿ�
		$conn = ConnMysqlClass::getConnMysql();
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$str_sql = "select d.sup_res_down_id sup_res_down_id,d.fk_down_id fk_down_id,f.down_urlname down_urlname,f.down_name down_name from rea1_support_resource_down d,rea1_resource_down f where d.fk_down_id = f.down_id order by d.sup_res_down_id desc";
		
		$result = mysql_query($str_sql);
		
		$arrDowns = array();
		$var = 0;
		
		while($row = mysql_fetch_array($result)){
			
			$arrDowns[$var++] = array(
									"sup_res_down_id"=>$row['sup_res_down_id'],
									"fk_down_id"=>$row['fk_down_id'],
									"down_urlname"=>$row['down_urlname'],
									"down_name"=>$row['down_name']
			);
			
		}
		
		mysql_close($conn);
		
		return $arrDowns;
	}
	
	/**
	 * ���������Դ
	 *
	 * @param ��Դ��Ϣ $arrDownInfo
	 * @return bool
	 */
	public function addDown($arrDownInfo){
		//�������ݿ������
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		//�������ݿ�
		$conn = ConnMysqlClass::getConnMysql();
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$fk_down_id = $arrDownInfo[fk_down_id];
		
		$str_sql = "insert into rea1_support_resource_down(fk_down_id) values($fk_down_id)";
		
		$myq = mysql_query($str_sql,$conn);
		
		mysql_close($conn);
		
		return $myq;
	}
	
	/**
	 * ����idɾ��������Դ
	 *
	 * @param ��Դid $sup_res_down_id
	 * @return bool
	 */
	public function deleteDownById($sup_res_down_id){
		
		//�������ݿ������
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		//�������ݿ�
		$conn = ConnMysqlClass::getConnMysql();
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$str_sql = "delete from rea1_support_resource_down where sup_res_down_id = $sup_res_down_id";
		
		$myq = mysql_query($str_sql,$conn);
		
		mysql_close($conn);
		
		return $myq;
	}
	
}
?>