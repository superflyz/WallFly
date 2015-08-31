<?php
  session_start();
  $_SESSION['propertyId']=$_GET['id'];
  $property_id = $_SESSION['propertyId'];
  $usertype = $_SESSION['usertype'];

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


$firstname = $_POST['first_name'];
$lastname = $_POST['last_name'];
$subject = $_POST['subject'];
$message = $_POST['request'];

$sql = "INSERT INTO repairrequest (user_id, fname, lname, subject, msg)
VALUES ('John', 'Doe', 'john@example.com')";