<?php
session_start();
date_default_timezone_set("Australia/Brisbane");
if (isset($_POST["payment_method_nonce"]) && $_POST["payment_method_nonce"] != "") {
    //Form is set and the payment_method_nocne is not empty so we can continue

    require_once('braintree-php-3.3.0/lib/braintree.php');
    require_once(__DIR__ . "/classes/Database.php");
    Braintree_Configuration::environment('sandbox');
    Braintree_Configuration::merchantId('7cb3t9x7mf6n38rz');
    Braintree_Configuration::publicKey('xq46gh5dq9p8z7qn');
    Braintree_Configuration::privateKey('9f006fa14e8cbac531dc4145963a449c');
    $paymentNonce = $_POST["payment_method_nonce"];
    $amount = $_POST["amount"];
    $userId = $_SESSION['userId'];
    $email = $_SESSION['userEmail'];
    $firstName = $_SESSION['userFirstName'];
    $lastName = $_SESSION['userLastName'];
    $propertyId = $_SESSION["propertyId"];

    try {
        $DBH = Database::getInstance();
        $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Unable to connect to database";
        file_put_contents('Log/PDOErrorLog.txt', $e->getMessage(), FILE_APPEND);
        die();
    }

    $result = Braintree_Transaction::sale([
        'amount' => $amount,
        'paymentMethodNonce' => $paymentNonce,
        //If we want the amount to directly go for the settlement then you need to check these one
        'options' => array(
            'submitForSettlement' => True
        ),
        //Customer info is optional and the parameters which go in the customer info can be decided also
        'customer' => array(
            'email' => $email,
            'firstName' => $firstName . " " . $lastName,
        ),
        'customFields' => [
            'propertyid' => $propertyId
        ]
    ]);
    if ($result->success) {
        //If the payment was successfuly processed, let`s continue
        $transaction = $result->transaction;
        //get the transaction ID
        $transactionID = $transaction->id;

        try {
            $statement = $DBH->prepare("INSERT INTO payment(property, payment_date, tenant_id, tenant_fname, tenant_lname, amount)
                    VALUES(?, ?, ?, ?, ?, ?)");
            $statement->execute(array($propertyId, date("d/m/Y"), $userId, $firstName, $lastName, $amount));
        } catch (PDOException $e) {
            echo "oh no";
        }
        echo "Succesful";
        echo $transactionID;
        header("Location: property_details.php?id=" . $propertyId);
    } else {
        //If the processing was not successful, show a message
        echo "Unsuccessful, here is why:";
        echo $result->message;
    }
}
?>