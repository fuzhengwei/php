<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
header ( 'Content-type: text/html; charset=utf-8' );
ini_set("error_reporting","E_ALL & ~E_NOTICE");

/********************************************************************
 * ����������
 * add by fuzhengwei
 * 2013��11��17�� 11:51:37
 ********************************************************************/
class AnswerDao{
	
	/**
	 * ���ݷ���֧��id��÷�����Ϣ
	 *
	 * @param ����֧��id $sup_res_answer_id
	 * @return ����֧������
	 */
	public function getAnsWerById($sup_res_answer_id){
		//�������ݿ������
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		//�������ݿ�
		$conn = ConnMysqlClass::getConnMysql();
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$str_sql = "select sup_res_answer_id,sup_res_answer_title,sup_res_answer_content from rea1_support_resource_answer where sup_res_answer_id = $sup_res_answer_id";
		
		$result = mysql_query($str_sql);
		
		$arrAnswerDetail= array();
		
		$row = mysql_fetch_array($result);
		
		$arrAnswerDetail = array(
								"sup_res_answer_id"=>$row['sup_res_answer_id'],
								"sup_res_answer_title"=>$row['sup_res_answer_title'],
								"sup_res_answer_content"=>str_replace("<br/>","\n",$row['sup_res_answer_content'])
		);
		
		mysql_close($conn);
		
		return $arrAnswerDetail;
	}
	
	/**
	 * ����idɾ���������
	 *
	 * @param �������id $sup_res_answer_id
	 * @return bool
	 */
	public function deleteAnswerById($sup_res_answer_id){
		//�������ݿ������
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		//�������ݿ�
		$conn = ConnMysqlClass::getConnMysql();
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$str_sql = "delete from rea1_support_resource_answer where sup_res_answer_id = $sup_res_answer_id";
		
		$myq = mysql_query($str_sql,$conn);
		
		mysql_close($conn);
		
		return $myq;
	}
	
	/**
	 * ��ȡ��������б�
	 */
	public function getAnswerList(){
		//�������ݿ������
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		//�������ݿ�
		$conn = ConnMysqlClass::getConnMysql();
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$str_sql = "select sup_res_answer_id,sup_res_answer_title,sup_res_answer_content from rea1_support_resource_answer order by sup_res_answer_id desc";
		
		$result = mysql_query($str_sql);
		
		$arrAnswers = array();
		$var = 0;
		
		while($row = mysql_fetch_array($result)){
			
			$arrAnswers[$var++] = array(
									"sup_res_answer_id"=>$row['sup_res_answer_id'],
									"sup_res_answer_title"=>$row['sup_res_answer_title'],
									"sup_res_answer_content"=>$row['sup_res_answer_content']
			);
			
		}
		
		mysql_close($conn);
		
		return $arrAnswers;
	}
	
	/**
	 * �����������
	 *
	 * @param �������INFO $arrAnswerInfo
	 */
	public function addAnswer($arrAnswerInfo){
		
		//�������ݿ������
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		//�������ݿ�
		$conn = ConnMysqlClass::getConnMysql();
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$sup_res_answer_title = $arrAnswerInfo['sup_res_answer_title'];
		$sup_res_answer_content = $arrAnswerInfo['sup_res_answer_content'];
		
		$str_sql = "insert into rea1_support_resource_answer(sup_res_answer_title,sup_res_answer_content) values('$sup_res_answer_title','$sup_res_answer_content')";
		
		$myq = mysql_query($str_sql,$conn);
		
		mysql_close($conn);
		
		return $myq;
	}
	
	
	
}

?>