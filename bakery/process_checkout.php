<?php 

session_start();

$name_receiver = $_POST['name_receiver'];
$phone_receiver = $_POST['phone_receiver'];
$address_receiver = $_POST['address_receiver'];

require 'admin/connect.php';

$total_price = 0;

$cart = $_SESSION['cart'];
foreach ($cart as $each) {
	$total_price += $each['price']*$each['quantity'];
}

$customer_id = $_SESSION['id'];
$status = 0;

$sql = "insert into orders(customer_id, name_receiver, phone_receiver, address_receiver, status, total_price)
values('$customer_id','$name_receiver','$phone_receiver','$address_receiver','$status','$total_price')";

mysqli_query($connect, $sql);

$sql = "select max(id) from orders
where customer_id = '$customer_id'";

$result = mysqli_query($connect, $sql);
$order_id = mysqli_fetch_array($result)['max(id)'];

foreach($cart as $each) {
	$product_id = $each['id'];
	$quantity = $each['quantity'];
	$sql = "insert into order_product(order_id, product_id, quantity)
	values('$order_id','$product_id','$quantity')";
	mysqli_query($connect, $sql);
}

mysqli_close($connect);
unset($_SESSION['cart']);

$_SESSION['success'] = "Đặt hàng thành công";
header('location:index.php');