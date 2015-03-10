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

	<div id = 'message'></div>

 <?php

 if (!$_SESSION["login"] == "1"){
	 $mysqli = new mysqli("oniddb.cws.oregonstate.edu","millerer-db",$password,"millerer-db"); //my DB
	 $name = '';
	 $password = '';
	 class profile_obj {
		 var $profName;
		 var $propass;
		 function __construct ($input1,$input2){
			 $this->profName = $input1;
			 $this->propass = $input2;
			 
		 }
	 }
				if(!($stmt = $mysqli->prepare('SELECT pname, pass  FROM profiles' ))){
								echo "Prepare Failed";
							}
				if(!($stmt->execute())){
					echo "Execute failed";
				}

				if (!($stmt->bind_result($name, $password ))){
					echo "Binding failed";
				}
				
				while ($stmt->fetch()){
					$profile_array[] = new profile_obj($name,$password);
				}
	$arr_size = count($profile_array);

	echo'<br><br><b>Add New Profile</b><br><br>
		  <form name = "newprof" method = "post">
		  <label> Add Name: </label> 
		  <input type = "text" id ="pname"> <br>
		  <label> Add password: </label> 
		  <input type = "password" id ="newpass"> <br>
		  <label> Select Profile Picture: </label>
		  <select id="pic">
		  <option value="1">Cat</option>
		  <option value="2">Dog</option>
		  <option value="3">Monkey</option>
		  <option value="4">Bee</option>
		  </select>
		  <p><input type="button" value ="Add Profile" onclick = "makename()" />
		  </p>
		  </form>';
		  
	echo'<br><br><b>Login</b><br><br>
		  <form name = "login" method = "post">
		  <label> Username </label> 
		  <input type = "text" id ="lname"> <br>
		  <label> Password: </label> 
		  <input type = "password" id ="lpass"> <br>
		  <p><input type="button" value ="Login" onclick = "attempt_log()" />
		  </p>
		  </form>';
		  
 }  

 else {
	 	
		$mysqli = new mysqli("oniddb.cws.oregonstate.edu","millerer-db",$password,"millerer-db"); //my DB
		$out_pic = '';
		$name = $_SESSION["user"];
		if(!($stmt = $mysqli->prepare('SELECT pic FROM profiles 
			WHERE pname = "'.$name.'"'))){
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
		echo '
		  <form name = "change" method = "post">
		  <select id="change_pic">
		  <option value="1">Cat</option>
		  <option value="2">Dog</option>
		  <option value="3">Monkey</option>
		  <option value="4">Bee</option>
		  </select>
		  <input type="button" value ="Change profile" onclick = "picture_change()" />
		  </form>';
		  
		echo'<br><h2>You are currently logged in as: '.$_SESSION["user"].'</h2>';
		echo '<b>Click button to log out</b><br><br>
		  <form name = "Logout" method = "post" action = "logout.php">
		  <input type = "submit" value = "Log Out">
		  </form>';	  
		$profile_array = '';
		$arr_size = 0;
 }
	  
?> 

 <script type='text/javascript'>
      var arry = <?php echo json_encode($profile_array)?>; //jason encode syntax from http://stackoverflow.com/questions/16772181/iterating-over-a-php-array-inside-a-javascript-loop
	  var loop = <?php echo $arr_size?>;
	  var i = 0;
	  for (i = 0; i < loop; i++){
		  var text = arry[i];
		  var text = text.profName;
		  console.log(text);
	  }
	 var div = document.getElementById("content");

function makename() {
	var input_area = document.getElementById("message");
	var input_name = document.getElementById("pname");
	var input_pass= document.getElementById("newpass");
	var input_pic= document.getElementById("pic");
	var Name_entry = input_name.value;
	var Pass_entry = input_pass.value;
	var Pic_entry = input_pic.value;
	
	console.log(Name_entry);
	input_area.innerHTML ="";
	if ( !(Name_entry)  || !(Pass_entry)){
			Name_entry = '';
			Pass_entry = '';
			input_area.innerHTML ="<br><br><b>MUST ENTER BOTH A USER NAME AND PASSWORD</b>";
	}

	else {
		var found = 0;
		for ( var i = 0; i < arry.length; i++){
			var text = arry[i];
			var text = text.profName;
			if (text == Name_entry){
				
				console.log("FOUND");
				found = 1;
			}
			
		}

		console.log(found);	
		
		if (found == 1){
			input_area.innerHTML ="<br><br><b>ERROR: USER NAME ALREADY EXISTS</b>";
			found = 0;
		}
		
		else{
			console.log("YEAH!");
			//below syntax to pass a value through POST in javascript taken from  http://stackoverflow.com/questions/133925/javascript-post-request-like-a-form-submit
			input_area.innerHTML = '<form id = "post_sub" action = "makeprofile.php" method = "post" > <input type = "hidden" name = "newname" value ="'+Name_entry+'"><input type = "hidden" name = "newpass" value ="'+Pass_entry+'"><input type = "hidden" name = "newpic" value ="'+Pic_entry+'"><input type = "submit" id = "add_user"></form>';
			input_area = document.getElementById("add_user");
			input_area.click();
		}	
	}
}


function attempt_log() {
var input_area = document.getElementById("message");
	var input_name = document.getElementById("lname");
	var input_pass= document.getElementById("lpass");
	var Name_entry = input_name.value;
	var Pass_entry = input_pass.value;
	console.log(Name_entry);
	input_area.innerHTML ="";
	if ( !(Name_entry)  || !(Pass_entry)){
			Name_entry = '';
			Pass_entry = '';
			input_area.innerHTML ="<br><br><b>MUST ENTER BOTH A USER NAME AND PASSWORD</b>";
	}

	else {
		console.log("Checkpint1");
		var found = 0;
		var index = 0;
		for ( var i = 0; i < arry.length; i++){
			var text = arry[i];
			var text = text.profName;
			if (text == Name_entry){
				
				console.log("FOUND");
				found = 1;
				index = i;
				i = arry.length;
			}
			
		}

		console.log(found);	
		
		if (found == 1){
			console.log("YEAH!");
			var text = arry[index];
			var text = text.propass;
			if (Pass_entry == text){
				input_area.innerHTML ="<br><br><b>YOU LOGGED IN!</b>";
				//below syntax to pass a value through POST in javascript taken from  http://stackoverflow.com/questions/133925/javascript-post-request-like-a-form-submit
				input_area.innerHTML = '<form id = "post_sub" action = "login.php" method = "post" > <input type = "hidden" name = "lname" value ="'+Name_entry+'"><input type = "submit" id = "input_user"></form>';
				input_area = document.getElementById("input_user");
				input_area.click();
			}
			
			else{
				input_area.innerHTML ="<br><br><b>PASSWORD DOESN'T MATCH USERNAME</b>";
			}
		}
		
		else{
			input_area.innerHTML ="<br><br><b>USER NAME NOT FOUND</b><br><br>";
			found = 0;
		}	
	}
}

function picture_change() {
	var input_pic= document.getElementById("change_pic");
	var Pic_entry = input_pic.value;
	var input_area = document.getElementById("message");
	console.log(Pic_entry);

			//below syntax to pass a value through POST in javascript taken from  http://stackoverflow.com/questions/133925/javascript-post-request-like-a-form-submit
			input_area.innerHTML = '<form id = "post_sub" action = "change.php" method = "post" > <input type = "hidden" name = "changed" value ="'+Pic_entry+'"><input type = "submit" id = "change_pic"></form>';
			input_area = document.getElementById("change_pic");
			input_area.click();
		
	}






	 //PHP variable transfer syntax from http://p2p.wrox.com/php-faqs/11606-q-how-do-i-pass-php-variables-javascript.html
</script>
	</div>
	
  </body>