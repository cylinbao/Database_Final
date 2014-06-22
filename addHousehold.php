<!DOCTYPE html>                                                                 
<style type="text/css">                                                         
  @import url("style.css");                                                     
</style>                                                                        
<html>                                                                          
<head>                                                                          
  <title>Database FP | New Household</title>
</head>                         
<?php
session_start();
if(!isset($_SESSION['username'])){                                              
  session_destroy();                                                            
	echo "You haven't login yet. Please Login first!<br/>";                       
	echo "<a href=index.php>Login Page</a>";                                      
}                                                                               
else{ 
?>
<body>
<h3>Household Registration System</br>Add New Household</h3>
<div id="mainform">
	<form method="post" action="addHouseholdCheck.php" name="addHouseForm">
		Address:
		<div id="regisInput">
		<input type="text" name="addHouseAddress">
		</div><br/>
		Size: 
		<div id="regisInput">
		<input type="text" name="addHouseSize">
		</div><br/>
		City:
		<div id="regisInput">
		<input type="text" name="addHouseCity">
		</div><br/>
		<!--
		Headid: 
		<div id="regisInput">
		<input type="text" name="addHouseHeadid">
		</div><br/>
		-->
    Select Head ID:                                                        
    <div id="regisInput">                                                       
    <select name=addHouseHeadid size=1>
    <?php                                                                       
      require 'PASS.php';                                                       
      $con = mysqli_connect($host,$dbname,$dbpasswd,$database);                 
      if( mysqli_connect_errno($con)){                                          
        echo "Fail to connect to Mysql<br/>".mysqli_connect_error()."<br/>";    
      } else{                                                                   
        $sql = "SELECT * FROM users";                                       
        $result = mysqli_query($con,$sql);                                      
        while($row = mysqli_fetch_array($result)){                              
          echo "<option value=\"".$row['uid']."\">".$row['uid']."</option>";    
        }                                                                       
      }                                                                         
    ?>                                                                          
    </select>                                                                   
    </div><br/>                                                                 
		<input value="Add" type="submit" name="addHouse" style="width:70px;
		 height:25px;font-size:15px;background-color:B3B3BC;
		 border:1px #E0E0EB double"/><br/>
	</form>
</div>
</body>
<?php
	}
?>
</html>
