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
require 'PASS.php';

$con = mysqli_connect($host,$dbname,$dbpasswd,$database);                       
                                                                                
if( mysqli_connect_errno($con)){                                                
    echo "Fail to connect to Mysql<br/>".mysqli_connect_error()."<br/>";        
}                                                                               
else{
	$uid = $_GET['updateUid'];

	$sql = "SELECT * FROM personal_info WHERE uid='".$uid."'";
	$result = mysqli_query($con,$sql);
	$num = mysqli_num_rows($result);
	if($num > 0){
		$row = mysqli_fetch_array($result);
?>
	<h2>Personal Info</h2>
	<form method="post" action="updateInfoCheck.php?uid=<?php echo $uid;?>" 
	 name="regisForm">
		Name:
		<div id="regisInput">
		<input type="text" name="updateName" value="<?php echo 
		$row['name']; ?>">
		</div><br/>
		Sex: 
		<div id="regisInput">
		<input type="text" name="updateSex" value="<?php echo
		$row['sex']; ?>">
		</div><br/>
		Birthday:(yyyy-mm-dd)
		<div id="regisInput">
		<input type="text" name="updateBirthday" value="<?php echo
		$row['birthday']; ?>">
		</div><br/>
		Hid: 
		<div id="regisInput">
		<input type="text" name="updateHid" value="<?php echo
		$row['hid']; ?>">
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
