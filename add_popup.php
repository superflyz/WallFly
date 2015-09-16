<!--This file is from the prototype, the code needs to be updated to use PDO instead-->
<?php
$username = "admin";
$password = "password";
$hostname = "localhost";

//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password)
or die("Unable to connect to MySQL");

//select a database to work with
$selected = mysql_select_db("wallflydb", $dbhandle)
or die("Could not select database");

session_start();
$current_user = $_SESSION['username'];
$usertype = $_SESSION['usertype'];
?>

<!DOCTYPE html>
<script type="text/javascript">
    function closeWin() {
        window.close();
    }
</script>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="style/style.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<div>
    <form name="add_form" method="post" action="add.php" enctype="multipart/form-data">
        <div class="form-group">
            <h2>Property Details</h2><br><br>
            <label for="owner_fn">Owner's Name</label><br>
            <input class="form-control" id="owner_fn" type="text" name="owner_fname" placeholder="First Name">&nbsp;
            <input class="form-control" id="owner_ln" type="text" name="owner_lname" placeholder="Last Name"><br><br>
            <label for="tenant_fn">Tenant's Name</label><br>
            <input class="form-control" id="tenant_fn" type="text" name="tenant_fname" placeholder="First Name">&nbsp;
            <input class="form-control" id="tenant_ln" type="text" name="tenant_lname" placeholder="Last Name"><br><br>
            <label for="agent_n">Agent's Name</label><br>
            <input class="form-control" id="agent_n" type="text" name="agent_name"><br><br>

            <?php
            if ($usertype == 'AGENT') {
                echo "<label for='owner_id'>Owner ID</label>";
                echo "<input class=\"form-control\" id='owner_id' type='text' name='ownerID'>";
                echo "<label for='agent_id'>Agent ID</label>";
                echo "<input class=\"form-control\" id='agent_id' type='text' name='agentID' value='" . $current_user . "' disabled>";
                echo "<label for='tenant_id'>Tenant ID</label>";
                echo "<input class=\"form-control\" id='tenant_id' type='text' name='tenantID'>";
            } elseif ($usertype == 'OWNER') {
                echo "<label for='owner_id'>Owner ID</label><br>";
                echo "<input class=\"form-control\" id='owner_id' type='text' name='ownerID' value='" . $current_user . "' disabled>";
                echo "<label for='agent_id'>Agent ID</label><br>";
                echo "<input class=\"form-control\" id='agent_id' type='text' name='agentID'>";
                echo "<label for='tenant_id'>Tenant ID</label><br>";
                echo "<input class=\"form-control\" id='tenant_id' type='text' name='tenantID'>";
            }
            ?>

            <br><br>

            <h3>Contacts</h3>
            <label for="owner_c">Owner</label>
            <input class="form-control" id="owner_c" type="text" name="owner_contact">

            <label for="agent_c">Agent</label>
            <input class="form-control" id="agent_c" type="text" name="agent_contact">

            <label for="tenant_c">Tenant</label>
            <input class="form-control" id="tenant_c" type="text" name="tenant_contact">

            <br><br>

            <h3>Address</h3>
            <label for="st">Street</label>
            <input class="form-control" id="st" type="text" name="street">
            <label for="sb">Suburb</label>
            <input class="form-control" id="sb" type="text" name="suburb">
            <label for="sta">State</label>
            <input class="form-control" id="sta" type="text" name="state" style="width:60px;">
            <label for="pc">Post Code</label>
            <input class="form-control" id="pc" type="text" name="post" maxlength="4" style="width:60px;">
            <br>

            <input type="file" name="photo" size="2000000" accept="image/gif, image/jpeg, image/x-ms-bmp, image/x-png"
                   size="26">
            <br>

            <input class="btn btn-success btn-sm" type="submit" name="btnAdd" value="Add">
            <input class="btn btn-success btn-sm" type="reset" class="button" value="Reset">
            &nbsp;&nbsp;
            <button class="btn btn-default btn-sm" onclick="closeWin()">Cancel</button>
        </div>
    </form>
</div>