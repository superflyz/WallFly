<?php
require_once(__DIR__ . '/../classes/Database.php');
$pID = $_POST['propertyID'];
try {
    $DBH = Database::getInstance();
    $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "Unable to connect";
    file_put_contents(__DIR__ . '/../Log/PDOErrorLog.txt', $e->getMessage(), FILE_APPEND);
    exit();
}

try {


    $result = $DBH->prepare("SELECT * FROM chat WHERE propertyID = :pID");
    $result->bindParam(':pID', $pID);
    $result->execute();
    $count = $result->rowCount();

    echo $count;
    $DBH = NULL;
    exit();

} catch (PDOException $e) {
    echo "Unable to send message";
    file_put_contents(__DIR__ . '/../Log/PDOErrorLog.txt', $e->getMessage(), FILE_APPEND);
    exit();
}
echo $rowCount;

?>