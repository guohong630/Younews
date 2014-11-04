
<?php
	session_start();
?>
<h3> Stock Media Platform </h3>
<form name="input" action="login_handle.php" method="post">
Username: <input type="text" name="user"><br>
Password: <input type="password" name="password"><br>
<input type="submit" value="Login">
</form>
<br>
Want an account?
<br>
<button type="button" onclick= "self.location='signup.php'" >Register</button>