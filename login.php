<?php

session_start();
require_once(__DIR__.'/classes/Database.php');
include ("/classes/securepassword.php");

$check_user = $_POST['username'];
$check_password = $_POST['password'];
$_SESSION['loginError'] = "";



 try{
        $DBH = Database::getInstance();
        $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }catch(PDOException $e) {
        echo "Unable to connect";
        file_put_contents('Log/PDOErrorLog.txt', $e->getMessage(), FILE_APPEND);
    }

try{

	//To protect MySQL injection
	$check_user = stripslashes($check_user);
	$check_password = stripcslashes($check_password);
	$check_user = mysql_real_escape_string($check_user);
	$check_password = mysql_real_escape_string($check_password);
	$securepass = new SecurePassword;
	$hashedpassword = $securepass->create_hash($check_password);
	

	


	//execute the SQL query and return records
	$STH = $DBH->query("SELECT * FROM user WHERE username = '$check_user' ");
	$STH->setFetchMode(PDO::FETCH_OBJ);

	//Mysql_num_row is counting table row
	//$count = mysql_num_rows($result);

	//If result matched $check_user and $check_password, table row must be 1 row
	if($STH->rowCount() == 1) {
		$row = $STH->fetch();
		$comparehash = $securepass-> validate_password($check_password, $row->password);
		if($comparehash){
			//session expire setup
			$_SESSION["expiration"] = time() + 1800;
			
			//session user setup
			$_SESSION["usertype"] = $row->privilege;
			$_SESSION["username"] = $row->username;
			header("location:home.php");
			exit();
		}else{

			$_SESSION['loginError'] = "Incorrect Login Details";
            header("Location:index.php");
            exit();
		}
		


		
	}else{
		$_SESSION['loginError'] = "Incorrect Login Details";
		header("Location:index.php");
		exit();
		
	}

	//close database
	$DBH = NULL;

}catch(PDOException $e) {
        echo "Problem logging in";
        file_put_contents('Log/PDOErrorLog.txt', $e->getMessage(), FILE_APPEND);
    }
?>