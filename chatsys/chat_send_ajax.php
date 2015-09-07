<?php

     // require_once('dbconnect.php');

     // db_connect();

     // $msg = $_GET["msg"];
     // $dt = date("Y-m-d H:i:s");
     // $user = $_GET["name"];

     // $sql="INSERT INTO chat(USERNAME,CHATDATE,MSG) " .
     //      "values(" . quote($user) . "," . quote($dt) . "," . quote($msg) . ");";

     //      echo $sql;

     // $result = mysql_query($sql);
     // if(!$result)
     // {
     //    throw new Exception('Query failed: ' . mysql_error());
     //    exit();
     // }

require_once(__DIR__.'/../classes/Database.php');
$date = date("Y-m-d H:i:s");
$user = $_POST['user'];
$message = $_POST['message'];
$pID = $_POST['pID'];
    
    try{
        $DBH = Database::getInstance();
        $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        
    }catch(PDOException $e) {
        echo "Unable to connect";
        file_put_contents(__DIR__.'/../Log/PDOErrorLog.txt', $e->getMessage(), FILE_APPEND);
        exit();
    }

    try{

        $statement = $DBH->prepare("INSERT INTO chat(propertyID, username, chatdate, msg)
            VALUES(:propertyID, :username, :chatdate, :message)");
            $result = $statement->execute(array(
            "propertyID" => $pID,
            "username" => $user,
            "chatdate" => $date,
            "message" => $message
            ));
            #close db connection 
            $DBH = NULL;
            exit(); 


    }catch(PDOException $e) {
        echo "Unable to send message";
        file_put_contents(__DIR__.'/../Log/PDOErrorLog.txt', $e->getMessage(), FILE_APPEND);
        exit();
}

