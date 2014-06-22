<!DOCTYPE html>
<style type="text/css">
	@import url("style.css");
</style>
<html>
<head>
	<title>Database FP | Statistics</title>
</head>
<body>
<h3>Household Registration System</br>Statistics Page</h3> 
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
		// sex ratio
		$sql = "SELECT * FROM personal_info WHERE sex = 'M'";
		$result = mysqli_query($con, $sql);
		$numM = mysqli_num_rows($result);

		$sql2 = "SELECT * FROM personal_info WHERE sex = 'F'";
		$result2 = mysqli_query($con, $sql2);
		$numF = mysqli_num_rows($result2);

		$totP = $numM + $numF;
		$ratM = ($numM / $totP) * 100;
		$ratF = ($numF / $totP) * 100;

		$ratM = number_format($ratM, 2);
		$ratF = number_format($ratF, 2);

		echo "<span style=\"font-size:25px;\">Sex Ratio</span><br/>";
		echo "Male: ".$ratM."%<br/>";
		echo "Female: ".$ratF."%<br/>";

		// population structure
		$nowY = date("Y");
		$smallY = $nowY - 14;
		$bigY = $nowY - 64;

		$time1 = date("Y-m-d H-i-s", mktime(0, 0, 0, 0, 0, $smallY));
		$time2 = date("Y-m-d H-i-s", mktime(0, 0, 0, 0, 0, $bigY));

		$sql = "SELECT * FROM personal_info WHERE birthday >='".$time1."'";
		$result = mysqli_query($con, $sql);
		$numY = mysqli_num_rows($result);

		$sql2 = "SELECT * FROM personal_info WHERE birthday <'".$time1."' AND 
							birthday >= '".$time2."'";
		$result2 = mysqli_query($con, $sql2);
		$numM = mysqli_num_rows($result2);

		$sql3 = "SELECT * FROM personal_info WHERE birthday <'".$time2."'";
		$result3 = mysqli_query($con, $sql3);
		$numO = mysqli_num_rows($result3);

		$ratY = ($numY / $totP) * 100;
		$ratY = number_format($ratY, 2);
		$ratM = ($numM / $totP) * 100;
		$ratM = number_format($ratM, 2);
		$ratO = ($numO / $totP) * 100;
		$ratO = number_format($ratO, 2);

		echo "<p>";
		echo "<span style=\"font-size:25px;\">Population Structure</span><br/>";
		echo "Age 0 ~ 14: ".$ratY."%<br/>";
		echo "Age 15 ~ 64: ".$ratM."%<br/>";
		echo "Age 65 ~ : ".$ratO."%<br/>";

		// region population
		echo "<p>";
		echo "<span style=\"font-size:25px;\">Population in each City</span><br/>";
		
		$sql = "SELECT * FROM household";
		$result = mysqli_query($con, $sql);
		$num = mysqli_num_rows($result);
		for($i = 0; $i < $num; $i++) {
			$row = mysqli_fetch_array($result);
			$hid = $row['hid'];
			$city = $row['city'];

			$sql2 = "SELECT * FROM personal_info WHERE hid = '".$hid."'";
			$result2 = mysqli_query($con, $sql2);
			$numR = mysqli_num_rows($result2);
			
			$ratR = ($numR / $totP) * 100;
			$ratR = number_format($ratR, 2);
				
			echo $city.": ".$ratR."%<br/>";
		}
	}
}
?>
</div>
<div id=button>                                                                 
<input type="button" value="Main" style="float:center;width:60px;               
 height:25px;font-size:15px;background-color:B3B3BC;border:1px #E0E0EB          
 double" onclick="self.location.href='main.php'"/>                              
</div>
</body>
</html>
