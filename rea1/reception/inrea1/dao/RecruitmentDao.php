<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
header ( 'Content-type: text/html; charset=utf-8' );
ini_set("error_reporting","E_ALL & ~E_NOTICE");

/**
 * 招聘信息操作DAO
 * add by fuzhengwei 
 * 2013年11月17日 14:35:55
 */
class RecruitmentDao{
	
	/**
	 * 获取招聘信息对象集合
	 *
	 * @return 招聘信息对象集合
	 */
	public function getRecruitmentList($recType){
		
		//引入数据库操作类
		require_once '../conndb/mysql/ConnMysqlClass.php';
		
		//链接数据库
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