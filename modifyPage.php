<!DOCTYPE html>
<style type="text/css">
	@import url("style.css");
</style>
<html>
<head>
	<title>Database FP | Modification</title>
</head>
<body>
<h3>Household Registration System</br>Modification Page</h3> 
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
		<p><span style="font-size:25px;">Modificatoin Histories</span>            
      <form method="post" action="modhistory.php">                              
      Select UID:                                                               
      <select name=modUid size=1>                                               
      <?php                                                                     
        $sql = "SELECT * FROM users";                                           
        $result = mysqli_query($con,$sql);                                      
        while($row = mysqli_fetch_array($result)){                              
        echo "<option value=\"".$row['uid']."\">".$row['uid']."</option>";      
        }                                                                       
      ?>                                                                        
      </select><br/>                                                            
      Enter Time Interval:(yyyy-mm-dd hh-mm-ss)<br/>                            
      <input type="text" name="statime">~<input type="text" name="endtime">     
      <input type="submit" value="Search">                                      
      </form></p>
			<br/>
<?php
		echo "<span style=\"font-size:25px;\">                                    
      Latest 5 Modified Profiles</span>";                                       
                                                                                
      $sql5 = "SELECT * FROM personal_info ORDER BY modtime DESC LIMIT 5";      
      $result5 = mysqli_query($con,$sql5);                                      
      $num5 = mysqli_num_rows($result5);                                        
      for($i=0;$i<$num5;$i++){                                                  
        $row5 = mysqli_fetch_array($result5);                                   
        echo "<br/><span style=\"word-spacing:1em;\">                           
           User_ID:".$row5['uid']." Name:".$row5['name'].                       
           " Modified_Time:</span>".$row5['modtime']."                          
           <a href=userinfo.php?uid=".$row5['uid'].">                           
           User_Info</a>";                                                      
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
