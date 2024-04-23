<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
Chọn thời gian
<input type="date" name="" value="<?php echo date('Y-m-d') ?>">
<input type="week" name="">
<input type="month" name="">
<!-- 
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