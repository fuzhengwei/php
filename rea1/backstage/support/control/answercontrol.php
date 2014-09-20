<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
require_once '../../../util/StackConst.php';

//获取操作类型值
$type = @$_POST['type'] == "" ? @$_GET['type']:@$_POST['type'];

if("addAnswer" == $type){
	
	$arrAnswerInfo = array(
							"sup_res_answer_title" => @$_POST['sup_res_answer_title'],
							"sup_res_answer_content" => @$_POST['sup_res_answer_content']
	);
	
	//引入AnswerDao操作类
	require_once '../dao/AnswerDao.php';
	//实例化Dao
	$answerDao = new AnswerDao();
	
	if($answerDao->addAnswer($arrAnswerInfo)){
		echo "技术解答保存成功！";
		StackConst::jump_page("../view/resanswerlist.php");
	}else{
		echo "技术解答保存失败！";
	}
	
}else if("deleteAnswer" == $type){
	
	//引入AnswerDao操作类
	require_once '../dao/AnswerDao.php';
	//实例化Dao
	$answerDao = new AnswerDao();
	
	if($answerDao->deleteAnswerById(@$_GET['sup_res_answer_id'])){
		echo "技术解答删除成功！";
		StackConst::jump_page("../view/resanswerlist.php");
	}else{
		echo "技术解答删除失败！";
	}
}else if("updateAnswer" == $type){
	//引入AnswerDao操作类
	require_once '../dao/AnswerDao.php';
	//实例化Dao
	$answerDao = new AnswerDao();
	
	if($answerDao->deleteAnswerById(@$_POST['sup_res_answer_id'])){
		
		$arrAnswerInfo = array(
							"sup_res_answer_title" => @$_POST['sup_res_answer_title'],
							"sup_res_answer_content" => @$_POST['sup_res_answer_content']
		);
		
		if($answerDao->addAnswer($arrAnswerInfo)){
			echo "技术解答修改成功！";
			StackConst::jump_page("../view/resanswerlist.php");
		}else{
			echo "技术解答修改失败！";
		}
		
		StackConst::jump_page("../view/resanswerlist.php");
	}else{
		echo "技术解答修改失败！";
	}
}
?>