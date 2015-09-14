<?php
//Destroy a session and log the user out
session_start();
session_destroy();
header("Location:index.php");
exit();
?>