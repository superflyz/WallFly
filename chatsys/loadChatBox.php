<?php

require_once(__DIR__.'/../classes/Database.php');

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
        $chatArray= [];
        $STH = $DBH->query("SELECT * FROM chat WHERE propertyID = '$pID' ORDER BY chat_id DESC ");

        $STH->setFetchMode(PDO::FETCH_OBJ);
        while($row = $STH->fetch()) {
           $chatArray[] = $row; 
        }

        echo json_encode($chatArray);
        #close db connection 
        $DBH = NULL;
        exit(); 


    }catch(PDOException $e) {
        echo "Unable to send message";
        file_put_contents(__DIR__.'/../Log/PDOErrorLog.txt', $e->getMessage(), FILE_APPEND);
        exit();
}