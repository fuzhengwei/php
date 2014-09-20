<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
header ( 'Content-type: text/html; charset=utf-8' );
ini_set("error_reporting","E_ALL & ~E_NOTICE");
/*********************************************************
 * 产品类别操作DAO
 * add by fuzhengwei
 * 2013年11月16日 15:24:45
 *********************************************************/
class CategoryDao{
	
	/**
	 * 新增产品类别
	 * @param 产品类别 $arrCategoryInfo
	 */
	public function addCategory($arrCategoryInfo){
		
		//引入数据库操作类
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		//链接数据库
		$conn = ConnMysqlClass::getConnMysql();
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$pro_cate_name = $arrCategoryInfo['pro_cate_name'];
		
		$str_sql = "insert into rea1_product_category(pro_cate_name) values('$pro_cate_name')";
		
		$myq = mysql_query($str_sql,$conn);
		
		mysql_close($conn);
		
		return $myq;
		
	}
	
	/**
	 * 根据产品类别id产出本类别
	 *
	 * @param 产品类别id $pro_cate_id
	 * @return true/false
	 */
	public function deleteCategoryById($pro_cate_id){
		//引入数据库操作类
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		//链接数据库
		$conn = ConnMysqlClass::getConnMysql();
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$str_sql = "delete from rea1_product_category where pro_cate_id = $pro_cate_id";
		
		$myq = mysql_query($str_sql,$conn);
		
		mysql_close($conn);
		
		return $myq;
	}
	
	/**
	 * 获取产品类别列表
	 * 
	 */
	public function getCategoryList(){
		//引入数据库操作类
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		//链接数据库
		$conn = ConnMysqlClass::getConnMysql();
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$str_sql = "select pro_cate_id,pro_cate_name from rea1_product_category order by pro_cate_id desc";
		
		$result = mysql_query($str_sql);
		
		$arrCagegorys = array();
		$var = 0;
		
		while($row = mysql_fetch_array($result)){
			
			$arrCagegorys[$var++] = array(
											"pro_cate_id"=>$row['pro_cate_id'],
											"pro_cate_name"=>$row['pro_cate_name']
			);
			
		}
		
		mysql_close($conn);
		
		return $arrCagegorys;
		
	}
	
}

?>