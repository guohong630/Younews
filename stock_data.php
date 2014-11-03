<!DOCTYPE HTML>

<?php
	session_start();
	require_once("connection.php");
	require_once("verify.php");
	$stockid = $_GET['stockid'];
	echo "This page gets stockid=$stockid and need to print stock data in this page";

	$sql="select price, date_to_unix_ts(stock_date) as ST from has_stock_data where stock_id=$stockid";
	$stm=oci_parse($conn,$sql);
	oci_execute($stm,OCI_DEFAULT);
	oci_fetch_all($stm,$res);

	$data=array();
	$n=count($res['PRICE']);
	for($i=0;$i<$n;$i++){
		$a=array(intval($res['ST'][$i]),floatval($res['PRICE'][$i]));
		array_push($data,$a);
	}
	$dataJ = json_encode($data);

	oci_close($conn);
?>

<html>
<h1>H</h1?
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Highstock Example</title>

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<style type="text/css">
${demo.css}
		</style>
		<script type="text/javascript">
$(function () {
        console.log(jQuery.parseJSON("<?php echo $dataJ ?>"));
        // Create the chart
        $('#container').highcharts('StockChart', {


            rangeSelector : {
                selected : 1,
                inputEnabled: $('#container').width() > 480
            },

            title : {
                text : 'AAPL Stock Price'
            },

            series : [{
                name : 'AAPL',
                data : jQuery.parseJSON("<?php echo $dataJ ?>"),
                tooltip: {
                    valueDecimals: 2
                }
            }]
        });
});

		</script>
	</head>
	<body>
<script src="./js/highstock.js"></script>
<script src="./js/modules/exporting.js"></script>

<div id="container" style="height: 400px; min-width: 310px"></div>
	</body>
</html>