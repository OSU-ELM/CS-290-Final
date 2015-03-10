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

 if (!$_SESSION["login"] == "1"){
	echo '<h2>Please log in to customize your items</h2>';
		  
 }  

 else {
		$mysqli = new mysqli("oniddb.cws.oregonstate.edu","millerer-db",$password,"millerer-db"); //my DB
		
		echo'<h2>            Welcome '.$_SESSION["user"].'!</h2>';
		
	 
		echo '<p><h2>Your items</h2><p>
			<table border="1">
		    <tr><td>Product Name<td>Price<td>Product Type';

		$out_name = ''; 
		$out_price = '';
		$out_type = '';
		$out_id = '';

		if(!($stmt = $mysqli->prepare('SELECT p.id, p.item, p.cost, p.ptype FROM products p
			INNER JOIN profiles ON profiles.id = p.pid
			WHERE profiles.pname = "'.$_SESSION["user"].'"
			ORDER BY p.item'))){
			echo "Prepare Failed";
		}
		if(!($stmt->execute())){
				echo "Execute failed";
		}
	
		if (!($stmt->bind_result($out_id,$out_name, $out_price, $out_type ))){
					echo "Binding failed";
				}
		
		while ($stmt->fetch()){
				echo '<tr> <td>  '.$out_name.'<td>  $'.$out_price.'<td>  '.$out_type.'<td>
			    <form name = "delete_form" method = "post" action = \'removeitem.php\'>
				<input type="submit" value =Delete>
				<input type="hidden" name="input" value="'.$out_id.'">
				</form>
				<br>'; 
		}
			echo "</table>";

		
		$stmt->close();
///////////////////////////////////////////////////


	 echo'<br><br><br><b>Add New Item</b><br><br>
	  <form name = "new_item" method = "post">
	  <label> Add Item Name: </label> 
	  <input type = "text" id ="newName"> <br>
	  <label> Add Item Price: (Max $999.99): </label> 
	  <input type = "number" id ="newPrice" step="0.01" min = "0", max = "999.99"> <br>
	  <label> Select Item Type: </label>
	  <select id="newType">
	  <option value="Food">Food</option>
	  <option value="Clothing">Clothing</option>
	  <option value="Book">Toy</option>
	  <option value="Toy">Book</option>
	  <option value="Tool">Tool</option>
	  <option value="Other">Other</option>
	  </select>
	</form>
	<p><input type="button" value = "Add Item" onclick = "addItem()" /></p>';
	 //html coding for decimal constraints on price from http://stackoverflow.com/questions/19011861/is-there-a-float-input-type-in-html5
 }
	  
?> 

 <script type='text/javascript'>


function addItem() {
	var input_area = document.getElementById("message");
	
	var input_name = document.getElementById("newName");
	var input_price= document.getElementById("newPrice");
	var input_type= document.getElementById("newType");
	
	var Name_entry = input_name.value;
	var Price_entry = input_price.value;
	var Type_entry = input_type.value;
	
	
	console.log(Name_entry);
	console.log(Price_entry);
	console.log(Type_entry);
	
	
	input_area.innerHTML ="";
	
	if (Name_entry == "" || Price_entry == ""){
		input_area.innerHTML = "<h2>ERROR: You must fill out all parts of the form</h2><br>";
	}
	else {
		
			input_area.innerHTML = '<form id = "post_newItem" action = "makeitem.php" method = "post" > <input type = "hidden" name = "newname" value ="'+Name_entry+'"><input type = "hidden" name = "newprice" value ="'+Price_entry+'"><input type = "hidden" name = "newtype" value ="'+Type_entry+'"><input type = "submit" id = "add_items" action = "makeitem.php" ></form>';
			input_area = document.getElementById("add_items");
			input_area.click();
	}
	
	
	
}

	 //PHP variable transfer syntax from http://p2p.wrox.com/php-faqs/11606-q-how-do-i-pass-php-variables-javascript.html
</script>
		<div id = 'message'></div>
	</div>
	
  </body>