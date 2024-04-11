<?php 

session_start();
if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['phone']) || empty($_POST['address'])) {
	$_SESSION['error'] = "Phải điền đầy đủ thông tin";
	header('location:signup.php');
	exit();
}

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$phone = $_POST['phone'];
$address = $_POST['address'];

require 'admin/connect.php';
$sql = "select * from customers where email = '$email'";
$result = mysqli_query($connect, $sql);

if(mysqli_num_rows($result) == 1) {
	$_SESSION['error'] = "Email " . $_POST['email'] . " đã tồn tại, vui lòng đăng ký bằng email khác";
	header('location:signup.php');
	exit();
}

$sql = "insert into customers(name, email, password, phone, address)
values('$name','$email','$password','$phone','$address')";

mysqli_query($connect, $sql);

$sql = "select * from customers where email = '$email'";
$result = mysqli_query($connect, $sql);
$id = mysqli_fetch_array($result)['id'];

$_SESSION['id'] = $id;
$_SESSION['name'] = $name;

mysqli_close($connect);

header('location:index.php');
