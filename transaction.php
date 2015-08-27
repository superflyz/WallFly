<?php
    if(isset($_POST["payment_method_nonce"]) && $_POST["payment_method_nonce"] != "" ){
        //Form is set and the payment_method_nocne is not empty so we can continue 
      
        require_once('braintree-php-3.3.0/lib/braintree.php');
        Braintree_Configuration::environment('sandbox');
        Braintree_Configuration::merchantId('7cb3t9x7mf6n38rz');
        Braintree_Configuration::publicKey('xq46gh5dq9p8z7qn');
        Braintree_Configuration::privateKey('9f006fa14e8cbac531dc4145963a449c');
        $buyerEmail   =  $_POST["userEmail"];
        $buyerName    =  $_POST["cardholderName"];
        $paymentNonce =  $_POST["payment_method_nonce"];
        $amount       =  $_POST["amount"];
        $propertyId   =  $_POST["propertyId"];
        echo $propertyId;
      
        $result = Braintree_Transaction::sale([
            'amount' => $amount,
            'paymentMethodNonce' => $paymentNonce,
            //If we want the amount to directly go for the settlement then you need to check these one
            'options' => array(
                'submitForSettlement' => True
            ),
            //Customer info is optional and the parameters which go in the customer info can be decided also
            'customer' => array(
                'email' => $buyerEmail,
                'firstName' => $buyerName,
            ),
            'customFields' => [
                'propertyid' => $propertyId
            ]
        ]);
        if($result->success){
            //If the payment was successfuly processed, let`s continue
            $transaction = $result->transaction;
            //get the transaction ID
            $transactionID = $transaction->id;
            echo "Succesful";
            echo $transactionID;
        } else {
            //If the processing was not successful, show a message
            echo "Unsuccessful, here is why:";
            echo $result->message;
        }
    } 
?>