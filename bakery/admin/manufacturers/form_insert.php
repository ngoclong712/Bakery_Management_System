<?php  
session_start();
require '../check_super_admin_login.php';
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
if(isset($_SESSION['error'])) {
	echo $_SESSION['error'] . "<br>";
	unset($_SESSION['error']);
}
?>
<form method="post" action="process_insert.php" enctype="multipart/form-data">
	<h1>Thêm nhà sản xuất</h1>
	<br>
	Tên
	<input type="text" name="name">
	<br>
	Địa chỉ
	<textarea name="address"></textarea>
	<br>
	Điện thoại
	<input type="text" name="phone">
	<br>
	Ảnh
	<input type="file" name="photo">
	<br>
	<button>Gửi</button>
</form>
</body>
</html>