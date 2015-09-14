<?php
//Checks to see if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: /wallfly/index.php');
    exit();
}
?>