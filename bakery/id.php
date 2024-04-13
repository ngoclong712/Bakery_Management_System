<?php 
	$id = $_GET['id'];
	require 'admin/connect.php';
	$sql = "select * from products
	where id = '$id'";
	$result = mysqli_query($connect, $sql);
	if(mysqli_num_rows($result) != 1) {
		session_start();
		$_SESSION['error'] = "Không tồn tại sản phẩm với id = $id";
		header('location:index.php');
		exit();
	}
	$each = mysqli_fetch_array($result);
?>

<div id="middle">
	<h1><?php echo $each['name'] ?></h1>
	<?php if($each['photo'] != 'current_empty') { ?>
		<img src="admin/products/photos/<?php echo $each['photo'] ?>">
	<?php } else { ?>
		<h3>Sản phẩm này tạm thời chưa có hình ảnh minh họa, xin lỗi quý khách</h3>
	<?php } ?>
	<p><?php echo "Giá tiền " . $each['price'] ?></p>
	<p><?php echo $each['description'] ?></p>
</div>