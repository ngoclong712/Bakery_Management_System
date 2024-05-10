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
	$total = 0;
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
			<td>
				<span class="span-price">
					<?php echo $each['price'] ?>
				</span>
				
			</td>
			<td>
				<button 
				class="btn-update-quantity" 
				data-id="<?php echo $each['id'] ?>"
				data-type="dec"
				>
					-
				</button>
				<span class="span-quantity">
					<?php echo $each['quantity'] ?>
				</span>
				<button 
				class="btn-update-quantity" 
				data-id="<?php echo $each['id'] ?>"
				data-type="inc"
				>
					+
				</button>
			</td>
			<td>
				<span class="span-sum">
					<?php 
						$sum = $each['quantity']*$each['price'];
						$total += $sum;
						echo $sum;
					?>
				</span>
			</td>
			<td>
				<button class="btn-delete" data-id="<?php echo $each['id'] ?>">
					X
				</button>
			</td>
		</tr>
	<?php } ?>
</table>
<h1>
	Tổng tiền hóa đơn: $
	<span id="span-total">
		<?php echo  $total ?>
	</span>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$(".btn-update-quantity").click(function(event) {
		let btn = $(this);
		let id = btn.data('id');
		let type = btn.data('type');
		$.ajax({
			url: 'update_quantity.php',
			type: 'GET',
			data: {id, type},
		})
		.done(function() {
			let parent_tr = btn.parents('tr');
			let price = parent_tr.find('.span-price').text();
			let quantity = parent_tr.find('.span-quantity').text();
			if(type === 'inc') {
				quantity++;
			}
			else {
				quantity--;
			}
			if(quantity === 0) {
				parent_tr.remove();
				/*xử lí khi giỏ hàng trống*/
			}
			else {
				parent_tr.find('.span-quantity').text(quantity);
				let sum = price * quantity;
				parent_tr.find('.span-sum').text(sum);
			}

			getTotal();

		})
	});
	$(".btn-delete").click(function(event) {
		let btn = $(this);
		let id = btn.data('id');
		$.ajax({
			url: 'delete_from_cart.php',
			type: 'GET',
			data: {id},
		})
		.done(function() {
			btn.parents('tr').remove();
			getTotal();
		})
	});
});
function getTotal() {
	let total = 0;
	$(".span-sum").each(function() {
		total += parseFloat($(this).text());
	});
	$("#span-total").text(total);
}
</script>
</body>
</html>