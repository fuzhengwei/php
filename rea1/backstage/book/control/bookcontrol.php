<?php
	header ( 'Content-type: text/html; charset=utf-8' );
	date_default_timezone_set('prc');  
  

	$ctype = @$_POST['ctype'];
	//pcs书籍链接保存的数据库
	if("pcsbook2db" == $ctype){
		
		require_once '../dao/BookDao.php';
		
		$bookDao = new BookDao();
		
		$arrBook = array(
						'fk_user_id' => 0,//默认系统管理员分配
						'resource_book_name' => @$_POST['resource_book_name'],
						'resource_book_language' => @$_POST['resource_book_language'],
						'resource_book_url' => @$_POST['resource_book_url'],
						'resource_book_size' =>@$_POST['resource_book_size'],
						'resource_book_level' => @$_POST['resource_book_level'],
						'resource_book_review' => @$_POST['resource_book_review'],
						'resource_book_word' => @$_POST['resource_book_word'],
						'resource_book_date' => @$_POST['resource_book_date']
					);
					
		if($bookDao->shareBook($arrBook)){
			$url = "../view/pcsbook.php";
			echo "<script language='javascript' type='text/javascript'>";
			echo "window.location.href='$url'";
			echo "</script>";
		}
		
	}

?>