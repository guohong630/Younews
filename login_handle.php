<?php
	require_once('login.php');
	require_once('connection.php');
	$user = $_POST["user"];
	$passwd = $_POST["password"];
	$stmt=oci_parse($conn,"select user_name from users where user_name= '$user' and password='$passwd'");
	oci_execute($stmt, OCI_DEFAULT);

	oci_fetch_all($stmt,$res);
	$url="welcome.php";
	$c=count($res["USER_NAME"]);

	if($c>0){
		$_SESSION['username']=$user;
		$_SESSION['password']=$passwd;
		echo "<script language='javascript' type='text/javascript'>";  
		echo "alert('Login Success!');window.location.href='$url';";  
		echo "</script>";  
	}
	else{
		echo "Wrong username/password!<br>";
	}
	oci_close($conn);
?>