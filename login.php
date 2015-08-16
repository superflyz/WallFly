<?php
session_start();
$_SESSION["triedLogin"] = "true";
$username = "admin";
$password = "password";
$hostname = "localhost"; 

//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password)
 or die("Unable to connect to MySQL");

//select a database to work with
$selected = mysql_select_db("admin",$dbhandle)
  or die("Could not select database");

$check_user = $_POST['username'];
$check_password = $_POST['password'];

//To protect MySQL injection
$check_user = stripslashes($check_user);
$check_password = stripcslashes($check_password);
$check_user = mysql_real_escape_string($check_user);
$check_password = mysql_real_escape_string($check_password);

//execute the SQL query and return records
$sql = "SELECT * FROM user WHERE username = '$check_user' and password = '$check_password'";
$result = mysql_query($sql);

//Mysql_num_row is counting table row
$count = mysql_num_rows($result);

//If result matched $check_user and $check_password, table row must be 1 row
if($count == 1){
	$row = mysql_fetch_array($result);
	//session expire setup
	$session_expiration = time() + 5000;
	session_set_cookie_params($session_expiration);
	//start session
	
	$_SESSION["usertype"] = $row["privilege"];
	$_SESSION["username"] = $row["username"];
	header("location:home.php");
} else {
	
	header("Location: index.php");
}


//close database
mysql_close($dbhandle);


?>