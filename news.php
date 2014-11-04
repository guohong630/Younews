<?php
	session_start();
	require_once("connection.php");
	require_once("verify.php");
	$newsid=$_GET['newsid'];
	$sql="select * from news where news_id=$newsid";
	$stm=oci_parse($conn,$sql);
	oci_execute($stm,OCI_DEFAULT);
	oci_fetch_all($stm,$res);
	$topic=$res['TOPIC'][0];
	$source=$res['NEWS_SOURCE'][0];
	$kw=$res['KEYWORDS'][0];
	$date=$res['NEWS_DATE'][0];
	$txt=$res['NEWS_CONTENT'][0];
	$url=$res['URL'][0];
	oci_close($conn);
?>

<h2><?php echo $topic?></h2>
<h4>  <?php echo "Source: <a href=$url>$source</a>"?></h4>
<h4><?php echo "Keywords: $kw"?></h4>
<h5><?php echo "Date: $date"?></h5>
<br>
<?php echo $txt
?>

<h3>Click <a href="welcome.php">here</a> to go back.</h3>
