<!DOCTYPE hml>
<style tpye="text/css">
	@import url("style.css");
</style>
<html>
<head>
	<title>Database FP | Search</title>
</head>
<body>
<h3>Household Registration System</br>Search Page</h3>
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
	<p><span style="font-size:25px;">Search by UID</span></br>                
      <form method="get" action="searchResult.php">                             
      Select UID:                                                               
      <select name=searchUid size=1>                                            
      <?php                                                                     
        $sql = "SELECT * FROM users";                                           
        $result = mysqli_query($con,$sql);                                      
        while($row = mysqli_fetch_array($result)){                              
        echo "<option value=\"".$row['uid']."\">".$row['uid']."</option>";      
        }                                                                       
      ?>                                                                        
      </select>                                                                 
      <input type="submit" value="Search"><br/>                                 
      </form></p>                                                               
                                                                                
      <p><span style="font-size:25px;">Search by HID</span></br>                
      <form method="get" action="searchResult.php">                             
      Select HID:                                                               
      <select name=searchHid size=1>                                            
      <?php                                                                     
        $sql = "SELECT * FROM household";                                       
        $result = mysqli_query($con,$sql);                                      
        while($row = mysqli_fetch_array($result)){                              
        echo "<option value=\"".$row['hid']."\">".$row['hid']."</option>";      
        }                                                                       
      ?>                                                                        
      </select>                                                                 
      <input type="submit" value="Search"><br/>                                 
      </form></p>

			<p><span style="font-size:25px;">Search by Sex</span></br>                
      <form method="get" action="searchResult.php">                             
      Select Sex:                                                               
      <select name=searchSex size=1>                                            
        <option value=M>Male</option>                                           
        <option value=F>Female</option>                                         
      </select>                                                                 
      <input type="submit" value="Search"><br/>                                 
      </form></p>                                                               
                                                                                
      <p><span style="font-size:25px;">Search by Age</span></br>                
      <form method="get" action="searchResult.php">                             
      Enter Age interval:                                                       
      <input type="text" name="startAge" size="3"> ~                            
      <input type="text" name="endAge" size="3">                                
      <input type="submit" value="Search"><br/>                                 
      </form></p>                                                               
                                                                                
      <p><span style="font-size:25px;">Search by Living City</span></br>        
      <form method="get" action="searchResult.php">                             
      Select City:                                                              
      <select name=searchCity size=1>                                           
      <?php                                                                     
        $sql = "SELECT * FROM household";                                       
        $result = mysqli_query($con,$sql);                                      
        while($row = mysqli_fetch_array($result)){                              
        echo "<option value=\"".$row['hid']."\">".$row['city']."</option>";     
        }                                                                       
      ?>                                                                        
      </select>                                                                 
      <input type="submit" value="Search"><br/>                                 
      </form></p>
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
