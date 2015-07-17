<?php
	setcookie("username",$_POST["username"],time() + (86400* 7),"localhost");
	setcookie("password",$_POST["password"],time() + (86400* 7),"localhost");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Redirect</title>
		<meta http-equiv="refresh" content="0;URL=index.php">
	</head>
</html>
