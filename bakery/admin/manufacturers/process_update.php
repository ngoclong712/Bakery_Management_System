<?php 

session_start();
require '../check_super_admin_login.php';
require '../connect.php';

if(empty($_POST['name']) ||empty($_POST['address']) || empty($_POST['phone'])) {
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
$address = $_POST['address'];
$phone = $_POST['phone'];

$sql = "update manufacturers
set
name = '$name',
address = '$address',
phone = '$phone',
photo = '$file_name'
where id = '$id'
";

mysqli_query($connect, $sql);

mysqli_close($connect);

$_SESSION['success'] = "Cập nhật thành công";
header('location:index.php');