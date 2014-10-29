<?php
	session_start();
	require_once("verify.php");
	$user=$_SESSION['username'];
	print "This is the main page for user:$user!<br>";
?>