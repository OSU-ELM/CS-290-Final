<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'storedInfo.php'; //This is for logging in to my ONID db without displaying the password as it is stored in a hidden folder
session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
	<title>Eric Miller CS 290 Final</title>

	<script src = 'tutorial.js'></script>
	<LINK href="style.css" rel="stylesheet" />
  </head>
  <body>
    <div class = 'topper'>
	<img src="market.jpg" width = "200 px" height = "150px" class ="topl"> <!--photo from http://www.wordstream.com/blog/ws/2014/09/18/beginners-guide-to-target-markets -->
	<b>E-Market</b>
	<img src="market.jpg" width = "200 px" height = "150px" class ="topr">
	</div>
	<table class ='menu'>
	  <tbody>
	     <tr><td><a href = 'home.html'>Home</a></tr>
		<tr><td><a href = 'front.php'>Login/out</a></tr>
	    <tr><td> <a href = 'myitems.php'>List My Items</a></tr>
		<tr><td> <a href = 'cat.php'>Items for Sale</a></tr>
		<tr><td><img src="market2.jpg" width = "200 px" height = "350px"> <!--photo from http://www.miromaroutlets.com/news/miromar-outlets-to-host-weekly-farmer%E2%80%99s-market-beginning-january-6/ -->
		</tr>
	  </tbody>
	</table>
	<div class = 'content'> 
<?php

	if (isset($_POST['newname']) == TRUE){ //syntax from http://php.net/manual/en/function.isset.php
		
		$user = $_POST['newname'];
		$pass = $_POST['newpass'];
		$pic = $_POST['newpic'];
		if ($pic == '1'){
			echo ('<br> <img src="1.jpg" width = "150px" height = "150px">');
			
		}
		if ($pic == '2'){
			echo ('<br> <img src="2.jpg" width = "150px" height = "150px">');
			
		}
		if ($pic == '3'){
			echo ('<br> <img src="3.jpg" width = "150px" height = "150px">');
			
		}
		if ($pic == '4'){
			echo ('<br> <img src="4.jpg" width = "150px" height = "150px">');
			
		}
		echo ('<br><br><b>New User Name: '.$user.' <br>New User Password: '.$pass.'</b>');
		$mysqli = new mysqli("oniddb.cws.oregonstate.edu","millerer-db",$password,"millerer-db"); //my DB
		if(!($stmt = $mysqli->prepare('INSERT INTO profiles(pname,pass,pic) VALUES(?,?,?)'))){
								echo "Prepare Failed<br>";
						}
		if(!($stmt->bind_param('sss',$user,$pass,$pic))){ //syntax from http://us2.php.net/manual/en/mysqli-stmt.bind-param.php
				echo "Bind Failed<br>";
			}
		if (!$stmt->execute()) {
				echo "Execute failed<br>";
			}
		
		echo('<form id = "return_front" action = "front.php"> 
			  <button type ="submit"> Return to Login Page</button>
			  </form>');
	}
	
	else{
		echo ("<h2>Please use log in page</h2>");
	}

?>	
	
	
	
	</div>


  </body>