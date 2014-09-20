<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
header ( 'Content-type: text/html; charset=utf-8' );
ini_set("error_reporting","E_ALL & ~E_NOTICE");
class CaseDao {

	/**
	 * 获取案例列表
	 *
	 * @param 页数 $page
	 * @param 语言 $language
	 * @param 关键字 $word
	 * @param 状态 $statue
	 */
	public function getCaseList($page,$language,$word,$statue,$fk_user_id){
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		require_once '../../user/dao/UserDao.php';
		
		//定义每页的条数
	    $pageCount = 10;
		
		//如果是0页或者没有赋值那么默认给第一页
		if("" == $page || 0 == $page){
			$page = 1;
		}
		//分页数据
		$page_start = ($page - 1) * $pageCount;
		
		$str_sql = "select resource_case_id,fk_user_id,resource_case_language,resource_case_data,resource_case_title,substr( resource_case_content,1,150) as resource_case_content,resource_case_statue from stack_resource_case ";
		
		$str_sql_count = "select count(resource_case_id) from stack_resource_case ";
		
		//拼接sql
		if("" == $language && "" == $word && "" == $statue && "" == $fk_user_id){
			//三个多为空，这个状态比较多，因为遇到这个状态，那么下面的都不去比较了
			$str_sql .= "";
			$str_sql_count .= "";
		}else if("" != $fk_user_id){
			//languge不为空
			$str_sql .= "where fk_user_id = $fk_user_id ";
			$str_sql_count .= "where fk_user_id = $fk_user_id ";
		}else if("" != $language && "" == $word && "" == $statue){
			if("" != $fk_user_id){
				//languge不为空
				$str_sql .= "and resource_case_language = '$language' ";
				$str_sql_count .= "and resource_case_language = '$language' ";
			}else{
				//languge不为空
				$str_sql .= "where resource_case_language = '$language' ";
				$str_sql_count .= "where resource_case_language = '$language' ";
			}
			
		}else if("" != $word && "" == $language && "" == $statue){
			if("" != $fk_user_id){
				//word不为空
				$str_sql .= "and resource_case_title like '%$word%' ";
				$str_sql_count .= "and resource_case_title like '%$word%' ";
			}else{
				//word不为空
				$str_sql .= "where resource_case_title like '%$word%' ";
				$str_sql_count .= "where resource_case_title like '%$word%' ";
			}
			
		}else if("" != $statue && "" == $language && "" == $word){
			if("" != $fk_user_id){
				//statue不为空
				$str_sql .= "and resource_case_statue = '$statue' ";
				$str_sql_count .= "and resource_case_statue = '$statue' ";
			}else{
				//statue不为空
				$str_sql .= "where resource_case_statue = '$statue' ";
				$str_sql_count .= "where resource_case_statue = '$statue' ";
			}
			
		}else if(""!=$language && ""!=$word && ""!=$statue){
			if("" != $fk_user_id){
				//三个全都不为空
				$str_sql .="and resource_case_language = '$language' and resource_case_title like '%$word%' and resource_case_statue = '$statue' ";
				$str_sql_count .="and resource_case_language = '$language' and resource_case_title like '%$word%' and resource_case_statue = '$statue' ";
			}else{
				//三个全都不为空
				$str_sql .="where resource_case_language = '$language' and resource_case_title like '%$word%' and resource_case_statue = '$statue' ";
				$str_sql_count .="where resource_case_language = '$language' and resource_case_title like '%$word%' and resource_case_statue = '$statue' ";
			}
			
		}else if("" != $language && "" != $word && "" == $statue){
			if("" != $fk_user_id){
				//language word不为空
				$str_sql .= "and resource_case_language = '$language' and where resource_case_title like '%$word%' ";
				$str_sql_count .= "and resource_case_language = '$language' and where resource_case_title like '%$word%' ";
			}else{
				//language word不为空
				$str_sql .= "where resource_case_language = '$language' and where resource_case_title like '%$word%' ";
				$str_sql_count .= "where resource_case_language = '$language' and where resource_case_title like '%$word%' ";
			}
			
		}else if("" != $language && "" == $word && "" != $statue){
			if("" != $fk_user_id){
				//language statue不为空
				$str_sql .= "and resource_case_language = '$language' and resource_case_statue = '$statue' ";
				$str_sql_count .= "and resource_case_language = '$language' and resource_case_statue = '$statue' ";
			}else{
				//language statue不为空
				$str_sql .= "where resource_case_language = '$language' and resource_case_statue = '$statue' ";
				$str_sql_count .= "where resource_case_language = '$language' and resource_case_statue = '$statue' ";
			}
			
		}else if("" == $language && "" != $word && "" != $statue){
			if("" != $fk_user_id){
				//word statue 不为空
				$str_sql .= "and resource_case_title like '%$word%' resource_case_statue = '$statue' ";
				$str_sql_count .= "and resource_case_title like '%$word%' resource_case_statue = '$statue' ";
			}else{
				//word statue 不为空
				$str_sql .= "where resource_case_title like '%$word%' resource_case_statue = '$statue' ";
				$str_sql_count .= "where resource_case_title like '%$word%' resource_case_statue = '$statue' ";
			}
			
		}
		
		//以时间为倒叙排列
		$str_sql .= "order by resource_case_data desc limit $page_start,$pageCount";
		
		//根据用户id查询用户名
		$userDao = new UserDao();
		
		$conn = ConnMysqlClass::getConnMysql();
		
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$result = mysql_query ( $str_sql );
		
		$arrCases = array();
		$var = 0;
		
		while($row = mysql_fetch_array($result)){
			
			$arrCases[$var++] = array(
									'page' =>$page,
									'fk_user_id'=>$row['fk_user_id'],
									'user_head_img_name'=>$userDao->getUserHeadImgNameById($row['fk_user_id']),
									'user_name' =>$userDao->getUserById($row['fk_user_id']),
									'resource_case_id'=>$row['resource_case_id'],
									'resource_case_language'=>$row['resource_case_language'],	
									'resource_case_data'=>$row['resource_case_data'],
									'resource_case_title'=>$row['resource_case_title'],	
									'resource_case_content'=>$row['resource_case_content'],	
									'resource_case_statue'=>$row['resource_case_statue'],
								);
			
		}
		
		//查询数量能分出来多少页
		$result = mysql_query ( $str_sql_count );
		$row = mysql_fetch_array($result);
		//获得分页		
		$pageNum = $row[0] / $pageCount;
		$arrCases['pageSum'] = strval($pageNum);
		
		//关闭数据库
		mysql_close($conn);
		
		return $arrCases;
	}
	
	/**
	 * 通过resource_case_id获得案例详情
	 * @param 案例ID $resource_case_id
	 */
	public function getCaseDetailById($resource_case_id){
		
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		require_once '../../user/dao/UserDao.php';
		
		//根据用户id查询用户名
		$userDao = new UserDao();
		
		$conn = ConnMysqlClass::getConnMysql();
		
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$sql = "select resource_case_id,fk_user_id,resource_case_language,resource_case_data,resource_case_title,resource_case_content,resource_case_statue from stack_resource_case where resource_case_id = $resource_case_id";
		
		$result = mysql_query ( $sql );
		
		$arrCaseDetil = array();
		
		$row = mysql_fetch_array($result);
			
		$arrCaseDetil = array(
								'user_head_img_name'=>$userDao->getUserHeadImgNameById($row['fk_user_id']),
								'user_name' =>$userDao->getUserById($row['fk_user_id']),
								'resource_case_id'=>$row['resource_case_id'],
								'resource_case_language'=>$row['resource_case_language'],	
								'resource_case_data'=>$row['resource_case_data'],
								'resource_case_title'=>$row['resource_case_title'],	
								'resource_case_content'=>$row['resource_case_content'],	
								'resource_case_statue'=>$row['resource_case_statue'],
							);
			
		
		
		//关闭数据库
		mysql_close($conn);
		
		return $arrCaseDetil;
		
	}
	
	/**
	 * 根据id获得评论表
	 *
	 * @param 案例id $resource_case_id
	 */
	public function getCaseDiscussListById($resource_case_id){
		
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		require_once '../../user/dao/UserDao.php';
		
		//根据用户id查询用户名
		$userDao = new UserDao();
		
		$conn = ConnMysqlClass::getConnMysql();
		
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$sql = "select * from stack_resource_case_discuss where fk_resource_case_id = $resource_case_id order by resource_case_discuss_data desc";
		
		$result = mysql_query ( $sql );
		
		$arrDiscussList = array();

		$var = 0;
		while($row = mysql_fetch_array($result)){
			$arrDiscussList[$var++] = array(
												'resource_case_discuss_id'=>$row['resource_case_discuss_id'],
												'fk_user_id'=>$row['fk_user_id'],
												'user_name'=>$userDao->getUserById($row['fk_user_id']),
												'user_head_img_name'=>$userDao->getUserHeadImgNameById($row['fk_user_id']),
												'fk_resource_case_id'=>$row['fk_resource_case_id'],
												'resource_case_discuss_data'=>$row['resource_case_discuss_data'],
												'resource_case_discuss_content'=>$row['resource_case_discuss_content']	
											);
		}
		
		return $arrDiscussList;
		
	}
	
	/**
	 * 获得每类案例的数量
	 */
	public function getEachCaseCount(){
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		$conn = ConnMysqlClass::getConnMysql();
		
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$str_sql = "select resource_case_language,count(resource_case_language) from stack_resource_case group by resource_case_language order by count(resource_case_language) desc"; 
		
		$result = mysql_query ( $str_sql );
		$eachCaseCount = array();
		$var = 0;
		while($row = mysql_fetch_array($result)){
			$eachCaseCount[$var++] = array(		
												'resource_case_language'=>$row[0],
												$row[0]=>$row[1]
										   );
		}
		
		//关闭数据库
		mysql_close($conn);
		
		return $eachCaseCount;
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
	
	/**
	 * 发表案例
	 *
	 * @param 发表案例详情集合传递 $issueDetail
	 */
	public function issueCase($issueDetail){
		
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		$conn = ConnMysqlClass::getConnMysql();
		
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$fk_user_id = $issueDetail['fk_user_id'];
		$resource_case_language = $issueDetail['resource_case_language'];
		$resource_case_data = $issueDetail['resource_case_data'];
		$resource_case_title = $issueDetail['resource_case_title'];
		$resource_case_content = $issueDetail['resource_case_content'];
		$resource_case_statue = 0; //首次发为案例默认为0状态 
		
		$str_sql = "insert into stack_resource_case(fk_user_id,resource_case_language,resource_case_data,resource_case_title,resource_case_content,resource_case_statue) values($fk_user_id,'$resource_case_language','$resource_case_data','$resource_case_title','$resource_case_content',$resource_case_statue)";
		
		$myq = mysql_query($str_sql,$conn);
		
		$resource_case_id = 0;
		
		if($myq){
			//插入成功获得插入的id
			$resource_case_id = mysql_insert_id();
		}else{
			$resource_case_id = 0;
		}
		
		mysql_close($conn);
		
		return $resource_case_id;
	}

	/**
	 * 添加评论
	 *
	 * @param 评论内容 $discussDetail
	 */
	public function addDiscuss($discussDetail){
		require_once '../../conndb/mysql/ConnMysqlClass.php';
		
		$conn = ConnMysqlClass::getConnMysql();
		
		mysql_select_db(ConnMysqlClass::getDBName(), $conn);
		
		$fk_resource_case_id = $discussDetail["fk_resource_case_id"];
		$fk_user_id = $discussDetail["fk_user_id"];
		$resource_case_discuss_data = $discussDetail["resource_case_discuss_data"];
		$resource_case_discuss_content = $discussDetail["resource_case_discuss_content"];
		
		$str_sql = "insert into stack_resource_case_discuss(fk_resource_case_id,fk_user_id,resource_case_discuss_data,resource_case_discuss_content) value($fk_resource_case_id,$fk_user_id,'$resource_case_discuss_data','$resource_case_discuss_content')";
		
		$myq = mysql_query($str_sql,$conn);
		
		mysql_close($conn);
		
		return $myq;
			
	}
}


?>