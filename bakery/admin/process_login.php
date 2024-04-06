<?php 

require 'connect.php';

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "select * from admin 
where email = '$email' and password = '$password'";

$result = mysqli_query($connect, $sql);

if (mysqli_num_rows($result) == 1) {
	session_start();
	$each = mysqli_fetch_array($result);
	$_SESSION['id'] = $each['id'];
	$_SESSION['name'] = $each['name'];
	$_SESSION['level'] = $each['level'];
	header('location:root/index.php');
	exit;
}

session_start();
$_SESSION['error'] = "Sai thông tin đăng nhập";
header('location:index.php');
exit;