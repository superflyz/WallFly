<?php
if (time() > $_SESSION["expiration"]) {
    header("Location:timedout.php");
    exit();
}
?>