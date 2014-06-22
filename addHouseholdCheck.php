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
if(!isset($_SESSION['username'])){                                              
  session_destroy();                                                            
	echo "You haven't login yet. Please Login first!<br/>";                       
	echo "<a href=index.php>Login Page</a>";                
}
else{ 
$address = $_POST['addHouseAddress'];
$size = $_POST['addHouseSize'];
$city = $_POST['addHouseCity'];
$headid = $_POST['addHouseHeadid'];
//echo $regUsername;echo "<br/>";echo $regPasswd;echo "<br/>";
//echo $regEmail;echo "<br/>";echo $regName;echo "<br/>";
//echo $regSex;echo "<br/>";echo $regBirthday;echo "<br/>";echo $regHid;

require 'PASS.php';
$con = mysqli_connect($host,$dbname,$dbpasswd,$database);
if( mysqli_connect_errno($con)){                                          
	echo "Fail to connect to Mysql<br/>".mysqli_connect_error()."<br/>";    
} else{                                                                   
	$sql = "SELECT * FROM household WHERE address='".$address."' AND size='"
				  .$size."' AND city='".$city."'";
	$result = mysqli_query($con,$sql);
	$num = mysqli_num_rows($result);
	if($num > 0){
		echo "<div id=\"mainform\">";
		echo "<h2>Household already exist.</h2><br/>";
		echo "<a href='main.php'>Main Page</a>";
		echo "</div>";
	} else {
		$sql = "SELECT * FROM household";
		$result = mysqli_query($con,$sql);
		$num = mysqli_num_rows($result);
		$hid = $num + 1;
		$hid = "F".$hid;
		//echo "<br/>uid=".$uid."<br/>";

		$sql2 = "INSERT INTO household (
						 	hid,
						 	address,
						 	size,
						 	city,
						 	headid) 
						 VALUES (
							'".$hid."',
							'".$address."',
							'".$size."',
							'".$city."',
							'".$headid."')";

		$result2 = mysqli_query($con,$sql2);
		if(!$result2){
			echo "something ERROR!<br/>".mysqli_error();
		}

		mysql_close($con);
		echo "<div id=\"mainform\">";
		echo "<h2>Register Sucessfully!</h2><br/>";
		echo "<a href='main.php'>Main Page</a>";
		echo "</div>";
	}
} 
}
?>
</body>
</html>
