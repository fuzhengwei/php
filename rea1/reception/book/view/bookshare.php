<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>share book</title>
<link type="text/css" rel="stylesheet" href="../../zcss/bookshare.css" />
<script language="javascript" type="text/javascript">
	function clearText(e){
		if("书籍名称" == e.value || "输入一句中心思想便于搜索" == e.value){
			e.value = "";
		}
	}
</script>
</head>

<body>
<div class="topdiv">
	<div class="logoAndInDiv">
		
	</div>
</div>

<form action="../control/bookcontrol.php" method="post" enctype="multipart/form-data">
<input type="hidden" value="bookshare" name="ctype"/>
<div class="caseTitle">
	<input type="text" value="书籍名称" onkeydown="clearText(this)" name="resource_book_name"/>
</div>
<div class="caseContent">
	<div class="contentDiv">
		<textarea name="resource_book_review"></textarea>
	</div>
	<div class="bookFile">
		<input type="file" name="book_file"/>
	</div>
	<div class="caseType">
		<select name="resource_book_language">
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
	</div>
	<div class="caseDifficulty">
		<select name="resource_book_level">
			<option value="菜鸟级别">菜鸟级别</option>
			<option value="初级级别">初级级别</option>
			<option value="中级级别">中级级别</option>
			<option value="高级级别">高级级别</option>
			<option value="大师级别">大师级别</option>
		</select>
	</div>
</div>
<div class="caseWord">
	<input type="text" value="输入一句中心思想便于搜索" onkeydown="clearText(this)" name="resource_book_word"/>
</div>
<div class="submitDiv">
	<input type="submit" value="提交书籍" onclick=""/>
</div>
</form>	
</body>
</html>
