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
	if(isset($_SESSION['error'])) {
		echo $_SESSION['error'];
		unset($_SESSION['error']);
	}
	if(isset($_SESSION['success'])) {
		echo $_SESSION['success'];
		unset($_SESSION['success']);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
	<script src="https://jqueryvalidation.org/files/lib/jquery.form.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$(".btn-add-to-cart").click(function(event) {
		let id = $(this).data('id');
		$.ajax({
			url: 'add_to_cart.php',
			type: 'GET',
			// dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
			data: {id},
		})
		.done(function(data) {
			if(data == 1) {
				alert("Thêm thành công");
			}
			else {
				alert(data);
			}
		})
	});
	$("#btn-signup").click(function(event) {
		
	});
});
</script>
</body>
</html>