<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Sign Up</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <h3>Sign Up</h3>

<?php 
require_once "connection.php";

   if (isset($_POST['submit'])) {
      // Grab the profile data from the POST
      $username = $_POST['username'];
      $password1 = $_POST['password1'];
      $password2 = $_POST['password2'];
    
      if (!empty($username) && !empty($password1) && !empty($password2) && ($password1 == $password2)) {    
              //insert the data into database
              $query1 = "INSERT INTO USERS (USER_NAME, PASSWORD) VALUES ('$username', '$password1')" ;
              $stid1 = oci_parse($conn, $query1);
              oci_execute($stid1);
              oci_commit($conn);
	    
              //Comfirm success with the user
              echo '<p> Your new account has been successfully created. You\'re now ready to <a href="login.php">log in</a>.</p>>';

              oci_close($conn);
	      exit();
      }
      else {
      echo '<p>You must enter all of the sign-up data, including the desired password twice.</p>';
      }
   }

   

?>


<p>Please enter your username and desired password to sign up to our application.</p>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <fieldset>
      <legend>Registration Info</legend>
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" value="<?php if (!empty($username)) echo $username; ?>" /><br />
      <label for="password1">Password:</label>
      <input type="password" id="password1" name="password1" /><br />
      <label for="password2">Password (retype):</label>
      <input type="password" id="password2" name="password2" /><br />
    </fieldset>
    <input type="submit" value="Sign Up" name="submit" />
  </form>
</body> 
</html>
