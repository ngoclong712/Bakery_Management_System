<?php 
session_start();
if(empty($_SESSION['id'])) {
	$_SESSION['error'] = "Vui lòng đăng nhập";
	header('location:signin.php');
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
<?php include 'menu.php' ?>
Đây là giao diện sau khi đăng nhập của người dùng
<?php echo $_SESSION['name'] ?>
</body>
</html>