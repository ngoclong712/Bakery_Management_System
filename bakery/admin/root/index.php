<?php  
session_start();
require '../check_admin_login.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<style type="text/css">
		.highcharts-figure,
		.highcharts-data-table table {
		    min-width: 360px;
		    max-width: 800px;
		    margin: 1em auto;
		}

		.highcharts-data-table table {
		    font-family: Verdana, sans-serif;
		    border-collapse: collapse;
		    border: 1px solid #ebebeb;
		    margin: 10px auto;
		    text-align: center;
		    width: 100%;
		    max-width: 500px;
		}

		.highcharts-data-table caption {
		    padding: 1em 0;
		    font-size: 1.2em;
		    color: #555;
		}

		.highcharts-data-table th {
		    font-weight: 600;
		    padding: 0.5em;
		}

		.highcharts-data-table td,
		.highcharts-data-table th,
		.highcharts-data-table caption {
		    padding: 0.5em;
		}

		.highcharts-data-table thead tr,
		.highcharts-data-table tr:nth-child(even) {
		    background: #f8f8f8;
		}

		.highcharts-data-table tr:hover {
		    background: #f1f7ff;
		}

	</style>
</head>
<body>
<?php 
// require '../menu.php';
require '../connect.php';
// $arrX = array_keys($arr);
// $arrY = array_values($arr);
// echo json_encode($arr);
// exit();
?>
<h1>Đây là giao diện admin</h1>
<figure class="highcharts-figure">
    <div id="container"></div>
    <p class="highcharts-description">
        Basic line chart showing trends in a dataset. This chart includes the
        <code>series-label</code> module, which adds a label to each line for
        enhanced readability.
    </p>
</figure>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$.ajax({
			url: 'get_doanh_thu.php',
			type: 'GET',
			dataType: 'json',
			data: {days: 30},
		})
		.done(function(response) {
			const arrX = Object.keys(response);
			const arrY = Object.values(response);
			Highcharts.chart('container', {

			    title: {
			        text: 'Thống kê doanh thu 30 ngày gần nhất',
			        align: 'left'
			    },

			    yAxis: {
			        title: {
			            text: 'Doanh thu'
			        }
			    },

			    xAxis: {
			        categories: arrX
			    },

			    legend: {
			        layout: 'vertical',
			        align: 'right',
			        verticalAlign: 'middle'
			    },

			    plotOptions: {
			        series: {
			            label: {
			                connectorAllowed: false
			            },
			        }
			    },

			    series: [{
			        name: 'Doanh thu',
			        data:  arrY
			    }],

			    responsive: {
			        rules: [{
			            condition: {
			                maxWidth: 500
			            },
			            chartOptions: {
			                legend: {
			                    layout: 'horizontal',
			                    align: 'center',
			                    verticalAlign: 'bottom'
			                }
			            }
			        }]
			    }

			});
		})
	});
	
</script>
</body>
</html>