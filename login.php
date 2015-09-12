<?php

session_start();
require_once(__DIR__.'/classes/Database.php');
include (__DIR__ . "/classes/securepassword.php");

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
	//$check_user = mysql_real_escape_string($check_user);
	//$check_password = mysql_real_escape_string($check_password);
	$securepass = new SecurePassword;
	$hashedpassword = $securepass->create_hash($check_password);





	//execute the SQL query and return records
  $statement = $DBH->prepare("SELECT * FROM user WHERE username=:username");
  $statement->execute(['username' => $check_user]);
	$result = $statement->fetch(PDO::FETCH_OBJ);

  if ($result) {
    $comparehash = $securepass->validate_password($check_password, $result->password);

    if ($comparehash) {
      //session expire setup
			$_SESSION["expiration"] = time() + 1800;

			//session user setup
			$_SESSION["usertype"] = $result->privilege;
			$_SESSION["username"] = $result->username;
			$_SESSION['userId'] = $result->username;
			$_SESSION['userFirstName'] = $result->first_name;
			$_SESSION['userLastName'] = $result->last_name;
			$_SESSION['userEmail'] = $result->email;
			header("location:home.php");
			exit();
    } else {
      $_SESSION['loginError'] = "Incorrect Login Details 123";
      header("Location:index.php");
      exit();
    }
  } else {
    $_SESSION['loginError'] = "Incorrect Login Details 456";
    header("Location:index.php");
    exit();
  }

	//Mysql_num_row is counting table row
	//$count = mysql_num_rows($result);

	//If result matched $check_user and $check_password, table row must be 1 row
  // var_dump($STH->rowCount()); // 0
	// if($STH->rowCount() == 1) {
	// 	$row = $STH->fetch();
  //
  //   // var_dump($row);
  //   // var_dump($row->password);
  //   // var_dump($check_password);
	// 	if($comparehash){
	// 		//session expire setup
	// 		$_SESSION["expiration"] = time() + 1800;
  //
	// 		//session user setup
	// 		$_SESSION["usertype"] = $row->privilege;
	// 		$_SESSION["username"] = $row->username;
	// 		$_SESSION['userId'] = $row->username;
	// 		$_SESSION['userFirstName'] = $row->first_name;
	// 		$_SESSION['userLastName'] = $row->last_name;
	// 		$_SESSION['userEmail'] = $row->email;
	// 		header("location:home.php");
	// 		exit();
	// 	}else{
  //
	// 		$_SESSION['loginError'] = "Incorrect Login Details  123";
  //           header("Location:index.php");
  //           exit();
	// 	}
  //
  //
  //
  //
	// }else{
	// 	$_SESSION['loginError'] = "Incorrect Login Details 456";
	// 	header("Location:index.php");
	// 	exit();
  //
	// }

	//close database
	$DBH = NULL;

}catch(PDOException $e) {
        echo "Problem logging in";
        file_put_contents('Log/PDOErrorLog.txt', $e->getMessage(), FILE_APPEND);
    }
?>
