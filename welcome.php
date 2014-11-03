<?php
	session_start();
	require_once('connection.php');
	require_once('verify.php');//require connection.php before verifying! and should start session first!
	$user=$_SESSION['username'];
	$passwd=$_SESSION['password'];
	print "Welcom! $user!<br>";
	$sql_user = oci_parse($conn, "select user_id from users where user_name='$user'");
	oci_execute($sql_user,OCI_DEFAULT);
	oci_fetch_all($sql_user,$res);
	$userid = $res['USER_ID'][0];
	echo "<a href=\"news_list.php?userid=$userid\">Check your personal news!<br>";
	$sql = oci_parse($conn, "select si.stock_id, si.stock_name, c.com_name from users u, select_stock ss, stocks_issue si,companies c where u.user_name='$user' and u.user_id=ss.user_id and ss.stock_id=si.stock_id and si.company_id=c.company_id");
	oci_execute($sql,OCI_DEFAULT);
	while($row=oci_fetch_row($sql)){
		$stockid=$row[0];
		$disp = $row[2] ." (". $row[1].")";
		echo "<a href=\"stock_data.php?stockid=$stockid\">$disp</a><br>";
	}
	oci_close($conn);
?>