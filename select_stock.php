<h3> Stock Media Platform </h3>
<h4> Location: <a href="welcome.php">Welcome</a> > Select Stock <h4>


<?php

	session_start();
	require_once("connection.php");
	require_once("verify.php");
	$userid=$_GET['userid'];
	if (isset($_POST['submit'])) {
		foreach ($_POST['stocks'] as $stock_id)
		{ 
			$query1 = "SELECT * FROM SELECT_STOCK WHERE USER_ID = $userid AND STOCK_ID = $stock_id";
	        $stid = oci_parse($conn, $query1);
			oci_execute($stid);
			$numrows = oci_fetch_all($stid, $res);
            if ($numrows==0) {
	           	$query = "INSERT INTO SELECT_STOCK (USER_ID, STOCK_ID) VALUES ($userid, $stock_id)";
	           	$stid1 = oci_parse($conn, $query);
		        oci_execute($stid1);
		        oci_commit($conn);
			}
	    }
	    echo 'The stock have successfully added to your interest list! Click <a href="welcome.php">here</a> to go back.';
	    oci_close($conn);
		exit();
	} 

print <<<_HTML_
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>	

	<h3>Please select the stocks that you are interested in (use 'Ctrl' for multiple choice)</h3>

        <body>
                <form method="post" action="select_stock.php?userid=$userid">
                        <select name="stocks[ ]" multiple>
                                <option value="1">YHOO</option>
                                <option value="2">GOOGL</option>
                                <option value="3">FB</option>
                                <option value="4">JNJ</option>
                                <option value="5">BABA</option>
								<option value="6">AAPL</option>
								<option value="7">NVS</option>
								<option value="8">GS</option>
								<option value="9">MS</option>
                                <option value="10">GE</option>
                        </select>
                        <input type="submit" name="submit" value=Submit>
                </form>
        </body>
</html>
_HTML_

?>



