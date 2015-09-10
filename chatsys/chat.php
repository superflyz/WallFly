<?php
session_start();
include (__DIR__ . "/../classes/chatfunctions.php");
require_once(__DIR__.'/../logincheck.php');

$_SESSION['propertyId'] = "";
$username = $_SESSION["username"];
$usertype = $_SESSION["usertype"];
$properties = [];
$selectedproperty="";
$pID = '';

//set the propertyID from the $_SESSION['selectedChatProperty'] if set
if(isset($_SESSION['selectedChatProperty'])) {
   $selectedproperty = $_SESSION['selectedChatProperty'];
   $pID = Chat::GetPropertyID($username,$usertype,$selectedproperty);
    unset($_SESSION['selectedChatProperty']);

}

if($usertype == 'TENANT'){
  $tenantArray=[];
  $tenantArray = Chat::GetProperties($username,$usertype);
  $selectedproperty = $tenantArray[0];
  $pID = Chat::GetPropertyID($username,$usertype,$selectedproperty);

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Chat</title>
      <!--<link href="../css/chat.css" rel="stylesheet">-->
       <!-- Latest compiled and minified CSS -->
       <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
      <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
      <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="../css/chat.css">
      <script src="../js/chat.js"></script>
      <script type="text/javascript">
         // assign current username to jquery var and use it in SendMessage function
         var user = <?php echo "'".$_SESSION['username']."'";?>;
         var pID =  <?php echo "'".$pID."'";?>;
         $(document).ready(function() {
            bar(pID, user);
            $("#btn-send").click(function(){
               SendMessage(user,pID);
            });
         });
      </script>
</head>
<body>
 <!-- create address dropdown list only if agent or owner usertype -->
<?php if (($usertype == 'AGENT') || ($usertype == 'OWNER')){

   $properties = Chat::GetProperties($username,$usertype);


   //dropdown for property list
   echo '<div class="container">
            <div class="btn-group">
                <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">Select a Property<span class="caret"></span></a>
                    <ul id="propertieslist"class="dropdown-menu">';
                    foreach ($properties as $propertyAddress) {
                     echo '<li><a href="#">'.$propertyAddress.'</a></li>';
                    }
            echo '</ul>
            </div>

        </div>';
        }

    //load the chatbox if propertyID is set
    if($pID != ""){
        $name =  $_SESSION['username'];
        echo "<script type='text/javascript'>";
        echo "LoadChatBox('".$pID."', '".$name."')";
        echo "</script>";
    }

?>

    <!-- Chat box -->
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                    Chat <?php if($selectedproperty != ""){echo ' for '.$selectedproperty;};?>
                    </div>
                    <div id="chatbox" class="panel-body">
                        <ul id="chatlist" class="chat">

                        </ul>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="input-group">
                        <input id="btn-input" type="text" class="form-control input-sm" placeholder="Type your message here..." />
                        <span class="input-group-btn">
                            <button class="btn btn-warning btn-sm" id="btn-send">Send</button>
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
    $('#propertieslist li').on('click', function(){
         var propertyAdd=$(this).text();
          jQuery.ajax({
            url:'setselectedchatpropery.php',
            type: "POST",
            data: {
                selected:propertyAdd
                },
           success: function(result){

            window.location.reload();
            }
        });
    });
    </script>
</body>
</html>
