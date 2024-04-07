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
	if(isset($_SESSION['success'])) {
		echo $_SESSION['success'] . "<br>";
		unset($_SESSION['success']);
	}
	if(isset($_SESSION['error'])) {
		echo $_SESSION['error'] . "<br>";
		unset($_SESSION['error']);
	}
	include '../menu.php';
	require '../connect.php';

	$sql = "select * from manufacturers";
	$result = mysqli_query($connect, $sql);
?>
Đây là giao diện quản lý nhà sản xuất 
<a href="form_insert.php">Thêm</a>
<table border="1" width="100%">
	<tr>
		<th>Mã</th>
		<th>Tên</th>
		<th>Địa chỉ</th>
		<th>Điện thoại</th>
		<th>Ảnh</th>
		<th>Sửa</th>
		<th>Xóa</th>
	</tr>
	<?php foreach ($result as $each) { ?>
	<tr>
		<td>
			<?php echo $each['id'] ?>
		</td>
		<td>
			<?php echo $each['name'] ?>
		</td>
		<td>
			<?php echo $each['address'] ?>
		</td>
		<td>
			<?php echo $each['phone'] ?>
		</td>
		<td>
			<?php if ($each['photo'] != 'current_empty') { ?>
				<img src="photos\<?php echo $each['photo'] ?>" height = '100'>
			<?php } else {
				echo "Nhà sản xuất này tạm thời chưa có ảnh đại diện";
			}?>
		</td>
		<td>
			<a href="form_update.php?id=<?php echo $each['id'] ?>">
				Sửa
			</a>
		</td>
		<td>
			<a href="delete.php?id=<?php echo $each['id'] ?>">
				Xóa
			</a>
		</td>
	</tr>
	<?php } ?>
</table>
</body>
</html>