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

require 'mail.php';
$title = "Đăng ký tài khoản thành công";
$content = "Chúc mừng bạn đã đăng ký thành công, tài khoản đăng nhập của bạn là " . $email . ", vui lòng bấm vào đây để đăng nhập: <a href='http://localhost/bakery/signin.php'> Đăng nhập</a>";
sendmail($email, $name, $title, $content);

mysqli_query($connect, $sql);

$sql = "select * from customers where email = '$email'";
$result = mysqli_query($connect, $sql);
$id = mysqli_fetch_array($result)['id'];

$_SESSION['id'] = $id;
$_SESSION['name'] = $name;

mysqli_close($connect);

header('location:index.php');
