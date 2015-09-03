<?php
  session_start();
  $_SESSION['propertyId']=$_GET['id'];
  $property_id = $_SESSION['propertyId'];
  $usertype = $_SESSION['usertype'];
  $username = $_SESSION['username'];


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


//storing the image that user uploads while making repair request
//directory where the image will be saved
$target_dir = "wallfly/img/repair";

//target image
$target_file = $target_dir . basename($_FILES["repair_image"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}


//storing the deatils of the user while they make requests
$firstname = $_POST['first_name'];
$lastname = $_POST['last_name'];
$subject = $_POST['subject'];
$message = $_POST['request'];


//getting the user_id of the currently logged in user
$sql="SELECT user_id FROM user WHERE username = '$username'";
$result = mysql_query($sql);

//storing all the information of the user making the request into the database
$sqlnew = "INSERT INTO repairs
VALUES ($result, $property_id, $firstname, $lastname, $subject, $message, null, 0, $target_file)";
