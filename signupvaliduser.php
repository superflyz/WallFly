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
            $STH2 = $DBH->query("SELECT email FROM user WHERE email='$email'");
 
           
            # setting the fetch mode
            $STH->setFetchMode(PDO::FETCH_OBJ);
            
             
            # handling the results
            if($STH->rowCount() > 0) {
            
                echo "<script type='text/javascript'>";
                echo "alert('Sorry that username already exits');";
                echo "openModal()";
                echo "</script>";
                exit();
            }else{

            $STH3 = $DBH->prepare("INSERT INTO user(username, password, privilege, email, first_name, last_name)
            VALUES(:username, :password, :usertype, :email, :first_name, :last_name)");
            $STH3->execute(array(
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
            header('Location: signupmessage.php');
            exit();
        }

            
        

        
    ?>