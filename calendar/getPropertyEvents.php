<?php
/**
 * Created by PhpStorm.
 * User: UltraKapes
 * Date: 9/21/2015
 * Time: 4:16 PM
 */

require_once(__DIR__ . '/../classes/Database.php');

$pID = $_POST['selected'];

//initialise Database Handler
try {
    $DBH = Database::getInstance();
    $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Unable to connect";
    file_put_contents(__DIR__ . '/../Log/PDOErrorLog.txt', $e->getMessage(), FILE_APPEND);
    exit();
}
//select properties based on ID
try {
            $statement = $DBH->prepare("SELECT * FROM calendar WHERE propertyID = :propertyID ");
            $statement->bindParam(':propertyID', $pID);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
    for ($i = 0; $i < count($result); $i++) {
        echo '<div id="'.$result[$i]->eventID.'" class="selectStyle">
                <div id="selectInfo">
               <h3>'.$result[$i]->eventName.'</h3>';
         echo '<p>Date set: '.$result[$i]->eventDate.'</p>';
         echo '<p>Interval: '.$result[$i]->eventInterval.'</p>';
         if($result[$i]->eventTime != ""){echo '<p>Time: '.$result[$i]->eventTime.'</p>';}
         if($result[$i]->description != ""){echo '<p>Description: '.$result[$i]->description.'</p>';}
        echo '</div><div id="selectButtons"><button type="button" id="editEvent" class="btn btn-warning btn-sm">Edit</button><br/>
        <button type="button" id="removeEvent"class="btn btn-danger btn-sm">Remove</button></div></div>';}

    $DBH = NULL;
    exit();



} catch (PDOException $e) {
    echo "Could not access property database";
    file_put_contents(__DIR__ . '/../Log/PDOErrorLog.txt', $e->getMessage(), FILE_APPEND);
}

?>