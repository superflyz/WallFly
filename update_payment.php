<?php
	session_start();
	$propertyID = $_SESSION['propertyId'];

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

 	$date = $_POST['date'];
 	$tenant_id = $_POST['tenant_id'];
 	$tenant_fname = $_POST['tenant_fname'];
 	$tenant_lname = $_POST['tenant_lname'];
 	$amount = $_POST['amount'];

 	$sql = "INSERT INTO payment(property, payment_date, tenant_id, tenant_fname, tenant_lname, amount)
 				VALUES ('$propertyID', '$date', '$tenant_id', '$tenant_fname', '$tenant_lname', '$amount')";
 	$result = mysql_query($sql);
 	
 	mysql_close();
 	echo "<script type='text/javascript'>";
	echo "alert('You have updated the payment history successfully');";
	echo "window.close();";
	echo "window.opener.location.reload();";
	echo "</script>";

?>