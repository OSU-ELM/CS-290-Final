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
	if (isset($_POST['lname'])== TRUE){//syntax from http://php.net/manual/en/function.isset.php
		$user = $_POST['lname'];
		$_SESSION["user"] = $user;
		$_SESSION["login"] = "1";
		echo ('<br><br><b>Welcome '.$user.' ! You are now logged in. </b>');


		echo('<form id = "return_front" action = "front.php"> 
			  <button type ="submit"> Return to Login Page</button>
			  </form>');
	
		$mysqli = new mysqli("oniddb.cws.oregonstate.edu","millerer-db",$password,"millerer-db"); //my DB
		$out_pic = '';
		if(!($stmt = $mysqli->prepare('SELECT pic FROM profiles 
			WHERE pname = "'.$_SESSION["user"].'"'))){
			echo "Prepare Failed";
		}
		if(!($stmt->execute())){
				echo "Execute failed";
		}
	
		if (!($stmt->bind_result($out_pic ))){
					echo "Binding failed";
				}
		$stmt->fetch();
		if ($out_pic == '1'){
			echo ('<br> <img src="1.jpg" width = "150px" height = "150px">');
			
		}
		if ($out_pic == '2'){
			echo ('<br> <img src="2.jpg" width = "150px" height = "150px">');
			
		}
		if ($out_pic == '3'){
			echo ('<br> <img src="3.jpg" width = "150px" height = "150px">');
			
		}
		if ($out_pic == '4'){
			echo ('<br> <img src="4.jpg" width = "150px" height = "150px">');
			
		}
	}
	else{
		echo "<h2>ERROR: Please use log in page</h2>";
	}
?>	
	
	
	
	</div>


  </body>