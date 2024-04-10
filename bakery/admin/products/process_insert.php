<?php 

session_start();
require '../check_admin_login.php';
require '../connect.php';

if(empty($_POST['name']) ||empty($_POST['price']) || empty($_POST['description'])) {
	header('location:form_insert.php');
	$_SESSION['error'] = "Phải điền đầy đủ thông tin";
	exit;
}

$photo = $_FILES['photo'];
$name = $_POST['name'];
$price = $_POST['price'];
$manufacturer_id = $_POST['manufacturer_id'];
$type_id = $_POST['type_id'];
$description = $_POST['description'];

$file_extension = explode('.', $photo['name'])[1];
if(empty($file_extension)) {
	$file_name = "current_empty";
}
else {
	$folder = "photos/";
	$file_name = time(). '.' . $file_extension;
	$file_path = $folder.$file_name;
	move_uploaded_file($photo['tmp_name'], $file_path);
}


$sql = "INSERT INTO `products`(`name`, `photo`, `price`, `type_id`, `manufacturer_id`, `description`) VALUES ('$name','$file_name','$price','$type_id','$manufacturer_id','$description')";
mysqli_query($connect, $sql);

mysqli_close($connect);

$_SESSION['success'] = "Thêm thành công sản phẩm";
header('location:index.php');