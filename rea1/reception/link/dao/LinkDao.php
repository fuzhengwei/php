<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
header ( 'Content-type: text/html; charset=utf-8' );
ini_set("error_reporting","E_ALL & ~E_NOTICE");
class LinkDao {

	
	/**
	 * 根据信息查询链接
	 *
	 * @param 分页页数 $page
	 * @param 资源类别 $category
	 * @param 语言类别 $language
	 * @param 检索关键字 $word
	 */
	public function getLinkList($page,$category,$language,$word){
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		require_once '../../user/dao/UserDao.php';
		
		//定义每页的条数
	    $pageCount = 30;
		
		//如果是0页或者没有赋值那么默认给第一页
		if("" == $page || 0 == $page){
			$page = 1;
		}
		//分页数据
		$page_start = ($page - 1) * $pageCount;
		
		//根据用户id查询用户名
		$userDao = new UserDao();
		
		$conn = ConnMysqlClass::getConnMysql();
		
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$str_sql = "select fk_user_id,fk_category_sort_name,fk_language_sort_name,resource_link_name,resource_link_url,resource_link_content,resource_link_data,resource_link_statue from stack_resource_link where fk_category_sort_name = '$category' ";
		
		$str_sql_count = "select count(resource_link_id) from stack_resource_link where fk_category_sort_name = '$category' ";
		
		//组合sql语句
		if("" != $language && "" == $word){
			$str_sql .= "and fk_language_sort_name = '$language' ";
			$str_sql_count .= "and fk_language_sort_name = '$language' ";
		}else if("" == $language && "" != $word){
			$str_sql .= "and resource_link_name like '%$word%' or resource_link_content like '%$word%' ";
			$str_sql_count = "and resource_link_name like '%$word%' or resource_link_content like '%$word%' ";
		}else if("" != $language && "" != $word){
			$str_sql .= "and fk_language_sort_name = '$language' and resource_link_name like '%$word%' or resource_link_content like '%$word%' ";
			$str_sql_count = "and fk_language_sort_name = '$language' and resource_link_name like '%$word%' or resource_link_content like '%$word%' ";
		}
		
		$str_sql .= "order by resource_link_id desc limit $page_start,$pageCount";
		
		$result = mysql_query ( $str_sql );
		
		$arrLinks = array();
		$var = 0;
		
		while($row = mysql_fetch_array($result)){
			
			$arrLinks[$var++] = array(
									"fk_user_id"=>$row['fk_user_id'],
									"user_name"=>$userDao->getUserById($row['fk_user_id']),
									"fk_category_sort_name"=>$row['fk_category_sort_name'],
									"fk_language_sort_name"=>$row['fk_language_sort_name'],
									"resource_link_name"=>$row['resource_link_name'],
									"resource_link_url"=>$row['resource_link_url'],
									"resource_link_content"=>$row['resource_link_content'],
									"resource_link_data"=>$row['resource_link_data']
							    );
			
		}
		//查询数量能分出来多少页
		$result = mysql_query ( $str_sql_count );
		$row = mysql_fetch_array($result);
		//获得分页		
		$pageNum = ceil($row[0] / $pageCount);
		$arrLinks['pageSum'] = strval($pageNum);
		
		//关闭数据库
		mysql_close($conn);
		
		return $arrLinks;
		
	}
	
	/**
	 * 分享链接
	 *
	 * @param 链接信息集合 $resourceLink
	 */
	public function shareLink($resourceLink){
		
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		$conn = ConnMysqlClass::getConnMysql();
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$fk_user_id = $resourceLink['fk_user_id'];
		$fk_category_sort_name = $resourceLink['fk_category_sort_name'];
		$fk_language_sort_name = $resourceLink['fk_language_sort_name'];
		$resource_link_name = $resourceLink['resource_link_name'];
		$resource_link_url = $resourceLink['resource_link_url'];
		$resource_link_content =$resourceLink['resource_link_content'];
		$resource_link_data = $resourceLink['resource_link_data'];
		
		$str_sql = "insert into stack_resource_link(fk_user_id,fk_category_sort_name,fk_language_sort_name,resource_link_name,resource_link_url,resource_link_content,resource_link_data) values($fk_user_id,'$fk_category_sort_name','$fk_language_sort_name','$resource_link_name','$resource_link_url','$resource_link_content','$resource_link_data')";
		
		$myq = mysql_query($str_sql,$conn);
		
		mysql_close($conn);
		
		return $myq;
		
	}
	
	/**
	 * 获得每类案例的数量
	 */
	public function getEachLinkCount($fk_category_sort_name){
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		$conn = ConnMysqlClass::getConnMysql();
		
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$str_sql = "select fk_language_sort_name,count(fk_language_sort_name) from stack_resource_link where fk_category_sort_name = '$fk_category_sort_name' group by fk_language_sort_name order by count(fk_language_sort_name) desc"; 
		
		$result = mysql_query ( $str_sql );
		$eachLinkCount = array();
		$var = 0;
		while($row = mysql_fetch_array($result)){
			$eachLinkCount[$var++] = array(		
												'fk_language_sort_name'=>$row[0],
												$row[0]=>$row[1]
										   );
		}
		
		//关闭数据库
		mysql_close($conn);
		
		return $eachLinkCount;
	} 
	
	/**
	 * 获得语言分类
	 */
	public function getLanguageSort(){
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		$conn = ConnMysqlClass::getConnMysql();
		
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$str_sql = "select language_sort_name from stack_resource_language_sort";
		
		$result = mysql_query ( $str_sql );
		
		$languageSorts = array();
		$var = 0;
		while($row = mysql_fetch_array($result)){
			$languageSorts[$var++] = array(
												"language_sort_name"=>$row['language_sort_name']
										   );
		}
		//关闭数据库
		mysql_close($conn);
		
		return $languageSorts;
		
	}
	
	
}

?>