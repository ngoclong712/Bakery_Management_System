<style type="text/css">
	.each_product {
		width: 33%;
		border: solid 1px black;
		height: 300px;
		float: left;
	}
</style>
<?php 
	require 'admin/connect.php';
	$sql = "select * from products";
	$result = mysqli_query($connect, $sql);
?>

<div id="middle">
	<?php foreach ($result as $each) { ?>
		<div class="each_product">
			<h1><?php echo $each['name'] ?></h1>
			<?php if($each['photo'] != 'current_empty') { ?>
				<img src="admin/products/photos/<?php echo $each['photo'] ?>" height='100'>
			<?php } else { ?>
				<img src="admin/products/photos/images.png" height='100'>
			<?php } ?>
			<p> Giá tiền: <?php echo $each['price'] ?></p>
			<a href="product.php?id=<?php echo $each['id'] ?>">Xem chi tiết</a>
			<?php if(!empty($_SESSION['id'])) { ?>
				<br>
				<button 
					data-id="<?php echo $each['id'] ?>"
					class="btn-add-to-cart"
				>
					Thêm vào giỏ hảng
				</button>
			<?php } ?>
		</div>
	<?php } ?>
</div>