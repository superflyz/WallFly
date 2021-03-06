<?php

require_once(__DIR__.'/classes/Database.php');
session_start();

$property_id = $_SESSION['propertyId'];
$usertype = $_SESSION['usertype'];
$username = $_SESSION['username'];
$repair_id = $_POST['repair_id'];

try{
    $DBH = Database::getInstance();
    $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

} catch (PDOException $e) {
    echo "Unable to connect";
//            file_put_contents(__DIR__.'/../Log/PDOErrorLog.txt', $e->getMessage(), FILE_APPEND);
    exit();
}

try{

    $STH = $DBH->prepare("UPDATE repairs SET approval = 1 WHERE repair_id=:repair_id");
    $STH->bindParam(":repair_id",$repair_id);
    $STH->execute();

    #close db connection 
    $DBH = NULL;
    header("Location: property_details.php?id=$property_id&approve=1");
    exit();


}catch(PDOException $e) {
    echo "Unable to send message: " . $e->getMessage();
//            file_put_contents(__DIR__.'/../Log/PDOErrorLog.txt', $e->getMessage(), FILE_APPEND);
    exit();
}

?>