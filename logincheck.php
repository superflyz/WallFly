<?php

if(!isset($_SESSION['username'])){
		header('Location: /wallfly/index.php');
		exit();
	}
?>