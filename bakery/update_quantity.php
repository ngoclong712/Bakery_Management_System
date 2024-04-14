<?php 

session_start();
$id = $_GET['id'];
$type = $_GET['type'];

if($_SESSION['cart'][$id]['quantity'] === 1 && $type === 'dec') {
	unset($_SESSION['cart'][$id]);
}

else {
	if($type === 'dec') {
		$_SESSION['cart'][$id]['quantity']--;
	}
	else {
		$_SESSION['cart'][$id]['quantity']++;
	}
}

header('location:view_cart.php');