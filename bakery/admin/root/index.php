<?php  
session_start();
include '../check_admin_login.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
<?php 
require '../menu.php';
?>
<h1>Đây là giao diện admin</h1>
<h4>Chào bạn 
	<?php
		
		echo $_SESSION['name'];
	?>
</h4>
</body>
</html>