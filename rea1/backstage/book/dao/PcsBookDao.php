<?php

class PcsBookDao {

	public function getBookList($language,$ORDER,$BY,$LIMIT,$isFilter){
		date_default_timezone_set('prc');  
		
		require_once '../../../util/pcs/libs/BaiduPCS.class.php';
		require_once '../../../util/StackConst.php';
		require_once 'BookDao.php';
		
		$pcs = new BaiduPCS(StackConst::access_token());
		
		$path = StackConst::pcs_url() . "book/".$language."/";
		
		//根据time排序
		$by = $ORDER;
		//升序或降序
		$order = $BY;
		//记录区间
		$limit = $LIMIT;
		
		$result = $pcs->listFiles($path, $by, $order, $limit);
	
		$flist = json_decode($result);
		
		$arrBooks = array();
		$var = 0;
		
		$bookDao = new BookDao();
		
		for($i = 0; $i <count($flist->list); $i ++){
			$bookNameBuf = substr(strrchr($flist->list[$i]->path,"/"),1,strlen(strrchr($flist->list[$i]->path,"/")));
	        
			//数据库不存在这个书返回true
			$isExit = $bookDao->isExitByBookName($bookNameBuf);
			if($isFilter == 0 ? true:false || $isExit){
				$arrBooks[$var++] = array(
	        						'isExit' => $isExit,
	        						'resource_book_language' =>@$_POST['language'],
	        						'resource_book_name' =>$bookNameBuf,
	        						'resource_book_url' =>strrchr($flist->list[$i]->path,"book"),
	        						'resource_book_size' =>sprintf("%.2f",($flist->list[$i]->size / (1024*1024) )),
	        						'resource_book_level' =>'',
	        						'resource_book_review' =>'',
	        						'resource_book_word' =>'',
	        						'resource_book_date' =>date('Y/m/d G:i:s',$flist->list[$i]->ctime)
	        					);
			}
			
	    }
		
	    return $arrBooks;
	    
	}
	
}

?>