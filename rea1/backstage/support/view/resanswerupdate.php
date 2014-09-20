<?php 
//引入静态常量
require_once '../../../util/StackConst.php';
//引入操作DAO
require_once '../dao/AnswerDao.php';
//获得sup_res_answer_id
$sup_res_answer_id = @$_GET['sup_res_answer_id'];
//实例化dao
$answerDao = new AnswerDao();
//获取对象集合
$arrAnswerDetail = $answerDao->getAnsWerById($sup_res_answer_id);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>服务支持|技术解答</title>
<script language="javascript" type="text/javascript" src="../../zjs/jquery-1.8.3.js"></script>
<script type="text/javascript"> 
function hhfwz(){
	$("#sup_res_answer_content").val($("#sup_res_answer_content").val().replace(/\r\n|\n/g,'<br/>')); 
}
</script> 
</head>

<body>
<form action="../control/answercontrol.php" method="post">
	<input type="hidden" name="type" value="updateAnswer"/>
	<input type="hidden" name="sup_res_answer_id" value="<?php echo $arrAnswerDetail['sup_res_answer_id'];?>"/>
	<table border="1" width="100%">
		<tr>
			<td>技术标题点</td>
			<td><input type="text" name="sup_res_answer_title" style="width: 500px;" value="<?php echo $arrAnswerDetail['sup_res_answer_title'];?>"></td>
		</tr>
		<tr>
			<td>技术解答内容</td>
			<td><textarea cols="100" name="sup_res_answer_content" id="sup_res_answer_content" rows="20"><?php echo $arrAnswerDetail['sup_res_answer_content'];?></textarea></td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" value="修改技术解答内容" onclick="hhfwz()"/></td>
		</tr>
	</table>
</form>
</body>
</html>
