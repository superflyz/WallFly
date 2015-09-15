<?php
//Gets a username and password and tries to log the user in if they are valid
session_start();
require_once(__DIR__ . '/classes/Database.php');
include(__DIR__ . "/classes/securepassword.php");

$checkUser = $_POST['username'];
$checkPassword = $_POST['password'];
$_SESSION['loginError'] = "";


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
            $_SESSION['userId'] = $result->username;
            $_SESSION['userFirstName'] = $result->first_name;
            $_SESSION['userLastName'] = $result->last_name;
            $_SESSION['userEmail'] = $result->email;
            header("location:dashboard.php");
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
    //close database
    $DBH = NULL;

} catch (PDOException $e) {
    echo "Problem logging in";
    file_put_contents('Log/PDOErrorLog.txt', $e->getMessage(), FILE_APPEND);
}
?>
