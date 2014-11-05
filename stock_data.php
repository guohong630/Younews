<!DOCTYPE HTML>

<?php
	session_start();
	require_once("connection.php");
	require_once("verify.php");
	$stockid = $_GET['stockid'];
	$stockname=$_GET['stockname'];

	$sql="select price, date_to_unix_ts(stock_date) as ST from has_stock_data where stock_id=$stockid order by stock_date";
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
                text : "<?php echo $stockname ?>"+" Stock Price"
            },

            series : [{
                name : "<?php echo $stockname ?>",
                data : jQuery.parseJSON("<?php echo $dataJ ?>"),
                tooltip: {
                    valueDecimals: 2
                }
            }]
        });
});

		</script>
		<style>
			#header {
			    background-color:black;
			    color:white;
			    text-align:center;
			    padding:5px;
			}
			#footer {
			    background-color:black;
			    color:white;
			    clear:both;
			    text-align:center;
			   padding:5px;	 	 
			}
		</style>
	</head>
	<body>
		<div id="header">
		<h1>Stock Media Platform</h1>
		</div>
		<h4> Location: <a href="welcome.php">Welcome</a> > <?php echo $stockname ?> Stock Data <h4>
<script src="./js/highstock.js"></script>
<script src="./js/modules/exporting.js"></script>

<div id="container" style="height: 400px; min-width: 310px"></div>
<br><br>
<div id="footer">
Copyright @ Siyao Li, Hong Guo
</div>
	</body>
</html>