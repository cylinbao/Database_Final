<!DOCTYPE html>
<style type="text/css">
	@import url("style.css");
</style>
<html>
<head>
	<title>Database FP | Update</title>
</head>
<body>
<h3>Household Registration System</br>Update Page</h3> 
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
?>
		<p><span style="font-size:25px;">Update User Information</span></br>      
      <form method="get" action="updateInfo.php">                               
      Select UID:                                                               
      <select name=updateUid size=1>                                            
      <?php                                                                     
        $sql = "SELECT * FROM users";                                           
        $result = mysqli_query($con,$sql);                                      
        while($row = mysqli_fetch_array($result)){                              
        echo "<option value=\"".$row['uid']."\">".$row['uid']."</option>";      
        }                                                                       
      ?>                                                                        
      </select>                                                                 
      <input type="submit" value="Update">                                      
      </form>                                                                   
                                                                                
      <p><span style="font-size:25px;">Update Household Infomation</span></br>  
      <form method="get" action="updateHouse.php">                              
      Select HID:                                                               
      <select name=updateHid size=1>                                            
      <?php                                                                     
        $sql = "SELECT * FROM household";                                       
        $result = mysqli_query($con,$sql);                                      
        while($row = mysqli_fetch_array($result)){                              
        echo "<option value=\"".$row['hid']."\">".$row['hid']."</option>";      
        }                                                                       
      ?>                                                                        
      </select>                                                                 
      <input type="submit" value="Update">                                      
      </form>
<?php
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
