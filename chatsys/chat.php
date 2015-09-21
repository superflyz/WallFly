<?php
session_start();
include(__DIR__ . "/../classes/PropertyFunctions.php");
require_once(__DIR__ . '/../logincheck.php');

//set up page variables
$_SESSION['propertyId'] = "";
$userName = $_SESSION["username"];
$userType = $_SESSION["usertype"];
$properties = [];
$selectedProperty = "";
$pID = '';


//set the propertyID from the $_SESSION['selectedChatProperty'] if set
if (isset($_SESSION['selectedChatProperty'])) {
    $selectedProperty = $_SESSION['selectedChatProperty'];
    $pID = PropertyFunctions::GetPropertyID($userName, $userType, $selectedProperty);
    unset($_SESSION['selectedChatProperty']);

}

//set pID if a tenant because only has one property to display
if ($userType == 'TENANT') {
    $tenantArray = [];
    $tenantArray = PropertyFunctions::GetProperties($userName, $userType);
    $selectedProperty = $tenantArray[0];
    $pID = PropertyFunctions::GetPropertyID($userName, $userType, $selectedProperty);

}

?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Chat</title>
    <!--<link href="../css/chat.css" rel="stylesheet">-->
    <!-- Latest compiled and minified CSS -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/module.css">

    <script src="../js/chat.js"></script>

    <script type="text/javascript">
        // assign current username to jquery var and use it in SendMessage function
        var user = <?php echo "'".$_SESSION['username']."'";?>;
        var pID =  <?php echo "'".$pID."'";?>;
        var type = <?php echo "'".$userType."'";?>;

        $(document).ready(function () {

            chatLoad(pID, user);
            $("#btn-send").click(function () {

                SendMessage(user, pID, type);


            });


            $("#propertyHolder").hide();
            $(".show-properties").click(function () {
                $("#propertyHolder").toggle();
            });

            $('.navList li a').on('click', function () {

                var propertyAdd = $(this).text();

                jQuery.ajax({
                    url: 'setselectedchatpropery.php',
                    type: "POST",
                    data: {
                        selected: propertyAdd
                    },
                    success: function (result) {
                        setTimeout(function () {
                            $("#propertyHolder").hide();
                            window.location.reload();
                        }, 2000);

                    }
                });
            });

            $('#box').keyup(function () {
                var valThis = this.value.toLowerCase(),
                    lenght = this.value.length;

                $('.navList>li>a').each(function () {
                    var text = $(this).text(),
                        textL = text.toLowerCase(),
                        htmlR = '<b>' + text.substr(0, lenght) + '</b>' + text.substr(lenght);
                    (textL.indexOf(valThis) == 0) ? $(this).html(htmlR).show() : $(this).hide();
                });

            });
        });
    </script>
</head>
<body>
<audio id="audiotag1" src="../sounds/messageAlert.mp3" preload="auto"></audio>
<!-- create address dropdown list only if agent or owner usertype -->
<?php if (($userType == 'AGENT') || ($userType == 'OWNER')) {
    $properties = PropertyFunctions::GetProperties($userName, $userType);


    //dropdown for property list
    echo '<div class="container">

            <div class="btn-group">
                <a class="btn btn-primary dropdown-toggle show-properties selector" data-toggle="dropdown" href="#" style="margin-left: 15px;">Select a Property</a>';
}

?>
<div id="reducedPadding" class="container">
    <div id="propertyHolder">
        <input placeholder="type to search..." id="box" type="text"/>
        <ul class="navList ">
            <?php
            foreach ($properties as $propertyAddress) {
                echo '<li><a href="">' . $propertyAddress . '</a></li>';
            } ?>
        </ul>
    </div>
</div>


<!-- Chat box -->
<div class="container">
    <div class="row">
        <div class="col-md-5">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Chat <?php if ($selectedProperty != "") {
                        echo ' for ' . $selectedProperty;
                    }; ?>
                </div>
                <div id="chatbox" class="panel-body">
                    <ul id="chatlist">

                    </ul>
                </div>
            </div>
            <div class="panel-footer">
                <div class="input-group">
                    <textarea id="btn-input" type="text" class="form-control input-sm"
                              placeholder="Type your message here..."/></textarea>
                        <span class="input-group-btn">
                            <button class="btn btn-success btn-sm" id="btn-send">Send</button>
                        </span>

                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- End Chatbox -->
<!-- set $_SESSION['selectedChatProperty'] from dropdown then refresh page -->

<script type="text/javascript">
    function play_single_sound() {
        document.getElementById('audiotag1').play();
    }
</script>
</body>
</html>
