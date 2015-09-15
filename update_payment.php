<!--This page is for Agents and owners to manually update the payment history for a property-->
<?php
session_start();
require_once(__DIR__ . "/classes/Database.php");
$propertyID = $_SESSION['propertyId'];

//Connect to the database
try {
    $DBH = Database::getInstance();
    $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Unable to connect to database";
    file_put_contents('Log/PDOErrorLog.txt', $e->getMessage(), FILE_APPEND);
    die();
}

$amount = $_POST["amount"];
$userId = $_SESSION['userId'];
$email = $_SESSION['userEmail'];
$firstName = $_SESSION['userFirstName'];
$lastName = $_SESSION['userLastName'];
$propertyId = $_SESSION["propertyId"];

try {
    $statement = $DBH->prepare("INSERT INTO payment(property, payment_date, tenant_id, tenant_fname, tenant_lname, amount)
                        VALUES(?, ?, ?, ?, ?, ?)");
    $statement->execute(array($propertyId, $_POST['date'], $userId, $firstName, $lastName, $amount));
} catch (PDOException $e) {
    echo "An error occured";
}

header("Location: property_details.php?id=" . $propertyId);
?>