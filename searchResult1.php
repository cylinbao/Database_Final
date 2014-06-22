<!DOCTYPE hml>
<style tpye="text/css">
	@import url("style.css");
</style>
<html>
<head>
	<title>Database FP | Search Result</title>
</head>
<body>
<h3>Household Registration System</br>Search Result</h3>
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
		$uid = $_GET['searchUid'];
		$hid = $_GET['searchHid'];
		$sex = $_GET['searchSex'];
		$age1 = $_GET['startAge'];
		$age2 = $_GET['endAge'];
		$cityHid = $_GET['searchCity'];

		if($uid != "") {
			$sql = "SELECT * FROM personal_info WHERE uid='".$uid."'";
			$result = mysqli_query($con,$sql);
			$num = mysqli_num_rows($result);

			if($num > 0){
				$row = mysqli_fetch_array($result);
				$name = $row['name'];
				$sex = $row['sex'];
				$birthday = $row['birthday'];
				$hid = $row['hid'];

				echo "<span style=\"font-size:25px;\">".$name."</span><br/>";
				echo "Uid: ".$uid."<br/>";
				echo "Hid: ".$hid."<br/>";
				echo "Sex: ".$sex."<br/>";
				echo "Birthday: ".$birthday."<br/>";

				$sql2 = "SELECT * FROM users WHERE uid='".$uid."'";
				$result2 = mysqli_query($con,$sql2);
				$num2 = mysqli_num_rows($result2);
				if($num2 > 0){
					$row2 = mysqli_fetch_array($result2);
					echo "Email: ".$row2['email']."<br/>";
				}
			}
		}
		else if($hid != "") {
			$sql = "SELECT * FROM household WHERE hid='".$hid."'";                      
			$result = mysqli_query($con,$sql);                                          
			$num = mysqli_num_rows($result);                                            

			if($num > 0) {                                                              
				$row = mysqli_fetch_array($result);                                       
				$address = $row['address'];                                               
				$size = $row['size'];                                                     
				$city = $row['city'];                                                     

				echo "<span style=\"font-size:25px;\">
							Household Information</span><br/>"; 
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
					echo "<br/>".$row2['name']."                                    
						<a href=userinfo.php?uid=".$row2['uid'].">                 
						User_Info</a>";                                            
				}
			}
		}
		else if($sex != "") {
			$sql = "SELECT * FROM personal_info WHERE sex='".$sex."'";
			$result = mysqli_query($con,$sql); 
			$num = mysqli_num_rows($result);                                        
			for($i=0;$i<$num;$i++){                                                  
				$row = mysqli_fetch_array($result);
				$uid = $row['uid'];
				$name = $row['name'];
				$sex = $row['sex'];
				$birthday = $row['birthday'];
				$hid = $row['hid'];

				echo "<span style=\"font-size:25px;\">".$name."</span><br/>";
				echo "Uid: ".$uid."<br/>";
				echo "Hid: ".$hid."<br/>";
				echo "Sex: ".$sex."<br/>";
				echo "Birthday: ".$birthday."<br/>";

				$sql2 = "SELECT * FROM users WHERE uid='".$uid."'";
				$result2 = mysqli_query($con,$sql2);
				$num2 = mysqli_num_rows($result2);
				if($num2 > 0){
					$row2 = mysqli_fetch_array($result2);
					echo "Email: ".$row2['email'];
				}
				if($i != $num-1)
					echo "<p>";
			}
		}
		else if($age1 != "" && $age2 != "") {
			$nowY = date("Y");
			$staY = $nowY - $age2;
			$endY = $nowY - $age1;
			$time1 = date("Y-m-d H-i-s", mktime(0, 0, 0, 0, 0, $staY));
			$time2 = date("Y-m-d H-i-s", mktime(0, 0, 0, 0, 0, $endY));
			
			//echo $time1."<br/>".$time2;
			$sql = "SELECT * FROM personal_info WHERE birthday >= '".$time1."' AND
							birthday <= '".$time2."'";
			$result = mysqli_query($con,$sql); 
			$num = mysqli_num_rows($result);                                        
			if($num > 0) {
				for($i=0;$i<$num;$i++){                                                  
					$row = mysqli_fetch_array($result);
					$uid = $row['uid'];
					$name = $row['name'];
					$sex = $row['sex'];
					$birthday = $row['birthday'];
					$hid = $row['hid'];

					echo "<span style=\"font-size:25px;\">".$name."</span><br/>";
					echo "Uid: ".$uid."<br/>";
					echo "Hid: ".$hid."<br/>";
					echo "Sex: ".$sex."<br/>";
					echo "Birthday: ".$birthday;

					if($i != $num-1)
						echo "<p>";
				}
			}
			else
				echo "<span style=\"font-size:25px;\">No Proper Result!</span><br/>";
		}
		else if($cityHid != "") {
			$sql = "SELECT * FROM personal_info WHERE hid='".$cityHid."'";
			$result = mysqli_query($con,$sql); 
			$num = mysqli_num_rows($result);                                        
			for($i=0;$i<$num;$i++){                                                  
				$row = mysqli_fetch_array($result);
				$uid = $row['uid'];
				$name = $row['name'];
				$sex = $row['sex'];
				$birthday = $row['birthday'];
				$hid = $row['hid'];

				echo "<span style=\"font-size:25px;\">".$name."</span><br/>";
				echo "Uid: ".$uid."<br/>";
				echo "Hid: ".$hid."<br/>";
				echo "Sex: ".$sex."<br/>";
				echo "Birthday: ".$birthday."<br/>";

				$sql2 = "SELECT * FROM users WHERE uid='".$uid."'";
				$result2 = mysqli_query($con,$sql2);
				$num2 = mysqli_num_rows($result2);
				if($num2 > 0){
					$row2 = mysqli_fetch_array($result2);
					echo "Email: ".$row2['email']."<br/>";
				}

				$sql3 = "SELECT * FROM household WHERE hid='".$hid."'";
				$result3 = mysqli_query($con,$sql3);
				$num3 = mysqli_num_rows($result3);
				if($num3 > 0){
					$row3 = mysqli_fetch_array($result3);
					echo "Address: ".$row3['city']." ".$row3['address'];
				}
				if($i != $num-1)
					echo "<p>";
			}
		}

		//echo "<p>";
		//echo "<br/>";
		//echo "<input type=\"button\" value=\"Main Page\" style=
			//\"float: left;\" onclick=\"self.location.href='main.php'\">";
		//echo "<br/>";
	}
}
?>
</div>
<div id=button>                                                                 
  <input type="button" value="Main" style="float:center;width:60px;             
   height:25px;font-size:15px;background-color:B3B3BC;border:1px #E0E0EB        
   double"                                                                      
  onclick="self.location.href='main.php'">                                      
</div>
</body>
</html>
