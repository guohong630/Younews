<?php	
	//require connection.php before verifying! and should start session first!
	$url="login.php";
	$js="<script language='javascript' type='text/javascript'>alert('Login First!');window.location.href='$url';</script>";
	if(!isset($_SESSION['username']) || !isset($_SESSION['password'])){
		oci_close($conn);
		echo $js;
	}

	$user=$_SESSION['username'];
	$passwd=$_SESSION['password'];

	$stmt=oci_parse($conn,"select user_name from users where user_name= '$user' and password='$passwd'");
	oci_execute($stmt, OCI_DEFAULT);
	oci_fetch_all($stmt,$res);
	$c=count($res["USER_NAME"]);
	if($c<=0){
		oci_close($conn);
		echo $js;
	}
?>