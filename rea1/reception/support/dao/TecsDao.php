<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
header ( 'Content-type: text/html; charset=utf-8' );
ini_set("error_reporting","E_ALL & ~E_NOTICE");

/********************************************************************
 * ����֧�ֲ���DAO
 * add by fuzhengwei
 * 2013��11��17�� 12:25:12
 ********************************************************************/
class TecsDao{
	
	
	/**
	 * ��ȡ����֧�ֶ��󼯺�
	 *
	 * @return ����֧�ֶ��󼯺�
	 */
	public function getTecsList(){
		//�������ݿ������
		require_once '../conndb/mysql/ConnMysqlClass.php';
		
		//�������ݿ�
		$conn = ConnMysqlClass::getConnMysql();
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$str_sql = "select sup_res_sup_tecs_id,sup_res_sup_tecs_coutent from rea1_support_resource_tecs order by sup_res_sup_tecs_id desc";
	
		$result = mysql_query($str_sql);
		
		$arrTecs = array();
		$var = 0;
		
		while($row = mysql_fetch_array($result)){
			
			$arrTecs[$var++] = array(
									"sup_res_sup_tecs_coutent"=>$row['sup_res_sup_tecs_coutent']
			);
			
		}
		
		mysql_close($conn);
		
		return $arrTecs;
	}
	
}
?>