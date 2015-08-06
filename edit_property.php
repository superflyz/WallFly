<?php

session_start();
$propertyID = $_SESSION['propertyId'];
$current_user = $_SESSION['username'];
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

//Get values from form
if($usertype == "AGENT"){
	$owner_id=$_POST['owner_id'];
	$agent_id=$current_user;
	$tenant_id=$_POST['tenant_id'];
	$owner_fname=$_POST['owner_fname'];
	$owner_lname=$_POST['owner_lname'];
	$tenant_fname=$_POST['tenant_fname'];
	$tenant_lname=$_POST['tenant_lname'];
	$agent_name=$_POST['agent_name'];
	$owner_contact=$_POST['owner_contact'];
	$agent_contact=$_POST['agent_contact'];
	$tenant_contact=$_POST['tenant_contact'];
	$street=$_POST['street'];
	$suburb=$_POST['suburb'];
	$state=$_POST['state'];
	$post=$_POST['pc'];
	$uploadDir = "img/properties/"; //Image upload folder
}elseif($usertype == "OWNER"){
	$owner_id=$current_user;
	$agent_id=$_POST['agent_id'];
	$tenant_id=$_POST['tenant_id'];
	$owner_fname=$_POST['owner_fname'];
	$owner_lname=$_POST['owner_lname'];
	$tenant_fname=$_POST['tenant_fname'];
	$tenant_lname=$_POST['tenant_lname'];
	$agent_name=$_POST['agent_name'];
	$owner_contact=$_POST['owner_contact'];
	$agent_contact=$_POST['agent_contact'];
	$tenant_contact=$_POST['tenant_contact'];
	$street=$_POST['street'];
	$suburb=$_POST['suburb'];
	$state=$_POST['state'];
	$post=$_POST['pc'];
	$uploadDir = "img/properties/"; //Image upload folder
}


//Edit data into mysql
if($_FILES['photo']['size'] > 0){
	function random_string($length) {
    $key = '';
    $keys = array_merge(range(0, 9), range('a', 'z'));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $key;
	}

	$fileName = random_string(10);
	$tmpName = $_FILES['photo']['tmp_name'];
	$fileSize = $_FILES['photo']['size'];
	$fileType = $_FILES['photo']['type'];
	
	$filePath = $uploadDir . basename($fileName);
	$uploadOk = 1;
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])){
		//$check = getimagesize($fileName);
		if($fileSize > 0){
			echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else{
			echo "File is not an image.";
			$uploadOk = 0;
		}
	}
	// Check if file already exists
	if (file_exists($filePath)){
		echo "Sorry, file already exists.";
		$uploadOk = 0;
	}
	// Check file size
	if($fileSize > 2000000) {
		echo "Sorry, your file is too large.";
		$uploadOk = 0;
	}
	// Allow certain file formats
	if($fileType != "image/jpg" && $fileType != "image/png" && $fileType != "image/jpeg" && $fileType != "image/gif"){
		echo "Sorry, only JPG, JPEG, PNG and GIF files are allowed.";
		$uqloadOk = 0;
	}
	// Check if $uqloadOk is set to 0 by an error
	if($uploadOk == 0){
		echo "Sorry, your file was not uqloaded.";
	// fie everything is ok, try to uqload file
	} else {
		$result_upload = move_uploaded_file($tmpName, $filePath);
		if ($result_upload !== false) {
			$sql="UPDATE property SET owner_id = '$owner_id',
									  agent_id = '$agent_id',
									  tenant_id = '$tenant_id', 
									  owner_fname = '$owner_fname', 
									  owner_lname = '$owner_lname',
									  tenant_fname = '$tenant_fname', 
									  tenant_lname = '$tenant_lname',
									  property_agent = '$agent_name', 
									  contact_owner = '$owner_contact', 
									  contact_agent = '$agent_contact', 
									  contact_tenant = '$tenant_contact', 
									  property_street = '$street', 
									  property_suburb = '$suburb', 
									  property_state = '$state', 
									  property_postcode = '$post', 
									  image = '$filePath', 
									  user_id = '$current_user'
									  WHERE property_id = '$propertyID'";
		}else {
			echo "Sorry, there was an error uploading your file.";
		}
	}
} elseif(empty($_FILE['photo']['name'])){

	$image_sql = "SELECT image FROM property WHERE property_id='$propertyID'";
    $image_result = mysql_query($image_sql);
              while ($row = mysql_fetch_array($image_result)) {
                $current_image = $row['image'];
              }
	$sql="UPDATE property SET owner_id = '$owner_id',
							  agent_id = '$agent_id',
							  tenant_id = '$tenant_id', 
							  owner_fname = '$owner_fname', 
							  owner_lname = '$owner_lname',
							  tenant_fname = '$tenant_fname', 
							  tenant_lname = '$tenant_lname',
							  property_agent = '$agent_name', 
							  contact_owner = '$owner_contact', 
							  contact_agent = '$agent_contact', 
							  contact_tenant = '$tenant_contact', 
							  property_street = '$street', 
							  property_suburb = '$suburb', 
							  property_state = '$state', 
							  property_postcode = '$post', 
							  image = '$current_image', 
							  user_id = '$current_user'
							  WHERE property_id = '$propertyID'";
}

$result=mysql_query($sql);

//close connection
mysql_close();

echo "<script type='text/javascript'>";
echo "alert('You have edited the property successfully.');";
echo "window.close();";
echo "window.opener.location.reload();";
echo "</script>";

?>