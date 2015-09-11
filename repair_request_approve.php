<?php
require_once(__DIR__.'/classes/Database.php');
session_start();
$property_id = $_SESSION['propertyId'];
$usertype = $_SESSION['usertype'];
$username = $_SESSION['username'];

class repairRequestApprove{
    public static function Approve($date_of_request, $subject) {
        
        try{
            $DBH = Database::getInstance();
            $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

        } catch (PDOException $e) {
            echo "Unable to connect";
        //            file_put_contents(__DIR__.'/../Log/PDOErrorLog.txt', $e->getMessage(), FILE_APPEND);
            exit();
        }

        try{

            $STH = $DBH->prepare("UPDATE repairs SET approval=1 WHERE property_id=:property_id , subject=:subject, date_of_request=:date_of_request)");
            $STH->bindParam(":subject", $subject);
            $STH->bindParam(":property_id", $property_id);
            $STH->bindParam(":date_of_request",$date_of_request);
            $result = $STH->execute();
            
            #close db connection 
            $DBH = NULL;


        }catch(PDOException $e) {
            echo "Unable to send message: " . $e->getMessage();
        //            file_put_contents(__DIR__.'/../Log/PDOErrorLog.txt', $e->getMessage(), FILE_APPEND);
            exit();
        }
        
        return 1;
        
    }
} 

class repairRequestDeny{
    public static function Deny($date_of_request, $subject) {
        
        try{
            $DBH = Database::getInstance();
            $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

        } catch (PDOException $e) {
            echo "Unable to connect";
        //            file_put_contents(__DIR__.'/../Log/PDOErrorLog.txt', $e->getMessage(), FILE_APPEND);
            exit();
        }

        try{

            $STH = $DBH->prepare("UPDATE repairs SET approval=2 WHERE property_id=:property_id , subject=:subject, date_of_request=:date_of_request)");
            $STH->bindParam(":subject", $subject);
            $STH->bindParam(":property_id", $property_id);
            $STH->bindParam(":date_of_request",$date_of_request);
            $result = $STH->execute();
            
            #close db connection 
            $DBH = NULL;


        }catch(PDOException $e) {
            echo "Unable to send message: " . $e->getMessage();
        //            file_put_contents(__DIR__.'/../Log/PDOErrorLog.txt', $e->getMessage(), FILE_APPEND);
            exit();
        }
        
        return 2;
        
    }
} 
?>