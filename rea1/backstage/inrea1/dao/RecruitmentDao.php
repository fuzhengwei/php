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
	 * ����id��ȡRecruitment
	 *
	 * @param ��Ƹid $in_id
	 * @return ��Ƹ��Ϣ
	 */
	public function getRecruitmentById($in_id){
		
		//�������ݿ������
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		//�������ݿ�
		$conn = ConnMysqlClass::getConnMysql();
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$str_sql = "select in_id,fk_in_category,in_content from rea1_in where in_id = $in_id";
		
		$result = mysql_query($str_sql);
		
		$arrRecruitmentDetail = array();
		
		$row = mysql_fetch_array($result);
		
		$arrRecruitmentDetail = array(
									"in_id" => $row['in_id'],
									"fk_in_category" => $row['fk_in_category'],
									"in_content" => str_replace("<br/>","\n",$row['in_content'])
		);
		
		mysql_close($conn);
		
		return $arrRecruitmentDetail;
	}
	
	/**
	 * �����Ƹ��Ϣ
	 *
	 * @param ��Ƹ��Ϣ���� $arrRecruitmentInfo
	 * @return bool
	 */
	public function addRecruitment($arrRecruitmentInfo){
		//�������ݿ������
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		//�������ݿ�
		$conn = ConnMysqlClass::getConnMysql();
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$fk_in_category = $arrRecruitmentInfo['fk_in_category'];
		$in_content = $arrRecruitmentInfo['in_content'];
		
		$str_sql = "insert into rea1_in(fk_in_category,in_content) values('$fk_in_category','$in_content')";
	
		$myq = mysql_query($str_sql,$conn);
		
		mysql_close($conn);
		
		return $myq;
	}
	
	/**
	 * ����idɾ����Ƹ��Ϣ
	 *
	 * @param ��Ƹ��Ϣid $in_id
	 * @return bool
	 */
	public function deleteRecruitmentById($in_id){
		//�������ݿ������
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		//�������ݿ�
		$conn = ConnMysqlClass::getConnMysql();
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$str_sql = "delete from rea1_in where in_id = $in_id";
		
		$myq = mysql_query($str_sql,$conn);
		
		mysql_close($conn);
		
		return $myq;
	}
	
	/**
	 * ������Ƹid�޸�������Ϣ
	 *
	 * @param ��Ƹ��Ϣ $arrRecruitmentInfo
	 * @return T/F
	 */
	public function updateRecruitmentById($arrRecruitmentInfo){
		
		//�������ݿ������
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		//�������ݿ�
		$conn = ConnMysqlClass::getConnMysql();
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$in_id = $arrRecruitmentInfo['in_id'];
		$fk_in_category = $arrRecruitmentInfo['fk_in_category'];
		$in_content = $arrRecruitmentInfo['in_content'];
		
		$str_sql = "update rea1_in set fk_in_category = '$fk_in_category',in_content = '$in_content' where in_id = $in_id";
		
		$myq = mysql_query($str_sql,$conn);
		
		mysql_close($conn);
		
		return $myq;
	}
	
	/**
	 * ��ȡ��Ƹ��Ϣ���󼯺�
	 *
	 * @return ��Ƹ��Ϣ���󼯺�
	 */
	public function getRecruitmentList(){
		
		//�������ݿ������
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		//�������ݿ�
		$conn = ConnMysqlClass::getConnMysql();
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$str_sql = "select in_id,fk_in_category,in_content from rea1_in order by in_id desc";
		
		$result = mysql_query($str_sql);
		
		$arrRecruitments = array();
		$var = 0;
		
		while($row = mysql_fetch_array($result)){
			
			$arrRecruitments[$var++] = array(
											"in_id"=>$row['in_id'],
											"fk_in_category"=>$row['fk_in_category'],
											"in_content"=>$row['in_content']
			);
			
		}
		
		mysql_close($conn);
		
		return $arrRecruitments;
		
	}
}
?>