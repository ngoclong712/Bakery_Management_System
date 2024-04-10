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
	if(empty($_GET['id'])) {
		$_SESSION['error'] = "Phải truyền mã vào";
		header('location:index.php');
		exit;
	}
	$id = $_GET['id'];

	include '../connect.php';
	include '../menu.php';

	$sql = "select * from products
	where id = '$id'";
	$result = mysqli_query($connect, $sql);
	if(mysqli_num_rows($result) != 1) {
		$_SESSION['error'] = "Nhà sản xuất không tồn tại với id = $id";
		header('location:index.php');
		exit;
	}
	$each = mysqli_fetch_array($result);
	$sql1 = "select * from manufacturers";
	$sql2 = "select * from type";
	$result1 = mysqli_query($connect, $sql1);
	$result2 = mysqli_query($connect, $sql2);
?>
<form method="post" action="process_update.php" enctype="multipart/form-data">
	<input type="hidden" name="id" value = "<?php echo $each['id'] ?>">
	Tên
	<input type="text" name="name" value="<?php echo $each['name'] ?>">
	<br>
	<?php if($each['photo'] != 'current_empty') { ?>
		Chọn ảnh mới
		<input type="file" name="photo_new">
		<br>
		Hoặc giữ ảnh cũ
		<br>
		<img src="photos\<?php echo $each['photo'] ?>" height = '100'>
		<input type="hidden" name="photo_old" value="<?php echo $each['photo'] ?>">
	<?php } else { ?>
		Chọn ảnh
		<input type="file" name="photo_new">
		<input type="hidden" name="photo_old" value="<?php echo $each['photo'] ?>">
	<?php } ?>
	<br>
	Loại
	<select name="type_id">
		<?php foreach ($result2 as $each2) { ?>
			<option value="<?php echo $each2['id'] ?>"
				<?php if($each2['id'] === $each['type_id']) { ?>
					selected
				<?php } ?>
			>
				<?php echo $each2['name'] ?>
			</option>
		<?php } ?>
	</select>
	<br>
	Giá
	<input type="text" name="price" value="<?php echo $each['price'] ?>">
	<br>
	Nhà sản xuất
	<select name="manufacturer_id">
		<?php foreach ($result1 as $each1) { ?>
			<option value="<?php echo $each1['id'] ?>"
				<?php if($each1['id'] === $each['manufacturer_id']) { ?>
					selected
				<?php } ?>
			>
				<?php echo $each1['name'] ?>
			</option>
		<?php } ?>
	</select>
	<br>
	Mô tả
	<textarea name="description"><?php echo $each['description'] ?></textarea>
	<br>
	<button>Cập nhật</button>
</form>
</body>
</html>