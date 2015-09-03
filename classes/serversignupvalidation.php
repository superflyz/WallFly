 <?php
    include ("securepassword.php");
    class Validator {
    


    //error vars
    private $usernameErr = "";
	private $passwordErr ="";
	private $first_nameErr = "";
	private $last_nameErr = "";
	private $emailErr = "";
	private $typeErr = "";
	
    //form vars
    private $username = "";
	private $password = "";
	private $first_name = "";
	private $last_name = "";
	private $email = "";
	private $usertype = "";
    private $validform = true;
    private $pattern = '#^[a-z0-9\x20]+$#i';


    public function test_input($data) {
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }


    public function validform($user,$pass,$first,$last,$mail,$usertype){

        $this->username = $user;
        $this->password = $pass;
        $this->first_name = $first;
        $this->last_name = $last;
        $this->email = $mail;
        $this->usertype = $usertype;

        // process the form
        if ( (empty($this->username)) || (!preg_match($this->pattern,$this->username)) || (strlen($this->username) < 5) ) {
            $this->usernameErr = "Must Enter a Valid Username";
            $this->validform = false;
        }
        else {
            $this->username = $this->test_input($this->username);
        }

        if ( (empty($this->password)) || (!ctype_alnum($this->password)) || (strlen($this->password) < 6) ) {
            $this->passwordErr = "Must Enter a Valid Password";
            $this->validform = false;
        }
        else {
            $this->password = $this->test_input($this->password);
        }

        if ( (empty($this->first_name))|| (strlen($this->first_name) < 3)) {
            $this->first_nameErr = "Must Enter a Valid First Name";
            $this->validform = false;
        }
        else {
            $this->first_name = $this->test_input($this->first_name);
        }

        if ( (empty($this->last_name)) || (strlen($this->last_name) < 3) ) {
            $this->last_nameErr = "Must Enter a Valid Last Name";
            $this->validform = false;
        }
        else {
            $this->last_name = $this->test_input($this->last_name);
        }

        if ( (empty($this->email)) || (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) ) {
            $this->emailErr = "Correct Email is Required";
            $this->validform = false;
        }
        else {
            $this->email = $this->test_input($this->email);
        }

        if (empty($usertype)) {
            $this->typeErr = "Correct User Type is Required";
            $this->validform = false;
        }
        else {
            $this->usertype = $this->test_input($this->usertype);
        } 

        if($this->validform == true) {
            $_SESSION['signedUp'] = "true";
        } else {
            $_SESSION['signedUp'] = "false";
        }
		
		return $array = array($this->validform,$this->usernameErr,$this->passwordErr,$this->first_nameErr,$this->last_nameErr,$this->emailErr,$this->typeErr,$this->username,
        $this->password,$this->first_name,$this->last_name,$this->email,$this->usertype);
		
        }
    }


    /**
    * 
    */
    class SignUpValiduser
    {   
        
        private $valid = ""; 
        private $hashedpassword = "";
       



       public function enterNewUser($validform,$username,$password,$usertype,$email,$first_name,$last_name){
        $this->valid = $validform;
        if($this->valid == false) {
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
            $STH2 = $DBH->query("SELECT email FROM user WHERE email='$email'");
 
           
            # setting the fetch mode
            $STH->setFetchMode(PDO::FETCH_OBJ);
            $STH2->setFetchMode(PDO::FETCH_OBJ);
             
            # handling the results
            if($STH->rowCount() > 0) {
            
                echo "<script type='text/javascript'>";
                echo "alert('Sorry that username already exists');";
                echo "openModal()";
                echo "</script>";
                exit();
            }elseif($STH2->rowCount() > 0){

                echo "<script type='text/javascript'>";
                echo "alert('Sorry that email is already registered');";
                echo "openModal()";
                echo "</script>";
                exit();

            }else{
             $securepass = new SecurePassword;
             $this->hashedpassword = $securepass->create_hash($password);
            

            $statement = $DBH->prepare("INSERT INTO user(username, password, privilege, email, first_name, last_name)
            VALUES(:username, :password, :usertype, :email, :first_name, :last_name)");
            $result = $statement->execute(array(
            "username" => $username,
            "password" => $this->hashedpassword,
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
            header('Location: signupmessage.php');
            exit();
        }

            
        }

         
        }


       
    }

?>