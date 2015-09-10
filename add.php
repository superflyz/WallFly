<?php
$username = "admin";
$password = "password";
$hostname = "localhost"; 

//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password)
 or die("Unable to connect to MySQL");

//select a database to work with
$selected = mysql_select_db("wallflydb",$dbhandle)
  or die("Could not select database");

session_start();
$current_user = $_SESSION['username'];
$usertype = $_SESSION['usertype'];
if ($usertype == "TENANT") {

	exit("Sorry, You don't have permission to add a property.");

}

//Check user's name
$sql_get_name = "SELECT first_name, last_name FROM user WHERE username = '$current_user'";
$result_get_name = mysql_query($sql_get_name);
while($row = mysql_fetch_array($result_get_name)){
	$firstname = $row['first_name'];
	$lastname = $row['last_name'];
}


//Get values from form
if($usertype == "AGENT"){
	$owner_id=$_POST['ownerID'];
	$agent_id=$current_user;
	$tenant_id=$_POST['tenantID'];
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
	$post=$_POST['post'];
	$uploadDir = "img/properties/"; //Image upload folder
}elseif($usertype == "OWNER"){
	$owner_id=$current_user;
	$agent_id=$_POST['agentID'];
	$tenant_id=$_POST['tenantID'];
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
	$post=$_POST['post'];
	$uploadDir = "img/properties/"; //Image upload folder
}



//Insert data into mysql
//$sql="INSERT INTO property(property_owner, property_agent, property_tenant, contact_owner, contact_agent, contact_tenant, property_street, property_suburb, property_state, property_postcode)
//VALUES ('$owner_name', '$agent_name', '$tenant_name', '$owner_contact', '$agent_contact', '$tenant_contact', '$street', '$suburb', '$state', '$post')";

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
	//$fileName = $_FILES['photo']['name'];
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
			$sql="INSERT INTO property(owner_id, agent_id, tenant_id, owner_fname, owner_lname, tenant_fname, tenant_lname, property_agent, contact_owner, contact_agent, contact_tenant, property_street, property_suburb, property_state, property_postcode, image, user_id)
			VALUES ('$owner_id', '$agent_id', '$tenant_id','$owner_fname', '$owner_lname', '$tenant_fname', '$tenant_lname', '$agent_name', '$owner_contact', '$agent_contact', '$tenant_contact', '$street', '$suburb', '$state', '$post', '$filePath', '$current_user')";
		}else {
			echo "Sorry, there was an error uploading your file.";
		}
	}
} elseif(empty($_FILE['photo']['name'])){
	$default_image = "img/properties/default_banner.gif";
	$sql="INSERT INTO property(owner_id, agent_id, tenant_id, owner_fname, owner_lname, tenant_fname, tenant_lname, property_agent, contact_owner, contact_agent, contact_tenant, property_street, property_suburb, property_state, property_postcode, image, user_id)
			VALUES ('$owner_id', '$agent_id', '$tenant_id', '$owner_fname', '$owner_lname', '$tenant_fname', '$tenant_lname', '$agent_name', '$owner_contact', '$agent_contact', '$tenant_contact', '$street', '$suburb', '$state', '$post','$default_image', '$current_user')";
}

$result=mysql_query($sql);


//close connection
mysql_close();

echo "<script type='text/javascript'>";
echo "alert('You have added the property successfully.');";
echo "window.close();";
echo "window.opener.location.reload();";
echo "</script>";

?>