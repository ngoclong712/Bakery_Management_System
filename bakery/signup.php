
<?php 
// session_start();
// if(isset($_SESSION['error'])) {
// 	echo $_SESSION['error'];
// 	unset($_SESSION['error']);
// }
?>
<div id="modal-signup" class="modal fade">
	<div class="modal-dialog">
    
      <!-- Modal content-->
	    <div class="modal-content">
	    	<div class="modal-header">
	    		<h1>Đăng ký tài khoản</h1>
	    		<div class="alert alert-danger" id="div-error" style="display: none;">
				</div>
	    	</div>
	    	<div class="modal-body">
				<form id="form-signup" method="post">
					Tên
					<input type="text" name="name">
					<br>
					Email
					<input type="email" name="email">
					<br>
					Mật khẩu
					<input type="password" name="password">
					<br>
					Số điện thoại
					<input type="text" name="phone">
					<br>
					Địa chỉ
					<textarea name="address"></textarea>
					<br>
					<button>Đăng ký</button>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	jQuery(document).ready(function() {
		$("#form-signup").validate({
			rules: {
				"password": {
					required: true,
					minlength: 8
				},
				"email": {
					required: true,
					email: true
				}
			},
			messages: {
				"email": {
					required: "Bắt buộc nhập email",
					email: "Nhập email sai rồi"
				},
				"password": {
					required: "Bắt buộc nhập password",
					minlength: "Hãy nhập ít nhất 8 ký tự"
				}
			},
			submitHandler: function() {
				$.ajax({
					url: 'process_signup.php',
					type: 'POST',
					dataType: 'html',
					data: $("#form-signup").serializeArray(),
				})
				.done(function(respond) {
					if(respond !== '1') {
						$("#div-error").text(respond);
						$("#div-error").show();
					}
					else {
						$("#modal-signup").toggle();
						$(".modal-backdrop").hide();
						$(".menu-user").show();
						$(".menu-guest").hide();
						$("#span-name").text($("input[name='name']").val());
					}
				});		
			}
		});
	});
</script>