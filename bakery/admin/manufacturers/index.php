<?php  
session_start();
include '../check_super_admin_login.php';
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
if(isset($_SESSION['success'])) {
	echo $_SESSION['success'] . "<br>";
	unset($_SESSION['success']);

}
?>
Đây là giao diện quản lý nhà sản xuất
</body>
</html>