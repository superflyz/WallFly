<?php
include("SecurePassword.php");

class Validator
{


    //error vars
    private $userNameErr = "";
    private $passwordErr = "";
    private $firstNameErr = "";
    private $lastNameErr = "";
    private $emailErr = "";
    private $typeErr = "";

    //form vars
    private $userName = "";
    private $password = "";
    private $firstName = "";
    private $lastName = "";
    private $email = "";
    private $userType = "";
    private $validForm = true;
    private $pattern = '#^[a-z0-9\x20]+$#i';


    public function testInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


    public function validForm($user, $pass, $first, $last, $mail, $userType)
    {

        $this->userName = $user;
        $this->password = $pass;
        $this->firstName = $first;
        $this->lastName = $last;
        $this->email = $mail;
        $this->userType = $userType;

        // process the form
        if ((empty($this->userName)) || (!preg_match($this->pattern, $this->userName)) || (strlen($this->userName) < 5)) {
            $this->userNameErr = "Must Enter a Valid Username";
            $this->validForm = false;
        } else {
            $this->userName = $this->testInput($this->userName);
        }

        if ((empty($this->password)) || (!ctype_alnum($this->password)) || (strlen($this->password) < 6)) {
            $this->passwordErr = "Must Enter a Valid Password";
            $this->validForm = false;
        } else {
            $this->password = $this->testInput($this->password);
        }

        if ((empty($this->firstName)) || (strlen($this->firstName) < 3)) {
            $this->firstNameErr = "Must Enter a Valid First Name";
            $this->validForm = false;
        } else {
            $this->firstName = $this->testInput($this->firstName);
        }

        if ((empty($this->lastName)) || (strlen($this->lastName) < 3)) {
            $this->lastNameErr = "Must Enter a Valid Last Name";
            $this->validForm = false;
        } else {
            $this->lastName = $this->testInput($this->lastName);
        }

        if ((empty($this->email)) || (!filter_var($this->email, FILTER_VALIDATE_EMAIL))) {
            $this->emailErr = "Correct Email is Required";
            $this->validForm = false;
        } else {
            $this->email = $this->testInput($this->email);
        }

        if (empty($userType)) {
            $this->typeErr = "Correct User Type is Required";
            $this->validForm = false;
        } else {
            $this->userType = $this->testInput($this->userType);
        }

        if ($this->validForm == true) {
            $_SESSION['signedUp'] = "true";
        } else {
            $_SESSION['signedUp'] = "false";
        }

        return $array = array($this->validForm, $this->userNameErr, $this->passwordErr, $this->firstNameErr, $this->lastNameErr, $this->emailErr, $this->typeErr, $this->userName,
            $this->password, $this->firstName, $this->lastName, $this->email, $this->userType);

    }
}


/**
 *
 */
class SignUpValidUser
{

    private $valid = "";
    private $hashedPassword = "";


    public function enterNewUser($validForm, $userName, $password, $userType, $email, $firstName, $lastName)
    {
        $this->valid = $validForm;
        if ($this->valid == false) {
            echo "<script type='text/javascript'> openModal(); </script>";
            exit();
        }
        if (isset($_SESSION["signedUp"]) && $_SESSION["signedUp"] == "true") {
            $_SESSION["signedUp"] = "";
            //database adding
            try {
                $DBH = Database::getInstance();
                $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Unable to connect";
                file_put_contents('Log/PDOErrorLog.txt', $e->getMessage(), FILE_APPEND);
            }

            # query db for username
            $statement = $DBH->prepare("SELECT username FROM user WHERE username=:userName");
            $statement->bindParam(':userName', $userName);
            $statement2 = $DBH->prepare("SELECT email FROM user WHERE email=:email");
            $statement2->bindParam(':email', $email);
            $statement->execute();
            $statement2->execute();

            # setting the fetch mode
            $statement->setFetchMode(PDO::FETCH_OBJ);
            $statement2->setFetchMode(PDO::FETCH_OBJ);

            # handling the results
            if ($statement->rowCount() > 0) {

                echo "<script type='text/javascript'>";
                echo 'sweetAlert("Sorry", "That username already exists", "error");';
//                echo "alert('Sorry that username already exists');";
                echo "openModal()";
                echo "</script>";
                exit();
            } elseif ($statement2->rowCount() > 0) {

                echo "<script type='text/javascript'>";
                echo 'sweetAlert("Sorry", "That email is already registered", "error");';
//                echo "alert('Sorry that email is already registered');";
                echo "openModal()";
                echo "</script>";
                exit();

            } else {
                $securePass = new SecurePassword;
                $this->hashedPassword = $securePass->create_hash($password);


                $statement3 = $DBH->prepare("INSERT INTO user(username, password, privilege, email, first_name, last_name)
                    VALUES(:username, :password, :usertype, :email, :first_name, :last_name)");
                $result = $statement3->execute(array(
                    "username" => $userName,
                    "password" => $this->hashedPassword,
                    "usertype" => $userType,
                    "email" => $email,
                    "first_name" => $firstName,
                    "last_name" => $lastName
                ));
                #close db connection
                $DBH = NULL;
                #clear the saved form
                $_POST = array();
                $userName = $password = $firstName = $lastName = $email = $userType = "";
                $_SESSION[newSignUp] = 'true';
                header('Location: index.php');
                exit();
            }


        }


    }


}

?>