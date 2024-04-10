<?php 

session_start();
require '../check_admin_login.php';
require '../connect.php';

if(empty($_GET['id'])) {
	$_SESSION['error'] = "Phải truyền mã vào";
	header('location:index.php');
	exit;
}

$id = $_GET['id'];
$sql = "delete from products
where id = '$id'";

mysqli_query($connect, $sql);
mysqli_close($connect);

$_SESSION['success'] = "Xóa thành công";
header('location:index.php');