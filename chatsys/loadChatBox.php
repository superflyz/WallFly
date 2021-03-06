<?php
session_start();
require_once(__DIR__ . '/../classes/Database.php');

$pID = $_POST['pID'];

//initialise Database Handler
try {
    $DBH = Database::getInstance();
    $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "Unable to connect";
    file_put_contents(__DIR__ . '/../Log/PDOErrorLog.txt', $e->getMessage(), FILE_APPEND);
    exit();
}

//return rows related to the property ID in json string
try {
    $chatArray = [];
    $statement = $DBH->prepare("SELECT * FROM chat WHERE propertyID = :pID ORDER BY chat_id ASC ");
    $statement->bindParam(':pID', $pID);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_OBJ)) {
        $chatArray[] = $row;
    }
    echo json_encode($chatArray);
    #close db connection
    $DBH = NULL;
    exit();


} catch (PDOException $e) {
    echo "Unable to get messages";
    file_put_contents(__DIR__ . '/../Log/PDOErrorLog.txt', $e->getMessage(), FILE_APPEND);
    exit();
}


