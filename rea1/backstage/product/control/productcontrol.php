<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
require_once '../../../util/StackConst.php';

//获取操作类型值
$type = @$_POST['type'] == "" ? @$_GET['type']:@$_POST['type'];

//添加产品信息
if("addProduct" == $type){
	
	$arrProductInfo = array(
							"fk_pro_cate_name"=>@$_POST['fk_pro_cate_name'],
							"fk_pic_id"=>@$_POST['fk_pic_id'],
							"pro_name"=>@$_POST['pro_name'],
							"pro_intro"=>@$_POST['pro_intro'],
							"pro_overview"=>@$_POST['pro_overview'],
							"pro_explanation"=>@$_POST['pro_explanation'],
							"pro_parameter"=>@$_POST['pro_parameter']	
	);
	//引入产品信息操作DAO
	require_once '../dao/ProductDao.php';
	//实例化ProductDao
	$productDao = new ProductDao();
	
	if($productDao->addProduct($arrProductInfo)){
		echo "产品信息保存成功！";
		StackConst::jump_page("../view/productlist.php");
	}else{
		echo "产品信息保存失败！";
	}
	
}else if("deleteProduct" == $type){
	
	//引入产品信息操作DAO
	require_once '../dao/ProductDao.php';
	//实例化ProductDao
	$productDao = new ProductDao();
	
	if($productDao->deleteProductById(@$_GET['pro_id'])){
		echo "产品删除成功！";
		StackConst::jump_page("../view/productlist.php");
	}else{
		echo "产品删除失败！";
	}
}else if("updateProduct" == $type){
	//引入产品信息操作DAO
	require_once '../dao/ProductDao.php';
	//实例化ProductDao
	$productDao = new ProductDao();
	
	$arrProductInfo = array(
									"pro_id"=>@$_POST['pro_id'],
									"fk_pro_cate_name"=>@$_POST['fk_pro_cate_name'],
									"fk_pic_id"=>@$_POST['fk_pic_id'],
									"pro_name"=>@$_POST['pro_name'],
									"pro_intro"=>@$_POST['pro_intro'],
									"pro_overview"=>@$_POST['pro_overview'],
									"pro_explanation"=>@$_POST['pro_explanation'],
									"pro_parameter"=>@$_POST['pro_parameter']	
			);
	
			
	if($productDao->updateProductById($arrProductInfo)){
		echo "产品信息修改成功！";
		StackConst::jump_page("../view/productlist.php");
	}else{
		echo "产品信息修改失败！";
	}
	
	
}
?>