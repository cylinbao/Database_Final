<!DOCTYPE html>
<style type="text/css">
	@import url("style.css");
</style>
<html>
<head>
	<title>Database FP</title>
</head>
<?php 
session_start();

if(isset($_SESSION['sus']))
{
	header("Location:main.php");
}
if(isset($_POST['login']))
{
	$_SESSION['username'] = $_POST['user'];
	$_SESSION['pass'] = $_POST['pw'];
	header("Location:main.php");
}
?>
<body>
<!--
<font face="Arial" size="6">Household Registration System</font>
-->
<h3>Household Registration System</br>Login Page</h3>
<div id="loginform">
<form method="post">
		Account:
		<div id="logininput">
		<input type="text" name="user" />
		</div><br/>
		Password:
		<div id="logininput">
		<input type="password" name="pw" />
		</div>
		<br/><p>
		<input value="Login" type="submit" name="login" style="width:60px;
	 	 height:25px;font-size:15px;background-color:B3B3BC;
		 border:1px #E0E0EB double"/><br/>
		<p> New user? <a href="register.php">Register New Account</a>
</form>
</div>
<!--
<div id="loginform">
<form method="post">
		Account:
		<div id="logininput">
		<input type="text" name="user" />
		</div><br/>
		Password:
		<div id="logininput">
		<input type="password" name="pw" />
		</div>
		<br/><p>
		<input value="Login" type="submit" name="login" style="width:60px;
	 	 height:25px;font-size:15px;background-color:B3B3BC;
		 border:1px #E0E0EB double"/><br/>
		<p> New user? <a href="register.php">Register New Account</a>
</form>
</div>
-->
</body>
</html>
