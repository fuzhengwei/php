<link href="css/iOrder.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/iOrder.js"  charset="utf-8"></script>
<script type="text/javascript" src="js/jquery-1.8.2.js" href="js/jquery-1.8.2.js"></script>
<?php 
    session_start(); 
	if($_SESSION['login'] != 1)
	{
	    // 非登录状态，执行对非登录的处理操作，例如跳回到登录页面 
	    header('Location:login.php');
	}
	
	else 
	{
		// 首先要建一个DOMDocument对象 
		$xml = new DOMDocument(); 
		// 加载Xml文件 
		$xml->load("download/update.xml"); 
		// 获取所有的post标签 
		$postDom = $xml->getElementsByTagName("iOrder"); 
		// 循环遍历post标签 
		foreach($postDom as $iOrder)
		{ 
			// 获取Title标签Node 
			$title = $iOrder->getElementsByTagName("version"); 
			/** 
			* 要获取Title标签的Id属性要分两部走 
			* 1. 获取title中所有属性的列表也就是$title->item(0)->attributes 
			* 2. 获取title中id的属性，因为其在第一位所以用item(0) 
			* 
			* 小提示： 
			* 若取属性的值可以用item(*)->nodeValue 
			* 若取属性的标签可以用item(*)->nodeName 
			* 若取属性的类型可以用item(*)->nodeType 
			*/ 
			//echo "Id: " . $title->item(0)->attributes->item(0)->nodeValue . "<br />"; 
			
			echo'<form><table><tr><td colspan="4">
<a href="iOrder.php">首页</a>&nbsp;&nbsp;&nbsp;<a href="operaxml.php">刷新</a>&nbsp;&nbsp;&nbsp;<a href="check.php?exit=1">退出</a></td></tr>';
			
			echo "<tr><td>version: </td><td colspan='3'>" . $title->item(0)->nodeValue . "<td></tr>"; 
			echo "<tr><td>download: </td><td colspan='3'>" . $iOrder->getElementsByTagName("download")->item(0)->nodeValue . 
			"<td></tr>"; 
			header("Content-Type: text/html; charset=utf-8");  
			$domInfo = $iOrder->getElementsByTagName("newinfo");
			$i=0;
			foreach ($domInfo as $newinfo)
			{
				echo "<tr><td>newinfo: </td><td colspan='3'>" . 
				$iOrder->getElementsByTagName("newinfo")->item($i)->attributes->item(0)->nodeValue . 
				"<td><td><a href='modifyxml.php?deleteelement=newinfo&&num=$i' style='padding-left:15px'>删除</a></td></tr>";
				$i++;
			}
			echo '<br />';
			$domAdvert = $iOrder->getElementsByTagName("advert");
			$j=0;
			foreach ($domAdvert as $advert)
			{
				echo '<tr><td>';echo "advert: </td><td>" . $iOrder->getElementsByTagName("advert")->item($j)->attributes->item(0)->nodeValue
				.'</td>'.'<td style="padding-left:15px">
				<a target="blank" href='.$iOrder->getElementsByTagName("advert")->item($j)->attributes->item(1)->nodeValue.'>'. 
				$iOrder->getElementsByTagName("advert")->item($j)->attributes->item(1)->nodeValue . 
				'</a></td>'.'<td style="padding-left:15px;font-weight:'.
				$iOrder->getElementsByTagName("advert")->item($j)->attributes->item(2)->nodeValue.'">'.
				$iOrder->getElementsByTagName("advert")->item($j)->attributes->item(2)->nodeValue. 
				'</td>'.'<td style="padding-left:15px;color:'.
				$iOrder->getElementsByTagName("advert")->item($j)->attributes->item(3)->nodeValue.'">'.
				$iOrder->getElementsByTagName("advert")->item($j)->attributes->item(3)->nodeValue. 
				"</td><td><a href='modifyxml.php?deleteelement=advert&&num=$j' action='' style='padding-left:15px'>删除</a></td></tr>";
				$j++;
			}
			echo '<imput type="hidden" name="delete" value="delete"></table></form>';
		}
	}
?>
<br />
<br />
</form> 
<form action="upload_file.php" method="post" enctype="multipart/form-data">
<table><tr><td>
<label for="file">Filename:</label></td><td>
<input type="file" name="file" id="file" /> </td>
</tr>
<tr><td>
<input type="submit" name="submit" value="Upload" /></td>
</tr>
</table>
</form> 
<br />
<form action='modifyxml.php' method="post" >
<table>
<tr><td style="text-align: right">修改版本号：</td><td><input id='version' name='version' type="text" /></td></tr>
<tr><td style="text-align: right">修改下载链接：</td><td><input id='downloadurl' name='downloadurl' type="text" /></td></tr>
<tr><td style="text-align: right">添加新版本信息：</td><td><input id='newinfo' name='newinfo' type="text" /></td></tr>
<tr><td style="text-align: right">添加广告：</td><td><input id='adverttitle' name='adverttitle' type="text" title="新闻标题" />
<input id='adverturl' name='adverturl' type="text" title="新闻链接" /> 
<select name='fontweight'>
<option>--请选择--</option>
<option>Normal</option>
<option>Bold</option>
<option>Thin</option>
</select>
<select name='foreground'>
<option>--请选择--</option>
<option style="color:Blue;background-color:black">Blue</option>
<option style="color:Red;background-color:black">Red</option>
<option style="color:Black;background-color:white">Black</option>
<option style="color:AliceBlue;background-color:black">AliceBlue</option>
<option style="color:Aqua;background-color:black">Aqua</option>
<option style="color:AntiqueWhite;background-color:black">AntiqueWhite</option>
<option style="color:BlueViolet;background-color:black">BlueViolet</option>
<option style="color:BlueViolet;background-color:black">BlueViolet</option>
<option style="color:CornflowerBlue;background-color:black">CornflowerBlue</option>
<option style="color:Crimson;background-color:black">Crimson</option>
<option style="color:DarkGoldenrod;background-color:black">DarkGoldenrod</option>
<option style="color:DarkGreen;background-color:black">DarkGreen</option>
<option style="color:DarkRed;background-color:black">DarkRed</option>
<option style="color:DarkViolet;background-color:black">DarkViolet</option>
<option style="color:DeepPink;background-color:black">DeepPink</option>
<option style="color:DeepSkyBlue;background-color:black">DeepSkyBlue</option>
<option style="color:DimGray;background-color:black">DimGray</option>
<option style="color:Gold;background-color:black">Gold</option>
<option style="color:Green;background-color:black">Green</option>
<option style="color:GreenYellow;background-color:black">GreenYellow</option>
<option style="color:Indigo;background-color:black">Indigo</option>
<option style="color:LightBlue;background-color:black">LightBlue</option>
<option style="color:LightGreen;background-color:black">LightGreen</option>
<option style="color:Magenta;background-color:black">Magenta</option>
<option style="color:MediumOrchid;background-color:black">MediumOrchid</option>
<option style="color:MediumTurquoise;background-color:black">MediumTurquoise</option>
<option style="color:MidnightBlue;background-color:black">MidnightBlue</option>
<option style="color:Orange;background-color:black">Orange</option>
<option style="color:Olive;background-color:black">Olive</option>
<option style="color:SaddleBrown;background-color:black">SaddleBrown</option>
<option style="color:Tomato;background-color:black">Tomato</option>
<option style="color:Yellow;background-color:black">Yellow</option>
<option style="color:Violet;background-color:black">Violet</option> 
</select>
</td></tr>
<tr style="height:60px;"><td></td>
<td><input type="submit" value="OK" style="width:137px;" /></td>
<input type="hidden" name="modify" value="modify" />
</tr>
</table>










