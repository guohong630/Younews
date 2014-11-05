<!DOCTYPE html>
<?php
	session_start();
	require_once("connection.php");
	require_once("verify.php");
	$user=$_SESSION['username'];
	$userid=$_GET['userid'];
	$sql="SELECT distinct(NEWS.NEWS_ID), NEWS.TOPIC, KEYWORDS FROM SELECT_STOCK, STOCKS_ISSUE, COMPANIES, NEWS WHERE SELECT_STOCK.USER_ID=$userid AND SELECT_STOCK.STOCK_ID=STOCKS_ISSUE.STOCK_ID AND STOCKS_ISSUE.COMPANY_ID=COMPANIES.COMPANY_ID AND LOWER(NEWS.KEYWORDS) LIKE '%'||LOWER(COMPANIES.COM_NAME)||'%'";
	$stm=oci_parse($conn, $sql);
	oci_execute($stm,OCI_DEFAULT);
	//while($row=oci_fetch_row($stm)){
	//	$newsid=$row[0];
	//	$disp=$row[1];
	//	$kw=$row[2];
	//	echo "<a href=\"news.php?newsid=$newsid&userid=$userid\">$disp</a><br>(Keywords:$kw)<br>";
	//}
?>

<html>
<head>
<style>
#header {
    background-color:black;
    color:white;
    text-align:center;
    padding:5px;
}
#nav {
    line-height:30px;
    background-color:#eeeeee;
    height:500px;
    width:150px;
    float:left;
    padding:5px;	      
}
#section {
    width:750px;
    float:left;
    padding:10px;	 	 
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

<div id="nav">
	<br><a href="select_stock.php?userid=<?php echo $userid ?>">Select Stocks</a><br>
	<br><a href="preference.php?userid=<?php echo $userid ?>">Push Preference</a><br>
	<br><a href="logout.php">Logout</a><br>
</div>

<div id="section">
<h2>
	<?php
		echo  "<p class = 'text'>Welcome! $user! </p>"
	?>
</h2>
<p>
	<h4> Location: <a href="welcome.php">Welcome</a> > Personal News <h4>
	<?php 
		while($row=oci_fetch_row($stm)){
			$newsid=$row[0];
			$disp=$row[1];
			$kw=$row[2];
			echo "<a href=\"news.php?newsid=$newsid&userid=$userid\">$disp</a><br>(Keywords:$kw)<br>";
		}
	?>
</p>

</div>

<div id="footer">
Copyright @ Siyao Li, Hong Guo
</div>

</body>
</html>

<? php
	oci_close($conn);
?>
