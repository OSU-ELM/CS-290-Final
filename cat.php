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
	<title>Eric Miller CS290 Final</title>
	<LINK href="style.css" rel="stylesheet"  />
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
	<div id = 'submit'> </div>

	<div id = 'content'>

 <?php

		echo '<h2>Our Current Offerings</h2>';
		$mysqli = new mysqli("oniddb.cws.oregonstate.edu","millerer-db",$password,"millerer-db"); //my DB
		
		 
		echo '<p><h2>In Stock</h2><p>
			<table border="1">
		    <tr><td><td>Seller Name <td>Product Name<td>Price<td>Product Type';

		$out_seller = ''; 
		$out_name = ''; 
		$out_price = '';
		$out_type = '';
		$out_id = '';
		$out_pic = '';

		if(!($stmt = $mysqli->prepare('SELECT profiles.pic, p.id, p.item, p.cost, p.ptype, profiles.pname FROM products p
			INNER JOIN profiles ON profiles.id = p.pid
			ORDER BY profiles.pname'))){
			echo "Prepare Failed";
		}
		if(!($stmt->execute())){
				echo "Execute failed";
		}
	
		if (!($stmt->bind_result($out_pic , $out_id,$out_name, $out_price, $out_type, $out_seller ))){
					echo "Binding failed";
				}
		
		while ($stmt->fetch()){
		if ($out_pic == '1'){
		echo '<tr><td><img src="1.jpg" width = "90px" height = "90px"><td>'.$out_seller.'<td>  '.$out_name.'<td>  $'.$out_price.'<td>  '.$out_type.'<br>';
			
		}
		if ($out_pic == '2'){
		echo '<tr><td><img src="2.jpg" width = "90px" height = "90px"><td>'.$out_seller.'<td>  '.$out_name.'<td>  $'.$out_price.'<td>  '.$out_type.'<br>';
			
		}
		if ($out_pic == '3'){
		echo '<tr><td><img src="3.jpg" width = "90px" height = "90px"><td>'.$out_seller.'<td>  '.$out_name.'<td>  $'.$out_price.'<td>  '.$out_type.'<br>';
			
		}
		if ($out_pic == '4'){
			echo '<tr><td><img src="4.jpg" width = "90px" height = "90px"><td>'.$out_seller.'<td>  '.$out_name.'<td>  $'.$out_price.'<td>  '.$out_type.'<br>';
			
		}
		

		}
			echo "</table>";

		$stmt->close();
	  
?> 

	</div>
	
  </body>