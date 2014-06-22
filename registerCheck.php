<!DOCTYPE html>                                                                 
<style type="text/css">                                                         
  @import url("style.css");                                                     
</style>                                                                        
<html>                                                                          
<head>                                                                          
  <title>Database FP | Register</title>                                       
</head>                                                                         
<body>
<h3>Household Registration System</br>Register Page</h3>
<?php
session_start();                                                                
if(isset($_SESSION['sus']))                                                     
{                                                                               
  header("Location:main.php");                                                  
}
$regUsername = $_POST['regisUsername'];
$regPasswd = $_POST['regisPasswd'];
$regEmail = $_POST['regisEmail'];
$regName = $_POST['regisName'];
$regSex = $_POST['regisSex'];
$regBirthday = $_POST['regisBirthday'];
$regHid = $_POST['regisHid'];
//echo $regUsername;echo "<br/>";echo $regPasswd;echo "<br/>";
//echo $regEmail;echo "<br/>";echo $regName;echo "<br/>";
//echo $regSex;echo "<br/>";echo $regBirthday;echo "<br/>";echo $regHid;

$realPasswd = md5($regPasswd);
require 'PASS.php';
$con = mysqli_connect($host,$dbname,$dbpasswd,$database);
if( mysqli_connect_errno($con)){                                          
	echo "Fail to connect to Mysql<br/>".mysqli_connect_error()."<br/>";    
} else{                                                                   
	$sql = "SELECT * FROM users WHERE username='".$regUsername."'";
	$result = mysqli_query($con,$sql);
	$num = mysqli_num_rows($result);
	if($num > 0){
		echo "<div id=\"mainform\">";
		echo "<h2>Account already exist, Please Login directly!</h2><br/>";
		echo "<a href='index.php'>Login Page</a>";
		echo "</div>";
	} else {
		$sql = "SELECT * FROM users";
		$result = mysqli_query($con,$sql);
		$num = mysqli_num_rows($result);
		$uid = $num + 1;
		if($uid < 10)
			$uid = "0".$uid;
		//echo "<br/>uid=".$uid."<br/>";

		$sql2 = "INSERT INTO users (
						 	username,
						 	password,
						 	uid,
						 	email,
						 	isadmin) 
						 VALUES (
							'".$regUsername."',
							'".$realPasswd."',
							'".$uid."',
							'".$regEmail."',
							'0')";

		$result2 = mysqli_query($con,$sql2);
		if(!$result2){
			echo "something ERROR!<br/>".mysqli_error();
		}

		$sql3 = "INSERT INTO personal_info (
							uid,
							name,
							sex,
							birthday,
							hid,
							modtime) 
						 VALUES (
							'".$uid."',
							'".$regName."',
							'".$regSex."',
							'".$regBirthday."',
							'".$regHid."',
							CURRENT_TIMESTAMP)";
		$result3 = mysqli_query($con,$sql3);
		if(!$result3){
			echo "something ERROR!<br/>".mysqli_error();
		}

		$sql = "SELECT * FROM pmod_history";
		$result = mysqli_query($con,$sql);
		$num = mysqli_num_rows($result);
		$historyid = $num + 1;

		$sql = "SELECT * FROM personal_info WHERE uid='".$uid."'";
		$result = mysqli_query($con,$sql);
		$num = mysqli_num_rows($result);
		if($num>0){
			$row = mysqli_fetch_array($result);
			$modtime = $row['modtime'];
		}

		$sql4 = "INSERT INTO pmod_history (
							historyid,
							uid,
							name,
							sex,
							birthday,
							hid,
							modtime)
						 VALUES (
							'".$historyid."',
							'".$uid."',
							'".$regName."',
							'".$regSex."',
							'".$regBirthday."',
							'".$regHid."',
							'".$modtime."')";
		$result4 = mysqli_query($con,$sql4);
		if(!$result4){
			echo "something ERROR!<br/>".mysqli_error();
		}

		mysql_close($con);
		echo "<div id=\"mainform\">";
		echo "<h2>Register Sucessfully!</h2><br/>";
		echo "<a href='index.php'>Login Page</a>";
		echo "</div>";
	}
} 
?>
</body>
</html>
