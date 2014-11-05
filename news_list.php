<h3> Stock Media Platform </h3>
<h4> Location: <a href="welcome.php">Welcome</a> > Personal News <h4>
<?php
	session_start();
	require_once("connection.php");
	require_once("verify.php");
	$userid=$_GET['userid'];
	$sql="SELECT distinct(NEWS.NEWS_ID), NEWS.TOPIC, KEYWORDS FROM SELECT_STOCK, STOCKS_ISSUE, COMPANIES, NEWS WHERE SELECT_STOCK.USER_ID=$userid AND SELECT_STOCK.STOCK_ID=STOCKS_ISSUE.STOCK_ID AND STOCKS_ISSUE.COMPANY_ID=COMPANIES.COMPANY_ID AND LOWER(NEWS.KEYWORDS) LIKE '%'||LOWER(COMPANIES.COM_NAME)||'%'";
	$stm=oci_parse($conn, $sql);
	oci_execute($stm,OCI_DEFAULT);
	while($row=oci_fetch_row($stm)){
		$newsid=$row[0];
		$disp=$row[1];
		$kw=$row[2];
		echo "<a href=\"news.php?newsid=$newsid&userid=$userid\">$disp</a><br>(Keywords:$kw)<br>";
	}
	oci_close($conn);
?>

<h3>Click <a href="welcome.php">here</a> to go back.</h3>
