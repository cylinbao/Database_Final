<!DOCTYPE hml>
<style tpye="text/css">
	@import url("style.css");
</style>
<html>
<head>
	<title>Database FP | UserInfo</title>
</head>
<body>
<h3>Household Registration System</br>User Profile</h3>
<div id="mainform">
<?php
session_start();

if(!isset($_SESSION['sus'])){
	echo "You haven't login yet. Please login first!<br/>";
	echo "<a href=index.php>Login Page</a>";
}
else{
	require 'PASS.php';

	$con = mysqli_connect($host,$dbname,$dbpasswd,$database);

	if( mysqli_connect_errno($con)){
    	echo "Fail to connect to Mysql<br/>".mysqli_connect_error()."<br/>";
	}else{
		$uid = $_GET['uid'];

		if($uid == "")
			$uid = $_GET['searchUid'];
			
		if($uid == "")
			$uid = $_SESSION['uid'];

		$sql = "SELECT * FROM personal_info WHERE uid='".$uid."'";
		$result = mysqli_query($con,$sql);
		$num = mysqli_num_rows($result);

		if($num > 0){
			$row = mysqli_fetch_array($result);
			$name = $row['name'];
			$sex = $row['sex'];
			$birthday = $row['birthday'];
			$hid = $row['hid'];

			echo "Name: ".$name."<br/>";
			echo "Sex: ".$sex."<br/>";
			echo "Birthday: ".$birthday."<br/>";

			$sql2 = "SELECT * FROM users WHERE uid='".$uid."'";
			$result2 = mysqli_query($con,$sql2);
			$num2 = mysqli_num_rows($result2);
			if($num2 > 0){
				$row2 = mysqli_fetch_array($result2);
				echo "Email: ".$row2['email']."<br/>";
			}

			echo "<p>";
			echo "<input type=\"button\" value=\"Household Info\" style=
			      \"float: left;\" onclick=\"self.location.href=
						'householdinfo.php?hid=".$hid."'\">";
			echo "<br/>";
			echo "<input type=\"button\" value=\"Main Page\" style=
			      \"float: left;\" onclick=\"self.location.href='main.php'\">";
			echo "<br/>";
		}
	}
}
?>
</div>
</body>
</html>
