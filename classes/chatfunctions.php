<?php
require_once(__DIR__ . '/Database.php');

class Chat
{

    public static function GetProperties($userName, $userType)
    {
        $propertyArray = [];
        //initialise Database Handler
        try {
            $DBH = Database::getInstance();
            $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Unable to connect";
            file_put_contents(__DIR__ . '/../Log/PDOErrorLog.txt', $e->getMessage(), FILE_APPEND);
            exit();
        }
        //select properties based on userType
        try {

            switch ($userType) {
                case "AGENT":
                    $statement = $DBH->prepare("SELECT * FROM property WHERE agent_id = :userName ");
                    $statement->bindParam(':userName', $userName);
                    break;
                case "OWNER":
                    $statement = $DBH->prepare("SELECT * FROM property WHERE owner_id = :userName ");
                    $statement->bindParam(':userName', $userName);
                    break;
                case "TENANT":
                    $statement = $DBH->prepare("SELECT * FROM property WHERE tenant_id = :userName ");
                    $statement->bindParam(':userName', $userName);
                    break;
            }

            $statement->setFetchMode(PDO::FETCH_OBJ);
            while ($row = $statement->fetch()) {
                $propertyArray[] = $row->property_street;

            }

            return $propertyArray;

            $DBH = NULL;
        } catch (PDOException $e) {
            echo "Could not access property database";
            file_put_contents(__DIR__ . '/../Log/PDOErrorLog.txt', $e->getMessage(), FILE_APPEND);
        }
    }

    public static function GetPropertyID($userName, $userType, $address)
    {
        if ($address == "") {

            exit();
        } else {
            $propertyID = "";
            try {
                $DBH = Database::getInstance();
                $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Unable to connect";
                file_put_contents(__DIR__ . '/../Log/PDOErrorLog.txt', $e->getMessage(), FILE_APPEND);
                exit();
            }

            try {

                switch ($userType) {
                    case "AGENT":
                        $statement = $DBH->prepare("SELECT property_id FROM property WHERE agent_id = :userName and  property_street = :address: LIMIT 1");
                        $statement->bindParam(':userName', $userName);
                        $statement->bindParam(':address', $address);
                        break;
                    case "OWNER":
                        $statement = $DBH->prepare("SELECT property_id FROM property WHERE owner_id = :userName and  property_street = :address LIMIT 1");
                        $statement->bindParam(':userName', $userName);
                        $statement->bindParam(':address', $address);
                        break;
                    case "TENANT":
                        $statement = $DBH->prepare("SELECT property_id FROM property WHERE tenant_id = :userName and  property_street = :address LIMIT 1");
                        $statement->bindParam(':userName', $userName);
                        $statement->bindParam(':address', $address);
                        break;
                }

                $statement->setFetchMode(PDO::FETCH_OBJ);
                $row = $statement->fetch();
                $propertyID = $row->property_id;
                return $propertyID;

                $DBH = NULL;
                exit();
            } catch (PDOException $e) {
                echo "Could not access property database";
                file_put_contents(__DIR__ . '/../Log/PDOErrorLog.txt', $e->getMessage(), FILE_APPEND);
                exit();
            }
        }
    }
}
