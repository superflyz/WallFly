<?php
class RepairDetailsRetrieval {

    public static function retrieve() {
        $property_id = $_SESSION['propertyId'];
        try{
            $DBH = Database::getInstance();
            $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

        } catch (PDOException $e) {
            echo "Unable to connect";
            exit();
        }
        try{
            $STH = $DBH->prepare("SELECT * FROM repairs WHERE property_id=:property_id");
            $STH->bindParam(":property_id", $property_id);
            $STH->execute();
            $result = $STH->fetchAll();
            $DBH = NULL;
        }catch(PDOException $e) {
            echo "Unable to send message: " . $e->getMessage();
            exit();
        }
        return $result;
    }
}

class RepairRetrieval {
    public static function finalRetrieve() {
        //$property_id = $_SESSION['propertyId'];
        $property_id = 125;
        try{
            $DBH = Database::getInstance();
            $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

        } catch (PDOException $e) {
            echo "Unable to connect";
            exit();
        }
        try{
            $STH = $DBH->prepare("SELECT * FROM repairs WHERE property_id=:property_id");
            $STH->bindParam(":property_id", $property_id);
            $STH->execute();
            $result = $STH->fetchAll();
            $DBH = NULL;
        }catch(PDOException $e) {
            echo "Unable to send message: " . $e->getMessage();
            exit();
        }
        return $result;
    }
}
?>