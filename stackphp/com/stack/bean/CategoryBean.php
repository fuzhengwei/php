<?php
/**
 * create by fuzhengwei
 * date 2014-5-18
 * QQ 184172133
 */
class CategoryBean {

	private $cat_id;
	private $cat_name;
	
	/**
	 * @return unknown
	 */
	public function getCat_id() {
		return $this->cat_id;
	}
	
	/**
	 * @return unknown
	 */
	public function getCat_name() {
		return $this->cat_name;
	}
	
	/**
	 * @param unknown_type $cat_id
	 */
	public function setCat_id($cat_id) {
		$this->cat_id = $cat_id;
	}
	
	/**
	 * @param unknown_type $cat_name
	 */
	public function setCat_name($cat_name) {
		$this->cat_name = $cat_name;
	}

	
}

?>