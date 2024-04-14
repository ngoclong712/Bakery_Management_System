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
		$_SESSION['error'] = "Đơn hàng này không tồn tại";
		header('location:index.php');
		exit;
	}
	$id = $_GET['id'];
	require '../menu.php';
	require '../connect.php';
	$total_price = 0;
	$sql = "select 
	order_product.*,
	products.name as pn,
	products.photo as pp,
	products.price as ppr 
	from order_product
	join products on products.id = order_product.product_id
	where order_id = '$id'";
	$result = mysqli_query($connect, $sql);
	mysqli_close($connect);
?>
<table border="1" width="100%">
	<tr>
		<th>Tên</th>
		<th>Ảnh minh họa</th>
		<th>Giá</th>
		<th>Số lượng</th>
		<th>Thành tiền</th>
	</tr>
	<?php foreach ($result as $each) { ?>
		<tr>
			<td><?php echo $each['pn'] ?></td>
			<td>
				<?php if($each['pp'] != 'current_empty') { ?>
					<img src="../products/photos/<?php echo $each['pp'] ?>" height = "100">
				<?php } else { ?>
					<p>Tạm thời sản phẩm này chưa có ảnh đại diện</p>
				<?php } ?>
			</td>
			<td><?php echo $each['ppr'] ?></td>
			<td><?php echo $each['quantity'] ?></td>
			<td>
				<?php
					echo $each['ppr']*$each['quantity'];
					$total_price += $each['ppr']*$each['quantity'];
				?>	
			</td>
		</tr>
	<?php } ?>
</table>
<h1>Tổng tiền của đơn hàng này là $<?php echo $total_price ?></h1>
</body>
</html>