<!DOCTYPE html>                                                                 
<style type="text/css">                                                         
  @import url("style.css");                                                     
</style>                                                                        
<html>                                                                          
<head>                                                                          
  <title>Database FP | Update</title>                                         
</head>                                                                         
<body>                                                                          
<h3>Household Registration System</br>Update User Info</h3>                    
<div id="mainform">
<?php                                                                           
session_start();                                                                
                                                                                
if(!isset($_SESSION['username'])){                                              
  session_destroy();                                                            
  echo "You haven't login yet. Please Login first!<br/>";                       
  echo "<a href=index.php>Login Page</a>";                                      
}                                                                               
else{                                                                           
$uid = $_GET['uid'];
$name = $_POST['updateName'];
$sex = $_POST['updateSex'];
$birthday = $_POST['updateBirthday'];
$hid = $_POST['updateHid'];

require 'PASS.php';                                                             
                                                                                
$con = mysqli_connect($host,$dbname,$dbpasswd,$database);                       
                                                                                
if( mysqli_connect_errno($con)){
    echo "Fail to connect to Mysql<br/>".mysqli_connect_error()."<br/>";        
}                                                                               
else{
	$flag = 0;
	$sql = "UPDATE personal_info SET 
					name='".$name."', 
					sex='".$sex."', 
					birthday='".$birthday."', 
					hid='".$hid."',
					modtime=CURRENT_TIMESTAMP 
					WHERE uid='".$uid."'";
	$result = mysqli_query($con,$sql);
	if(!$result){                           
		echo "something ERROR!<br/>".mysqli_error();
		echo 1;
		$flag = 1;
	}

	$sql3 = "SELECT * FROM personal_info WHERE uid='".$uid."'";
	$result3 = mysqli_query($con,$sql3);
	if(!$result3){	
		echo "something ERROR!<br/>".mysqli_error();
		echo 3;
		$flag = 1;
	} else {
		$row = mysqli_fetch_array($result3);
		$modtime = $row['modtime'];
		//echo "modtime=".$modtime."<br/>";
	}
	
	$sql2 = "SELECT * FROM pmod_history";
	$result2 = mysqli_query($con,$sql2);
	$num = mysqli_num_rows($result2);
	if(!$result2){	
	echo "something ERROR!<br/>".mysqli_error();
		$flag = 1;
		echo 2;
	}
	$historyid = $num + 1;
	//echo "historyid=".$historyid." <br/>";

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
            '".$name."',                                                   
            '".$sex."',                                                    
            '".$birthday."',                                               
            '".$hid."',                                                    
            '".$modtime."')";
	$result4 = mysqli_query($con,$sql4);
	if(!$result4){
		echo "something ERROR!<br/>".mysqli_error();
		echo 4;
		$flag = 1;
	}

	mysql_close($con);
	
	if($flag == 0){
		echo "<h2>Update Sucessfully!</h2><br/>";
	}
	//echo "<a href='main.php'>Main Page</a>";
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
