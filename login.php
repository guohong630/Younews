<!DOCTYPE html>

<?php
	session_start();
?>
<html>
<head>
<style>
#header {
    background-color:black;
    color:white;
    text-align:center;
    padding:5px;
}
#nav {
    line-height:30px;
    background-color:#eeeeee;
    height:500px;
    width:150px;
    float:left;
    padding:5px;	      
}
#section {
    width:750px;
    float:left;
    padding:10px;	 	 
}
#footer {
    background-color:black;
    color:white;
    clear:both;
    text-align:center;
   padding:5px;	 	 
}
</style>
</head>

<body>

<div id="header">
<h1>Stock Media Platform</h1>
</div>

<div id="nav">
	<form name="input" action="login_handle.php" method="post">
		Username: <input type="text" name="user"><br>
		Password: <input type="password" name="password"><br>
		<input type="submit" value="Login">
	</form>
	<br>Want an account?<br>
	<button type="button" onclick= "self.location='signup.php'" >Register</button>
</div>

<div id="section">
<h2>Welcome, My Friend!</h2>
<p>
	<img src="/db/image/login.jpg" alt="Stock Login" style="width:500px">
</p>

</div>

<div id="footer">
Copyright @ Siyao Li, Hong Guo
</div>

</body>
</html>