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
	 * ��ȡ��������б�
	 */
	public function getAnswerList(){
		//�������ݿ������
		require_once '../conndb/mysql/ConnMysqlClass.php';
		
		//�������ݿ�
		$conn = ConnMysqlClass::getConnMysql();
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$str_sql = "select sup_res_answer_title,sup_res_answer_content from rea1_support_resource_answer order by sup_res_answer_id desc";
		
		$result = mysql_query($str_sql);
		
		$arrAnswers = array();
		$var = 0;
		
		while($row = mysql_fetch_array($result)){
			
			$arrAnswers[$var++] = array(
									"sup_res_answer_title"=>$row['sup_res_answer_title'],
									"sup_res_answer_content"=>$row['sup_res_answer_content']
			);
			
		}
		
		mysql_close($conn);
		
		return $arrAnswers;
	}
	
	
}

?>