<?php
	session_start(); 
	if($_GET['exit']==1)
	{
		$_SESSION['login'] = 0;
		header('Location:login.php');
	}
	else 
	{
		if($_POST['user']=='admin')
		{
			if($_POST['password']=='anyi0927')
			{
				 $_SESSION['login'] = 1;
				header('Location:newinfo.php');
			}
			else 
				header('Location:login.php');
		}
		else 
				header('Location:login.php');
	}
?>
