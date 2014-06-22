<!DOCTYPE html>                                                                 
<style type="text/css">                                                         
  @import url("style.css");                                                     
</style>                                                                        
<html>                                                                          
<head>                                                                          
  <title>Database FP | Register</title>
</head>                         
<?php
session_start();
if(isset($_SESSION['sus']))
{
	header("Location:main.php");
}
?>
<body>
<h3>Household Registration System</br>Register Page</h3>
<div id="mainform">
	<form method="post" action="registerCheck.php" name="regisForm">
		Username:
		<div id="regisInput">
		<input type="text" name="regisUsername">
		</div><br/>
		Password: 
		<div id="regisInput">
		<input type="password" name="regisPasswd">
		</div><br/>
		Email:
		<div id="regisInput">
		<input type="text" name="regisEmail">
		</div><br/>
		Name: 
		<div id="regisInput">
		<input type="text" name="regisName">
		</div><br/>
		Sex: 
		<div id="regisInput">
		<select name=regisSex>
			<option value=M >M</option>
			<option value=F >F</option>
		</select>
		</div><br/>
		Birthday:(yyyy-mm-dd)
		<div id="regisInput">
		<input type="text" name="regisBirthday">
		</div><br/>
		Select Household ID:
		<div id="regisInput">
		<select name=regisHid size=1>
		<?php
			require 'PASS.php';
			$con = mysqli_connect($host,$dbname,$dbpasswd,$database);
			if( mysqli_connect_errno($con)){
    		echo "Fail to connect to Mysql<br/>".mysqli_connect_error()."<br/>";
			} else{
				$sql = "SELECT * FROM household";
				$result = mysqli_query($con,$sql);
				while($row = mysqli_fetch_array($result)){
					echo "<option value=\"".$row['hid']."\">".$row['hid']."</option>";	
				}
			}
		?>
		</select>
		</div><br/>
		<input value="Register" type="submit" name="register" style="width:70px;
		 height:25px;font-size:15px;background-color:B3B3BC;
		 border:1px #E0E0EB double"/><br/>
	</form>
</div>
</body>
</html>
