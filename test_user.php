<?php
	ini_set('display_errors', 'On');
	$db = "w4111g.cs.columbia.edu:1521/adb";
	$conn = oci_connect("sl3766", "abcde", $db);
	$stmt = oci_parse($conn, "select user_name from users");
	oci_execute($stmt, OCI_DEFAULT);
	while ($res = oci_fetch_row($stmt))
	{
		echo "User Name: ". $res[0]."<br>";
	}
	oci_close($conn);
?>
