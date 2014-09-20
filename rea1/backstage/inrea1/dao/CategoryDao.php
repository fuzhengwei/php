<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
header ( 'Content-type: text/html; charset=utf-8' );
ini_set("error_reporting","E_ALL & ~E_NOTICE");
/*********************************************************
 * 招聘类别操作DAO
 * add by fuzhengwei
 * 2013年11月17日 14:32:02
 *********************************************************/
class CategoryDao{
	
	/**
	 * 新增招聘类别
	 * @param 产品类别 $arrCategoryInfo
	 */
	public function addCategory($arrCategoryInfo){
		
		//引入数据库操作类
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		//链接数据库
		$conn = ConnMysqlClass::getConnMysql();
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$in_cat_content = $arrCategoryInfo['in_cat_content'];
		
		$str_sql = "insert into rea1_in_category(in_cat_content) values('$in_cat_content')";
		
		$myq = mysql_query($str_sql,$conn);
		
		mysql_close($conn);
		
		return $myq;
		
	}
	
	/**
	 * 根据招聘类别id删除本类别
	 *
	 * @param 产品类别id $pro_cate_id
	 * @return true/false
	 */
	public function deleteCategoryById($in_cat_id){
		//引入数据库操作类
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		//链接数据库
		$conn = ConnMysqlClass::getConnMysql();
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$str_sql = "delete from rea1_in_category where in_cat_id = $in_cat_id";
		
		$myq = mysql_query($str_sql,$conn);
		
		mysql_close($conn);
		
		return $myq;
	}
	
	/**
	 * 获取招聘类别列表
	 * @return 招牌类别对象数组
	 */
	public function getCategoryList(){
		//引入数据库操作类
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		//链接数据库
		$conn = ConnMysqlClass::getConnMysql();
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$str_sql = "select in_cat_id,in_cat_content from rea1_in_category order by in_cat_id desc";
		
		$result = mysql_query($str_sql);
		
		$arrCagegorys = array();
		$var = 0;
		
		while($row = mysql_fetch_array($result)){
			
			$arrCagegorys[$var++] = array(
											"in_cat_id"=>$row['in_cat_id'],
											"in_cat_content"=>$row['in_cat_content']
			);
			
		}
		
		mysql_close($conn);
		
		return $arrCagegorys;
		
	}
	
}

?>