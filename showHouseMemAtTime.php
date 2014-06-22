<!DOCTYPE html>                                                                 
<style type="text/css">                                                         
  @import url("style.css");                                                     
</style>                                                                        
<html>                                                                          
<head>                                                                          
  <title>Database FP | History</title>
</head>                         
<body>
<h3>Household Registration System</br>Show Household Members</h3>
<div id="mainform">
<?php
session_start();

if(!isset($_SESSION['username'])){                                              
  session_destroy();                                                            
  echo "You haven't login yet. Please Login first!<br/>";                       
  echo "<a href=index.php>Login Page</a>";                                      
}                                                                               
else{                                                                           
	$time = $_POST['time'];
	$uid = $_SESSION['uid'];
	$hid = $_SESSION['hid'];
	require 'PASS.php';

	$con = mysqli_connect($host,$dbname,$dbpasswd,$database);

	if( mysqli_connect_errno($con)){	
		echo "Fail to connect to Mysql<br/>".mysqli_connect_error()."<br/>";        
	}	else{
		$sql = "CREATE VIEW Table1 AS
						SELECT *
						FROM pmod_history
						WHERE modtime <= '".$time."'";
		$result = mysqli_query($con,$sql);
		if(!$result){
			echo "something ERROR1!<br/>".mysqli_error();
		} else{
			$sql2 = "CREATE VIEW Table2 AS
							SELECT *
							FROM Table1 AS A
							WHERE NOT EXISTS (
							SELECT *
							FROM Table1 AS B
							WHERE A.uid = B.uid AND A.modtime < B.modtime
							)";
			$result2 = mysqli_query($con,$sql2);
			if(!$result2){
				echo "something ERROR2!<br/>".mysqli_error();
			} else{
				$sql3 = "SELECT *
								 FROM Table2
								 WHERE hid = '".$hid."'
								";
				$result3 = mysqli_query($con,$sql3);
				if(!$result3){
					echo "something ERROR2!<br/>".mysqli_error();
				} else{
					echo "<h2>Members at ".$time."</h2>";
					$count = 1;
					while($row = mysqli_fetch_array($result3)){
						echo "<span style=\"word-spacing:1em;\">
								 ".$count.". ".$row['name']."</span><br/>";
							$count += 1;
					}
					$sql4 = "DROP VIEW Table1";
					$result4 = mysqli_query($con,$sql4);
					$sql5 = "DROP VIEW Table2";
					$result5 = mysqli_query($con,$sql5);
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
