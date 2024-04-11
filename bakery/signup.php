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
<h1>Đăng ký tài khoản</h1>
<form action="process_signup.php" method="post">
	Tên
	<input type="text" name="name">
	<br>
	Email
	<input type="email" name="email">
	<br>
	Mật khẩu
	<input type="password" name="password">
	<br>
	Số điện thoại
	<input type="text" name="phone">
	<br>
	Địa chỉ
	<textarea name="address"></textarea>
	<br>
	<button>Đăng ký</button>
</form>
</body>
</html>