<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
header ( 'Content-type: text/html; charset=utf-8' );
ini_set("error_reporting","E_ALL & ~E_NOTICE");

/********************************************************************
 * 技术解答操作
 * add by fuzhengwei
 * 2013年11月17日 11:51:37
 ********************************************************************/
class AnswerDao{
	
	/**
	 * 根据服务支持id获得服务信息
	 *
	 * @param 服务支持id $sup_res_answer_id
	 * @return 服务支持详情
	 */
	public function getAnsWerById($sup_res_answer_id){
		//引入数据库操作类
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		//链接数据库
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
	 * 根据id删除技术解答
	 *
	 * @param 技术解答id $sup_res_answer_id
	 * @return bool
	 */
	public function deleteAnswerById($sup_res_answer_id){
		//引入数据库操作类
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		//链接数据库
		$conn = ConnMysqlClass::getConnMysql();
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$str_sql = "delete from rea1_support_resource_answer where sup_res_answer_id = $sup_res_answer_id";
		
		$myq = mysql_query($str_sql,$conn);
		
		mysql_close($conn);
		
		return $myq;
	}
	
	/**
	 * 获取技术解答列表
	 */
	public function getAnswerList(){
		//引入数据库操作类
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		//链接数据库
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
	 * 新增技术解答
	 *
	 * @param 技术解答INFO $arrAnswerInfo
	 */
	public function addAnswer($arrAnswerInfo){
		
		//引入数据库操作类
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		//链接数据库
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