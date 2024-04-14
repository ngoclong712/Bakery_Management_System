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
	$sql = "select orders.*,
	customers.name as cn,
	customers.phone as cp,
	customers.address as ca
	from orders
	join customers on customers.id = orders.customer_id";
	$result = mysqli_query($connect, $sql);
?>
Đây là giao diện quản lý đơn hàng
<table border="1" width="100%">
	<tr>
		<th>Mã</th>
		<th>Thời gian đặt</th>
		<th>Thông tin người nhận</th>
		<th>Thông tin người đặt</th>
		<th>Trạng thái</th>
		<th>Tổng tiền</th>
		<th>Xem</th>
		<th>Sửa</th>
	</tr>
	<?php foreach ($result as $each) { ?>
		<tr>
			<td><?php echo $each['id'] ?></td>
			<td><?php echo $each['created_at'] ?></td>
			<td>
				<?php 
					echo $each['cn'] . "<br>";
					echo $each['cp'] . "<br>";
					echo $each['ca'];
				?>
			</td>
			<td>
				<?php  
					echo $each['name_receiver'] . "<br>";
					echo $each['phone_receiver'] . "<br>";
					echo $each['address_receiver'];
				?>
			</td>
			<td>
				<?php 
					switch ($each['status']) {
						case '0':
							echo "Mới đặt";
							break;
						case '1':
							echo "Đã duyệt";
							break;
						case '2':
							echo "Đã hủy";
							break;
					}
				?>
			</td>
			<td><?php echo $each['total_price'] ?></td>
			<td>
				<a href="detail.php?id=<?php echo $each['id'] ?>">Xem chi tiết</a>
			</td>
			<td>
				<?php if($each['status'] != 0) { ?>
					<p>Đơn hàng đã được xử lí</p>
				<?php } else { ?>
					<a href="update.php?id=<?php echo $each['id'] ?>&status=1">
						Duyệt
					</a>
					<br>
					<a href="update.php?id=<?php echo $each['id'] ?>&status=2">
						Hủy
					</a>
				<?php } ?>
			</td>
		</tr>
	<?php } 
	mysqli_close($connect);
	?>
</table>
</body>
</html>