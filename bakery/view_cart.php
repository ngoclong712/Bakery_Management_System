<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
<p>
	<a href="index.php">Trở về trang chủ</a>
</p>
<?php 
	session_start();
	if(empty($_SESSION['cart'])) {
?>
	<h1>Giỏ hàng của bạn hiện tại tạm thời trống, hãy quay lại sau khi đặt hàng nhé</h1>
<?php } else { 
	$cart = $_SESSION['cart'];
	$sum = 0;
?>
<table border="1" width="100%">
	<tr>
		<th>Mã sản phẩm</th>
		<th>Tên</th>
		<th>Ảnh</th>
		<th>Giá</th>
		<th>Số lượng</th>
		<th>Tổng tiền</th>
		<th>Xóa</th>
	</tr>
	<?php foreach ($cart as $each) { ?>
		<tr>
			<td><?php echo $each['id'] ?></td>
			<td><?php echo $each['name'] ?></td>
			<td>
				<?php if($each['photo'] != 'current_empty') { ?>
					<img src="admin/products/photos/<?php echo $each['photo'] ?>" height="100">
				<?php } else { ?>
					<p>Sản phẩm tạm thời chưa có hình ảnh minh họa</p>
				<?php } ?>
			</td>
			<td><?php echo $each['price'] ?></td>
			<td>
				<a href="update_quantity.php?id=<?php echo $each['id'] ?>&type=dec">
					-
				</a>
				<?php echo $each['quantity'] ?>
				<a href="update_quantity.php?id=<?php echo $each['id'] ?>&type=inc">
					+
				</a>
			</td>
			<td>
				<?php  
					$result = $each['price'] * $each['quantity'];
					$sum += $result;
					echo $result;
				?>		
			</td>
			<td>
				<a href="delete_from_cart.php?id=<?php echo $each['id'] ?>">X</a>
			</td>
		</tr>
	<?php } ?>
</table>
<h1>
	Tổng tiền hóa đơn:
	<?php echo "$" . $sum ?>
</h1>
<?php 
	$id = $_SESSION['id'];
	require 'admin/connect.php';
	$sql = "select * from customers
	where id = '$id'";
	$result1 = mysqli_query($connect, $sql);
	$each1 = mysqli_fetch_array($result1);
?>
<form method="post" action="process_checkout.php">
	Tên người nhận
	<input type="text" name="name_receiver" value="<?php echo $each1['name'] ?>">
	<br>
	SĐT người nhận
	<input type="text" name="phone_receiver" value="<?php echo $each1['phone'] ?>">
	<br>
	Địa chỉ người nhận
	<input type="text" name="address_receiver" value="<?php echo $each1['address'] ?>">
	<br>
	<button>Đặt hàng</button>
</form>
<?php } ?>
</body>
</html>