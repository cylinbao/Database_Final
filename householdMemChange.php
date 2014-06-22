<!DOCTYPE html>                                                                 
<style type="text/css">                                                         
  @import url("style.css");                                                     
</style>                                                                        
<html>                                                                          
<head>                                                                          
  <title>Database FP | Household Members</title>
</head>                         
<body>
<h3>Household Registration System</br>Household Members Change List</h3>
<div id="mainform">
<?php
session_start();

if(!isset($_SESSION['username'])){                                              
  session_destroy();                                                            
  echo "You haven't login yet. Please Login first!<br/>";                       
  echo "<a href=index.php>Login Page</a>";                                      
} else{
	$hid = $_GET['selectHid'];
	require 'PASS.php';

	$con = mysqli_connect($host,$dbname,$dbpasswd,$database);

	if(mysqli_connect_errno($con)){	
		echo "Fail to connect to Mysql<br/>".mysqli_connect_error()."<br/>";        
	} else {
		$sql1 = "CREATE TABLE IF NOT EXISTS selectTable (
						 uid varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci 
						 NOT NULL,
						 name varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci
						 NOT NULL,
						 hid varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci 
						 NOT NULL,
						 modtime datetime NOT NULL,
						 PRIMARY KEY (uid)
						);";
		$result1 = mysqli_query($con, $sql1);
		if(!$result1){
			echo "Result1: ".mysqli_error($con);
		}			
		
		$sql2 = "SELECT * FROM pmod_history ORDER BY modtime ASC";
		$result2 = mysqli_query($con, $sql2);
		if(!$result2){
			echo "Result2: ".mysqli_error($con);
		}

		$count = 0;
		while($row2 = mysqli_fetch_array($result2)){
			$sql3 = "SELECT * 
							 FROM selectTable
							 WHERE uid = '".$row2['uid']."'";
			$result3 = mysqli_query($con, $sql3);
			if(!$result3){
				echo "Result3: ".mysqli_error($con);
			}
			$num3 = mysqli_num_rows($result3);
			if($num3 == 0){
				if($row2['hid'] == $hid){
					$sql4 = "INSERT INTO selectTable (
									 uid,
									 name,
									 hid,
									 modtime
									 )
									 VALUES (
									 '".$row2['uid']."',
									 '".$row2['name']."',
									 '".$row2['hid']."',
									 '".$row2['modtime']."'
									 );";
					$result4 = mysqli_query($con, $sql4);
					if(!$result4){
						echo "Result4: ".mysqli_error($con);
					}

					$sql5 = "SELECT * FROM selectTable";
					$result5 = mysqli_query($con, $sql5);
					if(!$result5){
						echo "Result5: ".mysqli_error($con);
					}
					$count = $count + 1;
					echo $count.". ".$row2['modtime'];
					echo "<span style=\"word-spacing:1em;\"> ";
					output($result5);
				}
			} else{
				if($row2['hid'] != $hid){
					$sql6 = "DELETE FROM selectTable
									 WHERE uid = '".$row2['uid']."'";
					$result6 = mysqli_query($con, $sql6);
					if(!$result6){
						echo "Result6: ".mysqli_error($con);
					}
					$sql7 = "SELECT * FROM selectTable";
					$result7 = mysqli_query($con, $sql7);
					if(!$result7){
						echo "Result7: ".mysqli_error($con);
					}
					$count = $count + 1;
					echo $count.". ".$row2['modtime'];
					echo "<span style=\"word-spacing:1em;\"> ";
					output($result7);
				}
			}
		}
		$sql8 = "DROP TABLE selectTable";
		$result8 = mysqli_query($con, $sql8);
		if(!$result8){
			echo "Result8: ".mysqli_error($con);
		}			
	}
}
function output($print){
	$flag = true;
	while($rowPrint = mysqli_fetch_array($print)){
		if($flag){
			echo $rowPrint['name'];
			$flag = false;
		} else{
			echo ", ".$rowPrint['name'];
		}
	}
	echo "</span><br/>";
}
?>
<p><input type="button" value="Main Page" style="float: left;" 
onclick="self.location.href='main.php'"><br/>
</div>
</body>
</html>
