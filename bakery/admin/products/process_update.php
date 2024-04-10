<?php 

session_start();
require '../check_admin_login.php';
require '../connect.php';

if(empty($_POST['name']) ||empty($_POST['price']) || empty($_POST['description'])) {
	header('location:index.php');
	$_SESSION['error'] = "Phải điền đầy đủ thông tin";
	exit;
}

$photo_new = $_FILES['photo_new'];
if($photo_new['size'] > 0) {
	$folder = "photos/";
	$file_extension = explode('.', $photo_new['name'])[1];
	$file_name = time(). '.' . $file_extension;
	$file_path = $folder.$file_name;
	move_uploaded_file($photo_new['tmp_name'], $file_path);
}
else {
	$file_name = $_POST['photo_old'];
}
$id = $_POST['id'];
$name = $_POST['name'];
$price = $_POST['price'];
$manufacturer_id = $_POST['manufacturer_id'];
$type_id = $_POST['type_id'];
$description = $_POST['description'];

$sql = "update products
set
name = '$name',
price = '$price',
manufacturer_id = '$manufacturer_id',
photo = '$file_name',
type_id = '$type_id',
description = '$description'
where id = '$id'
";

mysqli_query($connect, $sql);

mysqli_close($connect);

$_SESSION['success'] = "Cập nhật thành công";
header('location:index.php');