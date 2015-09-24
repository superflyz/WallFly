<?php
session_start();
require_once(__DIR__ . '/../logincheck.php');
include(__DIR__ . "/../classes/PropertyFunctions.php");
include(__DIR__ . "/../classes/CalendarEvents.php");


//set up page variables
$_SESSION['propertyId'] = "";
$userName = $_SESSION["username"];
$userType = $_SESSION["usertype"];
$properties = [];
$selectedProperty = "";
$pID = '';

if (!isset($_SESSION['eventAdded'])) {

    $_SESSION['eventAdded'] = "";
}

//set the propertyID from the $_SESSION['selectedChatProperty'] if set
if (isset($_SESSION['selectedChatProperty'])) {
    $selectedProperty = $_SESSION['selectedChatProperty'];
    $pID = PropertyFunctions::GetPropertyID($userName, $userType, $selectedProperty);
    //unset($_SESSION['selectedChatProperty']);

}


//set pID if a tenant because only has one property to display
if ($userType == 'TENANT') {
    $tenantArray = [];
    $tenantArray = PropertyFunctions::GetProperties($userName, $userType);
    $selectedProperty = $tenantArray[0];
    $pID = PropertyFunctions::GetPropertyID($userName, $userType, $selectedProperty);

}


?>
<!doctype html>
<html lang="en">

<head>

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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

    <!-- Bootstrap core CSS -->
    <link href="clockpicker/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for the timepicker template -->
    <!--    <link href="clockpicker/css/style.css" rel="stylesheet">-->
    <link href="clockpicker/css/timepicki.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/module.css">

    <script src="../js/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/sweetalert.css">
    <!-- Custom Theme JavaScript -->
    <script src="clockpicker/js/bootstrap.min.js"></script>
    <script src="http://cdn.jsdelivr.net/jquery.validation/1.14.0/jquery.validate.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.0/additional-methods.js"></script>
    <script src="clockpicker/js/timepicki.js"></script>

    <script>
        $(document).ready(function () {



            $("#propertyHolder").hide();
            $(".show-properties").click(function () {
                $("#propertyHolder").toggle();
            });

            $('.navList li a').on('click', function () {

                var propertyAdd = $(this).text();


                $.ajax({
                    type: 'POST',
                    url: "calendarSetProperty.php",
                    data: {
                        selected: propertyAdd
                    },
                    success: function (data) {

                        $("#propertyHolder").hide();
                        window.location.reload();

                    },
                    error: function (data) {
                        alert('Exeption:' + exception);
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


            var eventAdded = <?php echo "'".$_SESSION['eventAdded']."'";?>;
            if (eventAdded == "true") {
                swal("Success", "You have added an event to the calendar", "success");
            } else if (eventAdded == "true") {
                sweetAlert("Oops...", "Something went wrong with adding that event", "error");

            }
            <?php unset($_SESSION['eventAdded']);?>

            $('#add-event').click(function () {
                var checkID = <?php echo "'".$pID."'";?>;
                if (checkID == 0) {
                    swal("Just a reminder", "To please select a property first to add an event");
                } else {
                    $('.event-modal-md').modal('show');
                }

            });

            $('#select-event').click(function () {
                var checkID = <?php echo "'".$pID."'";?>;
                if (checkID == 0) {
                    swal("Just a reminder", "To please select a property first to add an event");
                } else {

                    jQuery.ajax({
                        url: 'getPropertyEvents.php',
                        type: "POST",
                        data: {
                            selected: checkID
                        },
                        success: function (result) {
                            $("#dynamic-edit").empty();
                            $("#dynamic-edit").append(result);
                            $('.select-modal-md').modal('show');

                        }
                    });
                }
            });

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

            $('#setEvent').validate({ // initialize the plugin
                rules: {
                    eventName: {
                        required: true,
                        maxlength: 20
                    },
                    date: {
                        required: true
                    },
                    description: {
                        maxlength: 100
                    }

                }
            });

            $('#hidden').bind("DOMSubtreeModified", function () {
                var date = $('#hidden').html();
                var dateArray = date.split("-");
                var dateString = dateArray[1] + "/" + dateArray[0] + "/" + dateArray[2];
                $('#date').val(dateString);

            });


            $('#timepicker1').timepicki();


        });


    </script>

</head>

<body>
<!--add event modal-->
<div class="modal modal-vcenter fade event-modal-md" tabindex="-1" role="dialog"
     aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <p class="modal-title flabel">Add Event</p>
            </div>

            <div class="modal-body">
                <form id="setEvent" name="addEvent" method="post" action="addevent.php">
                    <div class="form-field ff1">
                        <label for="eventName">Event Name</label>
                        <input name="eventName" type="text" class="form-control">
                        <span class="error"></span>
                    </div>
                    <div class="form-field">
                        <label for="timepicker1">Time</label>

                        <div class="inner cover indexpicker">

                            <input id="timepicker1" type="text" name="timepicker1"/>


                        </div>

                    </div>
                    <div class="form-field">
                        </br>
                        <label for="interval">Select Interval</label>
                        <select name="interval" class="form-control">
                            <option value="onetime">One Time</option>
                            <option value="everyweek">Weekly</option>
                            <option value="everyotherweek">Fortnightly</option>
                            <option value="everymonth">Monthly</option>
                        </select>
                        <span class="error"></span>
                    </div>
                    <div class="form-field">
                        </br>
                        <label for="description">Description</label>
                        <input name="description" type="text" id="description" class="form-control">
                        <span class="error"></span>
                    </div>
                    <div class="form-field">
                        <input type="hidden" name="propertyID" id="propertyID" class="form-control"
                               value="<?php echo $pID; ?> ">
                    </div>
                    <div class="form-field">
                        <input type="hidden" name="email" id="email" class="form-control"
                               value="<?php echo $userName; ?> ">
                    </div>
                    <!-- date picker -->

                    <div class="form-field">

                        <label for="date">Event Date</label>
                        <input name="date" id="date" type="text" class="form-control" readonly>
                        <pre hidden id="hidden" class="event-receiver"></pre>
                        <span class="error"></span>
                        <section style="height:200px">
                            <div class="col-md-12">
                                <div class="dzscalendar skin-aurora" id="trauroradatepicker" style="height:200px">
                                </div>
                            </div>
                        </section>

                    </div>

                    <!-- end date picker -->
                    <div>
                        <button type="submit" name="Submit" value="submit" id="submit-btn"
                                class="btn btn-primary submit">Add event
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end add event modal-->

<!--select event modal-->
<div class="modal modal-vcenter fade select-modal-md" tabindex="-1" role="dialog"
     aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <p class="modal-title flabel">Select Event</p>
            </div>

            <div id="select-modal-body" class="modal-body">
                <form id="selectEvent" name="addEvent" method="post" action="addevent.php">
                    <div id="dynamic-edit" class="clearfix">

                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- end add event modal-->

<?php if (($userType == 'AGENT') || ($userType == 'OWNER')) {

    $properties = PropertyFunctions::GetProperties($userName, $userType);


    //dropdown for property list
    echo '<div class="container">';
    echo '<div class="btn-group divLeft">';
    echo '<a class="btn btn-primary dropdown-toggle show-properties" data-toggle="dropdown" href="#">Select a Property</a>';

}

?>
<div id="propertyHolder">
    <input placeholder="   type to search..." id="box" type="text"/>
    <ul class="navList ">
        <?php
        foreach ($properties as $propertyAddress) {
            echo '<li><a href="">' . $propertyAddress . '</a></li>';
        } ?>
    </ul>
</div>


<?php if (($userType == 'AGENT') || ($userType == 'OWNER')) {
    echo '</div>';
    echo '<div class="btn-group divLeft">';
    echo '<a id="add-event" class="btn btn-primary dropdown-toggle add-event" data-toggle="modal"  href="#">Add Calander Event</a>';
    echo '</div>';

    echo '<div class="btn-group divLeft">';
    echo '<a id="select-event" class="btn btn-primary" data-toggle="modal"  href="#">Edit Calander Event</a>';
    echo '</div>';
    echo '</div>';
} ?>
<!--start calendar-->
<section id="calender">
    <div class="container">
        <div class="row">
            <div class="col-md-12 extend">
                <div class="dzscalendar-con  skin-responsive-galileo" style="max-width: 960px; margin: 25px auto;">
                    <div class="dzscalendar skin-responsive-galileo auto-init" style="" data-options="{
            design_month_covers : ['http://dummyimage.com/950x350/000000/3c3c3d.jpg','http://dummyimage.com/950x350/000000/3c3c3d.jpg','http://dummyimage.com/950x350/000000/3c3c3d.jpg','http://dummyimage.com/950x350/000000/3c3c3d.jpg','http://dummyimage.com/950x350/000000/3c3c3d.jpg','http://dummyimage.com/950x350/000000/3c3c3d.jpg','http://dummyimage.com/950x350/000000/3c3c3d.jpg','http://dummyimage.com/950x350/000000/3c3c3d.jpg','http://dummyimage.com/950x350/000000/3c3c3d.jpg','http://dummyimage.com/950x350/000000/3c3c3d.jpg','http://dummyimage.com/950x350/000000/3c3c3d.jpg','http://dummyimage.com/950x350/000000/3c3c3d.jpg']
            ,start_weekday: 'Monday'
            ,header_weekdayStyle: 'responsivefull'
        }">
                        <div class="events">


                            <div class="event-tobe" data-date="3-14-2014"></div>

                            <div class="event-tobe" data-tag="imgbg" data-eventbg="img/bg.jpg" data-repeat="everymonth"
                                 data-day="6">
                                <span class="tooltip-heading">Meeting at Palace@ 3PM</span>
                                <span class="label">Date</span> 11-8-2012 at 6PM<br/>
                                <span class="label">Location</span> Bremen, Germany<br>
                                <br/>Ana is meeting with you in the town square.
                            </div>


                            <?php
                            if (($pID == "") && ($userType != "TENANT")) {


                                $events = CalendarEvents::getAllEvents($userName);

                                foreach ($events as $event) {

                                    $interval = $event->eventInterval;
                                    $explodeDate = explode("/", $event->eventDate);
                                    echo ' <div class="event-tobe" data-tag="blue" data-repeat=' . $interval . ' data-day="' . $explodeDate[0] . '" data-month="' . $explodeDate[1] . '"
                                        data-year="' . $explodeDate[2] . '" data-type="link" data-href="#">
                                        <span class="tooltip-heading">' . $event->eventName . '</span>';
                                    if ($event->eventTime != "") {
                                        echo '<span class="label">Time:</span>' . $event->eventTime . '<br/>';
                                    }
                                    echo '<br/>' . $event->description . '</div>';


                                };

                            } else {

                                $events = CalendarEvents::getPropertyEvents($pID);

                                foreach ($events as $event) {

                                    $interval = $event->eventInterval;
                                    $explodeDate = explode("/", $event->eventDate);
                                    echo ' <div class="event-tobe" data-tag="blue" data-repeat=' . $interval . ' data-day="' . $explodeDate[0] . '" data-month="' . $explodeDate[1] . '"
                                        data-year="' . $explodeDate[2] . '" data-type="link" data-href="#">
                                        <span class="tooltip-heading">' . $event->eventName . '</span>';
                                    if ($event->eventTime != "") {
                                        echo '<span class="label">Time:</span>' . $event->eventTime . '<br/>';
                                    }
                                    echo '<br/>' . $event->description . '</div>';

                                };
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<!--end calendar-->


<link rel="stylesheet" href="fontawesome/font-awesome.min.css"/>


</body>

</html>
