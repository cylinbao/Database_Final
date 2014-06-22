<!DOCTYPE html>
<style type="text/css">
	@import url("style.css");
</style>
<html>
<head>
	<title>Database FP | Household_Info</title>
</head>
<body>
<h3>Household Registration System</br>Household Information</h3> 
<div id="mainform">
<?php
session_start();

if(!isset($_SESSION['sus'])){
	echo "You haven't login yet. Please login first!<br/>";
	echo "<a href=index.php>Login Page</a>";
}
else{
	$host = "localhost";
	$dbname = "dbuser";
	$dbpasswd = "dbuser";
	$database = "db_pj2";

	$con = mysqli_connect($host,$dbname,$dbpasswd,$database);

	if( mysqli_connect_errno($con)){
    	echo "Fail to connect to Mysql<br/>".mysqli_connect_error()."<br/>";
	}else{
		$hid = $_GET['hid'];

		if($hid == "")
			$hid = $_GET['searchHid'];

		if($hid == "")
			$hid = $_SESSION['hid'];

		$sql = "SELECT * FROM household WHERE hid='".$hid."'";
		$result = mysqli_query($con,$sql);
		$num = mysqli_num_rows($result);

		if($num > 0) {
			$row = mysqli_fetch_array($result);
			$address = $row['address'];
			$size = $row['size'];
			$city = $row['city'];

			echo "<span style=\"font-size:25px;\">Household Information</span><br/>";
			echo "Household ID: ".$hid."<br/>";
			echo "Address: ".$address."<br/>";
			echo "Size: ".$size."<br/>";
			echo "City: ".$city."<br/>";

			echo "<br/>";
			echo "<span style=\"font-size:25px;\">Household Members</span>";
			$sql2 = "SELECT * FROM personal_info WHERE hid='".$hid."'";
			$result2 = mysqli_query($con,$sql2);
			$num2 = mysqli_num_rows($result2);
			for($i=0;$i<$num2;$i++){
				$row2 = mysqli_fetch_array($result2);
				//if($row2['name'] != $_SESSION['name']){
                echo "<br/>".$row2['name']."
                     <a href=userinfo.php?uid=".$row2['uid'].">
                     User_Info</a>";
        //        }
			}
			//echo "<p><a href=main.php>Back to Main Page</a></p>";
		  //echo "<br/><p>"; 
		  //echo "<input type=\"button\" value=\"Main Page\" style=                 
			//       \"float: left;\" onclick=\"self.location.href='main.php'\">";
		  //echo "<br/>"; 
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
