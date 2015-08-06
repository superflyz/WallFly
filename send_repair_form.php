<?php
  // Report all errors
  error_reporting(E_ALL);
  
  // Same as error_reporting(E_ALL);
  ini_set("error_reporting", E_ALL);
	session_start();

	$userID = $_SESSION['username'];
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
	

  $sql_my_email = "SELECT email FROM user WHERE username = '$userID'";
  $result_my_email = mysql_query($sql_my_email);
  while ($row = mysql_fetch_array($result_my_email)) {
    $my_email = $row['email'];
  }

  if(isset($_POST['send_email'])){
    $to = $_POST['email'];
    $from = $my_email;
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $telephone = $_POST['telephone'];
    $property_address = $_POST['property_address'];
    $subject = $_POST['subject'];
    $message = $first_name." ".$last_name." wrote the following repair requests: ".$_POST['request'];
/*
    // headers
    $headers = "From: " . $from . "\r\n" . 
                "Property Address: " . $property_address . "\r\n" . 
                "Contact Number: " . $telephone . "\r\n" .
                "X-Mailer: PHP/" . phpversion();

    // headers for attachment 
    $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: text/html;\n"; 

    $mail = mail($to, $subject, $message, $headers);
*/
    //debugging
    $headers = "From: test@test.com" . "\r\n" . 
                "Property Address: address" . "\r\n" . 
                "Contact Number: 010101010" . "\r\n" .
                "X-Mailer: PHP/" . phpversion();
    $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: text/html;\n"; 
    $mail = mail("sdhwa92@gmail.com", "test email", "test", $headers);
    echo $to . $from . $first_name . $last_name . $telephone . $property_address . $subject . $message . $mail;

/*
    if($mail){
      echo "<script type='text/javascript'>";
      echo "alert('Mail Sent. Thank you ".$first_name.", we will contact you shortly.');";
      //echo "alert(Check: " . $to . $first_name . $last_name . $telephone . $property_address . $subject . $message .");";
      echo "history.go(-1);";
      echo "</script>";
    }else{
      echo "<script type='text/javascript'>";
      echo "alert('Mail sending failed.');";
      echo "</script>";
    }
*/
	}
  mysql_close();
?>