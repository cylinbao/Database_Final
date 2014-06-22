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
	require 'PASS.php';

	$con = mysqli_connect($host,$dbname,$dbpasswd,$database);

	if( mysqli_connect_errno($con)){
    	echo "Fail to connect to Mysql<br/>".mysqli_connect_error()."<br/>";
	}else{
		$uid = $_GET['uid'];
		
		$sql = "SELECT * FROM personal_info WHERE uid='".$uid."'";                  
    $result = mysqli_query($con,$sql);                                          
    $num = mysqli_num_rows($result);                                            
                                                                                
    if($num > 0){                                                               
      $row = mysqli_fetch_array($result);                                       
      $name = $row['name'];                                                     
      $sex = $row['sex'];                                                       
      $birthday = $row['birthday'];                                             
      $hid = $row['hid'];                                                       
                                                                                
      echo "Name: ".$name."<br/>";                                              
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
