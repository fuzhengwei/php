<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
header ( 'Content-type: text/html; charset=utf-8' );
//ini_set("error_reporting","E_ALL & ~E_NOTICE");
/***********************************************************************
 * 产品操作DAO
 * add by fuzhengwei
 * 2013年11月16日 16:03:06
 ***********************************************************************/
class ProductDao{
	
	/**
	 * 获取产品信息列表
	 *
	 */
	public function getProductList($proType){
		
		//引入数据库操作类
		require_once '../conndb/mysql/ConnMysqlClass.php';
		
		//链接数据库
		$conn = ConnMysqlClass::getConnMysql();
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$str_sql = "select pro.pro_name pro_name,pro.pro_intro pro_intro,pro.pro_overview pro_overview,pro.pro_explanation pro_explanation,pro.pro_parameter pro_parameter,pic.pic_urlname pic_urlname from rea1_product pro,rea1_resource_pic pic where pro.fk_pic_id = pic.pic_id and pro.fk_pro_cate_name = '$proType' order by pro_id desc";
		
		$result = mysql_query($str_sql);
		
		$arrProducts = array();
		$var = 0;
		
		while($row = mysql_fetch_array($result)){
			
			$arrProducts[$var++] = array(
								"pic_urlname"=>$row['pic_urlname'],
								"pro_name"=>$row['pro_name'],
								"pro_intro"=>$row['pro_intro'],
								"pro_overview"=>$row['pro_overview'],
								"pro_explanation"=>$row['pro_explanation'],
								"pro_parameter"=>$row['pro_parameter']
			);
		}
		
		mysql_close($conn);
		
		return $arrProducts;
	}
	
}
?>