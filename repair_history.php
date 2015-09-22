<?php
session_start();
require_once(__DIR__ . "/classes/Database.php");
require_once('repairretrieve.php');
//$_SESSION['propertyId'] = $_GET['id'];
$usertype = $_SESSION['usertype'];

try {
    $DBH = Database::getInstance();
    $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $statement = $DBH->prepare("SELECT * FROM property WHERE property_id=:propertyId");
    $statement->bindParam(':propertyId', $property_id);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        if (!($row['owner_id'] == $_SESSION['username'] || $row['agent_id'] == $_SESSION['username'] || $row['tenant_id'] == $_SESSION['username'])) {
            header("Location: index.php");
        }
    }
} catch (PDOException $e) {
    echo "Unable to connect to database";
    file_put_contents('Log/PDOErrorLog.txt', $e->getMessage(), FILE_APPEND);
    die();
}

$result = RepairRetrieval::finalRetrieve();


//  calling reapir request approval/deny file
//    require_once('repair_request_approve');
//  creating variables for calling functions approve or deny with 2 input parameters
//    $date_of_request = $_GET['date_of_request'];
//    $subject = $_GET['repairReuestDisplaysubject'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="WallFly - Property Mangement System">
    <meta name="author" content="The SuperFlyz">

    <title>Repair - WallFly</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/wallfly.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body> 

    <div class="container">
        <div class="row">
            <div id="repair" class="col-md-12">
                <h1>Repairs History</h1>
                            <br />
                        
            <table class="table">
                <tr>
                    <th class="tg-0yxs">Date</th>
                    <th class="tg-0yxs">Tenant Name</th>
                    <th class="tg-0yxs">Subject</th>
                    <th class="tg-0yxs">Request</th>
                    <th class="tg-0yxs">Image</th>
                    <th class="tg-0yxs">Status</th>
                </tr>
                
                <?php for ($i = 0; $i < count($result); $i++): ?>
                    
                    <p id="repair_id" hidden>
                        <?=$result[$i]['repair_id']?>
                    </p>
                
                    <tr>
                        <td>
                            <p >
                                <?=$result[$i]['date_of_request']?>
                            </p>
                        </td>

                        <td >
                            <p><?=$result[$i]['first_name']?><br /><?=$result[$i]['last_name']?></p>
                        </td>

                        <td>
                            <p >
                                <?=$result[$i]['subject']?>
                            </p>
                        </td>

                        <td>
                            <p><?=$result[$i]['request']?></p>
                        </td>

                        <td>
                            <img src="<?=$result[$i]['img_path']?>" width="320px" height="240px">
                        </td>

                        <td>     
                            <p>
                                <? if($result[$i]['approval'] == 0){echo "Pending";}
                                elseif($result[$i]['approval'] == 1){echo "Approved";}
                                else{echo "Denied";}?>
                            </p>
                        </td>
                    </tr>
                <?php endfor ?>
                
            </table>

            </div>
        </div>
    </div>

</body>
</html>

