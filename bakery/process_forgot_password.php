<?php 

require 'admin/connect.php';
$tendb = "$_SERVER[REQUEST_URI]";
$tach = explode('/', $tendb);
$tmp = $tach[1];
// die($tmp);
$actual_link = "http://$_SERVER[HTTP_HOST]/$tmp";
// die($actual_link);
$email = $_POST['email'];

$sql = "select * from customers
where email = '$email'";
$result = mysqli_query($connect, $sql);
if(mysqli_num_rows($result) === 1) {
	$each = mysqli_fetch_array($result);
	$id = $each['id'];
	$name = $each['name'];
	$sql = "delete from forgot_password
	where customer_id = '$id'";
	$result = mysqli_query($connect, $sql);
	$token = uniqid();
	$sql = "insert into forgot_password(customer_id, token)
	values('$id','$token')";
	mysqli_query($connect, $sql);

	$link = $actual_link."/change_new_password.php?token=$token";

	
	require 'mail.php';
	$title = "Đặt lại mật khẩu";
	$content = "Bấm vào đây để thay đổi mật khẩu <a href='$link'>Đặt lại mật khẩu</a>";
	// die($content);
	sendmail($email, $name, $title, $content);
}
