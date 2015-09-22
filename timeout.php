<?php
session_start();
require_once(__DIR__ . '/logincheck.php');
require_once(__DIR__ . '/classes/Database.php');
include(__DIR__ . "/classes/SecurePassword.php");
$checkUser = $_POST['username'];
$checkPassword = $_POST['password'];


try {
    $DBH = Database::getInstance();
    $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Unable to connect";
    file_put_contents('Log/PDOErrorLog.txt', $e->getMessage(), FILE_APPEND);
}

try {
    $securePass = new SecurePassword;
    //execute the SQL query and return records
    $statement = $DBH->prepare("SELECT * FROM user WHERE username=:username");
    $statement->execute(['username' => $checkUser]);
    $result = $statement->fetch(PDO::FETCH_OBJ);
    if ($result) {
        $comparehash = $securePass->validate_password($checkPassword, $result->password);
        if ($comparehash) {
            //session expire setup
            $_SESSION["expiration"] = time() + 1800;

            //session user setup
            $_SESSION["usertype"] = $result->privilege;
            $_SESSION["username"] = $result->username;
            //close database
            $DBH = NULL;
            header("location:home.php");
            exit();
        } else {
            //close database
            $DBH = NULL;
            header("Location:timedout.php");
            exit();
        }
    }
} catch (PDOException $e) {
    //close database
    $DBH = NULL;
    echo "Problem logging in";
    file_put_contents('Log/PDOErrorLog.txt', $e->getMessage(), FILE_APPEND);
}
?>