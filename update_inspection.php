<?php
	session_start();
	$propertyID = $_SESSION['propertyId'];
	$currentID = $_SESSION["username"];

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

 	$inspection_date = $_POST['inspection_date'];
 	$tenant_id = $_POST['tenant_id'];
 	$tenant_fname = $_POST['tenant_fname'];
 	$tenant_lname = $_POST['tenant_lname'];
 	$inspector = $currentID;
 	$comment = $_POST['inspection_comment'];

 	$sql = "INSERT INTO inspection(inspection_date, tenant_id, tenant_fname, tenant_lname, inspector, comment, property_id)
 				VALUES ('$inspection_date', '$tenant_id', '$tenant_fname', '$tenant_lname', '$inspector', '$comment', '$propertyID')";
 	$result = mysql_query($sql);
 	
 	mysql_close();
 	echo "<script type='text/javascript'>";
	echo "alert('You have updated the inspection report successfully');";
	echo "window.close();";
	echo "window.opener.location.reload();";
	echo "</script>";

?>