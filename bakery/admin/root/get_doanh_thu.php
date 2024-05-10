<?php 

// require '../menu.php';
require '../connect.php';
$max_date = $_GET['days']; 
$sql = "select 
DATE_FORMAT(created_at, '%e-%m') as ngay, 
sum(total_price) as doanh_thu 
from orders 
WHERE DATEDIFF(NOW(), created_at) < $max_date
GROUP BY DATE_FORMAT(created_at, '%e-%m')
";
$result = mysqli_query($connect, $sql);
$arr = [];
// echo json_encode($arr);
$today = date('d');
$this_month = date('m');
if($today < $max_date) {
	$day_last_month = $max_date - $today;
	$last_month = date('Y-m-d', strtotime(" -1 month"));
	$last_only_month = date('m', strtotime(" -1 month"));
	$max_day_last_month = (new Datetime($last_month))->format('t');
	$start_day_last_month = $max_day_last_month - $day_last_month + 1;
	$days = (new DateTime())->format('t');
	for($i = $start_day_last_month; $i <= $max_day_last_month; $i++) {
		$key = $i . "-" . $last_only_month;
		$arr[$key] = 0;
	}
	$start_date_this_month = 1;
}
else {
	$start_date_this_month = $today - $max_date + 1;
}


for($i = $start_date_this_month; $i <= $today; $i++) {
	$key = $i . "-" . $this_month;
	$arr[$key] = 0;
}
foreach ($result as $each) {
	$arr[$each['ngay']] = (int)($each['doanh_thu']);
}
echo json_encode($arr);