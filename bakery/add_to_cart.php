<?php 

try {
	
session_start();

if(empty($_GET['id'])) {
	throw new Exception("Không tồn tại id");
	
}

$id = $_GET['id'];

if(empty($_SESSION['cart'][$id])) {
	require 'admin/connect.php';
	$sql = "select * from products
	where id = '$id'";
	$result = mysqli_query($connect, $sql);
	$each = mysqli_fetch_array($result);
	$_SESSION['cart'][$id]['id'] = $id;
	$_SESSION['cart'][$id]['name'] = $each['name'];
	$_SESSION['cart'][$id]['photo'] = $each['photo'];
	$_SESSION['cart'][$id]['price'] = $each['price'];
	$_SESSION['cart'][$id]['quantity'] = 1;
	mysqli_close($connect);
}
else {
	$_SESSION['cart'][$id]['quantity'] ++;
}

// $_SESSION['success'] = "Thêm vào giỏ hàng thành công";
// header('location:index.php');
echo 1;

} catch (Throwable $e) {
	echo $e->getMessage();
}