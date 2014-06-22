<!DOCTYPE html>                                                                 
<style type="text/css">                                                         
  @import url("style.css");                                                     
</style>                                                                        
<html>                                                                          
<head>                                                                          
  <title>Database FP | Update</title>
</head>                         
<body>
<h3>Household Registration System</br>Update Household Info</h3>
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
	$hid = $_GET['updateHid'];

	$sql = "SELECT * FROM household WHERE hid='".$hid."'";
	$result = mysqli_query($con,$sql);
	$num = mysqli_num_rows($result);
	if($num > 0){
		$row = mysqli_fetch_array($result);
	echo "<h2>".$hid." Household Info</h2>";
?>
	<form method="post" action="updateHouseCheck.php?hid=<?php echo $hid;?>" 
	 name="regisForm">
		Address:
		<div id="regisInput">
		<input type="text" name="updateAddress" value="<?php echo 
		$row['address']; ?>">
		</div><br/>
		Size: 
		<div id="regisInput">
		<input type="text" name="updateSize" value="<?php echo
		$row['size']; ?>">
		</div><br/>
		City:
		<div id="regisInput">
		<input type="text" name="updateCity" value="<?php echo
		$row['city']; ?>">
		</div><br/>
		Headid: 
		<div id="regisInput">
		<input type="text" name="updateHeadid" value="<?php echo
		$row['headid']; ?>">
		</div><br/>
		<input value="Update" type="submit" name="update" style="width:70px;
		 height:25px;font-size:15px;background-color:B3B3BC;
		 border:1px #E0E0EB double"/><br/>
	</form>
<?php
	}
}
}
?>
</div>
</body>
</html>
