<?php
session_start();
 require_once(__DIR__.'/logincheck.php');
 require_once(__DIR__.'/classes/Database.php');
$checkUser = $_POST['username'];
$checkPassword = $_POST['password'];


 try{
        $DBH = Database::getInstance();
        $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }catch(PDOException $e) {
        echo "Unable to connect";
        file_put_contents('Log/PDOErrorLog.txt', $e->getMessage(), FILE_APPEND);
    }

try{


	//execute the SQL query and return records
	$statement = $DBH->prepare("SELECT * FROM user WHERE username=:checkUser and password=:checkPassword");
	$statement->execute(array(':$checkUser'=>$checkUser,':$checkPassword'=>$checkPassword));
	$statement ->setFetchMode(PDO::FETCH_OBJ);

	//If result matched $check_user and $check_password, table row must be 1 row
	if($statement->rowCount() == 1) {
		$row = $statement->fetch();
		//session expire setup
		$_SESSION["expiration"] = time() + 1800;
		
		//session user setup
		$_SESSION["usertype"] = $row->privilege;
		$_SESSION["username"] = $row->username;
		//close database
		$DBH = NULL;
		header("location:home.php");
		exit();
	}else{
		//close database
		$DBH = NULL;
		header("Location:timedout.php");

		exit();
		
	}



}catch(PDOException $e) {
        echo "Problem logging in";
        file_put_contents('Log/PDOErrorLog.txt', $e->getMessage(), FILE_APPEND);
    }
?>