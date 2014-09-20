<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
header ( 'Content-type: text/html; charset=utf-8' );
session_start ();

$type = @$_POST['ctype'];
$type_get = @$_GET['ctype'];
if('bookshare' == $type){
	
	require_once '../dao/BookDao.php';
	require_once '../../../util/pcs/libs/BaiduPCS.class.php';
	require_once '../../../util/StackConst.php';
	
	if (isset ( $_FILES ["book_file"] )) {
		if ($_FILES ["book_file"] ["error"] > 0) {
			echo "Error: " . $_FILES ["book_file"] ["error"] . "<br />";
		} else {
//			echo "Upload: " . $_FILES ["book_file"] ["name"] . "<br />";
//			echo "Type: " . $_FILES ["book_file"] ["type"] . "<br />";
//			echo "Size: " . ($_FILES ["book_file"] ["size"] / 1024) . " Kb<br />"; //对于文件大小 后期上传将做限制
//			echo "Stored in: " . $_FILES ["book_file"] ["tmp_name"] . "<br/>";
		}
	}
	$arrBook = array(
						'fk_user_id' => @$_SESSION ['userLoginMessage']['user_id'],
						'resource_book_name' => @$_POST['resource_book_name'],
						'resource_book_language' => @$_POST['resource_book_language'],
						'resource_book_url' => 'book/'.@$_POST['resource_book_language'].'/'.$_FILES ["book_file"] ["name"],
						'resource_book_size' =>($_FILES ["book_file"] ["size"] / 1024),
						'resource_book_level' => @$_POST['resource_book_level'],
						'resource_book_review' => @$_POST['resource_book_review'],
						'resource_book_word' => @$_POST['resource_book_word']
					);
	
	$bookDao = new BookDao();
	//增加到数据，并判断是否成功
	/*
	if($bookDao->shareBook($arrBook))
	{
		$pcs = new BaiduPCS ( StackConst::access_token() );
		$pcs->upload(file_get_contents ($_FILES ["book_file"] ["tmp_name"]),StackConst::pcs_url().'book/'.@$_POST['resource_book_language'].'/',$_FILES ["book_file"] ["name"],NULL,TRUE);
		
		//跳转回书籍列表页面
		header ( "Location: ../view/booklist.php" );
		
	}else{
		echo "error!";
	}
	*/
	//跳转回书籍列表页面
	header ( "Location: ../view/booklist2.php" );
}else if('downbook' == $type_get){
	require_once '../../../util/StackConst.php';
	
	$DOWNURL = "https://pcs.baidu.com/rest/2.0/pcs/file?method=download&access_token=".StackConst::access_token()."&path=".StackConst::pcs_url().@$_GET ['path'];

	StackConst::jump_page($DOWNURL);
}
?>