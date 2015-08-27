 <?php

    class Validator {
  
    //error vars
    private $usernameErr = "";
	private $passwordErr ="";
	private $first_nameErr = "";
	private $last_nameErr = "";
	private $emailErr = "";
	private $usertypeErr = "";
	
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
            $usernameErr = "Must Enter a Valid Username";
            $validform = false;
        }
        else {
            $username = $this->test_input($this->username);
        }

        if ( (empty( $this->password )) || (!ctype_alnum( $this->password )) || (strlen( $this->password ) < 6) ) {
            $passwordErr = "Must Enter a Valid Password";
            $validform = false;
        }
        else {
            $password = test_input($password);
        }

        if ( (empty($first_name))|| (strlen($first_name) < 3)) {
            $first_nameErr = "Must Enter a Valid First Name";
            $validform = false;
        }
        else {
            $first_name = test_input($first_name);
        }

        if ( (empty($last_name)) || (strlen($last_name) < 3) ) {
            $last_nameErr = "Must Enter a Valid Last Name";
            $validform = false;
        }
        else {
            $last_name = test_input($last_name);
        }

        if ( (empty($email)) || (!filter_var($email, FILTER_VALIDATE_EMAIL)) ) {
            $emailErr = "Correct Email is Required";
            $validform = false;
        }
        else {
            $email = test_input($email);
        }

        if (empty($usertype)) {
            $usertypeErr = "Correct User Type is Required";
            $validform = false;
        }
        else {
            $usertype = $this->test_input($usertype);
        } 
		
		return $array = array($validform,$usernameErr,$passwordErr,$first_nameErr,$last_nameErr,$emailErr,$this->usertypeErr);
		
    }


}



    

    

?>