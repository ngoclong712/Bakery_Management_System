<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
<form>
	Điền gì đó đi
	<input type="text" name="ten" id="ten">
</form>
<div id="ket_qua">
	
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$("#ten").keyup(function(event) {
			let ten = $(this).val();
			$("#ket_qua").text('Bạn đã điền: ' + ten);
		});
	});
</script>
<!-- 
đóng kết nối ở đâu (tránh trong vòng lặp)

tạo file header rồi include, k chèn lại menu

*admin: nên để table, để thẳng hàng cho sửa xóa, không để div

làm tìm kiếm, phân trang, phân trang nên tống 1 file riêng

dung PDO kết hợp prepare param tránh sql injection

theo 1 quy tắc, vd viết hoa chữ cái đầu cho tiêu đề =>> áp dụng hết

validate trước =>> r mới khai báo biến, validate có thể addslashes

validate cả backend và frontend(dùng js), validate backend trước

validate js tách 1 file riêng

nút đăng nhập ở bên trái, hủy ở bên phải

nên dùng exit() thay vì die(), vì die() dùng để hiển thị lỗi

*sản phẩm k được phép xóa nếu nằm trong hóa đơn

super admin không được phép xóa nhau, k được phép xóa bản thân, admin không được phép xóa

select option chạy vòng for từ min tới date('Y') 
số sản phẩm đã đặt: left join group by ten
SELECT
products.id,
name,
ifnull(sum(quantity), 0) as quantity_sale
from products
left join order_product on order_product.product_id = products.id
left join orders on orders.id = order_product.order_id
where orders.status = 1 or orders.status is null
GROUP by products.id;
-->
</body>
</html>