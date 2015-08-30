 <?php

    class Validator {
    private $alive = true;
    //error vars
    private $usernameErr = $passwordErr = $first_nameErr = $last_nameErr = $emailErr = $usertypeErr ="";
    //form vars
    private $username = $password = $first_name = $last_name = $email = $usertype = "";
    private $validform = true;
    private $pattern = '#^[a-z0-9\x20]+$#i';


    function test_input($data) {
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }


    function validateform($user,$pass,$first,$last,$mail,$user){

        this->$username = $user;
        this->$password = $pass;
        this->$first_name = $first;
        this->$last_name = $last;
        this->$email = $mail;
        this->$usertype = $user;

        if ($username != '') {
        header("Location: home.php");
        exit();
        }   

         if ($_SERVER["REQUEST_METHOD"] == "POST") { 
        // process the form
        if ( (empty($_POST["username"])) || (!preg_match($pattern, $_POST["username"])) || (strlen($_POST["username"]) < 5) ) {
            $usernameErr = "Must Enter a Valid Username";
            $validform = false;
        }
        else {
            $username = test_input($_POST["username"]);
        }

        if ( (empty($_POST["password"])) || (!ctype_alnum($_POST["password"])) || (strlen($_POST["password"]) < 6) ) {
            $passwordErr = "Must Enter a Valid Password";
            $validform = false;
        }
        else {
            $password = test_input($_POST["password"]);
        }

        if ( (empty($_POST["first_name"])) || (strlen($_POST["first_name"]) < 3) ) {
            $first_nameErr = "Must Enter a Valid First Name";
            $validform = false;
        }
        else {
            $first_name = test_input($_POST["first_name"]);
        }

        if ( (empty($_POST["last_name"])) || (strlen($_POST["last_name"]) < 3) ) {
            $last_nameErr = "Must Enter a Valid First Name";
            $validform = false;
        }
        else {
            $last_name = test_input($_POST["last_name"]);
        }

        if ( (empty($_POST["email"])) || (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) ) {
            $emailErr = "Correct Email is Required";
            $validform = false;
        }
        else {
            $email = test_input($_POST["email"]);
        }

        if (empty($_POST["usertype"])) {
            $usertypeErr = "Correct User Type is Required";
            $validform = false;
        }
        else {
            $usertype = test_input($_POST["usertype"]);
        } 

        if($validform == true) {
            $_SESSION['signedUp'] = "true";
        } else {
            $_SESSION['signedUp'] = "false";
        }
    }


}

}

$validate = new Validator;
$validate-> validform();

    

    

?>