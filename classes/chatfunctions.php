<?php 
require_once(__DIR__.'/Database.php');

class Chat {

    public static function GetProperties($username,$usertype) {
    	$propertyArray = [];
    	try{
	        $DBH = Database::getInstance();
	        $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    	}catch(PDOException $e) {
	        echo "Unable to connect";
	        file_put_contents(__DIR__.'/../Log/PDOErrorLog.txt', $e->getMessage(), FILE_APPEND);
	        exit();
    	}

		try{  

			switch ($usertype) {
    		case "AGENT":
	        	$STH = $DBH->query("SELECT * FROM property WHERE agent_id = '$username' ");
	        	break;
	    	case "OWNER":
	        	$STH = $DBH->query("SELECT * FROM property WHERE owner_id = '$username' ");
	       		break;
	       	}

	       	$STH->setFetchMode(PDO::FETCH_OBJ); 
	       	while($row = $STH->fetch()) {
	       		$propertyArray[] = $row->property_street; 
			      
			}

			return $propertyArray;

			$DBH = NULL;
		}catch(PDOException $e) {
        	echo "Could not access property database";
        	file_put_contents(__DIR__.'/../Log/PDOErrorLog.txt', $e->getMessage(), FILE_APPEND);
    	}
    }

    public static function GetPropertyID($username,$address,$usertype) {
    	$propertyID = "";
    	try{
	        $DBH = Database::getInstance();
	        $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    	}catch(PDOException $e) {
	        echo "Unable to connect";
	        file_put_contents(__DIR__.'/../Log/PDOErrorLog.txt', $e->getMessage(), FILE_APPEND);
	        exit();
    	}

    	try{  

			switch ($usertype) {
    		case "AGENT":
	        	$STH = $DBH->query("SELECT property_id FROM property WHERE agent_id = '$username' and  property_street = '$address' LIMIT 1");
	        	break;
	    	case "OWNER":
	        	$STH = $DBH->query("SELECT property_id FROM property WHERE owner_id = '$username' and  property_street = '$address' LIMIT 1");
	       		break;
	       	}

	       	$STH->setFetchMode(PDO::FETCH_OBJ); 
	       	$row = $STH->fetch();
	        $propertyID = $row->property_id; 
			      
			}

			return $propertyID;

			$DBH = NULL;
			exit();
		}catch(PDOException $e) {
        	echo "Could not access property database";
        	file_put_contents(__DIR__.'/../Log/PDOErrorLog.txt', $e->getMessage(), FILE_APPEND);
        	exit();
    	}



    }
}

