<?php
	session_start();

	//connect DB
 	$username = "admin";
 	$password = "password";
 	$hostname = "localhost"; 
 	
 	//connection to the database
 	$dbhandle = mysql_connect($hostname, $username, $password)
 	 or die("Unable to connect to MySQL");
 	
 	//select a database to work with
 	$selected = mysql_select_db("admin",$dbhandle)
 	  or die("Could not select database");

 	
 	$username = $_POST['username'];
 	$password = $_POST['password'];
 	$first_name = $_POST['first_name'];
 	$last_name = $_POST['last_name'];
 	$email = $_POST['email'];
 	$usertype = $_POST['usertype'];

 	$check_username = "SELECT username FROM user WHERE username='$username'";
 	$check_result = mysql_query($check_username);
 	if($check_result && mysql_num_rows($check_result) > 0){
 		echo "<script type='text/javascript'>";
		echo "alert('The username is already taken!');";
		echo "history.go(-1);";
		echo "</script>";
 	} else{
		$sql = "INSERT INTO user(username, password, privilege, email, first_name, last_name)
 				VALUES ('$username', '$password', '$usertype', '$email', '$first_name', '$last_name')";
 		$result = mysql_query($sql);
	
 		mysql_close();
 		echo "<script type='text/javascript'>";
		echo "alert('Thank you for join us!');";
		echo "</script>";
		header("Location: error.php");
 	}

 	

?>