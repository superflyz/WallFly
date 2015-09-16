<?php

require_once(__DIR__ . '/../classes/Database.php');
$date = date("Y-m-d H:i:s");
$user = $_POST['user'];
$message = $_POST['message'];
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

//enter chat message into Database
try {

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

} catch (PDOException $e) {
    echo "Unable to send message";
    file_put_contents(__DIR__ . '/../Log/PDOErrorLog.txt', $e->getMessage(), FILE_APPEND);
    exit();
}

