<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
header ( 'Content-type: text/html; charset=utf-8' );
ini_set("error_reporting","E_ALL & ~E_NOTICE");

/**********************************************************************
 * ��Ա����DAO
 * add by fuzhengwei 
 * 2013��11��18�� 12:20:32
 **********************************************************************/
class EmpDao{
	
	/**
	 * ��֤��¼
	 * $emp_name,$emp_pwd
	 */
	public function doLogin($emp_name,$emp_pwd){
		
		//�������ݿ������
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		//�������ݿ�
		$conn = ConnMysqlClass::getConnMysql();
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$str_sql = "select emp_name from rea1_emp where emp_name = '$emp_name' and emp_pwd = '$emp_pwd'";
		
		$result = mysql_query($str_sql);
		
		$row = mysql_fetch_array($result);
		
		mysql_close($conn);
		
		return $row['emp_name'];
		
	}
	
}
?>