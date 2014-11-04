
<?php 

        session_start();
	require_once("connection.php");
	require_once("verify.php");
	$userid=$_GET['userid'];
	if (isset($_POST['submit'])) {
        $period = $_POST['period'];
	$prefer = $_POST['prefer'];

	$query = "INSERT INTO USERS (PUSH_PERIOD, PUSH_VIA_EMAIL) VALUES('$period', '$prefer')";
	$stid = oci_parse($conn, $query);
              oci_execute($stid);
              oci_commit($conn);
              //Comfirm success with the user
              echo '<p class="text">Successfully changed your preference. Click <a href="welcome.php">here</a> to go back.</p>>';

              oci_close($conn);
	      exit();
	}

print <<<_HTML_
<html>
  <h3>Choose your personized pusing service!</h3>

        <form method="post" action="preference.php?userid=$userid">
       <input name="prefer" type="radio" value="0" />Don't send me email<br>
       <input name="prefer" type="radio" value="1" />via email<br>
       <label for="phone">Pushing Period</label>
       <input type="number" id="period" name="period" /><br />
       <input type="submit" name="submit" value=Submit>
	</form>
<html>
_HTML_

?>




