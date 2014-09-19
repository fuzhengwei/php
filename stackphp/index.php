<?php
/**
 * create by fuzhengwei
 * date 2014-5-18
 * QQ 184172133
 */
require_once 'com/stack/bean/PageBean.php';
require_once 'com/stack/bean/CategoryBean.php';
require_once 'com/stack/util/rsq/ReflectQueryDao.php';

$rqd = new ReflectQueryDao("CategoryBean"); //使用了哪个bean对象要对其引入
$pageBean = new PageBean(1);				//分页bean
$pageBean->setMaxResult(2);					//同时可以设置每页几条数据，默认为10条

/***********************************************
 * 插入对象
 ***********************************************
 $bean = new CategoryBean();
// $bean->setCat_id('4'); //加与不加无所谓
 $bean->setCat_name("东软帝国");
 $rqd->doInsertModel($bean);
 */

/***********************************************
 * 根据id删除对象
 ***********************************************
 $rqd->doDeleteModelById(3);
 */

/***********************************************
 * 传入对象修改
 *********************************************** 
 $bean = new CategoryBean();
 $bean->setCat_id(5); 
 $bean->setCat_name("群号5307397");
 $rqd->doUpdateModel($bean);
 */

/************************************************
 * 获取集合对象便利
 *************************************************/
 $modelList = $rqd->doSelectModelList($pageBean);

 //echo $modelList[0]->getCat_name();

 foreach ($modelList as $key){
	
	echo $key->getCat_id()." ".$key->getCat_name()."<hr/>";
	
 }
 

/*************************************************
 * 根据id查询对象
 *************************************************
 $model = $rqd->doSelectModelById(2);
 echo $model->getCat_id()." ".$model->getCat_name();
 */

?>