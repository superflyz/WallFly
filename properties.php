<?php
//session start
session_start();
require_once(__DIR__."/classes/Database.php");
$usertype = $_SESSION['usertype'];
$permission_1 = "ADMIN";
$permission_2 = "OWNER";
$permission_3 = "AGENT";
$permission_4 = "TENANT";

try {
    $DBH = Database::getInstance();
    $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Unable to connect to database";
    file_put_contents('Log/PDOErrorLog.txt', $e->getMessage(), FILE_APPEND);
    die();
}
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Wall Fly</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid2" id="content">
    <div class="row">
        <?php
        $current_user = $_SESSION['username'];
        //$sql = "SELECT property_id, owner_id, agent_id, tenant_id, owner_fname, owner_lname, property_agent, tenant_fname, tenant_lname, image FROM property WHERE owner_id='$current_user' OR agent_id='$current_user' OR tenant_id='$current_user'";
        //$result = mysql_query($sql) or die(mysql_error());
        $statement = $DBH->prepare("SELECT property_id, owner_id, agent_id, tenant_id, owner_fname, owner_lname, property_agent, tenant_fname, tenant_lname, image FROM property WHERE owner_id=:current_user OR agent_id=:current_user OR tenant_id=:current_user");
        $statement->bindParam(':current_user', $current_user);
        $statement->execute();
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $_SESSION['propertyId'] = $row['property_id'];
            echo "<div class='col-md-4' id='items'>";
            echo "<img class='img-rounded' border='0' src=\"" . $row['image'] . "\" width=\"320\" height=\"240\"><br><br>";
            echo "<h4>Owner: " . $row['owner_fname'] . " " . $row['owner_lname'] . " (ID: " . $row['owner_id'] . ")</h3>";
            echo "<h4>Agent: " . $row['property_agent'] . " (ID: " . $row['agent_id'] . ")</h3>";
            echo "<h4>Tenant: " . $row['tenant_fname'] . " " . $row['tenant_lname'] . " (ID: " . $row['tenant_id'] . ")</h3>";
            echo "<h3><a class='divLink' href='property_detail.php?id=" . $row['property_id'] . "'>Click</a></h3>";
            echo "</div>";
        }
        ?>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php
            if ($usertype == $permission_1 || $usertype == $permission_2 || $usertype == $permission_3) {
                ?>
                <div>
                    <button class="add_btn"
                            onclick="javascript:void window.open('add_popup.php','1428456850982','width=700,height=500,toolbar=0,menubar=0,location=0,status=0,scrollbars=1,resizable=1,left=0,top=0');return false;">
                        <span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Add Property
                    </button>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>
<br>
<div>
    <ul style="list-style-type: none; text-align: center; text-decoration: none;">
        <li style="display:inline; padding:25px;"><a href="#">About Us</li>
        <li style="display:inline; padding:25px;"><a href="#">Contact Us</li>
        <li style="display:inline; padding:25px;"><a href="#">RTA Website</li>
        <li style="display:inline; padding:25px;"><a href="#">Report an Issue</li>
    </ul>
</div>
<script type="text/javascript">
    document.getElementById("calendar_btn").onclick = function () {
        location.href = "calendar/calendar.php";
    };
</script>
</body>
</html>