<?php
  session_start();
  require_once(__DIR__.'/classes/Database.php');

  $property_id = $_SESSION['propertyId'];
  $usertype = $_SESSION['usertype'];
  $username = $_SESSION['username'];
  echo $username;


////storing the image that user uploads while making repair request
////directory where the image will be saved
//$target_dir = "img/repair/";
//
////target image
//$target_file = $target_dir . basename($_FILES["repair_image"]["name"]);
////var_dump($target_file);
//$uploadOk = 1;
//$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
//// Check if image file is a actual image or fake image
//if(isset($_POST["submit"])) {
//    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
//    if($check !== false) {
//        echo "File is an image - " . $check["mime"] . ".";
//        $uploadOk = 1;
//    } else {
//        echo "File is not an image.";
//        $uploadOk = 0;
//    }
//    if($uploadOk == 1){
//        move_uploaded_file($_FILES["repair_image"]["name"], $target_file);
//    }else{
//        echo "File is not an image.";
//    }
//}

$fileName = $_FILES['repair_image']['name'];
//var_dump($_POST);
$uploadDir = 'img/repair/';
$target_file = $uploadDir . basename($fileName);
echo $target_file;
if($_FILES['repair_image']['size'] > 0){
	function random_string($length) {
    $key = '';
    $keys = array_merge(range(0, 9), range('a', 'z'));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $key;
	}
    
	$tmpName = $_FILES['repair_image']['tmp_name'];
	$fileSize = $_FILES['repair_image']['size'];
	$fileType = $_FILES['repair_image']['type'];
	
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
	if (file_exists($target_file)){
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
		$result_upload = move_uploaded_file($tmpName, $target_file);
    }

}
//storing the deatils of the user while they make requests
$firstname = $_POST['first_name'];
$lastname = $_POST['last_name'];
$subject = $_POST['subject'];
$message = $_POST['request'];
$approval = 0;




try{
        $DBH = Database::getInstance();
        $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        
    }catch(PDOException $e) {
        echo "Unable to connect";
        file_put_contents(__DIR__.'/../Log/PDOErrorLog.txt', $e->getMessage(), FILE_APPEND);
        exit();
    }

    try{
        
            $STH = $DBH->prepare("SELECT user_id FROM user WHERE username=:username");
            $STH->bindParam(":username", $username);
            $STH->execute();
            $result = $STH->fetch(PDO::FETCH_ASSOC);
	        $userdatabase_id = $result['user_id'];
            echo $userdatabase_id;


        $statement = $DBH->prepare("INSERT INTO repairs(user_id, property_id, first_name, last_name, subject, request, approval,                                    img_path)
            VALUES (:user_id, :property_id, :first_name, :last_name, :subject, :request, :approval,                                                    :img_path)");
            $result = $statement->execute(array(
            "user_id" => $userdatabase_id,
            "property_id" => $property_id,            
            "first_name"  => $firstname,
            "last_name"   => $lastname,
            "subject"     => $subject,
            "request"     => $message,
            "approval"    => $approval,                                  
            "img_path"    => $target_file
            ));
            #close db connection 
            $DBH = NULL;
            exit(); 


    }catch(PDOException $e) {
        echo "Unable to send message";
        file_put_contents(__DIR__.'/../Log/PDOErrorLog.txt', $e->getMessage(), FILE_APPEND);
        exit();
}

