<?php

session_start ();
if (isset ( $_SESSION ['userLoginMessage'] )) {
	echo $_SESSION ['userLoginMessage'];
} else {
?>
<a href="userlogin.php" target="_blank">登录<a> | 
<a href="userregister.php" target="_blank">注册</a>|
			
<?php
}
?>