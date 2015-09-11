<?php
require_once(__DIR__.'/classes/Database.php');
class RepairDetailsRetrieval {
    
    
    public static function retrieve() {
//        session_start();
        
        $property_id = $_SESSION['propertyId'];


        try{
            $DBH = Database::getInstance();
            $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

        } catch (PDOException $e) {
            echo "Unable to connect";
//            file_put_contents(__DIR__.'/../Log/PDOErrorLog.txt', $e->getMessage(), FILE_APPEND);
            exit();
        }

        try{

            $STH = $DBH->prepare("SELECT * FROM repairs WHERE property_id=:property_id");
            $STH->bindParam(":property_id", $property_id);
            $STH->execute();
            $result = $STH->fetchAll();
//            var_dump($result);
//            var_dump($result[0]);
            #close db connection 
            $DBH = NULL;


        }catch(PDOException $e) {
            echo "Unable to send message: " . $e->getMessage();
//            file_put_contents(__DIR__.'/../Log/PDOErrorLog.txt', $e->getMessage(), FILE_APPEND);
            exit();
        }
        
        return $result;
    }
    
    
}

?>