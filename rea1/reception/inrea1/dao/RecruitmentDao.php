<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
header ( 'Content-type: text/html; charset=utf-8' );
ini_set("error_reporting","E_ALL & ~E_NOTICE");

/**
 * ��Ƹ��Ϣ����DAO
 * add by fuzhengwei 
 * 2013��11��17�� 14:35:55
 */
class RecruitmentDao{
	
	/**
	 * ��ȡ��Ƹ��Ϣ���󼯺�
	 *
	 * @return ��Ƹ��Ϣ���󼯺�
	 */
	public function getRecruitmentList($recType){
		
		//�������ݿ������
		require_once '../conndb/mysql/ConnMysqlClass.php';
		
		//�������ݿ�
		$conn = ConnMysqlClass::getConnMysql();
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$str_sql = "select fk_in_category,in_content from rea1_in where fk_in_category = '$recType' order by in_id desc";
		
		$result = mysql_query($str_sql);
		
		$arrRecruitments = array();
		$var = 0;
		
		while($row = mysql_fetch_array($result)){
			
			$arrRecruitments[$var++] = array(
											"fk_in_category"=>$row['fk_in_category'],
											"in_content"=>$row['in_content']
			);
			
		}
		
		mysql_close($conn);
		
		return $arrRecruitments;
		
	}
}
?>