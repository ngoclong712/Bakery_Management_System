<?php  
session_start();
require '../check_admin_login.php';
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

require '../connect.php';
$sql = "select * from manufacturers";
$sql1 = "select * from type";
$result = mysqli_query($connect, $sql);
$result1 = mysqli_query($connect, $sql1);
?>
<form method="post" action="process_insert.php" enctype="multipart/form-data">
	<h1>Thêm sản phẩm</h1>
	<br>
	Tên
	<input type="text" name="name">
	<br>
	Ảnh
	<input type="file" name="photo">
	<br>
	Giá tiền
	<input type="number" name="price">
	<br>
	Nhà sản xuất
	<select name="manufacturer_id">
		<?php foreach ($result as $each) { ?>
			<option value="<?php echo $each['id'] ?>">
				<?php echo $each['name'] ?>
			</option>
		<?php } ?>
	</select>
	<br>
	Loại
	<select name="type_id">
		<?php foreach ($result1 as $each1) { ?>
			<option value="<?php echo $each1['id'] ?>">
				<?php echo $each1['name'] ?>
			</option>
		<?php } ?>
	</select>
	<br>
	Mô tả
	<textarea name="description"></textarea>
	<br>
	<button>Thêm</button>
</form>
</body>
</html>