<!DOCTYPE html>

<?php
	session_start();
	require_once('connection.php');
	require_once('verify.php');//require connection.php before verifying! and should start session first!
	$user=$_SESSION['username'];
	$passwd=$_SESSION['password'];

	//echo  "<p class = 'text'>Welcome! $user! (<a href=\"logout.php\">Logout</a>)</p><br>";
	$sql_user = oci_parse($conn, "select user_id from users where user_name='$user'");
	oci_execute($sql_user,OCI_DEFAULT);
	oci_fetch_all($sql_user,$res);
	$userid = $res['USER_ID'][0];

	if(isset($_GET['rm'])){
		if($_GET['rm']==1){
			$stkid=$_GET['stockid'];
			$del_sql="delete from select_stock where user_id=$userid and stock_id=$stkid";
			$stm=oci_parse($conn, $del_sql);
			oci_execute($stm);
			oci_commit($conn);
		}
	}
	//echo "<a href=\"news_list.php?userid=$userid\">Check your personal news!<br>";
	$sql = oci_parse($conn, "select si.stock_id, si.stock_name, c.com_name from users u, select_stock ss, stocks_issue si,companies c where u.user_name='$user' and u.user_id=ss.user_id and ss.stock_id=si.stock_id and si.company_id=c.company_id");
	oci_execute($sql,OCI_DEFAULT);
	//while($row=oci_fetch_row($sql)){
	//	$stockid=$row[0];
	//	$com=$row[2];
	//	$disp = $row[2] ." (". $row[1].")";
	//	echo "<a href=\"stock_data.php?stockid=$stockid&stockname=$com\">$disp</a><br>";
	//}
	//echo "<a href=\"select_stock.php?userid=$userid\">Select stocks</a><br>";
    //echo "<a href=\"preference.php?userid=$userid\">Change your pushing preference</a><br>";
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
		echo  "<p class = 'text'>Welcome! $user! (<a href=\"news_list.php?userid=$userid\">Check your personal news</a>)</p>"
	?>
</h2>
<p>
	<h3>Your stocks, click to see history data:<br></h3>
	<?php
	while($row=oci_fetch_row($sql)){
		$stockid=$row[0];
		$com=$row[2];
		$disp = $row[2] ." (". $row[1].")";
		echo "<a href=\"stock_data.php?stockid=$stockid&stockname=$com\">$disp</a>    (<a href=\"welcome.php?rm=1&stockid=$stockid\">x</a>)<br>";
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





