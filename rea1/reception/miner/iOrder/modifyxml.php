<?php
	header("Content-Type: text/html; charset=utf-8");
	copy("download/update.xml","update.xml");
	$xml = new DOMDocument(); 
		// 加载Xml文件 
	$xml->load("download/update.xml"); 
	if($_POST['modify']=='modify')
	{
		addxml($xml,$_POST['version'],$_POST['downloadurl'],$_POST['newinfo'],
		$_POST['adverttitle'],$_POST['adverturl'],$_POST['fontweight'],$_POST['foreground']); 
	}
	else
	{
		deletexml($xml,$_GET['deleteelement'],$_GET['num']);	
	}
	$xml->save("download/update.xml");
	header('Location:operaxml.php');
?>
<?php 

function deletexml($xmldom,$elememt,$num)
{
	$deleteelement=$xmldom->getElementsByTagName($elememt)->item($num);
	$deleteelement->parentNode->removeChild($deleteelement);
}

?>
<?php 


//添加一个学生信息
//addxml($xmldom);
function addxml($xmldom,$version,$downloadurl,$newinfo,$adverttitle,$adverturl,$fontweight,$foreground)
{
	$root = $xmldom->getElementsByTagName("iOrder")->item(0);
	if($version!='')
	{
		$xmldom->getElementsByTagName("version")->item(0)->nodeValue=$version;
	}
	if($downloadurl!='')
	{
		$xmldom->getElementsByTagName("download")->item(0)->nodeValue=$downloadurl;
	}
	if($newinfo!='')
	{
		$elementnewinfo = $xmldom->createElement("newinfo"); 
		$elementnewinfo->setAttribute("value",$newinfo); 
		$root->appendChild($elementnewinfo);
	}
	if($adverttitle!=''&&$adverturl!='')
	{
		$elementadvert = $xmldom->createElement("advert"); 
		$elementadvert->setAttribute("value",$adverttitle); 
		$elementadvert->setAttribute("url",$adverturl);
		$elementadvert->setAttribute("fontweight",$fontweight); 
		$elementadvert->setAttribute("foreground",$foreground);  
		$root->appendChild($elementadvert);
	}
	 
}
?>