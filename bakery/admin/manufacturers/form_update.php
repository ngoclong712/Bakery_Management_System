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

	$sql = "select * from manufacturers
	where id = '$id'";
	$result = mysqli_query($connect, $sql);
	if(mysqli_num_rows($result) != 1) {
		$_SESSION['error'] = "Nhà sản xuất không tồn tại với id = $id";
		header('location:index.php');
		exit;
	}
	$each = mysqli_fetch_array($result);
?>
<form method="post" action="process_update.php" enctype="multipart/form-data">
	<input type="hidden" name="id" value = "<?php echo $each['id'] ?>">
	Tên
	<input type="text" name="name" value="<?php echo $each['name'] ?>">
	<br>
	Địa chỉ
	<textarea name="address"><?php echo $each['address'] ?></textarea>
	<br>
	Điện thoại
	<input type="text" name="phone" value="<?php echo $each['phone'] ?>">
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
	<button>Cập nhật</button>
</form>
</body>
</html>