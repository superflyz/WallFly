<?php
session_start();
require_once(__DIR__ . "/classes/Database.php");
$_SESSION['propertyId'] = $_GET['id'];
$property_id = $_SESSION['propertyId'];
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


?>
<!DOCTYPE HTML>
<html>
<head lang="en">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="distributor" content="Global"/>
    <meta itemprop="contentRating" content="General"/>
    <meta name="robots" content="All"/>
    <meta name="revisit-after" content="7 days"/>
    <meta name="description" content="The source of truly unique and awesome jquery plugins."/>
    <meta name="keywords"
          content="slider, carousel, responsive, swipe, one to one movement, touch devices, jquery, plugin, bootstrap compatible, html5, css3"/>
    <meta name="author" content="w3widgets.com">

    <title>Wall Fly</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="style/style.css">

    <link rel="stylesheet" href="/bootstrap-calendar/dist/css/font-awesome.min.css">
    <!-- Respomsive slider -->
    <link href="style/responsive-calendar.css" rel="stylesheet">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

    <script src="js/responsive-calendar.js"></script>

</head>

<body>
<div id="tabContainer">
    <div id="tabs">
        <ul>
            <li id="tabHeader_1">Profile</li>
            <li id="tabHeader_2">Payments History</li>
            <?php
            $privilege1 = "TENANT";
            $privilege2 = "ADMIN";
            $privilege3 = "AGENT";
            $privilege4 = "OWNER";
            $usertype = $_SESSION['usertype'];
            if ($usertype == $privilege1 || $usertype == $privilege2) {
                echo "<li id='tabHeader_3'>Repair Request</li>";
            } elseif ($usertype == $privilege3 || $usertype == $privilege4) {
                echo "<li id='tabHeader_5'>Maintenance</li>";
            }
            ?>
            <li id="tabHeader_6">Inspection Report</li>
            <li id="tabHeader_4">RTA Form</li>
        </ul>
    </div>
    <div id="tabscontent">
        <div class="tabpage" id="tabpage_1">
            <h2>Details</h2>
            <br>
            <?php
            //Select picked property
            //$sql = "SELECT owner_id, agent_id, tenant_id, owner_fname, owner_lname, property_agent, tenant_fname, tenant_lname, contact_owner, contact_agent, contact_tenant, property_street, property_suburb, property_state, property_postcode, image, user_id
            //      FROM property WHERE property_id='$property_id'";
            //$result = mysql_query($sql);
            $statement = $DBH->prepare('SELECT owner_id, agent_id, tenant_id, owner_fname, owner_lname, property_agent,
                tenant_fname, tenant_lname, contact_owner, contact_agent, contact_tenant, property_street,
                property_suburb, property_state, property_postcode, image, user_id FROM property WHERE property_id=:propertyId');
            $statement->bindParam(':propertyId', $property_id);
            $statement->execute();
            //$result = $statement->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <div class="row">
                <div class="col-md-6">
                    <?php

                    while ($row = $statement->fetch(PDO::FETCH_ASSOC)){

                    echo "<img border='0' src=\"" . $row['image'] . "\" width=\"320\" height=\"240\" style=\"background-color:#000000\" class=\"img-thumbnail\"><br><br>";
                    ?>
                </div>
                <div class="col-md-6">
                    <?php
                    echo "<ul class=\"list-group\" style='margin-right:40px'>";
                    echo "<li class=\"list-group-item\">Owner: " . $row['owner_fname'] . " " . $row['owner_lname'] . " (ID: " . $row['owner_id'] . ")</li>";
                    echo "<li class=\"list-group-item\">Agent: " . $row['property_agent'] . " (ID: " . $row['agent_id'] . ")</li>";
                    echo "<li class=\"list-group-item\">Tenant: " . $row['tenant_fname'] . " " . $row['tenant_lname'] . " (ID: " . $row['tenant_id'] . ")</li>";
                    echo "</ul><br><br>";
                    echo "<h3>Address</h4>";
                    echo "<p>" . $row['property_street'] . " " . $row['property_suburb'] . " " . $row['property_state'] . "</p>";
                    echo "<p>Post Code " . $row['property_postcode'] . "</p><br><br>";
                    echo "<h3>Contacts</h4>";
                    echo "<ul class=\"list-group\" style='margin-right:40px'>";
                    echo "<li class=\"list-group-item\">Owner's: " . $row['contact_owner'] . "</li>";
                    echo "<li class=\"list-group-item\">Agent's: " . $row['contact_agent'] . "</li>";
                    echo "<li class=\"list-group-item\">Tenant's: " . $row['contact_tenant'] . "</li>";
                    echo "</ul>";
                    }

                    echo "<a href='tenant_agreement.php' target='popup' onclick='window.open(\"tenant_agreement.php\", \"name\", \"width=400, height=600\")'>View Tenant Agreement</a>";
                    ?>
                </div>
            </div>
            <!--end row-->
            <?php

            if ($usertype != "TENANT") {
                echo "<form name='edit_delete' method='post' action='delete.php' enctype='multipart/form-data'>";
                echo "<button id='property_buttons' class=\"btn btn-success\" onclick=\"javascript:void window.open('property_edit_popup.php','1428456850982','width=700,height=500,toolbar=0,menubar=0,location=0,status=0,scrollbars=1,resizable=1,left=0,top=0');return false;\">Edit</button>";
                echo "<input type='submit' id='property_buttons' class='btn btn-danger' name='delete' value='Delete' />";
                echo "</form>";
            }
            echo "<button id='back' class='btn btn-default btn-xs'>Go Back to Property Lists</button>";

            ?>
        </div>
        <div class="tabpage" id="tabpage_2">
            <h2>Payment History</h2>
            <table class="table table-hover">
                <tr>
                    <th class="tg-0yxs">Date</th>
                    <th class="tg-0yxs">Tenant ID</th>
                    <th class="tg-0yxs">Tenant Name</th>
                    <th class="tg-0yxs">Amount</th>
                </tr>
                <?php
                //$payment_sql = "SELECT payment_date, tenant_id, tenant_fname, tenant_lname, amount FROM payment WHERE property='$property_id'";
                //$payment_result = mysql_query($payment_sql);
                $statement = $DBH->prepare("SELECT payment_date, tenant_id, tenant_fname, tenant_lname, amount FROM payment WHERE property=:propertyId");
                $statement->bindParam(':propertyId', $property_id);
                $statement->execute();
                while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row['payment_date'] . "</td>";
                    echo "<td>" . $row['tenant_id'] . "</td>";
                    echo "<td>" . $row['tenant_fname'] . " " . $row['tenant_lname'] . "</td>";
                    echo "<td>$" . $row['amount'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </table>

            <!---Owner and agent payment update-->
            <?php
            if ($usertype != "TENANT") {
                ?>
                <h3>Add Payment</h3>
                <form id="addPayment" method="post" action="update_payment.php">
                    <label>Date</label><br/><input type="text" name="date" placeholder="dd/mm/yyyy" value=""/><br/>
                    <label>Amount</label><br/><input type="text" name="amount" placeholder="$0.00" value=""/><br/>
                    <input type="submit" name="addPaymentButton" value="add">
                </form>
                <?php
            }
            ?>

            <!--Tenant payment-->
            <!--Test payment function DO NOT MODIFY-->
            <!--Test payment function DO NOT MODIFY-->
            <!--Test payment function DO NOT MODIFY-->
            <!--Test payment function DO NOT MODIFY-->
            <!--Test payment function DO NOT MODIFY-->
            <!--Test payment function DO NOT MODIFY-->
            <?php
            require_once('braintree-php-3.3.0/lib/braintree.php');
            Braintree_Configuration::environment('sandbox');
            Braintree_Configuration::merchantId('7cb3t9x7mf6n38rz');
            Braintree_Configuration::publicKey('xq46gh5dq9p8z7qn');
            Braintree_Configuration::privateKey('9f006fa14e8cbac531dc4145963a449c');

            $pathToPayment = "transaction.php";

            $clientToken = Braintree_ClientToken::generate();
            ?>
            <?php
            if ($usertype == $privilege1) {
                ?>
                <h3>Make Payment</h3>
                <form id="checkout" method="post" action="<?php echo $pathToPayment; ?>">
                    <input type="text" name="amount" placeholder="$0.00" value=""/>

                    <div id="payment-form"></div>
                    <input type="submit" name="braintreeSubmit" value="Pay Now">
                </form>

                <!-- Including the braintree script to encrypt the card data -->
                <script src="https://js.braintreegateway.com/v2/braintree.js"></script>
                <script>
                    var clientToken = "<?php echo $clientToken; ?>";

                    braintree.setup(clientToken, "dropin", {
                        container: "payment-form"
                    });
                </script>
                <?php
            }
            ?>
            <!--End payment function-->
            <!--End payment function-->
            <!--End payment function-->
            <!--End payment function-->


        </div>
        <?php
        if ($usertype == $privilege1 || $usertype == $privilege2) {
            echo "<div class='tabpage' id='tabpage_3'>";
            echo "<h2>Repair Request</h2>";
            ?>
            <form name='repair_request_form' method="post" action="repairform.php">
                <table width="70%">
                    <tr>
                        <td valign="top" width="20%">
                            <label for="first_name">First Name *</label>
                        </td>
                        <td valign="top" width="50%">
                            <input class="form-control" type="text" name="first_name" maxlength="50" size="30"
                                   placeholder="First Name">
                        </td>
                    </tr>

                    <tr>
                        <td valign="top">
                            <label for="last_name">Last Name *</label>
                        </td>
                        <td valign="top">
                            <input class="form-control" type="text" name="last_name" maxlength="50" size="30"
                                   placeholder="Last Name">
                        </td>
                    </tr>

                    <tr>
                        <td valign="top">
                            <label for="subject">Subject </label>
                        </td>
                        <td valign="top">
                            <input class="form-control" type="text" name="subject" maxlength="30" size="30"
                                   placeholder="subject">
                        </td>
                    </tr>

                    <tr>
                        <td valign="top">
                            <label for="request">Request *</label>
                        </td>
                        <td valign="top">
                            <textarea class="form-control" name="request" rows="4"
                                      placeholder="Please write your requests"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td valign="top">
                            <label for="attach_img">Image File</label>
                            <input type="file" id="attach_img">

                            <p class="help-block">Attach your image.</p>
                        </td>
                        <td valign="top">

                        </td>
                    </tr>

                    <tr style="margin-top: 20px;">
                        <td style="text-align:right" colspan="2">
                            <button class="btn btn-success btn-sm" type="submit" name="send_email">Request</button>
                            &nbsp;
                            <input class="btn btn-default btn-sm" type="reset" value="Reset">
                        </td>
                    </tr>
                </table>
            </form>
            <!--<iframe id="contact" src="contactform/contact.php" width="100%" height="500"></iframe>-->
            <?php
            echo "</div>";
        }
        ?>

        <div class="tabpage" id="tabpage_4">
            <table width="100%">
                <tr>
                    <td width="45%"><h2>Process for Applying to QCAT</h2></td>
                    <td width="50px"></td>
                    <td width="45%"><h2>RTA Form</h2></td>
                </tr>
                <tr>
                    <td>1. First you should try and resolve your dispute directly. <br><br>
                        2. If you cannot reach agreement, you must try to resolve the dispute assisted by the RTA’s
                        dispute resolution service (unless your dispute is considered ‘urgent’ by the legislation).
                        Lodge a Dispute resolution request (Form 16).<br><br>
                        3. If you go through the RTA’s dispute resolution process and the dispute remains unresolved the
                        RTA will send you a notice of unresolved dispute. You can then choose to lodge an application to
                        have your matter heard at QCAT for an order to be made.<br><br>
                        4. Once you have applied to QCAT and paid the application fee notices will be sent to attend a
                        hearing on a set date. When the case is heard a decision will be made by the adjudicator or
                        magistrate and you must follow the order given.<br><br></td>
                    <td></td>
                    <td>
                        <a href="https://www.rta.qld.gov.au/Disputes/Dispute-resolution/How-to-prevent-disputes">Preventing Disputes</a> <br>
                        <br>
                        <br>
                        <a href="https://www.rta.qld.gov.au/Disputes/Dispute-resolution/How-to-prevent-disputes/Preventing-bond-disputes">Preventing Bond Disputes</a> <br>
                        <br>
                        <br>
                        <a href="https://www.rta.qld.gov.au/Disputes/Dispute-resolution/How-to-resolve-tenancy-issues">Resolving Tenancy Issues:</a> <br>
                        <br>
                        <br>
                        <a href="https://www.rta.qld.gov.au/Disputes/Dispute-resolution/Applying-for-dispute-resolution">Dispute Resolution by RTA</a> <br>
                        <br>
                        <br>
                        <a href="https://www.rta.qld.gov.au/Disputes/Dispute-resolution/Applying-for-dispute-resolution/Matters-unsuitable-for-conciliation">Matters unsuitable for conciliation</a> <br>
                        <br>
                        <br>
                        <a href="https://www.rta.qld.gov.au/Disputes/Dispute-resolution/Applying-to-QCAT">Queensland Civil and Administrative Tribunal</a> <br>
                    </td>
                </tr>
            </table>

            <h2>RTA Dispute resolution request form</h2>
            <!--<form>-->
            <table width="100%">

                <tr>
                    <td valign="top" width="200">
                        <label for="bondNum">Rental Bond Number </label>
                    </td>
                    <td valign="top">
                        <input type="text" name="bondNum" maxlength="30" size="30"/>
                    </td>
                </tr>
            </table>

            <h3>1. Who is lodging this dispute request</h3>
            <table width="100%">
                <tr>
                    <td valign="top">
                        <form id="check">
                            <input type="checkbox" name="requester" value="lessor">Lessor&nbsp;&nbsp;
                            <input type="checkbox" name="requester" value="agent">Agent&nbsp;&nbsp;
                            <input type="checkbox" name="requester" value="tenant">Tenant/s&nbsp;&nbsp;
                            <input type="checkbox" name="requester" value="manager">Manager/provider&nbsp;&nbsp;
                            <input type="checkbox" name="requester" value="resident">Resident/s
                        </form>
                    </td>
                </tr>

                <tr id="requesters">
                    <table width="100%" border="0" cellpadding="10" id="requester_form">
                        <tr>
                            <td width="16%">
                                <h4>Full name/trading name</h4>
                            </td>
                            <td width="16%">
                                <input type="text" name="requester_name" maxlength="30" size="30">
                            </td>
                            <td width="5%">

                            </td>
                            <td width="16%">

                            </td>
                            <td width="5%">

                            </td>
                            <td>

                            </td>
                        </tr>

                        <tr>
                            <td>
                                <h4>Postal address</h4>
                            </td>
                            <td>
                                <input type="text" name="postal_address" maxlength="30" size="30">
                            </td>
                            <td>
                                <h4>Postcode</h4>
                            </td>
                            <td>
                                <input type="text" name="postcode" maxlength="10" size="10">
                            </td>
                            <td>

                            </td>
                            <td>

                            </td>
                        </tr>

                        <tr>
                            <td>
                                <h4>Phone</h4>
                            </td>
                            <td>
                                <input type="text" name="phone" maxlength="10" size="15">
                            </td>
                            <td>
                                <h4>Mobile</h4>
                            </td>
                            <td>
                                <input type="text" name="mobile" maxlength="12" size="15">
                            </td>
                            <td>
                                <h4>Email</h4>
                            </td>
                            <td>
                                <input type="text" name="email" maxlength="30" size="20">
                            </td>
                            <td>

                            </td>
                        </tr>
                    </table>
                </tr>
            </table>

            <h3>2. The RTA can assist you in the following ways. <i>(Mark all that apply)</i></h3>
            <table width="100%" border="0">
                <tr>
                    <td>
                        <input type="checkbox" name="wrh" value="wrh">Writing/reading help&nbsp;&nbsp;
                        <input type="checkbox" name="aoe" value="aoe">Ausian or signed English&nbsp;&nbsp;
                        <input type="checkbox" name="interpreter" value="interpreter">Interpreter service, specify
                        language&nbsp;<input type="text" size="10" id="language">
                    </td>
                </tr>
            </table>

            <h3>3. Has the tenant or resident left the property?</h3>
            <table width="100%" border="0">
                <tr>
                    <td>
                        <input type="checkbox" name="no" value="no">No&nbsp;&nbsp;
                        <input type="checkbox" name="yes" value="yes">Yes&nbsp;<input type="text" size="10"
                                                                                      placeholder="DD/MM/YYYY">
                    </td>
                </tr>
            </table>

            <h3>4. Who is the dispute with: </h3>
            <table width="100%">
                <tr>
                    <td valign="top">
                        <form id="check">
                            <input type="checkbox" name="requester" value="lessor">Lessor&nbsp;&nbsp;
                            <input type="checkbox" name="requester" value="agent">Agent&nbsp;&nbsp;
                            <input type="checkbox" name="requester" value="tenant">Tenant/s&nbsp;&nbsp;
                            <input type="checkbox" name="requester" value="manager">Manager/provider&nbsp;&nbsp;
                            <input type="checkbox" name="requester" value="resident">Resident/s
                        </form>
                    </td>
                </tr>

                <tr id="requesters">
                    <table width="100%" border="0" cellpadding="10" id="requester_form">
                        <tr>
                            <td width="16%">
                                <h4>Full name/trading name</h4>
                            </td>
                            <td width="16%">
                                <input type="text" name="requester_name" maxlength="30" size="30">
                            </td>
                            <td width="5%">

                            </td>
                            <td width="16%">

                            </td>
                            <td width="5%">

                            </td>
                            <td>

                            </td>
                        </tr>

                        <tr>
                            <td>
                                <h4>Postal address</h4>
                            </td>
                            <td>
                                <input type="text" name="postal_address" maxlength="30" size="30">
                            </td>
                            <td>
                                <h4>Postcode</h4>
                            </td>
                            <td>
                                <input type="text" name="postcode" maxlength="10" size="10">
                            </td>
                            <td>

                            </td>
                            <td>

                            </td>
                        </tr>

                        <tr>
                            <td>
                                <h4>Phone</h4>
                            </td>
                            <td>
                                <input type="text" name="phone" maxlength="10" size="15">
                            </td>
                            <td>
                                <h4>Mobile</h4>
                            </td>
                            <td>
                                <input type="text" name="mobile" maxlength="12" size="15">
                            </td>
                            <td>
                                <h4>Email</h4>
                            </td>
                            <td>
                                <input type="text" name="email" maxlength="30" size="20">
                            </td>
                            <td>

                            </td>
                        </tr>
                    </table>
                </tr>
            </table>

            <h3>5. The dispute is about: </h3>
            <table width="100%">
                <tr>
                    <td>
                        <input type="checkbox">Bond
                        <input type="checkbox">Rent arrears
                        <input type="checkbox">Repairs
                        <input type="checkbox">Entry
                        <input type="checkbox">Claim greater than bond
                        <input type="checkbox">Tenancy database
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox">Other (specify details) <textarea rows="2" cols="100"></textarea>
                    </td>
                </tr>
            </table>

            <h3>6. Please indicate which notices if any, have been issued/received. Attach copies if possible.</h3>
            <table width="100%">
                <tr>
                    <td>
                        <input type="checkbox">Notice to remedy breach (Form 11, R11)
                        <input type="checkbox">Notice to leave (Form12, R12)
                        <input type="checkbox">Notice of Intention to leave (Form 13, R13)
                    </td>
                </tr>
            </table>
            <br><br>
            <button class="btn btn-success" onclick="rtasubmit()">Request</button>
            <input class="btn btn-default" type="reset" value="Reset">
            <!--</form>-->
        </div>
        <?php
        if ($usertype == $privilege3 || $usertype == $privilege4) {
            echo "<div class='tabpage' id='tabpage_5'>";
            echo "<h2>Repair Requests</h2>";
            ?>
            <table class="table table-hover">
                <tr>
                    <th class="tg-0yxs">Date</th>
                    <th class="tg-0yxs">Tenant Name</th>
                    <th class="tg-0yxs">Subject</th>
                    <th class="tg-0yxs">Request</th>
                    <th class="tg-0yxs">Image</th>
                    <th class="tg-0yxs">Status</th>
                </tr>

                <tr>
                    <td>
                        05/05/2015
                    </td>

                    <td>
                        Ben Park
                    </td>

                    <td>
                        Leaking water tank.
                    </td>

                    <td>
                        Hi, can you fix up the water tank? The water tank is leaking since yesterday. Thank you.
                    </td>

                    <td>
                        <img src="img/repair/leaking_watertank.jpg" width="320" height="240">
                    </td>

                    <td>
                        <button type="button" class="btn btn-success btn-xs" style="width:100%; margin-top:80px;">
                            Approve
                        </button>
                        <button type="button" class="btn btn-danger btn-xs"
                                style="width:100%; margin-button:80px; margin-top:10px;">Deny
                        </button>
                    </td>
                </tr>

                <tr>
                    <td>
                        01/06/2015
                    </td>

                    <td>
                        Ben Park
                    </td>

                    <td>
                        A door handle is broken.
                    </td>

                    <td>
                        Hi, one of room's door handle has been broken. Can you fix it up please? Thank you.
                    </td>

                    <td>
                        <img src="img/repair/broken_doorhandle.jpg" width="320" height="240">
                    </td>

                    <td>
                        <button type="button" class="btn btn-success btn-xs" style="width:100%; margin-top:80px;">
                            Approve
                        </button>
                        <button type="button" class="btn btn-danger btn-xs"
                                style="width:100%; margin-button:80px; margin-top:10px;">Deny
                        </button>
                    </td>
                </tr>


            </table>
            <?php
            echo "</div>";
        }
        ?>


        <!-- Inspection tab-->
        <div class="tabpage" id="tabpage_6">
            <h2>Inspection Report</h2>
            <table class="table table-hover">
                <tr>
                    <th class="tg-0yxs">Date</th>
                    <th class="tg-0yxs">Tenant ID</th>
                    <th class="tg-0yxs">Tenant Name</th>
                    <th class="tg-0yxs">Inspector</th>
                    <th class="tg-0yxs">Comment</th>
                </tr>
                <?php
                //$payment_sql = "SELECT inspection_date, tenant_id, tenant_fname, tenant_lname, inspector, comment FROM inspection WHERE property_id='$property_id'";
                //$payment_result = mysql_query($payment_sql);
                $statement = $DBH->prepare("SELECT inspection_date, tenant_id, tenant_fname, tenant_lname, inspector, comment FROM inspection WHERE property_id=:property_id");
                $statement->bindParam(':property_id', $property_id);
                $statement->execute();
                while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row['inspection_date'] . "</td>";
                    echo "<td>" . $row['tenant_id'] . "</td>";
                    echo "<td>" . $row['tenant_fname'] . " " . $row['tenant_lname'] . "</td>";
                    echo "<td>" . $row['inspector'] . "</td>";
                    echo "<td>" . $row['comment'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
            <br><br>
            <?php
            if ($usertype == $privilege3) {
                echo "<button id='inspection_update_btn' class=\"btn btn-success btn-lg btn-block\" onclick=\"javascript:void window.open('update_inspection_popup.php','1428456850982','width=500,height=360,toolbar=0,menubar=0,location=0,status=0,scrollbars=1,resizable=1,left=0,top=0');return false;\">Update Inspection</button>";
            }

            ?>
        </div>
    </div>
</div>
</div>

<script src="js/tabs_old.js"></script>

<script type="text/javascript">

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-1332079-8']);
    _gaq.push(['_trackPageview']);

    (function () {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
    })();

    //back button
    document.getElementById("back").onclick = function () {
        location.href = "properties.php";
    };


    //RTA submit
    function rtasubmit() {
        window.location.reload();
        alert('Your dispute resolution has been requested.');
    }

    //repair request submit
    function rrsubmit() {
        window.location.reload();
        alert('Your repair request has been submitted.');
    }
</script>

<br>
<br>

<div>
    <ul style="list-style-type: none; text-align: center; text-decoration: none;">
        <li style="display:inline; padding:25px;"><a href="#">About Us</li>
        <li style="display:inline; padding:25px;"><a href="#">Contact Us</li>
        <li style="display:inline; padding:25px;"><a href="#">RTA Website</li>
        <li style="display:inline; padding:25px;"><a href="#">Report an Issue</li>
    </ul>
</div>
</body>
</html>