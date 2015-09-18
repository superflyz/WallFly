<?php
session_start();
require_once(__DIR__ . '/../logincheck.php');
include(__DIR__ . "/../classes/chatfunctions.php");


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
    $pID = Chat::GetPropertyID($userName, $userType, $selectedProperty);
    unset($_SESSION['selectedChatProperty']);

}


//set pID if a tenant because only has one property to display
if ($userType == 'TENANT') {
    $tenantArray = [];
    $tenantArray = Chat::GetProperties($userName, $userType);
    $selectedProperty = $tenantArray[0];
    $pID = Chat::GetPropertyID($userName, $userType, $selectedProperty);

}


?>
<!doctype html>
<html lang="en">

<head>
    <!--    <title>Wallfly Calendar</title>-->
    <!--    <meta charset="utf-8"/>-->
    <!--    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2">-->
    <!--    <meta http-equiv="X-UA-Compatible" content="IE=edge">-->
    <!--    <meta name="description" content="WallFly - Property Mangement System">-->
    <!--    <meta name="author" content="The SuperFlyz">-->

    <!--    <link rel='stylesheet' type="text/css" href="style/style.css"/>-->
    <!--    <script src="js/jquery.js" type="text/javascript"></script>-->
    <!--    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--    <!--[if lt IE 9]-->
    <!--    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>-->
    <!--    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>-->
    <!--    <![endif]-->
    <!--    <link href='http://fonts.googleapis.com/css?family=Carrois+Gothic' rel='stylesheet' type='text/css'>-->
    <!--    <link rel='stylesheet' type="text/css" href="dzstooltip/dzstooltip.css"/>-->
    <!--    <link rel='stylesheet' type="text/css" href="dzscalendar/dzscalendar.css"/>-->
    <!--    <script src="dzscalendar/dzscalendar.js" type="text/javascript"></script>-->
    <!--    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>-->

    <!--    <link href="../css/bootstrap.min.css" rel="stylesheet">-->
    <!--    <link href="./bootstrap/bootstrap.css" rel="stylesheet">-->

    <!--    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>-->
    <!--    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>-->
    <!--    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">-->
    <!--    <link rel="stylesheet" type="text/css" href="../css/module.css">-->

    <!--    <link href="../css/wallfly.css" rel="stylesheet">-->


    <meta charset="utf-8"/>
    <title>Wallfly Calendar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2">
    <link href="./bootstrap/bootstrap.css" rel="stylesheet">
    <link rel='stylesheet' type="text/css" href="style/style.css"/>
    <script src="js/jquery.js" type="text/javascript"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link href='http://fonts.googleapis.com/css?family=Carrois+Gothic' rel='stylesheet' type='text/css'>
    <link rel='stylesheet' type="text/css" href="dzstooltip/dzstooltip.css"/>
    <link rel='stylesheet' type="text/css" href="dzscalendar/dzscalendar.css"/>
    <script src="dzscalendar/dzscalendar.js" type="text/javascript"></script>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/module.css">
    <!-- Bootstrap core CSS -->
    <link href="clockpicker/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for the timepicker template -->
    <!--    <link href="clockpicker/css/style.css" rel="stylesheet">-->
    <link href="clockpicker/css/timepicki.css" rel="stylesheet">


</head>

<body>
<?php if (($userType == 'AGENT') || ($userType == 'OWNER')) {

    $properties = Chat::GetProperties($userName, $userType);


    //dropdown for property list
    echo '<div class="container">';
    echo '<div class="btn-group divLeft">';
    echo '<a class="btn btn-primary dropdown-toggle show-properties" data-toggle="dropdown" href="#">Select a Property<span class="caret"></span></a>';

}

?>
<div id="reducedPadding">
    <div id="propertyHolder">
        <input placeholder="   type to search..." id="box" type="text"/>
        <ul class="navList ">
            <?php
            foreach ($properties as $propertyAddress) {
                echo '<li><a href="#">' . $propertyAddress . '</a></li>';
            } ?>
        </ul>
    </div>
</div>

<?php if (($userType == 'AGENT') || ($userType == 'OWNER')) {
    echo '</div>';
    echo '<div class="btn-group divRight">';
    echo '<a class="btn btn-primary dropdown-toggle add-event" data-toggle="modal" data-target=".event-modal-md" href="#">Add Calander Event<span class="caret"></span></a>';
    echo '</div></div>';
} ?>

<script>

    $(document).ready(function () {
        $("#propertyHolder").hide();
        $(".show-properties").click(function () {
            $("#propertyHolder").toggle();
        });


        $('.navList li a').on('click', function () {

            var propertyAdd = $(this).text();

            jQuery.ajax({
                url: '../chatsys/setselectedchatpropery.php',
                type: "POST",
                data: {
                    selected: propertyAdd
                },
                success: function (result) {

                    $("#propertyHolder").hide();
                    window.location.reload();
                }
            });
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
</script>
<!--start calendar-->
<section id="calender">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="dzscalendar-con  skin-responsive-galileo" style="max-width: 960px; margin: 25px auto;">
                    <div class="dzscalendar skin-responsive-galileo auto-init" style="" data-options="{
            design_month_covers : ['http://dummyimage.com/950x350/000000/3c3c3d.jpg','http://dummyimage.com/950x350/000000/3c3c3d.jpg','http://dummyimage.com/950x350/000000/3c3c3d.jpg','http://dummyimage.com/950x350/000000/3c3c3d.jpg','http://dummyimage.com/950x350/000000/3c3c3d.jpg','http://dummyimage.com/950x350/000000/3c3c3d.jpg','http://dummyimage.com/950x350/000000/3c3c3d.jpg','http://dummyimage.com/950x350/000000/3c3c3d.jpg','http://dummyimage.com/950x350/000000/3c3c3d.jpg','http://dummyimage.com/950x350/000000/3c3c3d.jpg','http://dummyimage.com/950x350/000000/3c3c3d.jpg','http://dummyimage.com/950x350/000000/3c3c3d.jpg']
            ,start_weekday: 'Monday'
            ,header_weekdayStyle: 'responsivefull'
        }">
                        <div class="events">
                            <div class="event-tobe" data-date="3-14-2014">test</div>

                            <!-- this is how you define a every week event -->
                            <div class="event-tobe" data-tag="blue" data-repeat="everyweek" data-day="7" data-month="9"
                                 data-year="2015" data-type="link" data-href="http://google.com">everyweek
                            </div>
                            <!-- this is how you define a every week event END -->


                            <!-- this is how you define a EOK event -->
                            <div class="event-tobe" data-tag="blue" data-repeat="everyotherweek" data-day="23"
                                 data-month="9" data-year="2015" data-type="link" data-href="http://google.com">every
                                other week
                            </div>
                            <!-- this is how you define a EOK event END -->


                            <div class="event-tobe" data-tag="imgbg" data-eventbg="img/bg.jpg" data-repeat="everymonth"
                                 data-day="6">
                                <span class="tooltip-heading">Meeting at Palace@ 3PM</span>
                                <span class="label">Date</span> 11-8-2012 at 6PM<br/>
                                <span class="label">Location</span> Bremen, Germany<br>
                                <br/>Ana is meeting with you in the town square.
                            </div>

                            <div class="event-tobe" data-tag="blue" data-repeat="everyweek" data-day="26" data-month="9"
                                 data-year="2015" data-type="link" data-href="http://google.com">
                                <span class="tooltip-heading">Khafan must do...</span>
                                <span class="label">Action</span>Buy android product<br/>
                                <span class="label">Time</span>9AM as soon as store opens<br>
                                <br/>You know that apple sucks right ?
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<!--end calendar-->


<!--add event modal-->
<div class="modal modal-vcenter fade event-modal-md" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <p class="modal-title flabel">Add Event</p>
            </div>

            <div class="modal-body">
                <form id="setEvent" name="setEvent" method="post" action="setevent.php">
                    <div class="form-field ff1">
                        <label for="eventName">Event Name</label>
                        <input name="eventName" type="text" id="eventName" class="form-control">
                    </div>
                    <div class="form-field">
                        <label for="description">Time</label>

                        <div class="inner cover indexpicker">

                            <input id="timepicker1" type="text" name="timepicker1"/>

                        </div>

                    </div>
                    <div class="form-field">
                        </br>
                        <label for="description">Select Interval</label>
                        <select class="form-control">
                            <option value="onetime">One Time</option>
                            <option value="weekly">Weekly</option>
                            <option value="fortnightly">Fortnightly</option>
                            <option value="monthly">Monthly</option>
                            <option value="yearly">Yearly</option>
                        </select>
                    </div>
                    <div class="form-field">
                        </br>
                        <label for="description">Description</label>
                        <input name="description" type="text" id="description" class="form-control">
                    </div>
                    <!-- date picker -->

                    <div class="form-field">

                        <label for="date">Event Date</label>
                        <pre name="date " class="event-receiver">no event date...</pre>
                        <section style="height:200px">
                            <div class="col-md-12">
                                <div class="dzscalendar skin-aurora" id="trauroradatepicker" style="height:200px">
                                    <div class="events">
<!--                                        <div class="event-tobe" data-repeat="everymonth" data-day="09"></div>-->
<!--                                        <div class="event-tobe" data-repeat="everymonth" data-day="10"></div>-->
                                    </div>
                                </div>
                            </div>
                        </section>


                    </div>

                    <!-- end date picker -->
                    <span class="error"><?php echo $_SESSION['loginError']; ?></span>

                    <div>
                        <button type="submit" name="Submit" value="Login" id="login_btn"
                                class="btn btn-primary btn-sm btn-block submit">Add event
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end add event modal-->
<script>
    jQuery(document).ready(function ($) {
        // cover pictures for calendar jan->dec in order
        var design_month_covers = ['img/jan.jpg', 'img/feb.jpg', 'img/mar.jpg', 'img/apr.jpg', 'img/may.jpg', 'img/jun.jpg', 'img/jul.jpg', 'img/aug.jpg', 'img/sep.jpg', 'img/oct.jpg', 'img/nov.jpg', 'img/dec.jpg'];

        //set cover pictures
        dzscal_init("#cal-responsive-galileo2", {
            design_month_covers: design_month_covers
        });

        dzscal_init("#trauroradatepicker", {
            design_transitionDesc: 'tooltipDef'
            , mode: 'datepicker'
            , header_weekdayStyle: 'three'
            , design_transition: 'fade'
        });

        dzscal_init("#calendar_datepicker", {
            design_transitionDesc: 'tooltipDef'
            , mode: 'datepicker'
            , date_format: 'j-F-Y'
            , header_weekdayStyle: 'three'
            , design_transition: 'fade'
            , mode_datepicker_setTodayAsDefault: 'on'
        });


        function dp1_event(arg) {
            //console.log(arg);
            $('.event-receiver').html(arg);

        }

        var dp1 = document.getElementById('trauroradatepicker');
        if (dp1) {
            dp1.arr_datepicker_events.push(dp1_event);

        }
    });
</script>

<link rel="stylesheet" href="fontawesome/font-awesome.min.css"/>
<!-- Placed at the end of the document so the pages load faster -->
<script src="clockpicker/js/jquery.min.js"></script>
<script src="clockpicker/js/timepicki.js"></script>
<script>
    $('#timepicker1').timepicki();
</script>
<script src="clockpicker/js/bootstrap.min.js"></script>


</body>

</html>
