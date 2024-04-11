<?php 
session_start();
$email = $_POST['email'];
$password = $_POST['password'];
if(isset($_POST['remember'])) {
	$remember = true;
}
else {
	$remember = false;
}

require 'admin/connect.php';

$sql = "select * from customers
where email = '$email'";

$result = mysqli_query($connect, $sql);
if(mysqli_num_rows($result) == 0) {
	$_SESSION['error'] = "Tài khoản không tồn tại";
	header('location:signin.php');
	exit();
}
$sql = "select * from customers
where email = '$email' and password = '$password'";
$result = mysqli_query($connect, $sql);
if(mysqli_num_rows($result) == 1) {
	$each = mysqli_fetch_array($result);
	$id = $each['id'];
	$_SESSION['id'] = $id;
	$_SESSION['name'] = $each['name'];
	if($remember) {
		$token = uniqid('user_', true);
		$sql = "update customers
		set token = '$token'
		where id = '$id'";
		mysqli_query($connect, $sql);
		setcookie('remember', $token, time() + (60 * 60 * 24 * 30));
	}
	header('location:user.php');
	exit();
}
else {
	$_SESSION['error'] = "Sai thông tin đăng nhập";
	header('location:signin.php');
	exit();
}
mysqli_close($connect);