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
	 * ��ȡ������Դ�б�
	 *
	 * @return ��Դ���󼯺�
	 */
	public function getDownList(){
		//�������ݿ������
		require_once '../conndb/mysql/ConnMysqlClass.php';
		
		
		//�������ݿ�
		$conn = ConnMysqlClass::getConnMysql();
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$str_sql = "select f.down_urlname down_urlname,f.down_name down_name from rea1_support_resource_down d,rea1_resource_down f where d.fk_down_id = f.down_id order by d.sup_res_down_id desc";
		
		$result = mysql_query($str_sql);
		
		$arrDowns = array();
		$var = 0;
		
		while($row = mysql_fetch_array($result)){
			
			$arrDowns[$var++] = array(
									"down_urlname"=>$row['down_urlname'],
									"down_name"=>$row['down_name']
			);
			
		}
		
		mysql_close($conn);
		
		return $arrDowns;
	}
	
}
?>