<?php
session_start();
if (isset($_POST['selected'])) {

    $_SESSION['selectedChatProperty'] = $_POST['selected'];

}