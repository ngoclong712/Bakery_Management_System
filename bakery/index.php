<?php 
	session_start();
	if(isset($_COOKIE['remember'])) {
		$token = $_COOKIE['remember'];
		require 'admin/connect.php';
		$sql = "select * from customers
		where token = '$token'
		limit 1";
		$result = mysqli_query($connect, $sql);
		if(mysqli_num_rows($result) == 1) {
			$each = mysqli_fetch_array($result);
			$_SESSION['id'] = $each['id'];
			$_SESSION['name'] = $each['name'];
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<style type="text/css">
		#main {
			width: 100%;
			height: 700px;
		}
		#top{
			width: 100%;
			height: 20%;
		}
		#middle {
			width: 100%;
			height: 73%;
		}
		#bottom {
			width: 100%;
			height: 7%;
		}
	</style>
</head>
<body>
<div id="main">
	<?php include 'menu.php' ?>
	<?php include 'products.php' ?>
	<?php include 'footer.php' ?>
</div>
</body>
</html>