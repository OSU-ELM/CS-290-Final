<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'storedInfo.php';
session_start();
?>
<html>
  <head>
    <meta charset="UTF-8">
	 <meta http-equiv="refresh" content="0;url=myitems.php"> <!--//auto redirect code from  http://stackoverflow.com/questions/5411538/redirect-from-an-html-page -->
	<title>ErEric Miller CS 360 Final Project</title>
  </head>
<body></body>
<?php

	if (isset($_POST['newname']) == TRUE){ //syntax from http://php.net/manual/en/function.isset.php
		$newname = $_POST['newname'];
		$newprice = $_POST['newprice'];
		$newtype = $_POST['newtype'];
		$user = $_SESSION["user"];

		$mysqli = new mysqli("oniddb.cws.oregonstate.edu","millerer-db",$password,"millerer-db");

		if(!($stmt = $mysqli->prepare('INSERT INTO products(pid,item,cost,ptype) VALUES((SELECT id FROM profiles WHERE pname = ?),?,?,?)'))){
									echo "Prepare Failed<br>";
				}
		if(!($stmt->bind_param('ssss',$user,$newname,$newprice,$newtype))){ //syntax from http://us2.php.net/manual/en/mysqli-stmt.bind-param.php
					echo "Bind Failed<br>";
				}
			if (!$stmt->execute()) {
					echo "Execute failed<br>";
			}
	}
	else {
		echo "<h2>Error: Please use my items page</h2>";
	}
?>