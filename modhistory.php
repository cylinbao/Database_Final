<!DOCTYPE html>                                                                 
<style type="text/css">                                                         
  @import url("style.css");                                                     
</style>                                                                        
<html>                                                                          
<head>                                                                          
  <title>Database FP | History</title>
</head>                         
<body>
<h3>Household Registration System</br>Modificatoin Histories</h3>
<div id="mainform">
<?php
session_start();

if(!isset($_SESSION['username'])){                                              
  session_destroy();                                                            
  echo "You haven't login yet. Please Login first!<br/>";                       
  echo "<a href=index.php>Login Page</a>";                                      
}                                                                               
else{                                                                           
	$start = $_POST['statime'];
	$end = $_POST['endtime'];
	$uid = $_POST['modUid'];
	if($uid == "")
		$uid = $_GET['uid'];
	require 'PASS.php';

	$con = mysqli_connect($host,$dbname,$dbpasswd,$database);

	if( mysqli_connect_errno($con)){	
		echo "Fail to connect to Mysql<br/>".mysqli_connect_error()."<br/>";        
	}                                                                               
	else{
		if($start == "" && $end == ""){
			$sql = "SELECT * FROM pmod_history WHERE uid='".$uid."'";
			$result = mysqli_query($con,$sql);
			if(!$result){
				echo "something ERROR!<br/>".mysqli_error();
			} else{
				$count = 1;
				while($row = mysqli_fetch_array($result)){
					echo "<span style=\"word-spacing:1em;\">
           ".$count.". Name:".$row['name'].
					 " Sex:".$row['sex']." Birthday:".$row['birthday'].
           " Modified_Time:".$row['modtime']."</span><br/>";
					 $count += 1;
				}
			}
		} else if($start == "" || $end == ""){
			echo "Please enter right Time Interval!<br/>";	
		}	else{
			$sql = "SELECT * FROM pmod_history WHERE uid='".$uid."' AND modtime >= '"
							.$start."' AND modtime <= '".$end."'";
			$result = mysqli_query($con,$sql);
			if(!$result){
				echo "something ERROR!<br/>".mysqli_error();
			} else{
				$count = 1;
				while($row = mysqli_fetch_array($result)){
					echo "<span style=\"word-spacing:1em;\">
           ".$count.". Name:".$row['name'].
					 " Sex:".$row['sex']." Birthday:".$row['birthday'].
           " Modified_Time:".$row['modtime']."</span><br/>";
					 $count += 1;
				}
			}
		}
	}
}
?>
<p><input type="button" value="Main Page" style="float: left;" 
onclick="self.location.href='main.php'"><br/>
</div>
</body>
</html>
