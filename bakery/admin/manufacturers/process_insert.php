<?php 

session_start();
include '../check_super_admin_login.php';
include '../connect.php';

$photo = $_FILES['photo'];
$file_extension = explode('.', $photo['name'])[1];


if(empty($_POST['name']) ||empty($_POST['address']) || empty($_POST['phone']) || empty($file_extension)) {
	header('location:form_insert.php');
	$_SESSION['error'] = "Phải điền đầy đủ thông tin";
	exit;
}

$name = $_POST['name'];
$address = $_POST['address'];
$phone = $_POST['phone'];

$folder = "photos/";
$file_name = time(). '.' . $file_extension;
$file_path = $folder.$file_name;

move_uploaded_file($photo['tmp_name'], $file_path);

$sql = "insert into manufacturers(name, address, photo, phone)
values('$name','$address','$file_name','$phone')";
mysqli_query($connect, $sql);

mysqli_close($connect);

$_SESSION['success'] = "Thêm thành công nhà sản xuất";
header('location:index.php');