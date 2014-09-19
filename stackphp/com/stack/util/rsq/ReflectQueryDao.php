<?php
/**************************************************
 * Create user fuzhengwei
 * Create date 2014-5-17
 * QQ 184172133
 * 为了实现快速开发的目的，减少冗余语句
 * 为此用php反射技术实现简易框架
 * 本框架最大特点是不需要写sql语句
 **************************************************/
require_once 'com/stack/util/conn/ConnMysql.php';
class ReflectQueryDao extends ConnMysql {
	//bean url
	private $beanUrl = "";
	//加载类
	private $class;
	//属性
	private $properties;
	//实例
	private $instance;
	//表
	private $table;
	//填充sql语句
	private $isOne = FALSE;
	//是否打印sql语句
	private $isPrintSql = TRUE;
	
	private $sqlInsert = "INSERT INTO ";
	private $sqlDelete = "DELETE FROM ";
	private $sqlUpdate = "UPDATE ";
	private $sqlUpdateWhere = " WHERE ";
	private $sqlSelect = "SELECT ";
	private $sqlSelectWhere = " WHERE ";
	private $sqlSelectPage = " LIMIT ";
	
	function __construct($beanUrl){
		
		$this->beanUrl = $beanUrl;
		
		/**
		 * 建立 Person这个类的反射类  
		 */
		$this->class = new ReflectionClass ( $beanUrl ); 
		/**
		 * 实例化Person 类  
		 */
		$this->instance = $this->class->newInstance();
		/**
		 * 获得属性
		 */
		$this->properties = $this->class->getProperties ();
		/**
		 * 获得表名
		 */
		$this->table = strtolower(str_replace("Bean", "", $beanUrl)); 
		
		//设置insert语句
		$this->setInsertSql();
		//设置delete语句
		$this->setDeleteSql();
		//设置update语句
		$this->setUpdateSql();
		//设置select语句
		$this->setSelectSql();
		
	}
	
	/**
	 * insert model
	 *
	 * @param model $objBean
	 */
	public function doInsertModel($objBean){
		$buffSql = $this->sqlInsert;
		
		$isAddComma = FALSE;
		$isOne = FALSE;
		foreach ( $this->properties as $property ) {
			if($isOne){
				if($isAddComma){
					$get=$this->class->getmethod("get".strtoupper(substr($property->getName(),0,1)).substr($property->getName(),1));  
					$buffSql .= ",'".$get->invoke($objBean)."'";
				}else {
					$get=$this->class->getmethod("get".strtoupper(substr($property->getName(),0,1)).substr($property->getName(),1));  
					$buffSql .= "'".$get->invoke($objBean)."'";
					$isAddComma = TRUE;
				}
			}else{
				$isOne = TRUE;
			}
		}
		$buffSql .= ")";
		if($this->isPrintSql){
			echo $buffSql."<hr/>";
		}
		$conn = ConnMysql::getConnMysql();
		mysql_select_db(ConnMysql::getDBName(), $conn);
		$myq = mysql_query($buffSql,$conn);
		mysql_close($conn);
		return $myq;
	}
	
	/**
	 * delete model
	 *
	 * @param int $id
	 */
	public function doDeleteModelById($id){
		$buffSql = $this->sqlDelete . $id;
		if($this->isPrintSql){
			echo $buffSql."<hr/>";
		}
		$conn = ConnMysql::getConnMysql();
		mysql_select_db(ConnMysql::getDBName(), $conn);
		$myq = mysql_query($buffSql,$conn);
		mysql_close($conn);
		return $myq;
		
	}
	
	/**
	 * update Model
	 *
	 * @param unknown_type $objBean
	 * @return unknown
	 */
	public function doUpdateModel($objBean){
		$buffSql = $this->sqlUpdate;
		$buffSqlWhere = $this->sqlUpdateWhere;
		$isAddComma = FALSE;
		$isOne = FALSE;
		
		foreach ( $this->properties as $property ) {
			$get=$this->class->getmethod("get".strtoupper(substr($property->getName(),0,1)).substr($property->getName(),1)); 
			if($isOne){
				if($isAddComma){
					$buffSql .= ",set ".$property->getName()." = '".$get->invoke($objBean)."'";
				}else {
					$buffSql .= "set ".$property->getName()." = '".$get->invoke($objBean)."'";
					$isAddComma = TRUE;
				}
			}else{
				$isOne = TRUE;
				$buffSqlWhere .= $property->getName()." = ".$get->invoke($objBean);
			}
		}
		
		if($this->isPrintSql){
			echo $buffSql.$buffSqlWhere."<hr/>";
		}
		
		$conn = ConnMysql::getConnMysql();
		mysql_select_db(ConnMysql::getDBName(), $conn);
		$myq = mysql_query($buffSql.$buffSqlWhere,$conn);
		mysql_close($conn);
		return $myq;
	}
	
	/**
	 * select model list
	 *
	 * @param unknown_type $pageBean
	 * @return unknown
	 */
	public function doSelectModelList($pageBean){
		
		$buffSql = $this->sqlSelect.$this->sqlSelectPage.$pageBean->getFirstResult().",".$pageBean->getMaxResult();
		if($this->isPrintSql){
			echo $buffSql."<hr/>";
		}
		$conn = ConnMysql::getConnMysql();
		mysql_select_db(ConnMysql::getDBName(), $conn);
		$myq = mysql_query($buffSql);
		$modelList = array();
		$var = 0;
		
		while($row = mysql_fetch_array($myq)){
			$instance = $this->class->newInstance();
			foreach ( $this->properties as $property ) {
				
				$set = $this->class->getMethod("set".strtoupper(substr($property->getName(),0,1)).substr($property->getName(),1));
				$set->invoke($instance,$row[$property->getName()]);
			}
			$modelList[$var++] = $instance;
		}
		//调用方法而不是调用属性
		mysql_close($conn);
		
		return $modelList;
		
	}
	
	/**
	 * select model by id
	 *
	 * @param unknown_type $id
	 * @return unknown
	 */
	public function doSelectModelById($id){
		$buffSql = $this->sqlSelect." WHERE ".$this->properties[0]->getName()." = ".$id;
		if($this->isPrintSql){
			echo $buffSql."<hr/>";
		}
		$conn = ConnMysql::getConnMysql();
		mysql_select_db(ConnMysql::getDBName(), $conn);
		$myq = mysql_query($buffSql);
		$row = mysql_fetch_array($myq);
		$model = $this->class->newInstance();
		foreach ( $this->properties as $property ) {
			$set = $this->class->getMethod("set".strtoupper(substr($property->getName(),0,1)).substr($property->getName(),1));
			$set->invoke($model,$row[$property->getName()]);
		}
		mysql_close($conn);
		return $model;
		
	}
	
	/*set insert sql*/
	public function setInsertSql(){
		$buffSql = $this->sqlInsert.$this->table."(";
		$isAddComma = FALSE;
		foreach ( $this->properties as $property ) {
			if($this->isOne){		
				if($isAddComma){
					$buffSql .= ",".$property->getName();
				}else{
					$buffSql .= $property->getName()."";
					$isAddComma = TRUE;
				} 
			}else{
				$this->isOne = TRUE;
			}
		}
		$this->sqlInsert = $buffSql .= ") VALUES(";
	}
	
	/*set delete sql*/
	public function setDeleteSql(){
		$buffSql = $this->sqlDelete.$this->table." WHERE ".$this->properties[0]->getName()." = ";
		$this->sqlDelete = $buffSql;	
	}
	
	/*set update sql*/
	public function setUpdateSql(){
		$buffSql = $this->sqlUpdate.$this->table." ";
		$this->sqlUpdate = $buffSql;
	}
	
	/*set select sql*/
	public function setSelectSql(){
		$buffSql = $this->sqlSelect;
		$isOne = FALSE;
		
		foreach ( $this->properties as $property ) {
			if($isOne){		
				$buffSql .= ",".$property->getName();
			}else{
				$buffSql .= $property->getName();
				$isOne = TRUE;
			}
		}
		$buffSql = $buffSql." FROM ".$this->table." ";
		$this->sqlSelect = $buffSql;
	}
}

?>