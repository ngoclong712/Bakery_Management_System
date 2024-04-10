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

	$sql = "select
	products.*,
	manufacturers.name as mn,
	type.name as tn
	from products
	join manufacturers on manufacturers.id = products.manufacturer_id
	join type on type.id = products.type_id";
	$result = mysqli_query($connect, $sql);
?>
Đây là giao diện quản lý sản phẩm
<a href="form_insert.php">Thêm</a>
<table border="1" width="100%">
	<tr>
		<th>Mã</th>
		<th>Tên</th>
		<th>Ảnh</th>
		<th>Loại</th>
		<th>Giá</th>
		<th>Tên nhà sản xuất</th>
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
			<?php if ($each['photo'] != 'current_empty') { ?>
				<img src="photos\<?php echo $each['photo'] ?>" height = '100'>
			<?php } else {
				echo "Sản phẩm này tạm thời chưa có ảnh minh họa";
			}?>
		</td>
		<td>
			<?php echo $each['tn'] ?>
		</td>
		<td>
			<?php echo $each['price'] ?>
		</td>
		<td>
			<?php echo $each['mn'] ?>
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