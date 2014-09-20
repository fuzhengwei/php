<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
header ( 'Content-type: text/html; charset=utf-8' );
ini_set("error_reporting","E_ALL & ~E_NOTICE");
/***********************************************************************
 * ��Ʒ����DAO
 * add by fuzhengwei
 * 2013��11��16�� 16:03:06
 ***********************************************************************/
class ProductDao{
	
	/**
	 * ����id��ѯҪ�޸ĵ���Ϣ
	 *
	 * @param ��Ʒid $pro_id
	 * @return ��Ʒ����
	 */
	public function getProductById($pro_id){
		//�������ݿ������
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		//�������ݿ�
		$conn = ConnMysqlClass::getConnMysql();
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$str_sql = "select t.pro_id pro_id,t.fk_pro_cate_name fk_pro_cate_name,t.fk_pic_id fk_pic_id,t.pro_name pro_name,t.pro_intro pro_intro,t.pro_overview pro_overview,t.pro_explanation pro_explanation,t.pro_parameter pro_parameter, c.pic_urlname pic_urlname,c.pic_name pic_name from rea1_product t,rea1_resource_pic c where t.fk_pic_id = c.pic_id and t.pro_id = $pro_id";
	
		$result = mysql_query($str_sql);
		
		$arrProduct = array();
		
		$row = mysql_fetch_array($result);
				
		$arrProduct = array(
							"pro_id"=>$row['pro_id'],
							"fk_pro_cate_name"=>$row['fk_pro_cate_name'],
							"fk_pic_id"=>$row['fk_pic_id'],
							"pic_name"=>$row['pic_name'],
							"pro_name"=>$row['pro_name'],
							"pro_intro"=>str_replace("<br/>","\n",$row['pro_intro']),
							"pro_overview"=>str_replace("<br/>","\n",$row['pro_overview']),
							"pro_explanation"=>str_replace("<br/>","\n",$row['pro_explanation']),
							"pro_parameter"=>str_replace("<br/>","\n",$row['pro_parameter'])
		);
		
		mysql_close($conn);
		
		return $arrProduct;
	}
	
	/**
	 * ��ȡ��Ʒ��Ϣ�б�
	 *
	 */
	public function getProductList(){
		//�������ݿ������
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		//�������ݿ�
		$conn = ConnMysqlClass::getConnMysql();
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$str_sql = "select pro_id,fk_pro_cate_name,fk_pic_id,pro_name,pro_intro,pro_overview,pro_explanation,pro_parameter from rea1_product order by pro_id desc";
		
		$result = mysql_query($str_sql);
		
		$arrProducts = array();
		$var = 0;
		
		//����PicDao
		require_once '../../resourcepic/dao/PicDao.php';
		//ʵ����picDao
		$picDao = new PicDao();
		
		while($row = mysql_fetch_array($result)){
			
			$arrProducts[$var++] = array(
								"pro_id"=>$row['pro_id'],
								"fk_pro_cate_name"=>$row['fk_pro_cate_name'],
								"fk_pic_id"=>$row['fk_pic_id'],
								"pic_urlname"=>$picDao->getPicUrlNameById($row['fk_pic_id']),
								"pro_name"=>$row['pro_name'],
								"pro_intro"=>$row['pro_intro'],
								"pro_overview"=>$row['pro_overview'],
								"pro_explanation"=>$row['pro_explanation']
			);
		}
		
		mysql_close($conn);
		return $arrProducts;
	}
	
	/**
	 * ������Ʒ��Ϣ�����ݿ�
	 * @param ��Ʒ��Ϣ $arrProductInfo
	 */
	public function addProduct($arrProductInfo){
		
		//�������ݿ������
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		//�������ݿ�
		$conn = ConnMysqlClass::getConnMysql();
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$fk_pro_cate_name = $arrProductInfo['fk_pro_cate_name'];
		$fk_pic_id = $arrProductInfo['fk_pic_id'];
		$pro_name = $arrProductInfo['pro_name'];
		$pro_intro = $arrProductInfo['pro_intro'];
		$pro_overview = $arrProductInfo['pro_overview'];
		$pro_explanation = $arrProductInfo['pro_explanation'];
		$pro_parameter = $arrProductInfo['pro_parameter'];
		
		$str_sql = "insert into rea1_product(fk_pro_cate_name,fk_pic_id,pro_name,pro_intro,pro_overview,pro_explanation,pro_parameter) values('$fk_pro_cate_name',$fk_pic_id,'$pro_name','$pro_intro','$pro_overview','$pro_explanation','$pro_parameter')";
		
		$myq = mysql_query($str_sql,$conn);
		
		mysql_close($conn);
		
		return $myq;
		
	}
	
	/**
	 * ����idɾ����Ʒ��Ϣ
	 *
	 * @param ��Ʒid $pro_id
	 * @return true/false
	 */
	public function deleteProductById($pro_id){
		//�������ݿ������
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		//�������ݿ�
		$conn = ConnMysqlClass::getConnMysql();
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$str_sql = "delete from rea1_product where pro_id = $pro_id";
		
		$myq = mysql_query($str_sql,$conn);
		
		mysql_close($conn);
		
		return $myq;
	}
	
	/**
	 * �޸Ĳ�Ʒ��Ϣ
	 *
	 * @param ��Ʒ��Ϣ $arrProductInfo
	 */
	public function updateProductById($arrProductInfo){
		//�������ݿ������
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		//�������ݿ�
		$conn = ConnMysqlClass::getConnMysql();
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$pro_id = $arrProductInfo['pro_id'];
		$fk_pro_cate_name = $arrProductInfo['fk_pro_cate_name'];
		$fk_pic_id = $arrProductInfo['fk_pic_id'];
		$pro_name = $arrProductInfo['pro_name'];
		$pro_intro = $arrProductInfo['pro_intro'];
		$pro_overview = $arrProductInfo['pro_overview'];
		$pro_explanation = $arrProductInfo['pro_explanation'];
		$pro_parameter = $arrProductInfo['pro_parameter'];
		
		$str_sql = "update rea1_product set fk_pro_cate_name = '$fk_pro_cate_name',fk_pic_id = $fk_pic_id,pro_name = '$pro_name',pro_intro = '$pro_intro',pro_overview = '$pro_overview',pro_explanation = '$pro_explanation',pro_parameter = '$pro_parameter' where pro_id = $pro_id";
		
		$myq = mysql_query($str_sql,$conn);
		
		mysql_close($conn);
		
		return $myq;
	}
	
	/**
	 * ��ȡPicList
	 * @return picList ����
	 */
	public function getPicList(){
		
		require_once '../../resourcepic/dao/PicDao.php';
		
		$picDao = new PicDao();
		
		return $picDao->getPicList();
		
	}
	
	public function getCategoryList(){
		
		require_once 'CategoryDao.php';
		
		$categoryDao = new CategoryDao();
		
		return $categoryDao->getCategoryList();
		
	}
	
}
?>