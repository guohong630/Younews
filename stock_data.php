<?php
	session_start();
	require_once("connection.php");
	require_once("verify.php");
	$stockid = $_GET['stockid'];
	echo "This page gets stockid=$stockid and need to print stock data in this page";
?>