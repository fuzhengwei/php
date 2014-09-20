<?php
	require_once '../../../util/StackConst.php';
	require_once '../dao/PcsBookDao.php';
	$arrBooks = array();
	if("" != @$_POST['language']){
		$pcsBookDao = new PcsBookDao();
		$arrBooks = $pcsBookDao->getBookList(@$_POST['language'],@$_POST['ORDER'],@$_POST['BY'],@$_POST['LIMIT'],@$_POST['isFilter']);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>book pcs</title>
<link type="text/css" rel="stylesheet" href="../../zcss/pcsbook.css" />

</head>

<body>
<div class="top">
	<form action="pcsbook.php" method="post">
		<input type="hidden" value="pcsbooklist" name="ctype"/>
		<table>
			<tr>
				<td bgcolor="#33CC00">查询PCS</td>
			</tr>
			<tr>
				<td>
					<select name="language">
						<option value="C">C</option>
						<option value="C艹">C++</option>
						<option value="JAVA">JAVA</option>
						<option value="PHP">PHP</option>
						<option value="CSharp">CSharp</option>
						<option value="NET">NET</option>
						<option value="ORACLE">ORACLE</option>
						<option value="MYSQL">MYSQL</option>
						<option value="MSSQL">MSSQL</option>
						<option value="DB2">DB2</option>
						<option value="SYBASE">SYBASE</option>
						<option value="ACCESS">ACCESS</option>
						<option value="HTML">HTML</option>
						<option value="JAVASCRIPT">JAVASCRIPT</option>
						<option value="JQUERY">JQUERY</option>
						<option value="EXTJS">EXTJS</option>
						<option value="GIT">GIT</option>
						<option value="SVN">SVN</option>
						<option value="CVS">CVS</option>
						<option value="ANT">ANT</option>
						<option value="MAVEN">MAVEN</option>
						<option value="ROSE">ROSE</option>
						<option value="POWERDESIGNER">POWERDESIGNER</option>
						<option value="TOMCAT">TOMCAT</option>
						<option value="JBOSS">JBOSS</option>
						<option value="APACHE">APACHE</option>
						<option value="LINUX">LINUX</option>
					</select>
				</td>
				<td bgcolor="#CC0099">ORDER
					<select name="ORDER">
						<option value="asc">ASC</option>
						<option value="desc" selected="selected">DESC</option>
					</select>
				</td>
				<td bgcolor="#FF0000">BY
					<select name="BY">
						<option value="time">time</option>
						<option value="name">name</option>
						<option value="size">size</option>
					</select>
				</td>
				<td bgcolor="#CC3399">
					查询范围【0-5、0-10、3-9】：<input type="text" name="LIMIT"/>
				</td>
				<td bgcolor="#99CC99">是否显示已保存书籍
					<label><input type="radio" name="isFilter" value="1" checked="checked"/>否</label>
					<label><input type="radio" name="isFilter" value="0" />是</label>
				</td>
				<td>
					<input type="submit" value="查询"/>
				</td>
			</tr>
		</table>
	</form>
</div>
<table bgcolor="#CCCCCC" border="1">
	<tr>
		<td>文件类型</td>
		<td>文件名称</td>
		<td>文件路径</td>
		<td>文件大小</td>
		<td>上传时间</td>
		<td>难度级别</td>
		<td>书籍评价</td>
		<td>中心思想</td>
		<td>操作</td>
		<td>缩略图</td>
	</tr>
	
	<?php 
		if("" != $arrBooks){
			foreach ($arrBooks as $arrBook){
	?>			<form action="../control/bookcontrol.php" method="post">
					<input type="hidden" value="pcsbook2db" name="ctype"/>
					<tr>
						<td>
							<?php echo $arrBook['resource_book_language'];?>
							<input type="hidden" value="<?php echo $arrBook['resource_book_language'];?>" name="resource_book_language"/>
						</td>
						<td style="word-wrap:break-word; word-break:break-all;width: 150px;">
							<?php echo $arrBook['resource_book_name'];?>
							<input type="hidden" value="<?php echo $arrBook['resource_book_name'];?>" name="resource_book_name"/>
						</td>
						<td style="word-wrap:break-word; word-break:break-all;width: 150px;">
							<?php echo $arrBook['resource_book_url'];?>
							<input type="hidden" value="<?php echo $arrBook['resource_book_url'];?>" name="resource_book_url"/>
						</td>
						<td>
							<?php echo $arrBook['resource_book_size'];?> M
							<input type="hidden" value="<?php echo $arrBook['resource_book_size'];?>" name="resource_book_size"/>
						</td>
						<td>
							<?php echo $arrBook['resource_book_date'];?>
							<input type="hidden" value="<?php echo $arrBook['resource_book_date'];?>" name="resource_book_date"/>
						</td>
						<td>
							<select name="resource_book_level" style="width: 100px; height: 50px;font-size: 18px;">
								<option value="菜鸟级别">菜鸟级别</option>
								<option value="初级级别">初级级别</option>
								<option value="中级级别">中级级别</option>
								<option value="高级级别">高级级别</option>
								<option value="大师级别">大师级别</option>
							</select>
						</td>
						<td width="100" height="100">
							<textarea name="resource_book_review" class="resource_book_review"></textarea>
						</td>
						<td>
							<input type="text" value="<?php echo $arrBook['resource_book_word'];?>" name="resource_book_word"/>
						</td>
						
						<td>
							<?php 
								if($arrBook['isExit']){
							?>
									<input type="submit" value="保存到数据库" style="width: 100px; height: 50px;"/>
							<?php		
								}else{
									echo "数据库已经存在此条数据！";
								}
							?>
							
						</td>
						<td><a href="https://pcs.baidu.com/rest/2.0/pcs/file?method=download&access_token=<?php echo StackConst::access_token();?>&path=<?php echo urlencode(StackConst::pcs_url().$arrBook['resource_book_url']);?>">
							<img src="https://pcs.baidu.com/rest/2.0/pcs/thumbnail?method=generate&access_token=<?php echo StackConst::access_token();?>&path=<?php echo urlencode(StackConst::pcs_url().$arrBook['resource_book_url']);?>&quality=10&width=80&height=100" width="80" height="100"/>
							</a>
						</td>
					</tr>
				</form>
	<?php
			}
		}
	?>
	
</table>
</body>
</html>
