<?php

require_once(__DIR__ . '/Database.php');
/**
 * Created by PhpStorm.
 * User: UltraKapes
 * Date: 9/20/2015
 * Time: 3:54 PM
 */
class CalendarEvents
{

    public static function addEvent($propertyID,$eventName,$time,$interval,$description,$date){

        try {
            $DBH = Database::getInstance();
            $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            echo "Unable to connect";
            file_put_contents(__DIR__ . '/../Log/PDOErrorLog.txt', $e->getMessage(), FILE_APPEND);
            exit();
        }

        try{

            $statement = $DBH->prepare("INSERT INTO calendar(propertyID,eventName,eventTime,eventInterval,description,eventDate)
                    VALUES(:propertyID, :eventName, :eventTime, :eventInterval, :description, :eventDate)");
            $statement->bindParam(':propertyID', $propertyID);
            $statement->bindParam(':eventName', $eventName);
            $statement->bindParam(':eventTime', $time);
            $statement->bindParam(':eventInterval', $interval);
            $statement->bindParam(':description', $description);
            $statement->bindParam(':eventDate', $date);

            $result = $statement->execute();

            if($result){
                $DBH = NULL;
                return true;

            }else{
                $DBH = NULL;
               return false;
            }



        }catch (PDOException $e) {
            echo "Unable add event";
            file_put_contents(__DIR__ . '/../Log/PDOErrorLog.txt', $e->getMessage(), FILE_APPEND);
            $DBH = NULL;
            exit();
        }
    }

}