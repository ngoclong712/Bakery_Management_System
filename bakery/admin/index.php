<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
<?php 

session_start();
if(isset($_SESSION['error'])) {
	echo $_SESSION['error'];
	unset($_SESSION['error']);
}

?>
<form method="post" action="process_login.php">
	<h1>Đăng nhập admin</h1>
	Email
	<input type="email" name="email">
	<br>
	Mật khẩu
	<input type="password" name="password">
	<br>
	<button>Đăng nhập</button>
</form>
</body>
</html>