<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
header ( 'Content-type: text/html; charset=utf-8' );
ini_set("error_reporting","E_ALL & ~E_NOTICE");

/********************************************************************
 * 服务支持操作DAO
 * add by fuzhengwei
 * 2013年11月17日 12:25:12
 ********************************************************************/
class TecsDao{
	
	/**
	 * 添加服务支持
	 *
	 * @param 服务支持信息 $arrTecsInfo
	 * @return bool
	 */
	public function addTecs($arrTecsInfo){
		
		//引入数据库操作类
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		//链接数据库
		$conn = ConnMysqlClass::getConnMysql();
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$sup_res_sup_tecs_coutent = $arrTecsInfo['sup_res_sup_tecs_coutent'];
		
		$str_sql = "insert into rea1_support_resource_tecs(sup_res_sup_tecs_coutent) values('$sup_res_sup_tecs_coutent')";
		
		$myq = mysql_query($str_sql,$conn);
		
		mysql_close($conn);
		
		return $myq;
		
	}
	
	/**
	 * 获取服务支持对象集合
	 *
	 * @return 服务支持对象集合
	 */
	public function getTecsList(){
		//引入数据库操作类
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		//链接数据库
		$conn = ConnMysqlClass::getConnMysql();
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$str_sql = "select sup_res_sup_tecs_id,sup_res_sup_tecs_coutent from rea1_support_resource_tecs order by sup_res_sup_tecs_id desc";
	
		$result = mysql_query($str_sql);
		
		$arrTecs = array();
		$var = 0;
		
		while($row = mysql_fetch_array($result)){
			
			$arrTecs[$var++] = array(
									"sup_res_sup_tecs_id"=>$row['sup_res_sup_tecs_id'],
									"sup_res_sup_tecs_coutent"=>$row['sup_res_sup_tecs_coutent']
			);
			
		}
		
		mysql_close($conn);
		
		return $arrTecs;
	}
	
	/**
	 * 根据服务支持id删除此信息
	 *
	 * @param 服务支持id $sup_res_sup_tecs_id
	 * @return bool
	 */
	public function deleteTecsById($sup_res_sup_tecs_id){
		//引入数据库操作类
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		//链接数据库
		$conn = ConnMysqlClass::getConnMysql();
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$str_sql = "delete from rea1_support_resource_tecs where sup_res_sup_tecs_id = $sup_res_sup_tecs_id";
		
		$myq = mysql_query($str_sql,$conn);
		
		mysql_close($conn);
		
		return $myq;
	}
	
}
?>