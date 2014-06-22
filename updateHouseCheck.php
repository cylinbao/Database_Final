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
$hid = $_GET['hid'];
$address = $_POST['updateAddress'];
$size = $_POST['updateSize'];
$city = $_POST['updateCity'];
$headid = $_POST['updateHeadid'];

require 'PASS.php';                                                             
                                                                                
$con = mysqli_connect($host,$dbname,$dbpasswd,$database);                       
                                                                                
if( mysqli_connect_errno($con)){
    echo "Fail to connect to Mysql<br/>".mysqli_connect_error()."<br/>";        
}                                                                               
else{
	$sql = "UPDATE household SET 
					address='".$address."', 
					size='".$size."', 
					city='".$city."', 
					headid='".$headid."' 
					WHERE hid='".$hid."'";
	$result = mysqli_query($con,$sql);
	if(!$result){                           
	      echo "something ERROR!<br/>".mysqli_error();
	} else{
		echo "<h2>Update Sucessfully!</h2><br/>";
		echo "<a href='main.php'>Main Page</a>";
	}
}
}
?>
</div>
</body>
</html>
