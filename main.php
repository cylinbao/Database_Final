<!DOCTYPE html>
<style type="text/css">
	@import url("style.css");
</style>
<html>
<head>
	<title>Database FP | Main</title>
</head>
<body>
<h3>Household Registration System</br>Main Page</h3>
<div id="mainform">
<?php
session_start();

if(!isset($_SESSION['username'])){
	session_destroy();	
	echo "You haven't login yet. Please Login first!<br/>";
	echo "<a href=index.php>Login Page</a>";
}
else{
require 'PASS.php';

$con = mysqli_connect($host,$dbname,$dbpasswd,$database);

if( mysqli_connect_errno($con)){
    echo "Fail to connect to Mysql<br/>".mysqli_connect_error()."<br/>";
}
else{
	$name = mysql_real_escape_string($_SESSION['username']);
	$pwd = mysql_real_escape_string($_SESSION['pass']);
	$md5_pw = md5($pwd);

	$sql = "SELECT * FROM users WHERE username='".$name.
		   "'AND password='".$md5_pw."'";
	$result = mysqli_query($con,$sql);
	$num = mysqli_num_rows($result);
	if($num>0){
		$row = mysqli_fetch_array($result);
		$_SESSION['sus'] = true;
		$_SESSION['email'] = $row['email'];
		$_SESSION['uid'] = $row['uid'];
		$admin = $row['isadmin'];
		$nowUid = $row['uid'];

		$sql2 = "SELECT * FROM personal_info WHERE uid='"
			.$_SESSION['uid']."'";
		$result2 = mysqli_query($con,$sql2);
		$num2 = mysqli_num_rows($result2);
		if($num2 > 0){
			$row2 = mysqli_fetch_array($result2);
			$_SESSION['name'] = $row2['name'];
			$_SESSION['sex'] = $row2['sex'];
			$_SESSION['birthday'] = $row2['birthday'];
			$_SESSION['hid'] = $row2['hid'];
			$_SESSION['modtime'] = $row2['modtime'];
		}

		$sql3 = "SELECT * FROM household WHERE hid='"
				.$_SESSION['hid']."'";
		$result3 = mysqli_query($con,$sql3);
		$num3 = mysqli_num_rows($result3);
		if($num3 > 0){
			$row3 = mysqli_fetch_array($result3);
			$_SESSION['address'] = $row3['address'];
			$_SESSION['size'] = $row3['size'];
			$_SESSION['city'] = $row3['city'];
			$headid = $row3['headid'];
		}

		echo "<h2>Welcome ".$row['username']."!</h2><br/>";
		if($nowUid == $headid){
?>
			<p><span style="font-size:25px;">Show Household Members at</span>
			<form method="post" action="showHouseMemAtTime.php">
			Enter Time:(yyyy-mm-dd hh-mm-ss)<br/>
			<input type="text" name="time">
			<input type="submit" value="Show">
			</form></p>
<?php
		}
		if($admin == 0){
			echo "<span style=\"font-size:25px;\">Household Members</span>";

			$sql4 = "SELECT * FROM personal_info WHERE hid='"
					.$_SESSION['hid']."'"; 
			$result4 = mysqli_query($con,$sql4);
			$num4 = mysqli_num_rows($result4);
			echo "<br/>";
			for($i=0;$i<$num4;$i++){
				$row4 = mysqli_fetch_array($result4);
				if($row4['name'] != $_SESSION['name']){
				echo $row4['name']."
					 <a href=userinfo.php?uid=".$row4['uid'].">
					 User_Info</a><br/>";
				}
			}
?>
			<p><span style="font-size:25px;">Modificatoin Histories</span>
			<form method="post" action="modhistory.php?uid=<?php echo $nowUid; ?>">
				Enter Time Interval:(yyyy-mm-dd hh-mm-ss)<br/>
				<input type="text" name="statime">~<input type="text" name="endtime">
				<input type="submit" value="Search">
			</form></p>
<?php
		}else{
			//echo "<span style=\"font-size:25px;\">
			//Latest 5 Modified Profiles</span>";

			//$sql5 = "SELECT * FROM personal_info ORDER BY modtime DESC LIMIT 5";
			//$result5 = mysqli_query($con,$sql5);
			//$num5 = mysqli_num_rows($result5);
			//for($i=0;$i<$num5;$i++){
				//$row5 = mysqli_fetch_array($result5);
				//echo "<br/><span style=\"word-spacing:1em;\">
					 //User_ID:".$row5['uid']." Name:".$row5['name'].
					 //" Modified_Time:</span>".$row5['modtime']."
					 //<a href=userinfo.php?uid=".$row5['uid'].">
					 //User_Info</a>";
			//}
?>
			<p><span style="font-size:25px;">Household Members Changes List
			</span></br>
			<form method="get" action="householdMemChange.php">
			Select HID:
			<select name=selectHid size=1>
			<?php                                                             
    		$sql = "SELECT * FROM household";                                       
    		$result = mysqli_query($con,$sql);                                      
    		while($row = mysqli_fetch_array($result)){                              
      	echo "<option value=\"".$row['hid']."\">".$row['hid']."</option>";    
    		}                                                                       
    	?>
			</select>
			<input type="submit" value="Search">
			</form>

			<br/>
			<input type="button" value="Search Page" style="float: left; width:125px;
				height:25; font-size:15px;" 
	 		onclick="self.location.href='search.php'">
			<br/>
			<p>
			<input type="button" value="Update Page" style="float: left; width:125px;
				height:25; font-size:15px;" 
	 		onclick="self.location.href='update.php'">
			<br/>
			<p>
			<input type="button" value="Modification" style="float: left;
				width:125px; height:25; font-size:15px;" 
	 		onclick="self.location.href='modifyPage.php'">
			<br/>
			<p>
			<input type="button" value="Statistics" style="float: left; width:125px;
				height:25; font-size:15px;" 
	 		onclick="self.location.href='statistics.php'">
			<br/>
<?php
		}
?>
	<p>
	<input type="button" value="User Info" style="float: left; width:125px;
				height:25; font-size:15px;" 
	 onclick="self.location.href='userinfo.php'">
	<br/>
	<p>
	<input type="button" value="Household Info" style="float: left; width:125px;
				height:25; font-size:15px;"
	 onclick="self.location.href='householdinfo.php'">
	<br/>
<?php
	$hid = $_SESSION['hid'];
	$city = $_SESSION['city'];

	$sql = "SELECT * FROM household WHERE city = '".$city."' AND hid <> '".
					$hid."'";                       
	$result = mysqli_query($con, $sql);                                         
	$num = mysqli_num_rows($result);
	
	if($num > 0) {
		$row = mysqli_fetch_array($result);
		$hid2 = $row['hid'];

		$sql2 = "SELECT * FROM personal_info WHERE hid ='".$hid2."'";
		$result2 = mysqli_query($con, $sql2);
		$row2 = mysqli_fetch_array($result2);
?>
		<p><span style="font-size:25px;">Feel lonely?</span><br/>
<?php

		echo "A person you may want to know: ";
		echo "<a href=stranger.php?uid=".$row2['uid'].">".$row2['name']."</a>";
	}
?>
</div>
<div id=button>
	<input type="button" value="Logout" style="float:center;width:60px;
 	 height:25px;font-size:15px;background-color:B3B3BC;border:1px #E0E0EB 
	 double"
 	onclick="self.location.href='logout.php'">
</div>
<?php
	}
	else{
		session_destroy();
		echo "Login Fail. Please check your account and password.<br/>";
		echo "<a href=index.php>Back to Login Page<br/></a>";
	}
	mysqli_close($con);
}
}
?>
</body>
</html>
