<?php 
//引入静态常量
require_once '../../../util/StackConst.php';
//引入操作DAO
require_once '../dao/AnswerDao.php';
//实例化dao
$answerDao = new AnswerDao();
//获取对象集合
$arrAnswers = $answerDao->getAnswerList();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>

<body>
	<input type="hidden" name="type" value=""/>
	<table border="1" width="95%">
		<tr>
			<th>序号</th>
			<th>技术解答标题</th>
			<th>技术解答内容</th>
			<th width="120px" colspan="2">操作</th>
		</tr>
		<?php 
			$XH = 1;
			foreach ($arrAnswers as $answer){
		?>
				<tr align="center">
					<td><?php echo $XH++;?></td>
					<td><?php echo $answer['sup_res_answer_title']?></td>
					<td><?php echo $answer['sup_res_answer_content']?></td>
					<td><a href="resanswerupdate.php?sup_res_answer_id=<?php echo $answer['sup_res_answer_id']?>">修改</a></td>
					<td><a href="../control/answercontrol.php?type=deleteAnswer&sup_res_answer_id=<?php echo $answer['sup_res_answer_id']?>">删除</a></td>
				</tr>
		<?php		
			}
		?>
	</table>
</body>
</html>
