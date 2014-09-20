<link href="css/iOrder.css" rel="stylesheet" type="text/css" />
<div style="margin-left:300px;margin-top:100px">
<?php
	header("Content-Type: text/html; charset=utf-8"); 
	if ($_FILES["file"]["error"] > 0)
    {
    	echo "&nbsp;&nbsp;&nbsp;&nbsp;Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  	else
    {
	    echo "&nbsp;&nbsp;&nbsp;&nbsp;Upload: " . $_FILES["file"]["name"] . "<br />";
	    echo "&nbsp;&nbsp;&nbsp;&nbsp;Type: " . $_FILES["file"]["type"] . "<br />";
	    echo "&nbsp;&nbsp;&nbsp;&nbsp;Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
	    echo "&nbsp;&nbsp;&nbsp;&nbsp;Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
	    move_uploaded_file($_FILES["file"]["tmp_name"],
	    "download/". $_FILES["file"]["name"]);
	    echo "&nbsp;&nbsp;&nbsp;&nbsp;Stored in: "."download/" . $_FILES["file"]["name"];
    }   
?> <br />  
<a href='newinfo.php'>&nbsp;&nbsp;&nbsp;&nbsp;返回</a><br />
</div> 