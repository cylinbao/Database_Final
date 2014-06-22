<!DOCTYPE html>
<style type="text/css">
	@import url("style.css");
</style>
<html>
<head>
	<title>Database FP | Logout</title>
</head>
<body>
<h3>Household Registration System</br>Logout Page</h3>
<div id="mainform">
<?php
session_start();

if(isset($_SESSION['sus'])){
	session_destroy();
	echo "<h2>GOODBYE!</h2>";
	//echo "<a href=index.php>Login Page</a>";
}
else{
	session_destroy();
	echo "<h2>You haven't login yet. Please login first</h2>";
	//echo "<a href=index.php>Login Page</a>";
}
?>
<p><input type="button" value="Login Page" style="float: left;"
onclick="self.location.href='index.php'"><br/>
</div>
</body>
</html>
