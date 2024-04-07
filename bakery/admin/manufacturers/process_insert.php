<?php 

session_start();
include '../check_super_admin_login.php';
include '../connect.php';

$name = $_POST['name'];
$address = $_POST['address'];
$photo = $_FILES['photo'];
$phone = $_POST['phone'];

$folder = "photos/";
$file_extension = explode('.', $photo['name'])[1];
$file_name = time(). '.' . $file_extension;
$file_path = $folder.$file_name;

move_uploaded_file($photo['tmp_name'], $file_path);

$sql = "insert into manufacturers(name, address, photo, phone)
values('$name','$address','$file_name','$phone')";
mysqli_query($connect, $sql);

mysqli_close($connect);

$_SESSION['success'] = "Thêm thành công nhà sản xuất";
header('location:index.php');