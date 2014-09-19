<?php
/**
 * create by fuzhengwei
 * date 2014-5-18
 * QQ 184172133
 */
class PageBean{
	
	/** type=int*/
	private $firstResult = 1;
	
	/** type=int*/  
	private $maxResult = 10;
	
	/** 通过构造方法传参代表分页*/
	function __construct($firstResult){
		$this->firstResult = $firstResult;
	}
	
	/**
	 * @return unknown
	 */
	public function getFirstResult() {
		if($this->firstResult > 1){
			return ($this->firstResult - 1) * $this->maxResult;
		}else{
			return 0;
		}
	}
	
	/**
	 * @return unknown
	 */
	public function getMaxResult() {
		if($this->firstResult > 1){
			return $this->maxResult + ($this->firstResult - 1)  * $this->maxResult;
		}else{
			return $this->maxResult;
		}
	}
	
	/**
	 * @param unknown_type $firstResult
	 */
	public function setFirstResult($firstResult) {
		$this->firstResult = $firstResult;
	}
	
	/**
	 * @param unknown_type $maxResult
	 */
	public function setMaxResult($maxResult) {
		$this->maxResult = $maxResult;
	}
	
}

?>