<?php 
session_start();

$token = $_POST['token'];
$password = $_POST['password'];

require 'admin/connect.php';
$sql = "select customer_id from forgot_password
where token = '$token'";
$result = mysqli_query($connect, $sql);
if(mysqli_num_rows($result) !== 1) {
	$_SESSION['error'] = "Không tồn tại khách hàng";
	header('location:index.php');
	exit;
}

$each = mysqli_fetch_array($result)['customer_id'];
$sql = "update customers
set password = '$password'
where id = '$each'";
mysqli_query($connect, $sql);

$sql = "delete from forgot_password
where token = '$token'";
mysqli_query($connect, $sql);
mysqli_close($connect);
$_SESSION['success'] = "Đổi mật khẩu thành công";
header('location:index.php');