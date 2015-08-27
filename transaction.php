<?php
require_once('braintree-php-3.3.0/lib/braintree.php');
Braintree_Configuration::environment('sandbox');
  Braintree_Configuration::merchantId('7cb3t9x7mf6n38rz');
  Braintree_Configuration::publicKey('xq46gh5dq9p8z7qn');
  Braintree_Configuration::privateKey('9f006fa14e8cbac531dc4145963a449c');
$result = Braintree_Transaction::sale(array(
    "amount" => "1000.00",
    "creditCard" => array(
        "number" => $_POST["number"],
        "cvv" => $_POST["cvv"],
        "expirationMonth" => $_POST["month"],
        "expirationYear" => $_POST["year"]
    ),
    "options" => array(
        "submitForSettlement" => true
    )
));
if ($result->success) {
    echo("Success! Transaction ID: " . $result->transaction->id);
} else if ($result->transaction) {
    echo("Error: " . $result->message);
    echo("<br/>");
    echo("Code: " . $result->transaction->processorResponseCode);
} else {
    echo("Validation errors:<br/>");
    foreach (($result->errors->deepAll()) as $error) {
        echo("- " . $error->message . "<br/>");
    }
}
?>