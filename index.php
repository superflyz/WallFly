<?php 
    session_start();
    require_once(__DIR__.'/classes/Database.php');
    
     //error vars
    $usernameErr = $passwordErr = $first_nameErr = $last_nameErr = $emailErr = $usertypeErr ="";
    //form vars
    $username = $password = $first_name = $last_name = $email = $usertype = "";
    $validform = true;
    $pattern = '#^[a-z0-9\x20]+$#i';

    function test_input($data) {
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }

    if ($username != '') {
        header("Location: home.php");
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

    function add_databse() {
       
    }
?>

<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Wall Fly</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <!-- JQuery Validate Plugin-->
    <script src="http://cdn.jsdelivr.net/jquery.validation/1.14.0/jquery.validate.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/additional-methods.js"></script>
    <script type="text/javascript" src="js/index.js"></script>


    
</head>

<body>
    <style type="text/css">

    .error {
        color: red;
    }

    #signup_form label.error {
        color: red;
    }
    
    #signup_form input.error {
        border: 1px solid red;
    }
    </style>
    

    <div class="container-fluid3">
        <div class="row">
            <div class="col-md-12">
                <img src="img/logo.jpg">
            </div>
        </div>
        <div class="row row-centered">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <form id="login" name="login" method="post" action="login.php">
                    <!--<div class="input-group">-->
                    <input name="username" type="text" id="username" class="form-control" placeholder="Username">
                    <!--</div>-->
                    <!--<div class="input-group">-->
                    <input name="password" type="password" id="password" class="form-control" placeholder="Password">
                    <!--</div>-->
                    <br>
                   <!--  <input class="btn btn-warning" type="reset" class="button" value="Reset"> -->
                    <input type="submit" name="Submit" value="Login" id="login_btn" class="btn btn-success custom">
                  
                </form>
                <br>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-success custom" data-toggle="modal" data-target="#signup" onclick="clearForm()">
                    Sign Up
                </button>
                <!-- Modal -->
                <div class="modal fade" id="signup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog modal-sm " role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Wallfly Sign Up</h4>
                            </div>
                            <div class="modal-body">
                                <form id="signup_form" name="signup_form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                    <!-- <label for="username">Username</label> -->
                                    <input class="form-control" type="text" size="12" name="username" placeholder="Username" value="<?php echo $username ?>" id="usrname"/>
                                    <span class="error"><?php echo $usernameErr;?></span>
                                    <br>
                                    <!-- <label for="password">Password</label> -->
                                    <input class="form-control" type="password" size="12" name="password" placeholder="Password" value="<?php echo $password ?>" id="psswrd"/>
                                    <span class="error"><?php echo $passwordErr;?></span>
                                    <br>
                                    <!-- <label for="first_name">First Name</label> -->
                                    <input class="form-control" type='text' name='first_name' maxlength='50' size='30' placeholder='First Name' value="<?php echo $first_name ?>" id="fname"/>
                                    <span class="error"><?php echo $first_nameErr;?></span>
                                    <br>
                                    <!-- <label for="last_name">Last Name</label> -->
                                    <input class="form-control" type='text' name='last_name' maxlength='50' size='30' placeholder='Last Name' value="<?php echo $last_name ?>" id="lname"/>
                                    <span class="error"><?php echo $last_nameErr;?></span>
                                    <br>
                                    <!-- <label for="email">Email Address</label> -->
                                    <input class="form-control" type="text" name="email" maxlength="50" size="12" placeholder='Email Address' value="<?php echo $email ?>" id="email"/>
                                    <span class="error"><?php echo $emailErr;?></span>
                                    <br>
                                    <!-- <label for="usertype">User Type</label> -->
                                    <select class="form-control" name="usertype" placeholder='Please Select'>
                                        <option value="">Please Select</option>
                                        <option value="AGENT">Agent</option>
                                        <option value="OWNER">Owner</option>
                                        <option value="TENANT">Tenant</option>
                                    </select>
                                    <span class="error"><?php echo $usertypeErr;?></span>
                            </div>
                            <div class="modal-footer">
                                <input class="btn btn-success" type="submit" name="btnAdd" value="Add"> &nbsp;&nbsp;
                                <input class="btn btn-warning" type="reset" class="button" value="Reset"> &nbsp;&nbsp;
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  <button type="button" class="btn btn-success custom" onclick="javascript:void window.open('signup_popup.php','1428456850982','width=500, height=350,toolbar=0,menubar=0,location=0,status=0,scrollbars=1,resizable=1,left=0,top=0');return false;">Sign Up</button> -->
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>

    <?php
        if($validform == false) {
             echo "<script type='text/javascript'> openModal(); </script>";
             exit();
        }
        if(isset($_SESSION["signedUp"]) && $_SESSION["signedUp"] == "true") {
            $_SESSION["signedUp"] = "";
            //database adding
             try{
                $DBH = Database::getInstance();
                $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            } catch(PDOException $e) {
                echo "Unable to connect";
                file_put_contents('Log/PDOErrorLog.txt', $e->getMessage(), FILE_APPEND);
            }

            # query db for username
            $STH = $DBH->query("SELECT username FROM user WHERE username='$username'");
 
           
            # setting the fetch mode
            $STH->setFetchMode(PDO::FETCH_OBJ);
             
            # handling the results
            if($STH->rowCount() > 0) {
            
                echo "<script type='text/javascript'>";
                echo "alert('The username is already taken!');";
                echo "openModal()";
                echo "</script>";
                exit();
            }

            $statement = $DBH->prepare("INSERT INTO user(username, password, privilege, email, first_name, last_name)
            VALUES(:username, :password, :usertype, :email, :first_name, :last_name)");
            $statement->execute(array(
            "username" => $username,
            "password" => $password,
            "usertype" => $usertype,
            "email" => $email,
            "first_name" => $first_name,
            "last_name" => $last_name
            ));
            #close db connection 
            $DBH = NULL; 
            #clear the saved form
            $_POST = array();
            $username = $password = $first_name = $last_name = $email = $usertype = "";

            echo "<script type='text/javascript'>";
            echo "alert('Thank you for signing up');";
            echo "</script>";
            exit();
        }
        if(isset($_SESSION["signedUp"]) && $_SESSION["signedUp"] == "false") {
            $_SESSION["signedUp"] = "";
            echo "<script type='text/javascript'>";
            echo "alert('Thank you for signing up');";
            echo "</script>";
            exit();
        }
        if(isset($_SESSION["triedLogin"]) && $_SESSION["triedLogin"] == "true") {
            $_SESSION["triedLogin"] = "";
            echo "<script type='text/javascript'>";
            echo "alert('The username is already taken!');";
            echo "openModal()";
            echo "</script>";
            exit();
        }

        
    ?>

</body>


</html>
